<?php
require_once ("../DB-Connect/PDO-Connect_courses.php");
// require_once("../DB-Connect/PDO-Connect_firm.php");

if(!isset($_POST["course_id"])) {
    header("location: /Mid-term/courses/course_list.php");
    exit();
}

$course_id = $_POST["course_id"];
$batch_date = $_POST["batch_date"];
// echo ($id);
// exit();

try {
  $sql_batch = "DELETE FROM courses.batch 
                WHERE courses.batch.course_id = ? 
                AND courses.batch.batch_date = ?";
  $stmt_batch = $courses_db_host -> prepare($sql_batch);
  $stmt_batch -> execute([$course_id, $batch_date]);

  $data = [
      "status" => 1,
      "message" => "梯次刪除成功！"
  ];

} catch (PDOException $e) {
  $data = [
      "status" => 0,
      "message" => $e->getMessage()
  ];
}

echo json_encode($data);
$courses_db_host = null;
// $firm_db_host = null;