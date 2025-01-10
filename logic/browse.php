<?php
require_once __DIR__ . '/../includes/init.php';
require_once __DIR__ . '/../includes/db_connect.php';


require_once 'browse_functions.php';
include_once "../logic/book_available_check.php";
try {

    $selectedCategory = isset($_GET['category_id']) ? sanitizeInput($_GET['category_id']) : null;

    // جلب البيانات
    $categories = getCategories($pdo);
    $allBooks = getBooks($pdo, $selectedCategory);

    $bookStatuses = [];


    foreach ($allBooks as $book) {
        $bookStatuses[$book['ID']] = bookAvaiableCheck($pdo, $book['ID']);

    }
} catch (PDOException $e) {
    error_log("Database error: " . $e->getMessage());
    echo "حدث خطأ أثناء معالجة طلبك. يرجى المحاولة لاحقًا.";
}
?>