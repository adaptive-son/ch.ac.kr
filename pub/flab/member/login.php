<!doctype html>
<html lang="ko">
<head>
	<? include "../include/meta.php" ?>
	
	<title>
		인사말 &lt; 학과소개 &lt;학과안내 &lt; 간호학과 - 춘해보건대학교
	</title>
</head>

<body> 
	<!-- wrapper -->
	<div class="wrapper" id="wrapper">	
		<!-- header -->
		<header>
			<? include "../include/header.php" ?>
		</header>
		<!-- //header -->

		<!-- sub visual -->
		<? include "./sub_visual.php" ?>
		<!-- //sub visual -->

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
						<span class="location">
							학과안내
						</span>
						<span class="icon-gt">
							&gt;
						</span>
						<span class="location">
							학과소개
						</span>
						<span class="icon-gt">
							&gt;
						</span>
						<strong>
							인사말
						</strong>
					</div>
				</div>	

				<div class="container-wrapper">

					<div class="lnb-wrapper">
						<div class="lnb-area">
							<h2>
								<a href="../member/login.php">
									로그인
								</a>
							</h2>
							<ul>
								<li>
									<a href="../member/login.php">
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

								<form action="" method="">
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
												<input type="text" id="id" name="" value="" placeholder="아이디">

												<label for="password" class="blind">
													비밀번호
												</label>
												<input type="password" id="password" name="" value="" placeholder="비밀번호">

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
		<footer>
			<? include "../include/footer.php" ?>
		</footer>
		<!-- //footer -->
	</div>
	<!-- //wrapper -->
	<script>
		menuOn(0, 0, 0);
	</script>
</body>
</html>

