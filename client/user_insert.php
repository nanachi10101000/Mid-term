<?php
require_once("dbconnect/pdo_connect_client.php");
$sql="SELECT * FROM category";
$stmt = $db_host->prepare($sql);
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Insert Product</title>
    <?php require_once ("css.php") ?>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <form action="doInsert.php" method="post">
                    <div class="mb-2">
                        <label for="">姓名</label>
                        <input type="text" class="form-control" name="name">
                    </div>
                    <div class="mb-2">
                        <label for="">信箱地址</label>
                        <input type="email" class="form-control" name="email">
                    </div>
                    <div class="mb-2">
                        <label for="">密碼</label>
                        <input type="password" class="form-control" name="password">
                    </div>
                    <div class="mb-2">
                        <label for="">身分證字號</label>
                        <input type="text" class="form-control" name="id_number">
                    </div>
                    <div class="mb-2">
                        <label for="">性別</label>
                        <select class="form-select" name="gender" id="">
                            <option value="1">男</option>
                            <option value="0">女</option>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label for="">出生日期</label>
                        <input type="date" class="form-control" name="birth">
                    </div>
                    <div class="mb-2">
                        <label for="">住址</label>
                        <input type="text" class="form-control" name="address">
                    </div>
                    <div class="mb-2">
                        <label for="">電話號碼</label>
                        <input type="text" class="form-control" name="telephone">
                    </div>
                    <button class="btn btn-primary" type="submit">送出</button>
                </form>
                <button class="btn btn-primary mt-2" onclick="window.history.back();">回上一頁</button>
            </div>
        </div>
    </div>
</body>
</html>