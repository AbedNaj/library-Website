<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['admin_id'])) {
    header("Location: /admin");
    exit();
}


?>
<?php
require_once '../includes/login_include.php';
