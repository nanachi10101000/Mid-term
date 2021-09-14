<?php
require_once ("../DB-Connect/PDO-Connect_courses.php");
require_once ("../DB-Connect/PDO-Connect_client.php");
require_once ("../DB-Connect/PDO-Connect_order.php");

$order_id = $_GET["id"];


$sql_client="SELECT * FROM client.client_information 
        WHERE valid=1 ORDER BY client.client_information.id DESC";
$stmt_client=$client_db_host->prepare($sql_client);
$stmt_client->execute();
$rows_client=$stmt_client->fetchAll(PDO::FETCH_ASSOC);
// print_r($rows_client);

$sql_course="SELECT * FROM courses.course_information 
        WHERE valid=1 ORDER BY courses.course_information.id DESC";
$stmt_course=$client_db_host->prepare($sql_course);
$stmt_course->execute();
$rows_course=$stmt_course->fetchAll(PDO::FETCH_ASSOC);
//print_r($rows_course);

$sql="SELECT * FROM order.order_id_detail where order_id = ? AND valid=1 ";
$stmt=$order_db_host->prepare($sql);
$stmt->execute([$order_id]);
$rows=$stmt->fetchAll(PDO::FETCH_ASSOC);
$dataCount=$stmt->rowCount();
//print_r($rows);

$course_id = $rows[0]["course_id"];

$sql_batch="SELECT * FROM courses.batch 
        WHERE valid=1 AND courses.batch.course_id = ?";
$stmt_batch=$client_db_host->prepare($sql_batch);
$stmt_batch->execute([$course_id]);
$rows_batch=$stmt_batch->fetchAll(PDO::FETCH_ASSOC);
//print_r($rows_batch);

require_once ("css.php");
require_once ("js.php");
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
        編輯訂單
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <form action="updateOrder.php" method="post">
            <div>
            <input type="text" name="order_id" value="<?=$order_id?>" hidden>
            </div>    
                <div class="mb-2">
                    <!-- <label for="">會員編號</label>
                    <input list="client_list" class="form-control" type="text" name="client_id" value="">
                    <datalist id="client_list">
                        <?php foreach($rows_client as $clientVal): ?>
                            <option value="<?= $clientVal["id"] ?>"><?= $clientVal["email"] ?></option>
                        <?php endforeach;?>
                    </datalist> -->
                </div>
                <div class="mb-2">
                    <label for="">課程編號</label>
                    <select name="course_id" id="course_id" class="form-control">
                        <?php foreach($rows_course as $courseVal): ?>
                            <option value="<?= $courseVal["id"] ?>" 
                            <?php if($order_id == $courseVal["id"]) echo "selected" ?>
                            ><?= $courseVal["course_name"] ?></option>
                        <?php endforeach;?>
                    </select>
                </div>
                <div class="mb-2">
                    <label for="">梯次</label>
                    <select class="form-select" name="batch_date" id="batch_date">
                        <?php foreach($rows_batch as $batchVal): ?>
                            <option value="<?= $batchVal["batch_date"] ?>" 
                            <?php if($rows[0]["batch_date"] == $batchVal["batch_date"]) echo "selected" ?>
                            ><?= $batchVal["batch_date"] ?></option>
                        <?php endforeach;?>
                    </select>
                </div> 
                <div class="mb-2">
                    <label for="">人數</label>
                    <input type="text" class="form-control" name="number_of_people" value="<?= $rows[0]["number_of_people"] ?>">
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
<script>
    $("#course_id").on("change", function () {
        let course_id = $(this).val();
        let formData = new FormData();
            formData.append("course_id", course_id);
            axios.post("../API_order/getBatchInfo.php", formData)  
                .then(function (response) {
                let data = response.data;
                console.log(response);
                // return;
                let batchCode = "";
                    if(data.status === 1) {
                        data.data_batch.forEach((batch) => {
                            batchCode += `<option data-courseid="${batch.course_id}" value="${batch.batch_date}"> ${batch.batch_date} </option>`
                        })
                        $("#batch_date").empty();
                        $("#batch_date").append(batchCode);
                    } else {
                        $("#batch_date").empty();
                        alert(data.message)
                    }
                })
                .catch(function (error) {
                console.log(error);
                });
      })
</script>
</html>