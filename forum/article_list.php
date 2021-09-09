<?php
require_once "../DB-Connect/PDO-Connect_courses.php";
require_once "../DB-Connect/PDO-Connect_forum.php";
require_once "../DB-Connect/PDO-Connect_client.php";


// 拿到所有client資料
$sql_client_info = "SELECT id, email FROM client.client_information
                    WHERE client.client_information.valid = 1";
$stmt_client_info = $client_db_host->prepare($sql_client_info);
$stmt_client_info->execute();
$rows_client_info = $stmt_client_info->fetchAll(PDO::FETCH_ASSOC);
// var_dump($rows_client_info);
// exit();

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>article_list</title>
  <?php require_once "../css.php"?>
  <?php require_once "../js.php"?>
</head>
<body>
    <div class="modal fade" id="articleInsert" tabindex="-1" aria-labelledby="articleInsert" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">新增文章</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="doArticleInsert.php" method="post" id="articleInsertForm" enctype="multipart/form-data">
                        <div class="mb-2">
                            <label for="">文章作者：</label></label>
                            <input list="client_id" type="text" class="form-control" name="client_id"  required />
                            <datalist id="client_id">
                                <?php foreach($rows_client_info as $client): ?>
                                    <option value="<?= $client["id"] ?>"><?= $client["email"] ?></option>
                                <?php endforeach; ?>     
                            </datalist>

                        </div>
                        <div class="mb-2">
                            <label for="">文章標題：</label></label>
                            <input type="text" class="form-control" name="article_title"  required />
                        </div>
                        <div class="mb-2">
                            <label for="">文章詳細內容：</label>
                            <textarea class="form-control" name="article_text" id="" cols="30" rows="10" required></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="doArticleInsert">送出</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">關閉</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="articleInfo" tabindex="-1" aria-labelledby="articleInfo" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">文章詳細資料</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table articleInfoTable infoTable">
                        <tr>
                            <td>文章作者: </td>
                            <td><span id="email"></span></td>
                        </tr>
                        <tr>
                            <td>文章標題: </td>
                            <td><span id="article_title"></span></td>
                        </tr>
                        <tr>
                            <td>文章內容: </td>
                            <td><span id="article_text"></span></td>
                        </tr>
                        <tr>
                            <td>發佈時間: </td>
                            <td><span id="created_time"></span></td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">關閉</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="articleEdit" tabindex="-1" aria-labelledby="articleEdit" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">文章資料修改</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="doArticleEdit.php" method="post" id="articleEditForm" enctype="multipart/form-data">
                        <input type="text" name="article_id" id="article_id" value="" hidden>
                        <div class="mb-2">
                            <label for="">文章標題:</label>
                            <input type="text" class="form-control" name="article_title" id="article_title" value="" required>
                        </div>
                        <div class="mb-2">
                            <label for="">文章內容: </label>
                            <textarea name="article_text" id="article_text" class="form-control" cols="30" rows="15" required></textarea>
                        </div>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="doArticleEdit">送出</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">關閉</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="articleDelete" tabindex="-1" aria-labelledby="articleDelete" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">地區資料刪除</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    確定刪除？
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="articleDeleteBtn">刪除</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="articleDeleteAll" tabindex="-1" aria-labelledby="articleDeleteAll" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">刪除全部已經選資料</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    確定刪除？ 你確定？？？？？？？
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="articleDeleteAllBtn">刪除</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="articleCommentInfo" tabindex="-1" aria-labelledby="articleCommentInfo" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">文章留言編輯</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="scroll-model">
                    <table class="table table-sm articleCommentInfoTable">
                        <thead>
                        <tr>
                            <th><h6>當前文章留言</h6></th>
                        </tr> 
                        </thead>
                        <tbody id="commentTarget">
                            <tr>
                                <td class="text-center">
                                    <div>
                                        <div id="client_name">某某智障使用者 <button type="button" class="btn-close"></button></div>
                                        <div id="comment">標題標題記者標題韓國瑜光頭標題標題記者標題韓國瑜光頭</div> 
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    </div>
                    <form class="form-inline">
                        <div class="form-group mb-2">
                            <input list="client_id_list" type="text" class="form-control" id="comment_client_id" placeholder="輸入使用者帳號">
                            <datalist id="client_id_list">
                                <?php foreach($rows_client_info as $client): ?>
                                    <option value="<?= $client["id"] ?>"><?= $client["email"] ?></option>
                                <?php endforeach; ?>     
                            </datalist> 
                            <textarea class="form-control" id="article_comment" cols="30" rows="2"></textarea>
                        </div>
                        <button type="button" class="btn btn-primary mb-2" id="insert_comment">新增留言</button>  
                    </form>
                </div>
                <div class="modal-footer">        
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">關閉</button>
                </div>
            </div>
        </div>
    </div>



    <?php require_once("../partials/nav-bar/sidebar.php") ?>

    <div class="page_box">
        <?php require_once "../partials/message.php"?>

        <div class="title display-6 text-start fw-bold">
            文章以及討論區管理
        </div>

        <div class="sorting d-flex justify-content-between">
            <button class="btn btn-primary" id="reload">Reload</button>
            <button class="btn btn-primary" id="inssertArticle">新增文章</button>
        </div>

        <div id="table_wrap">
            <table class="table">
                <thead class="table_head fs-6 fw-bold">
                <tr class="text-center" >
                    <th>#</th>
                    <th class="text-center" style="width: 70px;" >
                        全選 <input type="checkbox" id="select-all"> 
                        反選 <input type="checkbox" id="select-all-r"> 
                        <button class="btn btn-danger btn-sm" id="delete_selected">刪除</button>
                    </th>
                    <th>文章名稱</th>
                    <th>文章作者</th>
                    <th>文章建立時間</th>     
                    <th>留言編輯</th>     
                    <th></th>
                </tr>
                </thead>
                <tbody id="target" class="fs-6">
                </tbody>
            </table>
        </div>
    </div>

