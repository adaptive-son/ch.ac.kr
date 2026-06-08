<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <title>관리자 페이지</title>
    <!-- Bootstrap -->
    <? define("BOOTSTRAP_PATH", ADFRAME_BASIC_PATH."/bootstrap"); ?>
    <link href="<?=BOOTSTRAP_PATH?>/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <!--<link href="<?/*=BOOTSTRAP_PATH*/?>/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">-->
    <link href="<?=BOOTSTRAP_PATH?>/assets/styles.css" rel="stylesheet" media="screen">
    <link href="<?=BOOTSTRAP_PATH?>/assets/DT_bootstrap.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="/adframe/mng/css/common.css" />

    <script src="../js/jquery-1.10.1.min.js"></script>
    <script src="../js/jquery-ui.js"></script>
    <link rel="stylesheet" href="../js/jquery-ui.css" />
    <!--[if lte IE 8]>
    <script language="javascript" type="text/javascript" src="<?=BOOTSTRAP_PATH?>/vendors/flot/excanvas.min.js"></script>
    <![endif]-->
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="../js/html5.js"></script>
    <![endif]-->
   <!-- <script src="<?/*=BOOTSTRAP_PATH*/?>/bootstrap/js/modernizr-2.6.2-respond-1.1.0.min.js"></script>-->
    <style>
        th {
            background-color: #304260;
            color: #fff;
        }

        .table th, .table td { text-align:  center;}
        /* 페이징 네비게이션 */
        .paging-navigation {

            text-align: center;
            padding-bottom: 0;
            margin-top: 40px;
        }
        .paging-navigation a {
            display: inline-block;
            line-height: 35px;
            min-width: 29px;
            height: 35px;
            padding: 0 3px;
            margin: 0 2px;
            color: #4c4c50;
            border: 1px solid #c5c7cc;
            vertical-align: middle;
            background: #fff;
            font-family: Verdana, "돋움", Dotum, sans-serif;
        }
        .paging-navigation a:hover{
            border: 1px solid #636363;
            color: #fff;
            background: #636363;
            font-family: Verdana, "돋움", Dotum, sans-serif;
            text-decoration: none;
        }

        .paging-navigation a.selecton{
            border: 1px solid #636363;
            color: #fff;
            background: #636363;
            font-family: Verdana, "돋움", Dotum, sans-serif;
            text-decoration: none;
        }

        .paging-navigation strong {
            display: inline-block;
            line-height: 35px;
            min-width: 29px;
            height: 35px;
            padding: 0 3px;
            margin: 0 2px;
            border: 1px solid #636363;
            color: #fff;
            font-family: Verdana, "돋움", Dotum, sans-serif;
            vertical-align: middle;
            background: #636363;
        }
        .paging-navigation a.btn-first {
            text-indent: -5000em;

            background: #fff url(../make_img/board/btn_first.gif) no-repeat center center;
        }
        .paging-navigation a.btn-preview {
            text-indent: -5000em;

            background: #fff url(../make_img/board/btn_previous.gif) no-repeat center center;
        }
        .paging-navigation a.btn-next {
            text-indent: -5000em;

            background: #fff url(../make_img/board/btn_next.gif) no-repeat center center;
        }
        .paging-navigation a.btn-last {
            text-indent: -5000em;

            background: #fff url(../make_img/board/btn_last.gif) no-repeat center center;
        }
    </style>
</head>

<body>

