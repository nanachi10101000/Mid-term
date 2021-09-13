<?php
//require_once ("../wonderful/PDO-Connect_order.php");
//$sql="SELECT * FROM order.order_id where valid=1 ";
//$stmt=$order_db_host->prepare($sql);
//$stmt->execute();
//$rows=$stmt->fetchAll(PDO::FETCH_ASSOC);
//$dataCount=$stmt->rowCount();
//print_r($rows);
//
require_once ("css.php");
require_once("CMStemplateAcss.php");
require_once("../partials/nav-bar/sidebar.php")
?>

<!doctype html>
<html lang="en">
<head>
    <title>ordercreat</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<body>
<div class="container">
    <div class="title display-6 text-center fw-bold">
        新增訂單
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <form action="doInsertOrder.php" method="post">
<!--                <div class="mb-2">-->
<!--                    <label for="">分類</label>-->
<!--                    <select class="form-select" name="category_id" id="">-->
<!--                        --><?php //foreach ($rows as $value): ?>
<!--                            <option value="--><?//=$value["id"]?><!--">--><?//=$value["name"]?><!--</option>-->
<!--                        --><?php //endforeach; ?>
<!--                    </select>-->
<!--                </div>-->
                <div class="mb-2">
                    <label for="">會員編號</label>
                    <input class="form-control" type="text" name="client_id">
                </div>
                <div class="mb-2">
                    <label for="">課程編號</label>
                    <select class="form-select" name="course_id" id="">
                        <option value="課邊course1">課邊course1</option>
                        <option value="課邊course2">課邊course2</option>
                        <option value="課邊course3">課邊course3</option>
                        <option value="課邊course4">課邊course4</option>
                    </select>
                </div>
                <div class="mb-2">
                    <label for="">梯次</label>
                    <select class="form-select" name="batch_date" id="">
                        <option value="2021/09/09">2021/09/09</option>
                        <option value="2021/09/10">2021/09/10</option>
                        <option value="2021/09/11">2021/09/11</option>
                    </select>
                </div>
                <div class="mb-2">
                    <label for="">人數</label>
                    <input type="text" class="form-control" name="number_of_people">
                </div>
<!--                <div class="mb-2">-->
<!--                    <label for="">費用</label>-->
<!--                   自動算出-->
<!--                    <input type="text" class="form-control" name="price">-->
<!--                </div>-->

                <button class="btn btn-primary" type="submit">送出</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>