<?php
require_once("../DB-Connect/PDO-Connect_courses.php");


if(isset($_POST["condition"])) {
    $condition = $_POST["condition"];
    $asc_desc = $_POST["asc_desc"];

    if ($asc_desc == 1) {
        if($condition == "category") {
            $sqlCode = "courses.category.category_name ASC";
            asc_desc($sqlCode, $courses_db_host);
        }

    } 
    
    else {
        if($condition == "category") {
            $sqlCode = "courses.category.category_name DESC";
            asc_desc($sqlCode, $courses_db_host);
        }
    }



} else {
    // 沒有任何條件時：
    $sqlCode = "courses.category.id DESC";
    asc_desc($sqlCode, $courses_db_host);
}




function asc_desc($sqlCode, $courses_db_host) {
    $sql_category = "SELECT courses.category.* FROM courses.category
                WHERE courses.category.valid = 1
                ORDER BY $sqlCode";
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
}