<?php
function bookAvaiableCheck($pdo,$book_ID){

    $stmtBorrowed = $pdo->prepare("select  
count(book.book_name)  as 'borrowed'

from rent
join book on rent.book_ID = book.ID
join rent_log on rent.ID = rent_log.rent_ID
WHERE rent_log.return_date is null and book.ID = :book_ID");
        
    $stmtBorrowed->bindParam(":book_ID", $book_ID, PDO::PARAM_INT);
    $stmtBorrowed->execute();

    $stmtBookNum = $pdo->prepare("select quantity from book where ID = :book_ID");
    $stmtBookNum->bindParam(":book_ID", $book_ID, PDO::PARAM_INT);
    $stmtBookNum->execute();

 $borrowedCount = $stmtBorrowed->fetchcolumn();
 $BookCount = $stmtBookNum->fetchcolumn();
    
  $isAvailable = "Available"; ;

 if($BookCount <= $borrowedCount){
    $isAvailable = "Not Available";

}

$result = array("book state" => $isAvailable, "borrowed books" => $borrowedCount, "available books" => $BookCount);

return $result;

}
?>

