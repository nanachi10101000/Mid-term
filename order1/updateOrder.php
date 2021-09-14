<?php
require_once ("PDO-Connect_order.php");


//if(!isset($_POST["name"])){
//    echo"請輸入資料";
//    exit();
//}
$order_id=$_POST["order_id"];
//$client_id=$_POST["client_id"];
$course_id=$_POST["course_id"];
$batch_date=$_POST["batch_date"];
$number_of_people=$_POST["number_of_people"];

//$sql="INSERT INTO product (name,content,created_at,valid)
//VALUES('$name','$content','$now','1')";





try{
//// 將data 存入 order_id
//    $sql_order_id = "update order.order_id set client_id=? where id=?";
//    $stmt_order_id = $order_db_host -> prepare($sql_order_id);
//    $stmt_order_id -> execute([$client_id,$id]);
//    $lastId = $order_db_host -> lastInsertId();


// 將data 存入 order_id_detail
    $sql_order_id_detail= "update order.order_id_detail set course_id=?,batch_date=?,number_of_people=? where order_id=?";
    $stmt_order_id_detail = $order_db_host  -> prepare($sql_order_id_detail);
    $stmt_order_id_detail -> execute([$course_id,$batch_date,$number_of_people, $order_id]);

    $_SESSION["success_msg"] = "修改成功";
}
catch(PDOException $e){
    $_SESSION["error_msg"] = "Error:".$e->getMessage();
    echo "寫入失敗<br>";
    echo "Error:".$e->getMessage();
    exit;
}
$db_host=null;

header("location:orderlist.php");

