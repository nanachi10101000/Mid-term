<?php
  require_once("../DB-Connect/PDO-Connect_firm.php");
  require_once("../DB-Connect/PDO-Connect_courses.php");
  require_once("../DB-Connect/PDO-Connect_image.php");

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
    doSql($sqlCode, $input_value, $courses_db_host, $firm_db_host);
  } 

  // 依照體驗商搜尋
  elseif ($condition == 2) {
    $sqlCode = "firm.firm_information.firm_name";
    doSql($sqlCode, $input_value, $courses_db_host, $firm_db_host);
  }

  // 依照地區名稱搜尋
  elseif($condition == 3) {
    $sqlCode = "courses.area.area_name";
    doSql($sqlCode, $input_value, $courses_db_host, $firm_db_host);
  }

  

  // sql語法整合在一起的code，使用時再帶入變數
  function doSql($sqlCode, $input_value, $courses_db_host, $firm_db_host) {
    try {
      $sql_course = "SELECT courses.course_information.*, firm.firm_information.firm_name,
                  courses.category.category_name, courses.area.area_name
                  FROM courses.course_information, firm.firm_information, courses.category, courses.area
                  WHERE courses.course_information.firm_id = firm.firm_information.id
                  AND courses.course_information.category_id = courses.category.id
                  AND courses.course_information.area_id = courses.area.id
                  AND $sqlCode LIKE ?
                  AND courses.course_information.valid = 1
                  ORDER BY courses.course_information.id DESC";
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






  // 拿到所有課程圖片資料
  // $sql_course_image = "SELECT * FROM image.course
  //                       WHERE image.course.course_id = ?";
  // $stmt_course_image = $image_db_host -> prepare($sql_course_image);
  // $stmt_course_image -> execute([$id]);
  // $rows_course_image = $stmt_course_image -> fetchAll(PDO::FETCH_ASSOC);


  // 原 1-code
    // try {
  //   $sql_course = "SELECT courses.course_information.*, firm.firm_information.firm_name,
  //               courses.category.category_name, courses.area.area_name
  //               FROM courses.course_information, firm.firm_information, courses.category, courses.area
  //               WHERE courses.course_information.firm_id = firm.firm_information.id
  //               AND courses.course_information.category_id = courses.category.id
  //               AND courses.course_information.area_id = courses.area.id
  //               AND courses.course_information.course_name LIKE ?
  //               AND courses.course_information.valid = 1
  //               ORDER BY courses.course_information.id DESC";
  //   $stmt_course = $courses_db_host -> prepare($sql_course);
  //   $stmt_course -> execute([$input_value]);
  //   $rows_course = $stmt_course -> fetchAll(PDO::FETCH_ASSOC);
  // } catch (PDOException $e) {
  //   $data = [
  //     "status" => 1,
  //     "data_course" => $e
  //   ];
  //   echo json_encode($data);
  //   $courses_db_host = null;
  //   $firm_db_host = null;
  // }
  //var_dump($rows_course);
  // echo json_encode($rows_course);


  // 原 2-code
  //  try {
  //   $sql_course = "SELECT courses.course_information.*, firm.firm_information.firm_name,
  //               courses.category.category_name, courses.area.area_name
  //               FROM courses.course_information, firm.firm_information, courses.category, courses.area
  //               WHERE courses.course_information.firm_id = firm.firm_information.id
  //               AND courses.course_information.category_id = courses.category.id
  //               AND courses.course_information.area_id = courses.area.id
  //               AND firm.firm_information.firm_name LIKE ?
  //               AND courses.course_information.valid = 1
  //               ORDER BY courses.course_information.id DESC";
  //   $stmt_course = $courses_db_host -> prepare($sql_course);
  //   $stmt_course -> execute([$input_value]);
  //   $rows_course = $stmt_course -> fetchAll(PDO::FETCH_ASSOC);
  // } catch (PDOException $e) {
  //   $data = [
  //     "status" => 1,
  //     "data_course" => $e
  //   ];
  //   echo json_encode($data);
  //   $courses_db_host = null;
  //   $firm_db_host = null;
  // }
  //var_dump($rows_course);
  // echo json_encode($rows_course);



  // 原 3-code
  // try {
  //   $sql_course = "SELECT courses.course_information.*, firm.firm_information.firm_name,
  //               courses.category.category_name, courses.area.area_name
  //               FROM courses.course_information, firm.firm_information, courses.category, courses.area
  //               WHERE courses.course_information.firm_id = firm.firm_information.id
  //               AND courses.course_information.category_id = courses.category.id
  //               AND courses.course_information.area_id = courses.area.id
  //               AND courses.area.area_name LIKE ?
  //               AND courses.course_information.valid = 1
  //               ORDER BY courses.course_information.id DESC";
  //   $stmt_course = $courses_db_host -> prepare($sql_course);
  //   $stmt_course -> execute([$input_value]);
  //   $rows_course = $stmt_course -> fetchAll(PDO::FETCH_ASSOC);
  // } catch (PDOException $e) {
  //   $data = [
  //     "status" => 1,
  //     "data_course" => $e
  //   ];
  //   echo json_encode($data);
  //   $courses_db_host = null;
  //   $firm_db_host = null;
  // }


// if($stmt_course -> rowCount() === 0) {
//     $data = [
//         "status" => 0,
//         "message" => "沒有找到符合條件的資料"
//     ];
// } else {
//     $data = [
//         "status" => 1,
//         "data_course" => $rows_course
//         // "data_course_image" => $rows_course_image[0]
//     ];
// }



// echo json_encode($data);
// $courses_db_host = null;
// $firm_db_host = null;