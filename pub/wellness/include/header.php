			<? @session_start(); ?>
			<!-- skip navigation -->
			<p class="skip-navigation"> 
				<a href="#contents">본문으로 바로가기</a> 
			</p>
			<!-- //skip navigation -->

			<div class="header">
				<!-- 학과 공통 gnb -->
				<div class="gnb-wrapper">
					<div class="gnb-area">
						<div class="gnb-box">
							<dl>
								<dt>
									글자크기
								</dt>
								<dd>
									<button type="button" class="font big" onclick="zoomOut(); return false;">
										화면 확대
									</button>
								</dd>
								<dd>
									<button type="button" class="font reset" onclick="zoomReset(); return false;">
										화면 초기화
									</button>
								</dd>
								<dd>
									<button type="button" class="font small" onclick="zoomIn(); return false;">
										화면 축소
									</button>
								</dd>
							</dl>

							<ul class="gnb-link">
								<li>
									<a href="http://www.ch.ac.kr/main/index.php" target="_blank" title="새창 열림">
										<span>
											<strong>대학메인</strong>
										</span>
										<img src="/_common/img/icon/icon_new_window01@2x.gif" alt="" />
									</a>
								</li>

								<li>
									<a href="http://ipsiw.ch.ac.kr/page/main/index.php" target="_blank" title="새창 열림">
										<span>
											<strong>입학안내</strong>
										</span>
										<img src="/_common/img/icon/icon_new_window01@2x.gif" alt="" />
									</a>
								</li>

								<li>
									<a href="https://hs1.ch.ac.kr" target="_blank" title="새창열림">
										<span>
											<strong>학사행정시스템</strong>
										</span>
										<img src="/_common/img/icon/icon_new_window01@2x.gif" alt="" />
									</a>
								</li>

								<li>
									<a href="https://job.ch.ac.kr/default.aspx" target="_blank" title="새창열림">
										<span>
											<strong>학생이력관리시스템</strong>
										</span>
										<img src="/_common/img/icon/icon_new_window01@2x.gif" alt="" />
									</a>
								</li>

								<li>
									<a href="https://eclass.ch.ac.kr/" target="_blank" title="새창열림">
										<span>
											<strong>E 클래스</strong>
										</span>
										<img src="/_common/img/icon/icon_new_window01@2x.gif" alt="" />
									</a>
								</li>

								<li>
									<? if($_SESSION['MEMBER_ID']!='' || $_SESSION['ID'] != ''){?>
									<a href="javascript:;" id="btnLogout">
										<span>
											<strong>로그아웃</strong>
										</span>
									</a>
									<?} else { ?>
									<a href="/member/login.php">
										<span>
											<strong>로그인</strong>
										</span>
									</a>
									<?}?>
								</li>
							</ul>

							<ul class="sns-list">
								<li>
									<a href="">
										<img src="/_common/img/common/icon_facebook01.png" alt="FACEBOOK" />
									</a>
								</li>
								<li>
									<a href="">
										<img src="/_common/img/common/icon_cafe01.png" alt="NAVER CAFE" />
									</a>
								</li>
								<li>
									<a href="">
										<img src="/_common/img/common/icon_blog01.png" alt="BLOG" />
									</a>
								</li>
								<li>
									<a href="">
										<img src="/_common/img/common/icon_instagram01.png" alt="INSTAGRAM" />
									</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<!-- //학과 공통 gnb -->


				<div class="header-wrapper">
					<div class="bg"></div>
					<div class="header-area">
						<h1>
							<a href="/main/index.php">
								<img src="/_common/img/common/logo.png" alt="<?=SITE_TITLE?>" />
								<strong>
									 <?=_TAG_TITLE;?>
								</strong>
							</a>
						</h1>

						<div class="top-menu-wrapper">
							<ul>
								<? foreach ( $menu_1depth as $k => $v ) {
									// 메뉴카테고리일 경우, 첫번째 하위메뉴의 링크주소를 가지고 옴
									if ( $v[cnt] > 0 && ( $v[ETC1] == "MENU" ) ) $v[LINK_URL] = $menu_2depth[$v[TREE_NO]][0][LINK_URL];

									// 첫번째 하위메뉴도 메뉴카테고리일경우 그보다 더 밑의 첫번째 하위메뉴의 링크주소를 가지고옴 ex) 대학생활
									if($menu_2depth[$v[TREE_NO]][0][cnt] > 0 && ($menu_2depth[$v[TREE_NO]][0][ETC1] == "MENU")){
										$v[LINK_URL] = $menu_3depth[$menu_2depth[$v[TREE_NO]][0][TREE_NO]][0][LINK_URL];

									}
									?>
									<li>
										<a href="<?=$v[LINK_URL]?>" class="topmenu<?=$k+1?>" <?=$v[LINK_TARGET]?>>
											<span class="title">
												<span data-hover="<?=$v[NAME]?>">
													<?=$v[NAME]?>
												</span>
											</span>
										</a>
										<div class="top-submenu">
												<h2><a class="topmenu<?=$k+1?>"><?=$v[NAME]?></a></h2><span class="arrow"></span>
											<ul>
												<?
												foreach ( $menu_2depth[$menu_1depth[$k][TREE_NO]] as $k2 => $v2 ) {
													// 메뉴카테고리일 경우, 첫번째 하위메뉴의 링크주소를 가지고 옴
													if ( $v2[cnt] > 0 && ( $v2[ETC1] == "MENU" ) ) $v2[LINK_URL] = $menu_3depth[$v2[TREE_NO]][0][LINK_URL];
													?>
													<li>
														<a href="<?=$v2[LINK_URL]?>" <?=$v2[LINK_TARGET]?> class="topmenu<?=$k+1?>-<?=$k2+1?>">
															<span class="title"><?=$v2[NAME]?></span>
															<span class="bg"></span>
															<?php if(strpos($v2[LINK_TARGET],"blank")){?><span class="new-window01">새 창</span><?}?>
														</a>
													</li>
													<?
												}
												?>

											</ul>
										</div>
									</li>
								<?}?>
							</ul>
						</div>

						<button type="button" class="btn-totalmenu">
							<span class="menu">
								<span></span>
								<span></span>
								<span></span>
							</span>
						</button>
					</div>
				</div>
			</div>

			<div class="mask-totalmenu"></div>
			<div class="totalmenu-wrapper">
				<div class="bg"></div>
				<div class="mobile-gnb-wrapper">
					<div class="mobile-gnb-area">
						<h2>
							전체메뉴
						</h2>

						<ul>
							<li>
								<? if($_SESSION['MEMBER_ID']!='' || $_SESSION['ID'] != ''){?>
								<?} else {?>
								<a href="/member/login.php">
									<span class="image">
										<img src="/_common/img/icon/icon_type0101.png" alt="" />
									</span>
									<strong>
										로그인
									</strong>
								</a>
								<?}?>
							</li>

							<li>
								<a href="https://www.ch.ac.kr">
									<span class="image">
										<img src="/_common/img/icon/icon_type0102.png" alt="" />
									</span>
									<strong>
										대학메인
									</strong>
								</a>
							</li>

							<li>
								<a href="https://ipsiw.ch.ac.kr">
									<span class="image">
										<img src="/_common/img/icon/icon_type0103.png" alt="" />
									</span>
									<strong>
										입학안내
									</strong>
								</a>
							</li>
						<ul>					
					</div>
				</div>
				<div class="totalmenu-area">
					<ul>
						<? foreach ( $menu_1depth as $k => $v ) {
							// 메뉴카테고리일 경우, 첫번째 하위메뉴의 링크주소를 가지고 옴
							if ( $v[cnt] > 0 && ( $v[ETC1] == "MENU" ) ) $v[LINK_URL] = $menu_2depth[$v[TREE_NO]][0][LINK_URL];

							// 첫번째 하위메뉴도 메뉴카테고리일경우 그보다 더 밑의 첫번째 하위메뉴의 링크주소를 가지고옴 ex) 대학생활
							if($menu_2depth[$v[TREE_NO]][0][cnt] > 0 && ($menu_2depth[$v[TREE_NO]][0][ETC1] == "MENU")){
								$v[LINK_URL] = $menu_3depth[$menu_2depth[$v[TREE_NO]][0][TREE_NO]][0][LINK_URL];

							}
							?>
							<li>
								<a href="<?=$v[LINK_URL]?>" class="topmenu<?=$k+1?>" <?=$v[LINK_TARGET]?>>
									<span class="title">
										<span data-hover="<?=$v[NAME]?>">
											<?=$v[NAME]?>
										</span>
									</span>
								</a>
								<div class="top-submenu">
										<h2><a class="topmenu<?=$k+1?>"><?=$v[NAME]?></a></h2><span class="arrow"></span>
									<ul>
										<?
										foreach ( $menu_2depth[$menu_1depth[$k][TREE_NO]] as $k2 => $v2 ) {
											// 메뉴카테고리일 경우, 첫번째 하위메뉴의 링크주소를 가지고 옴
											if ( $v2[cnt] > 0 && ( $v2[ETC1] == "MENU" ) ) $v2[LINK_URL] = $menu_3depth[$v2[TREE_NO]][0][LINK_URL];
											?>
											<li>
												<a href="<?=$v2[LINK_URL]?>" <?=$v2[LINK_TARGET]?> class="topmenu<?=$k+1?>-<?=$k2+1?>">
													<span class="title"><?=$v2[NAME]?></span>
													<span class="bg"></span>
													<?php if(strpos($v2[LINK_TARGET],"blank")){?><span class="new-window01">새 창</span><?}?>
												</a>
											</li>
											<?
										}
										?>

									</ul>
								</div>
							</li>
						<?}?>
					</ul>
				</div>

				<button type="button" class="btn-mobile-close">
					<img src="/_common/img/btn/btn_close01@2x.png" alt="전체메뉴 닫기" />
				</button>
			</div>
			<script>
				$(document).ready(function() {
					$('#btnLogout').bind('click', function() {
						if(confirm('로그아웃 하시겠습니까?')) {
							location.replace('/login/login_proc.php?site=dent&Confirm=logout')
						}
					})
				});
			</script>