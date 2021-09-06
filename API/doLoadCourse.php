<?php
require_once("../DB-Connect/PDO-Connect_firm.php");
require_once("../DB-Connect/PDO-Connect_courses.php");


$sql_course = "SELECT courses.course_information.*, firm.firm_information.firm_name
              FROM courses.course_information JOIN firm.firm_information
              ON courses.course_information.firm_id = firm.firm_information.id
              WHERE courses.course_information.valid = 1";
$stmt_course = $firm_db_host->prepare($sql_course);
$stmt_course->execute();
$rows_course = $stmt_course->fetchAll(PDO::FETCH_ASSOC);


if($stmt_course -> rowCount() === 0) {
    $data = [
        "status" => 0,
        "message" => "沒有找到資料"
    ];
} else {
    $data = [
        "status" => 1,
        "data_course" => $rows_course,
    ];
}
echo json_encode($data);

$courses_db_host = null;
$firm_db_host = null;