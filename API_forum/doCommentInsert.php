<?php
require_once("../DB-Connect/PDO-Connect_forum.php");

if(!isset($_POST["comment_client_id"]) || !isset($_POST["article_id"]) || !isset($_POST["article_comment"])) {
  header("location: /Mid-term/forum/article_list.php");
  exit();
}

$client_id = $_POST["comment_client_id"];
$article_id = $_POST["article_id"];
$comment_text = $_POST["article_comment"];
date_default_timezone_set("Asia/Taipei"); // 設定時區
$now = date('Y-m-d H:i:s');

if(empty($client_id) || empty($comment_text)){
  $data = [
    "status" => 0,
    "message" => "請確實填寫留言者或是留言內容啦！"
  ];
} 

else {
  try {
    // 將data 存入 article_comment
    $sql_comment = "INSERT INTO forum.article_comment (client_id, article_id, comment_text, created_time, valid)           VALUES (?, ?, ?, ?, 1)";
    $stmt_comment = $forum_db_host -> prepare($sql_comment);
    $stmt_comment -> execute([$client_id, $article_id, $comment_text, $now]);

    //echo("seccuessfully!");
    $data = [
      "status" => 1,
      "message" => "新增留言成功囉！"
    ];
  } catch (PDOException $e) {
    //echo ("insert failed");
    //var_dump($e);
    $data = [
      "status" => 0,
      "message" => "Error" . $e ->getMessage()
    ];
  }
}

echo json_encode($data);

$forum_db_host = null;





