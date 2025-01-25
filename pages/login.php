<header>
    <title>Login</title>
</header>

<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['user_id'])) {
    header("Location: /");
    exit();
}


?>
<?php include '../includes/header.php'; ?>
<?php include '../includes/login_include.php'; ?>