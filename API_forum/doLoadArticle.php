<?php
require_once("../DB-Connect/PDO-Connect_forum.php");
require_once("../DB-Connect/PDO-Connect_client.php");



if(isset($_POST["condition"])) {
    $condition = $_POST["condition"];
    $asc_desc = $_POST["asc_desc"];

    if ($asc_desc == 1) {
        if($condition == "article") {
            $sqlCode = "forum.article.article_title ASC";
            asc_desc($sqlCode, $forum_db_host, $client_db_host);
        }

        elseif($condition == "email") {
            $sqlCode = "client.client_information.email ASC";
            asc_desc($sqlCode, $forum_db_host, $client_db_host);
        }

        elseif($condition == "created_time") {
            $sqlCode = "forum.article.created_time ASC";
            asc_desc($sqlCode, $forum_db_host, $client_db_host);
        }

    } else {
        if($condition == "article") {
            $sqlCode = "forum.article.article_title DESC";
            asc_desc($sqlCode, $forum_db_host, $client_db_host);
        }

        elseif($condition == "email") {
            $sqlCode = "client.client_information.email DESC";
            asc_desc($sqlCode, $forum_db_host, $client_db_host);
        }

        elseif($condition == "created_time") {
            $sqlCode = "forum.article.created_time DESC";
            asc_desc($sqlCode, $forum_db_host, $client_db_host);
        }
    }


} 

else {
    // 沒有任何條件時：
    $sqlCode = "forum.article.id DESC";
    asc_desc($sqlCode, $forum_db_host, $client_db_host);
} 




function asc_desc($sqlCode, $forum_db_host, $client_db_host) {
    $sql_article = "SELECT forum.article.*, client.client_information.email  
                FROM forum.article, client.client_information
                WHERE forum.article.client_id = client.client_information.id
                AND forum.article.valid = 1
                ORDER BY $sqlCode";
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
    $client_db_host = null;
}
