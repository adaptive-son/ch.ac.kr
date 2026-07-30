/* 탭메뉴 공지사항, 신입학, 편입학, 재외국민/외국인 */
$(function() {
	/* 퀵메뉴 */
	$(".aside-quickmenu-wrapper > button").on("click", function() {
		if ($(".aside-quickmenu-wrapper").hasClass('active') != true) {
			$(".aside-quickmenu-wrapper").addClass('active');
			$(".aside-quickmenu-wrapper > .quickmenu-wrapper > ul > li:first-child > button").addClass('active');

		} else {
			$(".aside-quickmenu-wrapper").removeClass('active');
		}	
	});

	/*
	$(".aside-quickmenu-wrapper > button").focus(function() {
		$(".aside-quickmenu-wrapper").addClass('active');
	});
	*/

	$("#public-quickmenu .quickmenu-wrapper > ul > li > button").focus(function() {
		$("#public-quickmenu .quickmenu-wrapper > ul > li > button").removeClass('active');
		$(this).addClass('active');
	});

	$(".quickmenu-wrapper > ul > li:last-child > button + .quickmenu-area > ul > li:last-child > a").blur(function() {
		$(".aside-quickmenu-wrapper, #public-quickmenu .quickmenu-wrapper > ul > li > button").removeClass('active');
	});


	var mainVisualSlider = new Swiper('#main-visual-slider', {
		loop: true,
		autoHeight: true, // 슬라이드 반복
		slidesPerView: 1,
		spaceBetween: 0,
		autoplay: {
			delay: 10000,
			disableOnInteraction: false,
		},
		pagination: {
			el: '.main-visual-swiper-pagination',
			type: "fraction",
		},
		navigation: {
			nextEl: '.main-visual-button-next',
			prevEl: '.main-visual-button-prev',
		},
	});

	$(".main-visual-button-play").hide();

	$(".main-visual-button-pause").click(function() {
		$(".main-visual-button-pause").hide();
		$(".main-visual-button-play").show();
		mainVisualSlider.autoplay.stop();
	});

	$(".main-visual-button-play").click(function() {
		$(".main-visual-button-pause").show();
		$(".main-visual-button-play").hide();
		mainVisualSlider.autoplay.start();
	});

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

	$(".main-board-area > ul > li > button").on("click", function() {
		$(".main-board-area > ul > li > button").removeClass('active');
		$(this).addClass('active');
	});
	
	/* LANGUAGE */
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
            $('#langList li[data-lang="' + savedLang + '"]').addClass('active');
        }

        // 언어 선택
        $('#langList').on('click', 'li', function() {
            var lang = $(this).data('lang');
            var label = $(this).text().trim();
            $('#langList li').removeClass('active');
            $(this).addClass('active');
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

        // 구글 번역이 "춘해보건대학교"를 잘못된 영문 학교명으로 번역하는 문제 보정
        // (구글 번역 위젯은 용어집 기능을 지원하지 않아 번역 결과를 직접 치환)
        var schoolNameFixes = [
            [/Chunhae College of Health Sciences/gi, 'Choonhae Health Sciences University'],
            [/Chunhae University of Health Sciences/gi, 'Choonhae Health Sciences University'],
            [/\bChunhae\b/g, 'Choonhae']
        ];
        function fixSchoolNameTranslation(root) {
            var walker = document.createTreeWalker(root || document.body, NodeFilter.SHOW_TEXT, null, false);
            var node;
            while (node = walker.nextNode()) {
                var text = node.nodeValue;
                if (text.indexOf('Chunhae') === -1) continue;
                var fixed = text;
                schoolNameFixes.forEach(function(pair) {
                    fixed = fixed.replace(pair[0], pair[1]);
                });
                if (fixed !== text) node.nodeValue = fixed;
            }
        }

        var schoolNameFixTimer = null;
        var schoolNameObserver = new MutationObserver(function() {
            clearTimeout(schoolNameFixTimer);
            schoolNameFixTimer = setTimeout(function() { fixSchoolNameTranslation(document.body); }, 300);
        });
        schoolNameObserver.observe(document.body, {
            childList: true,
            subtree: true,
            characterData: true
        });

        setTimeout(function() { fixSchoolNameTranslation(document.body); }, 1000);
		/* //LANGUAGE */
});

/* LANGUAGE */
function googleTranslateElementInit() {
    new google.translate.TranslateElement({
        pageLanguage: 'ko', // 웹사이트의 기본 언어 (한국어)
        // 아래 줄은 선택사항입니다. 특정 언어만 지정하고 싶을 때 사용하세요.
        // includedLanguages: 'en,ja,zh-CN,vi,id', 
        layout: google.translate.TranslateElement.InlineLayout.SIMPLE, // 레이아웃 스타일
        autoDisplay: false
    }, 'google_translate_element');
}
/* //LANGUAGE */