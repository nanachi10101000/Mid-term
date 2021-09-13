<script>
    setTimeout("window.location.href = 'firm-list.php'",1000 );
</script>
<?php
require_once("./PDO-Connect_firm.php");
//檢查Email格式
if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    echo 'Email格式錯誤，改修失敗<br><br>';
    echo '等待跳轉';
    exit();
}
//檢查有無輸入資料
if (strlen($_POST["email"]) <= 0 || strlen($_POST["firm_name"]) <= 0
    || strlen($_POST["contact_person"]) <= 0 || strlen($_POST["telephone"])<= 0 || strlen($_POST["address"]) <= 0  ) {
    echo "有資料未輸入，改修失敗<br><br>";
    echo '等待跳轉';
    exit();
}

$id=$_POST["id"];
$email = $_POST["email"];
$firm_name = $_POST["firm_name"];
$contact_person = $_POST["contact_person"];
$telephone = $_POST["telephone"];
$address = $_POST["address"];

if(!isset($_POST["password"])){
    try {
        $sql = "UPDATE firm_information SET email=?, firm_name=?, contact_person=?, telephone=?, address=? WHERE id=?";
        $stmt_firm = $db_host->prepare($sql);
        $stmt_firm->execute([$email, $firm_name, $contact_person,$telephone,$address, $id]);

        echo "修改成功<br>";
        echo "等待跳轉";

    }catch (PDOException $e) {
    echo "修改失敗<br>";
    echo "Error: " . $e->getMessage();
    exit;
}
} else {
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    if(strlen($_POST["password"]) <= 0){
        echo "有資料未輸入，改修失敗<br><br>";
        echo '等待跳轉';
        exit();
    }else
    try {
        $sql = "UPDATE firm_information SET email=?, password=?, firm_name=?, contact_person=?, telephone=?, address=? WHERE id=?";
        $stmt_firm = $db_host->prepare($sql);
        $stmt_firm->execute([$email, $password, $firm_name, $contact_person,$telephone,$address, $id]);

        echo "修改成功<br>";
        echo "等待跳轉";


    }catch (PDOException $e) {
        echo "修改失敗<br>";
        echo "Error: " . $e->getMessage();
        exit;
    }
}


//$db_host = NULL;
//header("location: firm-edit.php?id=".$id);

