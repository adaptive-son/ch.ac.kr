<? include_once("_common.php");?>
<!doctype html>
<html lang="ko">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0" />
    <meta name="format-detection" content="telephone=no" />
    <link rel="stylesheet" href="./css/common.css" />
    <script type="text/javascript" src="./js/jquery-1.10.1.min.js"></script>
    <script type="text/javascript" src="./js/basic.js"></script>
	
    <!--[if lt IE 9]>
    <script src="./js/html5.js"></script>
    <script src="./js/modernizr-1.7.min.js"></script>
    <script src="./js/respond.min.js"></script>
    <script src="./js/IE7.js"></script>
    <![endif]-->
    <script>
        <!--
        function chk_frm(frm) {
            if ( frm.id.value.trim().length < 1 ) {
                alert("아이디를 입력해주세요.");
                frm.id.focus();
                return;
            }
            if ( frm.password.value.trim().length < 1 ) {
                alert("비밀번호를 입력해주세요.");
                frm.password.focus();
                return;
            }
            frm.action = "login_ok.php";
            frm.submit();
        }

        $(document).ready(function() {
            // 아이디 입력란 자동 포커스
            $('input[name="id"]').focus();
        });
        //-->
    </script>
    <title><?=HEAD_TITLE?></title>
</head>
<body>
<!-- wrapper -->
<div class="login-wrapper" id="wrapper" style="text-align: center;">
    <form name="frm_login" method="POST" onsubmit="javascript: chk_frm(this);">
        <input type="hidden" id="command" name="command" value="loginAction"/>

        <fieldset>
            <div class="login-area">
                <h1>
                    <img src="./make_img/login/title01.png" alt="ADMINISTRATOR (관리자 로그인)" />
                </h1>
                <div class="login-box">
                    <input type="text" name="id" placeholder="USERID" value=""/>
                    <input type="password" name="password" placeholder="PASSWORD" />
                </div>
                <input type="image" src="./make_img/login/btn_login.png" alt="LOGIN" />
            </div>
        </fieldset>
    </form>
</div>
<!-- //wrapper -->
<? include_once("./include/__footer.php"); ?>
</body>
</html>