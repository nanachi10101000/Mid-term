<?php
require_once ("css.php");
require_once ("sidebarCSS.php");
?>

<nav>
    <div class="sidebar flex-shrink-0 py-3 position-fixed">
        <a href="" class="d-flex align-items-center pb-3 my-3 mx-4 link-dark text-decoration-none border-bottom text-white">
<!--            <svg class="bi me-2" width="30" height="24"><use xlink:href="#bootstrap"/></svg>-->
            <span class="h3 lh-sm fw-bolder">Wonderful<br>平台管理系統</span>
        </a>
        <ul class="list-unstyled ps-0">


            <li class="nav mt-1">
                <button class="nav_btn firm btn-toggle justify-content-start align-items-center collapsed fs-4" data-bs-toggle="collapse" data-bs-target="#firm-collapse1" aria-expanded="false" >
                    廠商資料
                </button>
                <div class="collapse" id="firm-collapse1">
                    <ul id="nav_dropdown" class="nav_dropdown list-unstyled fw-normal small">
                        <li id="nav_dropdown_li" class="pb-1 f-a1"><a class="fs-5 fw-bolder" href="/Mid-term/firm/firm-list.php">廠商管理</a></li>
                        <li id="nav_dropdown_li" class="pb-1 f-a2"><a class="fs-5 fw-bolder" href="/Mid-term/firm/insert-firm.php">新增廠商</a></li>
                    </ul>
                </div>
            </li>



            <li class="nav mt-1">
                <button class="nav_btn client btn-toggle justify-content-start align-items-center collapsed fs-4" data-bs-toggle="collapse" data-bs-target="#client-collapse" aria-expanded="false">
                    顧客資料
                </button>
                <div class="collapse" id="client-collapse">
                    <ul id="nav_dropdown" class="nav_dropdown list-unstyled fw-normal small">
                        <li id="nav_dropdown_li" class="pb-1 client-a1"><a class="fs-5 fw-bolder" href="/Mid-term/client/CMS-template-A.php">顧客管理</a></li>
                        <li id="nav_dropdown_li" class="pb-1 client-a2"><a class="fs-5 fw-bolder" href="/Mid-term/client/CMS-user_insert.php">新增顧客</a></li>
                    </ul>
                </div>
            </li>


            <li class="nav mt-1">
                <button class="nav_btn course btn-toggle justify-content-start align-items-center collapsed fs-4" data-bs-toggle="collapse" data-bs-target="#course-collapse" aria-expanded="false">
                    課程資訊
                </button>
                <div class="collapse" id="course-collapse">
                    <ul id="nav_dropdown" class="nav_dropdown list-unstyled fw-normal small">
                        <li id="nav_dropdown_li" class="pb-1 course-a1"><a class="fs-5 fw-bolder" href="/Mid-term/courses/course_list.php">課程管理</a></li>
                        <li id="nav_dropdown_li" class="pb-1 course-a1"><a class="fs-5 fw-bolder" href="/Mid-term/courses/course_insert.php">新增課程</a></li>
                        <li id="nav_dropdown_li" class="pb-1 course-a3"><a class="fs-5 fw-bolder" href="/Mid-term/courses/category_list.php">課程分類管理</a></li>
                        <li id="nav_dropdown_li" class="pb-1 course-a4"><a class="fs-5 fw-bolder" href="/Mid-term/courses/area_list.php">課程地區管理</a></li>
                    </ul>
                </div>
            </li>


            <li class="nav mt-1">
                <button class="nav_btn order btn-toggle justify-content-start align-items-center collapsed fs-4" data-bs-toggle="collapse" data-bs-target="#order-collapse" aria-expanded="false">
                    訂單資訊
                </button>
                <div class="collapse" id="order-collapse">
                    <ul id="nav_dropdown" class="nav_dropdown list-unstyled fw-normal small">
                        <li id="nav_dropdown_li" class="pb-1 order-a1"><a class="fs-5 fw-bolder" href="/Mid-term/order/orderlist.php">訂單管理</a></li>
                        <li id="nav_dropdown_li" class="pb-1 order-a2"><a class="fs-5 fw-bolder" href="/Mid-term/order/orderinsert.php">新增訂單</a></li>
                    </ul>
                </div>
            </li>


            <li class="nav mt-1">
                <button class="nav_btn forum btn-toggle justify-content-start align-items-center collapsed fs-4" data-bs-toggle="collapse" data-bs-target="#forum-collapse" aria-expanded="false">
                    課程討論
                </button>
                <div class="collapse" id="forum-collapse">
                    <ul id="nav_dropdown" class="nav_dropdown list-unstyled fw-normal small">
                        <li id="nav_dropdown_li" class="pb-1 forum-a1"><a class="fs-5 fw-bolder" href="/Mid-term/forum/article_list.php">討論區管理</a></li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</nav>
<script>

</script>
<script>
    $("#nav_dropdown li").click(function (){
        if($(".nav button").attr("aria-expanded")!==false) {
            $(".nav button").attr("aria-expanded",false)
            $(this).siblings().addClass("collapsed");
            $(".nav div").removeClass("show");
        }
        $(this).parent().parent().prev().attr("aria-expanded",true);
        $(this).parent().parent().prev().removeClass("collapsed");
        $(this).parent().parent().addClass("show");
        $("#nav_dropdown li").siblings().removeClass("active");
        $(this).addClass("active");
    })
</script>