<?php
require_once ("../DB-Connect/PDO-Connect_order.php");
//$sql_order_id="SELECT * FROM order.order_id where valid=1 ";
//$stmt_order_id=$order_db_host->prepare($sql_order_id);
//$stmt_order_id->execute();
//$rows_order_id=$stmt_order_id->fetchAll(PDO::FETCH_ASSOC);
//$dataCount_order_id=$stmt_order_id->rowCount();
//$sql_order_id_detail="SELECT * FROM order.order_id_detail where valid=1 ";
//$stmt_order_id_detail=$order_db_host->prepare($sql_order_id_detail);
//$stmt_order_id_detail->execute();
//$rows_order_id_detail=$stmt_order_id_detail->fetchAll(PDO::FETCH_ASSOC);
//$dataCount_order_id_detail=$stmt_order_id_detail->rowCount();
//print_r($rows);
//

$order_id = $_GET["id"];

$sql_order="SELECT order_id.*, order_id_detail.* 
            FROM order.order_id, order.order_id_detail
            WHERE order.order_id.id = order.order_id_detail.order_id
            AND order.order_id.id = ?
            AND order_id.valid = ?";
$stmt_order=$order_db_host->prepare($sql_order);
$stmt_order->execute([$order_id, 1]);
$rows_order=$stmt_order->fetchAll(PDO::FETCH_ASSOC);
$dataCount_order=$stmt_order->rowCount();

//var_dump($rows_order);

require_once ("css.php");
require_once("CMStemplateAcss.php");
require_once("../partials/nav-bar/sidebar.php");
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
                詳細訂單資訊
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
                        <a class="dropdown_list btn fw-bolder h4" href="orderlist.php">回到訂單列表</a>
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
<!--序號 訂單編號 課程編號 課程名稱  梯次 人數 費用 會員編號 會員名稱-->
                    <th>序號</th>
                    <th>訂單編號</th>
                    <th>會員編號</th>
                    <th>課程名稱</th>
                    <th>梯次</th>
                    <th>人數</th>
                </tr>
                </thead>
                <tbody class="fs-6">
                <?php foreach ($rows_order as $value){ ?>
                <tr>
                    <!--序號 訂單編號 課程編號 課程名稱  梯次 人數 費用 會員編號 會員名稱-->
                    <td>1</td>
                    <td><?=$value["order_id"]?></td>
                    <td><?=$value["client_id"]?></td>
                    <td><?=$value["course_id"]?></td>
                    <td><?=$value["batch_date"]?></td>
                    <td><?=$value["number_of_people"]?></td>


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