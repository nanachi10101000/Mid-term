<?php
require_once("dbconnect/pdo_connect_client.php");
if (!isset($_POST["id"])) {
    exit();
}
$id=$_POST["id"];
$name = $_POST["name"];
$email=$_POST["email"];
$password = $_POST["password"];
$id_number = $_POST["id_number"];
$gender = $_POST["gender"];
$birth = $_POST["birth"];
$address = $_POST["address"];
$telephone = $_POST["telephone"];
$now = date('Y-m-d H:i:s');

try {
    $sql = "UPDATE client_information set email=?, password=?, client_name=?, gender=?, id_number=?, birth=?, address=?, telephone=?, created_time=? WHERE `id` = $id";
    $stmt = $db_host->prepare($sql);
    $stmt->execute([$email, $password, $name, $gender, $id_number, $birth, $address, $telephone, $now]);
} catch (PDOException $e) {
    exit;
}
$db_host = NULL;