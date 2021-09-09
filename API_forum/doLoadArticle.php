<?php
require_once("../DB-Connect/PDO-Connect_forum.php");
require_once("../DB-Connect/PDO-Connect_client.php");

// 拿到所有article資料
$sql_article = "SELECT forum.article.*, client.client_information.email  
                FROM forum.article, client.client_information
                WHERE forum.article.client_id = client.client_information.id
                AND forum.article.valid = 1
                ORDER BY forum.article.id DESC";
$stmt_article = $forum_db_host->prepare($sql_article);
$stmt_article->execute();
$rows_article = $stmt_article->fetchAll(PDO::FETCH_ASSOC);
// var_dump($rows_article);
// exit();

if($stmt_article -> rowCount() === 0) {
    $data = [
        "status" => 0,
        "message" => "沒有找到資料"
    ];
} else {
    $data = [
        "status" => 1,
        "data_article" => $rows_article
    ];
}
echo json_encode($data);

$forum_db_host = null;