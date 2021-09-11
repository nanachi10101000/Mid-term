<?php
require_once("../DB-Connect/PDO-Connect_courses.php");
require_once("../DB-Connect/PDO-Connect_image.php");

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


if($_FILES["file"]["error"] === 0 && $_FILES["image_file"]["error"] === 0) {

    // 抓到原始上傳檔案的副檔名
    $path_parts = pathinfo($_FILES["file"]["name"]);
    $ext = $path_parts["extension"];
    // 自訂檔名
    $file_name = rand() . "." . $ext;
    //echo ($file_name);

    // 抓到原始上傳檔案的副檔名 (圖片)
    $image_path_parts = pathinfo($_FILES["image_file"]["name"]);
    $image_ext = $image_path_parts["extension"];
    // 自訂檔名
    $image_file_name = rand() . "." . $image_ext;


    
    // 將檔案從暫存中移出來，並且移到/course_detail, 以及圖片的/image_files
    if(move_uploaded_file($_FILES["file"]["tmp_name"], "../course_detail_files/" . $file_name) && 
      move_uploaded_file($_FILES["image_file"]["tmp_name"], "../image_files/" . $image_file_name)) {

      try {
        // 將data 存入 course_information
        $sql_course_info = "INSERT INTO courses.course_information (firm_id, category_id, area_id, course_name, price, caution, course_detail, created_time ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt_course_info = $courses_db_host -> prepare($sql_course_info);
        $stmt_course_info -> execute([$firm_id, $category_id, $area_id, $course_name, $price, $caution,$file_name , $now]);
        $lastId = $courses_db_host -> lastInsertId();

        // 將data 存入 image.course
        $sql_course_image = "INSERT INTO image.course (course_id, image_name ) VALUES (?, ?)";
        $stmt_course_image = $image_db_host -> prepare($sql_course_image);
        $stmt_course_image -> execute([$lastId, $image_file_name]);

        //var_dump($rows_course_info);
        //echo("seccuessfully!");
        $_SESSION["success_msg"] = "課程資料新增成功！";
        header("location: course_list.php");
      } catch (PDOException $e) {
        //echo ("insert failed");
        //var_dump($e);
        $_SESSION["error_msg"] = "資料新增失敗(1)！";
        header("location: course_insert.php");
      }
      
    } else {
        $_SESSION["error_msg"] = "資料新增失敗(2)！";
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