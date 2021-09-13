<?php
require_once("PDO-Connect_firm.php");
require_once("css.php");
require_once("CMStemplateAcss.php");
require_once("../partials/nav-bar/sidebar.php");
ini_set('display_errors', 'off');

if (isset($_GET["sort"])) {
    if ($_GET["sort"] == 6) {
        $sql = "SELECT * FROM firm_information  WHERE valid=1 ORDER BY contact_person DESC";
    }else  if ($_GET["sort"] == 2){
        $sql = "SELECT * FROM firm_information  WHERE valid=1 ORDER BY id DESC";
    }
    else  if ($_GET["sort"] == 3){
        $sql = "SELECT * FROM firm_information  WHERE valid=1 ORDER BY firm_name ASC";
    }
    else  if ($_GET["sort"] == 4){
        $sql = "SELECT * FROM firm_information  WHERE valid=1 ORDER BY firm_name DESC";
    }
    else  if ($_GET["sort"] == 5){
        $sql = "SELECT * FROM firm_information  WHERE valid=1 ORDER BY contact_person ASC";
    }
    else {
        $sql = "SELECT * FROM firm_information  WHERE valid=1 ORDER BY id ASC";
    }
} else
{
    $sql = "SELECT * FROM firm_information  WHERE valid=1 ORDER BY id ASC";
//    $sql = "SELECT * FROM firm_information WHERE valid=1 AND firm_name LIKE '%".$_GET["search"]."%'";
}
if (isset($_GET["search"])) {
    $sql = "SELECT * FROM firm_information WHERE valid=1 AND firm_name LIKE '%".$_GET["search"]."%'";
}




//if (isset($_POST["page"])) {
//    if ($_POST["page"] == 1) {
//        $sql = "SELECT * FROM firm_information  WHERE valid=1 ORDER BY id DESC";
//    }
//    else  $sql = "SELECT * FROM firm_information  WHERE valid=1 ORDER BY id ASC ";
//
//} else  $sql = "SELECT * FROM firm_information  WHERE valid=1 ORDER BY id DESC";

$rs = $db_host-> query($sql);

$stmt_firm = $db_host -> prepare($sql);
$stmt_firm->execute();
$rows = $stmt_firm->fetchAll(PDO::FETCH_ASSOC);
$dataCount=$stmt_firm->rowCount();

//分頁設定
$per_total = $rs -> rowCount();  //計算總筆數
$per = 10;  //每頁筆數
$pages = ceil($per_total/$per);  //計算總頁數;ceil(x)取>=x的整數,也就是小數無條件進1法

if(!isset($_GET['page'])){  //!isset 判斷有沒有$_GET['page']這個變數
    $page = 1;
}else{
    $page = $_GET['page'];
}

$start = ($page-1)*$per;  //每一頁開始的資料序號(資料庫序號是從0開始)
$rs = $db_host -> query($sql.' LIMIT '.$start.', '.$per); //讀取選取頁的資料

$page_start = $start +1;  //選取頁的起始筆數
$page_end = $start + $per;  //選取頁的最後筆數
if($page_end>$per_total){  //最後頁的最後筆數=總筆數
    $page_end = $per_total;
}
?>

<!doctype html>
<html lang="en">
<head>
    <title>Firm-list</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<style>
    .modal-body input{
        width: 100%;
    }
    .modal-body button{
        width: 100%;
        margin: 0;
        padding: 0;
        border: none;
        background: none;
    }
