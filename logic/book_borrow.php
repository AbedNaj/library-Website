<?php 
require_once __DIR__ . '/../includes/init.php';
require_once __DIR__ . '/../includes/db_connect.php';
require_once  'book_borrow_check.php';
if ($_GET["IsAvaiable"] == false) {
  exit("this book is not available now");
}


if ($_SERVER ["REQUEST_METHOD"] === 'POST') {
    if(!empty($_POST["duration"])){

       $daysCount = filter_var($_POST["duration"], FILTER_SANITIZE_NUMBER_INT);
        $userID = filter_var($_SESSION["user_id"], FILTER_SANITIZE_NUMBER_INT);
        $bookID = filter_var($_GET["book_id"], FILTER_SANITIZE_NUMBER_INT);
        $message = '';
        if (checkRentCount($pdo, $userID) == false) {
          $message = "You cannot borrow more than 3 books at a time.";
          return;
      }
      
      if (checkBookRentCount($pdo, $bookID, $userID) == false) {
        $message = "You have already borrowed this book.";  
          return;
      }
      
      try {
          $stmt = $pdo->prepare("
              INSERT INTO rent(user_ID, book_ID, rent_days_count)
              VALUES(:user_ID, :book_ID, :rent_days_count)
          ");
          
          $stmt->bindParam(":user_ID", $userID, PDO::PARAM_INT);
          $stmt->bindParam(":book_ID", $bookID, PDO::PARAM_INT);
          $stmt->bindParam(":rent_days_count", $daysCount, PDO::PARAM_INT);
      
          if ($stmt->execute()) {
  
              header("Location: borrowedBooks");
              exit();
          } else {
              echo "Something went wrong with your request";
          }
      } catch(PDOException $e) {
          error_log($e->getMessage());
          echo "Something went wrong with the database operation. Please try again later.";
      }
    }else{
      echo "please enter the duration";
    }




}


?>