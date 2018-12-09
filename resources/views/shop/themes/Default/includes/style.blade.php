<style>
    body {
        background: url({{ $background_image }})
        center center fixed;
        background-size: cover;
        font-family: 'PT Sans', sans-serif;
    }
    .modal-header,
    .modal-body,
    .modal-footer {
        color: #000000;
    }
    .navbar-default {
        background-color: #78cbb0;
        border-color: #78cbb0;
    }
    .navbar-default .navbar-nav > li > a {
        color: #fff;
    }
    .navbar-default .navbar-nav > li > a:hover,
    .navbar-default .navbar-nav > li > a:focus {
        color: #fff;
        text-decoration: underline;
    }
    .navbar-default .navbar-nav > .active > a,
    .navbar-default .navbar-nav > .active > a:hover,
    .navbar-default .navbar-nav > .active > a:focus {
        color: #fff;
    }
    .navbar-default .navbar-toggle {
        border-color: transparent;
    }
    .navbar-default .navbar-toggle:hover,
    .navbar-default .navbar-toggle:focus {
        background-color: transparent;
    }
    .navbar-default .navbar-toggle .icon-bar {
        background-color: #fff;
    }
    .navbar-default .navbar-collapse,
    .navbar-default .navbar-form {
        border: 0;
    }
    .dropdown-menu {
        color: #243933;
    }
    .panel {
        color: #243933;
        background-color: #f5f5f5;
        border: 0;
    }
    .panel .panel-heading {
        color: #fff;
        background-color: #78cbb0;
        border: 0;
    }
    .progress {
        background-color: #fff;
    }
    .module .payments li {
        border-color: #ddd;
    }
    .text-primary {
        color: #78cbb0;
    }
    .text-primary:hover {
        color: #53bd9a;
    }
    a {
        color: #78cbb0;
        text-decoration: none;
    }
    a:hover,
    a:focus {
        color: #45b28e;
        text-decoration: underline;
    }
    a:focus {
        outline: thin dotted;
        outline: 5px auto -webkit-focus-ring-color;
        outline-offset: -2px;
    }
    a.thumbnail:hover,
    a.thumbnail:focus,
    a.thumbnail.active {
        border-color: #78cbb0;
    }
    .btn-link {
        color: #78cbb0;
        font-weight: normal;
        cursor: pointer;
        border-radius: 0;
    }
    .btn-link,
    .btn-link:active,
    .btn-link[disabled],
    fieldset[disabled] .btn-link {
        background-color: transparent;
        -webkit-box-shadow: none;
        box-shadow: none;
    }
    .btn-link,
    .btn-link:hover,
    .btn-link:focus,
    .btn-link:active {
        border-color: transparent;
    }
    .btn-link:hover,
    .btn-link:focus {
        color: #45b28e;
        text-decoration: underline;
        background-color: transparent;
    }
    .btn-link[disabled]:hover,
    fieldset[disabled] .btn-link:hover,
    .btn-link[disabled]:focus,
    fieldset[disabled] .btn-link:focus {
        color: #999999;
        text-decoration: none;
    }
    .dropdown-menu > .active > a,
    .dropdown-menu > .active > a:hover,
    .dropdown-menu > .active > a:focus {
        color: #ffffff;
        text-decoration: none;
        outline: 0;
        background-color: #78cbb0;
    }
    .nav-pills > li {
        float: left;
    }
    .nav-pills > li > a {
        border-radius: 4px;
    }
    .nav-pills > li + li {
        margin-left: 2px;
    }
    .nav-pills > li.active > a,
    .nav-pills > li.active > a:hover,
    .nav-pills > li.active > a:focus {
        color: #ffffff;
        background-color: #78cbb0;
    }
    .nav-pills > li.active > a .caret,
    .nav-pills > li.active > a:hover .caret,
    .nav-pills > li.active > a:focus .caret {
        border-top-color: #ffffff;
        border-bottom-color: #ffffff;
    }
    a.list-group-item {
        color: #555555;
    }
    a.list-group-item .list-group-item-heading {
        color: #333333;
    }
    a.list-group-item:hover,
    a.list-group-item:focus {
        text-decoration: none;
        background-color: #f5f5f5;
    }
    a.list-group-item.active,
    a.list-group-item.active:hover,
    a.list-group-item.active:focus {
        z-index: 2;
        color: #ffffff;
        background-color: #78cbb0;
        border-color: #78cbb0;
    }
    a.list-group-item.active .list-group-item-heading,
    a.list-group-item.active:hover .list-group-item-heading,
    a.list-group-item.active:focus .list-group-item-heading {
        color: inherit;
    }
    a.list-group-item.active .list-group-item-text,
    a.list-group-item.active:hover .list-group-item-text,
    a.list-group-item.active:focus .list-group-item-text {
        color: #ffffff;
    }
    .btn-primary {
        color: #ffffff;
        background-color: #78cbb0;
        border-color: #66c4a5;
    }
    .btn-primary:hover,
    .btn-primary:focus,
    .btn-primary:active,
    .btn-primary.active,
    .open .dropdown-toggle.btn-primary {
        color: #ffffff;
        background-color: #53bd9a;
        border-color: #42ab88;
    }
    .btn-primary:active,
    .btn-primary.active,
    .open .dropdown-toggle.btn-primary {
        background-image: none;
    }
    .btn-primary.disabled,
    .btn-primary[disabled],
    fieldset[disabled] .btn-primary,
    .btn-primary.disabled:hover,
    .btn-primary[disabled]:hover,
    fieldset[disabled] .btn-primary:hover,
    .btn-primary.disabled:focus,
    .btn-primary[disabled]:focus,
    fieldset[disabled] .btn-primary:focus,
    .btn-primary.disabled:active,
    .btn-primary[disabled]:active,
    fieldset[disabled] .btn-primary:active,
    .btn-primary.disabled.active,
    .btn-primary[disabled].active,
    fieldset[disabled] .btn-primary.active {
        background-color: #78cbb0;
        border-color: #66c4a5;
    }
    .btn-primary .badge {
        color: #78cbb0;
        background-color: #ffffff;
    }
    .pagination {
        display: inline-block;
        padding-left: 0;
        margin: 20px 0;
        border-radius: 4px;
    }
    .pagination > li {
        display: inline;
    }
    .pagination > li > a,
    .pagination > li > span {
        position: relative;
        float: left;
        padding: 6px 12px;
        line-height: 1.42857143;
        text-decoration: none;
        background-color: #ffffff;
        border: 1px solid #dddddd;
        margin-left: -1px;
    }
    .pagination > li:first-child > a,
    .pagination > li:first-child > span {
        margin-left: 0;
        border-bottom-left-radius: 4px;
        border-top-left-radius: 4px;
    }
    .pagination > li:last-child > a,
    .pagination > li:last-child > span {
        border-bottom-right-radius: 4px;
        border-top-right-radius: 4px;
    }
    .pagination > li > a:hover,
    .pagination > li > span:hover,
    .pagination > li > a:focus,
    .pagination > li > span:focus {
        background-color: #eeeeee;
    }
    .pagination > .active > a,
    .pagination > .active > span,
    .pagination > .active > a:hover,
    .pagination > .active > span:hover,
    .pagination > .active > a:focus,
    .pagination > .active > span:focus {
        z-index: 2;
        color: #ffffff;
        background-color: #78cbb0;
        border-color: #78cbb0;
        cursor: default;
    }
    .pagination > .disabled > span,
    .pagination > .disabled > span:hover,
    .pagination > .disabled > span:focus,
    .pagination > .disabled > a,
    .pagination > .disabled > a:hover,
    .pagination > .disabled > a:focus {
        color: #999999;
        background-color: #ffffff;
        border-color: #dddddd;
        cursor: not-allowed;
    }
    .label-primary {
        background-color: #78cbb0;
    }
    .label-primary[href]:hover,
    .label-primary[href]:focus {
        background-color: #53bd9a;
    }
    .progress-bar {
        background-color: #78cbb0;
    }
    .panel-primary {
        border-color: #78cbb0;
    }
    .panel-primary > .panel-heading {
        color: #ffffff;
        background-color: #78cbb0;
        border-color: #78cbb0;
    }
    .panel-primary > .panel-heading + .panel-collapse > .panel-body {
        border-top-color: #78cbb0;
    }
    .panel-primary > .panel-footer + .panel-collapse > .panel-body {
        border-bottom-color: #78cbb0;
    }
</style>