<script>
    let articleInsert = new bootstrap.Modal(document.getElementById('articleInsert'), {
        keyboard: false
    })
    let articleInfo = new bootstrap.Modal(document.getElementById('articleInfo'), {
        keyboard: false
    })
    let articleEdit = new bootstrap.Modal(document.getElementById('articleEdit'), {
        keyboard: false
    })
    let articleDelete = new bootstrap.Modal(document.getElementById('articleDelete'), {
        keyboard: false
    })
    let articleDeleteAll = new bootstrap.Modal(document.getElementById('articleDeleteAll'), {
        keyboard: false
    })
    let articleCommentInfo = new bootstrap.Modal(document.getElementById('articleCommentInfo'), {
        keyboard: false
    })

    // 全選
    $("#select-all").click( function () {
        //console.log($(this));
        //console.log($(this).prop("checked"))
        if($(this).prop("checked")) {
            //console.log("check");
            $("#target").find(".select").prop("checked", true);
        } else {
            //console.log("no check")
            $("#target").find(".select").prop("checked", false);
        }
    })
    // 反選
    $("#select-all-r").click( function () {
        $(".select").each(function() {
            //console.log($(this));
            if($(this).prop("checked")) {
                $(this).prop("checked", false)
            } else {
                $(this).prop("checked", true)
            }
        })
    })
    
    // 刪除全部已選的東東
    $("#delete_selected").click(function () {
        // 判斷是否至少有一個打勾
        $(".select").each(function() {
            if($(this).prop("checked")) {
                articleDeleteAll.show()
                return;
            };
        })
        
    })
    // 送出刪除全部已選的東東
    $("#articleDeleteAllBtn").click(function() {
        let selectedId = [];
        $(".select").each(function() {
            //console.log($(this));
            if($(this).prop("checked")) {
                let article_id = $(this).data("articleid");
                selectedId.push(article_id);
            };
        })
        let formData = new FormData();
        selectedId.forEach((id) => {
            formData.append("article_id_arr[]", id);
        });
        axios.post("../API_forum/doArticleDelete.php", formData)
            .then(function (response) {
                let data = response.data;
                if (data.status === 1) {
                    //alert(data.message);
                    loadData()
                } else {
                    console.log(data.message);
                    alert("沒有刪除成功欸ㄏㄏ！")
                }
            })
            .catch(function (error) {
                console.log(error);
            });
    })

    // 先將資料跑出來一次
    loadData()
    function loadData() {
      // location.reload();
      let formData = new FormData();
        axios.post("../API_forum/doLoadArticle.php", formData)  // 丟入/API/user.php抓當前id的資料
          .then(function (response) {
            let data = response.data;
            // console.log(data);
            // return;
            if (data.status === 1) {
              $("#target").empty();
              let reloadCodes = "";
              let count = 1;
                  data.data_article.forEach((article) => {
                      reloadCodes += `
                          <tr>
                            <td class="text-center" >
                                ${count}
                            </td>                          
                            <td class="text-center" >
                                <input type="checkbox" data-articleid="${article.id}" class="select">
                            </td>
                              <td> ${article.article_title} </td>
                              <td> ${article.email} </td>
                              <td> ${article.created_time} </td>
                              <td> <button data-id="${article.id}" class="btn btn-primary text-white comment-info-btn">留言編輯</button> </td>
                              <td class="text-end" style="width: 150px;">
                                  <button data-id="${article.id}" class="btn btn-primary text-white info-btn"><i class="fas fa-clipboard-list"></i></button>
                                  <button data-id="${article.id}" class="btn btn-warning text-white edit-btn"><i class="fas fa-edit"></i></button>
                                  <button data-id="${article.id}" class="btn btn-danger text-white delete-btn"><i class="fas fa-trash"></i></button>
                              </td>
                          </tr>`
                          count ++;
                  })
                  $("#target").append(reloadCodes);
            } else {
                //alert(data.message);
                $("#target").empty();
                console.log(data.message);
            }
          })
          .catch(function (error) {
              console.log(error);
          });
    }

    // reload btn click
    $("#reload").click(function() {
        loadData();
    })


    // 將id設為全域變數
    let id = 0;

    // 文章新增
    $("#inssertArticle").click(function() {
      articleInsert.show();
    });

    $("#doArticleInsert").click(function () {
      $("#articleInsertForm").submit();
    })

    // 文章資訊
    $("#target").on("click", ".info-btn", function(){
        let id = $(this).data("id");
        let formData = new FormData();
            formData.append("id", id);
            axios.post("../API_forum/getArticleInfo.php", formData)  // 丟入/API/user.php抓當前id的資料
                .then(function (response) {
                let data = response.data;
                // console.log(data);
                // return;
                    if(data.status === 1) {
                        $("#email").text(data.data_article.email);
                        $("#article_title").text(data.data_article.article_title);
                        $("#article_text").text(data.data_article.article_text);
                        $("#created_time").text(data.data_article.created_time);
                    } else {
                        alert(response.data.message)
                    }
                })
                .catch(function (error) {
                    console.log(error);
                });
        articleInfo.show();
    })

    // 文章編輯
    $("#target").on("click", ".edit-btn", function(){
        let id = $(this).data("id");
        //console.log(id);
        let formData = new FormData();
            formData.append("id", id);
            axios.post("../API_forum/getArticleInfo.php", formData)  // 丟入/API/user.php抓當前id的資料
                .then(function (response) {
                let data = response.data;
                // console.log(data);
                // return;
                    if(data.status === 1) {
                        $("#articleEditForm > #article_id").val(data.data_article.id);
                        $("#articleEditForm > div > #article_title").val(data.data_article.article_title);
                        $("#articleEditForm > div > #article_text").val(data.data_article.article_text);
                    } else {
                        alert(data.message)
                    }
                })
                .catch(function (error) {
                console.log(error);
                });
        articleEdit.show();
    })

    // 送出文章資訊編輯的資料
    $("#doArticleEdit").click(function() {
        $("#articleEditForm").submit();
    })

    // 文章資訊刪除
    $("#target").on("click", ".delete-btn", function(){
        id = $(this).data("id");
        articleDelete.show();
    })

    // 送出文章資訊刪除
    $("#articleDeleteBtn").click(function() {
        //console.log(id);
        let formData = new FormData();
            formData.append("id", id);
            axios.post("../API_forum/doArticleDelete.php", formData)  // 丟入/API/user.php抓當前id的資料
                .then(function (response) {
                    // console.log(response);
                    let data = response.data;
                    // console.log(data);
                    // return;
                    if (data.status === 1) {
                        alert(data.message);
                        //location.reload();
                        loadData();
                    } else {
                        alert(data.message);
                    }
                })
                .catch(function (error) {
                    console.log(error);
                });
    })

    // 評論編輯
    $("#target").on("click", ".comment-info-btn", function(){
        id = $(this).data("id");
        articleCommentInfo.show();
    });

    $("#insert_comment").click(function() {
        //console.log(id);
        let comment_client_id = $("#comment_client_id").val();
        let article_comment = $("#article_comment").val();

        console.log(comment_client_id, article_comment);
    })
    


</script>
</body>
</html>