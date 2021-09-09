<?php
require_once("../DB-Connect/PDO-Connect_forum.php");
require_once("../DB-Connect/PDO-Connect_client.php");

if(!isset($_POST["article_id"])) {
    header("location: /Mid-term/forum/article_list.php");
    exit();
}

$article_id = $_POST["article_id"]; 

// 拿到當前課程的所有article資料
$sql_comment = "SELECT forum.article_comment.* , client.client_information.email
              FROM forum.article_comment, client.client_information
              WHERE forum.article_comment.client_id = client.client_information.id
              AND forum.article_comment.valid = 1
              AND forum.article_comment.article_id = ?
              ORDER BY forum.article_comment.article_id";
$stmt_comment = $forum_db_host->prepare($sql_comment);
$stmt_comment->execute([$article_id]);
$rows_comment = $stmt_comment->fetchAll(PDO::FETCH_ASSOC);
// var_dump($rows_comment);
// exit();

if($stmt_comment -> rowCount() === 0) {
    $data = [
        "status" => 0,
        "message" => "目前還沒有任何留言ㄜ！"
    ];
} else {
    $data = [
        "status" => 1,
        "data_comment" => $rows_comment
    ];
}
echo json_encode($data);

$forum_db_host = null;