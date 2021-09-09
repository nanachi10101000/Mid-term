<?php
require_once("../DB-Connect/PDO-Connect_forum.php");
session_start();

if(!isset($_POST["id"]) && !isset($_POST["article_id_arr"])) {
    header("location: /Mid-term/forum/article_list.php");
    exit();
}

if (isset($_POST["id"])) {
  $id = $_POST["id"];
  // echo ($id);
  // exit();

  try {
    $sql_article = "UPDATE forum.article SET valid = ? WHERE id = ?";
    $stmt_article = $forum_db_host -> prepare($sql_article);
    $stmt_article -> execute([0, $id]);

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
}

if (isset($_POST["article_id_arr"])) {
  $article_id_arr = $_POST["article_id_arr"];

  try {
    foreach($article_id_arr as $article_id) {
      $sql_article = "UPDATE forum.article SET valid = ? WHERE id = ?";
      $stmt_article = $forum_db_host -> prepare($sql_article);
      $stmt_article -> execute([0, $article_id]);
    }
    $data = [
        "status" => 1,
        "message" => "地區資料刪除成功！"
    ];

  } catch (PDOException $e) {
    $data = [
        "status" => 0,
        "message" => $e->getMessage()
    ];
  }
}


echo json_encode($data);
$courses_db_host = null;
// $firm_db_host = null;