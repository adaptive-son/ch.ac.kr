<?
@session_start();
//print_R($_SESSION);
?>
<style>
.g-lan-box { position: relative; display: inline-block; }

.custom-lang-dropdown { position: relative; }

/* gnb-wrapper가 .header(z-index:100, DOM 후순위)에 가려지지 않도록 */
.gnb-wrapper { z-index: 200 !important; }

.custom-lang-dropdown button#langToggle {
    display: flex;
    align-items: center;
    gap: 4px;
    height: 38px;
    padding: 0 20px;
    background: transparent;
    border: none;
    color: #828282;
    font-size: 12px;
    cursor: pointer;
    white-space: nowrap;
    transition: all 0.2s ease-in-out;
}
.custom-lang-dropdown button#langToggle:hover {
    background: #edecea;
}
.custom-lang-dropdown button#langToggle::after {
    content: '';
    display: inline-block;
    width: 0;
    height: 0;
    border-left: 4px solid transparent;
    border-right: 4px solid transparent;
    border-top: 5px solid #828282;
    margin-left: 4px;
    transition: transform 0.2s;
}
.custom-lang-dropdown.open button#langToggle::after {
    transform: rotate(180deg);
}
#langToggle .lang-text::before {
    content: 'LANGUAGE';
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
#langList li.active { font-weight: bold; color: #0054a4; }
</style>
<script type="text/javascript">
function googleTranslateElementInit() {
    new google.translate.TranslateElement({
        pageLanguage: 'ko', // 웹사이트의 기본 언어 (한국어)
        // 아래 줄은 선택사항입니다. 특정 언어만 지정하고 싶을 때 사용하세요.
        // includedLanguages: 'en,ja,zh-CN,vi,id', 
        layout: google.translate.TranslateElement.InlineLayout.SIMPLE, // 레이아웃 스타일
        autoDisplay: false
    }, 'google_translate_element');
}
</script>

