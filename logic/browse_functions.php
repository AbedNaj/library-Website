<?php

function sanitizeInput($input)
{
    return filter_var(trim($input), FILTER_SANITIZE_NUMBER_INT);
}


function getCategories($pdo)
{

    $stmtCategory = $pdo->prepare(query: "SELECT ID, category_name FROM categories");
    $stmtCategory->execute();
    return $stmtCategory->fetchAll(PDO::FETCH_ASSOC);
}

function getBooks($pdo, $selectedCategory = null)
{

    if ($selectedCategory !== null) {
        $stmtAllBooks = $pdo->prepare("SELECT 
    book.ID, 
    book.book_name,     
    authors.author_name, 
    book_img.img_url

FROM 
    book
    
    join  authors on authors.ID = book.book_author
JOIN 
    book_img 
ON 
    book.ID = book_img.book_ID
    
    where book.book_category = :category_id
    ");
        $stmtAllBooks->bindParam(":category_id", $selectedCategory, PDO::PARAM_INT);
        $stmtAllBooks->execute();

        return $stmtAllBooks->fetchAll(PDO::FETCH_ASSOC);


    } else {
        $stmtAllBooks = $pdo->prepare("SELECT 
        book.ID, 
        book.book_name, 
        authors.author_name, 
        book_img.img_url
    
    FROM 
        book
        
        join  authors on authors.ID = book.book_author
    JOIN 
        book_img 
    ON 
        book.ID = book_img.book_ID
        
      
        ");
        $stmtAllBooks->execute();

        return $stmtAllBooks->fetchAll(PDO::FETCH_ASSOC);

    }

}

?>