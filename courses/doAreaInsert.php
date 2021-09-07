<?php
require_once("../DB-Connect/PDO-Connect_courses.php");

if(!isset($_POST["area_name"])) {
  header("location: area_list.php");
  exit();
}

$area_name = $_POST["area_name"];
$area_detail = $_POST["area_detail"];

if(empty($area_name) || empty($area_detail)){
  $_SESSION["error_msg"] = "請確實填寫地區名稱或地區詳細資訊！";
  header("location: area_list.php");
  exit();
}


// 拿到所有area資料
$sql_area = "SELECT * FROM courses.area WHERE valid = 1";
$stmt_area = $courses_db_host->prepare($sql_area);
$stmt_area->execute();
$rows_area = $stmt_area->fetchAll(PDO::FETCH_ASSOC);
//var_dump($rows_area);

if($stmt_area -> rowCount() > 0) {
  foreach($rows_area as $area) {
    foreach($area as $value) {
      if ($value == $area_name) {
        $_SESSION["error_msg"] = "此地區已經存在！";
        header("location: area_list.php");
        exit();
      }
    }
  };
}

try {
  // 將data 存入 area
  $sql_area = "INSERT INTO courses.area (area_name, area_detail) VALUES (?, ?)";
  $stmt_area = $courses_db_host -> prepare($sql_area);
  $stmt_area -> execute([$area_name, $area_detail]);

  //echo("seccuessfully!");
  $_SESSION["success_msg"] = "地區資料新增成功！";
  header("location: area_list.php");
} catch (error $e) {
  //echo ("insert failed");
  //var_dump($e);
  $_SESSION["error_msg"] = "地區資料新增失敗！";
  header("location: area_list.php");
}
