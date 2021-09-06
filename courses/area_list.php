<?php
require_once "../DB-Connect/PDO-Connect_courses.php";

// 拿到所有地區資料
// $sql_area = "SELECT courses.area.* FROM courses.area
//               WHERE courses.area.valid = 1";
// $stmt_area = $course_db_host->prepare($sql_area);
// $stmt_area->execute();
// $rows_area = $stmt_area->fetchAll(PDO::FETCH_ASSOC);
//var_dump($rows_area);
//exit();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>course_list</title>
  <?php require_once "../css.php"?>
  <?php require_once "../js.php"?>
</head>
<body>
    <div class="modal fade" id="areaInsert" tabindex="-1" aria-labelledby="areaInsert" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">新增地區</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form action="doAreaInsert.php" method="post" id="areaInsertForm" enctype="multipart/form-data">
                      <div class="mb-2">
                          <label for="">地區：</label>
                          <select name="area_name" id="area_name" class="form-control" required>
                          <option value="北部">北部</option>
                          <option value="中部">中部</option>
                          <option value="南部">南部</option>
                          <option value="東部">東部</option>
                          <option value="離島">離島</option>
                          </select>
                      </div>
                  </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="doAreaInsert">送出</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">關閉</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="courseInfo" tabindex="-1" aria-labelledby="courseInfo" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">課程資料</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table courseInfoTable">
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
                    <table class="table table-sm courseEditTable">
                        <h1 class="text-center">課程編輯</h1>
                        <form action="doCourseEdit.php" method="post" id="courseEditForm" enctype="multipart/form-data">
                            <input type="text" name="course_id" id="course_id" value="" hidden>
                            <div class="mb-2">
                                <label for="">體驗商：</label>
                                <input type="text" class="form-control" id="firm" value="" disabled>
                            </div>
                            <div class="mb-2">
                                <label for="">課程分類：</label>
                                <select name="category_id" id="category_id" class="form-control" required>
                                <?php foreach ($rows_category as $category): ?>
                                <option value="<?=$category["id"]?>">
                                    <?=$category["category_name"]?>
                                </option>
                                <?php endforeach;?>
                                </select>
                            </div>
                            <div class="mb-2">
                                <label for="">選擇地區：</label>
                                <select name="area_id" id="area_id" class="form-control" required>
                                <?php foreach ($rows_area as $area): ?>
                                <option value="<?=$area["id"]?>">
                                    <?=$area["area_name"]?>
                                </option>
                                <?php endforeach;?>
                                </select>
                            </div>
                            <div class="mb-2">
                                <label for="">課程名稱：</label>
                                <input type="text" class="form-control" name="course_name" id="course_name" value="" required>
                            </div>
                            <div class="mb-2">
                                <label for="">課程定價：</label>
                                <input type="number" class="form-control" name="price" id="price" value="" required>
                            </div>
                            <div class="mb-2">
                                <label for="">課程詳細說明檔：</label>
                                <input type="file" class="form-control" name="file" >
                            </div>
                            <div class="mb-2">
                                <input type="text" class="form-control" name="prevFile" id="prevFile" value="" hidden>
                            </div>
                            <div class="mb-2">
                                <label for="">使用者條款：</label>
                                <textarea class="form-control" name="caution"cols="30" rows="5" id="caution"></textarea>
                            </div>
                        </form>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="doCourseEdit">送出</button>
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
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="courseDeleteBtn">刪除</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                </div>
            </div>
        </div>
    </div>


    <div class="container main-container">
        <?php require_once "../partials/message.php"?>
        <div class="my-2 d-flex justify-content-between">
            <button class="btn btn-primary" id="reload">Reload Data</button>
            <button class="btn btn-primary" id="inssertArea">新增地區</button>
        </div>
        <div class="mb-2">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th class="text-center" style="width: 70px;" >全選 <input type="checkbox" id="select-all"> </th>
                    <th>地區名稱</th>
                    <th></th>
                </tr>
                </thead>
                <tbody id="target">
                </tbody>
            </table>
        </div>
    </div>

