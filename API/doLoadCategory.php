<?php
require_once("../DB-Connect/PDO-Connect_courses.php");


// 拿到所有地區資料
$sql_category = "SELECT courses.category.* FROM courses.category
              WHERE courses.category.valid = 1";
$stmt_category = $courses_db_host->prepare($sql_category);
$stmt_category->execute();
$rows_category = $stmt_category->fetchAll(PDO::FETCH_ASSOC);
// var_dump($rows_area);
// exit();

if($stmt_category -> rowCount() === 0) {
    $data = [
        "status" => 0,
        "message" => "沒有找到資料"
    ];
} else {
    $data = [
        "status" => 1,
        "data_category" => $rows_category
    ];
}
echo json_encode($data);

$courses_db_host = null;
