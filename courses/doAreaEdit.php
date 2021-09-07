<?php
require_once("../DB-Connect/PDO-Connect_courses.php");

if(!isset($_POST["area_id"])) {
  header("location: area_list.php");
  exit;
}

$area_id = $_POST["area_id"];
$area_name = $_POST["area_name"];
$area_detail = $_POST["area_detail"];

// var_dump($area_id, $area_name, $area_detail);
// exit();

if(empty($area_id) || empty($area_name) || empty($area_detail)) {
  $_SESSION["error_msg"] = "每個資料都需要確實填寫！";
  header("location: area_list.php");
  exit();
}

try {
  // 將data 存入 area
  $sql_area = "UPDATE courses.area SET area_name = ?, area_detail = ?
                      WHERE courses.area.id = ?";
  $stmt_area = $courses_db_host -> prepare($sql_area);
  $stmt_area -> execute([$area_name, $area_detail, $area_id]);
  //echo("seccuessfully! with no file");
  $_SESSION["success_msg"] = "地區資料更新成功囉！";
  header("location: area_list.php");
} catch (error $e) {
  // echo ("update failed");
  $_SESSION["error_msg"] = "地區資料更新失敗！";
  header("location: area_list.php");
  var_dump($e);
}

