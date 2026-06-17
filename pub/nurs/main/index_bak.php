<!doctype html>
<html lang="ko">
<head>
	<? include "../include/meta.php" ?>

	<link rel="stylesheet" href="../css/main.css">
	<script src="../js/main.js"></script>

	<title>
		간호학과 - 춘해보건대학교
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
				
				<article>
					<div class="main-contents01" id="contents">
						<div class="main-visual-wrapper">
							<img src="../img/main/main_visual_pc01.jpg" alt="" class="pc"/>
							<img src="../img/main/main_visual_mobile01.jpg" alt="" class="mobile"/>
							
							<p class="main-slogan-wrapper">
								<img src="../img/main/word_main_slogan01.png" alt="Department of Nursing 글로벌 간호리더 창의적 전문인재 양성, 춘해보건대학교 간호학과는  1968년도 간호교육 시작한 이래 지역 및 국가의 국민건강 향상을 위한 우수한 간호전문 인재배출에 기여해 왔습니다." />
							</p>
						</p>
					</div>

					<div class="main-menu01-wrapper">
						<div class="main-menu01-area">
							<a href="http://ipsiw.ch.ac.kr/page/main/index.php" target="_blank" title="새창열림">
								<img src="../img/main/icon_menu0101.png" alt="입학안내" />
								<span class="word">
									<strong>
										입학안내
									</strong>

									<span>
										학과 입학에 대한 모든<br />
										궁금증 해결 
									</span>
								</span>
							</a>
						</div>

						<div class="main-menu01-area">
							<a href="/pub/contents/contents_view.php?site_id=nurs&TREE_NO=5814&DEPTH=2">
								<img src="../img/main/icon_menu0102.png" alt="교육시설·기자재" />
								<span class="word">
									<strong>
										교육시설·기자재
									</strong>

									<span>
										첨단 시뮬레이션 실습실에서의<br />
										1:1 맞춤형 임상재현 실습
									</span>
								</span>
							</a>
						</div>

						<div class="main-menu01-area">
							<a href="/pub/contents/contents_view.php?site_id=nurs&TREE_NO=5828&DEPTH=2">
								<img src="../img/main/icon_menu0103.png" alt="졸업생 한마디" />
								<span class="word">
									<strong>
										졸업생 한마디
									</strong>

									<span>
										사회 첫 발을 내딛은<br />
										선배들의 이야기
									</span>
								</span>
							</a>
						</div>

						<div class="main-menu01-area">
							<a href="/pub/contents/contents_view.php?site_id=nurs&TREE_NO=5829&DEPTH=2">
								<img src="../img/main/icon_menu0104.png" alt="취업현황" />
								<span class="word">
									<strong>
										취업현황
									</strong>

									<span>
										학과 취업현황에 대한<br />
										모든 궁금증 해결 
									</span>
								</span>
							</a>
						</div>
					</div>
				</article>

				<article>
					<div class="main-contents02">
						<div class="main-contents-wrapper">
							<!-- main board, movie -->
							<div class="main-contents-area">
								<!-- main board -->
								<div class="main-board-wrapper">
									<div class="title-area">
										<h2>
											간호학과
										</h2>
										<p>
											춘해보건대학교 간호사는 21세기 글로벌 시대를<span></span>
											이끌어 나갈 인간존중 실무중심 전문직<span></span>
											간호사를 양성하는 것입니다.
										</p>
									</div>

									<div class="main-board-area">
										<ul>
											<li>
												<button type="button" class="active">
													공지사항
												</button>

												<div class="main-board-box">
													<ul>
														<?
														// (테이블명, 코드, 보드타입, 게시물수, 내용글수)
														$bbs_no="1210";
														$boardList = BBS_GetList("bbs_nurs", $bbs_no, 0, 4, 300);

														// 게시판 메뉴 정보 가져오기
														$sql_BoardInfomation = " SELECT TREE_NO, DEPTH FROM ".TABLE_TREE." WHERE CONTENTS LIKE '%".$bbs_no."%' and TREE_ID = '".site_id."' ";
														$row_BoardTreeInfo = $adb->getRow($sql_BoardInfomation, DB_FETCHMODE_ASSOC);
														$param_menuInfo = "site_id=".site_id."&TREE_NO=".$row_BoardTreeInfo[TREE_NO]."&DEPTH=".($row_BoardTreeInfo[DEPTH]+1);
														$more_linkUrl = "/pub/board/board.php?".$param_menuInfo;
														$view_linkUrl = $more_linkUrl."&bbs=see";
														$url_target = "";
														foreach ( $boardList as $k => $v ) {
															?>
															<li>
																<a href="<?=$view_linkUrl?>&data=<?=$v['linkdata']?>">
																	<span class="title-area">
																		<strong>
																			<?=$v['title']?>
																		</strong>
																	</span>
																	<span class="date">
																		<?=$v['datetime']?>
																	</span>
																</a>
															</li>
														<?}?>
														<? if(count($boardList)==0){?>
															<li>
																<a>
																	<span class="title-area">
																		<strong>
																			게시물이 없습니다
																		</strong>
																	</span>
																</a>
															</li>
														<?php }?>
													</ul>

													<a href="<?=$more_linkUrl?>" class="btn-more" title="공지사항 더보기" >
														<img src="../img/main/icon_more01.gif" />
													</a>
												</div>
											</li>

											<li>
												<button type="button">
													취업정보
												</button>

												<div class="main-board-box">
													<ul>
														<?
														// (테이블명, 코드, 보드타입, 게시물수, 내용글수)
														$bbs_no="1211";
														$boardList = BBS_GetList("bbs_nurs", $bbs_no, 0, 4, 300);

														// 게시판 메뉴 정보 가져오기
														$sql_BoardInfomation = " SELECT TREE_NO, DEPTH FROM ".TABLE_TREE." WHERE CONTENTS LIKE '%".$bbs_no."%' and TREE_ID = '".site_id."' ";
														$row_BoardTreeInfo = $adb->getRow($sql_BoardInfomation, DB_FETCHMODE_ASSOC);
														$param_menuInfo = "site_id=".site_id."&TREE_NO=".$row_BoardTreeInfo[TREE_NO]."&DEPTH=".($row_BoardTreeInfo[DEPTH]+1);
														$more_linkUrl = "/pub/board/board.php?".$param_menuInfo;
														$view_linkUrl = $more_linkUrl."&bbs=see";
														$url_target = "";
														foreach ( $boardList as $k => $v ) {
															?>
															<li>
																<a href="<?=$view_linkUrl?>&data=<?=$v['linkdata']?>">
																	<span class="title-area">
																		<strong>
																			<?=$v['title']?>
																		</strong>
																	</span>
																	<span class="date">
																		<?=$v['datetime']?>
																	</span>
																</a>
															</li>
														<?}?>
														<? if(count($boardList)==0){?>
															<li>
																<a>
																	<span class="title-area">
																		<strong>
																			게시물이 없습니다
																		</strong>
																	</span>
																</a>
															</li>
														<?php }?>
													</ul>

													<a href="<?=$more_linkUrl?>" class="btn-more" title="취업정보 더보기" >
														<img src="../img/main/icon_more01.gif" />
													</a>
												</div>
											</li>
										</ul>
									</div>

									<script>
										$(function() {
											$(".main-board-area > ul > li > button").on("click", function() {
												$(".main-board-area > ul > li > button").removeClass('active');
												$(this).addClass('active');
											});
										});
									</script>
								</div>
								<!-- //main board -->

								<!-- main movie -->
								<div class="main-movie-wrapper">
									<a href="#" class="main-movie-area">
										<h3>
											<span class="title">
												<span>
													춘해보건대학교
												</span>
												<strong>
													학과동영상
												</strong>
											</span>
										</h3>
										<div class="main-movie-box">
											<img src="../img/main/img_movie01.jpg" alt="" class="bg"/>
											<img src="../img/main/btn_play.png" alt="" class="icon-movie"/>
										</div>
									</a>
								</div>
								<!-- //main movie -->
							</div>
							<!-- //main board, movie -->

							<!-- main menu -->
							<div class="main-menu02">
								<ul>
									<li>
										<a href="#">
											<span class="image center-crop">
												<img src="../img/main/icon_menu0201.png" alt="교수소개" />
											</span>
											<strong>
												교수소개
											</strong>
										</a>
									</li>

									<li>
										<a href="/pub/board/board.php?site_id=nurs&TREE_NO=5836&DEPTH=2">
											<span class="image center-crop">
												<img src="../img/main/icon_menu0202.png" alt="자료실" />
											</span>
											<strong>
												자료실
											</strong>
										</a>
									</li>

									<li>
										<a href="/pub/board/board.php?site_id=nurs&TREE_NO=5837&DEPTH=2">
											<span class="image center-crop">
												<img src="../img/main/icon_menu0203.png" alt="동아리활동" />
											</span>
											<strong>
												동아리활동
											</strong>
										</a>
									</li>

									<li>
										<a href="#">
											<span class="image center-crop">
												<img src="../img/main/icon_menu0204.png" alt="교육과정" />
											</span>
											<strong>
												교육과정
											</strong>
										</a>
									</li>

									<li>
										<a href="/pub/contents/contents_view.php?site_id=nurs&TREE_NO=5827&DEPTH=2">
											<span class="image center-crop">
												<img src="../img/main/icon_menu0205.png" alt="졸업후진로" />
											</span>
											<strong>
												졸업 후 진로
											</strong>
										</a>
									</li>

									<li>
										<a href="#">
											<span class="image center-crop">
												<img src="../img/main/icon_menu0206.png" alt="" />
											</span>
											<strong>
												장학제도
											</strong>
										</a>
									</li>
								</ul>
							</div>
							<!-- //main menu -->
						</div>
					</div>
				</article>

				<article>
					<div class="main-contents03">
						<div class="main-contents-wrapper">
							<div class="main-news-wrapper">
								<h2>
									학과뉴스
								</h2>

								<div class="main-news-area pc">
									<ul>
										<li>
											<a href="#" class="main-news-box">
												<span class="image center-crop">
													<img src="../img/main/img_dummy_new01.jpg" alt="" />
												</span>
												<strong class="title">
													2019-2학기 전문대학 글로벌 현장학습  발대식
												</strong>
												<span class="date">
													2019.05.25
												</span>
											</a>
										</li>

										<li>
											<a href="#" class="main-news-box">
												<span class="image center-crop">
													<img src="../img/main/img_dummy_new02.jpg" alt="" />
												</span>
												<strong class="title">
													국제개발협력 이해증진사업 필리핀 해외봉사
												</strong>
												<span class="date">
													2019.05.25
												</span>
											</a>
										</li>

										<li>
											<a href="#" class="main-news-box">
												<span class="image center-crop">
													<img src="../img/main/img_dummy_new03.jpg" alt="" />
												</span>
												<strong class="title">
													간호학과 이경리 교수, '시시콜콜 100인 토크' 패널로 참석
												</strong>
												<span class="date">
													2019.05.25
												</span>
											</a>
										</li>

										<li>
											<a href="#" class="main-news-box">
												<span class="image center-crop">
													<img src="../img/main/img_dummy_new04.jpg" alt="" />
												</span>
												<strong class="title">
													산악부, 제52회 대통령기 전국 등산 대회서 수상산악부, 제52회 대통령기 전국 등산 대회서 수상산악부, 제52회 대통령기 전국 등산 대회서 수상
												</strong>
												<span class="date">
													2019.05.25
												</span>
											</a>
										</li>
									</ul>
								</div>

								<div class="main-news-area mobile">

									<div class="swiper-container" id="main-mobile-news-slider">
										<div class="swiper-wrapper">
											<div class="swiper-slide">
												<a href="#" class="main-news-box">
													<span class="image center-crop">
														<img src="../img/main/img_dummy_new01.jpg" alt="" />
													</span>
													<strong class="title">
														2019-2학기 전문대학 글로벌 현장학습  발대식
													</strong>
													<span class="date">
														2019.05.25
													</span>
												</a>
											</div>
											<div class="swiper-slide">
												<a href="#" class="main-news-box">
													<span class="image center-crop">
														<img src="../img/main/img_dummy_new02.jpg" alt="" />
													</span>
													<strong class="title">
														국제개발협력 이해증진사업 필리핀 해외봉사
													</strong>
													<span class="date">
														2019.05.25
													</span>
												</a>
											</div>

											<div class="swiper-slide">
												<a href="#" class="main-news-box">
													<span class="image center-crop">
														<img src="../img/main/img_dummy_new03.jpg" alt="" />
													</span>
													<strong class="title">
														간호학과 이경리 교수, '시시콜콜 100인 토크' 패널로 참석
													</strong>
													<span class="date">
														2019.05.25
													</span>
												</a>
											</div>
											<div class="swiper-slide">
												<a href="#" class="main-news-box">
													<span class="image center-crop">
														<img src="../img/main/img_dummy_new04.jpg" alt="" />
													</span>
													<strong class="title">
														산악부, 제52회 대통령기 전국 등산 대회서 수상산악부, 제52회 대통령기 전국 등산 대회서 수상산악부, 제52회 대통령기 전국 등산 대회서 수상
													</strong>
													<span class="date">
														2019.05.25
													</span>
												</a>
											</div>
										</div>
									</div>

									<div class="swiper-pagination"></div>


								</div>

								<a href="#" class="btn-more" title="학과뉴스 더보기">
									<img src="../img/main/icon_more01.gif" alt="" />
								</a>





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

		var mainMobileNewsSlider = new Swiper('#main-mobile-news-slider', {
			loop: true,
			autoHeight: true, // 슬라이드 반복
			slidesPerView: 2,
			spaceBetween: 30,
			autoplay: {
				delay: 10000,
				disableOnInteraction: false,
			},
			pagination: {
				el: '.swiper-pagination',
				clickable: true,
			}
		});
	</script>
</body>
</html>


