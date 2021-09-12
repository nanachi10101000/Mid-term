<?php
require_once("../DB-Connect/PDO-Connect_courses.php");

if(isset($_POST["condition"])) {
    $condition = $_POST["condition"];
    $asc_desc = $_POST["asc_desc"];

    if ($asc_desc == 1) {
        if($condition == "area") {
            $sqlCode = "courses.area.area_name ASC";
            asc_desc($sqlCode, $courses_db_host);
        }

    } 
    
    else {
        if($condition == "area") {
            $sqlCode = "courses.area.area_name DESC";
            asc_desc($sqlCode, $courses_db_host);
        }
    }



} else {
    // 沒有任何條件時：
    $sqlCode = "courses.area.id DESC";
    asc_desc($sqlCode, $courses_db_host);
}


function asc_desc($sqlCode, $courses_db_host) {
    $sql_area = "SELECT courses.area.* FROM courses.area
                WHERE courses.area.valid = 1
                ORDER BY $sqlCode";
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
}