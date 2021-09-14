<?php
require_once ("PDO-Connect_order.php");

$id = $_GET["id"];
$valid=1;


try{
//// 將data 存入 order_id
    $sql_order_id = "update order.order_id set valid=0 where id=?";
    $stmt_order_id = $order_db_host -> prepare($sql_order_id);
    $stmt_order_id -> execute([$id]);

}
catch(PDOException $e){
    $_SESSION["error_msg"] = "Error:".$e->getMessage();
    echo "寫入失敗<br>";
    echo "Error:".$e->getMessage();
    exit;
}
$db_host=null;

header("location:orderlist.php");

