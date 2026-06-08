<!doctype html>
<html lang="ko">
<head>
	<? include "../include/meta.php" ?>

	<link rel="stylesheet" href="../css/main02.css">
	<script src="../js/main.js"></script>

	<title>
		간호학부 - 춘해보건대학교
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
							<p class="main-slogan-wrapper">
								<span>
									Department of Nursing
								</span>
								<strong>
									춘해보건대학교 간호학부
								</strong>
							</p>							

							<div class="main-visual-area">
								<div class="flower01">
									<img src="../img/main/icon_smile01.png" alt="" class="smile" />
									<img src="../img/main/img_flower01.png" alt="" class="flower" />
								</div>

								<div class="swiper-container" id="main-visual-slider">
									<div class="swiper-wrapper">									
										<div class="swiper-slide">
											<img src="../img/main/main_visual_pc0101.jpg" alt="" class="pc" />
											<img src="../img/main/main_visual_mobile0101.jpg" alt="" class="mobile" />
										</div>
										<div class="swiper-slide">
											<img src="../img/main/main_visual_pc02_new.jpg" alt="" class="pc" />
											<img src="../img/main/main_visual_mobile02_new.jpg" alt="" class="mobile" />
										</div>

										<div class="swiper-slide">
											<img src="../img/main/main_visual_pc0401.jpg" alt="" class="pc" />
											<img src="../img/main/main_visual_mobile0401.jpg" alt="" class="mobile" />
										</div>

										<div class="swiper-slide">
											<img src="../img/main/main_visual_pc0301.jpg" alt="" class="pc" />
											<img src="../img/main/main_visual_mobile0301.jpg" alt="" class="mobile" />
										</div>

										<div class="swiper-slide">
											<img src="../img/main/main_visual_pc0201.jpg" alt="" class="pc" />
											<img src="../img/main/main_visual_mobile0201.jpg" alt="" class="mobile" />
										</div>
									</div>	
								</div>
								<div class="main-visual-menu-wrapper">
									<div class="main-visual-option">
										<div id="main-visual-pagination"></div>
										<button type="button" class="main-visual-prev01">
											이전 이미지로 이동
										</button>
										<button type="button" class="main-visual-next01">
											다음 이미지로 이동
										</button>
									</div>

									<div class="main-menu01-wrapper">
										<div class="main-menu01-area">
											<a href="http://ipsiw.ch.ac.kr/page/main/index.php" target="_blank">
												<img src="../img/main/icon_menu0101.png" alt="" />
												<span class="word">
													입학안내
												</span>
											</a>
										</div>

										<div class="main-menu01-area">
											<a href="/contents/contents_view.php?site_id=nurs&TREE_NO=5814&DEPTH=2">
												<img src="../img/main/icon_menu0102.png" alt="" />
												<span class="word">
													교육시설
												</span>
											</a>
										</div>

										<div class="main-menu01-area">
											<a href="/contents/contents_view.php?site_id=nurs&TREE_NO=5828&DEPTH=2">
												<img src="../img/main/icon_menu0103.png" alt="" />
												<span class="word">
													졸업생<span class="span-mobile-br02"></span>한마디
												</span>
											</a>
										</div>

										<div class="main-menu01-area">
											<a href="/contents/contents_view.php?site_id=nurs&TREE_NO=5829&DEPTH=2">
												<img src="../img/main/icon_menu0104.png" alt="" />
												<span class="word">
													취업현황
												</span>
											</a>
										</div>
									</div>									
								</div>
							</div>
						</div>
					</div>
					
				
					<div class="main-contents02">
						<div class="main-contents-wrapper">
							<!-- main board -->
							<div class="main-board-wrapper">
								<div class="main-title-area">
									<h2>
										공지사항
									</h2>
									
								</div>
								<div class="main-board-area">
									<ul>
										<li>
											<button type="button" class="active" data-url="/board/board.php?site_id=nurs&TREE_NO=5830&DEPTH=2">
												<span><i>전체</i></span>
											</button>
											<div class="main-board-box">
												<ul>
													<?
													// (테이블명, 코드, 보드타입, 게시물수, 내용글수)
													$bbs_no="1210";
													$boardList = BBS_GetList("bbs_nurs", $bbs_no, 0, 6, 300);

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
											</div>												
										</li>
										<li>
											<button type="button" data-url="/board/board.php?site_id=nurs&TREE_NO=5830&DEPTH=2&category=1학년">
												<span><i>1학년</i></span>
											</button>
											<div class="main-board-box">
												<ul>
													<?
													// (테이블명, 코드, 보드타입, 게시물수, 내용글수)
													$bbs_no="1210";
													$boardList = BBS_GetList("bbs_nurs", $bbs_no, 0, 6, 300, 0, "1학년");
													
													
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
													<? } ?>
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
											</div>												
										</li>											
										<li>
											<button type="button" data-url="/board/board.php?site_id=nurs&TREE_NO=5830&DEPTH=2&category=2학년">
												<span><i>2학년</i></span>
											</button>
											<div class="main-board-box">
												<ul>
													<?
													// (테이블명, 코드, 보드타입, 게시물수, 내용글수)
													$bbs_no="1210";
													$boardList = BBS_GetList("bbs_nurs", $bbs_no, 0, 6, 300, 0, "2학년");
													
													
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
													<? } ?>
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
											</div>												
										</li>
										<li>
											<button type="button" data-url="/board/board.php?site_id=nurs&TREE_NO=5830&DEPTH=2&category=3학년">
												<span><i>3학년</i></span>
											</button>
											<div class="main-board-box">
												<ul>
													<?
													// (테이블명, 코드, 보드타입, 게시물수, 내용글수)
													$bbs_no="1210";
													$boardList = BBS_GetList("bbs_nurs", $bbs_no, 0, 6, 300, 0, "3학년");
													
													
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
													<? } ?>
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
											</div>												
										</li>
										<li>
											<button type="button" data-url="/board/board.php?site_id=nurs&TREE_NO=5830&DEPTH=2&category=4학년">
												<span><i>4학년</i></span>
											</button>
											<div class="main-board-box">
												<ul>
													<?
													// (테이블명, 코드, 보드타입, 게시물수, 내용글수)
													$bbs_no="1210";
													$boardList = BBS_GetList("bbs_nurs", $bbs_no, 0, 6, 300, 0, "4학년");
													
													
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
													<? } ?>
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
											</div>
										</li>
										<li>
											<button type="button" data-url="http://ipsiw.ch.ac.kr/page/sub06/sub01.php">
												<span><i>입학</i></span>
											</button>
											<div class="main-board-box">
												<ul>
													<?
													// 입시 홈페이지 공지사항 게시글 가지고 오기
													$sql_BoardInfomation = "SELECT * FROM chipsi.bbs_ipsi6 WHERE code='1515' ORDER BY idx DESC LIMIT 6";
													$result = DBquery($sql_BoardInfomation);


													for($i=0; $row=@mysql_fetch_array($result); $i++) {
														$encode_str = "pagecnt=".$pagecnt."&idx=".$row[idx]."&letter_no=".$s_letter."&offset=".$offset;
														$encode_str.= "&search=".$search."&searchstring=".$searchstring;
														$encode_str.= "&Boardkey=".$row[code]."&Sub_No=".$row[sub_no]."&DBTable=".$configBBS[board_id];
														$list_data = Encode64($encode_str); //각 레코드 정보

														//작성일자 년월일
														$writeday = explode("-",substr($row[writeday],0,11));
														$writeday = $writeday[0]."-".$writeday[1]."-".$writeday[2];
														?>
														<li>
															<a href="https://ipsiw.ch.ac.kr/page/sub06/sub01.php?bbs=see&data=<?=$list_data?>" target="_blank">
																<span class="title-area">
																	<strong>
																		<?=$row['title']?>
																	</strong>
																</span>
																<span class="date">
																	<?=$writeday?>
																</span>
															</a>
														</li>
													<?php 
													}
													?>
												</ul>													
											</div>
										</li>
									</ul>
								</div>
								<a href="/board/board.php?site_id=nurs&TREE_NO=5830&DEPTH=2" id="notice-btn" class="btn-more" title="새창열림_입학 더보기" target="_blank">
									<span>더보기</span>
									<img src="../img/main/icon_more01.gif" alt="">
								</a>
								<script>
									$(function() {
										$(".main-board-area > ul > li > button").on("click", function() {
											$(".main-board-area > ul > li > button").removeClass('active');
											var url = $(this).attr("data-url");
											$("#notice-btn").attr("href",url);
											$(this).addClass('active');
										});
									});
								</script>
							</div>
								<!-- //main board -->
                                
							<!-- 동영상 갤러리 -->
							<div class="main-movie-wrapper">
								<div class="main-movie-area">
									<div class="main-sns-wrapper">
										<p>
											이 세상을 밝히는<br />
											빛이 되고 싶습니다.
										</p>
										<ul>
											<li>
												<a href="#">
													<img src="../img/main/icon_sns01.png" alt="인스타그램" />
												</a>
											</li>
											<li>
												<a href="#">
													<img src="../img/main/icon_sns02.png" alt="YUTUBE" />
												</a>
											</li>
										</ul>
									</div>
									<div class="main-movie-gallery">
										<h2>
											동영상 갤러리
										</h2>
										<div class="main-movie-gallery-list">
										<?php
											$bbs_no="1221";
											$boardList = BBS_GetList("bbs_nurs", $bbs_no, 1, 2, 300, 0, "");
											foreach ( $boardList as $k => $v ) {
												
										?>										
											<a href="https://www.youtube.com/watch?v=<?php echo $v['etc_char1']?>" target="_blank">
												<div class="image">
													<img src="<?if($v['file_src'] != '') echo $v['file_src']; else echo "/_common/img/common/noimg.jpg";?>" alt="<?=$v['title']?>" class="video_s"/>
												</div>	
												<div class="title">
													<p><?=$v['title']?></p>
												</div>
											</a>
										<?php
											}
										if(count($boardList)==0){
										?>
											<div class="no-video-gallery-box">
												<p>등록된 데이터가 없습니다.</p>
											</div>
										<?php
										}
										?>
										</div>
										<a href="#" class="btn-more" title="동영상갤러리 더보기">
											<span>더보기</span>
											<img src="../img/main/icon_arrow02_white.png" alt="" />
										</a>
									</div>
								</div>    
								<!-- //동영상 갤러리 -->
								<div class="flower02">
									<img src="../img/main/icon_smile02.png" alt="" class="smile" />
									<img src="../img/main/img_flower02.png" alt="" class="flower" />
								</div>	
							</div>
							<!-- //main movie -->
							<div class="main-news-wrapper">
								<div class="main-title-area">
									<h2>
										학부뉴스
									</h2>
								</div>
								
								<div class="main-news-area">
									<ul>
										<?
										// (테이블명, 코드, 보드타입, 게시물수, 내용글수)
										$bbs_no="1215";
										$bbs_id="bbs_nurs";
										$boardList = BBS_GetList($bbs_id, $bbs_no, 2, 4, 300);

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
												<?
													//if($_SERVER['REMOTE_ADDR']=="112.217.216.250") echo $v['file_src'];
												?>
												<a href="<?=$view_linkUrl?>&data=<?=$v['linkdata']?>" class="main-news-box">
													<span class="image center-crop">
														<img src="<?if($v['file_src'] != '') echo $v['file_src']; else echo "/_common/img/common/noimg.jpg";?>" alt="<?=$v['title']?>">
													</span>
													<strong class="title">
														<?=$v['title']?>
													</strong>
													<span class="date">
														<?=$v['datetime']?>
													</span>
												</a>
											</li>
										<?php }?>
									</ul>
								</div>
								
								<a href="<?=$more_linkUrl;?>" class="btn-more" title="학부뉴스 더보기">
									<span>더보기</span>
									<img src="../img/main/icon_more01.gif" alt="" />
								</a>
							</div>
						</div>							
						<!-- //main menu -->
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


