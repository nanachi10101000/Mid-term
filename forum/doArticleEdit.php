<?php
require_once("../DB-Connect/PDO-Connect_forum.php");
session_start();

if(!isset($_POST["article_id"])) {
  header("location: /Mid-term/forum/article_list.php");
  exit();
}

$article_id = $_POST["article_id"];
$article_title = $_POST["article_title"];
$article_text = $_POST["article_text"];

// var_dump($area_id, $area_name, $area_detail);
// exit();

if(empty($article_id) || empty($article_title) || empty($article_text)) {
  $_SESSION["error_msg"] = "每個資料都需要確實填寫！";
  header("location: article_list.php");
  exit();
}

try {
  // 將data 存入 article
  $sql_article = "UPDATE forum.article SET article_title = ?, article_text = ?
                  WHERE forum.article.id = ?";
  $stmt_article = $forum_db_host -> prepare($sql_article);
  $stmt_article -> execute([$article_title, $article_text, $article_id]);
  //echo("seccuessfully! with no file");
  $_SESSION["success_msg"] = "文章資料更新成功囉！";
  header("location: article_list.php");
} catch (PDOException $e) {
  // echo ("update failed");
  $_SESSION["error_msg"] = "文章資料更新失敗！";
  header("location: article_list.php");
  var_dump($e);
}

