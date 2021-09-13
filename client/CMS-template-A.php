<?php
require_once ("css.php");
require_once("CMStemplateAcss.php");
require_once ("../partials/nav-bar/sidebar.php");
?>

<!doctype html>
<html lang="en">
<head>
    <title>client_list</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<body>
<div class="page_box">
    <div class="title display-6 text-start fw-bold">
        顧客管理
    </div>
    <div class="sorting d-flex justify-content-between">
        <div id="dropdown" class="dropdown d-flex justify-content-between">
            <h5 class="me-2">筆數</h5>
            <select name="list_number" id="list_number" class="dropdown_list">
                    <option value="5" class="dropdown_list">5</option>
                    <option value="10" class="dropdown_list">10</option>
            </select>
        </div>
        <div>
            <div class="search">
                <input type="text" class="searchTerm" placeholder=搜尋>
                <button type="submit" class="searchButton">
                    <i class="fa fa-search"></i>
                </button>
            </div>
        </div>
    </div>
    <div id="table_wrap">
        <table class="table">
            <thead class="table_head fs-6 fw-bold">
            <tr class="fs-6 fw-bold">
            <th>姓名</th>
            <th>信箱地址</th>
            <th>密碼</th>
            <th>身分證字號</th>
            <th>性別</th>
            <th>出生日期</th>
            <th>地址</th>
            <th>電話號碼</th>
            <th>操作</th>
            </tr>
            </thead>
            <tbody class="fs-6" id="target">

            </tbody>
        </table>
    </div>
    <!-- page change button -->
    <div class="container" id="page_button">
    </div>
    <div class="simplePagination_box d-flex justify-content-center align-items-center"><div id="simplePagination" class="px-0 py-2"></div></div>
    <!-- imformation text -->
    <div class="container info-text">
    </div>
    <!-- user update -->
    <div id="update">
        <form action="doupdate.php" method="post">
            <div class="modal fade" id="user_update" tabindex="-1" aria-labelledby="user_update_Label" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="user_update_Label">修改資料</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-12">
                                <input type="hidden" name="id" id="update_id">
                                <div class="mb-2">
                                    <label for="">姓名</label>
                                    <input type="text" class="form-control" name="name" id="update_name">
                                </div>
                                <div class="mb-2">
                                    <label for="">信箱地址</label>
                                    <input type="email" class="form-control" name="email" id="update_email">
                                </div>
                                <div class="mb-2">
                                    <label for="">密碼</label>
                                    <input type="text" class="form-control" name="password" id="update_password">
                                </div>
                                <div class="mb-2">
                                    <label for="">身分證字號</label>
                                    <input type="text" class="form-control" name="id_number" id="update_id_number">
                                </div>
                                <div class="mb-2">
                                    <label for="">性別</label>
                                    <select class="form-select" name="gender" id="update_gender">
                                        <option id="male" value="1">男</option>
                                        <option id="female" value="0">女</option>
                                    </select>
                                </div>
                                <div class="mb-2">
                                    <label for="">出生日期</label>
                                    <input type="date" class="form-control" name="birth" id="update_birth">
                                </div>
                                <div class="mb-2">
                                    <label for="">住址</label>
                                    <input type="text" class="form-control" name="address" id="update_address">
                                </div>
                                <div class="mb-2">
                                    <label for="">電話號碼</label>
                                    <input type="text" class="form-control" name="telephone" id="update_telephone">
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">關閉</button>
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">確認修改</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!--uder delete -->
    <div id="delete">
        <form action="dodelete.php" method="post">
            <div class="modal fade" id="user_delete" tabindex="-1" aria-labelledby="user_delete_Label" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="user_delete_Label">刪除資料</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-12 text-left">
                            <input type="hidden" name="id" id="delete_id">
                                <table>
                                    <tbody>
                                        <tr><td><p>姓名：</p></td><td><p id="delete_name"></p></td></tr>
                                        <tr><td><p>信箱：</p></td><td><p id="delete_email"></p></td></tr>
                                        <tr><td><p>密碼：</p></td><td><p id="delete_password"></p></td></tr>
                                        <tr><td><p>身分證字號：</p></td><td><p id="delete_id_number"></p></td></tr>
                                        <tr><td><p>性別：</p></td><td><p id="delete_gender"></p></td></tr>
                                        <tr><td><p>出生日期：</p></td><td><p id="delete_birth"></p></td></tr>
                                        <tr><td><p>地址：</p></td><td><p id="delete_address"></p></td></tr>
                                        <tr><td><p>電話號碼：</p></td><td><p id="delete_telephone"></p></td></tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">關閉</button>
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">確認刪除</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    $("#dropdown li a").click(function(){
        $(this).parent().parent().find("a").removeClass("active");
        $(this).addClass("active");
        let text=$(this).text();
        $(this).parent().parent().prev().text(text);
    })
    let row=null;
    let page=1;
    let item_number=$("#list_number").val()
    // do update
    $("#target").on("click", ".info-btn", function () {
        let id = $(this).data("id");
        let name = $(`#name_${id}`).text().trim();
        let email = $(`#email_${id}`).text().trim();
        let password = $(`#password_${id}`).text().replace(/\s+/g, "");
        let id_number = $(`#id_number_${id}`).text().trim();
        let gender = $(`#gender_${id}`).text().trim();
        if(gender=="男")
        gender=1;
        else
        gender=0;
        let birth =$(`#birth_${id}`).text();
        let address = $(`#address_${id}`).text().trim();
        let telephone = $(`#telephone_${id}`).text().trim();
        $('#update_id').text(id);
        $('#update_id').val(id);
        $('#update_name').val(name);
        $('#update_email').val(email);
        $('#update_password').val(password);
        $('#update_id_number').val(id_number);
        $('#update_gender').val(gender);
        $('#update_birth').val(birth);
        $('#update_address').val(address);
        $('#update_telephone').val(telephone);
    })

    $("#update").on("click", ".btn-primary", function () {
        let id = $('#update_id').val();
        let name = $('#update_name').val();
        let email = $('#update_email').val();
        let password = $('#update_password').val();
        let id_number = $('#update_id_number').val();
        let gender = $('#update_gender').val();
        let birth = $('#update_birth').val();
        let address = $('#update_address').val();
        let telephone = $('#update_telephone').val();

        let formData = new FormData();
        formData.append("id", id);
        formData.append("name", name);
        formData.append("email", email);
        formData.append("password",password);
        formData.append("id_number", id_number);
        formData.append("gender", gender);
        formData.append("birth", birth);
        formData.append("address", address);
        formData.append("telephone", telephone);

        axios.post("doupdate.php", formData)
        .then(function () {

            creale_list()
            $(".info-text").empty()
            $(".info-text").append("修改成功");
        })
    })

    // do delete
    $("#target").on("click", ".edit-btn", function () {
        let id = $(this).data("id");
        let name = $(`#name_${id}`).text().trim();
        let email = $(`#email_${id}`).text().trim();
        let password = $(`#password_${id}`).text().replace(/\s+/g, "");
        let id_number = $(`#id_number_${id}`).text().trim();
        let gender = $(`#gender_${id}`).text().trim();
        if(gender==1)
        gender="男";
        else
        gender="女";
        let birth =$(`#birth_${id}`).text();
        birth=birth.slice(1,-1);
        let address = $(`#address_${id}`).text().trim();
        let telephone = $(`#telephone_${id}`).text().trim();
        $('#delete_id').val(id);
        $('#delete_name').html(name);
        $('#delete_email').html(email);
        $('#delete_password').html(password);
        $('#delete_id_number').html(id_number);
        $('#delete_gender').html(gender);
        $('#delete_birth').html(birth);
        $('#delete_address').html(address);
        $('#delete_telephone').html(telephone);
    })

    $("#delete").on("click", ".btn-primary", function () {
        let id = $('#delete_id').val();
        let formData = new FormData();
        formData.append("id", id);
        axios.post("dodelete.php", formData)
        .then(function () {
            page=1;
            creale_list()
            $(".info-text").empty()
            $(".info-text").append("刪除成功");
        })
    })



    // create list
    function creale_list() {
        axios.post("get_users_json.php")
        .then(function (response){
            let data = response.data;
            $("#target").empty();
            $("#page_button").empty();
            let list = "";
            row=data;
            for (let i = (page-1)*item_number+1; i<=page*item_number; i++) {
                user=data[i-1];
                if(typeof user =='undefined')
                    break;
                if(user.gender==1)
                    user.gender="男";
                else
                    user.gender="女";
                list+=`<tr id="list">
                <td id='name_${user.id}'>${user.client_name}</td>
                <td id='email_${user.id}'>${user.email}</td>
                <td id='password_${user.id}'>${user.password}</td>
                <td id='id_number_${user.id}'>${user.id_number}</td>
                <td id='gender_${user.id}'>${user.gender}</td>
                <td id='birth_${user.id}'>${user.birth}</td>
                <td id='address_${user.id}'>${user.address}</td>
                <td id='telephone_${user.id}'>${user.telephone}</td>
                <td class="text-end" style="width: 150px;">
                    <button data-id="${user.id}" class="btn btn-primary text-white info-btn" data-bs-toggle="modal" data-bs-target="#user_update">修改</button>
                    <button data-id="${user.id}" class="btn btn-danger text-white edit-btn" data-bs-toggle="modal" data-bs-target="#user_delete">刪除</button>
                </td></tr>`;
                $("#target").append(list);
                list = "";
            }

            let page_number=Math.ceil( row.length / $("#list_number").val());
            $("#simplePagination").pagination({
                items: row.length,
                itemsOnPage: $("#list_number").val(),
                cssStyle: 'light-theme',
                currentPage:page,
                displayedPages:10
            });
        })
    }
    creale_list();

    // change page
    $("#simplePagination").on("click", function () {
    let list = "";
    page=$(".active .current").text();
    console.log(page);
    let item_start=(page-1)*$("#list_number").val()+1;
    let item_end=page*$("#list_number").val();
    $("#target").empty();
    $(".info-text").empty();
    for (; item_start<=item_end; item_start++) {
            user=row[item_start-1];
            if(typeof user =='undefined')
            break;
            if(user.gender==1 || user.gender=="男")
                user.gender="男";
            else
                user.gender="女";
            list+=`<tr id="list">
            <td id='name_${user.id}'>${user.client_name}</td>
            <td id='email_${user.id}'>${user.email}</td>
            <td id='password_${user.id}'>${user.password}</td>
            <td id='id_number_${user.id}'>${user.id_number}</td>
            <td id='gender_${user.id}'>${user.gender}</td>
            <td id='birth_${user.id}'>${user.birth}</td>
            <td id='address_${user.id}'>${user.address}</td>
            <td id='telephone_${user.id}'>${user.telephone}</td>
            <td class="text-end" style="width: 150px;">
                <button data-id="${user.id}" class="btn btn-primary text-white info-btn" data-bs-toggle="modal" data-bs-target="#user_update">修改</button>
                <button data-id="${user.id}" class="btn btn-danger text-white edit-btn" data-bs-toggle="modal" data-bs-target="#user_delete">刪除</button>
            </td></tr>`;
            $("#target").append(list);
            list = "";
        }
    })

    // change list number
    $("#list_number").on("change", function () {
        let list = "";
        let item_end=$(this).val();
        let page=1;
        item_number=$(this).val();
        $("#target").empty();
        $(".info-text").empty();
        for (let item_start=1; item_start<=item_end; item_start++) {
                user=row[item_start-1];
                if(typeof user =='undefined')
                break;
                if(user.gender==1 || user.gender=="男")
                    user.gender="男";
                else
                    user.gender="女";
                list+=`<tr id="list">
                <td id='name_${user.id}'>${user.client_name}</td>
                <td id='email_${user.id}'>${user.email}</td>
                <td id='password_${user.id}'>${user.password}</td>
                <td id='id_number_${user.id}'>${user.id_number}</td>
                <td id='gender_${user.id}'>${user.gender}</td>
                <td id='birth_${user.id}'>${user.birth}</td>
                <td id='address_${user.id}'>${user.address}</td>
                <td id='telephone_${user.id}'>${user.telephone}</td>
                <td class="text-end" style="width: 150px;">
                    <button data-id="${user.id}" class="btn btn-primary text-white info-btn" data-bs-toggle="modal" data-bs-target="#user_update">修改</button>
                    <button data-id="${user.id}" class="btn btn-danger text-white edit-btn" data-bs-toggle="modal" data-bs-target="#user_delete">刪除</button>
                </td></tr>`;
                $("#target").append(list);
                list = "";
            }

        // update page button 
        let page_number=Math.ceil( row.length / $("#list_number").val());
        $("#simplePagination").pagination({
            items: row.length,
            itemsOnPage: $("#list_number").val(),
            cssStyle: 'light-theme'
        });
    })
</script>  
</div>
</body>
</html>