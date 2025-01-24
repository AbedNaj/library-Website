<?php

require_once "../includes/init.php";
require_once "../includes/db_connect.php";


if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


// check if the user is loged
if (isset($_SESSION['user_id'])) {

    // fetch current user name : 
    $stmt = $pdo->prepare('SELECT user_name FROM users WHERE ID = :userID');
    $stmt->bindParam(":userID", $_SESSION['user_id'], PDO::PARAM_INT);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $user = $user['user_name'];
    } else {
        die("User not found.");
    }

    // handle change userName
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['form_name'] === 'userForm') {
        try {
            $newUserName = $_POST['new-username'];
            $stmt = $pdo->prepare('UPDATE users SET user_name = :userName WHERE ID = :userID');
            $stmt->bindParam(":userID", $_SESSION['user_id'], PDO::PARAM_INT);
            $stmt->bindParam(":userName", $newUserName, PDO::PARAM_STR);

            if ($stmt->execute()) {
                $_SESSION['changeUser'] = 'UserName Changed Successfully';
                header("Location: settings");
                exit();
            }
        } catch (PDOException $e) {
            error_log($e->getMessage());
            $_SESSION['changeUser'] = 'Something Went Wrong...';
            header("Location: settings");
            exit();
        }
    }
    // handle change Password
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['form_name'] === 'passwordForm') {
        try {
            $currentPassword = $_POST['current-password'];
            $stmt = $pdo->prepare('SELECT user_password FROM users WHERE ID = :userID');
            $stmt->bindParam(":userID", $_SESSION['user_id'], PDO::PARAM_INT);
            $stmt->execute();
            $user_password = $stmt->fetchColumn();

            // Check if the current password is correct
            if (!password_verify($currentPassword, $user_password)) {
                $_SESSION['changePassword'] = 'Current password is incorrect. Please try again.';
                header("Location: settings");
                exit();
            }

            // Check if new password matches confirmation
            if ($_POST['new-password'] !== $_POST['confirm-password']) {
                $_SESSION['changePassword'] = 'New passwords do not match. Please re-enter your new password.';
                header("Location: settings");
                exit();
            }

            // Check if new password is the same as current password
            if (password_verify($_POST['new-password'], $user_password)) {
                $_SESSION['changePassword'] = 'New password cannot be the same as your current password.';
                header("Location: settings");
                exit();
            }

            // Check password length
            if (strlen($_POST['new-password']) < 8) {
                $_SESSION['changePassword'] = 'New Password must be longer than 8 characters.';
                header("Location: settings");
                exit();
            }

            // Update password
            $hashed_password = password_hash($_POST['new-password'], PASSWORD_DEFAULT);
            $stmt = $pdo->prepare('UPDATE users SET user_password = :userPassword WHERE ID = :userID');
            $stmt->bindParam(":userID", $_SESSION['user_id'], PDO::PARAM_INT);
            $stmt->bindParam(":userPassword", $hashed_password, PDO::PARAM_STR);

            if ($stmt->execute()) {
                $_SESSION['changePassword'] = 'Your password has been Successfully updated.';
                header("Location: settings");
                exit();
            }
        } catch (PDOException $e) {
            error_log($e->getMessage());
            $_SESSION['changePassword'] = 'Something went wrong';
            header("Location: settings");
            exit();
        }
    }
} else {
    die("you are not loged...");
}
