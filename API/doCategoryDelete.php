<?php
require_once ("../DB-Connect/PDO-Connect_courses.php");
// require_once("../DB-Connect/PDO-Connect_firm.php");

if(!isset($_POST["id"])) {
    header("location: /Mid-term/courses/category_list.php");
    exit();
}

$id = $_POST["id"];
// echo ($id);
// exit();

try {
  $sql_category = "UPDATE courses.category SET valid = ? WHERE id = ?";
  $stmt_category = $courses_db_host -> prepare($sql_category);
  $stmt_category -> execute([0, $id]);

  $data = [
      "status" => 1,
      "message" => "資料刪除成功！"
  ];

} catch (PDOException $e) {
  $data = [
      "status" => 0,
      "message" => $e->getMessage()
  ];
}

echo json_encode($data);
$courses_db_host = null;
// $firm_db_host = null;