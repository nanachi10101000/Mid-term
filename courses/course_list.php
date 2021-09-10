<?php
require_once "../DB-Connect/PDO-Connect_firm.php";
require_once "../DB-Connect/PDO-Connect_courses.php";


// 拿到所有category資料
$sql_category = "SELECT * FROM courses.category WHERE valid = 1";
$stmt_category = $courses_db_host->prepare($sql_category);
$stmt_category->execute();
$rows_category = $stmt_category->fetchAll(PDO::FETCH_ASSOC);
//var_dump($rows_category);

// 拿到所有area資料
$sql_area = "SELECT * FROM courses.area WHERE valid = 1";
$stmt_area = $courses_db_host->prepare($sql_area);
$stmt_area->execute();
$rows_area = $stmt_area->fetchAll(PDO::FETCH_ASSOC);
//var_dump($rows_area);
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
    <div class="modal fade" id="courseInfo" tabindex="-1" aria-labelledby="courseInfo" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">課程資料</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table courseInfoTable infoTable">
                        <thead>
                            <tr>
                                <th></th>
                                <th></th>
                            </tr> 
                        </thead>
                        <tbody>
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
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">關閉</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="batchInfo" tabindex="-1" aria-labelledby="batchInfo" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">課程梯次編輯</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-sm batchTable">
                        <thead>
                        <tr>
                            <th><h6>當前課程梯次</h6></th>
                        </tr> 
                        </thead>
                        <tbody id="batchTarget">
                            <tr>
                                <td class="text-center">
                                    <!-- <span id="batch-date">2021/08/30</span> -->
                                    <!-- <button type="button" class="btn-close"></button> -->
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <form class="form-inline">
                        <div class="form-group mb-2">
                            <input type="date" class="form-control" id="batch_date" value="">
                        </div>
                        <button type="button" class="btn btn-primary mb-2" id="insertBatch">新增梯次</button>
                    </form>         
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
                    <!-- <h1 class="text-center">課程編輯</h1> -->
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
                            <label for="">課程ㄉ圖片：</label>
                            <input type="file" class="form-control" name="image_file" required>
                        </div>
                        <div class="mb-2">
                            <input type="text" class="form-control" name="prevImageFile" id="prevImageFile" value="" hidden>
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
    <div class="modal fade" id="courseDeleteAll" tabindex="-1" aria-labelledby="courseDeleteAll" aria-hidden="true">
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
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="courseDeleteAllBtn">刪除</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                </div>
            </div>
        </div>
    </div>


    <?php require_once("../partials/nav-bar/sidebar.php") ?>

    <div class="page_box">
        <?php require_once "../partials/message.php"?>

        <div class="title display-6 text-start fw-bold">
            課程管理
        </div>
        

        <div class="sorting d-flex justify-content-between">
            <div class="d-flex" style="max-height: 40px;">
                <button class="btn btn-primary" id="reload">Reload</button>
                <div class="input-group ">
                    <select id="condition">
                        <option value="1">依課程搜</option>
                        <option value="2">依體驗商搜</option>
                        <option value="3">依地區搜</option>
                    </select>
                    <input type="text" class="form-control" id="search">
                    <button class="btn btn-success" id="search_btn">搜尋</button>
                </div>
            </div>
            <button class="btn btn-primary" href="course_insert.php">新增課程</button>
        </div>
        


        <div id="table_wrap">
            <table class="table">
                <thead class="table_head fs-6 fw-bold">
                <tr class="fs-6 fw-bold">
                    <th>#</th>
                    <th class="text-center" style="width: 70px;" >
                        全選 <input type="checkbox" id="select-all"> 
                        反選 <input type="checkbox" id="select-all-r">
                        <button class="btn btn-danger btn-sm" id="delete_selected">刪除</button>
                    </th>
                    <th>課程名稱</th>
                    <th>體驗商名稱</th>
                    <th>地區名稱</th>
                    <th>建立時間</th>
                    <th>梯次新建刪除</th>
                    <th></th>
                </tr>
                </thead>
                <tbody id="target" class="fs-6">
                    
                </tbody>
            </table>
            <div class="pageChange">
                <select id="listNumber">
                    <?php for($i = 1; $i <= 10; $i++): ?>
                        <option value="<?= $i ?>" <?php if($i == 8) echo "selected" ?>>
                         <?= $i ?>
                        </option>
                    <?php endfor; ?>
                </select>
                <button id="prevBtn" type="button" class="btn btn-primary btn-sm">Prev</button></button>
                <button id="nextBtn" type="button" class="btn btn-primary btn-sm">Next</button></button>
                <p>第 <span id="pageNumber"></span> 頁 | 共 <span id="totalPage"></span> 頁</p>
            </div>
        </div>
    </div>

    <script>
        let courseInfo = new bootstrap.Modal(document.getElementById('courseInfo'), {
            keyboard: false
        })
        let batchInfo = new bootstrap.Modal(document.getElementById('batchInfo'), {
            keyboard: false
        })

        let courseEdit = new bootstrap.Modal(document.getElementById('courseEdit'), {
            keyboard: false
        })
        let courseDelete = new bootstrap.Modal(document.getElementById('courseDelete'), {
            keyboard: false
        })
        let courseDeleteAll = new bootstrap.Modal(document.getElementById('courseDeleteAll'), {
            keyboard: false
        })

        

        // 全選
        $("#select-all").click( function () {
            if($(this).prop("checked")) {
                $("#target").find(".select").prop("checked", true);
            } else {
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
                    courseDeleteAll.show()
                    return;
                };
            })
            
        })
        // 送出刪除全部已選的東東
        $("#courseDeleteAllBtn").click(function() {
            let selectedId = [];
            $(".select").each(function() {
                //console.log($(this));
                if($(this).prop("checked")) {
                    let course_id = $(this).data("courseid");
                    selectedId.push(course_id);
                };
            })
            let formData = new FormData();
            selectedId.forEach((id) => {
                formData.append("course_id_arr[]", id);
            });
            axios.post("../API/doCourseDelete.php", formData)
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
        

        // 將id設為全域變數
        let id = 0;
        // 頁碼預設第一頁
        let page = 1;


        // 換頁功能
        $("#pageNumber").text(page);
        $("#listNumber").on("change", function() {
            let inputValue = $("#search").val();
            if (inputValue == "") {
                loadData();
            } else {
                doSearch();
            }
            
        })
        $("#prevBtn").click(function () {
            if(page > 1) {
                page--;
                $("#pageNumber").text(page);
                let inputValue = $("#search").val();
                if (inputValue == "") {
                    loadData();
                } else {
                    doSearch();
                }
            }
        })
        $("#nextBtn").click(function () {
            if ($("#pageNumber").text() !== $("#totalPage").text()) {
                page++;
                $("#pageNumber").text(page);
                let inputValue = $("#search").val();
                if (inputValue == "") {
                    loadData();
                } else {
                    doSearch();
                }
            }
        })

        // search function
        function doSearch() {
            // 依照不同的condition去不同的db找
            let inputValue = $("#search").val();
            let condtion = $("#condition").val();
            if(inputValue != "") {
                let formData = new FormData();
                formData.append("input_value", inputValue);
                formData.append("condition", condtion);
                axios.post("../API/doCourseSearch.php", formData)
                    .then(function (response) {
                        let data = response.data;
                        if (data.status === 1) {
                            $("#target").empty(); // 先移除所有tr
                            let course = data.data_course;
                            let reloadCodes = "";
                            let count = 1;

                            // 判斷頁碼
                            let listNumber = $("#listNumber").val(); // 一頁顯示數量
                            let dataLength = course.length; // 總共拿到多少資料
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
                                            <input type="checkbox" class="select" data-courseid="${course[i].id}">
                                        </td>
                                        <td> ${course[i].course_name} </td>
                                        <td> ${course[i].firm_name} </td>
                                        <td> ${course[i].area_name} </td>
                                        <td> ${course[i].created_time} </td>
                                        <td class="text-center" style="width: 150px;">
                                            <button  data-id="${course[i].id}" class="btn btn-primary text-white batch-btn">增減梯次</button>
                                        </td>
                                        <td class="text-end" style="width: 150px;">
                                            <button data-id="${course[i].id}" class="btn btn-primary text-white info-btn"><i class="fas fa-clipboard-list"></i></button>
                                            <button data-id="${course[i].id}" class="btn btn-warning text-white edit-btn"><i class="fas fa-edit"></i></button>
                                            <button data-id="${course[i].id}" class="btn btn-danger text-white delete-btn"><i class="fas fa-trash"></i></button>
                                        </td>
                                    </tr>`
                                count ++;
                            };
                            $("#target").append(reloadCodes);
                        } else {
                            //console.log(response);
                            loadData()
                            alert(data.message)
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            }
        } 

        // 按下search Btn
        $("#search_btn").click(function () {
            doSearch();
        })
        
        // loading 課程
        function loadData() {
            // location.reload();
            let formData = new FormData();
            axios.post("../API/doLoadCourse.php", formData) 
                .then(function (response) {
                    let data = response.data;
                    //console.log(data);

                    if (data.status === 1) {
                        $("#target").empty();
                        let course = data.data_course;
                        let reloadCodes = "";
                        let count = 1;

                        // 判斷頁碼
                        let listNumber = $("#listNumber").val(); // 一頁顯示數量
                        let dataLength = course.length; // 總共拿到多少資料
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
                                        <input type="checkbox" class="select" data-courseid="${course[i].id}">
                                    </td>
                                    <td> ${course[i].course_name} </td>
                                    <td> ${course[i].firm_name} </td>
                                    <td> ${course[i].area_name} </td>
                                    <td> ${course[i].created_time} </td>
                                    <td class="text-center" style="width: 150px;">
                                        <button  data-id="${course[i].id}" class="btn btn-primary text-white batch-btn">增減梯次</button>
                                    </td>
                                    <td class="text-end" style="width: 150px;">
                                        <button data-id="${course[i].id}" class="btn btn-primary text-white info-btn"><i class="fas fa-clipboard-list"></i></button>
                                        <button data-id="${course[i].id}" class="btn btn-warning text-white edit-btn"><i class="fas fa-edit"></i></button>
                                        <button data-id="${course[i].id}" class="btn btn-danger text-white delete-btn"><i class="fas fa-trash"></i></button>
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
        }
        // loading 梯次
        function loadBatch() {
            let formData = new FormData();
                formData.append("course_id", id);
                axios.post("../API/doLoadBatch.php", formData)  // 丟入/API/user.php抓當前id的資料
                    .then(function (response) {
                        let data = response.data;
                        //console.log(data);
                        if(data.status === 1) {
                            let batchCode = "";
                            data.data_batch.forEach((batch) => {
                                batchCode += `
                                <tr>
                                    <td class="text-center">
                                        <span id="batch-date">${batch.batch_date}</span>
                                        <button id="batchDeleteBtn" type="button" class="btn-close" data-courseid="${batch.course_id}" data-batchdate="${batch.batch_date} "></button>
                                    </td>
                                </tr>
                                `
                            });
                            $("#batchTarget").empty();
                            $("#batchTarget").append(batchCode);
                        } else {
                            //alert(data.message)
                            $("#batchTarget").empty();
                            //$("#batchTarget").append(batchCode);
                        }
                    })
                    .catch(function (error) {
                        console.log("error happend!");
                        console.log(error);
                    });
        }

        // 先將資料跑出來一次
        loadData();

        // reload btn click
        $("#reload").click(function() {
            loadData();
        })
        

        // 行程資訊
        $("#target").on("click", ".info-btn", function(){
            let id = $(this).data("id");
            let formData = new FormData();
                formData.append("id", id);
                axios.post("../API/getCourseInfo.php", formData)  // 丟入/API/user.php抓當前id的資料
                    .then(function (response) {
                    //console.log(response.data.data);
                        if(response.data.status === 1) {
                            $("#course-name").text(response.data.data_course.course_name);
                            $("#firm_name").text(response.data.data_course.firm_name);
                            $("#course_category").text(response.data.data_course.category_name);
                            $("#course_area").text(response.data.data_course.area_name);
                            $("#course_price").text(response.data.data_course.price);
                            $("#course_caution").text(response.data.data_course.caution);
                        } else {
                            alert(response.data.message)
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            courseInfo.show();
        })


        // 梯次編輯視窗
        $("#target").on("click", ".batch-btn", function(){
            id = $(this).data("id");
            batchInfo.show();
            loadBatch()
        })

        // 梯次新增
        $("#insertBatch").on("click", function(){
            //console.log(id);
            let batch_date = $("#batch_date").val();
            //console.log(batch_date);
            let formData = new FormData();
                formData.append("id", id);
                formData.append("batch_date", batch_date);
                axios.post("../API/doBatchInsert.php", formData)  // 丟入/API/user.php抓當前id的資料
                    .then(function (response) {
                        let data = response.data;
                        //console.log(response);

                        if(data.status === 1) {
                            //alert(data.message);
                            loadBatch()
                        } else {
                            //console.log(data.message);
                            alert("此梯次日期已經存在！")
                        }
                    })
                    .catch(function (error) {
                        //console.log("error happend!");
                        //console.log(error);
                    });
        })
        // 送出梯次刪除
        $("#batchTarget").on("click", "#batchDeleteBtn", function() {
            let course_id = $(this).data("courseid");
            let batch_date = $(this).data("batchdate").trim();
            //console.log(course_id, batch_date);
            //console.log($(this));
            let formData = new FormData();
                formData.append("course_id", course_id );
                formData.append("batch_date", batch_date);
                axios.post("../API/doBatchDelete.php", formData)  // 丟入/API/user.php抓當前id的資料
                    .then(function (response) {
                        //console.log(response);
                        let data = response.data;
                        if (data.status === 1) {
                            alert(data.message);
                            loadBatch()
                        } else {
                            console.log(data.message);
                            alert("沒有刪除成功欸ㄏㄏ！")
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
        })



        // 行程資訊編輯
        $("#target").on("click", ".edit-btn", function(){
            let id = $(this).data("id");
            // console.log(id);
            // courseEdit.show();
            // return;
            let formData = new FormData();
                formData.append("id", id);
                axios.post("../API/getCourseInfo.php", formData)  // 丟入/API/user.php抓當前id的資料
                    .then(function (response) {
                    let data = response.data;
                        //console.log(data);
                        //return;
                        if(data.status === 1) {
                        $("#course_id").val(data.data_course.id);
                        $("#firm").val(data.data_course.firm_name);
                        $("#category_id").val(data.data_course.category_id);
                        $("#area_id").val(data.data_course.area_id);
                        $("#course_name").val(data.data_course.course_name);
                        $("#price").val(data.data_course.price);
                        $("#prevFile").val(data.data_course.course_detail);
                        $("#prevImageFile").val(data.data_course_image.image_name);
                        $("#caution").val(data.data_course.caution);

                        } else {
                        alert(data.message)
                        }
                    })
                    .catch(function (error) {
                    console.log(error);
                    });
            //console.log($(".modal-content").scrollTop());
            courseEdit.show();
        })



        // 送出行程資訊編輯的資料
        $("#doCourseEdit").click(function() {
        $("#courseEditForm").submit();
        })

        // 行程資訊刪除
        $("#target").on("click", ".delete-btn", function(){
            id = $(this).data("id");
            courseDelete.show();
        })

        // 送出行程資訊刪除
        $("#courseDeleteBtn").click(function() {
            //console.log(id);
            let formData = new FormData();
                formData.append("id", id);
                axios.post("../API/doCourseDelete.php", formData)  // 丟入/API/user.php抓當前id的資料
                    .then(function (response) {
                        //console.log(response);
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