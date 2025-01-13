<?php
require_once "../includes/init.php";
require_once "../includes/db_connect.php";
require_once "profile_functions.php";
try{
$user_id = filter_var($_SESSION['user_id'], FILTER_SANITIZE_NUMBER_INT);

$userDate = getUserDate($pdo , $user_id );

$BooksRead = BooksRead($pdo , $user_id);

$CurrentlyBorrowedCount = CurrentlyBorrowedCount($pdo , $user_id);


$commentsCount = CommentsCount($pdo , $user_id);

$currentlyBorrowed = CurrentlyBorrowed($pdo , $user_id);

$recentReturned = RecentReturn($pdo , $user_id);

}catch(PDOException $e){
error_log("Profile Error: ".$e->getMessage());
}


?>