<?php
$servername = "localhost";
$username = "admin";
$password = "00000000";
$dbname = "image";

try{
    $db_host=new PDO(
        "mysql:host={$servername};dbname={$dbname};charset=utf8",
        $username, $password
    );
}catch (PDOException $e){
    exit;
}