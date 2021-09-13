<?php
require_once("dbconnect/pdo_connect_client.php");
if (!isset($_POST["name"])) {
    exit();
}
$name = $_POST["name"];
$email=$_POST["email"];
$password = $_POST["password"];
$id_number = $_POST["id_number"];
$gender = $_POST["gender"];
$birth = $_POST["birth"];
$address = $_POST["address"];
$telephone = $_POST["telephone"];
$now = date('Y-m-d H:i:s');
$valid = 1;


try {
    $sql = "INSERT INTO client_information(email, password, client_name, gender, id_number, birth, address, telephone, created_time, valid)
	VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 1)";
    $stmt = $db_host->prepare($sql);
    $stmt->execute([$email, $password, $name, $gender, $id_number, $birth, $address, $telephone, $now]);
} catch (PDOException $e) {
    exit;
}
$db_host = NULL;
 header("location: CMS-template-A.php");