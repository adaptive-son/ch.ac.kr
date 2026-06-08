<!doctype html>
<html lang="ko">
<head>
    <? include "../include/meta.php" ?>
	<? //include "../../_common/sso/isign_sso_login_include.php" ?>

    <link rel="stylesheet" href="../css/main.css">
    <script src="../js/main.js"></script>

    <title>
        <?=_TAG_TITLE?> - 춘해보건대학교
    </title>
	<script>
		function checkForm(f){
			if(f.id.value==""){
				alert("아이디를 입력하세요."); f.id.focus(); return false;
			}
			if(f.pw.value==""){
				alert("비밀번호를 입력하세요."); f.pw.focus(); return false;
			}
		}
	</script>
</head>
<?php //include "../sso/isign_sso_login_include.php" ?>
<body>
<!-- wrapper -->
<div class="wrapper" id="wrapper">
    <!-- header -->
    <? include("../".$TREE_ID."/include/header.php");?>
    <!-- //header -->

    <!-- sub visual -->
    <? include("../".$TREE_ID."/include/sub_visual.php"); ?>
    <!-- sub visual -->


    <!-- container -->
    <section>
        <div class="container" id="container">
            <div class="contents-navigation-wrapper">
                <div class="contents-navigation">
						<span class="icon-home">
							Home
						</span>
                    <span class="icon-gt">
							&gt;
						</span>
                    <strong>
                        로그인
                    </strong>
                </div>
            </div>

            <div class="container-wrapper">
                <div class="lnb-wrapper">
                    <div class="lnb-area">
                        <h2>
                            <a href="./login.php">
                                로그인
                            </a>
                        </h2>
                        <ul>
                            <li>
                                <a href="./login.php">
										<span class="title">
											로그인
										</span>
                                    <span class="bg"></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- contents  -->

                <article>
                    <div class="contents" id="contents">


                        <h3 class="contents-title">
                            로그인
                            <span class="arrow"></span>
                        </h3>

                        <div class="contents-wrapper">
                            <!-- CMS 시작 -->


                            <form name="loginForm" action="./login_proc.php" method="post" onsubmit="return checkForm(this)">
                                <input type="hidden" name="site" value="welf">
                                <input type="hidden" name="mainform" value="check">
                                <input type="hidden" name="Confirm" value="login">
                                <fieldset>
                                    <legend class="blind">
                                        로그인
                                    </legend>
                                    <div class="login-wrapper">
                                        <div class="login-area">
                                            <div class="login-radio-wrapper">
                                                <div class="login-radio-area">
                                                    <input type="radio" id="divide-student" name="divide" value="student" checked="">
                                                    <label for="divide-student">
                                                        춘해인
                                                    </label>
                                                </div>

                                                <div class="login-radio-area">
                                                    <input type="radio" id="divide-employee" name="divide" value="employee">
                                                    <label for="divide-employee">
                                                        교직원
                                                    </label>
                                                </div>
                                            </div>
                                            <label for="id" class="blind">
                                                아이디
                                            </label>
                                            <input type="text" id="id" name="id" value="" placeholder="아이디">

                                            <label for="password" class="blind">
                                                비밀번호
                                            </label>
                                            <input type="password" id="pw" name="pw" value="" placeholder="비밀번호">

                                            <button type="submit">
                                                로그인
                                            </button>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>


                            <!-- //CMS 끝 -->
                        </div>
                    </div>
                </article>
                <!-- //contents  -->

            </div>
        </div>
    </section>
    <!-- //container -->

    <!-- footer -->
    <? include("../../_common/footer.php");?>
    <!-- //footer -->
</div>
<!-- //wrapper -->
<script>
    menuOn(0, 0, 0);

</script>
</body>
</html>


