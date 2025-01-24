<?php
require_once("../includes/init.php");
require_once("../includes/db_connect.php");
require_once("return_functions.php");


$totalReturns = GetStatistics(
    $pdo,
    "select count(ID) as return_count
from rent_log 
WHERE return_date is not null"
);


$OnTimeReturns = GetStatistics(
    $pdo,
    "select count(ID)
from rent_log 
WHERE return_date is not null and DATEDIFF(rent_log.return_expiry_date,rent_log.return_date) > 0"
);

$OverdueReturns = GetStatistics(
    $pdo,
    "select count(ID)
from rent_log 
WHERE return_date is not null and DATEDIFF(rent_log.return_expiry_date,rent_log.return_date) < 0"
);


$returns = GetReturns($pdo, "select 
rent.ID as rentID,
users.user_name as 'Borrower',
book.book_name as 'Book Title',
rent_log.rent_date as 'Borrowed Date',
rent_log.return_expiry_date as 'Due Date',
rent_log.return_date as 'Return Date',

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
order by 
ISNULL(rent_log.return_date) DESC, 
rent_log.return_date desc");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['clear'])) {
    try {
        $rentID = filter_var($_POST['rentID'], FILTER_SANITIZE_NUMBER_INT);
        $stmt = $pdo->prepare('UPDATE rent_log
        SET return_date = CURRENT_DATE
            WHERE rent_ID  = :rentID');
        $stmt->bindParam(':rentID', $_POST['rentID'], PDO::PARAM_INT);
        if ($stmt->execute()) {
            $_SESSION['message'] = 'The book has been returned successfully.';
            header('location: returns');
            exit();
        }
    } catch (PDOException $e) {
        error_log($e->getMessage());
        $_SESSION['message'] = 'Something Went Wrong...';
        header('location: returns');
        exit();
    }
}
