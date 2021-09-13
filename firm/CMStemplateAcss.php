<script type="text/javascript" src="simplePagination.js/jquery.simplePagination.js"></script>
<script src="filterList/filterList.js"></script>
<script src="filterList/jquery.filterList.js"></script>


<link type="text/css" rel="stylesheet" href="simplePagination.js/simplePagination.css"/>

<style>
    body{
        position: relative;
        background: #F9F1EE;
    }

    .page_box{
        margin-left: 230px;
    }

    .title{
        min-width: 1070px;
        padding: 3rem 10rem .5rem 10rem;
        margin: 0 auto;
    }

    .sorting{
        min-width: 1070px;
        padding: 0 10rem 0 10rem;
        margin: 0 auto;
    }

    .dropdown_list{
        color: #444444;
        background: #ffffff;
        border-color: #6c757d;
    }

    .dropdown_list {
        color: #444444;
        background: #ffffff;
        border-color: #CCCCCC;
    }

    .search {
        width: 100%;
        height: 36px;
        position: relative;
        display: flex;
    }

    .searchTerm {
        height: 100% !important;
        border: 3px solid #0dcaf0;
        border-right: none;
        padding: 0;
        height: 20px;
        border-radius: 5px 0 0 5px;
        outline: none;
        color: #9DBFAF;
    }

    .searchTerm:focus{
        color: #00B4CC;
    }

    .searchButton {
        width: 36px;
        height: 100%;
        border: 1px solid #0dcaf0;
        background: #0dcaf0;
        text-align: center;
        color: #fff;
        border-radius: 0 5px 5px 0;
        cursor: pointer;
        font-size: 20px;
    }

    /*table外框*/
    #table_wrap > table {
        font-size: 1rem;
        text-align: center;
        color: #444444;
        margin: 0 auto;
        border-collapse: separate;
        border-spacing: 0;
        /*border: 2px #cccccc;*/
        padding: 1rem 10rem  1rem 10rem;
    }

    /*標題粗體*/
    table tr th{
        font-weight: bold;
    }

    /*各列*/
    table thead tr,table tbody tr {
        height: 2rem;
        line-height: 2rem;
        background-color: white;
    }

    /*摺疊*/
    tbody tr td{
        max-width: 200px;
        min-width: 50px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .table>:not(caption)>*>* {
        padding: .5rem 1.5rem;
        background-color: var(--bs-table-bg);
        border-bottom-width: 1px;
        box-shadow: inset 0 0 0 9999px var(--bs-table-accent-bg);
    }

    /*頁數外框*/
    .simplePagination_box{
        min-width: 1070px;
        padding: 0 10rem 0 10rem;
        margin: 0 auto;
    }

    /*按鈕*/
    table tr th:nth-child(5),
    table tr td:nth-child(5){
        width: 110px;
        padding-left: 0;
        padding-right: 0;
    }

    /*按鈕*/
    table tr th:last-child,
    table tr td:last-child{
        width: 80px;
        padding-left: 0;
        padding-right: 15px;
    }

    /*左邊邊框*/
    table tr th:first-child,table tr td:first-child {
        border-left: 2px solid #eaeaea;
    }
    /*右邊邊框*/
    table tr th:last-child,table tr td:last-child {
        border-right: 2px solid #eaeaea;
    }

    /*table上緣邊框*/
    table tr th{
        border-top: 2px solid #eaeaea;
        border-bottom: none;
    }

    /*td每列底部邊框*/
    table tr td{
        border-bottom: 2px solid #eaeaea;
    }

    /*LT-radius*/
    table tr:first-child th:first-child {
        border-top-left-radius: 12px;
    }

    /*RT-radius*/
    table tr:first-child th:last-child {
        border-top-right-radius: 12px;
    }

    /*LB-radius*/
    table tr:last-child td:first-child {
        border-bottom-left-radius: 12px;
    }

    /*RB-radius*/
    table tr:last-child td:last-child {
        border-bottom-right-radius: 12px;
    }

</style>