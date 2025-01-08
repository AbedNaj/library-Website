<?php
include_once("../includes/db_connect.php");
if(isset($_GET['request'])){

$requestID = $_GET['request'];



try{
$stmt = $pdo->prepare("select 
rent.ID,
users.user_name,
book.book_name,
rent.request_date,
rent.rent_days_count,
rent.rent_state_date,
rent_log.return_expiry_date,
case 
when rent.rent_state = 1 THEN 'Approved'
when rent.rent_state = 0 THEN 'Rejected'
else 'Pending'  
end as rent_state


from rent
join users on users.ID = rent.user_ID
join book on book.ID = rent.book_ID
left join rent_log on rent_log.rent_ID = rent.ID
where rent.ID = :requestID
order by rent.request_date desc");

$stmt->bindParam(":requestID", $requestID, PDO::PARAM_INT);
$stmt->execute();
$request = $stmt->fetch(PDO::FETCH_ASSOC);


}
catch(PDOException $e){
echo $e->getMessage();
    
}
}


?>