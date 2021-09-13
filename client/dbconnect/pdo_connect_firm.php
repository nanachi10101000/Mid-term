<?php
$servername = "localhost";
$username = "admin";
$password = "00000000";
$dbname = "firm";

try{
    $db_host=new PDO(
        "mysql:host={$servername};dbname={$dbname};charset=utf8",
        $username, $password
    );
    echo "資料庫連線成功<br>";
}catch (PDOException $e){
    echo "資料庫連線失敗<br>";
    echo "Error: ".$e->getMessage();
    exit;
}