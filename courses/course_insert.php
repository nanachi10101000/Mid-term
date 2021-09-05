<!DOCTYPE html>
<?php
  require_once("../DB-Connect/PDO-Connect_firm.php");
  require_once("../DB-Connect/PDO-Connect_courses.php");

  // 拿到所有體驗商資料
  $sql_firm = "SELECT * FROM firm.firm_information";
  $stmt_firm = $firm_db_host -> prepare($sql_firm);
  $stmt_firm -> execute();
  $rows_firm = $stmt_firm -> fetchAll(PDO::FETCH_ASSOC);
  //var_dump($rows_firm);


  // 拿到所有category資料
  $sql_category = "SELECT * FROM courses.category";
  $stmt_category = $courses_db_host -> prepare($sql_category);
  $stmt_category -> execute();
  $rows_category = $stmt_category -> fetchAll(PDO::FETCH_ASSOC);
  //var_dump($rows_category);

  // 拿到所有area資料
  $sql_area = "SELECT * FROM courses.area";
  $stmt_area = $courses_db_host -> prepare($sql_area);
  $stmt_area -> execute();
  $rows_area = $stmt_area -> fetchAll(PDO::FETCH_ASSOC);
  //var_dump($rows_area);
?>
<html lang="Zh">
  <head>
      <meta charset="UTF-8" />
      <meta name="auther" content="XiangYen(Ian) Hsu">
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <meta name="robots" content="index,follorw" />
      <meta name="rating" content="General">
      <?php require_once("../css.php")?>
      <?php require_once("../js.php")?>
  </head>
  <body>
    <div class="container vh-100 ">
      <div class="form-group course-insert-form">
          <h1 class="text-center">新增課程</h1>
          <form action="doInsert.php" method="post" enctype="multipart/form-data">
              <div class="mb-2">
                  <label for="">體驗商：</label>
                  <select name="firm_id" id="" class="form-control" required>
                    <?php foreach($rows_firm as $firm):?>
                    <option value="<?= $firm["id"] ?>">
                      <?= $firm["firm_name"] ?>
                    </option>
                    <?php endforeach; ?>
                  </select>
              </div>
              <div class="mb-2">
                  <label for="">課程分類：</label>
                  <select name="category_id" id="" class="form-control" required>
                    <?php foreach($rows_category as $category):?>
                    <option value="<?= $category["id"] ?>">
                      <?= $category["category_name"] ?>
                    </option>
                    <?php endforeach; ?>
                  </select>
              </div>
              <div class="mb-2">
                  <label for="">選擇地區：</label>
                  <select name="area_id" id="" class="form-control" required>
                    <?php foreach($rows_area as $area): ?>
                    <option value="<?= $area["id"] ?>">
                      <?= $area["area_name"] ?>
                    </option>
                    <?php endforeach; ?>
                  </select>
              </div>
              <div class="mb-2">
                  <label for="">課程名稱：</label>
                  <input type="text" class="form-control" name="course_name" required>
              </div>
              <div class="mb-2">
                  <label for="">課程定價：</label>
                  <input type="number" class="form-control" name="price" required>
              </div>
              <div class="mb-2">
                  <label for="">課程詳細說明檔：</label>
                  <input type="file" class="form-control" name="file" required>
              </div>
              <div class="mb-2">
                  <label for="">使用者條款：</label>
                  <textarea class="form-control" name="caution"cols="30" rows="5">請輸入您希望使用者遵守之條款：</textarea>
              </div>
              <div class="mb-2">
                  <?php if(isset($_SESSION["loginError"])): ?>
                      <p class="text-danger">帳號或密碼錯誤, 次數: <?= $_SESSION["loginError"] ?></p>
                  <?php endif; ?>
              </div>
              <div class="d-grid">
                  <button class="btn btn-primary" type="submit">資料送出</button>
              </div>
          </form>
      </div>
    </div>
  </body>
</html>