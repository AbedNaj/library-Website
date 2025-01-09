<?php 
include_once "../includes/db_connect.php";
if ($_GET["IsAvaiable"] == false) {
  exit("this book is not available now");
}


if ($_SERVER ["REQUEST_METHOD"] === 'POST') {
    if(!empty($_POST["duration"])){

      $daysCount = filter_var($_POST["duration"], FILTER_SANITIZE_NUMBER_INT);
      $userID = filter_var($_SESSION["user_id"], FILTER_SANITIZE_NUMBER_INT);
        $bookID = filter_var($_GET["book_id"], FILTER_SANITIZE_NUMBER_INT);
        try{

  $stmt = $pdo->prepare("
  insert into rent(user_ID , book_ID , rent_days_count)
  values(:user_ID , :book_ID , :rent_days_count)");
   $stmt->bindParam(":user_ID" , $userID , PDO::PARAM_INT);
   $stmt->bindParam(":book_ID" , $bookID , PDO::PARAM_INT);
   $stmt->bindParam(":rent_days_count" , $daysCount , PDO::PARAM_INT);


  if($stmt->execute()) {
echo"your request has been sent successfully";
  }else
  {
    echo "something went wrong with your request";
  }


        }
        catch(PDOException $e){
            
echo"something went wrong...";
    }


    }else{
      echo "please enter the duration";
    }




}


?>