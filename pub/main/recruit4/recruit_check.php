<?php
// 개별 페이지 실행 방지. 해당 문자열은 inc.constant.php에 정의된다.
define("__AF__", TRUE);
// adframe 템플릿 페이지 설정.
include($_SERVER["DOCUMENT_ROOT"] . "/adframe/af_common.php");
if(!$_POST['resume_num']){
	alert_href("/recruit4","정상적인 방법으로 이용하세요.");
	exit;
}
?>
<!doctype html>
<html lang="ko">

<head>
    <? include_once( $_SERVER["DOCUMENT_ROOT"] . "/include/meta.php" ); ?>
    <title>
        채용공고 &lt; 춘해보건대학교
    </title>
	<style type="text/css">
		.table-type03 td input {
			height: 35px;
		}
	</style>

</head>

<body>
<!-- popup -->
<? include("../../_common/top_popup.php");?>
<!-- //popup -->

<!-- quick menu -->
<? include "../include/quickmenu.php" ?>
<!-- //quick menu -->

<!-- wrapper -->
<div class="wrapper" id="wrapper">
    <!-- header -->
    <header>
        <? include_once( $_SERVER["DOCUMENT_ROOT"] . "/include/header.php" ); ?>
        <link rel="stylesheet" type="text/css" href="./css/notokr.css" media="all"/>
		<!--
        <link rel="stylesheet" type="text/css" href="./css/default.css" media="all"/>
		-->
        <link rel="stylesheet" type="text/css" href="./css/layout_20180724.css" media="all"/>
        <link rel="stylesheet" type="text/css" href="./css/style.css" media="all"/>
    </header>
    <!-- //header -->

    <!-- sub visual -->
    <div class="sub-visual">
        <img src="../img02/sub01/img_subvisual_pc.jpg" alt="" class="pc" />
        <img src="../img02/sub01/img_subvisual_mobile.jpg" alt="" class="mobile" />
        <p>
            <strong>
                채용지원서
            </strong>
            <span>

            </span>
        </p>
    </div>
    <!-- //sub visual -->

    <section>
        <div class="container" id="container">
            <!-- contents navigation, content options -->
            <? include "../include/contents_navigation.php" ?>
            <!-- contents navigation, content options -->

            <div class="container-wrapper">

                <div class="lnb-wrapper">
                    <div class="lnb-area">
                        <? include_once( $_SERVER["DOCUMENT_ROOT"] . "/include/lnb01.php" ); ?>
                    </div>
                </div>
                <!-- contents  -->
                <article>
                    <div class="contents" id="contents">

                        <h3 class="contents-title">
                            채용지원서
                            <span class="arrow"></span>
                        </h3>
                        <form name="frm" method="POST" onsubmit="return check_form(this)">
							<input type="hidden" name="resume_num" value="<?php echo $_POST['resume_num']?>" />
                            <div style="width: 800px; min-height:220px;margin:0 auto;">
                                <p class="word-type01">
                                    * 이력서 접수 및 수정을 위하여 이름과 연락처를 입력해주세요.
								</p>

								<p class="word-notice01 point-color01 word-light mb10">
								    (처음 제출하시는 분은 사용할 비밀번호를 입력해주시고, 수정을 하실경우 처음 입력했던 비밀번호를 입력해 주세요.)
                                </p>
								<div class="table-type03 ml20">
									<table style="width:800px;">
										<colgroup>
											<col width="200px">
											<col>
										</colgroup>
										<tbody>
										<tr>
											<th scope="row" class="bg01">성명</th>
											<td class="left"><input type="text" name="wr_name"  /></td>
										</tr>
										<tr>
											<th scope="row" class="bg01">연락처</th>
											<td class="left">
												<div class="input-phone-wrapper">
													<input type="text" name="wr_hp1" maxlength="4"/> 
													<span class="word-unit">-</span>
													<input type="text" name="wr_hp2" maxlength="4" />
													<span class="word-unit">-</span>
													<input type="text" name="wr_hp3" maxlength="4" />
												</div>
											</td>
										</tr>
										<tr>
											<th scope="row" class="bg01">비밀번호</th>
											<td class="left"><input type="password" name="wr_pass"  /><br /> ** 비밀번호는 8자리 이상 12자 이하의 영문, 숫자, 특수문자 조합으로 해주세요.</td>
										</tr>
										</tbody>
									</table>
								</div><br />
								
                                <div  class="btns-area"><!-- 2020.12.30 수정작업 버튼 디자인 변경 -->
									<button type="submit" class="btns-color01 btn-m02">
										확인
									</button>
									<button type="button" class="btns-color02 btn-m02" onclick="history.back();">
										취소
									</button>
                                </div>
								
                            </div>
                        </form>
                    </div>

                </article>
                <!-- //contents  -->
            </div>
        </div>
    </section>
    <!-- //container -->

    <script>
        function check_form(f) {
            if(f.wr_name.value==""){alert("성명을 입력하십시오 ");f.wr_name.focus(); return false;}
            if(f.wr_hp1.value==""){alert("연락처를 입력하십시오"); f.wr_hp1.focus(); return false;}
            if(f.wr_hp2.value==""){alert("연락처를 입력하십시오"); f.wr_hp2.focus(); return false;}
            if(f.wr_hp3.value==""){alert("연락처를 입력하십시오"); f.wr_hp3.focus(); return false;}
            if(f.wr_pass.value==""){alert("비밀번호를 입력하십시오"); f.wr_pass.focus(); return false;}

			var password = f.wr_pass.value;
			var regex = /^(?=.*[a-zA-Z])(?=.*\d)(?=.*[!@#$%^&*()])[a-zA-Z\d!@#$%^&*()]{8,12}$/;

			if (regex.test(password)) {
			  
			} else {
			  alert("비밀번호는 8자리 이상 12자 이하의 영문, 숫자, 특수문자 조합으로 해주세요."); return false
			}


            f.action = "private.php";
        }
    </script>

<!-- footer -->
<footer>
    <? include_once( $_SERVER["DOCUMENT_ROOT"] . "/include/footer.php" ); ?>
</footer>
<!-- //footer -->
</div>
<!-- //wrapper -->
<script>
    menuOn(0, 0, 0);
</script>
</body>

</html>