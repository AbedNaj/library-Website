<?php
require_once "../includes/init.php";
require_once "../includes/db_connect.php";


try{

$stmt = $pdo->prepare("select 
rent.ID,
DATE(rent.request_date) AS request_date,
rent.rent_days_count,
book.book_name,
authors.author_name,
rent_log.rent_date,
rent_log.return_expiry_date,
rent_log.return_date,
DATEDIFF(rent_log.return_expiry_date, CURDATE()) as days_remaining, 
book_img.img_url,
rent_fine.fine_state,


case 
when rent.rent_state = 1 THEN 'Approved'
when rent.rent_state = 0 THEN 'Rejected'
else 'Pending'  
end as rent_state


from rent
join users on users.ID = rent.user_ID
join book on book.ID = rent.book_ID
left join rent_log on rent_log.rent_ID = rent.ID
join authors on book.book_author = authors.ID
join book_img on book.ID = book_img.book_ID
left JOIN rent_fine on rent_fine.rentID = rent_log.ID
where users.ID = :user_id
order by rent.request_date desc");

$user = filter_var($_SESSION["user_id"], FILTER_SANITIZE_NUMBER_INT);
$stmt->bindParam(":user_id", $user, PDO::PARAM_INT);

$stmt->execute();

$borrows = $stmt->fetchAll(PDO::FETCH_ASSOC);


if($_SERVER["REQUEST_METHOD"] == "POST"){
    $rent_id = filter_var($_POST["rent_id"], FILTER_SANITIZE_NUMBER_INT);
    $stmtDelete = $pdo->prepare("DELETE FROM rent WHERE ID = :rent_id");
    $stmtDelete->bindParam(":rent_id", $rent_id, PDO::PARAM_INT);
    $stmtDelete->execute();
    header("Location: borrowedBooks");
exit();
}
}catch(PDOException $e){
    error_log("Database error: " . $e->getMessage());
}
?>