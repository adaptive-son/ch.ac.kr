<!doctype html>
<html lang="ko">
<head>
	<? include "../include/meta.php" ?>

	<link rel="stylesheet" href="../css/main.css">
	<link rel="stylesheet" href="../../_common/css/quickmenu.css">
	<script src="../js/main.js"></script>

	<title>
		글로벌뷰티과 - 춘해보건대학교
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

		<!-- quick menu -->
		<? include "../include/quickmenu.php" ?>
		<!-- //quick menu -->
		<!-- container -->
		<section>
			<div class="main-container" id="container">
				
				<article>
					<div class="main-contents01" id="contents">
						<div class="main-visual-wrapper">
							<div class="main-visual-slider-wrapper">
								<div class="swiper-container" id="main-visual-slider">
									<div class="swiper-wrapper">
										<div class="swiper-slide">
											<img src="../img/main/main_visual_pc01.jpg" alt="" class="pc"/>
											<img src="../img/main/main_visual_mobile01.jpg" alt="" class="mobile"/>

											<div class="main-slogan-wrapper01">
												<p class="word-eng">
													The Department of Global Beauty
												</p>
												<dl>
													<dt>
														<span>글로벌 무대에서 빛나는</span>
														<span>뷰티 전문가의 시작</span>
													</dt>
													<dd>
														<span>Where Beauty Professionals Begin to Shine on the Global Stage</span>
													</dd>
												</dl>
											</div>
										</div>

<!--
										<div class="swiper-slide">
											<img src="../img/main/main_visual_pc02.jpg" alt="" class="pc"/>
											<img src="../img/main/main_visual_mobile02.jpg" alt="" class="mobile"/>

											<div class="main-slogan-wrapper01">
												<p class="word-eng">
													The Department of Global Care
												</p>
												<dl>
													<dt>
														<span>Compassionate Care</span>
														<span>for a Better Tomorrow</span>
													</dt>
													<dd>
														<span>글로벌뷰티과는 외국인 유학생과 결혼 이주자를 대상으로 </span>
														<span>창의성을 갖춘 인재를 양성하기 위해 다양한 교육 프로그램과</span>
														<span>연구 기회를 제공하고 있습니다.</span>
													</dd>
												</dl>
											</div>
										</div>
