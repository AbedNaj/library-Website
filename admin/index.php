

<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['admin_id'])) {
    header("Location: /admin/admin-login");
    exit();
}
include("includes/admin_include.php");

?>