<?php
require_once("../DB-Connect/PDO-Connect_courses.php");
require_once("../DB-Connect/PDO-Connect_image.php");

if(!isset($_POST["course_name"])) {
  header("location: course_list.php");
  exit;
}

$course_id = $_POST["course_id"];
$category_id = $_POST["category_id"];
$area_id = $_POST["area_id"];
$course_name = $_POST["course_name"];
$price = $_POST["price"];
$caution = $_POST["caution"];
$prevFile = $_POST["prevFile"];
$prevImageFile = $_POST["prevImageFile"]; 
//var_dump($course_id, $category_id, $area_id, $course_name, $price, $caution, $prevFile);

if(empty($course_id) || empty($category_id) || empty($area_id) || empty($course_name) || empty($price) || empty($caution) ){
  $_SESSION["error_msg"] = "每個資料都需要確實填寫！";
  header("location: course_list.php");
  exit();
}



// 判斷此次更新有無上傳檔案，有的話將原檔案刪除，並新增一個
// 沒有的話就只更新其他data, course_detail這欄不更新

// 如果圖片跟檔案都有更新的話
if($_FILES["image_file"]["error"] === 0 && $_FILES["file"]["error"] === 0) {
  // 刪除原本的course_detail_file, 以及image
  unlink("../course_detail_files/" . $prevFile);
  unlink("../image_files/" . $prevImageFile);

  // 抓到原始上傳檔案的副檔名
  $path_parts = pathinfo($_FILES["file"]["name"]);
  $ext = $path_parts["extension"];
  // 自訂檔名
  $file_name = rand() . "." . $ext;

  // 抓到原始上傳檔案的副檔名 (圖片)
  $image_path_parts = pathinfo($_FILES["image_file"]["name"]);
  $image_ext = $image_path_parts["extension"];
  // 自訂檔名
  $image_file_name = rand() . "." . $image_ext;

  
  // 將檔案從暫存中移出來，並且移到/course_detail
  if(move_uploaded_file($_FILES["file"]["tmp_name"], "../course_detail_files/" . $file_name) &&
    move_uploaded_file($_FILES["image_file"]["tmp_name"], "../image_files/" . $image_file_name)) {

    try {
      // 將data 存入 course_information
      //UPDATE course.users SET name = ?, password =? WHERE id = ?
      $sql_course_info = "UPDATE courses.course_information 
                          SET category_id = ?, area_id = ?, course_name = ?, price = ?, caution = ?, course_detail = ?
                          WHERE courses.course_information.id = ?";
      $stmt_course_info = $courses_db_host -> prepare($sql_course_info);
      $stmt_course_info -> execute([$category_id, $area_id, $course_name, $price, $caution, $file_name, $course_id]);
      //var_dump($rows_course_info);

      // 將data 存入 image.course
      $sql_course_image = "UPDATE image.course SET image_name = ? WHERE course_id = ?";
      $stmt_course_image = $image_db_host -> prepare($sql_course_image);
      $stmt_course_image -> execute([$image_file_name, $course_id]);



      //echo("seccuessfully! with file");
      $_SESSION["success_msg"] = "資料更新成功(含圖片及行程介紹檔)！";
      header("location: course_list.php");
    } catch (error $e) {
      // echo ("insert failed");
      // var_dump($e);
      $_SESSION["error_msg"] = "資料更新失敗(1-0)！";
      header("location: course_list.php");
    }
  } else {
    $_SESSION["error_msg"] = "資料更新失敗(2-0)！";
    header("location: course_list.php");
  }


}


// 如果只有檔案有更新的話
else if($_FILES["file"]["error"] === 0) {
  // 刪除原本的course_detail_file
  unlink("../course_detail_files/" . $prevFile);

  // 抓到原始上傳檔案的副檔名
  $path_parts = pathinfo($_FILES["file"]["name"]);
  $ext = $path_parts["extension"];
  // 自訂檔名
  $file_name = rand() . "." . $ext;
  
  // 將檔案從暫存中移出來，並且移到/course_detail
  if(move_uploaded_file($_FILES["file"]["tmp_name"], "../course_detail_files/" . $file_name)) {

    try {
      // 將data 存入 course_information
      //UPDATE course.users SET name = ?, password =? WHERE id = ?
      $sql_course_info = "UPDATE courses.course_information 
                          SET category_id = ?, area_id = ?, course_name = ?, price = ?, caution = ?, course_detail = ?
                          WHERE courses.course_information.id = ?";
      $stmt_course_info = $courses_db_host -> prepare($sql_course_info);
      $stmt_course_info -> execute([$category_id, $area_id, $course_name, $price, $caution, $file_name, $course_id]);
      //var_dump($rows_course_info);
      //echo("seccuessfully! with file");
      $_SESSION["success_msg"] = "資料更新成功(含行程介紹檔)!";
      header("location: course_list.php");
    } catch (error $e) {
      // echo ("insert failed");
      // var_dump($e);
      $_SESSION["error_msg"] = "資料更新失敗(1-1)！";
      header("location: course_list.php");
    }
  } else {
    $_SESSION["error_msg"] = "資料更新失敗(2-1)！";
    header("location: course_list.php");
  }

} 

// 如果只有圖片有更新的話
else if($_FILES["image_file"]["error"] === 0) {
  // 刪除原本的image
  unlink("../image_files/" . $prevImageFile);

  // 抓到原始上傳檔案的副檔名 (圖片)
  $image_path_parts = pathinfo($_FILES["image_file"]["name"]);
  $image_ext = $image_path_parts["extension"];
  // 自訂檔名
  $image_file_name = rand() . "." . $image_ext;

  
  // 將檔案從暫存中移出來，並且移到/course_detail
  if(move_uploaded_file($_FILES["image_file"]["tmp_name"], "../image_files/" . $image_file_name)) {

    try {
      // 將data 存入 image.course
      $sql_course_image = "UPDATE image.course SET image_name = ? WHERE course_id = ?";
      $stmt_course_image = $image_db_host -> prepare($sql_course_image);
      $stmt_course_image -> execute([$image_file_name, $course_id]);

      //echo("seccuessfully! with file");
      $_SESSION["success_msg"] = "資料更新成功(含圖片)！";
      header("location: course_list.php");
    } catch (error $e) {
      // echo ("insert failed");
      // var_dump($e);
      $_SESSION["error_msg"] = "資料更新失敗(1-3)！" . $e;
      header("location: course_list.php");
    }
  } else {
    $_SESSION["error_msg"] = "資料更新失敗(2-3)！";
    header("location: course_list.php");
  }
}


else {
  try {
    // 將data 存入 course_information
    //UPDATE course.users SET name = ?, password =? WHERE id = ?
    $sql_course_info = "UPDATE courses.course_information 
                        SET category_id = ?, area_id = ?, course_name = ?, price = ?, caution = ?
                        WHERE courses.course_information.id = ?";
    $stmt_course_info = $courses_db_host -> prepare($sql_course_info);
    $stmt_course_info -> execute([$category_id, $area_id, $course_name, $price, $caution, $course_id]);
    //var_dump($rows_course_info);
    //echo("seccuessfully! with no file");
    $_SESSION["success_msg"] = "課程資料更新成功囉(不含圖片及行程介紹檔)！";
    header("location: course_list.php");
  } catch (error $e) {
    // echo ("update failed");
    $_SESSION["error_msg"] = "課程資料更新失敗！";
    header("location: course_list.php");
    var_dump($e);
  }
};