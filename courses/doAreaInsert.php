<?php
require_once("../DB-Connect/PDO-Connect_courses.php");

if(!isset($_POST["area_name"])) {
  header("location: area_list.php");
  exit();
}

$area_name = $_POST["area_name"];
echo $area_name;