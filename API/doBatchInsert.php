<?php
require_once("../DB-Connect/PDO-Connect_courses.php");

if(!isset($_POST["batch_date"])) {
  header("location: course_list.php");
  exit();
}

$course_id = $_POST["id"];
$batch_date = $_POST["batch_date"];
// $course_id = 10;
// $batch_date = "2021-09-01";
date_default_timezone_set("Asia/Taipei"); // 設定時區
$now = date('Y-m-d H:i:s');

if(empty($batch_date)){
  $data = [
    "status" => 0,
    "message" => "請確實填寫日期啦幹！"
  ];
} else {

  try {
    // 將data 存入 batch
    $sql_batch = "INSERT INTO courses.batch (course_id, batch_date, created_time) VALUES (?, ?, ?)";
    $stmt_batch = $courses_db_host -> prepare($sql_batch);
    $stmt_batch -> execute([$course_id, $batch_date, $now]);

    //echo("seccuessfully!");
    $data = [
      "status" => 1,
      "message" => "新增梯次成功囉！"
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

$courses_db_host = null;



// 拿到所有batch資料
// $sql_batch = "SELECT * FROM courses.batch WHERE valid = 1";
// $stmt_batch = $courses_db_host->prepare($sql_batch);
// $stmt_batch->execute();
// $rows_batch = $stmt_batch->fetchAll(PDO::FETCH_ASSOC);
// var_dump($rows_batch);

// 確認是否重複新增
// if($stmt_batch -> rowCount() > 0) { 
//   foreach($rows_batch as $batch) {
//     foreach($batch as $value) {
//       if ($value == $batch_name) {
//         $_SESSION["error_msg"] = "此地區已經存在！";
//         header("location: batch_list.php");
//         exit();
//       }
//     }
//   };
// }

// if() {
//     $data = [
//         "status" => 0,
//         "message" => "此梯次已存在"
//     ];
// } else {
//     $data = [
//         "status" => 1,
//         "data_batch" => $rows_batch
//     ];
// }


