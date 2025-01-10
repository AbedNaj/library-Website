<?php
require_once __DIR__ . '/../includes/init.php';
require_once __DIR__ . '/../includes/db_connect.php';
include_once("book_available_check.php");

$bookID = htmlspecialchars($_GET["book_id"]);

try {
$stmt = $pdo->prepare("SELECT 
    book.ID, 
    book.book_name,    
    book.book_description,
    book.quantity,
    book.publication_year ,
    authors.author_name, 
    book_img.img_url
 
FROM 
    book
    
    join  authors on authors.ID = book.book_author
JOIN 
    book_img 
ON 
    book.ID = book_img.book_ID
    
    where book.ID = :bookID
    ");


        $stmt ->bindParam(":bookID", $bookID, PDO::PARAM_INT);
        $stmt -> execute(); 

        $book = $stmt->fetch(PDO::FETCH_ASSOC);


        $bookStatuses = bookAvaiableCheck($pdo,$bookID);

        
  $IsAvailable;

  if($bookStatuses["book state"] == 'Available')
    $IsAvailable = true; else 
    $IsAvailable = false;
   

  
     
    } catch (PDOException $e) {

        echo"something went wrong" . $e->getMessage();
    }

?>