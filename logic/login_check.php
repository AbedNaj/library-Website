<?php 
require_once "../constants.php";
if (session_status() === PHP_SESSION_NONE) {

    session_start();

}

$isLoged = false;

if (isset($_SESSION["user_id"]) && isset($_SESSION["user_email"]) ) {
    $isLoged = true;

}


?>