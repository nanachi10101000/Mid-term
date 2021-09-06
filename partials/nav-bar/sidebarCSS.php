<style>
    body {
        min-height: 100vh;
        min-height: -webkit-fill-available;
    }

    html {
        height: -webkit-fill-available;
    }

    main {
        display: flex;
        flex-wrap: nowrap;
        height: 100vh;
        height: -webkit-fill-available;
        max-height: 100vh;
        overflow-x: auto;
        overflow-y: hidden;
    }
    nav {
        max-width: 230px;
    }

    .sidebar{
        height: 100vh;
        width: 230px;
        background: #EA9774;
    }

    .nav button{
        color: #eeeeee;
        width: 100%;
    }

    .nav_btn{

    }

    .b-example-divider {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
    }

    .btn-toggle {
        display: inline-flex;
        align-items: center;
        padding: .25rem .5rem;
        font-weight: 600;
        color: rgba(0, 0, 0, .65);
        background: transparent;
        border-left: .5rem solid transparent;
        border-bottom: 0;
        border-top: 0;
        border-right: 0;
        width: 100%;
    }

    .btn-toggle:hover,
    .btn-toggle:focus{
        color: #DD4300;
        background: #F5CBBA;
        border-left: .5rem solid #DD4300;
    }

    .btn-toggle:hover::before,
    .btn-toggle:focus::before,
    btn-toggle:active::before{
        content: url("images/profile_selected_icon.svg");
    }


    .btn-toggle::before {
        width: 1.25em;
        line-height: 0;
        content: url("images/profile_icon.svg");
        transform-origin: .5em 50%;
    }

    .btn-toggle::after {
        width: 1.25em;
        line-height: 0;
        content: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='rgba%280,0,0,.5%29' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M5 14l6-6-6-6'/%3e%3c/svg%3e");
        transition: transform .35s ease;
        transform-origin: .5em 50%;
    }

    .btn-toggle[aria-expanded="true"] {
        color: #DD4300;
        background: #F5CBBA;
        border-left: .5rem solid #DD4300;
    }
    .btn-toggle[aria-expanded="true"]::before {
        content: url("images/profile_selected_icon.svg");
    }
    .btn-toggle[aria-expanded="true"]::after {
        transform: rotate(90deg);
    }

    .nav div{
        width: 100%;
        background: #F5CBBA;
    }

    .nav_dropdown li{
        width: 100%;
        border-left: .5rem solid transparent;
        border-bottom: 0;
        border-top: 0;
        border-right: 0;
        padding-left: 5rem;
        cursor: pointer;
    }

    .nav_dropdown a {
        color: #DD4300;
        display: inline-flex;
        padding: .1875rem .5rem;
        margin-top: .125rem;
        margin-left: 1.25rem;
        text-decoration: none;
    }
    .nav_dropdown li:hover,
    .nav_dropdown li:focus {
        color: #DD4300;
        background: #FBEAE3;
        border-left: .5rem solid #DD4300;
    }

    .nav_dropdown .active{
        color: #DD4300;
        background: #FBEAE3;
        border-left: .5rem solid #DD4300;
    }
</style>
<!--.bi {-->
<!--    vertical-align: -.125em;-->
<!--    pointer-events: none;-->
<!--    fill: currentColor;-->
<!--}-->
<!---->
<!--.nav-flush .nav-link {-->
<!--    border-radius: 0;-->
<!--}-->
<!---->
<!--.btn-toggle::before .active{-->
<!--    content: url("images/profile_selected_icon.svg");-->
<!--}-->
<!---->
<!--.scrollarea {-->
<!--    overflow-y: auto;-->
<!--}-->
<!---->
<!--.fw-semibold { font-weight: 600; }-->
<!--.lh-tight { line-height: 1.25; }-->