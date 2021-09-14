<?php
  require_once("../DB-Connect/PDO-Connect_courses.php");

  if(!isset($_POST["course_id"])) {
    header("location: /Mid-term/order/orderlist.php");
    exit();
  }

  $course_id = $_POST["course_id"];
  //$id = 5;

  // 拿到所有課程資料
  $sql_batch = "SELECT * FROM courses.batch 
                WHERE courses.batch.course_id = ? AND courses.batch.valid = 1";
  $stmt_batch = $courses_db_host -> prepare($sql_batch);
  $stmt_batch -> execute([$course_id]);
  $rows_batch  = $stmt_batch -> fetchAll(PDO::FETCH_ASSOC);
  //var_dump($rows_batch);
  // echo json_encode($rows_batch);

  if($stmt_batch-> rowCount() === 0) {
      $data = [
          "status" => 0,
          "message" => "沒有找到資料"
      ];
  } else {
      $data = [
          "status" => 1,
          "data_batch" => $rows_batch
      ];
  }
  echo json_encode($data);
  $courses_db_host = null;