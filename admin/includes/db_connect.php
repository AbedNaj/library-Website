<?php

$host = "localhost";
$username = "root";
$db_name = "library";
$password = "";


try {
    $pdo = new PDO("mysql:host=$host;dbname=$db_name;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


} catch (Exception $e) {
    die("خطأ في الاتصال بقاعدة البيانات: " . $e->getMessage());
}

?>