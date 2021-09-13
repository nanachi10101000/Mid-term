<?php
require_once ("dbconnect/pdo_connect_client.php");
$sql = "SELECT * FROM client_information WHERE valid=1 ORDER BY id";
$stmt = $db_host->prepare($sql);
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($rows);