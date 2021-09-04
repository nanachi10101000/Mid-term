<?php
//開啟session
session_start();

// PDO connect 是連接MySQL時更安全且業界在用的方法
$servername = "localhost";
$username = "admin";
$password = "00000000";
$dbname = "image";

try {
    $db_host = new PDO(
      "mysql:host = {$servername}; dbname = {$dbname}; charset = utf8",
      $username, $password
    );
//    echo "DB connected Successfully";
} catch (PDOException $e) {
    echo "BD connected fail <br />";
    echo "Error: " . $e -> getMessage();
};