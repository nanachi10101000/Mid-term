<?php
require_once("../DB-Connect/PDO-Connect_forum.php");
session_start();

if(!isset($_POST["comment_id"])) {
    header("location: /Mid-term/forum/article_list.php");
    exit();
}

//$article_id = $_POST["article_id"];
$comment_id = $_POST["comment_id"];



try {
  $sql_comment = "UPDATE forum.article_comment SET valid = ? WHERE id = ?";
  $stmt_comment = $forum_db_host -> prepare($sql_comment);
  $stmt_comment -> execute([0, $comment_id]);

  $data = [
      "status" => 1,
      "message" => "資料刪除成功！"
  ];

} catch (PDOException $e) {
  $data = [
      "status" => 0,
      "message" => $e->getMessage()
  ];
}


echo json_encode($data);
$forum_db_host = null;
// $firm_db_host = null;