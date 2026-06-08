<?
@session_start();
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
    height: 40px;
    padding: 0 15px;
    background: transparent;
    border: none;
    color: #b1c3db;
    font-size: 14px;
    cursor: pointer;
    white-space: nowrap;
    transition: all 0.2s ease-in-out;
}
.custom-lang-dropdown button#langToggle:hover {
    color: #fff;
    background-color: rgba(0,0,0,0.3);
}
.custom-lang-dropdown button#langToggle::after {
    content: '';
    display: inline-block;
    width: 0;
    height: 0;
    border-left: 4px solid transparent;
    border-right: 4px solid transparent;
    border-top: 5px solid rgba(255,255,255,0.8);
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

<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
<header>
	<!-- gnb wrapper -->
	<div class="gnb-wrapper">
		<div class="left">
			<ul>
				<li>
					<a href="../main/index.php" target="_self">
						대학메인
					</a>
				</li>
				<li>
					<a href="http://eclass.ch.ac.kr/" target="_blank" title="새창열림">
						e클래스
					</a>
				</li>
				<li>
				<?php
				if($_SESSION['ID']) {
				?>
				<a href="https://job.ch.ac.kr/sso/Logout.aspx" target="_blank">
				<?php
				}else{
				?>
					<a href="https://job.ch.ac.kr/default.aspx" target="_blank" title="새창열림">
				<?php } ?>
						학생이력관리시스템
					</a>
				</li>
				<li>
					<a href="https://hs1.ch.ac.kr" target="_blank" title="새창열림">
						학사행정시스템
					</a>
				</li>
				<li>
					<a href="https://lib.ch.ac.kr" target="_blank" title="새창열림">
						도서관
					</a>
				</li>
				<li>
					<a href="https://chgw.ch.ac.kr" target="_blank" title="새창열림">
						전자결재
					</a>
				</li>
			</ul>
		</div>
		<div class="right">
			<ul>
				<li>
					<div class="g-lan-box" translate="no">
						<div class="custom-lang-dropdown notranslate">
						  <button id="langToggle" title="구글번역 언어선택"><img src="/img/common/google_logo.png" alt="Google 번역" style="height:14px;vertical-align:middle;margin-right:4px;"><span>LANGUAGE</span></button>
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
							<li data-lang="ko">Korean</li>
						  </ul>
						</div>
					</div>
				</li>
				<!-- <li>
					<a href="/english/main/index.php" target="_blank" title="새창 열림">
						ENGLISH
					</a>
				</li> -->
			</ul>
			<button type="button" class="btn-popup" id="popupzone-toggle-button">
				<span>
					POPUP
				</span>
			</button>
		</div>
	</div>
	<!-- //gnb wrapper -->

	<div class="header">
		<div class="header-wrapper">
			<div class="header-area">
				<h1>
					<a href="../main/index.php">
						춘해보건대학교
					</a>
				</h1>

				<div class="top-menu-wrapper">
					<? include "menu.php" ?>
				</div>


				<div class="right-side-menu-wrapper">
					<div class="side-menu-area">
						<button type="button" class="btn-option">
							<strong>
								옵션
							</strong>
						</button>
						<div class="side-menu-area01">
							<img src="/_common/img02/common/bubble_tail01@2x.png" class="bubble-tail" alt="" />
							<ul>
								<li>
									<a href="../main/index.php">
										홈
									</a>
								</li>
								<li>
									<? if($_SESSION['MEMBER_ID']!='' || $_SESSION['ID'] != ''){?>
										<a href="javascript:;" id="btnLogout">
											<span>
												로그아웃
											</span>
										</a>
									<?} else {
										
										?>
											<a href="../login/login.php">
											<span>
												로그인
											</span>
										</a>
									<?}?>
								</li>
							</ul>
							<button type="button" class="btn-clsoe">
								닫기
							</button>
						</div>
					</div>

					<div class="total-menu-search-wrapper">
						<div class="total-search-wrapper">
							<button type="button" class="btn-total-search">
								<label for="top-search-form">통합검색</label>
							</button>
							<div class="total-search-area">
								<form action="/totalsearch/totalsearch.php" method="post">
									<fieldset>
										<legend class="blind">
											통합검색
										</legend>
										<input type="search" id="top-search-form" name="top-search-form" value="" placeholder="검색어를 입력해주세요." />
										<input type="submit" name="" value="검색">
										<button type="button" class="btn-close">
											창닫기
										</button>
									</fieldset>
								</form>
							</div>
						</div>
					</div>

					<button type="button" title="사이트맵 열기" class="btn-totalmenu">
						<span class="menu">
							<span></span>
							<span></span>
							<span></span>
						</span>
					</button>
				</div>
			</div>
		</div>
	</div>

	<div class="mask-totalmenu"></div>
	<div class="totalmenu-wrapper">
		<div class="mobile-gnb-wrapper">
			<ul>
				<li>
					<a href="../main/index.php">
						<img src="/img/common/icon_mobile_gnb0101.png" alt="홈으로" />

						<strong>
							홈으로
						</strong>
					</a>
				</li>

				<li>
					<? if($_SESSION['MEMBER_ID']!='' || $_SESSION['ID'] != ''){?>
						<a href="javascript:;" id="btnLogout">
							<img src="/img/common/icon_mobile_gnb0102.png" alt="홈으로" />
							<strong>
								로그아웃
							</strong>
						</a>
					<?} else {
						?>
						<a href="../login/sso/business.php">
							<img src="/img/common/icon_mobile_gnb0102.png" alt="홈으로" />
							<strong>
								로그인
							</strong>
						</a>
					<?}?>
				</li>

				<li>
					<!-- http://eng.ch.ac.kr/(기존) -> 인트로 페이지가 생기면서 링크 수정 -->
					<a href="https://www.ch.ac.kr/english/main/index.php" target="_blank" title="새창열림">
						<img src="/img/common/icon_mobile_gnb0103.png" alt="대학메인" />
						<strong>
							ENGLISH
						</strong>
					</a>
				</li>
			</ul>
		</div>


		<div class="totalmenu-area">
			<div class="totalmenu-depth1">
				<ul>
					<?
						foreach ( $menu_1depth as $k => $v ) {
						// 메뉴카테고리일 경우, 첫번째 하위메뉴의 링크주소를 가지고 옴
						if ( $v[cnt] > 0 && ( $v[ETC1] == "MENU" ) )
						$v[LINK_URL] = $menu_2depth[$v[TREE_NO]][0][LINK_URL];
						$v[LINK_TARGET] = $menu_2depth[$v[TREE_NO]][0][LINK_TARGET];

						// 첫번째 하위메뉴도 메뉴카테고리일경우 그보다 더 밑의 첫번째 하위메뉴의 링크주소를 가지고옴 ex) 대학생활
						if($menu_2depth[$v[TREE_NO]][0][cnt] > 0 && ($menu_2depth[$v[TREE_NO]][0][ETC1] == "MENU")){
							$v[LINK_URL] = $menu_3depth[$menu_2depth[$v[TREE_NO]][0][TREE_NO]][0][LINK_URL];
						}

						//3차 까지 메뉴카테고리일 경우 4차 메뉴 링크 가져옴 ex)대학안내 - 20.12.21 shlee
						if($menu_3depth[$menu_2depth[$v[TREE_NO]][0][TREE_NO]][0][cnt] > 0 && ($menu_3depth[$menu_2depth[$v[TREE_NO]][0][TREE_NO]][0][ETC1] == "MENU")){
							$v[LINK_URL] = $menu_4depth[$menu_3depth[$menu_2depth[$v[TREE_NO]][0][TREE_NO]][0][TREE_NO]][0][LINK_URL];
						}

						//입학메뉴에서 입학홈페이지 링크 말고 입학상담 링크주소를 가지고옴
						if($menu_2depth[$v[TREE_NO]][0][ETC1] == "LINK" && $menu_2depth[$v[TREE_NO]][0][LINK_TARGET] == "1"){
							$v[LINK_TARGET] = $menu_2depth[$v[TREE_NO]][1][LINK_TARGET];
							$v[LINK_URL] = $menu_2depth[$v[TREE_NO]][1][LINK_URL];
						}

						

						if($v[MENU_ON]=="Y") {
					?>
						<li>
							<?
								if($v[cnt]>0 && $v[ETC1]=="MENU") {
							?>
							<button type="button" class="topmenu<?=$k+1?>">
								<span>
									<?=$v[NAME]?>
								</span>
							</button>
							<? } else if($v[cnt]=="0" && $v[ETC1]=="LINK") { ?>
							<a href="<?=$v[LINK_URL]?>" class="topmenu<?=$k+1?>" target="_blank">
								<span>
									<?=$v[NAME]?>
								</span>
							</a>
							<? } ?>
						</li>

					<? } } ?>
				</ul>
			</div>


			<div class="totalmenu-depth2-wrapper">
				<div class="totalmenu-depth2-area">
					<div class="totalmenu-depth2-box">
						<?

							foreach ( $menu_1depth as $k => $v ) {
								if($v[cnt]>0 && $v[ETC1]=="MENU") {
						?>
						<div class="totalmenu-depth2-group topmenu<?=$k+1?>">
							<h2>
								<?=$v[NAME]?>
							</h2>
							<ul>
							<?
								foreach ( $menu_2depth[$menu_1depth[$k][TREE_NO]] as $k2 => $v2 ) {
							?>
								<li>
									<a href="<?=$v2[LINK_URL]?>" <?=$v2[LINK_TARGET]?> class="topmenu<?=$k+1?>-<?=$k2+1?>">
										<span class="title">
											<?=$v2[NAME]?>
										</span>
										<? if($v2[cnt]>0) { ?>
										<span class="arrow"></span>
										<? } ?>
									</a>
								</li>
								<? } ?>
							</ul>
						</div>
						<? } } ?>
					</div>

					<div class="totalmenu-depth2-box">
						<?

							foreach ( $menu_1depth as $k => $v ) {
							foreach ( $menu_2depth[$v[TREE_NO]] as $k2 => $v2 ) {

								if($v2[cnt]>0 && $v2[ETC1]=="MENU") {
						?>
						<div class="totalmenu-depth3-group topmenu<?=$k+1?>-<?=$k2+1?>">
							<h3>
								<button type="button">
									<?=$v2[NAME]?>
								</button>
							</h3>

							<ul class="topmenu<?=$k+1?>-<?=$k2+1?>">
								<?
									foreach ( $menu_3depth[$v2[TREE_NO]] as $k3 => $v3 ) {
								?>
								<li>
									<a href="<?=$v3[LINK_URL]?>" <?=$v3[LINK_TARGET]?> class="topmenu<?=$k+1?>-<?=$k2+1?>-<?=$k3+1?>">
										<?=$v3[NAME]?>
										<?
											if($v3[cnt]>0) {
										?>
										<span class="arrow"></span>
										<? } ?>
									</a>
									<?
										if($v3[cnt]>0) {
									?>
									<ul class="topmenu<?=$k+1?>-<?=$k2+1?>-<?=$k3+1?>">
										<?
											foreach ( $menu_4depth[$v3[TREE_NO]] as $k4 => $v4 ) {
										?>
										<li>
											<a href="<?=$v4[LINK_URL]?>" <?=$v4[LINK_TARGET]?> class="topmenu<?=$k+1?>-<?=$k2+1?>-<?=$k3+1?>-<?=$k4+1?>">
												<?=$v4[NAME]?>
											</a>
										</li>
										<? } ?>
									</ul>
									<? } ?>
								</li>
								<? } ?>
							</ul>
						</div>
						<? } } } ?>
					</div>
				</div>
			</div>
		</div>


		<button type="button" class="btn-mobile-close">
			<img src="/img/common/btn_close_mobile.png" alt="전체메뉴 닫기" />
		</button>
	</div>
