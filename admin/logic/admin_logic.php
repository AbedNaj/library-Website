<?php
require_once("../includes/init.php");
require_once("../includes/db_connect.php");
require_once("return_functions.php");



$TotalBooks = GetStatistics($pdo, "Select count(ID)
from book");

$TotalUsers = GetStatistics($pdo, "Select count(ID)
from users");

$BooksBorrowed = GetStatistics($pdo, "select count(ID)
from rent_log 
where return_date is null");

$OverdueReturns = GetStatistics($pdo, "select count(ID)
from rent_log 
where return_date is null and DATEDIFF(rent_log.return_expiry_date, CURDATE()) < 0
");
