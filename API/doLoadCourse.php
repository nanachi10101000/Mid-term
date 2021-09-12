<?php
require_once("../DB-Connect/PDO-Connect_firm.php");
require_once("../DB-Connect/PDO-Connect_courses.php");

// 如果有傳入條件
if(isset($_POST["condition"])) {
    $condition = $_POST["condition"];
    $asc_desc = $_POST["asc_desc"];

    if ($asc_desc == 1) {
        if($condition == "course") {
            $sqlCode = "courses.course_information.course_name ASC";
            asc_desc($sqlCode, $firm_db_host, $courses_db_host);
        } 
        
        elseif($condition == "firm") {
            $sqlCode = "firm.firm_information.firm_name ASC";
            asc_desc($sqlCode, $firm_db_host, $courses_db_host);
        }

        elseif($condition == "area") {
            $sqlCode = "courses.area.area_name ASC";
            asc_desc($sqlCode, $firm_db_host, $courses_db_host);
        }

        elseif($condition == "created_time") {
            $sqlCode = "courses.course_information.created_time ASC";
            asc_desc($sqlCode, $firm_db_host, $courses_db_host);
        }

    } else {
        if($condition == "course") {
            $sqlCode = "courses.course_information.course_name DESC";
            asc_desc($sqlCode, $firm_db_host, $courses_db_host);
        } 
        
        elseif($condition == "firm") {
            $sqlCode = "firm.firm_information.firm_name DESC";
            asc_desc($sqlCode, $firm_db_host, $courses_db_host);
        }

        elseif($condition == "area") {
            $sqlCode = "courses.area.area_name DESC";
            asc_desc($sqlCode, $firm_db_host, $courses_db_host);
        }

        elseif($condition == "created_time") {
            $sqlCode = "courses.course_information.created_time DESC";
            asc_desc($sqlCode, $firm_db_host, $courses_db_host);
        }
    } 
} 

else {
    // 沒有任何條件時：
    $sqlCode = "courses.course_information.id DESC";
    asc_desc($sqlCode, $firm_db_host, $courses_db_host);
};




function asc_desc($sqlCode, $firm_db_host, $courses_db_host) {
    $sql_course = "SELECT courses.course_information.*, firm.firm_information.firm_name, courses.area.area_name
                    FROM courses.course_information, firm.firm_information, courses.area
                    WHERE courses.course_information.firm_id = firm.firm_information.id
                    AND courses.course_information.area_id = courses.area.id
                    AND courses.course_information.valid = 1
                    ORDER BY $sqlCode";
    $stmt_course = $courses_db_host->prepare($sql_course);
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
};