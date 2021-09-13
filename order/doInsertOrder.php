<?php
require_once ("PDO-Connect_order.php");

//if(!isset($_POST["name"])){
//    echo"請輸入資料";
//    exit();
//}

$client_id=$_POST["client_id"];
$course_id=$_POST["course_id"];
$batch_date=$_POST["batch_date"];
$number_of_people=$_POST["number_of_people"];
$now=date('Y-m-d H:i:s');
$valid=1;

//$sql="INSERT INTO product (name,content,created_at,valid)
//VALUES('$name','$content','$now','1')";





try{
// 將data 存入 order_id
    $sql_order_id = "INSERT INTO order.order_id (client_id, created_time,valid) VALUES (?,?,?)";
    $stmt_order_id = $order_db_host -> prepare($sql_order_id);
    $stmt_order_id -> execute([$client_id, $now,1]);
    $lastId = $order_db_host -> lastInsertId();


// 將data 存入 order_id_detail
    $sql_order_id_detail= "INSERT INTO order.order_id_detail (order_id,course_id,batch_date,number_of_people,valid ) VALUES (?,?,?,?,?)";
    $stmt_order_id_detail = $order_db_host  -> prepare($sql_order_id_detail);
    $stmt_order_id_detail -> execute([$lastId, $course_id,$batch_date,$number_of_people,1]);
}
catch(PDOException $e){
    echo "寫入失敗<br>";
    echo "Error:".$e->getMessage();
    exit;
}
$db_host=null;

header("location:orderlist.php");

