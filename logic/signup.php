<?php

require_once __DIR__ . '/../includes/init.php';
require_once __DIR__ . '/../includes/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_var($_POST['email'] , FILTER_SANITIZE_EMAIL); ;
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);


    if (strlen($password) < 8) {
        die("يجب أن تكون كلمة المرور أطول من 8 أحرف.");
    }
    // تشفير كلمة المرور
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);


   try {
        // إدخال البيانات إلى قاعدة البيانات
        $stmt = $pdo->prepare("INSERT INTO users (user_email, user_name, user_password) 
                               VALUES (:email, :username, :passwords)");
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':passwords', $hashed_password, PDO::PARAM_STR);
        if ($stmt->execute()) {
            echo "account created successfully";
        } else {
            echo "Something went wrong. Please try again.";
        }

    } catch (PDOException $e) {
        if ($e->getCode() == 23000) { // 23000 is the SQLSTATE code for integrity constraint violation
            echo "this email is already used";
        } else {
            // Log the error and show a generic message
            error_log("Database error: " . $e->getMessage());
            die("Something went wrong. Please try again.");
        }

    }

}
?>
