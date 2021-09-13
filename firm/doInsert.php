<!--格式錯誤或資料未輸入時跳轉回insert-firm.php-->
<script>
    setTimeout("window.location.href = 'firm-list.php'",3000);
</script>

<?php
require_once("./PDO-Connect_firm.php");
//檢查Email格式
if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    echo 'Email 格式錯誤 (Invalid email format) <br><br>';
    echo '等待跳轉';
    exit();

}
//檢查有無輸入資料
if (strlen($_POST["email"]) <= 0 || strlen($_POST["password"]) <= 0 || strlen($_POST["firm_name"]) <= 0
    || strlen($_POST["contact_person"]) <= 0 || strlen($_POST["telephone"])<= 0 || strlen($_POST["address"]) <= 0  ) {
    echo "有資料未輸入<br><br>";
    echo '等待跳轉';
    exit();
}

$email = $_POST["email"];
$password=md5($_POST["password"]);
$firm_name = $_POST["firm_name"];
$contact_person = $_POST["contact_person"];
$telephone = $_POST["telephone"];
$address = $_POST["address"];
$now = date('Y-m-d H:i:s');
$valid = 1;

try {
    $sql = "INSERT INTO firm_information(email, password, firm_name, contact_person, telephone, address,created_time,valid)
	VALUES (?, ?, ?, ?, ?, ?, ?,?)";
    $stmt_firm = $db_host->prepare($sql);
    $stmt_firm->execute([$email, $password, $firm_name, $contact_person, $telephone, $address, $now,$valid]);
    $id=$db_host->lastInsertId(); //取得最新一筆資料的 id
    echo "寫入成功<br>";
    echo "等待跳轉";
} catch (PDOException $e) {
    echo "寫入失敗<br>";
    echo "Error: " . $e->getMessage();
    echo $email;
    exit;
}

//$db_host = NULL;
//header("location:firm-edit.php?id=".$id);

?>
<!--寫入成功時跳轉回irm-list.php-->
<script>
    setTimeout("window.location.href = 'firm-list.php'",3000);
</script>


