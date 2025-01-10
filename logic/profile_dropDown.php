<?php
// في navbar.php
$projectRoot = $_SERVER['DOCUMENT_ROOT'] ;

require_once($projectRoot . "/includes/init.php");
require_once($projectRoot . "/includes/db_connect.php");


$stmt = $pdo->prepare("SELECT user_name FROM users WHERE id = :id");
$stmt->bindParam(":id", $_SESSION["user_id"], PDO::PARAM_INT);
if ($stmt->execute()) {


    $username = $stmt->fetchColumn();
}

?>