<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form values
    $bookTitle       = trim($_POST["title"]);
    $bookDescription = trim($_POST["description"]);
    $bookAuthorInput = trim($_POST["author"]);    // This is now a string (author name)
    $bookCategoryInput = trim($_POST["category"]);  // This is now a string (category name)
    $publicationYear = trim($_POST["publication_year"]);
    $copies          = trim($_POST["copies"]);

    try {
        // *** Process Author ***
        // Check if the author exists (assuming the column is named "author_name")
        $stmt = $pdo->prepare("SELECT id FROM authors WHERE author_name = :author_name");
        $stmt->execute([':author_name' => $bookAuthorInput]);
        $author = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($author) {
            $bookAuthor = $author['id'];
        } else {
            // Insert the new author if not found
            $stmt = $pdo->prepare("INSERT INTO authors (author_name) VALUES (:author_name)");
            $stmt->execute([':author_name' => $bookAuthorInput]);
            $bookAuthor = $pdo->lastInsertId();
        }

        // *** Process Category ***
        // Check if the category exists (assuming the column is named "category_name")
        $stmt = $pdo->prepare("SELECT id FROM categories WHERE category_name = :category_name");
        $stmt->execute([':category_name' => $bookCategoryInput]);
        $category = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($category) {
            $bookCategory = $category['id'];
        } else {
            // Insert the new category if not found
            $stmt = $pdo->prepare("INSERT INTO categories (category_name) VALUES (:category_name)");
            $stmt->execute([':category_name' => $bookCategoryInput]);
            $bookCategory = $pdo->lastInsertId();
        }

        // *** Insert the new book ***
        $stmt = $pdo->prepare("INSERT INTO book 
            (book_name, book_description, book_author, book_category, publication_year, quantity)
            VALUES (:book_title, :book_description, :book_author, :book_category, :publication_year, :copies)");

        $stmt->bindParam(":book_title", $bookTitle, PDO::PARAM_STR);
        $stmt->bindParam(":book_description", $bookDescription, PDO::PARAM_STR);
        $stmt->bindParam(":book_author", $bookAuthor, PDO::PARAM_INT);
        $stmt->bindParam(":book_category", $bookCategory, PDO::PARAM_INT);
        $stmt->bindParam(":publication_year", $publicationYear, PDO::PARAM_STR);
        $stmt->bindParam(":copies", $copies, PDO::PARAM_INT);

        if ($stmt->execute()) {
            echo "تم إضافة الكتاب بنجاح";
        } else {
            echo "حدث خطأ ما";
        }
    } catch (PDOException $e) {
        echo "حدث خطأ ما " . $e->getMessage();
    }
}