</style>
<body>
<div class="page_box">
            <div class="title display-6 text-start fw-bold">
                廠商管理
                </div>

            <div class="sorting d-flex justify-content-between">
                <div>
                    <div id="dropdown" class="dropdown">
                        <button id="dropdown_list" class="dropdown_list btn dropdown-toggle fw-bolder h4" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                           <span>請選擇排列</span>
                        </button><br>
                        <?php
                        //每頁顯示筆數明細
                        echo '顯示 '.$page_start.' 到 '.$page_end.' 筆 共 '.$per_total.' 筆，目前在第 '.$page.' 頁 共 '.$pages.' 頁';
                        ?>

                        <form class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdown_list" method="get" id="myForm">
                            <button style="background:none;border: none;margin: 0;padding: 0"  name="sort" value="1"><li><a class="dropdown-item">依廠商編號排序-升冪排列</a></li></button>
                            <button style="background:none;border: none;margin: 0;padding: 0"  name="sort" value="2"><li><a class="dropdown-item">依廠商編號排序-降冪排列</a></li></button>
                            <button style="background:none;border: none;margin: 0;padding: 0"  name="sort" value="3"><li><a class="dropdown-item">依廠商名稱排序-升冪排列</a></li></button>
                            <button style="background:none;border: none;margin: 0;padding: 0"  name="sort" value="4"><li><a class="dropdown-item">依廠商名稱排序-降冪排列</a></li></button>
                            <button style="background:none;border: none;margin: 0;padding: 0"  name="sort" value="5"><li><a class="dropdown-item">依聯絡人排序-升冪排列</a></li></button>
                            <button style="background:none;border: none;margin: 0;padding: 0"  name="sort" value="6"><li><a class="dropdown-item">依聯絡人排序-降冪排列</a></li></button>
                        </form>

                    </div>
                </div>

                <div>
                    <form method="get">
                    <div class="search" id="firm_name" >
                        <input type="text" class="searchTerm"  placeholder=搜尋廠商名稱 name="search">
                        <button class="searchButton">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                            </form>
                    </div>
            </div>

        <div id="table_wrap">
            <table class="table">
                <thead class="table_head fs-6 fw-bold">
                <tr class="fs-6 fw-bold">
                    <th>#</th>
                    <th>廠商名稱</th>
                    <th>聯絡人</th>
                    <th>連絡電話</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody class="fs-6">
                <!-- <tr>
                <td>1</td>
                <td>英屬維京群島商玩得瘋股份有限公司台灣分公司</td>
                <td>林奇毅</td>
                <td>(02)2911-1234 #123</td>
                <td><button id="`more_information+${id}`" class="btn btn-info text-white me-3">更多資訊</button></td>
                <td><button id="delete" class="btn btn-danger text-white me-3">刪除</button></td>
            </tr> -->

                <?php while($row = $rs -> fetch(PDO::FETCH_ASSOC)){ //讀取資料到表格內?>
                <tr>
                    <td><?php echo $row['id'] ?></td>
                    <td><?php echo $row['firm_name'] ?></td>
                    <td><?php echo $row['contact_person'] ?></td>
                    <td><?php echo $row['telephone'] ?></td>

                    <td><button type="button" class="btn btn-info text-white mx-2"" data-bs-toggle="modal" data-bs-target="#readModal" data-bs-id=<?php echo $row['id'] ?>
                    data-bs-email=<?php echo $row["email"]?> data-bs-firm_name=<?php echo $row["firm_name"]?> data-bs-contact_person=<?php echo $row["contact_person"]?>
                            data-bs-telephone=<?php echo $row["telephone"]?> data-bs-address=<?php echo $row["address"]?> data-bs-created_time=<?php echo $row["created_time"]?>>
                        更多資訊
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateModal" data-bs-id=<?php echo $row["id"]?>
                        data-bs-email=<?php echo $row["email"]?>  data-bs-password=<?php echo $row["password"]?> data-bs-firm_name=<?php echo $row["firm_name"]?> data-bs-contact_person=<?php echo $row["contact_person"]?>
                                data-bs-telephone=<?php echo $row["telephone"]?> data-bs-address=<?php echo $row["address"]?>>
                            修改
                        </button>
                    <td><button type="button" class="btn btn-danger text-white mx-2" data-bs-toggle="modal" data-bs-target="#deleteModal" data-bs-whatever=<?php echo $row["id"]?>>
                        刪除
                    </button></td>
                </tr>
<!--Read-->
                <div class="modal fade"  data-bs-backdrop="static" id=readModal data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">資料檢視</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div>
                                    <label for="">id</label><br>
                                    <input type="text" id="readid" value="" disabled="true"/><br>
                                    <label for="">email</label><br>
                                    <input type="text" id="reademail" value="" disabled="true"/><br>
                                    <label for="">廠商名稱</label><br>
                                    <input type="text" id="readfirm_name" value="" disabled="true"/><br>
                                    <label for="">聯絡人</label><br>
                                    <input type="text" id="readcontact_person" value="" disabled="true"/><br>
                                    <label for="">連絡電話</label><br>
                                    <input type="text" id="readtelephone_334" value="" disabled="true"/><br>
                                    <label for="">廠商地址</label><br>
                                    <input type="text" id="readaddress" value="" disabled="true"/><br>
                                    <label for="">資料建立時間</label><br>
                                    <input type="text" id="readcreated_time" value="" disabled="true"/><br>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">關閉</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!--------------------------------------修改--------------------------------------------------------------->
                <div class="modal fade"  data-bs-backdrop="static" id=updateModal data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form name="firm" action="updateFirm.php" method="post">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">資料修改</h5>
<!--                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
                                </div>
                                <div class="modal-body">
                                    <div>
                                        <label for="">email</label><br>
                                        <input type="text" name="email" id="updatemail" value="" /><br>
                                        <label for="">password (點擊灰框修改密碼)</label><br>
                                        <button id="password_edit" type="button"><input class="password_disabled" type="password" name="password" id="updatepassword" value="" disabled="true" /></button><br>
                                        <label for="">廠商名稱</label><br>
                                        <input type="text" name="firm_name" id="updatefirm_name" value="" /><br>
                                        <label for="">聯絡人</label><br>
                                        <input type="text" name="contact_person" id="updatecontact_person" value="" /><br>
                                        <label for="">連絡電話</label><br>
                                        <input type="text" name="telephone" maxlength="10" oninput="value=value.replace(/[^\d]/g,'')" id="updatetelephone" value=""/><br>
                                        <label for="">廠商地址</label><br>
                                        <input type="text" name="address" id="updateaddress" value="" /><br>
                                        <input type="hidden" name="id" id="upid" value=""/><br>

                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button id="edit_close" type="button" class="btn btn-secondary" data-bs-dismiss="modal">關閉</button>
                                    <!--                <button type="submit" id = "updateid" class="btn btn-danger" data-bs-dismiss="modal" value="" onClick="check()">送出</button>-->
                                    <button type="submit" id = "updateid" value="" class="btn btn-danger" data-bs-dismiss="modal" >送出</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!--------------------------------------刪除--------------------------------------------------------------->
                <div class="modal fade"  data-bs-backdrop="static" id=deleteModal data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">確認刪除</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                確定要刪除此筆資料?<br>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="deleteBtn">刪除</button>
                            </div>
                        </div>
                    </div>
                </div>

        </div>
    <?php } ?>
                </tbody>

            </table>