<script type="text/javascript">
function clearGoogTransCookie() {
    // 구글 번역 위젯이 현재 호스트뿐 아니라 상위 도메인(예: .ch.localhost)에도
    // 자체적으로 googtrans 쿠키를 심는 경우가 있어, 가능한 모든 도메인 단계를 지운다.
    document.cookie = 'googtrans=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
    var parts = location.hostname.split('.');
    for (var i = 0; i < parts.length - 1; i++) {
        document.cookie = 'googtrans=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/; domain=' + parts.slice(i).join('.') + ';';
    }
}
(function() {
    // 브라우저를 완전히 껏다 켜서 새로 방문한 경우(이번 세션에 sessionStorage 기록이 없음)라면
    // 이전에 선택했던 googtrans 쿠키와 localStorage에 저장된 언어를 지워 한국어로 초기화한다.
    // 같은 브라우저를 계속 켜둔 채로 페이지 이동/새로고침하는 동안에는 선택한 언어가 유지된다.
    if (!sessionStorage.getItem('ch_lang_session')) {
        clearGoogTransCookie();
        localStorage.removeItem('selectedLang');
        localStorage.removeItem('selectedLangLabel');
        sessionStorage.setItem('ch_lang_session', '1');
    }
})();
</script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
<header>
    <!-- skip navigation -->
    <p class="skip-navigation">
        <a href="#contents">메인콘텐츠 바로가기</a>
    </p>
    <!-- //skip navigation -->

    <div class="header">
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
							<a href="https://www.ch.ac.kr/main/index.php" target="_blank" title="새창열림">
								<span>
									대학메인
								</span>
								<img src="/_common/img/icon/icon_new_window01@2x.gif" alt="새창열림" />
							</a>
						</li>

						<li>
							<a href="http://ipsiw.ch.ac.kr/page/main/index.php" target="_blank" title="새창열림">
								<span>
									입학안내
								</span>
								<img src="/_common/img/icon/icon_new_window01@2x.gif" alt="새창열림" />
							</a>
						</li>

						<li>
                            <? if($_SESSION['MEMBER_ID']!='' || $_SESSION['ID'] != ''){?>
                                <a href="javascript:;" id="btnLogout">
                                    <span>
									    로그아웃
								    </span>
                                </a>
                            <?} else {?>
							
								<a href="/login/login.php">
                                    <span>
									    로그인
								    </span>
                                </a>
                            <?}?>
						</li>

						<!-- LANGUAGE -->
						<li>
							<div class="g-lan-box" translate="no">
								<div class="custom-lang-dropdown notranslate">
								  <button id="langToggle" title="구글번역 언어선택"><img src="https://ch.ac.kr/img/common/google_logo.png" alt="Google 번역" style="height:14px;vertical-align:middle;margin-right:4px;"><span class="lang-text notranslate" translate="no"></span></button>
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
						</li>
						<!-- //LANGUAGE -->
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
							<li>
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
						<? if($_SESSION['MEMBER_ID']!='' || $_SESSION['ID'] != ''){?>
							<a href="javascript:;" id="btnLogout"><!--추후 경로 수정-->
								<span class="image">
									<img src="/_common/img/icon/icon_type0101.png" alt="" />
								</span>
								<strong>
									로그아웃
								</strong>
							</a>
						<?} else {?>
							<a href="/login/login.php"><!--추후 경로 수정-->
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
				</ul>
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
            <img src="/_common/img/btn/btn_close01@2x.png" alt="전체메뉴 닫기">
        </button>



    </div>


</header>
<script>
    $(document).ready(function() {
        $('#btnLogout').bind('click', function() {
            if(confirm('로그아웃 하시겠습니까?')) {
                location.replace('/login/login_proc.php?Confirm=logout')
            }
        });

        // 페이지 로드 시 저장된 언어 복원
        var savedLang = localStorage.getItem('selectedLang');
        var savedLabel = localStorage.getItem('selectedLangLabel');
        if (savedLang && savedLang !== 'ko' && savedLabel) {
            $('#langList li[data-lang="' + savedLang + '"], #langListMob li[data-lang="' + savedLang + '"]').addClass('active');
        }

        // 언어 드롭다운 토글
        $('#langToggle').on('click', function(e) {
            e.stopPropagation();
            var $dropdown = $(this).closest('.custom-lang-dropdown');
            var $list = $('#langList');
            var isOpen = $dropdown.hasClass('open');
            $dropdown.toggleClass('open', !isOpen);
            $list.toggleClass('open', !isOpen);
        });

        $('#langToggleMob').on('click', function(e) {
            e.stopPropagation();
            var $dropdown = $(this).closest('.custom-lang-dropdown');
            var $list = $('#langListMob');
            var isOpen = $dropdown.hasClass('open');
            $dropdown.toggleClass('open', !isOpen);
            $list.toggleClass('open', !isOpen);
        });

        // 외부 클릭 시 닫기
        $(document).on('click', function(e) {
            if (!$(e.target).closest('.g-lan-box').length) {
                $('.custom-lang-dropdown').removeClass('open');
                $('#langList, #langListMob').removeClass('open');
            }
        });

        // 언어 선택
        $('#langList, #langListMob').on('click', 'li', function() {
            var lang = $(this).data('lang');
            var label = $(this).text().trim();
            $('#langList li, #langListMob li').removeClass('active');
            $('#langList li[data-lang="' + lang + '"], #langListMob li[data-lang="' + lang + '"]').addClass('active');
            $('.custom-lang-dropdown').removeClass('open');
            $('#langList, #langListMob').removeClass('open');

            if (lang === 'ko') {
                localStorage.removeItem('selectedLang');
                localStorage.removeItem('selectedLangLabel');
                clearGoogTransCookie();
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
        });

        // data-hover 속성을 번역된 텍스트로 동기화
        function syncMenuDataHover() {
            document.querySelectorAll('.top-menu-wrapper > ul > li > a .title span[data-hover]').forEach(function(span) {
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