<?php 

try {
require_once("../includes/init.php");
require_once("../includes/db_connect.php");

$stmtNewRequests = $pdo->prepare("SELECT COUNT(ID)
FROM rent
WHERE DATE(request_date) = CURDATE()");


$stmtPendingRequests = $pdo->prepare("SELECT COUNT(ID)
FROM rent
where rent_state is null");

$stmtApprovedCount = $pdo->prepare("SELECT COUNT(ID)
FROM rent_log
WHERE rent_date = curdate()");

$stmtRejectedCount = $pdo->prepare("SELECT COUNT(ID)
FROM rent
WHERE rent_state_date = curdate() and rent_state = 0");

$stmtPendingRequests->execute();
$stmtNewRequests->execute();
$stmtApprovedCount-> execute();
$stmtRejectedCount->execute();

$NewRequestsCount = $stmtNewRequests->fetchColumn();
$PendingRequestCount = $stmtPendingRequests->fetchColumn();
$ApprovedCount = $stmtApprovedCount->fetchColumn();
$RejectedCount = $stmtRejectedCount->fetchColumn();


} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}   
?>