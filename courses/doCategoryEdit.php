<?php
require_once("../DB-Connect/PDO-Connect_courses.php");

if(!isset($_POST["category_id"])) {
  header("location: category_list.php");
  exit;
}

$category_id = $_POST["category_id"];
$category_name = $_POST["category_name"];
$category_detail = $_POST["category_detail"];

// var_dump($category_id, $category_name, $category_detail);
// exit();

if(empty($category_id) || empty($category_name) || empty($category_detail)) {
  $_SESSION["error_msg"] = "每個資料都需要確實填寫！";
  header("location: category_list.php");
  exit();
}

try {
  // 將data 存入 category
  $sql_category = "UPDATE courses.category SET category_name = ?, category_detail = ?
                      WHERE courses.category.id = ?";
  $stmt_category = $courses_db_host -> prepare($sql_category);
  $stmt_category -> execute([$category_name, $category_detail, $category_id]);
  //echo("seccuessfully! with no file");
  $_SESSION["success_msg"] = "地區資料更新成功囉！";
  header("location: category_list.php");
} catch (PDOException $e) {
  // echo ("update failed");
  $_SESSION["error_msg"] = "地區資料更新失敗！";
  header("location: category_list.php");
  var_dump($e);
}

