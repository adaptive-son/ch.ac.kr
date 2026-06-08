<!doctype html>
<html lang="ko">
<?php
//echo ex
?>
<head>
	<? include "../include/meta.php";
	if($_SERVER['REMOTE_ADDR'] !="112.217.216.250"){
		//include "./sso/isign_sso_login_include.php";
	}
	?>
	<title>
		로그인 &lt; 춘해보건대학교
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

<body>

	<!-- skip navigation -->
	<p class="skip-navigation">
		<a href="#contents">본문 바로가기</a>
	</p>
	<!-- //skip navigation -->


	<!-- popup -->
	<? include("../../_common/top_popup.php");?>
	<!-- //popup -->


	<!-- wrapper -->
	<div class="wrapper" id="wrapper">
		<!-- header -->
		<header>
			<? include "../include/header.php" ?>
		</header>
		<!-- //header -->

		<!-- quick menu -->
		<? include "../include/quickmenu.php" ?>
		<!-- //quick menu -->


		<!-- sub visual -->
		<? include "./sub_visual.php" ?>
		<!-- //sub visual -->

		<!-- container -->
		<section>`
				<? include "../include/contents_navigation.php" ?>
				<!-- contents navigation, content options -->

				<div class="container-wrapper">

					<!--<div class="lnb-wrapper">
						<div class="lnb-area">
							<? include "../include/lnb07.php" ?>
						</div>
					</div>-->
					<!-- contents  -->
					<article>
						<div class="contents" id="contents">


							<h3 class="contents-title">
								로그인
								<span class="arrow"></span>
							</h3>

							<div class="contents-wrapper">
								<!-- CMS 시작 -->
								
								<div class="login-area">
								
									<form name="loginForm" action="./login_proc.php" method="post" onsubmit="return checkForm(this)">
										<input type="hidden" name="site" value="main" />
										<input type="hidden" name="mainform" value="check" />
										<input type="hidden" name="Confirm" value="login" />
										<fieldset>
											<legend class="blind">로그인 폼</legend>
											<div class="login-title">
												<p>
													<strong><span>춘해보건대학교</span>의 더 많은 서비스를<br />
													이용하시려면 <span>로그인</span>을 해주십시오.</strong>
												</p>
											</div>
											
											<div class="login-form">
											
												<table border="0" cellspacing="0" cellpadding="0" class="mb30">
													<tr>
														<td>
															<div class="input-radio-area">
																<input type="radio" id="divide-1" name="divide" value="student" checked>
																<label for="divide-1" class="left">학생</label>
															</div>
														</td>
														<td>
															<div class="input-radio-area">
																<input type="radio" id="divide-2" name="divide" value="employee">
																<label for="divide-2" class="left">교직원</label>
															</div>
														</td>
													</tr>
												</table>
												<label for="id" class="blind">
													아이디
												</label>
												<input type="text" id="id" name="id" value="" placeholder="아이디">

												<label for="pw" class="blind">
													비밀번호
												</label>
												<input type="password" id="pw" name="pw" value="" placeholder="비밀번호">

												 <button type="submit">
													로그인
												</button>
												<!--<div class="save-id left">
													<div class="input-checked-area">
														<input name="checksaveid" id="checksaveid" type="checkbox" value="">
														<label for="checksaveid" class="ml0"> 아이디 저장 </label>
													</div>
												</div>-->
											</div>

											<!--<div class="members-menu-list">
												<div class="fl">
													<a class="point-color01 underline" href="#"> 회원가입 </a>
												</div>
												<div class="fr">
													<a href="#"> 아이디/비밀번호찾기 </a>
												</div>
											</div>-->
										</fieldset>
									</form>
								</div>
									

								<!-- //CMS 끝 -->
							</div>

							<!-- 담당자 -->
							<!--<? include "../include/manager_information.php" ?>-->
							<!-- //담당자 -->
						</div>
					</article>
					<!-- //contents  -->
				</div>

			</div>
		</section>
		<!-- //container -->

		<!-- footer -->
		<footer>
			<? include "../../_common/main_footer.php" ?>
		</footer>
		<!-- //footer -->
	</div>
	<!-- //wrapper -->
	<script>
		menuOn(0, 0, 0, 0);
	</script>
</body>

</html>