<?php
  require_once("../DB-Connect/PDO-Connect_firm.php");
  require_once("../DB-Connect/PDO-Connect_courses.php");

  // 拿到所有課程資料
  $sql_course = "SELECT courses.course_information.*, firm.firm_information.firm_name
              FROM courses.course_information JOIN firm.firm_information
              ON courses.course_information.firm_id = firm.firm_information.id";
  $stmt_course = $firm_db_host -> prepare($sql_course);
  $stmt_course -> execute();
  $rows_course = $stmt_course -> fetchAll(PDO::FETCH_ASSOC);
  //var_dump($rows_course);
  //exit();

  // 拿到所有體驗商資料
  // $sql_firm = "SELECT * FROM firm.firm_information";
  // $stmt_firm = $firm_db_host -> prepare($sql_firm);
  // $stmt_firm -> execute();
  // $rows_firm = $stmt_firm -> fetchAll(PDO::FETCH_ASSOC);
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
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>course_list</title>
  <?php require_once("../css.php")?>
  <?php require_once("../js.php")?>
</head>
<body>
<div class="modal fade" id="courseInfo" tabindex="-1" aria-labelledby="courseInfo" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">課程資料</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-sm">
                    <tr>
                        <td>課程名稱: </td>
                        <td><span id="course-name"></span></td>
                    </tr>
                    <tr>
                        <td>課程體驗商: </td>
                        <td><span id="firm_name"></span></td>
                    </tr>
                    <tr>
                        <td>課程類別: </td>
                        <td><span id="course_category"></span></td>
                    </tr>
                    <tr>
                        <td>課程地區: </td>
                        <td><span id="course_area"></span></td>
                    </tr>
                    <tr>
                        <td>課程單價: </td>
                        <td><span id="course_price"></span></td>
                    </tr>
                    <tr>
                        <td>課程規範: </td>
                        <td><span id="course_caution"></span></td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">關閉</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="courseEdit" tabindex="-1" aria-labelledby="courseEdit" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">課程資料修改</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-sm">
                <!-- <input id="id" type="text" name="id" value="" hidden>-->
                    <tr>
                        <td>Name: </td>
                        <td><input id="editName" type="text" name="name" value=""></td>
                    </tr>
                    <tr>
                        <td>Email: </td>
                        <td><input id="editEmail" type="email" name="email" value="" disabled></td>
                    </tr>
                    <tr>
                        <td>password: </td>
                        <td><input id="editPassword" type="text" name="password" value=""></td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="editBtn">送出</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">關閉</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="courseDelete" tabindex="-1" aria-labelledby="courseDelete" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">課程資料刪除</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                確定刪除？
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="deleteBtn">刪除</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
            </div>
        </div>
    </div>
</div>



<div class="container">
    <div class="my-2">
        <button class="btn btn-primary" id="reload">Reload Data</button>
    </div>
    <div class="mb-2">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th class="text-center" style="width: 70px;" >全選 <input type="checkbox" id="select-all"> </th>
                <th>課程名稱</th>
                <th>體驗商名稱</th>
                <th>建立時間</th>
                <th></th>
            </tr>
            </thead>
            <tbody id="target">
              <?php foreach($rows_course as $value): ?>
                <tr>
                  <td class="text-center" ><input type="checkbox" id="select"></td>
                  <td> <?= $value["course_name"] ?> </td>
                  <td> <?= $value["firm_name"] ?> </td>
                  <td> <?= $value["created_time"] ?> </td>
                  <td class="text-end" style="width: 150px;">
                      <button data-id="<?= $value["id"] ?>" class="btn btn-primary text-white info-btn"><i class="fas fa-clipboard-list"></i></button>
                      <button data-id="<?= $value["id"] ?>" class="btn btn-warning text-white edit-btn"><i class="fas fa-edit"></i></button>
                      <button data-id="<?= $value["id"] ?>" class="btn btn-danger text-white delete-btn"><i class="fas fa-trash"></i></button>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<script>
  let courseInfo = new bootstrap.Modal(document.getElementById('courseInfo'), {
      keyboard: false
  })
  let courseEdit = new bootstrap.Modal(document.getElementById('courseEdit'), {
      keyboard: false
  })
  let courseDelete = new bootstrap.Modal(document.getElementById('courseDelete'), {
      keyboard: false
  })

  let id;
  $(".info-btn").click(function() {
    let id = $(this).data("id");
    let formData = new FormData();
        formData.append("id", id);
        axios.post("../API/course_info.php", formData)  // 丟入/API/user.php抓當前id的資料
            .then(function (response) {
              //console.log(response.data.data);
                if(response.data.status === 1) {
                    $("#course-name").text(response.data.data.course_name);
                    $("#firm_name").text(response.data.data.firm_name);
                    $("#course_category").text(response.data.data.category_name);
                    $("#course_area").text(response.data.data.area_name);
                    $("#course_price").text(response.data.data.price);
                    $("#course_caution").text(response.data.data.caution);
                } else {
                    alert(response.data.message)
                }
            })
            .catch(function (error) {
                console.log(error);
            });
    courseInfo.show();
  })

  $(".edit-btn").click(function() {
    let id = $(this).data("id");
    console.log(id);
    courseEdit.show();

  })

  $(".delete-btn").click(function() {
    let id = $(this).data("id");
    console.log(id);
    courseDelete.show();

  })
</script>
</body>
</html>