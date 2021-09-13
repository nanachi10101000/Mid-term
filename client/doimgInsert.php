<?php
require_once("dbconnect/pdo_connect_image.php");
$image= $_POST['photo'];
$email=$_POST["email"];
echo $email;
try {
    $sql = "INSERT INTO client(email,image) VALUES (?,".$image.")";
    $stmt = $db_host->prepare($sql);
    $stmt->execute([$email]);
} catch (PDOException $e) {
    exit();
}
$db_host = NULL;