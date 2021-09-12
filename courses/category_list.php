<?php
require_once "../DB-Connect/PDO-Connect_courses.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>category_list</title>
  <?php require_once "../css.php"?>
  <?php require_once "../js.php"?>
</head>
<body>
    <div class="modal fade" id="categoryInsert" tabindex="-1" aria-labelledby="categoryInsert" aria-hidden="true">
        <div class="modal-dialog big-modal">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">新增類別</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form action="doCategoryInsert.php" method="post" id="categoryInsertForm" enctype="multipart/form-data">
                      <div class="mb-2">
                        <label for="">類別名稱：</label>
                        <input type="text" class="form-control" name="category_name" id="" value="" required />
                      </div>
                      <div class="mb-2">
                        <label for="">類別詳細資訊：</label>
                        <textarea class="form-control" name="category_detail" id="" cols="30" rows="8" required></textarea>
                      </div>
                  </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="doCategoryInsert">送出</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">關閉</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="categoryInfo" tabindex="-1" aria-labelledby="categoryInfo" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">類別資料</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table categoryInfoTable infoTable">
                        <thead>
                            <th>類別詳細資料</th>
                            <th></th>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="label">類別名稱: </td>
                                <td><span id="category_name"></span></td>
                            </tr>
                            <tr>
                                <td class="label">類別細節: </td>
                                <td><span id="category_detail"></span></td>
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
    <div class="modal fade" id="categoryEdit" tabindex="-1" aria-labelledby="categoryEdit" aria-hidden="true">
        <div class="modal-dialog big-modal">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">類別資料修改</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- <h1 class="text-center">類別編輯</h1> -->
                    <form action="doCategoryEdit.php" method="post" id="categoryEditForm" enctype="multipart/form-data">
                        <input type="text" name="category_id" id="category_id" value="" hidden>
                        <div class="mb-2">
                            <label for="">類別名稱：</label>
                            <input type="text" class="form-control" name="category_name" id="category_name" value="" required>
                        </div>
                        <div class="mb-2">
                            <label for="">類別詳細資訊：</label>
                            <textarea class="form-control" name="category_detail" id="category_detail" cols="30" rows="8" required></textarea>
                        </div>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="doCategoryEdit">送出</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">關閉</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="categoryDelete" tabindex="-1" aria-labelledby="categoryDelete" aria-hidden="true">
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
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="categoryDeleteBtn">刪除</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="categoryDeleteAll" tabindex="-1" aria-labelledby="categoryDeleteAll" aria-hidden="true">
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
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="categoryDeleteAllBtn">刪除</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                </div>
            </div>
        </div>
    </div>


    <?php require_once("../partials/nav-bar/sidebar.php") ?>

    <div class="page_box">

        <div class="title display-6 text-start fw-bold">
            類別管理
        </div>

        <div class="sorting d-flex justify-content-between">
            <button class="btn btn-primary" id="reload">Reload</button>
            <button class="btn btn-primary" id="inssertCategory">新增類別</button>
        </div>

        <?php require_once "../partials/message.php"?>

        <div id="table_wrap">
            <table class="table">
                <thead class="table_head fs-6 fw-bold">
                <tr class="text-center">
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
                    <th class="ASC-DESC" data-condition="category">
                        類別名稱
                        <i class="fas fa-long-arrow-alt-up"></i>
                        <i class="fas fa-long-arrow-alt-down"></i>
                    </th>
                    <th>類別詳細資訊</th>
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
    let categoryInsert = new bootstrap.Modal(document.getElementById('categoryInsert'), {
        keyboard: false
    })
    let categoryInfo = new bootstrap.Modal(document.getElementById('categoryInfo'), {
        keyboard: false
    })
    let categoryEdit = new bootstrap.Modal(document.getElementById('categoryEdit'), {
        keyboard: false
    })
    let categoryDelete = new bootstrap.Modal(document.getElementById('categoryDelete'), {
        keyboard: false
    })
    let categoryDeleteAll = new bootstrap.Modal(document.getElementById('categoryDeleteAll'), {
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
                categoryDeleteAll.show()
                return;
            };
        })
        
    })
    // 送出刪除全部已選的東東
    $("#categoryDeleteAllBtn").click(function() {
        let selectedId = [];
        $(".select").each(function() {
            //console.log($(this));
            if($(this).prop("checked")) {
                let category_id = $(this).data("categoryid");
                selectedId.push(category_id);
            };
        })
        let formData = new FormData();
        selectedId.forEach((id) => {
            formData.append("category_id_arr[]", id);
        });
        axios.post("../API/doCategoryDelete.php", formData)
            .then(function (response) {
                //console.log(response);
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
        console.log(asc_desc_condition);
        
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


    // loading 類別
    function loadData() {
        let formData = new FormData();

        // 如果有升降冪的情況
        if (asc_desc_condition) {
            formData.append("condition", asc_desc_condition);
            formData.append("asc_desc", asc_desc);
        }
        axios.post("../API/doLoadCategory.php", formData)  
        .then(function (response) {
            let data = response.data;
            //console.log(data);
            
            if (data.status === 1) {
                $("#target").empty();
                let category = data.data_category;
                let reloadCodes = "";
                let count = 1;

                // 判斷頁碼
                let listNumber = $("#listNumber").val(); // 一頁顯示數量
                let dataLength = category.length; // 總共拿到多少資料
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
                            <input type="checkbox" data-categoryid="${category[i].id}" class="select">
                        </td>
                            <td> ${category[i].category_name} </td>
                            <td> ${category[i].category_detail} </td>
                            <td class="text-end" style="width: 150px;">
                                <button data-id="${category[i].id}" class="btn btn-primary text-white info-btn"><i class="fas fa-clipboard-list"></i></button>
                                <button data-id="${category[i].id}" class="btn btn-warning text-white edit-btn"><i class="fas fa-edit"></i></button>
                                <button data-id="${category[i].id}" class="btn btn-danger text-white delete-btn"><i class="fas fa-trash"></i></button>
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



    $("#inssertCategory").click(function() {
      //doInsertcategory.php
      categoryInsert.show();
    });

    $("#doCategoryInsert").click(function () {
      $("#categoryInsertForm").submit();
    })

    // 類別資訊
    $("#target").on("click", ".info-btn", function(){
        let id = $(this).data("id");
        let formData = new FormData();
            formData.append("id", id);
            axios.post("../API/getCategoryInfo.php", formData)  // 丟入/API/user.php抓當前id的資料
                .then(function (response) {
                let data = response.data
                // console.log(data);
                // return;
                    if(response.data.status === 1) {
                        $("#category_name").text(data.data_category.category_name);
                        $("#category_detail").text(data.data_category.category_detail);
                    } else {
                        alert(response.data.message)
                    }
                })
                .catch(function (error) {
                    console.log(error);
                });
        categoryInfo.show();
    })

    // 類別資訊編輯
    $("#target").on("click", ".edit-btn", function(){
        let id = $(this).data("id");
        // console.log(id);
        let formData = new FormData();
            formData.append("id", id);
            axios.post("../API/getCategoryInfo.php", formData)  // 丟入/API/user.php抓當前id的資料
                .then(function (response) {
                let data = response.data;
                // console.log(data);
                // return;
                    if(data.status === 1) {
                        $("#categoryEditForm > #category_id").val(data.data_category.id);
                        $("#categoryEditForm > div > #category_name").val(data.data_category.category_name);
                        $("#categoryEditForm > div > #category_detail").val(data.data_category.category_detail);
                    } else {
                        alert(data.message)
                    }
                })
                .catch(function (error) {
                console.log(error);
                });
        categoryEdit.show();
    })

    // 送出地區資訊編輯的資料
    $("#doCategoryEdit").click(function() {
        $("#categoryEditForm").submit();
    })

    // 地區資訊刪除
    $("#target").on("click", ".delete-btn", function(){
        id = $(this).data("id");
        categoryDelete.show();
    })

    // 送出地區資訊刪除
    $("#categoryDeleteBtn").click(function() {
        //console.log(id);
        let formData = new FormData();
            formData.append("id", id);
            axios.post("../API/doCategoryDelete.php", formData)  // 丟入/API/user.php抓當前id的資料
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