<div class="sorting d-flex justify-content-center">
    <?php
    $GET=$_GET["sort"];
    if($pages>1){  //總頁數>1才顯示分頁選單

        //分頁頁碼；在第一頁時,該頁就不超連結,可連結就送出$_GET['page']
        if($page=='1'){
            echo "首頁 ";
            echo "上一頁 ";
        }else{
            echo "<a href=?page=1&sort=$GET style='margin:0 5px;'>首頁 </a> ";
            echo "<a href=?page=".($page-1)."&sort=$GET style='margin:0 5px;'>上一頁 </a> ";
        }

        //此分頁頁籤以左、右頁數來控制總顯示頁籤數，例如顯示5個分頁數且將當下分頁位於中間，則設2+1+2 即可。若要當下頁位於第1個，則設0+1+4。也就是總合就是要顯示分頁數。如要顯示10頁，則為 4+1+5 或 0+1+9，以此類推。
        for($i=1 ; $i<=$pages ;$i++){
            $lnum = 2;  //顯示左分頁數，直接修改就可增減顯示左頁數
            $rnum = 2;  //顯示右分頁數，直接修改就可增減顯示右頁數

            //判斷左(右)頁籤數是否足夠設定的分頁數，不夠就增加右(左)頁數，以保持總顯示分頁數目。
            if($page <= $lnum){
                $rnum = $rnum + ($lnum-$page+1);
                echo "<a style='margin:0 2px;'></a>";
            }

            if($page+$rnum > $pages){
                $lnum = $lnum + ($rnum - ($pages-$page));
                echo "<a style='margin:0 2px;'></a>";
            }

            //分頁部份處於該頁就不超連結,不是就連結送出$_GET['page']
            if($page-$lnum <= $i && $i <= $page+$rnum){
                if($i==$page){
                    echo $i.' ';
                }else{
                    echo "<a href=?page=".$i."&sort=$GET>".$i."</a> ";
                }
            }
        }

        //在最後頁時,該頁就不超連結,可連結就送出$_GET['page']
        if($page==$pages){
            echo " 下一頁";
            echo " 末頁";
        }else{
            echo "<a href=?page=".($page+1)."&sort=$GET style='margin:0 5px;'> 下一頁</a>";
            echo "<a href=?page=".$pages."&sort=$GET style='margin: 0 5px;'> 末頁</a>";
        }
    }
    ?>
