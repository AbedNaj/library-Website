<?php 
function fetchBookDetails($pdo, $bookID){

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

      
        return $stmt->fetch(PDO::FETCH_ASSOC);
    


}
?>