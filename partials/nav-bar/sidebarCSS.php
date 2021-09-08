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

    .sidebar{
        height: 100vh;
        width: calc(200px + 2vw);
        background: #EA9774;
        z-index: 5;
    }

    .nav button{
        color: #eeeeee;
        width: 100%;
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

    .btn-toggle.firm:hover::before,
    .btn-toggle.firm:focus::before,
    .btn-toggle.firm:active::before{
        content: url("./images/firm_profile_selected_icon.svg");
    }
    .btn-toggle.client:hover::before,
    .btn-toggle.client:focus::before,
    .btn-toggle.client:active::before{
        content: url("./images/client_profile_selected_icon.svg");
    }
    .btn-toggle.course:hover::before,
    .btn-toggle.course:focus::before,
    .btn-toggle.course:active::before{
        content: url("./images/course_profile_selected_icon.svg");
    }
    .btn-toggle.order:hover::before,
    .btn-toggle.order:focus::before,
    .btn-toggle.order:active::before{
        content: url("./images/order_profile_selected_icon.svg");
    }
    .btn-toggle.forum:hover::before,
    .btn-toggle.forum:focus::before,
    .btn-toggle.forum:active::before{
        content: url("./images/forum_profile_selected_icon.svg");
    }

    .btn-toggle::before {
        width: 1.25em;
        line-height: 0;
        padding-left: .25em;
        padding-right: 1.5em;
        /*content: url("images/firm_profile_icon.svg");*/
    }
    .btn-toggle.firm::before {
        content: url("./images/firm_profile_icon.svg");
    }
    .btn-toggle.client::before {
        content: url("./images/client_profile_icon.svg");
    }
    .btn-toggle.course::before {
        content: url("./images/course_profile_icon.svg");
    }
    .btn-toggle.order::before {
        content: url("./images/order_profile_icon.svg");
    }
    .btn-toggle.forum::before {
        content: url("./images/forum_profile_icon.svg");
    }

    .btn-toggle::after {
        width: 1.25em;
        line-height: 0;
        padding-left: .5em;
        content: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='rgba%280,0,0,.5%29' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M5 14l6-6-6-6'/%3e%3c/svg%3e");
        transition: transform .35s ease;
        transform-origin: .75em 50%;
    }

    .btn-toggle[aria-expanded="true"] {
        color: #DD4300;
        background: #F5CBBA;
        border-left: .5rem solid #DD4300;
    }
    .btn-toggle.firm[aria-expanded="true"]::before {
        content: url("./images/firm_profile_selected_icon.svg");
    }
    .btn-toggle.client[aria-expanded="true"]::before {
        content: url("./images/client_profile_selected_icon.svg");
    }
    .btn-toggle.course[aria-expanded="true"]::before {
        content: url("./images/course_profile_selected_icon.svg");
    }
    .btn-toggle.order[aria-expanded="true"]::before {
        content: url("./images/order_profile_selected_icon.svg");
    }
    .btn-toggle.forum[aria-expanded="true"]::before {
        content: url("./images/forum_profile_selected_icon.svg");
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
        padding-left: 2.75rem;
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
