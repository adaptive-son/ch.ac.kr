<!doctype html>
<html lang="ko">
<head>
	<? include "../include/meta_260519.php" ?>

	<link rel="stylesheet" href="../css/main.css?ver=<?php echo time()?>">
	<script src="../js/main.js?ver=<?php echo time()?>"></script>

	<!-- swiper -->
	<link rel="stylesheet" href="/assets/css/swiper.min.css?ver=<?php echo time()?>">
	<script src="/assets/js/swiper.min.js?ver=<?php echo time()?>"></script>
	<!-- //swiper -->

	<title>
		국제교류처 - 춘해보건대학교
	</title>
</head>

<body> 
	<? include("../../_common/popup.php");?>
	<!-- wrapper -->
	<div class="wrapper" id="wrapper">	
		<!-- header -->
		<header>
			<? include "../include/header_260518.php" ?>
		</header>
		<!-- //header -->
		<!-- container -->
		<section>
			<div class="main-container" id="container">
				
				<!-- main contents 01 -->
				<article>

					<div class="main-contents01" id="contents">
						<div class="main-visual-wrapper">
							<img src="../img/main/main_visual_slide01_pc.jpg" alt="" class="pc"/>
							<img src="../img/main/main_visual_slide01_mobile.jpg" alt="" class="mobile"/>
						
							<p class="main-slogan-wrapper">
								<img src="../img/main/word_main_slogan01.png" alt="Forest &amp; Landscape Architecture Business 산림자원의 보존과 관리, 생태조경을 위한 글로컬 산림·조경 전문가 양성, 울산 유일의 산림·조경 전문가 양성 학과로 졸업과 동시에 산림·조경 관련 자격증 취득을 통해 다양한 산림·조경 분야에 취업이 가능하여 평생직업이 보장된 학과입니다.">
							</p>
						</div>
					</div>

				</article>
				<!-- //main contents 01 -->


				<!-- main contents 02 -->
				<article>
					<div class="main-contents02">

						<div class="main-contents-wrapper">

							<div class="main-contents-title-wrapper">
								<img src="../img/main/main-contents-title01.png" class="pc" alt="국제교류처에 오신걸 환영합니다. Welcome! International Affairs Office.">
								<img src="../img/main/main-contents-title01_m.png" class="mobile" alt="국제교류처에 오신걸 환영합니다. Welcome! International Affairs Office.">
							</div>

							<div class="tab-btns-wrapper">

								<button class=" main-tab01 active" >
									<div class="tab-tit">
										<span>한국어교육원</span>
										<span class="eng">Korean Language Institute</span>
									</div>
								</button>

								<button class="main-tab02 ">
									<div class="tab-tit">
										<span>글로벌센터</span>
										<span class="eng">Global Center</span>
									</div>
								</button>

								<button class="main-tab03 ">
									<div class="tab-tit">
										<span>국제개발협력센터</span>
										<span class="eng">Int'l Development Cooperation Center</span>
									</div>
								</button>

							</div>
							
							<div class="tab-contents-wrapper">

								<div class="tab-contents tab-contents-01 korean on">

									<!-- main board -->
									<div class="board-list-wrapper">
										<ul>
										<?php
											// (테이블명, 코드, 보드타입, 게시물수, 내용글수)
											$bbs_no="2912";
											$boardList = BBS_GetList("bbs_global", $bbs_no, 0, 3, 300);

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
												<a href="<?php echo $view_linkUrl?>&data=<?=$v['linkdata']?>">
													<div class="board-tit-wrapper">
														
														<div class="board-type">
															<span>공지</span>
														</div>
														<p class="board-tit">
															<?php echo $v['title']?>
														</p>
													</div>
													<p class="board-content">
														<?php echo $v['content']?>
													</p>

													<span class="board-date">
														<?php echo $v['datetime']?>
													</span>
												</a>
											</li>
										<?php
											}
										?>
											
										</ul>

										<a href="<?php echo $more_linkUrl?>" class="btn-board-more">
											<span>공지사항 더보기</span>
										</a>

										
									</div>
									<!-- //main board -->

									<!-- main menu -->
									<div class="main-menu02">
								
										<ul>

											<li>
												<a href="../sub04/sub01.php">
													<span class="image">
														<img src="../img/main/icon_menu0101.png" alt="" />
													</span>
													<strong>
														한국어교육원 소개
													</strong>
												</a>
											</li>

											<li>
												<a href="../sub04/sub02.php">
													<span class="image">
														<img src="../img/main/icon_menu0102.png" alt="" />
													</span>
													<strong>
														서류제출
													</strong>
												</a>
											</li>

											<li>
												<a href="https://ch.ac.kr/contents/contents_view.php?site_id=main&TREE_NO=16110&DEPTH=4" target="_blank">
													<span class="image">
														<img src="../img/main/icon_menu0103.png" alt="" />
													</span>
													<strong>
														기숙사안내
													</strong>
												</a>
											</li>

											<!-- 처음 3개 이후 li line 클래스 달것 -->
											<li class="line">
												<a href="../sub04/sub05.php">
													<span class="image">
														<img src="../img/main/icon_menu0104.png" alt="" />
													</span>
													<strong>
														FAQ
													</strong>
												</a>
											</li>

											<li class="line">
												<a href="/board/board.php?site_id=global&TREE_NO=16406&DEPTH=2">
													<span class="image">
														<img src="../img/main/icon_menu0105.png" alt="" />
													</span>
													<strong>
														자료실
													</strong>
												</a>
											</li>

											<li class="line">
												<a href="https://www.youtube.com/channel/UC4mS4ygHn3FBWa-APxtT_bg" target="_blank">
													<span class="image">
														<img src="../img/main/icon_menu0106.png" alt="" />
													</span>
													<strong>
														홍보영상
													</strong>
												</a>
											</li>
										</ul>
									</div>
									<!-- //main menu -->

									<!-- main banner -->
									<div class="main-banner-wrapper">
										<a href="../sub04/sub03.php">
											<img src="../img/main/main-banner-01.jpg" class="pc" alt="국제화시대 글로벌 인재양성 한국어연수 프로그램 안내">
											<img src="../img/main/main-banner-01-m.jpg" class="mobile" alt="국제화시대 글로벌 인재양성 한국어연수 프로그램 안내">
										</a>
									</div>
									<!-- //main banner -->

									<!-- photo gallery -->

									<div class="main-board-wrapper main-gallery-wrapper">
										
										<div class="board-tit">
											<h2>
												한국어교육원
												<strong>포토갤러리</strong>
											</h2>

											<p>
												세계속의 대학교로 
												발전해 나가겠습니다.
											</p>

											<a href="/board/board.php?site_id=global&TREE_NO=16405&DEPTH=2" class="btn-more">
												more
											</a>
										</div>

										<ul>
										<?php
											// (테이블명, 코드, 보드타입, 게시물수, 내용글수)
											$bbs_no="2913";
											$boardList = BBS_GetList("bbs_global", $bbs_no, 1, 2, 300);

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
												<a href="<?php echo $view_linkUrl?>&data=<?=$v['linkdata']?>" class="main-gallery-box">
													<span class="main-gallery-img">
														<img src="/data/bbs_upload/<?php echo $v['file_path']?>" alt="" />
													</span>
													<strong class="title">
													<?php echo $v['title']?>
													</strong>
												</a>
											</li>
										<?php
											}

										?>
											
										</ul>

							

									</div>

									<!-- //photo gallery -->



								</div>

								<div class="tab-contents tab-contents-02 global">

									<!-- main board -->
									<div class="board-list-wrapper">
									
										<ul>
										<?php
											// (테이블명, 코드, 보드타입, 게시물수, 내용글수)
											$bbs_no="2915";
											$boardList = BBS_GetList("bbs_global", $bbs_no, 0, 3, 300);

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
												<a href="<?php echo $view_linkUrl?>&data=<?=$v['linkdata']?>">
													<div class="board-tit-wrapper">
														
														<div class="board-type">
															<span>공지</span>
														</div>
														<p class="board-tit">
															<?php echo $v['title']?>
														</p>
													</div>
													<p class="board-content">
														<?php echo $v['content']?>
													</p>

													<span class="board-date">
														<?php echo $v['datetime']?>
													</span>
												</a>
											</li>
										<?php
											}
										?>
											

										</ul>

										<a href="/board/board.php?site_id=global&TREE_NO=16412&DEPTH=2" class="btn-board-more">
											<span>공지사항 더보기</span>
										</a>

										
									</div>
									<!-- //main board -->

									<!-- main menu -->
									<div class="main-menu02">
								
										<ul>

											<li>
												<a href="../sub05/sub01.php">
													<span class="image">
														<img src="../img/main/icon_menu0101.png" alt="" />
													</span>
													<strong>
														글로벌센터소개
													</strong>
												</a>
											</li>

											<li>
												<a href="../sub05/sub02.php">
													<span class="image">
														<img src="../img/main/icon_menu0202.png" alt="" />
													</span>
													<strong>
														Start up
													</strong>
												</a>
											</li>

											<li>
												<a href="../sub05/sub03.php">
													<span class="image">
														<img src="../img/main/icon_menu0203.png" alt="" />
													</span>
													<strong>
														Do it
													</strong>
												</a>
											</li>

											<li>
												<a href="../sub05/sub04.php">
													<span class="image">
														<img src="../img/main/icon_menu0204.png" alt="" />
													</span>
													<strong>
														Growing
													</strong>
												</a>
											</li>

											<li>
												<a href="../sub05/sub05.php">
													<span class="image">
														<img src="../img/main/icon_menu0205.png" alt="" />
													</span>
													<strong>
														글로벌현장학습
													</strong>
												</a>
											</li>

											<li>
												<a href="../sub05/sub07.php" >
													<span class="image">
														<img src="../img/main/icon_menu0206.png" alt="" />
													</span>
													<strong>
														FAQ
													</strong>
												</a>
											</li>
										</ul>
									</div>
									<!-- //main menu -->

									<!-- main banner -->
									<div class="main-banner-wrapper">
										<a href="../sub05/sub01.php">
											<img src="../img/main/main-banner-02.jpg" alt="국제적 수준의 보건의료 전문가 양성" class="pc">
											<img src="../img/main/main-banner-02-m.jpg" alt="국제적 수준의 보건의료 전문가 양성" class="mobile">
										</a>
									</div>
									<!-- //main banner -->

									<!-- photo gallery -->

									<div class="main-board-wrapper main-gallery-wrapper">
										
										<div class="board-tit">
											<h2>
												글로벌센터
												<strong>포토갤러리</strong>
											</h2>

											<p>
												세계속의 대학교로 
												발전해 나가겠습니다.
											</p>

											<a href="/board/board.php?site_id=global&TREE_NO=16414&DEPTH=2" class="btn-more">
												more
											</a>
										</div>

										<ul>
										<?php
											// (테이블명, 코드, 보드타입, 게시물수, 내용글수)
											$bbs_no="2916";
											$boardList = BBS_GetList("bbs_global", $bbs_no, 1, 2, 300);

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
												<a href="<?php echo $view_linkUrl?>&data=<?=$v['linkdata']?>" class="main-gallery-box">
													<span class="main-gallery-img">
													<img src="/data/bbs_upload/<?php echo $v['file_path']?>" alt="" />
													</span>
													<strong class="title">
													<?php echo $v['title']?>
													</strong>
												</a>
											</li>
										<?php
											}
										?>
											
										</ul>
									</div>
									<!-- //photo gallery -->
								</div>

								<div class="tab-contents tab-contents-03 develop ">

									<!-- main board -->
									<div class="board-list-wrapper">
									
										<ul>
										<?php
											// (테이블명, 코드, 보드타입, 게시물수, 내용글수)
											$bbs_no="2918";
											$boardList = BBS_GetList("bbs_global", $bbs_no, 0, 3, 300);

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
												<a href="<?php echo $view_linkUrl?>&data=<?=$v['linkdata']?>">
													<div class="board-tit-wrapper">
														
														<div class="board-type">
															<span>공지</span>
														</div>
														<p class="board-tit">
															<?php echo $v['title']?>
														</p>
													</div>
													<p class="board-content">
														<?php echo $v['content']?>
													</p>

													<span class="board-date">
														<?php echo $v['datetime']?>
													</span>
												</a>
											</li>
										<?php
											}
										?>
											
										</ul>

										<a href="/board/board.php?site_id=global&TREE_NO=16417&DEPTH=2" class="btn-board-more">
											<span>공지사항 더보기</span>
										</a>

										
									</div>
									<!-- //main board -->

									<!-- main menu -->
									<div class="main-menu02">
								
										<ul>

											<li>
												<a href="../sub06/sub01.php">
													<span class="image">
														<img src="../img/main/icon_menu0301.png" alt="" />
													</span>
													<strong>
														국제개발협력센터 소개
													</strong>
												</a>
											</li>

											<li>
												<a href="../sub06/sub06.php">
													<span class="image">
														<img src="../img/main/icon_menu0302.png" alt="" />
													</span>
													<strong>
														개발협력사업
													</strong>
												</a>
											</li>

											<li>
												<a href="../sub06/sub03.php">
													<span class="image">
														<img src="../img/main/icon_menu0303.png" alt="" />
													</span>
													<strong>
														FAQ
													</strong>
												</a>
											</li>

											<li>
												<a href="/board/board.php?site_id=global&TREE_NO=16420&DEPTH=2">
													<span class="image">
														<img src="../img/main/icon_menu0304.png" alt="" />
													</span>
													<strong>
														자료실
													</strong>
												</a>
											</li>

											<li>
												<a href="https://oda.koica.go.kr/" target="_blank">
													<span class="image">
														<img src="../img/main/icon_menu0305.png" alt="" />
													</span>
													<strong>
														KOICA ODA 교육원
													</strong>
												</a>
											</li>

											<li>
												<a href="https://www.youtube.com/channel/UC4mS4ygHn3FBWa-APxtT_bg" target="_blank">
													<span class="image">
														<img src="../img/main/icon_menu0306.png" alt="" />
													</span>
													<strong>
														홍보영상
													</strong>
												</a>
											</li>
										</ul>
									</div>
									<!-- //main menu -->

									<!-- main banner -->
									<div class="main-banner-wrapper">
										<a href="../sub06/sub01.php">
											<img src="../img/main/main-banner-03.jpg" alt="국제개발협력 역량을 갖춘 글로컬 인재 양성" class="pc">
											<img src="../img/main/main-banner-03-m.jpg" alt="국제개발협력 역량을 갖춘 글로컬 인재 양성" class="mobile">
										</a>
									</div>
									<!-- //main banner -->

									<!-- photo gallery -->

									<div class="main-board-wrapper main-gallery-wrapper">
										
										<div class="board-tit">
											<h2>
												국제개발협력센터
												<strong>포토갤러리</strong>
											</h2>

											<p>
												세계속의 대학교로 
												발전해 나가겠습니다.
											</p>

											<a href="/board/board.php?site_id=global&TREE_NO=16419&DEPTH=2" class="btn-more">
												more
											</a>
										</div>

										<ul>
										<?php
											// (테이블명, 코드, 보드타입, 게시물수, 내용글수)
											$bbs_no="2919";
											$boardList = BBS_GetList("bbs_global", $bbs_no, 1, 2, 300);

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
												<a href="<?php echo $view_linkUrl?>&data=<?=$v['linkdata']?>" class="main-gallery-box">
													<span class="main-gallery-img">
													<img src="/data/bbs_upload/<?php echo $v['file_path']?>" alt="" />
													</span>
													<strong class="title">
													<?php echo $v['title']?>
													</strong>
												</a>
											</li>
										<?php
											}
										?>
											
										</ul>
									</div>
									<!-- //photo gallery -->
								</div>
							</div>
						</div>
					</div>
				</article>
				<!-- //main contents 02 -->
				
			</div>
		</section>
		<!-- //container -->

		<!-- footer -->
		<footer>
			<? include("../../_common/footer.php");?>
		</footer>
		<!-- //footer -->
	</div>
	<!-- //wrapper -->
	<script>
		menuOn(0, 0, 0);

		var mainMobileNewsSlider = new Swiper('#main-mobile-news-slider', {
			loop: true,
			autoHeight: true, // 슬라이드 반복
			slidesPerView: 1,
			spaceBetween: 0,
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

	<script>

		var mainTabBtn = $('.tab-btns-wrapper').children('button');
		var mainTabCon = $('.tab-contents-wrapper').children('.tab-contents');
		
		mainTabBtn.on('click',function(){

			let i = $(this).index();

			$(this).addClass('active').siblings().removeClass('active');
			
			mainTabCon.eq(i).addClass('on');
			mainTabCon.eq(i).siblings().removeClass('on');

		});





	</script>
</body>
</html>


