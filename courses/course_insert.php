<!DOCTYPE html>
<?php
  require_once("../DB-Connect/PDO-Connect_firm.php");
  require_once("../DB-Connect/PDO-Connect_courses.php");

  // 拿到所有體驗商資料
  $sql_firm = "SELECT * FROM firm.firm_information
                WHERE valid = 1 ORDER BY firm.firm_information.id DESC";
  $stmt_firm = $firm_db_host -> prepare($sql_firm);
  $stmt_firm -> execute();
  $rows_firm = $stmt_firm -> fetchAll(PDO::FETCH_ASSOC);
  //var_dump($rows_firm);


  // 拿到所有category資料
  $sql_category = "SELECT * FROM courses.category 
                    WHERE valid = 1 ORDER BY courses.category.id DESC";
  $stmt_category = $courses_db_host -> prepare($sql_category);
  $stmt_category -> execute();
  $rows_category = $stmt_category -> fetchAll(PDO::FETCH_ASSOC);
  //var_dump($rows_category);

  // 拿到所有area資料
  $sql_area = "SELECT * FROM courses.area
                WHERE valid = 1 ORDER BY courses.area.id DESC";
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
      <title>course_insert</title>
      <?php require_once("../css.php")?>
      <?php require_once("../js.php")?>
  </head>
  <body>

    <?php require_once("../partials/nav-bar/sidebar.php") ?>
    <!-- <div class=" page_box container vh-100" style="width: 600px"> -->
    <div class="page_box">
      <div class="title display-6 text-start fw-bold">
            課程新增
      </div>
      <?php require_once("../partials/message.php") ?>
      <div class="form-group course-insert-form">
          <form action="doCourseInsert.php" method="post" enctype="multipart/form-data">
              <div class="mb-2">
                  <label for="">體驗商：</label>
                  <input list="firm_id" name="firm_id" type="text" class="form-control" placeholder="輸入體驗商名稱" required>
                  <datalist id="firm_id">
                    <?php foreach($rows_firm as $firm):?>
                    <option value="<?= $firm["id"] ?>">
                      <?= $firm["firm_name"] ?>
                    </option>
                    <?php endforeach; ?>
                  </datalist>
                  
                  
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
                  <label for="">課程相關圖片：(限jpg, jepg, png, svg檔)</label>
                  <input type="file" class="form-control" name="image_file" required>
              </div>
              <div class="mb-2">
                  <label for="">課程詳細說明檔：(限txt, word檔)</label>
                  <input type="file" class="form-control" name="file" required>
              </div>
              <div class="mb-2">
                  <label for="">使用者條款：</label>
                  <textarea class="form-control" name="caution"cols="30" rows="5">請輸入您希望使用者遵守之條款：</textarea>
              </div>

              <div class="d-grid">
                  <button class="btn btn-primary" type="submit">資料送出</button>
              </div>
          </form>
      </div>
    </div>
    <script>
    // sidebar 樣式控制
    $(".course").attr("aria-expanded",true);
    $(".course-a2").addClass("active");
    $("#course-collapse").removeClass("collapse");
    </script>
  </body>
</html>