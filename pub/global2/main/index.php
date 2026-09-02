<!doctype html>
<html lang="ko">
<head>
	<? include "../include/meta.php" ?>


	<link rel="stylesheet" href="../assets/css/swiper.min.css">
	<script src="../assets/js/swiper.min.js"></script>

	<link rel="stylesheet" href="../css/main.css">
	<script src="../js/main.js"></script>

	<title>
		국제교류처 - 춘해보건대학교
	</title>
</head>

<body class="main">
	<? include("../../_common/popup.php");?>
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
				<article data-aside-theme="light">
					<div class="main-contents01" id="contents">
						<div class="main-visual-wrapper">
							<div id="main-visual-slider" class="swiper">
								<div class="swiper-wrapper">
									<?php
									// 메인 배너 : 관리자(배너관리)에서 site_id=global2로 등록한 배너를 노출
									$mainVisual_today = date("Y-m-d");
									$mainVisual_query = " SELECT * FROM ".TABLE_BANNER." WHERE site_id='".site_id."' AND useyn='Y' AND (location='1' OR location IS NULL OR location='') AND '".$mainVisual_today."' BETWEEN gigan1 AND gigan2 ORDER BY sort ASC, no DESC ";
									$mainVisual_result = DBquery($mainVisual_query);
									$mainVisual_count = 0;
									while ( $mainVisual_row = mysql_fetch_array($mainVisual_result) ) {
										$mainVisual_count++;
									?>
									<div class="swiper-slide">
										<img src="<?=BANNER_LOAD_PATH?>/<?=$mainVisual_row[banner_name]?>" alt="<?=$mainVisual_row[title]?>" class="banner-img" />

										<div class="main-slogan-wrapper">
											<?php if ( trim($mainVisual_row[title]) != "" || trim($mainVisual_row[slogan]) != "" ) { ?>
											<p class="main-slogan-area">
												<?php if ( trim($mainVisual_row[title]) != "" ) { ?>
												<span>
													<?=$mainVisual_row[title]?>
												</span>
												<?php } ?>
												<?php if ( trim($mainVisual_row[slogan]) != "" ) { ?>
												<strong>
													<?php
													// 슬로건 textarea의 줄바꿈 그대로 반영
													$mainVisual_sloganLines = preg_split("/\r\n|\r|\n/", $mainVisual_row[slogan]);
													foreach ( $mainVisual_sloganLines as $mainVisual_sloganLine ) {
														if ( trim($mainVisual_sloganLine) == "" ) continue;
													?>
													<span><?=$mainVisual_sloganLine?></span>
													<?php } ?>
												</strong>
												<?php } ?>
											</p>
											<?php } ?>

											<?php if ( $mainVisual_row[link_url] ) { ?>
											<a href="<?=$mainVisual_row[link_url]?>" target="<?=$mainVisual_row[target]?>" class="btn-go">
												<strong>바로가기</strong>
												<img src="../img/main/icon_arrow01.png" alt="" />
											</a>
											<?php } ?>
										</div>
									</div>
									<?php } ?>

									<?php if ( $mainVisual_count == 0 ) { ?>
									<div class="swiper-slide">
										<img src="../img/main/main_visual01_pc.jpg" alt="" class="pc" />
										<img src="../img/main/main_visual01_mobile.jpg" alt="" class="mobile" />

										<div class="main-slogan-wrapper">
											<p class="main-slogan-area">
												<span>
													국제무대에서 경쟁력 있는 인재로<span class="span-mobile-br"></span> 성장할 수 있도록 돕습니다.
												</span>
												<strong>
													<span>세계와 연결되는 배움의 시작,</span>
													<span>춘해보건대학교 국제교류처</span>
												</strong>
											</p>

											<a href="#" class="btn-go">
												<strong>센터소개</strong>
												<img src="../img/main/icon_arrow01.png" alt="" />
											</a>
										</div>
									</div>
									<?php } ?>
								</div>

								<button type="button" class="main-visual-prev01" aria-label="이전 이미지"></button>
								<button type="button" class="main-visual-next01" aria-label="다음 이미지"></button>
							</div>
						</div>

						<div class="main-menu-wrapper">
							<ul>
								<li>
									<a href="<?=$find_2depth[16616][LINK_URL]?>">
										<span class="icon">
											<img src="../img/main/icon_menu0101.png" alt="" />
										</span>
										<strong>
											해외교류 현황
										</strong>
									</a>
								</li>
								<li>
									<a href="<?=$find_2depth[16627][LINK_URL]?>">
										<span class="icon">
											<img src="../img/main/icon_menu0102.png" alt="" />
										</span>
										<strong>
											한국어<span class="span-mobile-br"></span>교육센터
										</strong>
									</a>
								</li>
								<li>
									<a href="<?=$find_2depth[16639][LINK_URL]?>">
										<span class="icon">
											<img src="../img/main/icon_menu0103.png" alt="" />
										</span>
										<strong>
											글로벌<span class="span-mobile-br"></span>센터
										</strong>
									</a>
								</li>
								<li>
									<a href="<?=$find_2depth[16648][LINK_URL]?>">
										<span class="icon">
											<img src="../img/main/icon_menu0104.png" alt="" />
										</span>
										<strong>
											국제개발<span class="span-mobile-br"></span>협력센터
										</strong>
									</a>
								</li>
								<li>
									<a href="<?=$find_2depth[16622][LINK_URL]?>">
										<span class="icon">
											<img src="../img/main/icon_menu0105.png" alt="" />
										</span>
										<strong>
											학사일정
										</strong>
									</a>
								</li>
								<li>
									<a href="<?=$find_2depth[16623][LINK_URL]?>">
										<span class="icon">
											<img src="../img/main/icon_menu0106.png" alt="" />
										</span>
										<strong>
											장학안내
										</strong>
									</a>
								</li>
								<li>
									<a href="<?=$find_2depth[16624][LINK_URL]?>">
										<span class="icon">
											<img src="../img/main/icon_menu0107.png" alt="" />
										</span>
										<strong>
											체류관리
										</strong>
									</a>
								</li>
								<li>
									<a href="<?=$find_2depth[16615][LINK_URL]?>">
										<span class="icon">
											<img src="../img/main/icon_menu0108.png" alt="" />
										</span>
										<strong>
											찾아오시는길
										</strong>
									</a>
								</li>
							</ul>
						</div>
					</div>

				</article>

				<article data-aside-theme="dark">
					<div class="main-notice-wrapper">
						<div class="main-notice-inner">
							<div class="main-notice-head">
								<h2>공지사항을 알려드립니다</h2>
							</div>
							<?php
							// 공지사항 : 국제교류처(2910) / 한국어교육센터(2912) / 글로벌센터(2915) / 국제개발협력센터(2918)
							// 4개 게시판을 합쳐 최신순 정렬 후 상위 4건만 노출
							$notice_sources = array(
								"2910" => "국제교류처",
								"2912" => "한국어교육센터",
								"2915" => "글로벌센터",
								"2918" => "국제개발협력센터",
							);

							$notice_merged = array();
							foreach ($notice_sources as $notice_bbsNo => $notice_label) {
								$notice_items = BBS_GetList("bbs_global", $notice_bbsNo, 0, 4, 0);

								$sql_noticeTreeInfo = " SELECT TREE_NO, DEPTH FROM ".TABLE_TREE." WHERE CONTENTS LIKE '%".$notice_bbsNo."%' and TREE_ID = '".site_id."' ";
								$row_noticeTreeInfo = $adb->getRow($sql_noticeTreeInfo, DB_FETCHMODE_ASSOC);
								$notice_viewUrl = "/board/board.php?site_id=".site_id."&TREE_NO=".$row_noticeTreeInfo[TREE_NO]."&DEPTH=".($row_noticeTreeInfo[DEPTH]+1)."&bbs=see";

								foreach ($notice_items as $notice_item) {
									$notice_item['label'] = $notice_label;
									$notice_item['view_url'] = $notice_viewUrl."&data=".$notice_item['linkdata'];
									$notice_merged[] = $notice_item;
								}
							}

							usort($notice_merged, function($a, $b) {
								return strcmp($b['datetime'], $a['datetime']);
							});

							$notice_merged = array_slice($notice_merged, 0, 4);
							?>
							<ul class="main-notice-list">
								<?php if (count($notice_merged) > 0) { foreach ($notice_merged as $notice_item) { ?>
								<li>
									<a href="<?=$notice_item['view_url']?>">
										<span class="tag"><?=$notice_item['label']?></span>
										<strong><?=$notice_item['title']?></strong>
										<time><?=$notice_item['datetime']?></time>
									</a>
								</li>
								<?php } } else { ?>
								<li class="no-data">
									등록된 공지사항이 없습니다.
								</li>
								<?php } ?>
							</ul>
							<a href="#" class="btn-more" aria-label="공지사항 더보기">
								공지사항 더보기
							</a>
						</div>
					</div>
				</article>

				<article data-aside-theme="dark">
					<div class="main-quick-wrapper">
						<div class="main-quick-inner">
							<div class="youtube-quickmenu-wrapper">
								<div class="main-quickmenu-wrapper" id="main-quickmenu">
									<h2><span>QUICK<br />SERVICE</span></h2>
									<div class="quickmenu-wrapper">
										<ul>
											<li>
												<button type="button" class="active"><span>재학생</span></button>
												<div class="quickmenu-area">
													<ul>
														<li><a href="https://eclass.ch.ac.kr" target="_blank" title="새창열림"><img src="/assets/img/icon/quickmenu/0201.png" alt="" /><strong>e-class</strong></a></li>
														<li><a href="https://job.ch.ac.kr/default.aspx" target="_blank" title="새창열림"><img src="/assets/img/icon/quickmenu/0202.png" alt="" /><strong>학생이력관리시스템</strong></a></li>
														<li><a href="/contents/contents_view.php?site_id=main&TREE_NO=16074&DEPTH=3"><img src="/assets/img/icon/quickmenu/0203.png" alt="" /><strong>캠퍼스맵</strong></a></li>
														<li><a href="/contents/contents_view.php?site_id=main&TREE_NO=16117&DEPTH=3"><img src="/assets/img/icon/quickmenu/0204.png" alt="" /><strong>증명서발급</strong></a></li>
														<li><a href="/contents/contents_view.php?site_id=main&TREE_NO=16205&DEPTH=2"><img src="/assets/img/icon/quickmenu/0205.png" alt="" /><strong>학과안내</strong></a></li>
														<li><a href="/contents/contents_view.php?site_id=main&TREE_NO=16110&DEPTH=4"><img src="/assets/img/icon/quickmenu/0206.png" alt="" /><strong>생활관(기숙사)</strong></a></li>
														<li><a href="/board/board.php?site_id=main&TREE_NO=16078&DEPTH=2"><img src="/assets/img/icon/quickmenu/0207.png" alt="" /><strong>CH뉴스</strong></a></li>
														<li><a href="/contents/campusTel.php?site_id=main&TREE_NO=16076&DEPTH=3"><img src="/assets/img/icon/quickmenu/0208.png" alt="" /><strong>전화번호안내</strong></a></li>
														<li><a href="/contents/contents_view.php?site_id=main&TREE_NO=16183&DEPTH=4"><img src="/assets/img/icon/quickmenu/0209.png" alt="" /><strong>통학버스안내</strong></a></li>
														<li><a href="/contents/contents_view.php?site_id=main&TREE_NO=16106&DEPTH=4"><img src="/assets/img/icon/quickmenu/0210.png" alt="" /><strong>춘해병원</strong></a></li>
														<li><a href="https://lib.ch.ac.kr" target="_blank"><img src="/assets/img/icon/quickmenu/0211.png" alt="" /><strong>도서관</strong></a></li>
														<li><a href="/main_schedule/list.php?site_id=main&TREE_NO=16135&DEPTH=2"><img src="/assets/img/icon/quickmenu/0212.png" alt="" /><strong>학사일정</strong></a></li>
													</ul>
												</div>
											</li>
											<li>
												<button type="button"><span>교수</span></button>
												<div class="quickmenu-area">
													<ul>
														<li><a href="https://eclass.ch.ac.kr/" target="_blank" title="새창열림"><img src="/assets/img/icon/quickmenu/0301.png" alt="" /><strong>e-class</strong></a></li>
														<li><a href="https://job.ch.ac.kr/default.aspx" target="_blank" title="새창열림"><img src="/assets/img/icon/quickmenu/0302.png" alt="" /><strong>학생이력관리시스템</strong></a></li>
														<li><a href="https://hs1.ch.ac.kr" target="_blank" title="새창열림"><img src="/assets/img/icon/quickmenu/0303.png" alt="" /><strong>학사행정시스템</strong></a></li>
														<li><a href="https://chgw.ch.ac.kr/" target="_blank" title="새창열림"><img src="/assets/img/icon/quickmenu/0304.png" alt="" /><strong>웹메일</strong></a></li>
														<li><a href="/board/board.php?site_id=main&TREE_NO=16060&DEPTH=3"><img src="/assets/img/icon/quickmenu/0305.png" alt="" /><strong>규정집</strong></a></li>
														<li><a href="https://ipsiw.ch.ac.kr/page/main/index.php" target="_blank" title="새창열림"><img src="/assets/img/icon/quickmenu/0306.png" alt="" /><strong>입학안내</strong></a></li>
														<li><a href="/contents/contents_view.php?site_id=main&TREE_NO=16205&DEPTH=2"><img src="/assets/img/icon/quickmenu/0307.png" alt="" /><strong>학과안내</strong></a></li>
														<li><a href="/board/board.php?site_id=main&TREE_NO=16087&DEPTH=2"><img src="/assets/img/icon/quickmenu/0308.png" alt="" /><strong>공지사항</strong></a></li>
														<li><a href="/contents/campusTel.php?site_id=main&TREE_NO=16076&DEPTH=3"><img src="/assets/img/icon/quickmenu/0309.png" alt="" /><strong>전화번호안내</strong></a></li>
														<li><a href="/main_schedule/list.php?site_id=main&TREE_NO=16135&DEPTH=2"><img src="/assets/img/icon/quickmenu/0310.png" alt="" /><strong>학사일정</strong></a></li>
														<li><a href="/board/board.php?site_id=main&TREE_NO=16078&DEPTH=2"><img src="/assets/img/icon/quickmenu/0311.png" alt="" /><strong>CH뉴스</strong></a></li>
														<li><a href="/contents/contents_view.php?site_id=main&TREE_NO=16106&DEPTH=4"><img src="/assets/img/icon/quickmenu/0312.png" alt="" /><strong>춘해병원</strong></a></li>
													</ul>
												</div>
											</li>
											<li>
												<button type="button"><span>직원</span></button>
												<div class="quickmenu-area">
													<ul>
														<li><a href="https://eclass.ch.ac.kr/" target="_blank" title="새창열림"><img src="/assets/img/icon/quickmenu/0401.png" alt="" /><strong>e-class</strong></a></li>
														<li><a href="https://hs1.ch.ac.kr" target="_blank" title="새창열림"><img src="/assets/img/icon/quickmenu/0402.png" alt="" /><strong>학사행정시스템</strong></a></li>
														<li><a href="https://job.ch.ac.kr/default.aspx" target="_blank" title="새창열림"><img src="/assets/img/icon/quickmenu/0403.png" alt="" /><strong>학생이력관리시스템</strong></a></li>
														<li><a href="https://chgw.ch.ac.kr/" target="_blank" title="새창열림"><img src="/assets/img/icon/quickmenu/0404.png" alt="" /><strong>웹메일</strong></a></li>
														<li><a href="/board/board.php?site_id=main&TREE_NO=16060&DEPTH=3"><img src="/assets/img/icon/quickmenu/0405.png" alt="" /><strong>규정집</strong></a></li>
														<li><a href="/contents/contents_view.php?site_id=main&TREE_NO=16183&DEPTH=4"><img src="/assets/img/icon/quickmenu/0406.png" alt="" /><strong>통학버스안내</strong></a></li>
														<li><a href="/contents/campusTel.php?site_id=main&TREE_NO=16076&DEPTH=3"><img src="/assets/img/icon/quickmenu/0407.png" alt="" /><strong>전화번호안내</strong></a></li>
														<li><a href="/board/board.php?site_id=main&TREE_NO=16087&DEPTH=2"><img src="/assets/img/icon/quickmenu/0408.png" alt="" /><strong>공지사항</strong></a></li>
														<li><a href="/main_schedule/list.php?site_id=main&TREE_NO=16135&DEPTH=2"><img src="/assets/img/icon/quickmenu/0409.png" alt="" /><strong>학사일정</strong></a></li>
														<li><a href="https://academyinfo.go.kr/index.do" target="_blank" title="새창열림"><img src="/assets/img/icon/quickmenu/0410.png" alt="" /><strong>대학알리미</strong></a></li>
														<li><a href="/board/board.php?site_id=main&TREE_NO=16078&DEPTH=2"><img src="/assets/img/icon/quickmenu/0411.png" alt="" /><strong>CH뉴스</strong></a></li>
														<li><a href="/contents/contents_view.php?site_id=main&TREE_NO=16106&DEPTH=4"><img src="/assets/img/icon/quickmenu/0412.png" alt="" /><strong>춘해병원</strong></a></li>
													</ul>
												</div>
											</li>
											<li>
												<button type="button"><span>수험생</span></button>
												<div class="quickmenu-area">
													<ul>
														<li><a href="https://ipsiw.ch.ac.kr/page/main/index.php" target="_blank" title="새창열림"><img src="/assets/img/icon/quickmenu/0101.png" alt="" /><strong>입학안내</strong></a></li>
														<li><a href="/contents/contents_view.php?site_id=main&TREE_NO=16013&DEPTH=4"><img src="/assets/img/icon/quickmenu/0102.png" alt="" /><strong>춘해Vision</strong></a></li>
														<li><a href="/contents/contents_view.php?site_id=main&TREE_NO=16183&DEPTH=4"><img src="/assets/img/icon/quickmenu/0103.png" alt="" /><strong>오시는길</strong></a></li>
														<li><a href="/contents/contents_view.php?site_id=main&TREE_NO=16110&DEPTH=4"><img src="/assets/img/icon/quickmenu/0104.png" alt="" /><strong>생활관(기숙사)</strong></a></li>
														<li><a href="/contents/contents_view.php?site_id=main&TREE_NO=16101&DEPTH=4"><img src="/assets/img/icon/quickmenu/0105.png" alt="" /><strong>신입생장학금</strong></a></li>
														<li><a href="/contents/contents_view.php?site_id=main&TREE_NO=16106&DEPTH=4"><img src="/assets/img/icon/quickmenu/0106.png" alt="" /><strong>춘해병원</strong></a></li>
														<li><a href="/contents/contents_view.php?site_id=main&TREE_NO=16074&DEPTH=3"><img src="/assets/img/icon/quickmenu/0107.png" alt="" /><strong>캠퍼스맵</strong></a></li>
														<li><a href="/history/index.php" target="_blank" title="새창열림"><img src="/assets/img/icon/quickmenu/0108.png" alt="" /><strong>역사갤러리</strong></a></li>
														<li><a href="/contents/contents_view.php?site_id=main&TREE_NO=16183&DEPTH=4"><img src="/assets/img/icon/quickmenu/0109.png" alt="" /><strong>통학버스</strong></a></li>
														<li><a href="/contents/contents_view.php?site_id=main&TREE_NO=16205&DEPTH=2"><img src="/assets/img/icon/quickmenu/0110.png" alt="" /><strong>학과안내</strong></a></li>
														<li><a href="/board/board.php?site_id=main&TREE_NO=16078&DEPTH=2"><img src="/assets/img/icon/quickmenu/0111.png" alt="" /><strong>CH뉴스</strong></a></li>
														<li><a href="/main_schedule/list.php?site_id=main&TREE_NO=16135&DEPTH=2"><img src="/assets/img/icon/quickmenu/0112.png" alt="" /><strong>학사일정</strong></a></li>
													</ul>
												</div>
											</li>
											<li>
												<button type="button"><span>동문</span></button>
												<div class="quickmenu-area">
													<ul>
														<li><a href="/contents/contents_view.php?site_id=main&TREE_NO=16071&DEPTH=3"><img src="/assets/img/icon/quickmenu/0501.png" alt="" /><strong>발전기금</strong></a></li>
														<li><a href="/history/index.php" target="_blank" title="새창열림"><img src="/assets/img/icon/quickmenu/0502.png" alt="" /><strong>역사갤러리</strong></a></li>
														<li><a href="https://ipsiw.ch.ac.kr/page/main/index.php" target="_blank" title="새창열림"><img src="/assets/img/icon/quickmenu/0503.png" alt="" /><strong>입학안내</strong></a></li>
														<li><a href="/contents/contents_view.php?site_id=main&TREE_NO=16205&DEPTH=2"><img src="/assets/img/icon/quickmenu/0504.png" alt="" /><strong>학과안내</strong></a></li>
														<li><a href="/main_schedule/list.php?site_id=main&TREE_NO=16135&DEPTH=2"><img src="/assets/img/icon/quickmenu/0505.png" alt="" /><strong>학사일정</strong></a></li>
														<li><a href="/contents/contents_view.php?site_id=main&TREE_NO=16183&DEPTH=4"><img src="/assets/img/icon/quickmenu/0506.png" alt="" /><strong>통학버스안내</strong></a></li>
														<li><a href="/contents/contents_view.php?site_id=main&TREE_NO=16074&DEPTH=3"><img src="/assets/img/icon/quickmenu/0507.png" alt="" /><strong>캠퍼스맵</strong></a></li>
														<li><a href="/contents/contents_view.php?site_id=main&TREE_NO=16117&DEPTH=3"><img src="/assets/img/icon/quickmenu/0508.png" alt="" /><strong>증명서발급</strong></a></li>
														<li><a href="/board/board.php?site_id=main&TREE_NO=16078&DEPTH=2"><img src="/assets/img/icon/quickmenu/0509.png" alt="" /><strong>CH뉴스</strong></a></li>
														<li><a href="https://edu.ch.ac.kr/main/main.php" target="_blank" title="새창열림"><img src="/assets/img/icon/quickmenu/0510.png" alt="" /><strong>평생교육원</strong></a></li>
														<li><a href="/contents/contents_view.php?site_id=main&TREE_NO=16106&DEPTH=4"><img src="/assets/img/icon/quickmenu/0511.png" alt="" /><strong>춘해병원</strong></a></li>
														<li><a href="/contents/campusTel.php?site_id=main&TREE_NO=16076&DEPTH=3"><img src="/assets/img/icon/quickmenu/0512.png" alt="" /><strong>전화번호안내</strong></a></li>
													</ul>
												</div>
											</li>
											<li>
												<button type="button"><span>방문객</span></button>
												<div class="quickmenu-area">
													<ul>
														<li><a href="/contents/contents_view.php?site_id=main&TREE_NO=16074&DEPTH=3"><img src="/assets/img/icon/quickmenu/0601.png" alt="" /><strong>캠퍼스맵</strong></a></li>
														<li><a href="https://ipsiw.ch.ac.kr/page/main/index.php" target="_blank" title="새창열림"><img src="/assets/img/icon/quickmenu/0602.png" alt="" /><strong>입학안내</strong></a></li>
														<li><a href="/contents/contents_view.php?site_id=main&TREE_NO=16205&DEPTH=2"><img src="/assets/img/icon/quickmenu/0603.png" alt="" /><strong>학과안내</strong></a></li>
														<li><a href="/board/board.php?site_id=main&TREE_NO=16087&DEPTH=2&category=%EC%9E%85%EC%B0%B0%EC%A0%95%EB%B3%B4"><img src="/assets/img/icon/quickmenu/0604.png" alt="" /><strong>입찰공고</strong></a></li>
														<li><a href="/contents/contents_view.php?site_id=main&TREE_NO=16026&DEPTH=3"><img src="/assets/img/icon/quickmenu/0605.png" alt="" /><strong>행정부서/기관</strong></a></li>
														<li><a href="/contents/contents_view.php?site_id=main&TREE_NO=16183&DEPTH=4"><img src="/assets/img/icon/quickmenu/0606.png" alt="" /><strong>통학버스안내</strong></a></li>
														<li><a href="/contents/contents_view.php?site_id=main&TREE_NO=16183&DEPTH=4"><img src="/assets/img/icon/quickmenu/0607.png" alt="" /><strong>오시는길</strong></a></li>
														<li><a href="/history/index.php" target="_blank" title="새창열림"><img src="/assets/img/icon/quickmenu/0608.png" alt="" /><strong>역사갤러리</strong></a></li>
														<li><a href="https://edu.ch.ac.kr/main/main.php" target="_blank" title="새창열림"><img src="/assets/img/icon/quickmenu/0609.png" alt="" /><strong>평생교육원</strong></a></li>
														<li><a href="/contents/campusTel.php?site_id=main&TREE_NO=16076&DEPTH=3"><img src="/assets/img/icon/quickmenu/0610.png" alt="" /><strong>전화번호안내</strong></a></li>
														<li><a href="/board/board.php?site_id=main&TREE_NO=16078&DEPTH=2"><img src="/assets/img/icon/quickmenu/0611.png" alt="" /><strong>CH뉴스</strong></a></li>
														<li><a href="/contents/contents_view.php?site_id=main&TREE_NO=16106&DEPTH=4"><img src="/assets/img/icon/quickmenu/0612.png" alt="" /><strong>춘해병원</strong></a></li>
													</ul>
												</div>
											</li>
										</ul>
									</div>
								</div>

								<div class="youtube-wrapper">
									<a href="https://youtu.be/tLxj8OJeDII" target="_blank" title="새창 열림">
										<img src="../img/main/img_youtube002.jpg" alt="#춘해보건대학교 #학교투어 #신입생, 춘해보건대학교 홍보영상" />
									</a>
								</div>
							</div>
						</div>
					</div>
				</article>

				<article data-aside-theme="dark">
					<div class="main-board-wrapper">
						<div class="main-board-inner">

							<div class="main-board-left">
								<h2>자료실</h2>
								<?php
								// 자료실 : 한국어교육센터(2914) / 글로벌센터(2917) / 국제개발협력센터(2920)
								// 3개 게시판을 합쳐 최신순 정렬 후 상위 4건만 노출
								$library_sources = array(
									"2914" => "한국어교육센터",
									"2917" => "글로벌센터",
									"2920" => "국제개발협력센터",
								);

								$library_merged = array();
								foreach ($library_sources as $library_bbsNo => $library_label) {
									$library_items = BBS_GetList("bbs_global", $library_bbsNo, 0, 4, 0);

									$sql_libraryTreeInfo = " SELECT TREE_NO, DEPTH FROM ".TABLE_TREE." WHERE CONTENTS LIKE '%".$library_bbsNo."%' and TREE_ID = '".site_id."' ";
									$row_libraryTreeInfo = $adb->getRow($sql_libraryTreeInfo, DB_FETCHMODE_ASSOC);
									$library_viewUrl = "/board/board.php?site_id=".site_id."&TREE_NO=".$row_libraryTreeInfo[TREE_NO]."&DEPTH=".($row_libraryTreeInfo[DEPTH]+1)."&bbs=see";

									foreach ($library_items as $library_item) {
										$library_item['label'] = $library_label;
										$library_item['view_url'] = $library_viewUrl."&data=".$library_item['linkdata'];
										$library_merged[] = $library_item;
									}
								}

								usort($library_merged, function($a, $b) {
									return strcmp($b['datetime'], $a['datetime']);
								});

								$library_merged = array_slice($library_merged, 0, 4);
								?>
								<ul class="main-board-list">
									<?php if (count($library_merged) > 0) { foreach ($library_merged as $library_item) { ?>
									<li>
										<a href="<?=$library_item['view_url']?>">
											<span class="tit-group">
												<span class="tit">[<?=$library_item['label']?>] <?=$library_item['title']?></span>
												<?php if ($library_item['newimg'] != "") { ?>
												<span class="new">N</span>
												<?php } ?>
											</span>
											<time><?=str_replace("-", ".", $library_item['datetime'])?></time>
										</a>
									</li>
									<?php } } else { ?>
									<li class="no-data">
										등록된 자료가 없습니다.
									</li>
									<?php } ?>
								</ul>
								<a href="#" class="btn-more" aria-label="자료실 더보기">자료실 더보기</a>
							</div>

							<div class="main-board-right" role="region" aria-label="배너존">
								<div class="main-board-head">
									<h2 id="banner-zone-title">배너존</h2>
									<div class="swiper-nav" role="group" aria-label="배너 슬라이드 컨트롤">
										<button class="swiper-btn-prev" aria-label="이전 배너"></button>
										<button class="swiper-btn-next" aria-label="다음 배너"></button>
									</div>
								</div>
								<?php
								// 배너존 : 관리자(배너관리)에서 위치를 "배너존"으로 등록한 배너를 노출
								$bannerZone_today = date("Y-m-d");
								$bannerZone_query = " SELECT * FROM ".TABLE_BANNER." WHERE site_id='".site_id."' AND useyn='Y' AND location='7' AND '".$bannerZone_today."' BETWEEN gigan1 AND gigan2 ORDER BY sort ASC, no DESC ";
								$bannerZone_result = DBquery($bannerZone_query);
								$bannerZone_list = array();
								while ( $bannerZone_row = mysql_fetch_array($bannerZone_result) ) {
									$bannerZone_list[] = $bannerZone_row;
								}
								$bannerZone_count = count($bannerZone_list);
								?>
								<div class="swiper main-banner-swiper" aria-roledescription="carousel" aria-labelledby="banner-zone-title">
									<div class="swiper-wrapper" aria-live="polite">
										<?php if ( $bannerZone_count > 0 ) { foreach ( $bannerZone_list as $bannerZone_i => $bannerZone_row ) { ?>
										<div class="swiper-slide" role="group" aria-roledescription="slide" aria-label="<?=($bannerZone_i+1)?>번째 슬라이드 / 전체 <?=$bannerZone_count?>개">
											<?php if ( trim($bannerZone_row[link_url]) != "" ) { ?>
											<a href="<?=$bannerZone_row[link_url]?>" target="<?=$bannerZone_row[target]?>">
												<img src="<?=BANNER_LOAD_PATH?>/<?=$bannerZone_row[banner_name]?>" alt="<?=$bannerZone_row[title]?>" />
											</a>
											<?php } else { ?>
											<img src="<?=BANNER_LOAD_PATH?>/<?=$bannerZone_row[banner_name]?>" alt="<?=$bannerZone_row[title]?>" />
											<?php } ?>
										</div>
										<?php } } else { ?>
										<div class="swiper-slide" role="group" aria-roledescription="slide" aria-label="등록된 배너 없음">
											<img src="../img/main/img_banner01.jpg" alt="" />
										</div>
										<?php } ?>
									</div>
								</div>
							</div>

						</div>
					</div>
				</article>

				<article data-aside-theme="light">
					<div class="main-dept-wrapper" role="region" aria-label="외국인 전담학과 소개">
						<div class="main-dept-inner main-dept-inner--flat">
							<div class="dept-card dept-card--flat">
								<div class="dept-icon" aria-hidden="true">
									<img src="../img/main/icon_department01.png" alt="" />
								</div>
								<strong class="dept-name">글로벌케어과</strong>
								<p class="dept-desc">위치 : 해악관 302호<br />전화 : 052-270-0382</p>
								<a href="https://glocare.ch.ac.kr/main/index.php" target="_blank" title="새창 열림" class="dept-link">
									<strong>홈페이지 바로가기</strong>
								</a>
							</div>
							<div class="dept-card dept-card--flat">
								<div class="dept-icon" aria-hidden="true">
									<img src="../img/main/icon_department01.png" alt="" />
								</div>
								<strong class="dept-name">글로벌뷰티과</strong>
								<p class="dept-desc">위치 : 이화관 1606호<br />전화 : 052-270-0140</p>
								<a href="https://g-beauty.ch.ac.kr/main/index.php" target="_blank" title="새창 열림" class="dept-link">
									<strong>홈페이지 바로가기</strong>
								</a>
							</div>
							<div class="dept-card dept-card--flat">
								<div class="dept-icon" aria-hidden="true">
									<img src="../img/main/icon_department01.png" alt="" />
								</div>
								<strong class="dept-name">글로벌비즈니스과</strong>
								<p class="dept-desc">위치 : 이화관 1606호<br />전화 : 052-270-0140</p>
								<a href="#" target="_blank" title="새창 열림" class="dept-link">
									<strong>홈페이지 바로가기</strong>
								</a>
							</div>
						</div>
					</div>
				</article>

			</div>


			<ul class="aside-sns-menu">
				<li>
					<a href="https://www.youtube.com/channel/UC4mS4ygHn3FBWa-APxtT_bg" target="_blank" title="새창 열림">
						<img src="../img/main/icon_sns01.png" alt="유튜브 바로가기" />
						<strong>
							유튜브
						</strong>
					</a>
				</li>
				<li>
					<a href="https://www.instagram.com/choonhae1968/" target="_blank" title="새창 열림">
						<img src="../img/main/icon_sns02.png" alt="인스타그램 바로가기" />
						<strong>
							인스타그램
						</strong>
					</a>
				</li>
				<li>
					<a href="#" target="_blank" title="새창 열림">
						<img src="../img/main/icon_sns03.png" alt="카카오톡 상담 바로가기" />
						<strong>
							카카오톡 상담
						</strong>
					</a>
				</li>
				<li>
					<a href="https://www.facebook.com/ch19680316/" target="_blank" title="새창 열림">
						<img src="../img/main/icon_sns04.png" alt="페이스북 바로가기" />
						<strong>
							페이스북
						</strong>
					</a>
				</li>
			</ul>
		</section>
		<!-- //container -->
		<!-- footer -->
		<footer>
			<? include "../include/footer.php" ?>
		</footer>
		<!-- //footer -->
	</div>
	<!-- //wrapper -->
</body>
</html>

