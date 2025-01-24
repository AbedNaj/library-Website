<?php
require_once("../includes/init.php");
require_once("../includes/db_connect.php");

try {
    $ReturnID = filter_var($_GET['return'], FILTER_SANITIZE_NUMBER_INT);
    $stmt = $pdo->prepare("select 
rent.ID as rentID,
users.user_name as 'Borrower',
book.book_name as 'Book Title',
rent_log.rent_date as 'Borrowed Date',
rent_log.return_expiry_date as 'Due Date',
rent_log.return_date as 'Return Date',
rent_fine.fine_amount,
case 
when DATEDIFF(rent_log.return_expiry_date,rent_log.return_date) >= 0 THEN 'On Time'
when DATEDIFF(rent_log.return_expiry_date, rent_log.return_date)< 0 THEN 'Overdue'
when DATEDIFF(rent_log.return_expiry_date, CURDATE()) >= 0 THEN 'On Time'
when DATEDIFF(rent_log.return_expiry_date, CURDATE()) < 0 THEN 'Overdue'
end as Status


from rent
join users on users.ID = rent.user_ID
join book on book.ID = rent.book_ID
join rent_log on rent_log.rent_ID = rent.ID
left join rent_fine on rent_fine.rentID = rent_log.id
where rent.ID = :returnID

");
    $stmt->bindParam(":returnID", $ReturnID, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Something Went Wrong...";
}
