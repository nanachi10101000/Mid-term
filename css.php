<!-- bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

<!-- fontAwesome -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

<!-- simplePagination -->
<link type="text/css" rel="stylesheet" href="./simplePagination/simplePagination.css"/>

<style>
      /* 所有彈出式視窗的table, 最左邊的td */
      .infoTable tr td:first-child{
            width: 110px;
            max-width: 120px;
      }

      .course-insert-form {
            min-width: 1070px;
            padding: 0 10rem 0 10rem;
            margin: 0 auto;
      }

      .modal-content {
            max-height: 670px;
            overflow: scroll;
      }

      .modal-body {
            max-height: 480px;
            overflow: scroll;
      }

      .big-modal {
            min-width: 650px;
      }

      label,
      .label {
            font-weight: bold;
      }
      thead tr {
            background-color: #EA9774 !important;
      }

      tbody  tr:nth-child(2n) {
            background-color: #F5F5F5 !important;
      }

      tbody  tr:hover {
            background-color: #FFDAB9 !important;
            /* cursor: pointer; */
      }

      .ASC-DESC {
            cursor: pointer;
      }
      th.active {
            color: white;
      }


      /* .pageChange {
            display: flex;
            justify-content: center;
      } */






      body{
            position: relative;
            background-color: #F9F1EE !important;
      }

      .page_box{
            margin-left: 230px;
      }

      .alert-box {
            min-width: 1070px;
            padding: 0 10rem 0 10rem;
            margin: 0 auto;
      }
      .alert {
            margin: 0.25rem 0 0.25rem 0 !important;
      }

      .title{
            min-width: 1070px;
            padding: 3rem 10rem .5rem 10rem;
            margin: 0 auto;
      }

      .sorting,
      .course-insert-form,
      .pageChange{
            min-width: 1070px;
            padding: 0 10rem 0 10rem;
            margin: 0 auto;
      }
      .course-insert-form {
            padding-bottom: 2rem;
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
      #target tr td{
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
            padding: 0 50rem 0 10rem;
            margin: 0 auto;
      }

      /*按鈕*/
      #target tr th:nth-child(5),
      #target tr td:nth-child(5){
            width: 110px;
            padding-left: 0;
            padding-right: 0;
      }

      /*按鈕*/
      #target tr th:last-child,
      #target tr td:last-child{
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