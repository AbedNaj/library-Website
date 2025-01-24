<?php
require_once("../includes/init.php");
require_once("../includes/db_connect.php");


// fetch renturn data
try {
    $returnID = $_GET['return'];
    $stmt = $pdo->prepare("select 
rent.ID as rentID,
users.user_name as 'Borrower',
book.book_name as 'Book Title',
rent_log.rent_date as 'Borrowed Date',
rent_log.return_expiry_date as 'Due Date',
rent_log.return_date as 'Return Date',
rent_log.ID as rentLogID ,
DATEDIFF(rent_log.return_expiry_date, CURDATE()) as days_remaining 


from rent
join users on users.ID = rent.user_ID
join book on book.ID = rent.book_ID
join rent_log on rent_log.rent_ID = rent.ID
where  rent.ID = :returnID");

    $stmt->bindParam(":returnID", $returnID, PDO::PARAM_INT);

    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log("return fine : " . $e->getMessage());
    echo $e->getMessage();
}

// accept the fine

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $returnID = $_POST['returnID'];
        $fineAmount = $_POST['fineAmount'];
        $stmt = $pdo->prepare("insert into rent_fine(rentID , fine_amount , fine_state)
                                        VALUES(:returnID , :fine_amount , 1)");
        $stmt->bindParam(":returnID", $returnID, PDO::PARAM_INT);
        $stmt->bindParam(":fine_amount", $fineAmount, PDO::PARAM_INT);
        $stmt->execute();



        $rentID = filter_var($_GET['return'], FILTER_SANITIZE_NUMBER_INT);
        $stmt2 = $pdo->prepare('UPDATE rent_log
        SET return_date = CURRENT_DATE
            WHERE rent_ID  = :rentID');
        $stmt2->bindParam(':rentID',  $rentID, PDO::PARAM_INT);
        if ($stmt2->execute()) {
            $_SESSION['message'] = 'The book has been returned successfully.';
            header('location: returns');
            exit();
        }
    } catch (PDOException $e) {
        error_log("return fine : " . $e->getMessage());
        echo $e->getMessage();
    }
}
