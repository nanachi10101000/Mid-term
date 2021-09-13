<?php
require_once ("PDO-Connect_order.php");
$sql="SELECT * FROM order.order_id where valid=1 ";
$stmt=$order_db_host->prepare($sql);
$stmt->execute();
$rows=$stmt->fetchAll(PDO::FETCH_ASSOC);
$dataCount=$stmt->rowCount();
//print_r($rows);
//
require_once ("css.php");
require_once("CMStemplateAcss.php");
require_once("../partials/nav-bar/sidebar.php")
?>

<!doctype html>
<html lang="en">
<head>
    <title>orderlist</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<body>
<div class="page_box">
            <div class="title display-6 text-start fw-bold">
                訂單管理
            </div>

            <div class="sorting d-flex justify-content-between">

                <div>
                    <div id="dropdown" class="dropdown">
                        <button id="dropdown_list" class="dropdown_list btn dropdown-toggle fw-bolder h4" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            依訂單編號排序
                        </button>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdown_list">
                            <li><a id="dropdown-item" class="dropdown-item active" href="#">依訂單編號排序</a></li>
<!--                            <li><a id="dropdown-item" class="dropdown-item" href="#">依訂單編號排序</a></li>-->
                            <li><a id="dropdown-item" class="dropdown-item" href="#">依訂單名稱排序</a></li>
                            <li><a id="dropdown-item" class="dropdown-item" href="#">依創立日期排序</a></li>
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
                        <a class="dropdown_list btn fw-bolder h4" href="orderinsert.php">新增訂單</a>
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

                    <th>序號</th>
                    <th>訂單編號</th>
                    <th>會員編號</th>
                    <th>課程數量</th>
                    <th>詳細資訊</th>
                    <th>編輯訂單</th>
                    <th>刪除訂單</th>
                </tr>
                </thead>
                <tbody class="fs-6">
                <?php foreach ($rows as $value){ ?>
                <tr>
                    <td>1</td>
                    <td><?=$value["id"]?></td>
                    <td><?=$value["client_id"]?></td>
                    <td>3</td>
                    <td><a class="btn btn-info text-white mx-2" href="order.php?id=<?=$value["id"]?>">閱覽</a></td>
                    <td><a class="btn btn-info text-white mx-2" href="orderEdit.php?id=<?=$value["id"]?>">編輯</a></td>
                    <td><a class="btn btn-danger text-white mx-2" href="orderDelete.php?id=<?=$value["id"]?>">刪除</a></td>
                </tr>
                <?php } ?>
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