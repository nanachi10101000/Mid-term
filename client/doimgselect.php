<?php
require_once("dbconnect/pdo_connect_image.php");
try {
    $sql = "SELECT image FROM client";
    $stmt = $db_host->prepare($sql);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo '<img src="data:images/jpeg;base64,'.base64_encode($rows[0]['image']).'"/>'; 
} catch (PDOException $e) {
    exit();
}
$db_host = NULL;

    // $sql = "SELECT image FROM client";
    // $stmt = $db_host->prepare($sql);
    // $stmt->execute();
    // $stmt->bindColumn(1, $img, PDO::PARAM_LOB);
    // $stmt->fetch(PDO::FETCH_BOUND);
    // echo $img;
    // $fp = fopen('a.jpg', 'wb');
    // fwrite($fp, $img);