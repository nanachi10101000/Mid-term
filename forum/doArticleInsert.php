<?php
require_once("../DB-Connect/PDO-Connect_forum.php");
session_start();

if(!isset($_POST["client_id"])) {
  header("location: article_list.php");
  exit();
}
$client_id = $_POST["client_id"];
$article_title = $_POST["article_title"];
$article_text = $_POST["article_text"];
date_default_timezone_set("Asia/Taipei"); // 設定時區
$now = date('Y-m-d H:i:s');


if(empty($client_id) || empty($article_title) || empty($article_text)){
  $_SESSION["error_msg"] = "請確實填寫作者、標題或是文章內容！";
  header("location: article_list.php");
  exit();
}


try {
  // 將data 存入 forum.article
  $sql_article = "INSERT INTO forum.article (client_id, article_title, article_text, created_time, valid) 
                VALUES (?, ?, ?, ?, 1)";
  $stmt_article = $forum_db_host -> prepare($sql_article);
  $stmt_article -> execute([$client_id, $article_title, $article_text, $now]);

  // echo("seccuessfully!");
  $_SESSION["success_msg"] = "文章新增成功！";
  header("location: article_list.php");
} catch (PDOException $e) {
  //var_dump($e);
  $_SESSION["error_msg"] = "文章新增失敗！";
  header("location: article_list.php");
}
