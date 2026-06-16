<style>
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
							<a href="../main/index.php">
								<img src="/_common/img/common/logo.png" alt="춘해보건대학교" />
								<strong>
									 국제교류처
								</strong>
							</a>
						</h1>

						<div class="top-menu-wrapper">
							<? include "../include/menu.php" ?>
						</div>

						<div id="google_translate_element" style="display:none;"></div>
						<div class="g-lan-box notranslate" translate="no">
							<div class="custom-lang-dropdown">
								<button id="langToggle" title="구글번역 언어선택">
									<img src="/_common/img/common/google_logo.png" alt="Google 번역" style="height:14px;vertical-align:middle;margin-right:4px;">
									<span>LANGUAGE</span>
								</button>
								<ul id="langList" class="notranslate" translate="no">
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
							
							<img src="../../assets/img/common/logo.png" alt="춘해보건대학교" />
							<strong>
								 국제교류처
							</strong>
							
						</h2>

					</div>
				</div>
				<div class="totalmenu-area">
					<? include "../include/menu.php" ?>
				</div>

				<button type="button" class="btn-mobile-close">
					<img src="../../assets/img/btn/btn_close01@2x.png" alt="전체메뉴 닫기" />
				</button>
			</div>
<script>
$(document).ready(function() {
    // 페이지 로드 시 저장된 언어 복원
    var savedLang = localStorage.getItem('selectedLang');
    var savedLabel = localStorage.getItem('selectedLangLabel');
    if (savedLang && savedLang !== 'ko' && savedLabel) {
        $('#langToggle span').text(savedLabel);
        $('#langList li[data-lang="' + savedLang + '"]').addClass('active');
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

    // 외부 클릭 시 닫기
    $(document).on('click', function(e) {
        if (!$(e.target).closest('.g-lan-box').length) {
            $('.custom-lang-dropdown').removeClass('open');
            $('#langList').removeClass('open');
        }
    });

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