</header>
<script>
    $(document).ready(function() {
        $('#btnLogout').bind('click', function() {
            if(confirm('로그아웃 하시겠습니까?')) {
					location.replace('/login/login_proc.php?Confirm=logout');
			}
        });

        // 언어 드롭다운 토글
        $('#langToggle').on('click', function(e) {
            e.stopPropagation();
            var $dropdown = $(this).closest('.custom-lang-dropdown');
            var $list = $('#langList');
            var isOpen = $dropdown.hasClass('open');
            $dropdown.toggleClass('open', !isOpen);
            $list.toggleClass('open', !isOpen);
        });

        // 외부 클릭 시 닫기
        $(document).on('click', function(e) {
            if (!$(e.target).closest('.g-lan-box').length) {
                $('.custom-lang-dropdown').removeClass('open');
                $('#langList').removeClass('open');
            }
        });

        // 페이지 로드 시 저장된 언어 복원
        var savedLang = localStorage.getItem('selectedLang');
        var savedLabel = localStorage.getItem('selectedLangLabel');
        if (savedLang && savedLang !== 'ko' && savedLabel) {
            $('#langToggle span').text(savedLabel);
            $('#langList li[data-lang="' + savedLang + '"]').addClass('active');
        }

        // 언어 선택
        $('#langList').on('click', 'li', function() {
            var lang = $(this).data('lang');
            var label = $(this).text().trim();
            $('#langList li').removeClass('active');
            $(this).addClass('active');
            $('#langToggle span').text(label);
            $('.custom-lang-dropdown').removeClass('open');
            $('#langList').removeClass('open');

            if (lang === 'ko') {
                localStorage.removeItem('selectedLang');
                localStorage.removeItem('selectedLangLabel');
                var cookie = '/';
                document.cookie = 'googtrans=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=' + cookie;
                document.cookie = 'googtrans=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=' + cookie + '; domain=' + location.hostname;
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
        // 구글 번역은 DOM 텍스트는 바꾸지만 data-* 속성은 바꾸지 않으므로 직접 갱신
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
            childList: true,
            subtree: true,
            characterData: true
        });

        // 페이지 로드 후 이미 번역된 상태인 경우 대비
        setTimeout(syncMenuDataHover, 1000);
    });
</script>
