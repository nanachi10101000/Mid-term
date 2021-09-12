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
        <div class="modal-dialog bid-modal">
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
                        <label for="area_detail">地區詳細資訊：</label>
                        <textarea class="form-control" name="area_detail" id="" cols="30" rows="8" required></textarea>
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
                        <thead>
                            <tr>
                                <th></th>
                                <th></th>
                            </thead>
                        </tr>
                        <tbody>
                            <tr>
                                <td class="label">地區名稱: </td>
                                <td><span id="area_name"></span></td>
                            </tr>
                            <tr>
                                <td class="label">地區細節: </td>
                                <td><span id="area_detail"></span></td>
                            </tr>
                        </tbody>
                        
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">關閉</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="areaEdit" tabindex="-1" aria-labelledby="areaEdit" aria-hidden="true">
        <div class="modal-dialog big-modal">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">地區資料修改</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- <h1 class="text-center">地區編輯</h1> -->
                    <form action="doAreaEdit.php" method="post" id="areaEditForm" enctype="multipart/form-data">
                        <input type="text" name="area_id" id="area_id" value="" hidden>
                        <div class="mb-2">
                            <label for="">地區名稱：</label>
                            <input type="text" class="form-control" name="area_name" id="area_name" value="" required>
                        </div>
                        <div class="mb-2">
                            <label for="">地區詳細資訊：</label>
                            <textarea class="form-control" name="area_detail" id="area_detail" cols="30" rows="8" required></textarea>
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
    <div class="modal fade" id="areaDeleteAll" tabindex="-1" aria-labelledby="areaDeleteAll" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">刪除全部已經選資料</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    確定刪除？ 你確定？？？？？？？
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="areaDeleteAllBtn">刪除</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                </div>
            </div>
        </div>
    </div>



    <?php require_once("../partials/nav-bar/sidebar.php") ?>

    <div class="page_box">

        <div class="title display-6 text-start fw-bold">
            地區管理
        </div>

        <div class="sorting d-flex justify-content-between">
            <button class="btn btn-primary" id="reload">Reload</button>
            <button class="btn btn-primary" id="inssertArea">新增地區</button>
        </div>

        <?php require_once "../partials/message.php"?>

        <div id="table_wrap">
            <table class="table">
                <thead class="table_head fs-6 fw-bold">
                <tr class="text-center" >
                    <th>
                        <button class="btn btn-danger btn-sm" id="delete_selected">刪除</button>
                        <div>
                            #
                        </div>
                    </th>
                    <th class="text-center" style="width: 70px;" >
                        全選 <input type="checkbox" id="select-all"> 
                        反選 <input type="checkbox" id="select-all-r"> 
                    </th>
                    <th class="ASC-DESC" data-condition="area">
                        地區名稱
                        <i class="fas fa-long-arrow-alt-up"></i>
                        <i class="fas fa-long-arrow-alt-down"></i>
                    </th>
                    <th>地區詳細資訊</th>
                    <th>
                        顯示
                        <select id="listNumber" >
                            <?php for($i = 1; $i <= 10; $i++): ?>
                                <option value="<?= $i ?>" <?php if($i == 8) echo "selected" ?>>
                                <?= $i ?>
                                </option>
                            <?php endfor; ?>
                        </select>
                        筆
                    </th>
                </tr>
                </thead>
                <tbody id="target" class="fs-6">
                </tbody>
            </table>
            <!-- 換頁的按鈕 -->
            <?php require_once("../partials/page-system.php") ?>
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
    let areaDeleteAll = new bootstrap.Modal(document.getElementById('areaDeleteAll'), {
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
        // 判斷是否至少有一個打勾
        $(".select").each(function() {
            if($(this).prop("checked")) {
                areaDeleteAll.show()
                return;
            };
        })
        
    })
    // 送出刪除全部已選的東東
    $("#areaDeleteAllBtn").click(function() {
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

    // 防止點擊checkbox時 事件傳導到tr的click event
    $("#target").on("click", ":checkbox", function (e) {
        e.stopPropagation();
    });
    // 防止點擊button時 事件傳導到tr的click event
    $("#target").on("click", "button", function(e) {
        e.stopPropagation();
    })

    // 點擊tr 直接選取
    $("#target").on("click", "tr", function () {
        let checked = $(this).find(".select").prop("checked");
        if (checked) {
            $(this).find(".select").prop("checked", false);
        } else {
            $(this).find(".select").prop("checked", true);
        }
    });

    
    // 將id設為全域變數
    let id = 0;
    // 頁碼預設第一頁
    let page = 1;

    // 生降冪
    let asc_desc = 1;
    let asc_desc_condition;
    $(".ASC-DESC").click(function() {
        $(this).toggleClass(".active");
        asc_desc_condition = $(this).data("condition");
        //console.log(asc_desc_condition);
        
        if($(this).hasClass(".active")) {
            asc_desc = 1; // 升冪
        } else {
            asc_desc = 0; // 降冪
        }

        loadData();
    })


    // 換頁功能
    $("#pageNumber").text(page);
    $("#listNumber").on("change", function() {
        // 更改顯示幾筆資料當下，將頁數回到第一頁
        page = 1
        $("#pageNumber").text(page);

        loadData();   
    })
    $("#prevBtn").click(function () {
        if(page > 1) {
            page--;
            $("#pageNumber").text(page);
            loadData();
        }
    })
    $("#nextBtn").click(function () {
        if ($("#pageNumber").text() !== $("#totalPage").text()) {
            page++;
            $("#pageNumber").text(page);
            loadData();
        }
    })
    $("#goFirstBtn").click(function () {
        page = 1;
        $("#pageNumber").text(page);
        loadData();      
    })
    $("#goEndBtn").click(function () {
            page = $("#totalPage").text();
            $("#pageNumber").text(page);
            loadData();
    })

    function loadData() {
        let formData = new FormData();

        // 如果有升降冪的情況
        if (asc_desc_condition) {
            formData.append("condition", asc_desc_condition);
            formData.append("asc_desc", asc_desc);
        }
        axios.post("../API/doLoadArea.php", formData)  
        .then(function (response) {
            let data = response.data;
            //console.log(data);
            
            if (data.status === 1) {
                $("#target").empty();
                let area = data.data_area;
                let reloadCodes = "";
                let count = 1;

                // 判斷頁碼
                let listNumber = $("#listNumber").val(); // 一頁顯示數量
                let dataLength = area.length; // 總共拿到多少資料
                let totalPage = Math.ceil(dataLength / listNumber); // 共需要幾頁

                $("#totalPage").text(totalPage);
                for(let i = (page - 1) * listNumber; i < listNumber * page; i++){
                    if(i >= dataLength) {
                        break;
                    }

                    reloadCodes += `
                        <tr>
                        <td class="text-center" >
                            ${count}
                        </td>                          
                        <td class="text-center" >
                            <input type="checkbox" data-areaid="${area[i].id}" class="select">
                        </td>
                            <td> ${area[i].area_name} </td>
                            <td> ${area[i].area_detail} </td>
                            <td class="text-end" style="width: 150px;">
                                <button data-id="${area[i].id}" class="btn btn-primary text-white info-btn"><i class="fas fa-clipboard-list"></i></button>
                                <button data-id="${area[i].id}" class="btn btn-warning text-white edit-btn"><i class="fas fa-edit"></i></button>
                                <button data-id="${area[i].id}" class="btn btn-danger text-white delete-btn"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>`
                        count ++;
                  };
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
    };

    // 先將資料跑出來一次
    loadData();


    // reload btn click
    $("#reload").click(function() {
        loadData();
    });




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
                console.log($("#area_detail"));
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