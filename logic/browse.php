<?php 
require_once '../includes/db_connect.php';

try {
    // تحضير الاستعلام لجلب الأعمدة الضرورية فقط
    $stmt = $pdo->prepare("SELECT id, category_name FROM categories");
    $stmt->execute();

    // جلب البيانات
    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($categories) {

    } else {
        echo "لا توجد فئات.";
    }
} catch (PDOException $e) {
    echo "خطأ في قاعدة البيانات: " . $e->getMessage();
}
?>

