<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bookTitle = trim($_POST["title"]);
    $bookDescription = trim($_POST["description"]);
    $bookAuthor = trim($_POST["author"]);
    $bookCategory = trim($_POST["category"]);
    $publicationYear = trim($_POST["publication_year"]);
    $copies = trim($_POST["copies"]);


    try {
        $stmt = $pdo->prepare("INSERT INTO book (book_name, book_description, book_author, book_category, publication_year, quantity ) 
    VALUES (:book_title, :book_description, :book_author, :book_category, :publication_year, :copies)");

        $stmt->bindParam(":book_title", $bookTitle, PDO::PARAM_STR);
        $stmt->bindParam(":book_description", $bookDescription, PDO::PARAM_STR);
        $stmt->bindParam(":book_author", $bookAuthor, PDO::PARAM_INT);
        $stmt->bindParam(":book_category", $bookCategory, PDO::PARAM_INT);
        $stmt->bindParam(":publication_year", $publicationYear, PDO::PARAM_STR);
        $stmt->bindParam(":copies", $copies, PDO::PARAM_STR);

        if ($stmt->execute()) {
            echo "تم إضافة الكتاب بنجاح";
        } else

            echo "حدث خطأ ما";


    } catch (PDOException $e) {
        echo "حدث خطأ ما " . $e->getMessage();
    }


}

?>