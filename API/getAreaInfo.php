<?php
require_once("../DB-Connect/PDO-Connect_courses.php");

if(!isset($_POST["id"])) {
  header("location: /Mid-term/courses/area_list.php");
  exit();
}

$area_id = $_POST["id"];

// 拿到所有area資料
$sql_area = "SELECT * FROM courses.area WHERE valid = 1 AND id = ?";
$stmt_area = $courses_db_host->prepare($sql_area);
$stmt_area->execute([$area_id]);
$rows_area = $stmt_area->fetchAll(PDO::FETCH_ASSOC);
// var_dump($rows_area);
// exit;


if($stmt_area -> rowCount() === 0) {
      $data = [
          "status" => 0,
          "message" => "沒有找到資料"
      ];
  } else {
      $data = [
          "status" => 1,
          "data_area" => $rows_area[0]
      ];
  }

echo json_encode($data);
$courses_db_host = null;
$firm_db_host = null;