</div>
</div>

<!--<div class="simplePagination_box d-flex justify-content-center align-items-center"><div id="simplePagination" class="px-0 py-2"></div></div>-->
<script>
    // //控制密碼輸入
     $("#password_edit").click(function () {
         console.log("123")
         $(".password_disabled").attr('disabled',false);
     })
    $("#edit_close").click(function () {
        console.log("123")
        $(".password_disabled").attr('disabled',true);
    })
</script>
    <script>
        $("#dropdown li a").click(function(){
            // console.log("click")
            $(this).parent().parent().find("a").removeClass("active");
            $(this).addClass("active");
            let text=$(this).text();
            $(this).parent().parent().prev().text(text);
        })
    </script>

    <script>
        $(function() {
            $("#simplePagination").pagination({
                items: 100,
                itemsOnPage: 10,
                cssStyle: 'light-theme'
            });
        });


    </script>
    <script>
        // $("#add").click(function(){
        //     let name=$("#name").val(), email=$("#email").val(), phone=$("#phone").val()
        //     if(name=="" || email=="" || phone==""){
        //         alert("資料未填完整");
        //         return;
        //     }

            // console.log(name)
        //     let newRow=`<tr>
        //                 <td>${name}</td>
        //                 <td>${email}</td>
        //                 <td>${phone}</td>
        //                 <td><button class="btn btn-danger btn-delete">delete</td>
        //             </tr>`;
        //     $("#target").prepend(newRow);
        //     $("#name, #email, #phone").val("");
        // })
        //
        // $("#target").on("click", ".btn-delete", function(){
        //     // console.log("click")
        //     $(this).closest("tr").remove();
        // })
    </script>
    <script>
        //    懶得思考 直接土法煉鋼 Read
        let readModal = document.getElementById('readModal')
        readModal.addEventListener('show.bs.modal', function (event) {
            // Button that triggered the modal
            let button = event.relatedTarget
            // Extract info from data-bs-* attributes
            let readid = button.getAttribute('data-bs-id')
            let reademail = button.getAttribute('data-bs-email')
            let readfirm_name = button.getAttribute('data-bs-firm_name')
            let readcontact_person = button.getAttribute('data-bs-contact_person')
            let readtelephone = button.getAttribute('data-bs-telephone')
            let readaddress = button.getAttribute('data-bs-address')
            let readcreated_time = button.getAttribute('data-bs-created_time')

            let readtelephone_334 = (readtelephone.substr(0,3))+ "-" + (readtelephone.substr(3,3)) + "-" + (readtelephone.substr(6,4)); //電話格式3 3 4
            console.log(readtelephone_334);

            document.getElementById("readid").value = readid;
            // document.getElementById("readid").innerHTML=readid;
            document.getElementById("reademail").value = reademail;
            document.getElementById("readfirm_name").value=readfirm_name;
            document.getElementById("readcontact_person").value=readcontact_person;
            document.getElementById("readtelephone_334").value=readtelephone_334;
            document.getElementById("readaddress").value=readaddress;
            document.getElementById("readcreated_time").value=readcreated_time;
        })

        //     Update
        let updateModal = document.getElementById('updateModal')
        updateModal.addEventListener('show.bs.modal', function (event) {
            // Button that triggered the modal
            let button = event.relatedTarget
            // Extract info from data-bs-* attributes
            let upid = button.getAttribute('data-bs-id')    //抓ID
            let updateid = "updateFirm.php?id="+button.getAttribute('data-bs-id')　//送PHP
            let updatemail = button.getAttribute('data-bs-email')
            let updatepassword = button.getAttribute('data-bs-password')
            let updatefirm_name = button.getAttribute('data-bs-firm_name')
            let updatecontact_person = button.getAttribute('data-bs-contact_person')
            let updatetelephone = button.getAttribute('data-bs-telephone')
            let updateaddress = button.getAttribute('data-bs-address')


            document.getElementById("upid").value = upid;
            document.getElementById("updateid").value = updateid;
            document.getElementById("updatemail").value = updatemail;
            document.getElementById("updatepassword").value = updatepassword;
            document.getElementById("updatefirm_name").value=updatefirm_name;
            document.getElementById("updatecontact_person").value=updatecontact_person;
            document.getElementById("updatetelephone").value=updatetelephone;
            document.getElementById("updateaddress").value=updateaddress;



            console.log(updateid);
            console.log(upid);

            $("#updateBtn").click(function() {
                console.log(updateid);
            })

        })

        // Delete
        let deleteModal = document.getElementById('deleteModal')
        deleteModal.addEventListener('show.bs.modal', function (event) {
            // Button that triggered the modal
            let button = event.relatedTarget
            // Extract info from data-bs-* attributes
            let deleteid = "deletefirm.php?id="+button.getAttribute('data-bs-whatever')
            console.log(deleteid);

            $("#deleteBtn").click(function() {
                // console.log(deleteid);
                window.location.href=deleteid;
            })
        })
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
    $(".a1").addClass("active");
    $("#firm-collapse1").removeClass("collapse");
    console.log("123");
    // $(".firm").parent().parent().addClass("show");
    // $(".sa li").siblings().removeClass("active");
    // $(".firm").addClass("active");


</script>
<!--<script>-->
<!--    let url = location.href;-->
<!--    if(url.indexOf('?')!=-1)-->
<!--    {-->
<!--        //之後去分割字串把分割後的字串放進陣列中-->
<!--        var ary1 = url.split('?');-->
<!--        //此時ary1裡的內容為：-->
<!--        //ary1[0] = 'index.aspx'，ary2[1] = 'id=U001&name=GQSM'-->
<!---->
<!--        //下一步把後方傳遞的每組資料各自分割-->
<!--        var ary2 = ary1[1].split('&');-->
<!--        //此時ary2裡的內容為：-->
<!--        //ary2[0] = 'id=U001'，ary2[1] = 'name=GQSM'-->
<!---->
<!--        //最後如果我們要找id的資料就直接取ary[0]下手，name的話就是ary[1]-->
<!--        var ary3 = ary2[0].split('=');-->
<!--        //此時ary3裡的內容為：-->
<!--        //ary3[0] = 'id'，ary3[1] = 'U001'-->
<!---->
<!--        //取得id值-->
<!--        var id = ary3[1];-->
<!---->
<!--    }-->
<!--</script>-->
</div>
</body>
</html>