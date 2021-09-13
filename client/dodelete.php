<?php
require_once("dbconnect/pdo_connect_client.php");
if (!isset($_POST["id"])) {
    exit();
}
$id=$_POST["id"];

try {
    $sql = "UPDATE client_information set VALID = 0 WHERE `id` = $id";
    $stmt = $db_host->prepare($sql);
    $stmt->execute();
} catch (PDOException $e) {
    exit;
}

$db_host = NULL;