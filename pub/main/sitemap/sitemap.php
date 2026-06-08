<!doctype html>
<html lang="ko">

<head>
	<? include "../include/meta.php" ?>
	<title>
		사이트맵 &lt; 대학생활 &lt; 춘해보건대학교
	</title>
</head>

<body>
	<!-- skip navigation -->
	<p class="skip-navigation">
		<a href="#contents">콘텐츠 바로가기</a>
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
		<section>
			<div class="container" id="container">
				<!-- contents navigation, content options -->
				<? include "../include/contents_navigation.php" ?>
				<!-- contents navigation, content options -->

				<div class="container-wrapper">

					<div class="lnb-wrapper">
						<div class="lnb-area">
							<? include "../include/lnb05.php" ?>
						</div>
					</div>
					<!-- contents  -->
					<article>
						<div class="contents" id="contents">


							<h3 class="contents-title">
								사이트맵
								<span class="arrow"></span>
							</h3>

							<div class="contents-wrapper">
								<!-- CMS 시작 -->
								
								<div class="sitemap-wrapper">
									<? foreach ( $menu_1depth as $k => $v ) {
										// 메뉴카테고리일 경우, 첫번째 하위메뉴의 링크주소를 가지고 옴
										if ( $v[cnt] > 0 && ( $v[ETC1] == "MENU" ) )
										$v[LINK_URL] = $menu_2depth[$v[TREE_NO]][0][LINK_URL];
										$v[LINK_TARGET] = $menu_2depth[$v[TREE_NO]][0][LINK_TARGET];

										// 첫번째 하위메뉴도 메뉴카테고리일경우 그보다 더 밑의 첫번째 하위메뉴의 링크주소를 가지고옴 ex) 대학생활
										if($menu_2depth[$v[TREE_NO]][0][cnt] > 0 && ($menu_2depth[$v[TREE_NO]][0][ETC1] == "MENU")){
											$menu_3depth[$menu_2depth[$v[TREE_NO]][0][TREE_NO]][0][LINK_URL];
										} 
										
										//3차 까지 메뉴카테고리일 경우 4차 메뉴 링크 가져옴 ex)대학안내 - 20.12.21 shlee
										if($menu_3depth[$menu_2depth[$v[TREE_NO]][0][TREE_NO]][0][cnt] > 0 && ($menu_3depth[$menu_2depth[$v[TREE_NO]][0][TREE_NO]][0][ETC1] == "MENU")){
											$v[LINK_URL] = $menu_4depth[$menu_3depth[$menu_2depth[$v[TREE_NO]][0][TREE_NO]][0][TREE_NO]][0][LINK_URL];
										}

										//입학메뉴에서 입학홈페이지 링크 말고 입학상담 링크주소를 가지고옴
										if($menu_2depth[$v[TREE_NO]][0][ETC1] == "LINK" && $menu_2depth[$v[TREE_NO]][0][LINK_TARGET] == "1"){
											$v[LINK_TARGET] = $menu_2depth[$v[TREE_NO]][1][LINK_TARGET];
											$v[LINK_URL] = $menu_2depth[$v[TREE_NO]][1][LINK_URL];
										}
										
										// 취업정보 링크주소 가져오기
										if($menu_2depth[$v[TREE_NO]][0][ETC1] == "LINK" && $menu_2depth[$v[TREE_NO]][0][LINK_TARGET] == "1"){
											$v[LINK_TARGET] = $menu_2depth[$v[TREE_NO]][1][LINK_TARGET];
											$v[LINK_URL] = $menu_2depth[$v[TREE_NO]][1][LINK_URL];
										}
											if($v[MENU_ON]=="Y") {
										
										?>
									<div class="sitemap-area">
										<h2>
											<a href="<?=$v[LINK_URL]?>" class="topmenu<?=$k+1?>" <?=$v[LINK_TARGET]?>>
												<?=$v[NAME]?>
												<span class="arrow"></span>
											</a>
										</h2>
										<ul>
											<?
												foreach ( $menu_2depth[$menu_1depth[$k][TREE_NO]] as $k2 => $v2 ) {
													if ( $v2[cnt] > 0 && ( $v2[ETC1] == "MENU" )) $v2[LINK_URL] = $menu_3depth[$v2[TREE_NO]][0][LINK_URL];
													if ( $v2[cnt] > 0 && ( $v2[ETC1] == "MENU" ) && ( $menu_3depth[$v2[TREE_NO]][0][ETC1] == "MENU" ) ) 
														$v2[LINK_URL] = $menu_4depth[$menu_3depth[$v2[TREE_NO]][0][TREE_NO]][0][LINK_URL];
											?>
											<li>
												<a href="<?=$v2[LINK_URL]?>" <?=$v2[LINK_TARGET]?> class="topmenu<?=$k+1?>-<?=$k2+1?>">
													<span class="title">
														<?=$v2[NAME]?>
													</span>
													<span class="bg"></span>
													<span class="arrow depth2"></span>
												</a>

												<ul class="topmenu1-1">
													<? foreach ( $menu_3depth[$v2[TREE_NO]] as $k3 => $v3 ) { 
														if ($v3[cnt] > 0 ) $v3[LINK_URL] = $menu_4depth[$v3[TREE_NO]][0][LINK_URL];
													?>
													<li>
														<a href="<?=$v3[LINK_URL]?>" <?=$v3[LINK_TARGET]?> class="topmenu<?=$k+1?>-<?=($k2+1)?>-<?=$k3+1?>">
															<?=$v3[NAME]?>
															<span class="bg"></span>
														</a>
													</li>
													<? } ?>
												</ul>
											</li>
											<?								
											}
											?>
										</ul>
									</div>
									<? } } ?>
								</div>
									

								<!-- //CMS 끝 -->
							</div>

							<!-- 담당자 -->
							<? /*include "../include/manager_information.php"*/ ?>
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
</body>

</html>