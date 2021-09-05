<?php
require_once ("../DB-Connect/PDO-Connect_courses.php");
require_once("../DB-Connect/PDO-Connect_firm.php");

$id = $_POST["id"];

// 拿到所有課程資料
  $sql_course = "SELECT courses.course_information.*, firm.firm_information.firm_name,
              courses.category.category_name, courses.area.area_name
              FROM courses.course_information, firm.firm_information, courses.category, courses.area
              WHERE courses.course_information.firm_id = firm.firm_information.id
              AND courses.course_information.category_id = courses.category.id
              AND courses.course_information.area_id = courses.area.id
              AND course_information.id = ?";
  $stmt_course = $firm_db_host -> prepare($sql_course);
  $stmt_course -> execute([$id]);
  $rows_course = $stmt_course -> fetchAll(PDO::FETCH_ASSOC);
  //var_dump($rows_course);
  // echo json_encode($rows_course);


if($stmt_course -> rowCount() === 0) {
    $data = [
        "status" => 0,
        "message" => "沒有找到資料"
    ];
} else {
    $data = [
        "status" => 1,
        "data" => $rows_course[0]
    ];
}
echo json_encode($data);

$courses_db_host = null;
$firm_db_host = null;
