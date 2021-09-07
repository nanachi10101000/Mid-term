<?php
require_once ("../DB-Connect/PDO-Connect_courses.php");
// require_once("../DB-Connect/PDO-Connect_firm.php");

if(!isset($_POST["id"]) && !isset($_POST["course_id_arr"])) {
    header("location: /Mid-term/courses/course_list.php");
    exit();
}


if (isset($_POST["id"])) {
  $id = $_POST["id"];

  try {
    $sql_course = "UPDATE courses.course_information SET valid = ? WHERE id = ?";
    $stmt_course = $courses_db_host -> prepare($sql_course);
    $stmt_course -> execute([0, $id]);

    $data = [
        "status" => 1,
        "message" => "資料刪除成功！"
    ];

  } catch (PDOException $e) {
    $data = [
        "status" => 0,
        "message" => $e->getMessage()
    ];
  }
}

if (isset($_POST["course_id_arr"])) {
  $course_id_arr = $_POST["course_id_arr"];
  try {
    foreach($course_id_arr as $course_id) {
      $sql_course = "UPDATE courses.course_information SET valid = ? WHERE id = ?";
      $stmt_course = $courses_db_host -> prepare($sql_course);
      $stmt_course -> execute([0, $course_id]);
    }

    $data = [
        "status" => 1,
        "message" => "課程資料刪除成功！"
    ];

  } catch (PDOException $e) {
    $data = [
        "status" => 0,
        "message" => $e->getMessage()
    ];
  }
}


//$course_id_arr = $_POST["course_id_arr"];
echo json_encode($data);
$courses_db_host = null;
// $firm_db_host = null;