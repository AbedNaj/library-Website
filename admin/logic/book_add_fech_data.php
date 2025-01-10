<?php
require_once("../includes/init.php");
require_once("../includes/db_connect.php");


try {
    $stmtAuth = $pdo->prepare("SELECT * FROM authors");
    $stmtCategory = $pdo->prepare("SELECT * FROM categories");

    $stmtAuth->execute();
    $stmtCategory->execute();

    $authors = $stmtAuth->fetchAll(PDO::FETCH_ASSOC);
    $categories = $stmtCategory->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "حدث خطأ ما " . $e->getMessage();

}

?>