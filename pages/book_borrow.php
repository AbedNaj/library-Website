<?php
require_once("../logic/login_check.php");

if(!$isLoged == true) {

    header("Location: login");
    exit();
}


include_once("../includes/book_borrow_include.php");    
?>