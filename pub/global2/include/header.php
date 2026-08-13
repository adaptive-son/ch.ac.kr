			<!-- skip navigation -->
			<p class="skip-navigation"> 
				<a href="#contents">본문으로 바로가기</a> 
			</p>
			<!-- //skip navigation -->

			<div class="header">
				<div class="header-wrapper">
					<div class="bg"></div>
					<div class="header-area">
						<h1>
							<a href="/main/index.php">
								<img src="/_common/img/common/logo.png?v=<?php echo time()?>" alt="<?=SITE_TITLE?>">
								<strong>
									<?=_TAG_TITLE;?>
								</strong>
							</a>
						</h1>

						<div class="top-menu-wrapper">
							<ul>
								<? foreach ( $menu_1depth as $k => $v ) {
									// 메뉴카테고리일 경우, 첫번째 하위메뉴의 링크주소를 가지고 옴
									if ( $v[cnt] > 0 && ( $v[ETC1] == "MENU" ) )
									$v[LINK_URL] = $menu_2depth[$v[TREE_NO]][0][LINK_URL];
									$v[LINK_TARGET] = $menu_2depth[$v[TREE_NO]][0][LINK_TARGET];

									// 첫번째 하위메뉴도 메뉴카테고리일경우 그보다 더 밑의 첫번째 하위메뉴의 링크주소를 가지고옴 ex) 대학생활
									if($menu_2depth[$v[TREE_NO]][0][cnt] > 0 && ($menu_2depth[$v[TREE_NO]][0][ETC1] == "MENU")){
										$v[LINK_URL] = $menu_3depth[$menu_2depth[$v[TREE_NO]][0][TREE_NO]][0][LINK_URL];

									}

									//입학메뉴에서 입학홈페이지 링크 말고 입학상담 링크주소를 가지고옴
									if($menu_2depth[$v[TREE_NO]][0][ETC1] == "LINK" && $menu_2depth[$v[TREE_NO]][0][LINK_TARGET] == "1"){
										$v[LINK_TARGET] = $menu_2depth[$v[TREE_NO]][1][LINK_TARGET];
										$v[LINK_URL] = $menu_2depth[$v[TREE_NO]][1][LINK_URL];
									}
									?>
									<li class="counter7">
										<a href="<?=$v[LINK_URL]?>" class="topmenu<?=$k+1?>" <?=$v[LINK_TARGET]?>>
											<span class="title">
												<span data-hover="<?=$v[NAME]?>">
													<?=$v[NAME]?>
												</span>
											</span>
										</a>
										<div class="top-submenu">
											<h2>
												<a class="topmenu<?=$k+1?>" <?=$v[LINK_TARGET]?>>
													<?=$v[NAME]?>
												</a>
											</h2>
											<span class="arrow"></span>
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
								<a href="#">
									<span class="image">
										<img src="../../assets/img/icon/icon_type0102.png" alt="" />
									</span>
									<strong>
										대학메인
									</strong>
								</a>
							</li>

							<li>
								<a href="#">
									<span class="image">
										<img src="../../assets/img/icon/icon_type0103.png" alt="" />
									</span>
									<strong>
										입학안내
									</strong>
								</a>
							</li>
							<!-- LANGUAGE -->
							<li>
								<a href="javascript:void(0);" id="langToggleMob" class="custom-lang-dropdown notranslate" translate="no">
									<span class="image">
										<img src="https://ch.ac.kr/img/common/google_logo.png" alt="Google 번역" />
									</span>
									<strong>
										LANGUAGE<span class="mob-lang-arrow"></span>
									</strong>
								</a>
								<ul id="langListMob" class="notranslate" translate="no">
									<li data-lang="en">English</li>
									<li data-lang="vi">Vietnamese</li>
									<li data-lang="uz">Uzbek</li>
									<li data-lang="th">Thai</li>
									<li data-lang="my">Burmese</li>
									<li data-lang="id">Indonesian</li>
									<li data-lang="si">Sinhala</li>
									<li data-lang="mn">Mongolian</li>
									<li data-lang="zh-CN">Chinese</li>
									<li data-lang="ja">Japanese</li>
									<li data-lang="ko">Korean</li>
								</ul>
							</li>
							<!-- //LANGUAGE -->
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
					<img src="../../assets/img/btn/btn_close01@2x.png" alt="전체메뉴 닫기" />
				</button>
			</div>