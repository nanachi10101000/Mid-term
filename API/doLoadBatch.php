<?php
require_once("../DB-Connect/PDO-Connect_courses.php");

if(!isset($_POST["course_id"])) {
    header("location: /Mid-term/courses/course_list.php");
    exit();
}

$course_id = $_POST["course_id"]; 

// 拿到當前課程的所有batch資料
$sql_batch = "SELECT courses.batch.* FROM courses.batch
              WHERE courses.batch.valid = 1
              AND courses.batch.course_id = ?
              ORDER BY courses.batch.batch_date";
$stmt_batch = $courses_db_host->prepare($sql_batch);
$stmt_batch->execute([$course_id]);
$rows_batch = $stmt_batch->fetchAll(PDO::FETCH_ASSOC);
// var_dump($rows_batch);
// exit();

if($stmt_batch -> rowCount() === 0) {
    $data = [
        "status" => 0,
        "message" => "目前還沒有任何梯次ㄜ！"
    ];
} else {
    $data = [
        "status" => 1,
        "data_batch" => $rows_batch
    ];
}
echo json_encode($data);

$courses_db_host = null;