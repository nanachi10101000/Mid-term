<?php
  require_once("../DB-Connect/PDO-Connect_firm.php");
  require_once("../DB-Connect/PDO-Connect_courses.php");

  if(!isset($_POST["id"])) {
    header("location: course_list.php");
    exit();
  }

  $id = $_POST["id"];
  //$id = 5;
  // 拿到此id的課程資料
  $sql_course = "SELECT courses.course_information.*, firm.firm_information.firm_name 
                FROM courses.course_information, firm.firm_information
                WHERE courses.course_information.firm_id = firm.firm_information.id
                AND courses.course_information.id = ? 
                AND courses.course_information.valid = 1";
  $stmt_course = $courses_db_host -> prepare($sql_course);
  $stmt_course -> execute([$id]);
  $rows_course = $stmt_course -> fetchAll(PDO::FETCH_ASSOC);

  // echo json_encode($rows_course[0]);
  // exit();


if($stmt_course -> rowCount() === 0) {
    $data = [
        "status" => 0,
        "message" => "沒有找到資料"
    ];
} else {
    $data = [
        "status" => 1,
        "data_course" => $rows_course[0],
    ];
}
echo json_encode($data);

$courses_db_host = null;
$firm_db_host = null;
