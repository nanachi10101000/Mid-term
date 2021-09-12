<?php
  require_once("../DB-Connect/PDO-Connect_firm.php");
  require_once("../DB-Connect/PDO-Connect_courses.php");

  if(!isset($_POST["input_value"]) || !isset($_POST["condition"])) {
    header("location: /Mid-term/courses/course_list.php");
    exit();
  }

  $condition = $_POST["condition"];
  $input_value = $_POST["input_value"];
  $input_value = "%" . $input_value . "%";



  // 依照不同的condition去不同的db找課程資料 
  // 1 => 課程名稱， 2 => 體驗商名稱， 3 => 地區名稱
  if ($condition == 1) {
    $sqlCode = "courses.course_information.course_name";
    doCompare($sqlCode, $input_value, $courses_db_host, $firm_db_host);    
  } 

  // 依照體驗商搜尋
  elseif ($condition == 2) {
    $sqlCode = "firm.firm_information.firm_name";
    doCompare($sqlCode, $input_value, $courses_db_host, $firm_db_host);
  }

  // 依照地區名稱搜尋
  elseif($condition == 3) {
    $sqlCode = "courses.area.area_name";
    doCompare($sqlCode, $input_value, $courses_db_host, $firm_db_host);
  }

  

  // sql語法整合在一起的code，使用時再帶入變數
  function doSql($sqlCode, $sqlCode2, $input_value, $courses_db_host, $firm_db_host) {
    try {
      $sql_course = "SELECT courses.course_information.*, firm.firm_information.firm_name,
                  courses.category.category_name, courses.area.area_name
                  FROM courses.course_information, firm.firm_information, courses.category, courses.area
                  WHERE courses.course_information.firm_id = firm.firm_information.id
                  AND courses.course_information.category_id = courses.category.id
                  AND courses.course_information.area_id = courses.area.id
                  AND $sqlCode LIKE ?
                  AND courses.course_information.valid = 1
                  ORDER BY $sqlCode2";
      $stmt_course = $courses_db_host -> prepare($sql_course);
      $stmt_course -> execute([$input_value]);
      $rows_course = $stmt_course -> fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      $data = [
        "status" => 1,
        "data_course" => $e
      ];
      echo json_encode($data);
      $courses_db_host = null;
      $firm_db_host = null;
    }

    if($stmt_course -> rowCount() === 0) {
      $data = [
          "status" => 0,
          "message" => "沒有找到符合條件的資料"
      ];
    } else {
        $data = [
            "status" => 1,
            "data_course" => $rows_course
            // "data_course_image" => $rows_course_image[0]
        ];
    }
    echo json_encode($data);
    $courses_db_host = null;
    $firm_db_host = null;
  };


  function doCompare($sqlCode, $input_value, $courses_db_host, $firm_db_host) {
    if(isset($_POST["asc_desc_condition"])) {
      $asc_desc_condition = $_POST["asc_desc_condition"];
      $asc_desc = $_POST["asc_desc"];

      if ($asc_desc == 1) {
        if($asc_desc_condition == "course") {
            $sqlCode2 = "courses.course_information.course_name ASC";
            doSql($sqlCode, $sqlCode2, $input_value, $courses_db_host, $firm_db_host);
        } 
        
        elseif($asc_desc_condition == "firm") {
            $sqlCode2 = "firm.firm_information.firm_name ASC";
            doSql($sqlCode, $sqlCode2, $input_value, $courses_db_host, $firm_db_host);
        }

        elseif($asc_desc_condition == "area") {
            $sqlCode2 = "courses.area.area_name ASC";
            doSql($sqlCode, $sqlCode2, $input_value, $courses_db_host, $firm_db_host);
        }

        elseif($asc_desc_condition == "created_time") {
            $sqlCode2 = "courses.course_information.created_time ASC";
            doSql($sqlCode, $sqlCode2, $input_value, $courses_db_host, $firm_db_host);
        }

      } else {
        if($asc_desc_condition == "course") {
            $sqlCode2 = "courses.course_information.course_name DESC";
            doSql($sqlCode, $sqlCode2, $input_value, $courses_db_host, $firm_db_host);
        } 
        
        elseif($asc_desc_condition == "firm") {
            $sqlCode2 = "firm.firm_information.firm_name DESC";
            doSql($sqlCode, $sqlCode2, $input_value, $courses_db_host, $firm_db_host);
        }

        elseif($asc_desc_condition == "area") {
            $sqlCode2 = "courses.area.area_name DESC";
            doSql($sqlCode, $sqlCode2, $input_value, $courses_db_host, $firm_db_host);
        }

        elseif($asc_desc_condition == "created_time") {
            $sqlCode2 = "courses.course_information.created_time DESC";
            doSql($sqlCode, $sqlCode2, $input_value, $courses_db_host, $firm_db_host);
        }
      } 


    // 沒有升降冪的情況
    } else {
      $sqlCode2 = "courses.course_information.id DESC";
      doSql($sqlCode, $sqlCode2, $input_value, $courses_db_host, $firm_db_host);
    }
  }