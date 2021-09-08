<?php
require_once ("css.php");
require_once ("js.php");
require_once ("./partials/nav-bar/sidebar.php")
?>

<!doctype html>
<html lang="en">
<head>
    <title>CMS-template-A</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<body>
<div class="page_box">
            <div class="title display-6 text-start fw-bold">
                廠商管理
            </div>

            <div class="sorting d-flex justify-content-between">

                <div>
                    <div id="dropdown" class="dropdown">
                        <button id="dropdown_list" class="dropdown_list btn dropdown-toggle fw-bolder h4" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            依公司編號排序
                        </button>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdown_list">
                            <li><a id="dropdown-item" class="dropdown-item active" href="#">依公司編號排序</a></li>
                            <li><a id="dropdown-item" class="dropdown-item" href="#">依公司名稱排序</a></li>
                            <li><a id="dropdown-item" class="dropdown-item" href="#">依聯絡人排序</a></li>
                            <!--<li><hr class="dropdown-divider"></li>-->
                        </ul>



                        <button id="dropdown_list" class="dropdown_list btn dropdown-toggle fw-bolder h4" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            升冪排列
                        </button>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdown_list">
                            <li><a class="dropdown-item active" href="#">升冪排列</a></li>
                            <li><a class="dropdown-item" href="#">降冪排列</a></li>
                            <!--                        <li><hr class="dropdown-divider"></li>-->
                        </ul>
                    </div>
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
                    <th>#</th>
                    <th>公司名稱</th>
                    <th>聯絡人</th>
                    <th>連絡電話</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody class="fs-6">

                <tr>
                    <td>1</td>
                    <td>英屬維京群島商玩得瘋股份有限公司台灣分公司</td>
                    <td>林奇毅</td>
                    <td>(02)2911-1234 #123</td>
                    <td><button id="" class="btn btn-info text-white mx-2">更多資訊</button></td>
                    <td><button id="delete" class="btn btn-danger text-white mx-2">刪除</button></td>
                </tr>
                </tbody>
            </table>
        </div>
    <div class="simplePagination_box d-flex justify-content-center align-items-center"><div id="simplePagination" class="px-0 py-2"></div></div>

    <script>
        $("#dropdown li a").click(function(){
            // console.log("click")
            $(this).parent().parent().find("a").removeClass("active");
            $(this).addClass("active");
            let text=$(this).text();
            $(this).parent().parent().prev().text(text);
        })
    </script>

    <script>
        $(function() {
            $("#simplePagination").pagination({
                items: 100,
                itemsOnPage: 10,
                cssStyle: 'light-theme'
            });
        });


    </script>

    <script>
        // $("#add").click(function(){
        //     let name=$("#name").val(), email=$("#email").val(), phone=$("#phone").val()
        //     if(name=="" || email=="" || phone==""){
        //         alert("資料未填完整");
        //         return;
        //     }

            // console.log(name)
        //     let newRow=`<tr>
        //                 <td>${name}</td>
        //                 <td>${email}</td>
        //                 <td>${phone}</td>
        //                 <td><button class="btn btn-danger btn-delete">delete</td>
        //             </tr>`;
        //     $("#target").prepend(newRow);
        //     $("#name, #email, #phone").val("");
        // })
        //
        // $("#target").on("click", ".btn-delete", function(){
        //     // console.log("click")
        //     $(this).closest("tr").remove();
        // })
    </script>
</div>
</body>
</html>