<?php
  require_once("../DB-Connect/PDO-Connect_forum.php");
  require_once("../DB-Connect/PDO-Connect_client.php");


  if(!isset($_POST["input_value"]) || !isset($_POST["condition"])) {
    header("location: /Mid-term/forum/article_list.php");
    exit();
  }

  $condition = $_POST["condition"];
  $input_value = $_POST["input_value"];
  $input_value = "%" . $input_value . "%"; // 變成 LIKE %...%的形式



  // 依照不同的condition去不同的db找課程資料 
  // 1 => 標題， 2 => 作者名稱， 3 => 內文
  if ($condition == 1) {
    $sqlCode = "forum.article.article_title";
    doSql($sqlCode, $input_value, $forum_db_host, $client_db_host);
  } 

  // 依照作者名稱搜尋
  elseif ($condition == 2) {
    $sqlCode = "client.client_information.email";
    doSql($sqlCode, $input_value, $forum_db_host, $client_db_host);
  }

  // 依照內文搜尋
  elseif($condition == 3) {
    $sqlCode = "forum.article.article_text";
    doSql($sqlCode, $input_value, $forum_db_host, $client_db_host);
  }

  

  // sql語法整合在一起的code，使用時再帶入變數
  function doSql($sqlCode, $input_value, $forum_db_host, $client_db_host) {
    try {
      $sql_article = "SELECT forum.article.*, client.client_information.email  
                      FROM forum.article, client.client_information
                      WHERE forum.article.client_id = client.client_information.id
                      AND $sqlCode LIKE ?
                      AND forum.article.valid = 1
                      ORDER BY forum.article.id DESC";
      $stmt_article = $forum_db_host -> prepare($sql_article);
      $stmt_article -> execute([$input_value]);
      $rows_article = $stmt_article -> fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      $data = [
        "status" => 1,
        "data_article" => $e
      ];
      echo json_encode($data);
      $forum_db_host = null;
      $client_db_host = null;
    }

    if($stmt_article -> rowCount() === 0) {
      $data = [
          "status" => 0,
          "message" => "沒有找到符合條件的資料"
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
  };






  