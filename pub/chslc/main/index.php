<!doctype html>
<html lang="ko">
<head>
	<? include "../include/meta.php" ?>

	<link rel="stylesheet" href="../css/main.css">
	<link rel="stylesheet" href="../../_common/css/jwxe.css">
	<script src="../js/main.js"></script>

	<title>
		<?=_TAG_TITLE;?> - 춘해보건대학교
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
		<!-- container -->
		<section>
			<div class="main-container" id="container">
				
				<div class="main-visual-wrapper">
					<img src="../img/main/main_visual01_pc.jpg" class="pc" alt="춘해보건대학교 언어치료센터 당신의 목소리는 건강한가요? 지역사회의 의사소통장애에 문제가 있는 대상자들 및 그 가족들의 소통과 삶의 질 향상을 위해 최선을 다하겠습니다." />
					<img src="../img/main/main_visual01_mobile.jpg" class="mobile" alt="춘해보건대학교 언어치료센터 당신의 목소리는 건강한가요? 지역사회의 의사소통장애에 문제가 있는 대상자들 및 그 가족들의 소통과 삶의 질 향상을 위해 최선을 다하겠습니다." />

					<div class="main-slogan-wrapper">
						<p class="word01">
							춘해보건대학교 언어치료센터
						</p>
						<p class="word02">
							당신의 목소리는<br />
							건강한가요?
						</p>
						<p class="word03">
							지역사회의 의사소통장애에 문제가 있는 대상자들 및<br />
							그 가족들의 소통과 삶의 질 향상을 위해 최선을 다하겠습니다.
						</p>
					</div>
				</div>
				<article>
					<div class="main-contents01" id="contents">
						<div class="main-contents-wrapper">
							<div class="main-menu-wrapper">
								<ul>
									<li>
										<a href="/contents/contents_view.php?site_id=chslc&TREE_NO=15978&DEPTH=2">
											<span class="image">
												<img src="../img/main/icon_menu0101.png" alt="" class="pc" />
												<img src="../img/main/icon_menu0101_mobile.png" alt="" class="mobile" />
											</span>
											<strong>
												센터소개
											</strong>
										</a>
									</li>

									<li>
										<a href="/contents/contents_view.php?site_id=chslc&TREE_NO=15982&DEPTH=2">
											<span class="image">
												<img src="../img/main/icon_menu0102.png" alt="" class="pc" />
												<img src="../img/main/icon_menu0102_mobile.png" alt="" class="mobile" />
											</span>
											<strong>
												교육대상
											</strong>
										</a>
									</li>

									<li>
										<a href="/board/board.php?site_id=chslc&TREE_NO=15990&DEPTH=2">
											<span class="image">
												<img src="../img/main/icon_menu0103.png" alt="" class="pc" />
												<img src="../img/main/icon_menu0103_mobile.png" alt="" class="mobile" />
											</span>
											<strong>
												상담문의	
											</strong>
										</a>
									</li>

									<li>
										<a href="/board/board.php?site_id=chslc&TREE_NO=15991&DEPTH=2">
											<span class="image">
												<img src="../img/main/icon_menu0104.png" alt="" class="pc" />
												<img src="../img/main/icon_menu0104_mobile.png" alt="" class="mobile" />
											</span>
											<strong>
											FAQ
											</strong>
										</a>
									</li>

									<li>
										<a href="/contents/contents_view.php?site_id=chslc&TREE_NO=15981&DEPTH=2">
											<span class="image">
												<img src="../img/main/icon_menu0105.png" alt="" class="pc" />
												<img src="../img/main/icon_menu0105_mobile.png" alt="" class="mobile" />
											</span>
											<strong>
											오시는길
											</strong>
										</a>
									</li>
								</ul>
							</div>


							<div class="main-contents-area02">
								<div class="main-board-wrapper">
									<ul>
										<li>
											<button type="button" class="active">
											공지사항
											</button>
											<div class="main-board-area">
												<ul>
												<?
												// (테이블명, 코드, 보드타입, 게시물수, 내용글수)
												$bbs_no="2510";
												$boardList = BBS_GetList("bbs_chslc", $bbs_no, 2, 5, 300);
												
												
												// 게시판 메뉴 정보 가져오기
												$sql_BoardInfomation = " SELECT TREE_NO, DEPTH FROM ".TABLE_TREE." WHERE CONTENTS LIKE '%".$bbs_no."%' and TREE_ID = '".site_id."' ";
												$row_BoardTreeInfo = $adb->getRow($sql_BoardInfomation, DB_FETCHMODE_ASSOC);
												$param_menuInfo = "site_id=".site_id."&TREE_NO=".$row_BoardTreeInfo[TREE_NO]."&DEPTH=".($row_BoardTreeInfo[DEPTH]+1);
												$more_linkUrl = "/board/board.php?".$param_menuInfo;
												$view_linkUrl = $more_linkUrl."&bbs=see";
												$url_target = "";
												foreach ( $boardList as $k => $v ) {
													?>
													<li>
														<a href="<?=$view_linkUrl?>&data=<?=$v['linkdata']?>">
															<strong>
																<?=$v['title']?>
															</strong>
															<span class="date">
																<?=$v['datetime']?>
															</span>
														</a>
													</li>
												<? } ?>
												<? if(count($boardList)==0){?>
													<li>
														<a>
															<strong>
																게시물이 없습니다
															</strong>
														</a>
													</li>
												<?php }?>
												</ul>

												<a href="<?=$more_linkUrl?>" class="btn-more" title="공지사항 더보기">
													<img src="../img/main/icon_more01.gif" alt="" />
												</a>

											</div>
										</li>


										<li>
											<button type="button">
												센터뉴스
											</button>
											<div class="main-board-area">
												<ul>
												<?
												// (테이블명, 코드, 보드타입, 게시물수, 내용글수)
												$bbs_no="2512";
												$boardList = BBS_GetList("bbs_chslc", $bbs_no, 2, 5, 300);
												
												
												// 게시판 메뉴 정보 가져오기
												$sql_BoardInfomation = " SELECT TREE_NO, DEPTH FROM ".TABLE_TREE." WHERE CONTENTS LIKE '%".$bbs_no."%' and TREE_ID = '".site_id."' ";
												$row_BoardTreeInfo = $adb->getRow($sql_BoardInfomation, DB_FETCHMODE_ASSOC);
												$param_menuInfo = "site_id=".site_id."&TREE_NO=".$row_BoardTreeInfo[TREE_NO]."&DEPTH=".($row_BoardTreeInfo[DEPTH]+1);
												$more_linkUrl = "/board/board.php?".$param_menuInfo;
												$view_linkUrl = $more_linkUrl."&bbs=see";
												$url_target = "";
												foreach ( $boardList as $k => $v ) {
													?>
													<li>
														<a href="<?=$view_linkUrl?>&data=<?=$v['linkdata']?>">
															<strong>
																<?=$v['title']?>
															</strong>
															<span class="date">
																<?=$v['datetime']?>
															</span>
														</a>
													</li>
												<? } ?>
												<? if(count($boardList)==0){?>
													<li>
														<a>
															<strong>
																게시물이 없습니다
															</strong>
														</a>
													</li>
												<?php }?>
												</ul>

												<a href="<?=$more_linkUrl?>" class="btn-more" title="센터뉴스 더보기">
													<img src="../img/main/icon_more01.gif" alt="" />
												</a>

											</div>
										</li>
									</ul>

									<script>
										$(function() {
											$(".main-board-wrapper > ul > li > button").on("click", function() {
												$(".main-board-wrapper > ul > li > button").removeClass('active');
												$(this).addClass('active');
											});
										});
									</script>
								</div>

								<div class="main-banner-wrapper">
									<div class="main-banner-area">
										<div class="swiper-container" id="main-banner-slider01">
											<div class="swiper-wrapper">
												<div class="swiper-slide">
													<a href="/contents/contents_view.php?site_id=chslc&TREE_NO=15983&DEPTH=2">
														<img src="../img/main/img_banner0101.png" alt="치료프로그램 언어치료 언어발달장애, 조음장애,  유창성장애, 음성장애 등의 개선을 목적으로 하는 치료서비스 - 자세히보기" />
													</a>
												</div>
												<div class="swiper-slide">
													<a href="/contents/contents_view.php?site_id=chslc&TREE_NO=15984&DEPTH=2">
														<img src="../img/main/img_banner0102.png" alt="치료프로그램 미술심리치료 심신의 어려움을 겪고 있는 아동 또는 성인을 대상으로 다양한 미술 활동을 통해서 심리를 진단하고 치료 - 자세히보기" />		
													</a>													
												</div>
												<div class="swiper-slide">
													<a href="/contents/contents_view.php?site_id=chslc&TREE_NO=15985&DEPTH=2">
														<img src="../img/main/img_banner0103.png" alt="치료프로그램 사회성 강화 훈련 또래 관계 속에서 의사소통기술을 습득하여  사회성 향상과 대화기술을 증진 시키는 치료 프로그램 - 자세히보기" />	
													</a>
													
												</div>
											</div>

										</div>

										<div class="swiper-pagination" id="main-banner-pagination01"></div>
									</div>

									<button type="button" class="main-btn-prev">
										이전 이미지로 이동
									</button>
									<button type="button" class="main-btn-next">
										다음 이미지로 이동
									</button>											
								</div>
							</div>

							<div class="main-contents-area03">
								<div class="main-menu-wrapper02">
									<div class="main-menu-area02">
										<a href="/board/board.php?site_id=chslc&TREE_NO=15988&DEPTH=2" class="main-menu-box02">
											<span class="group">
												<strong>
													자료실
												</strong>
												<span>
													언어치료센터 자료실 <span class="span-br"></span>
													입니다.
												</span>

												<img src="../img/main/icon_menu0301.png" alt="" />
											</span>

											<img src="../img/main/icon_more02.gif" alt="" class="more" />
										</a>
									</div>

									<div class="main-menu-area02">
										<a href="/contents/contents_view.php?site_id=chslc&TREE_NO=15986&DEPTH=2" class="main-menu-box02">
											<span class="group">
												<strong>
												이용안내
												</strong>
												<span>
													치료절차에 대해 알려<span class="span-br"></span>
													드립니다.
												</span>

												<img src="../img/main/icon_menu0302.png" alt="" />
											</span>

											<img src="../img/main/icon_more02.gif" alt="" class="more" />
										</a>
									</div>

									<div class="main-menu-area02">
										<div class="main-menu-box02">
											<span class="group">
												<strong>
													052)221-8686
												</strong>
												<span>
													언어치료센터 예약전화
												</span>

												<img src="../img/main/icon_menu0303.png" alt="" />
											</span>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					
				</article>

				
				
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

		/* service slider 01 */
		var mainBannerSlider01 = new Swiper('#main-banner-slider01', {
			loop : true, // 슬라이드 반복
			autoplay: {
				delay: 10000,
				disableOnInteraction: false,
			},
			pagination: {
				el: '#main-banner-pagination01',
				clickable: true,
			},
			navigation: {
				nextEl: '.main-btn-next',
				prevEl: '.main-btn-prev',
			},
		});

	</script>
</body>
</html>