<script>
    let areaInsert = new bootstrap.Modal(document.getElementById('areaInsert'), {
        keyboard: false
    })
    // let courseInfo = new bootstrap.Modal(document.getElementById('courseInfo'), {
    //     keyboard: false
    // })
    // let categoryInfo = new bootstrap.Modal(document.getElementById('categoryInfo'), {
    //     keyboard: false
    // })

    // let courseEdit = new bootstrap.Modal(document.getElementById('courseEdit'), {
    //     keyboard: false
    // })
    // let courseDelete = new bootstrap.Modal(document.getElementById('courseDelete'), {
    //     keyboard: false
    // })


    // 將id設為全域變數
    let id = 0;

    $("#inssertArea").click(function() {
      //doInsertArea.php
      areaInsert.show();
    });

    $("#doAreaInsert").click(function () {
      $("#areaInsertForm").submit();
    })

    // // 地區資訊
    // $("#target").on("click", ".info-btn", function(){
    //     let id = $(this).data("id");
    //     let formData = new FormData();
    //         formData.append("id", id);
    //         axios.post("../API/course_info.php", formData)  // 丟入/API/user.php抓當前id的資料
    //             .then(function (response) {
    //             //console.log(response.data.data);
    //                 if(response.data.status === 1) {
    //                     $("#course-name").text(response.data.data.course_name);
    //                     $("#firm_name").text(response.data.data.firm_name);
    //                     $("#course_category").text(response.data.data.category_name);
    //                     $("#course_area").text(response.data.data.area_name);
    //                     $("#course_price").text(response.data.data.price);
    //                     $("#course_caution").text(response.data.data.caution);
    //                 } else {
    //                     alert(response.data.message)
    //                 }
    //             })
    //             .catch(function (error) {
    //                 console.log(error);
    //             });
    //     courseInfo.show();
    // })

    // // 地區資訊編輯
    // $("#target").on("click", ".edit-btn", function(){
    //     let id = $(this).data("id");
    //     // console.log(id);
    //     // courseEdit.show();
    //     // return;
    //     let formData = new FormData();
    //         formData.append("id", id);
    //         axios.post("../API/getCourseInfo.php", formData)  // 丟入/API/user.php抓當前id的資料
    //             .then(function (response) {
    //             let data = response.data;
    //             //console.log(data);
    //                 if(data.status === 1) {
    //                 $("#course_id").val(id);
    //                 $("#firm").val(data.data_course.firm_name);
    //                 $("#category_id").val(data.data_course.category_id);
    //                 $("#area_id").val(data.data_course.area_id);
    //                 $("#course_name").val(data.data_course.course_name);
    //                 $("#price").val(data.data_course.price);
    //                 $("#prevFile").val(data.data_course.course_detail);
    //                 $("#caution").val(data.data_course.caution);

    //                 } else {
    //                 alert(data.message)
    //                 }
    //             })
    //             .catch(function (error) {
    //             console.log(error);
    //             });
    //     courseEdit.show();
    // })

    // // 送出地區資訊編輯的資料
    // $("#doCourseEdit").click(function() {
    // $("#courseEditForm").submit();

    //     // let category_id = $("#category_id").val();
    //     // let area_id = $("#area_id").val();
    //     // let course_name = $("#course_name").val();
    //     // let price = $("#price").val();
    //     // let prevFile = $("#prevFile").val();
    //     // let caution = $("#caution").val();
    //     // console.log(category_id, area_id, course_name, price, prevFile, caution)
    // })

    // // 地區資訊刪除
    // $("#target").on("click", ".delete-btn", function(){
    //     id = $(this).data("id");
    //     courseDelete.show();
    // })

    // // 送出行程資訊刪除
    // $("#courseDeleteBtn").click(function() {
    //     //console.log(id);
    //     let formData = new FormData();
    //         formData.append("id", id);
    //         axios.post("../API/doCourseDelete.php", formData)  // 丟入/API/user.php抓當前id的資料
    //             .then(function (response) {
    //                 //console.log(response);
    //                 let data = response.data;
    //                 if (data.status === 1) {
    //                     alert(data.message);
    //                     //location.reload();
    //                     loadData();
    //                 } else {
    //                     alert(data.message);
    //                 }
    //             })
    //             .catch(function (error) {
    //                 console.log(error);
    //             });
    // })
    
    $("#reload").click(function() {
        loadData();
    })

    loadData()
    function loadData() {
      // location.reload();
      let formData = new FormData();
        axios.post("../API/doLoadArea.php", formData)  // 丟入/API/user.php抓當前id的資料
          .then(function (response) {
            let data = response.data;
            //console.log(data);

            if (data.status === 1) {
              $("#target").empty();
              let reloadCodes = "";
                  data.data_course.forEach((area) => {
                      reloadCodes += `
                          <tr>
                              <td class="text-center" ><input type="checkbox" id="select"></td>
                              <td> ${area.area_name} </td>
                              <td class="text-end" style="width: 150px;">
                                  <button data-id="${area.id}" class="btn btn-primary text-white info-btn"><i class="fas fa-clipboard-list"></i></button>
                                  <button data-id="${area.id}" class="btn btn-warning text-white edit-btn"><i class="fas fa-edit"></i></button>
                                  <button data-id="${area.id}" class="btn btn-danger text-white delete-btn"><i class="fas fa-trash"></i></button>
                              </td>
                          </tr>`
                  })
                  $("#target").append(reloadCodes);
            } else {
                alert(data.message);
            }
          })
          .catch(function (error) {
              console.log(error);
          });
    }
</script>
</body>
</html>