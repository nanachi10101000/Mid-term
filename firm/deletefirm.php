<?php
require_once("./PDO-Connect_firm.php");

$id=$_GET["id"];

try {
    $sql="UPDATE firm_information SET valid=0 WHERE id=?";
    $stmt_firm = $db_host->prepare($sql);
    $stmt_firm->execute([$id]);
    echo "修改成功<br>";
    echo $id;

}catch (PDOException $e) {
    echo "修改失敗<br>";
    echo "Error: " . $e->getMessage();
    exit;
}
$db_host = NULL;
header("location: firm-list.php");