-->

									</div>
								</div>

								<div class="main-visual-option">
									<div class="main-visual-swiper-pagination"></div>
									<button type="button" class="main-visual-button-prev">
										이전 비주얼로 이동
									</button>

									<button type="button" class="main-visual-button-pause">
										일시 멈춤
									</button>
									<button type="button" class="main-visual-button-play">
										재생
									</button>

									<button type="button" class="main-visual-button-next">
										다음 비주얼로 이동
									</button>
								</div>
							</div>
						</div>

						<div class="main-menu01-wrapper">
							<div class="main-menu01-area">
								<a href="http://ipsiw.ch.ac.kr/page/main/index.php" target="_blank" title="새창 열림">
									<img src="../img/main/icon_menu0101.png" alt="" />
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
								<a href="/contents/contents_view.php?site_id=gbeauty&TREE_NO=16502&DEPTH=2">
									<img src="../img/main/icon_menu0102.png" alt="" />
									<span class="word">
										<strong>
											교육시설
										</strong>

										<span>
											첨단 시뮬레이션 실습실에서의<br />
											맞춤형 실습
										</span>
									</span>
								</a>
							</div>

							<div class="main-menu01-area">
								<a href="/contents/contents_view.php?site_id=gbeauty&TREE_NO=16516&DEPTH=2">
									<img src="../img/main/icon_menu0103.png" alt="" />
									<span class="word">
										<strong>
											졸업 후 진로
										</strong>

										<span>
											졸업 후 진로
										</span>
									</span>
								</a>
							</div>

							<div class="main-menu01-area">
								<a href="/board/board.php?site_id=gbeauty&TREE_NO=16517&DEPTH=2">
									<img src="../img/main/icon_menu0104.png" alt="" />
									<span class="word">
										<strong>
											취업정보
										</strong>

										<span>
											최근 취업정보를<br />
											안내해드립니다.
										</span>
									</span>
								</a>
							</div>
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
                                                        $bbs_no="3110";
                                                        $boardList = BBS_GetList("bbs_gbeauty", $bbs_no, 0, 5, 300);

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
												<button type="button">
													1학년
												</button>

												<div class="main-board-box">
													<ul>
														<?
                                                        // (테이블명, 코드, 보드타입, 게시물수, 내용글수)
                                                        $bbs_no="3110";
                                                        $boardList = BBS_GetList("bbs_gbeauty", $bbs_no, 0, 5, 300, 0, "1학년");
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
                                                        <? }  ?>
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
												<button type="button">
													2학년
												</button>

												<div class="main-board-box">
													<ul>
														<?
                                                        // (테이블명, 코드, 보드타입, 게시물수, 내용글수)
                                                        $bbs_no="3110";
                                                        $boardList = BBS_GetList("bbs_gbeauty", $bbs_no, 0, 5, 300, 0, "2학년");
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
                                                        <? }  ?>
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
												</div>
											</li>
										</ul>
									</div>

									<a href="../sub04/sub01.php" class="btn-more" title="공지사항 더보기">
										<img src="../img/main/icon_more01.gif">
									</a>


								</div>
								<!-- //main board -->
								
								<!-- 포토 갤러리 -->
                                <div class="video-gallery-wrapper">
                                    <div class="title-area">
                                        <h2>
                                            포토 갤러리
                                        </h2>
                                    </div>    
                                    <div class="video-gallery-area">
										<?php
                                        $bbs_no="3112";
                                        $boardList = BBS_GetList("bbs_gbeauty", $bbs_no, 1, 2, 300, 0, "");

										$sql_BoardInfomation = " SELECT TREE_NO, DEPTH FROM ".TABLE_TREE." WHERE CONTENTS LIKE '%".$bbs_no."%' and TREE_ID = '".site_id."' ";
										$row_BoardTreeInfo = $adb->getRow($sql_BoardInfomation, DB_FETCHMODE_ASSOC);
										$param_menuInfo = "site_id=".site_id."&TREE_NO=".$row_BoardTreeInfo[TREE_NO]."&DEPTH=".($row_BoardTreeInfo[DEPTH]+1);
										$more_linkUrl = "/board/board.php?".$param_menuInfo;
                                        $view_linkUrl = $more_linkUrl."&bbs=see";
                                        foreach ( $boardList as $k => $v ) {
                                            ?>
                                            <div class="video-gallery-box">
                                                <a href="<?=$view_linkUrl?>&data=<?=$v['linkdata']?>">
                                                    <div class="main-movie-box">
                                                        <img src="<?if($v['file_src'] != '') echo $v['file_src']; else echo "/_common/img/common/noimg.jpg";?>" alt="" class="video_s"/>
                                                    </div>
                                                    <p><?=$v['title']?></p>
                                                </a>
                                            </div>
                                        <?php }
                                        if( count($boardList) == 0 ){
                                            ?>
                                            <div class="no-video-gallery-box">
                                                <p>등록된 데이터가 없습니다.</p>
                                            </div>
                                        <?php } ?>
									</div>
									
									<ul class="main-sns-list">
										<li>
											<a href="#" target="_blank" title="새창 열림" title="새창열림">
												<img src="../img/icon/icon_kakaotalk01.png" alt="KAKAOTALK" />
											</a>
										</li>
										<li>
											<a href="#" target="_blank" title="새창 열림" title="새창열림">
												<img src="../img/icon/icon_facebook01.png" alt="FACEBOOK" />
											</a>
										</li>
										<li>
											<a href="#" target="_blank" title="새창 열림" title="새창열림">
												<img src="../img/icon/icon_blog01.png" alt="BLOG" />
											</a>
										</li>
										<li>
											<a href="#" target="_blank" title="새창 열림" title="새창열림">
												<img src="../img/icon/icon_youtube01.png" alt="YOUTUBE" />
											</a>
										</li>

										<li>
											<a href="#" target="_blank" title="새창 열림" title="새창열림">
												<img src="../img/icon/icon_instagram01.png" alt="INSTAGRAM" />
											</a>
										</li>
									</ul>
                                </div>
								<!-- //main movie -->
							</div>
							<!-- //main board, movie -->

							<!-- main menu -->
							<div class="main-menu02">
								<ul>
									<li>
										<a href="/schedule/list.php?site_id=gbeauty&TREE_NO=16518&DEPTH=2">
											<span class="image center-crop">
												<img src="../img/main/icon_menu0201.png" alt="" />
											</span>
											<strong>
												학사일정
											</strong>
										</a>
									</li>

									<li>
										<a href="/board/board.php?site_id=gbeauty&TREE_NO=16509&DEPTH=2">
											<span class="image center-crop">
												<img src="../img/main/icon_menu0202.png" alt="" />
											</span>
											<strong>
												교육과정
											</strong>
										</a>
									</li>

									<li>
										<a href="/board/board.php?site_id=gbeauty&TREE_NO=16522&DEPTH=2">
											<span class="image center-crop">
												<img src="../img/main/icon_menu0203.png" alt="" />
											</span>
											<strong>
												자료실
											</strong>
										</a>
									</li>

									<li>
										<a href="https://eclass.ch.ac.kr/" target="_blank" title="새창 열림">
											<span class="image center-crop">
												<img src="../img/main/icon_menu0204.png" alt="" />
											</span>
											<strong>
												e-class
											</strong>
										</a>
									</li>

									<li>
										<a href="https://job.ch.ac.kr/" target="_blank" title="새창 열림">
											<span class="image center-crop">
												<img src="../img/main/icon_menu0205.png" alt="" />
											</span>
											<strong>
												학생이력관리시스템
											</strong>
										</a>
									</li>

									<li>
										<a href="https://lib.ch.ac.kr/" target="_blank" title="새창 열림">
											<span class="image center-crop">
												<img src="../img/main/icon_menu0206.png" alt="" />
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
                                        $bbs_no="3111";
                                        $bbs_id="bbs_gbeauty";
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
													<img src="<?if($v['file_src'] != '') echo $v['file_src']; else echo "/_common/img/common/noimg.jpg";?>" alt="<?=$v['title']?>" />
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
											<? foreach ( $boardList as $k => $v ) { ?>
                                                <div class="swiper-slide">
                                                    <a href="<?=$view_linkUrl?>&data=<?=$v['linkdata']?>" class="main-news-box">
													<span class="image center-crop">
														<img src="<?if($v['file_src'] != '') echo $v['file_src']; else echo "/_common/img/common/noimg.jpg";?>" alt="<?=$v['title']?>" />
													</span>
                                                        <strong class="title">
                                                            <?=$v['title']?>
                                                        </strong>
                                                        <span class="date">
														<?=$v['datetime']?>
													</span>
                                                    </a>
                                                </div>
                                            <? } ?>
										</div>
									</div>

									<div class="swiper-pagination"></div>


								</div>

								<a href="<?php echo $more_linkUrl?>" class="btn-more" title="학과뉴스 더보기">
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
</body>
</html>


