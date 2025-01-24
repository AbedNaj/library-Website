<?php

function GetStatistics($pdo, $query)
{
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchColumn();
    return $result;
}
function GetReturns($pdo, $query)
{
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

function ClearReturn($pdo, $query)
{
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}
