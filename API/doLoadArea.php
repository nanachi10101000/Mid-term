<?php
require_once("../DB-Connect/PDO-Connect_courses.php");

// 拿到所有地區資料
$sql_area = "SELECT courses.area.* FROM courses.area
              WHERE courses.area.valid = 1";
$stmt_area = $courses_db_host->prepare($sql_area);
$stmt_area->execute();
$rows_area = $stmt_area->fetchAll(PDO::FETCH_ASSOC);
// var_dump($rows_area);
// exit();

if($stmt_area -> rowCount() === 0) {
    $data = [
        "status" => 0,
        "message" => "沒有找到資料"
    ];
} else {
    $data = [
        "status" => 1,
        "data_area" => $rows_area
    ];
}
echo json_encode($data);

$courses_db_host = null;