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
    <!-- popup -->
    <? include("../../_common/popup.php");?>
    <!-- //popup -->

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
							<img src="../img/main/main_visual_pc01.jpg" alt="메인이미지" class="pc"/>
							<img src="../img/main/main_visual_mobile01.jpg" alt="메인이미지" class="mobile"/>
							
							<p class="main-slogan-wrapper">
								<img src="../img/main/word_main_slogan01.png" alt="Department of Speech and Language Therapy 인간존중정신을 갖춘 전문인 양성, 울산지역 유일의 언어치료 전공학과로, 언어치료 및 특수교육의 복수전공을 통해 장애진단, 치료 및 교육을 담당할 언어재활사와 장애영유아보육교사를 양성하는 학과입니다.">
							</p>
						</p>
					</div>

					<div class="main-menu01-wrapper">
						<div class="main-menu01-area">
							<a href="http://ipsiw.ch.ac.kr/page/main/index.php" target="_blank">
								<img src="../img/main/icon_menu0101.png" alt="입학안내" />
								<span class="word">
									<strong>
										입학안내
									</strong>

									<span>
										학과 입학에대한 모든<br />
										궁금증 해결 
									</span>
								</span>
							</a>
						</div>

						<div class="main-menu01-area">
							<a href="/contents/contents_view.php?site_id=slt&TREE_NO=5849&DEPTH=2">
								<img src="../img/main/icon_menu0102.png" alt="교육시설" />
								<span class="word">
									<strong>
										교육시설
									</strong>

									<span>
										첨단 시뮬레이션 실습실에서의<br />
										1:1 맞춤형 임상재현 실습
									</span>
								</span>
							</a>
						</div>

						<div class="main-menu01-area">
							<a href="/contents/contents_view.php?site_id=slt&TREE_NO=5861&DEPTH=2">
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
							<a href="/contents/contents_view.php?site_id=slt&TREE_NO=5862&DEPTH=2">
								<img src="../img/main/icon_menu0104.png" alt="취업현황" />
								<span class="word">
									<strong>
										취업현황
									</strong>

									<span>
										최근 취업현황을<br />
										안내해드립니다.
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
											공지사항
										</h2>
										
									</div>

									<div class="main-board-area">
										<ul>
											<li>
												<button type="button" class="active">
													전체
												</button>

												<div class="main-board-box">
													<ul>
														<?
														// (테이블명, 코드, 보드타입, 게시물수, 내용글수)
														$bbs_no="1910";
														$boardList = BBS_GetList("bbs_slt", $bbs_no, 0, 5, 300);

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

													<a href="/board/board.php?site_id=slt&TREE_NO=5863&DEPTH=2" class="btn-more" title="공지사항 더보기">
														<img src="../img/main/icon_more01.gif">
													</a>
												</div>

												
											</li>

											<li>
												<button type="button">
													1학년
												</button>

												<div class="main-board-box">
													<ul>
														<?
														// (테이블명, 코드, 보드타입, 게시물수, 내용글수)
														$bbs_no="1910";
														$boardList = BBS_GetList("bbs_slt", $bbs_no, 0, 5, 300, 0, "1학년");
														
														
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

													<a href="/board/board.php?site_id=slt&TREE_NO=5863&DEPTH=2&category=1학년" class="btn-more" title="1학년 더보기">
														<img src="../img/main/icon_more01.gif">
													</a>
												</div>

												
											</li>

											
											<li>
												<button type="button">
													2학년
												</button>

												<div class="main-board-box">
													<ul>
														<?
														// (테이블명, 코드, 보드타입, 게시물수, 내용글수)
														$bbs_no="1910";
														$boardList = BBS_GetList("bbs_slt", $bbs_no, 0, 5, 300, 0, "2학년");
														
														
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

													<a href="/board/board.php?site_id=slt&TREE_NO=5863&DEPTH=2&category=2학년" class="btn-more" title="2학년 더보기">
														<img src="../img/main/icon_more01.gif">
													</a>
												</div>

												
											</li>

											<li>
												<button type="button">
													3학년
												</button>

												<div class="main-board-box">
													<ul>
														<?
														// (테이블명, 코드, 보드타입, 게시물수, 내용글수)
														$bbs_no="1910";
														$boardList = BBS_GetList("bbs_slt", $bbs_no, 0, 5, 300, 0, "3학년");
														
														
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

													<a href="/board/board.php?site_id=slt&TREE_NO=5863&DEPTH=2&category=3학년" class="btn-more" title="3학년 더보기">
														<img src="../img/main/icon_more01.gif">
													</a>
												</div>
											</li>

											<li>
												<button type="button">
													전공심화과정
												</button>

												<div class="main-board-box">
													<ul>
														<?
														// (테이블명, 코드, 보드타입, 게시물수, 내용글수)
														$bbs_no="1910";
														$boardList = BBS_GetList("bbs_slt", $bbs_no, 0, 5, 300, 0, "전공심화과정");
														
														
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

													<a href="/board/board.php?site_id=slt&TREE_NO=5863&DEPTH=2&category=전공심화과정" class="btn-more" title="전공심화과정 더보기">
														<img src="../img/main/icon_more01.gif">
													</a>
												</div>
											</li>


											<li>
												<button type="button">
													입학
												</button>

												<div class="main-board-box">
													<ul>
														<?
														// 입시 홈페이지 공지사항 게시글 가지고 오기
														$sql_BoardInfomation = "SELECT * FROM chipsi.bbs_ipsi6 WHERE code='1515' ORDER BY idx DESC LIMIT 5";
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

													<a href="http://ipsiw.ch.ac.kr/page/sub06/sub01.php" class="btn-more" title="새창열림_입학 더보기" target="_blank">
														<img src="../img/main/icon_more01.gif">
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

								<!-- 동영상 갤러리 -->
                                <div class="video-gallery-wrapper">
                                    <div class="title-area">
                                        <h2>
                                            동영상 갤러리
                                        </h2>
                                    </div>    
                                    <div class="video-gallery-area">
									<?php
										$bbs_no="1923";
										$boardList = BBS_GetList("bbs_slt", $bbs_no, 1, 2, 300, 0, "");
										foreach ( $boardList as $k => $v ) {
											
									?>
                                        <div class="video-gallery-box">
                                            <a href="https://www.youtube.com/watch?v=<?php echo $v['etc_char1']?>" target="_blank">
												<div class="main-movie-box">
                                                	<img src="<?if($v['file_src'] != '') echo $v['file_src']; else echo "/_common/img/common/noimg.jpg";?>" alt="<?=$v['title']?>" class="video_s"/>
 													<img src="../img/main/btn_play.png" class="icon-movie" />
												</div>	
                                                <p><?=$v['title']?></p>
                                            </a>    
                                        </div>
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
									<ul class="main-sns-list">
										<li>
											<a href="#" target="_blank" title="새창열림">
												<img src="../../_common/img/icon/icon_kakaotalk01.png" alt="KAKAOTALK" />
											</a>
										</li>
										<li>
											<a href="#" target="_blank" title="새창열림">
												<img src="../../_common/img/icon/icon_facebook01.png" alt="FACEBOOK" />
											</a>
										</li>

										<li>
											<a href="https://blog.naver.com/ma129037" target="_blank" title="새창열림">
												<img src="../../_common/img/icon/icon_blog01.png" alt="BLOG" />
											</a>
										</li>

										<li>
											<a href="#" target="_blank" title="새창열림">
												<img src="../../_common/img/icon/icon_youtube01.png" alt="YOUTUBE" />
											</a>
										</li>

										<li>
											<a href="https://instagram.com/slp_ch?igshid=MzRlODBiNWFlZA==" target="_blank" title="새창열림">
												<img src="../../_common/img/icon/icon_instagram01.png" alt="INSTAGRAM" />
											</a>
										</li>
									</ul>
                                </div>    
                                <!-- //동영상 갤러리 -->
							</div>
							<!-- //main board, movie -->

							<!-- main menu -->
							<div class="main-menu02">
								<ul>
									<li>
										<a href="/schedule/list.php?site_id=slt&TREE_NO=5865&DEPTH=2">
											<span class="image center-crop">
												<img src="../img/main/icon_menu0201.png" alt="학사일정" />
											</span>
											<strong>
												학사일정
											</strong>
										</a>
									</li>

									<li>
										<a href="/board/board.php?site_id=slt&TREE_NO=5850&DEPTH=2">
											<span class="image center-crop">
												<img src="../img/main/icon_menu0202.png" alt="교육과정" />
											</span>
											<strong>
												교육과정
											</strong>
										</a>
									</li>

									<li>
										<a href="/board/board.php?site_id=slt&TREE_NO=5869&DEPTH=2">
											<span class="image center-crop">
												<img src="../img/main/icon_menu0203.png" alt="자료실" />
											</span>
											<strong>
												자료실
											</strong>
										</a>
									</li>

									<li>
										<a href="https://eclass.ch.ac.kr" target="_blank" title="새창열림">
											<span class="image center-crop">
												<img src="../img/main/icon_menu0204.png" alt="e-class" />
											</span>
											<strong>
												e-class
											</strong>
										</a>
									</li>

									<li>
										<a href="https://job.ch.ac.kr/" target="_blank" title="새창열림">
											<span class="image center-crop">
												<img src="../img/main/icon_menu0205.png" alt="학생이력관리시스템" />
											</span>
											<strong>
												학생이력관리시스템
											</strong>
										</a>
									</li>

									<li>
										<a href="http://lib.ch.ac.kr/" target="_blank" title="새창열림">
											<span class="image center-crop">
												<img src="../img/main/icon_menu0206.png" alt="도서관" />
											</span>
											<strong>
												도서관
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
										<?
										// (테이블명, 코드, 보드타입, 게시물수, 내용글수)
										$bbs_no="1915";
										$bbs_id="bbs_slt";
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

								<div class="main-news-area mobile">

									<div class="swiper-container" id="main-mobile-news-slider">
										<div class="swiper-wrapper">
											<?
											// (테이블명, 코드, 보드타입, 게시물수, 내용글수)
											$bbs_no="1915";
											$bbs_id="bbs_slt";
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
												<div class="swiper-slide">
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
												</div>
											<?php }?>
										</div>
									</div>

									<div class="swiper-pagination"></div>


								</div>

								<a href="<?=$more_linkUrl;?>" class="btn-more" title="학과뉴스 더보기">
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
</body>
</html>


