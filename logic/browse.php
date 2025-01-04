<?php
require_once '../includes/db_connect.php';


require_once 'browse_functions.php';

try {

    $selectedCategory = isset($_GET['category_id']) ? sanitizeInput($_GET['category_id']) : null;

    // جلب البيانات
    $categories = getCategories($pdo);
    $allBooks = getBooks($pdo, $selectedCategory);
} catch (PDOException $e) {
    error_log("Database error: " . $e->getMessage());
    echo "حدث خطأ أثناء معالجة طلبك. يرجى المحاولة لاحقًا.";
}
?>