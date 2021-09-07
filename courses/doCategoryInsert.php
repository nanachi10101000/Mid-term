<?php
require_once("../DB-Connect/PDO-Connect_courses.php");

if(!isset($_POST["category_name"])) {
  header("location: category_list.php");
  exit();
}

$category_name = $_POST["category_name"];
$category_detail = $_POST["category_detail"];

if(empty($category_name) || empty($category_detail)){
  $_SESSION["error_msg"] = "請確實填寫類別名稱或類別詳細資料！";
  header("location: category_list.php");
  exit();
}


// 拿到所有category資料
$sql_category = "SELECT * FROM courses.category WHERE valid = 1";
$stmt_category= $courses_db_host->prepare($sql_category);
$stmt_category->execute();
$rows_category = $stmt_category->fetchAll(PDO::FETCH_ASSOC);
//var_dump($rows_category);

// 確認是否重複新增
if($stmt_category -> rowCount() > 0) {
  foreach($rows_category as $category) {
    foreach($category as $value) {
      if ($value == $category_name) {
        $_SESSION["error_msg"] = "此類別已經存在！";
        header("location: category_list.php");
        exit();
      }
    }
  };
}

try {
  // 將data 存入 category
  $sql_category = "INSERT INTO courses.category (category_name, category_detail) VALUES (?, ?)";
  $stmt_category = $courses_db_host -> prepare($sql_category);
  $stmt_category -> execute([$category_name, $category_detail]);

  //echo("seccuessfully!");
  $_SESSION["success_msg"] = "類別資料新增成功！";
  header("location: category_list.php");
} catch (error $e) {
  //echo ("insert failed");
  //var_dump($e);
  $_SESSION["error_msg"] = "類別資料新增失敗！";
  header("location: category_list.php");
}