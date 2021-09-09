<?php
require_once("../DB-Connect/PDO-Connect_forum.php");

if(!isset($_POST["id"])) {
  header("location: /Mid-term/forum/article_list.php");
  exit();
}

$article_id = $_POST["id"];

// 拿到article資料
$sql_article = "SELECT forum.article.*, client.client_information.email  
                FROM forum.article, client.client_information
                WHERE forum.article.client_id = client.client_information.id
                AND forum.article.id = ?
                AND forum.article.valid = 1";
$stmt_article = $forum_db_host->prepare($sql_article);
$stmt_article->execute([$article_id]);
$rows_article = $stmt_article->fetchAll(PDO::FETCH_ASSOC);
// var_dump($rows_article);
// exit;


if($stmt_article -> rowCount() === 0) {
      $data = [
          "status" => 0,
          "message" => "沒有找到資料"
      ];
  } else {
      $data = [
          "status" => 1,
          "data_article" => $rows_article[0]
      ];
  }

echo json_encode($data);
$forum_db_host = null;

