			<style>
			/* 버튼 위치: header-area 우측, btn-totalmenu(100px) 바로 왼쪽 */
			.header-area .g-lan-box {
			    position: absolute;
			    right: 120px;
			    top: 50%;
			    transform: translateY(-50%);
			    z-index: 200;
			}

			.custom-lang-dropdown { position: relative; }

			.custom-lang-dropdown button#langToggle {
			    display: flex;
			    align-items: center;
			    gap: 4px;
			    height: 40px;
			    padding: 0 12px;
			    background: transparent;
			    border: none;
			    color: #555;
			    font-size: 13px;
			    cursor: pointer;
			    white-space: nowrap;
			    transition: all 0.2s ease-in-out;
			}
			.custom-lang-dropdown button#langToggle:hover {
			    color: #0c4ca3;
			    background-color: #f5f5f5;
			}

			.custom-lang-dropdown button#langToggle::after {
			    content: '';
			    display: inline-block;
			    width: 0;
			    height: 0;
			    border-left: 4px solid transparent;
			    border-right: 4px solid transparent;
			    border-top: 5px solid rgba(0,0,0,0.4);
			    margin-left: 4px;
			    transition: transform 0.2s;
			}
			.custom-lang-dropdown.open button#langToggle::after {
			    transform: rotate(180deg);
			}

			#langList {
			    display: none;
			    position: absolute;
			    top: calc(100% + 4px);
			    right: 0;
			    background: #fff;
			    border: 1px solid #ddd;
			    border-radius: 4px;
			    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
			    list-style: none;
			    padding: 4px 0;
			    margin: 0;
			    min-width: 130px;
			    max-height: 260px;
			    overflow-y: auto;
			    z-index: 9999;
			}
			#langList.open { display: block; }

			#langList li {
			    padding: 7px 14px;
			    font-size: 13px;
			    color: #333;
			    cursor: pointer;
			    white-space: nowrap;
			    transition: background 0.15s;
			}
			#langList li:hover { background: #f2f2f2; }
			#langList li.active { font-weight: bold; color: #0c4ca3; }

			/* 모바일 전체메뉴 내 LANGUAGE 항목 */
			#langListMob {
			    display: none;
			    list-style: none;
			    margin: 0;
			    padding: 0;
			}
			#langListMob.open { display: block; }
			#langListMob li {
			    padding: 10px 20px;
			    font-size: 14px;
			    cursor: pointer;
			}
			#langListMob li.active { font-weight: bold; }
			.mob-lang-arrow {
			    display: inline-block;
			    width: 0;
			    height: 0;
			    border-left: 4px solid transparent;
			    border-right: 4px solid transparent;
			    border-top: 5px solid rgba(255,255,255,0.6);
			    margin-left: 4px;
			    transition: transform 0.2s;
			}
			#langToggleMob.open .mob-lang-arrow { transform: rotate(180deg); }
			</style>
			<script type="text/javascript">
			function googleTranslateElementInit() {
			    new google.translate.TranslateElement({
			        pageLanguage: 'ko',
			        layout: google.translate.TranslateElement.InlineLayout.SIMPLE,
			        autoDisplay: false
			    }, 'google_translate_element');
			}
			</script>
			<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
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

						<div id="google_translate_element" style="display:none;"></div>
						<div class="g-lan-box notranslate" translate="no">
							<div class="custom-lang-dropdown">
								<button id="langToggle" title="구글번역 언어선택">
									<img src="https://www.ch.ac.kr/img/common/google_logo.png" alt="Google 번역" style="height:14px;vertical-align:middle;margin-right:4px;">
									<span>LANGUAGE</span>
								</button>
								<ul id="langList" class="notranslate" translate="no">
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
							</div>
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

<script>
$(document).ready(function() {
    function applyLang(lang, label) {
        if (lang === 'ko') {
            localStorage.removeItem('selectedLang');
            localStorage.removeItem('selectedLangLabel');
            document.cookie = 'googtrans=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/';
            document.cookie = 'googtrans=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/; domain=' + location.hostname;
            location.reload();
            return;
        }

        localStorage.setItem('selectedLang', lang);
        localStorage.setItem('selectedLangLabel', label);

        var select = document.querySelector('.goog-te-combo');
        if (select) {
            select.value = lang;
            var event = document.createEvent('HTMLEvents');
            event.initEvent('change', true, true);
            select.dispatchEvent(event);
        } else {
            document.cookie = 'googtrans=/ko/' + lang + '; path=/';
            location.reload();
        }
    }

    // 페이지 로드 시 저장된 언어 복원
    var savedLang = localStorage.getItem('selectedLang');
    var savedLabel = localStorage.getItem('selectedLangLabel');
    if (savedLang && savedLang !== 'ko' && savedLabel) {
        $('#langToggle span').text(savedLabel);
        $('#langList li[data-lang="' + savedLang + '"]').addClass('active');
        $('#langListMob li[data-lang="' + savedLang + '"]').addClass('active');
    }

    // 데스크탑 LANGUAGE 드롭다운
    $('#langToggle').on('click', function(e) {
        e.stopPropagation();
        var $dropdown = $(this).closest('.custom-lang-dropdown');
        var isOpen = $dropdown.hasClass('open');
        $dropdown.toggleClass('open', !isOpen);
        $('#langList').toggleClass('open', !isOpen);
    });

    $('#langList').on('click', 'li', function() {
        var lang = $(this).data('lang');
        var label = $(this).text().trim();
        $('#langList li').removeClass('active');
        $(this).addClass('active');
        $('#langToggle span').text(label);
        $('.custom-lang-dropdown').removeClass('open');
        $('#langList').removeClass('open');
        applyLang(lang, label);
    });

    // 모바일 전체메뉴 LANGUAGE 드롭다운
    $('#langToggleMob').on('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        $(this).toggleClass('open');
        $('#langListMob').toggleClass('open');
    });

    $('#langListMob').on('click', 'li', function() {
        var lang = $(this).data('lang');
        var label = $(this).text().trim();
        $('#langListMob li').removeClass('active');
        $(this).addClass('active');
        $('#langToggleMob').removeClass('open');
        $('#langListMob').removeClass('open');
        applyLang(lang, label);
    });

    // 외부 클릭 시 닫기
    $(document).on('click', function(e) {
        if (!$(e.target).closest('.g-lan-box').length) {
            $('.custom-lang-dropdown').removeClass('open');
            $('#langList').removeClass('open');
        }
        if (!$(e.target).closest('#langToggleMob, #langListMob').length) {
            $('#langToggleMob').removeClass('open');
            $('#langListMob').removeClass('open');
        }
    });

    // data-hover 속성을 번역된 텍스트로 동기화
    function syncMenuDataHover() {
        document.querySelectorAll('.top-menu-wrapper [data-hover]').forEach(function(span) {
            var text = span.textContent.trim();
            if (text) span.setAttribute('data-hover', text);
        });
    }
    var hoverSyncTimer = null;
    var menuObserver = new MutationObserver(function() {
        clearTimeout(hoverSyncTimer);
        hoverSyncTimer = setTimeout(syncMenuDataHover, 300);
    });
    menuObserver.observe(document.querySelector('.top-menu-wrapper') || document.body, {
        childList: true, subtree: true, characterData: true
    });
    setTimeout(syncMenuDataHover, 1000);
});
</script>