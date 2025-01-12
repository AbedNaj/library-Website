<?php
require_once __DIR__ . '/../includes/init.php';
require_once __DIR__ . '/../includes/db_connect.php';
include_once("book_available_check.php");
include_once("book_comment.php");
include_once("book_fetch_details.php");
$bookID = htmlspecialchars($_GET["book_id"]);

try {
    // fetch the book details

   $book = fetchBookDetails($pdo , $bookID);

  // check if the book is available

        $bookStatuses = bookAvaiableCheck($pdo,$bookID);

        $IsAvailable;


  if($bookStatuses["book state"] == 'Available')
    $IsAvailable = true; else 
    $IsAvailable = false;
   

   // fetch the comments
   
   $comments = fetchComments($pdo , $bookID);

    // fetch the comments count
   $commentsCount = commentsCount($pdo, $bookID);


   // delete the comment
 
 
   if(isset($_POST['comment_id']) && $_SERVER['REQUEST_METHOD'] == 'POST' ){
    $commentID = filter_var($_POST['comment_id'], FILTER_SANITIZE_NUMBER_INT);
    commentDelete($pdo , $commentID);
 
   

    $_SESSION['commentDeleted'] = 'Comment Deleted Successfully';
    header("Location: book-details?book_id=" .  urlencode($bookID). "#comments-section");
 
    exit; 

}

    // check if the user is logged in to be able to comment and insert the comment
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['comment'])){
        if(!isset($_SESSION["user_id"])){
        $commentMessage = "You need to login to comment";
   
    }else{
        $user = filter_var($_SESSION["user_id"], FILTER_SANITIZE_NUMBER_INT);
        commentInsert($pdo , $user , $bookID);

    
       header("Location: book-details?book_id=" .  urlencode($bookID). "#comments-section");
       exit; 
    }


}

    } catch (PDOException $e) {
       error_log($e->getMessage());
        echo"something went wrong";
    }

?>