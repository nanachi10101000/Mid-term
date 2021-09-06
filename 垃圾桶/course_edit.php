<?php
  require_once("../DB-Connect/PDO-Connect_firm.php");
  require_once("../DB-Connect/PDO-Connect_courses.php");

  if(!isset($_GET["id"])) {
    header("location: course_list.php");
    exit();
  }

  $id = $_GET["id"];

  // 拿到所有課程資料
  $sql_course = "SELECT courses.course_information.*, firm.firm_information.firm_name
                 FROM courses.course_information, firm.firm_information
                 WHERE courses.course_information.firm_id = firm.firm_information.id
                 AND courses.course_information.id = ? 
                 AND courses.course_information.valid = 1";
  $stmt_course = $firm_db_host -> prepare($sql_course);
  $stmt_course -> execute([$id]);
  $rows_course = $stmt_course -> fetch();
  // var_dump($rows_course[0]);
  //exit();

  // 拿到所有category資料
  $sql_category = "SELECT * FROM courses.category WHERE valid = 1";
  $stmt_category = $courses_db_host -> prepare($sql_category);
  $stmt_category -> execute();
  $rows_category = $stmt_category -> fetchAll(PDO::FETCH_ASSOC);
  //var_dump($rows_category);


  // 拿到所有area資料
  $sql_area = "SELECT * FROM courses.area WHERE valid = 1";
  $stmt_area = $courses_db_host -> prepare($sql_area);
  $stmt_area -> execute();
  $rows_area = $stmt_area -> fetchAll(PDO::FETCH_ASSOC);
  //var_dump($rows_area);
?>

<!DOCTYPE html>
<html lang="Zh">
    <head>
        <meta charset="UTF-8" />
        <meta name="auther" content="XiangYen(Ian) Hsu">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="robots" content="index,follorw" />
        <meta name="rating" content="General">
        <title>Course-Edit</title>
        <?php require_once("../css.php")?>
        <?php require_once("../js.php")?>
    </head>
    <body>
      <div class="container vh-100 ">
      <div class="form-group course-edit-form">
          <h1 class="text-center">課程編輯</h1>
          <form action="doCourseEdit.php" method="post" enctype="multipart/form-data">
            <input type="text" name="course_id" value="<?= $id ?>" hidden>
            <div class="mb-2">
                <label for="">體驗商：</label>
                <input type="text" class="form-control" value="<?= $rows_course["firm_name"] ?>" disabled>
            </div>
            <div class="mb-2">
                <label for="">課程分類：</label>
                <select name="category_id" id="" class="form-control" required>
                  <?php foreach($rows_category as $category):?>
                  <option value="<?= $category["id"] ?>"
                    <?php if($category["id"] == $rows_course["category_id"]) echo "selected" ?>
                  >
                    <?= $category["category_name"] ?>
                  </option>
                  <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-2">
                <label for="">選擇地區：</label>
                <select name="area_id" id="" class="form-control" required>
                  <?php foreach($rows_area as $area): ?>
                  <option value="<?= $area["id"] ?>"
                    <?php if($area["id"] == $rows_course["area_id"]) echo "selected" ?>
                  >
                    <?= $area["area_name"] ?>
                  </option>
                  <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-2">
                <label for="">課程名稱：</label>
                <input type="text" class="form-control" name="course_name" value="<?= $rows_course["course_name"] ?>" required>
            </div>
            <div class="mb-2">
                <label for="">課程定價：</label>
                <input type="number" class="form-control" name="price" value="<?= $rows_course["price"] ?>" required>
            </div>
            <div class="mb-2">
                <label for="">課程詳細說明檔：</label>
                <input type="file" class="form-control" name="file" >
            </div>
            <div class="mb-2">
                <input type="text" class="form-control" name="prevFile" value="<?= $rows_course["course_detail"] ?>" hidden>
            </div>
            <div class="mb-2">
                <label for="">使用者條款：</label>
                <textarea class="form-control" name="caution"cols="30" rows="5"><?= $rows_course["caution"] ?></textarea>
            </div>
            <div class="d-grid">
                <button class="btn btn-primary" type="submit">資料送出</button>
            </div>
          </form>
    </body>
</html>



<?php
$courses_db_host = null;
$firm_db_host = null;
