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
if($_FILES["file"]["error"] === 0) {

    // 抓到原始上傳檔案的副檔名
    $path_parts = pathinfo($_FILES["file"]["name"]);
    $ext = $path_parts["extension"];
    // 自訂檔名
    $file_name = rand() . "." . $ext;
    //echo ($file_name);
    
    // 將檔案從暫存中移出來，並且移到/course_detail
    if(move_uploaded_file($_FILES["file"]["tmp_name"], "../course_detail/" . $file_name)) {
      // var_dump($firm_id);
      // var_dump($category_id);
      // var_dump($area_id);
      // var_dump($course_name);
      // var_dump($price);
      // var_dump($caution);
      // var_dump($file_name);
      // var_dump($now);
      // exit;


      try {
        // 將data 存入 course_information
        $sql_course_info = "INSERT INTO courses.course_information (firm_id, category_id, area_id, course_name, price, caution, course_detail, created_time ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt_course_info = $courses_db_host -> prepare($sql_course_info);
        $stmt_course_info -> execute([$firm_id, $category_id, $area_id, $course_name, $price, $caution,$file_name , $now]);
        //var_dump($rows_course_info);
        echo("seccuessfully!");
      } catch (error $e) {
        echo ("insert failed");
        var_dump($e);
      }
      
    } else {
        $_SESSION["error_msg"] = "Upload failed";
        header("location: file-upload.php");
    }
} else {
    var_dump($_FILES["file"]);
    echo "<br />";
    var_dump($_FILES["file"]["error"]);
}
?>