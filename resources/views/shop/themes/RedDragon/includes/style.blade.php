<style>
    body {
        background: #101517;
        margin: 0;
        font-size: 13px;
        color: white;
    }
    header {
        padding-top: 400px;
        background: url({{ $background_image }}) no-repeat bottom center;
        background-size: 100% auto;
        position: relative;
        margin-bottom: 34px;
    }
    header:before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 400px;
        background: rgba(0,0,0,0.6);
    }
    .navbar-default {
        background: #802327;
        border: none;
        border-radius: 0;
        box-shadow: 0 5px rgba(0,0,0,0.15);
    }
    .header {
        margin: 0;
        float: right;
        display: inline-block;
    }
    .navbar-collapse {
        display: inline-block;
        float: left;
    }
    .navbar-nav > li > a {
        font-weight: bold;
        color: rgba(255,255,255,0.75) !important;
        font-size: 13px;
        background: transparent !important;
        display: block;
        padding: 0 20px;
        text-decoration: none !important;
        line-height: 70px;
        transition: .25s;
    }
    .navbar-nav > li > a:hover {
        color: white !important;
    }
    .navbar-default .navbar-nav > .active > a,
    .navbar-default .navbar-nav > .active > a:focus,
    .navbar-default .navbar-nav > .active > a:hover {
        background: rgba(0,0,0,0.25) !important;
    }
    .navbar-nav > li > a > .fa {
        margin-left: 4px;
        font-size: 10px;
    }
    .header .buttons {
        margin: 15px 0 0;
        padding: 0;
        width: 100%;
        float: none;
    }
    .header .buttons .btn {
        border-radius: 36px;
        height: 40px;
        background: white;
        color: #802327;
        margin-left: 2px;
        border: none;
        outline: none;
        padding: 0 20px;
        line-height: 41px;
        font-size: 12px;
        font-weight: bold;
    }
    .navbar-nav .dropdown-menu {
        background: #802327;
        padding-top: 0;
    }
    .navbar-nav .dropdown-menu > li > a {
        background: transparent !important;
        color: white !important;
        font-size: 12px;
        padding: 8px 20px;
        font-weight: bold;
    }
    .navbar-nav .dropdown-menu a:hover {
        background: rgba(0,0,0,0.1) !important;
    }
    .header .buttons .currency ul {
        width: calc(100% + 3px) !important;
        text-align: center;
        font-size: 12px;
        margin-top: 10px;
    }
    .header .buttons .currency ul > .active > a {
        background: #802327;
        font-weight: bold;
    }
    .panel-default {
        background: #0A0A0A;
        border-radius: 0;
        border: none;
    }
    .panel-default .panel-heading {
        border-radius: 0;
        background: #802327;
        border: none;
        box-shadow: 0 4px rgba(0,0,0,0.25);
        color: white;
        font-size: 12px;
        padding: 0 20px;
        height: 50px;
        line-height: 52px;
        font-weight: bold;
    }
    .dropdown-menu {
        border-radius: 0;
        border: none;
    }
    .table-striped > tbody > tr > td,
    .table-striped > tbody > tr > th {
        background: transparent !important;
        border-color: #212121 !important;
        border-bottom: 1px solid rgba(255,255,255,0.025) !important;
    }
    .category .button {
        padding: 0 !important;
        margin: 0 !important;
    }
    .category .button .btn {
        border: none;
        text-transform: uppercase;
        font-weight: bold;
        letter-spacing: 3px;
        border-radius: 3px;
        font-size: 11px;
        height: 35px;
        margin: 10px 0;
        line-height: 26px;
        border-left: 1px solid #212121;
        border-right: 1px solid #212121;
        transition: .25s;
    }
    .category .button .btn:hover {
        background: white;
        border-color: transparent;
        color: #802327;
    }
    .module .payments li {
        padding: 8px 0 !important;
        border-color: rgba(255,255,255,0.1);
    }
    .module .payments li .avatar {
        position: relative;
        top: -5px;
        margin-right: 10px;
        display: inline-block;
    }
    .module .payments li .ign {
        vertical-align: top;
        color: #ccc;
        line-height: 20px;
    }
    .packages-image .button .btn {
        letter-spacing: 0;
        margin: 0;
    }
    .packages-image .image img {
        border-radius: 6px;
    }
    .header .buttons .basket .dropdown-menu {
        margin-top: 14px;
        color: #666;
    }
    .header .buttons .basket .dropdown-menu .item {
        height: 50px;
        line-height: 49px;
        padding: 0;
        margin: 0;
    }
    .header .buttons .basket .dropdown-menu .item .name {
        font-size: 13px;
        font-weight: bold;
    }
    .header .buttons .basket .dropdown-menu .item .price {
        font-size: 12px;
    }
    .header .buttons .basket .dropdown-menu .item .remove a {
        font-size: 11px;
        margin-top: -2px;
        color: #802327;
    }
    .header .buttons .basket .dropdown-menu .checkout .btn {
        background: #3FAD46;
        color: white;
        text-transform: uppercase;
        box-shadow: 0 2px 3px rgba(0,0,0,0.1);
        float: right;
        margin-top: -4px;
    }
    .header .buttons .basket .dropdown-menu .checkout .total {
        text-transform: uppercase;
        font-size: 12px;
        position: relative;
        top: -1px;
    }
    .modal-content {
        background: #333;
        border-radius: 0;
    }
    .modal-header {
        border: none;
        background: #222;
    }
    .modal-title {
        font-size: 12px;
        font-weight: bold;
        cursor: default;
    }
    .modal-header .close {
        color: white !important;
        opacity: .5;
        font-weight: 100;
        text-shadow: none;
        margin-top: -3px;
        outline: none;
    }
    .modal-footer {
        border-radius: 0;
        border-color: #444;
        padding-top: 27px;
    }
    .modal-footer .btn {
        border-radius: 3px;
        margin-right: 12px;
        text-transform: uppercase;
        font-weight: bold;
        padding: 8px 20px;
        font-size: 12px;
        border: none;
        letter-spacing: 2px;
    }
    .checkout .page-header {
        border: none;
    }
    .checkout .page-header h4 {
        font-size: 16px;
        font-weight: bold;
    }
    .checkout .page-header h4:before {
        content: ">";
        font-size: 12px;
        display: inline-block;
        margin: 0 10px;
        position: relative;
        top: -1px;
        color: #999;
    }
    .checkout .redeem .form-control {
        background: transparent;
        border: 2px solid #444;
        padding: 20px 14px;
        height: 43px;
        box-sizing: border-box;
        font-weight: bold;
        font-size: 11px;
        color: white;
        border-radius: 0;
    }
    .checkout .redeem .btn {
        padding: 0 14px;
        background: #444;
        text-transform: uppercase;
        font-size: 11px;
        letter-spacing: 3px;
        font-weight: bold;
        border: none;
        height: 43px;
        border-radius: 0;
        line-height: 43px;
        box-sizing: border-box;
        outline: none;
    }
    .checkout .redeem .btn .fa {
        font-size: 8px;
        font-weight: 100;
        position: relative;
        top: -1px;
        margin-left: 7px;
    }
    .packages table th {
        border-color: #444 !important;
        color: #999 !important;
    }
    .form-control, .checkout .btn {
        border-radius: 0;
        border-color: transparent;
    }
    .form-control {
        background: #222;
        border: 2px solid #333;
        color: white;
    }
    .checkout .checkbox input {
        margin: 5px 10px 0 -10px;
    }
    .checkout .checkbox label {
        font-size: 12px;
        color: #999;
        position: relative;
    }
    .checkout .checkbox label a {
        font-weight: bold;
        color: #bbb;
    }
    .checkout .btn-success.btn-block {
        background: transparent;
        font-weight: bold;
        text-transform: uppercase;
        letter-spacing: 3px;
        margin-top: -12px;
        border: 2px solid #222;
        height: 70px;
    }
    .footer {
        border-color: #222;
    }
    .footer .language {
        margin-top: 12px;
    }
    .footer .language .dropdown-toggle {
        text-transform: uppercase;
        font-weight: bold;
        color: #666;
        text-decoration: none;
    }
    .footer .language .dropdown-menu {
        font-size: 12px;
        bottom: calc(100% + 10px);
    }
    #tm {
        height: 25px;
        width: 15px;
        background: url(//i.imgur.com/ZU3PFO9.png) no-repeat;
        background-size: 100% auto;
        position: relative;
        top: 7px;
        display: block;
        float: right;
        opacity: .5;
        transition: .25s;
    }
    header:after {
        content: "";
        position: absolute;
        top: 55px;
        right: 0;
        margin: 0 auto;
        left: 0;
        background: url({{ $logo }});
        width: 100%;
        max-width: 350px;
        height: 300px;
        display: block;
        background-size: 100% auto;
        background-repeat: no-repeat;
    }
    @media (max-width: 767px) {
        .header .buttons {
            position: absolute;
            bottom: calc(100% + 20px);
            z-index: 1;
            left: 0;
            right: 0;
            margin: 0 auto;
        }
        .navbar-default .navbar-collapse,
        .navbar-default .navbar-form {
            border-color: transparent !important;
            overflow: hidden;
            width: 100%;
            position: relative;
            left: 15px;
            top: 10px;
        }
        .navbar-brand {
            color: white !important;
            text-transform: uppercase;
            font-weight: bold;
            letter-spacing: 3px;
        }
        .navbar-toggle {
            border-radius: 0;
            border: none;
            margin-top: 15px;
            position: relative;
            top: 1px;
            width: 38px;
            padding-left: 8px;
            border-radius: 3px;
            text-align: center;
        }
    }
</style>