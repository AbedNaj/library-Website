<?php
// ملف الاتصال بقاعدة البيانات
require_once '../includes/db_connect.php';

// التحقق من طريقة الطلب (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // التحقق من أن الحقول غير فارغة
    if (!empty($_POST['user_email']) && !empty($_POST['user_password'])) {
        // استقبال البيانات
        $user_email = filter_var(trim($_POST['user_email']), FILTER_SANITIZE_EMAIL); ;
        $user_password = trim($_POST['user_password']);
        try {
            $stmt = $pdo->prepare("SELECT * FROM users WHERE user_email = :user_email LIMIT 1");
            $stmt->bindParam(':user_email', $user_email, PDO::PARAM_STR);
            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                if (password_verify($user_password, $user["user_password"])) {
                    if (session_status() === PHP_SESSION_NONE) {
                        session_start();
                    }
                    $_SESSION['user_id'] = $user['ID'];
                    $_SESSION['user_email'] = $user['user_email'];

                    if (!headers_sent()) {
                        header("Location: /");
                        exit();
                    } else {
                        echo "<script>window.location.href='/pages/home.php';</script>";
                        exit();
                    }
                } else {
                    $error = "كلمة المرور غير صحيحة";
                }
            } else {
                $error = "البريد الإلكتروني غير موجود";
            }
        } catch (PDOException $e) {
            $error = "حدث خطأ ما ";
        }
    } else {
        $error = "يرجى ملء جميع الحقول.";
    }
}
?>