<?php
require_once ("../DB-Connect/PDO-Connect_courses.php");
require_once ("../DB-Connect/PDO-Connect_client.php");
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


require_once ("css.php");
require_once ("js.php");
require_once("CMStemplateAcss.php");
require_once("../partials/nav-bar/sidebar.php");
require_once("../partials/nav-bar/sidebarCSS.php");
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
                <div class="mb-2">
                    <label for="">會員編號</label>
                    <input list="client_list" class="form-control" type="text" name="client_id">
                    <datalist id="client_list">
                        <?php foreach($rows_client as $clientVal): ?>
                            <option value="<?= $clientVal["id"] ?>"><?= $clientVal["email"] ?></option>
                        <?php endforeach;?>
                    </datalist>
                </div>
                <div class="mb-2">
                    <label for="">課程編號</label>
                    <input list="course_list" id="course_id" class="form-control" type="text" name="course_id">
                    <datalist id="course_list">
                        <?php foreach($rows_course as $courseVal): ?>
                            <option value="<?= $courseVal["id"] ?>"><?= $courseVal["course_name"] ?></option>
                        <?php endforeach;?>
                    </datalist>
                </div>
                <div class="mb-2">
                    <label for="">梯次</label>
                    <select class="form-select" name="batch_date" id="batch_date">
                        <!-- <option value="2021/09/09">2021/09/09</option>
                        <option value="2021/09/10">2021/09/10</option>
                        <option value="2021/09/11">2021/09/11</option> -->
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
<script>
    $("#course_id").on("change", function () {
        let course_id = $(this).val();
        let formData = new FormData();
            formData.append("course_id", course_id);
            axios.post("../API_order/getBatchInfo.php", formData)  
                .then(function (response) {
                let data = response.data;
                console.log(data.data_batch);
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