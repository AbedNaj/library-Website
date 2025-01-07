<?php 
include_once("../includes/db_connect.php");


// ادخال البيانات الى جدول rent
try{
$stmt = $pdo->prepare("select 
rent.ID,
users.user_name,
book.book_name,
rent.request_date,
rent.rent_days_count,

case 
when rent.rent_state = 1 THEN 'Approved'
when rent.rent_state = 0 THEN 'Rejected'
else 'Pending'  
end as rent_state


from rent
join users on users.ID = rent.user_ID
join book on book.ID = rent.book_ID
order by rent.request_date desc

");

$stmt->execute();

$requests = $stmt->fetchAll(PDO::FETCH_ASSOC);

}catch(Exception $e){}

?>


<?PHP


if($_SERVER['REQUEST_METHOD'] === 'POST'){

// التأكد من ان البيانات مرسلة
    if (isset($_POST['action']))
    {
        
$action = $_POST['action'];

// فحص القيمة المرسلة
        IF ($action == 'Approve'){
            $rent_state = 1;}
            elseIf ($action == 'Reject'){
                $rent_state = 0;
            }

      $rentID = $_POST['ID'];    
      
      // تحديث حالة الطلب في جدول ال rent
     try{

        $stmtRent = $pdo->prepare("update rent 
set
rent_state = :rent_state

where ID = :ID
");
    
$stmtRent->bindParam(":rent_state" , $rent_state, PDO::PARAM_INT);
$stmtRent->bindParam(":ID" , $rentID, PDO::PARAM_INT);

$stmtRent->execute();
// ادخال البيانات في جدول ال rent_log في حالة الموافقة
if ($action == 'Approve'&& $stmtRent->execute()){

    $stmtRentLog = $pdo->prepare('insert into rent_log (rent_ID,	return_expiry_date)
    values (:rent_ID, DATE_ADD(CURDATE(), INTERVAL :DaysCount DAY ))');

    $daysCount = filter_var( $_POST["DaysCount"] , FILTER_SANITIZE_NUMBER_INT);

    $stmtRentLog->bindParam(":rent_ID" , $rentID, PDO::PARAM_INT);
    $stmtRentLog->bindParam(":DaysCount" , $daysCount, PDO::PARAM_INT);
    $stmtRentLog->execute();
}

if($stmtRent->execute()){
    header("Location: borrow-requests");
    exit();}else
    {echo "something went wrong...";}
}

     catch(Exception $e){
        echo "something went wrong..." . $e->getMessage();
     }
        

    }
}


?>
