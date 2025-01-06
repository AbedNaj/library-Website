<?php

require_once '../includes/db_connect.php';

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
            echo "تم إنشاء الحساب بنجاح";
        } else {
            echo "حدث خطأ ما.";
        }

    } catch (PDOException $e) {
        error_log("Database error: " . $e->getMessage());
        die("حدث خطأ في الخادم.");
    }

}
?>
