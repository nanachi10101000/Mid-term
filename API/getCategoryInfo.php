<?php
require_once("../DB-Connect/PDO-Connect_courses.php");

if(!isset($_POST["id"])) {
  header("location: /Mid-term/courses/category_list.php");
  exit();
}

$category_id = $_POST["id"];

// 拿到所有category資料
$sql_category = "SELECT * FROM courses.category WHERE valid = 1 AND id = ?";
$stmt_category = $courses_db_host->prepare($sql_category);
$stmt_category->execute([$category_id]);
$rows_category = $stmt_category->fetchAll(PDO::FETCH_ASSOC);
// var_dump($rows_category);
// exit;


if($stmt_category -> rowCount() === 0) {
      $data = [
          "status" => 0,
          "message" => "沒有找到資料"
      ];
  } else {
      $data = [
          "status" => 1,
          "data_category" => $rows_category[0]
      ];
  }

echo json_encode($data);
$courses_db_host = null;
$firm_db_host = null;
