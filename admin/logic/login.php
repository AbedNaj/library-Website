<?php
require_once("../includes/init.php");
require_once("../includes/db_connect.php");


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    try {
        $stmt  = $pdo->prepare('SELECT * FROM users WHERE user_email = :email and isAdmin= 1 LIMIT 1');
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user) {
            if ($password == $user["user_password"]) {
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
                $_SESSION['admin_id'] = $user['ID'];
                $_SESSION['admin_email'] = $user['user_email'];

                if (!headers_sent()) {
                    header("Location: /admin");
                    exit();
                }
            } else {

                $_SESSION["error"] = "Incorrect Email or Password ";
                header('location: admin-login');
                exit();
            }
        } else {
            $_SESSION["error"] = "Incorrect Email or Password ";
            header('location: admin-login');
            exit();
        }
    } catch (PDOException $e) {
    }
}
