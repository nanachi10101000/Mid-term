<?php
require_once("../DB-Connect/PDO-Connect_courses.php");

if(!isset($_POST["firm_id"])) {
  header("location: course_insert.php");
  exit();
}

$firm_id = $_POST["firm_id"];
$category_id = $_POST["category_id"];
$area_id = $_POST["area_id"];
$course_name = $_POST["course_name"];
$price = $_POST["price"];
$caution = $_POST["caution"];
date_default_timezone_set("Asia/Taipei"); // 設定時區
$now = date('Y-m-d H:i:s');

if(empty($firm_id) || empty($category_id) || empty($area_id) || empty($course_name) || empty($price) || empty($caution) ){
  $_SESSION["error_msg"] = "每個資料都需要確實填寫！";
  header("location: course_insert.php");
  exit();
}


if($_FILES["file"]["error"] === 0) {

    // 抓到原始上傳檔案的副檔名
    $path_parts = pathinfo($_FILES["file"]["name"]);
    $ext = $path_parts["extension"];
    // 自訂檔名
    $file_name = rand() . "." . $ext;
    //echo ($file_name);
    
    // 將檔案從暫存中移出來，並且移到/course_detail
    if(move_uploaded_file($_FILES["file"]["tmp_name"], "../course_detail_files/" . $file_name)) {

      try {
        // 將data 存入 course_information
        $sql_course_info = "INSERT INTO courses.course_information (firm_id, category_id, area_id, course_name, price, caution, course_detail, created_time ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt_course_info = $courses_db_host -> prepare($sql_course_info);
        $stmt_course_info -> execute([$firm_id, $category_id, $area_id, $course_name, $price, $caution,$file_name , $now]);
        //var_dump($rows_course_info);
        //echo("seccuessfully!");
        $_SESSION["success_msg"] = "資料新增成功！";
        header("location: course_list.php");
      } catch (error $e) {
        //echo ("insert failed");
        //var_dump($e);
        $_SESSION["error_msg"] = "資料新增失敗！";
        header("location: course_insert.php");
      }
      
    } else {
        $_SESSION["error_msg"] = "資料新增失敗！";
        header("location: course_insert.php");
    }
} else {
    //var_dump($_FILES["file"]);
    //echo "<br />";
    //var_dump($_FILES["file"]["error"]);
    $_SESSION["error_msg"] = "請確實上傳檔案再送出表單！";
    header("location: course_insert.php");
}
?>