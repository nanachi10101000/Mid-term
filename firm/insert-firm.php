<?php
require_once("./PDO-Connect_firm.php");
require_once("css.php");
require_once("CMStemplateAcss.php");
require_once("../partials/nav-bar/sidebar.php");

$sql="SELECT * FROM firm_information";
$stmt_firm = $db_host->prepare($sql);
$stmt_firm->execute();
$rows = $stmt_firm->fetchAll(PDO::FETCH_ASSOC);

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Insert Firm</title>

</head>
<style>
    body{
        background: #F9F1EE;
    }
</style>
<body>

<div class="page_box">
    <div class="title display-6 text-start fw-bold">
        新增廠商
    </div>
<div class="container">
    <div class="row justify-content-center">
        <div class="py-2">

        </div>
        <div class="col-lg-6">
            <form name="firm" action="doInsert.php" method="post">
                <div class="mb-2">
                    <label for="">email</label>
                    <input type="text" class="form-control" name="email" >
                </div>
                <div class="mb-2">
                    <label for="">password</label>
                    <input type="password" class="form-control" name="password">
                </div>
                <div class="mb-2">
                    <label for="">公司名稱</label>
                    <input type="text" class="form-control" name="firm_name">
                </div>
                <div class="mb-2">
                    <label for="">負責人</label>
                    <input type="text" class="form-control" name="contact_person">
                </div>
                <div class="mb-2">
                    <label for="">連絡電話</label>
                    <input type="tel" class="form-control" name="telephone" maxlength="10" oninput="value=value.replace(/[^\d]/g,'')">
                    <!--                    //只能輸入數字-->
                </div>
                <div class="mb-2">
                    <label for="">公司地址</label>
                    <input type="text" class="form-control" name="address">
                </div>

                <!--                <button class="btn btn-primary" type="submit" onClick="check()>送出</button>-->

                <button type="button" class="btn btn-primary" data-bs-toggle="modal"onClick="check()">
                    送出
                </button>

                <!--確認-->


            </form>

        </div>
    </div>
</div>
</div>
<script>
    function check(){
        if(firm.email.value =="" || firm.password.value =="" || firm.firm_name.value =="" || firm.contact_person.value =="" || firm.telephone.value =="" || firm.address.value =="")
        {
            alert("有資料未輸入哦！");
        }
        else {
            // alert("Email" + "：" + firm.email.value + "\n" +
            //     "公司名稱" + "：" + firm.firm_name.value + "\n" +
            // "負責人" + "：" + firm.contact_person.value + "\n" +
            // "連絡電話" + "：" + firm.telephone.value + "\n" +
            // "公司地址" + "：" + firm.address.value);
            firm.submit();
        }

    }
</script>

<script>
    //控制sidebar

    $(".a1").click(function () {
        window.location.href="firm-list.php";
    })
    $(".a2").click(function () {
        window.location.href="insert-firm.php";
    })

    $(".firm").attr("aria-expanded",true);
    $(".a2").addClass("active");
    $("#firm-collapse1").removeClass("collapse");
    // $(".firm").parent().parent().addClass("show");
    // $(".sa li").siblings().removeClass("active");
    // $(".firm").addClass("active");


</script>

</body>
</html>