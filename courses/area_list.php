<?php
require_once "../DB-Connect/PDO-Connect_courses.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>area_list</title>
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
                        <input type="text" class="form-control" name="area_name" id="" value="" required />
                      </div>
                      <div class="mb-2">
                        <label for="">地區詳細資訊：</label>
                        <input type="text" class="form-control" name="area_detail" id="" value="" required />
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
    <div class="modal fade" id="areaInfo" tabindex="-1" aria-labelledby="areaInfo" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">地區資料</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table areaInfoTable infoTable">
                        <tr>
                            <td>地區名稱: </td>
                            <td><span id="area_name"></span></td>
                        </tr>
                        <tr>
                            <td>地區細節: </td>
                            <td><span id="area_detail"></span></td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">關閉</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="areaEdit" tabindex="-1" aria-labelledby="areaEdit" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">地區資料修改</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h1 class="text-center">地區編輯</h1>
                    <form action="doAreaEdit.php" method="post" id="areaEditForm" enctype="multipart/form-data">
                        <input type="text" name="area_id" id="area_id" value="" hidden>
                        <div class="mb-2">
                            <label for="">地區名稱：</label>
                            <input type="text" class="form-control" name="area_name" id="area_name" value="" required>
                        </div>
                        <div class="mb-2">
                            <label for="">地區詳細資訊：</label>
                            <input type="text" class="form-control" name="area_detail" id="area_detail" value="" required>
                        </div>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="doAreaEdit">送出</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">關閉</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="areaDelete" tabindex="-1" aria-labelledby="areaDelete" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">地區資料刪除</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    確定刪除？
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="areaDeleteBtn">刪除</button>
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
        <button class="btn btn-danger" id="delete_selected">刪除已選</button>
        <div class="mb-2">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th class="text-center" style="width: 70px;" >
                        全選 <input type="checkbox" id="select-all"> 
                        反選 <input type="checkbox" id="select-all-r"> 
                    </th>
                    <th>地區名稱</th>
                    <th>地區詳細資訊</th>
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
    let areaInfo = new bootstrap.Modal(document.getElementById('areaInfo'), {
        keyboard: false
    })

    let areaEdit = new bootstrap.Modal(document.getElementById('areaEdit'), {
        keyboard: false
    })
    let areaDelete = new bootstrap.Modal(document.getElementById('areaDelete'), {
        keyboard: false
    })

    // 全選
    $("#select-all").click( function () {
        //console.log($(this));
        //console.log($(this).prop("checked"))
        if($(this).prop("checked")) {
            //console.log("check");
            $("#target").find(".select").prop("checked", true);
        } else {
            //console.log("no check")
            $("#target").find(".select").prop("checked", false);
        }
    })
    // 反選
    $("#select-all-r").click( function () {
        $(".select").each(function() {
            //console.log($(this));
            if($(this).prop("checked")) {
                $(this).prop("checked", false)
            } else {
                $(this).prop("checked", true)
            }
        })
    })

    // 刪除全部已選的東東
    $("#delete_selected").click(function () {
        let selectedId = [];
        $(".select").each(function() {
            //console.log($(this));
            if($(this).prop("checked")) {
                let area_id = $(this).data("areaid");
                selectedId.push(area_id);
            };
        })
        let formData = new FormData();
        selectedId.forEach((id) => {
            formData.append("area_id_arr[]", id);
        });
        axios.post("../API/doAreaDelete.php", formData)
            .then(function (response) {
                let data = response.data;
                if (data.status === 1) {
                    //alert(data.message);
                    loadData()
                } else {
                    console.log(data.message);
                    alert("沒有刪除成功欸ㄏㄏ！")
                }
            })
            .catch(function (error) {
                console.log(error);
            });
    })


    // 先將資料跑出來一次
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
                  data.data_area.forEach((area) => {
                      reloadCodes += `
                          <tr>
                            <td class="text-center" >
                                <input type="checkbox" data-areaid="${area.id}" class="select">
                            </td>
                              <td> ${area.area_name} </td>
                              <td> ${area.area_detail} </td>
                              <td class="text-end" style="width: 150px;">
                                  <button data-id="${area.id}" class="btn btn-primary text-white info-btn"><i class="fas fa-clipboard-list"></i></button>
                                  <button data-id="${area.id}" class="btn btn-warning text-white edit-btn"><i class="fas fa-edit"></i></button>
                                  <button data-id="${area.id}" class="btn btn-danger text-white delete-btn"><i class="fas fa-trash"></i></button>
                              </td>
                          </tr>`
                  })
                  $("#target").append(reloadCodes);
            } else {
                //alert(data.message);
                $("#target").empty();
                console.log(data.message);
            }
          })
          .catch(function (error) {
              console.log(error);
          });
    }

    // reload btn click
    $("#reload").click(function() {
        loadData();
    })


    // 將id設為全域變數
    let id = 0;

    $("#inssertArea").click(function() {
      //doInsertArea.php
      areaInsert.show();
    });

    $("#doAreaInsert").click(function () {
      $("#areaInsertForm").submit();
    })

    // 地區資訊
    $("#target").on("click", ".info-btn", function(){
        let id = $(this).data("id");
        let formData = new FormData();
            formData.append("id", id);
            axios.post("../API/getAreaInfo.php", formData)  // 丟入/API/user.php抓當前id的資料
                .then(function (response) {
                let data = response.data
                // return;
                    if(response.data.status === 1) {
                        $("#area_name").text(data.data_area.area_name);
                        $("#area_detail").text(data.data_area.area_detail);
                    } else {
                        alert(response.data.message)
                    }
                })
                .catch(function (error) {
                    console.log(error);
                });
        areaInfo.show();
    })

    // 地區資訊編輯
    $("#target").on("click", ".edit-btn", function(){
        let id = $(this).data("id");
        //console.log(id);
        let formData = new FormData();
            formData.append("id", id);
            axios.post("../API/getAreaInfo.php", formData)  // 丟入/API/user.php抓當前id的資料
                .then(function (response) {
                let data = response.data;
                // console.log(data);
                // return;
                    if(data.status === 1) {
                        $("#areaEditForm > #area_id").val(data.data_area.id);
                        $("#areaEditForm > div > #area_name").val(data.data_area.area_name);
                        $("#areaEditForm > div > #area_detail").val(data.data_area.area_detail);
                    } else {
                        alert(data.message)
                    }
                })
                .catch(function (error) {
                console.log(error);
                });
        areaEdit.show();
    })

    // 送出地區資訊編輯的資料
    $("#doAreaEdit").click(function() {
        $("#areaEditForm").submit();
    })

    // 地區資訊刪除
    $("#target").on("click", ".delete-btn", function(){
        id = $(this).data("id");
        areaDelete.show();
    })

    // 送出地區資訊刪除
    $("#areaDeleteBtn").click(function() {
        //console.log(id);
        let formData = new FormData();
            formData.append("id", id);
            axios.post("../API/doAreaDelete.php", formData)  // 丟入/API/user.php抓當前id的資料
                .then(function (response) {
                    // console.log(response);
                    let data = response.data;
                    if (data.status === 1) {
                        alert(data.message);
                        //location.reload();
                        loadData();
                    } else {
                        alert(data.message);
                    }
                })
                .catch(function (error) {
                    console.log(error);
                });
    })
    


</script>
</body>
</html>