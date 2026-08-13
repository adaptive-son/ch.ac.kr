document.addEventListener('DOMContentLoaded', function() {

	/* 메인 비주얼 슬라이드 */
	new Swiper('#main-visual-slider', {
		loop: true,
		autoplay: {
			delay: 10000,
			disableOnInteraction: false,
		},
		slidesPerView: 1,
		spaceBetween: 0,
		pagination: {
			el: '#main-visual-pagination',
			type: 'fraction',
			formatFractionCurrent: function(number) {
				return ('0' + number).slice(-2);
			},
			formatFractionTotal: function(number) {
				return ('0' + number).slice(-2);
			},
			renderFraction: function(currentClass, totalClass) {
				return '<span class="' + currentClass + '"></span>' +
					' / ' +
					'<span class="' + totalClass + '"></span>';
			}
		},
		navigation: {
			nextEl: '.main-visual-next01',
			prevEl: '.main-visual-prev01',
		}
	});

	menuOn(0, 0, 0);

	/* 배너존 슬라이드 */
	var usingKeyboard = false;

	var bannerSwiper = new Swiper('.main-banner-swiper', {
		loop: true,
		autoplay: {
			delay: 10000,
			disableOnInteraction: false,
		},
		navigation: {
			nextEl: '.swiper-btn-next',
			prevEl: '.swiper-btn-prev',
		},
		a11y: {
			prevSlideMessage: '이전 배너',
			nextSlideMessage: '다음 배너',
		},
	});

	document.addEventListener('keydown', function() { usingKeyboard = true; });
	document.addEventListener('mousedown', function() { usingKeyboard = false; });

	['.swiper-btn-prev', '.swiper-btn-next'].forEach(function(sel) {
		document.querySelector(sel).addEventListener('click', function() {
			if (usingKeyboard) {
				bannerSwiper.autoplay.stop();
				bannerSwiper.slideToLoop(0);
			}
		});
	});

	/* 학과 소개 슬라이드 */
	var deptSwiper = new Swiper('.main-dept-swiper', {
		loop: true,
		slidesPerView: 1,
		autoplay: {
			delay: 10000,
			disableOnInteraction: false,
		},
		pagination: {
			el: '.dept-pagination',
			clickable: true,
		},
		a11y: {
			enabled: true,
			prevSlideMessage: '이전 학과',
			nextSlideMessage: '다음 학과',
			paginationBulletMessage: '{{index}}번째 슬라이드로 이동',
		},
	});

	function updateDeptA11y() {
		document.querySelectorAll('.main-dept-swiper .swiper-slide').forEach(function(slide) {
			var isActive = slide.classList.contains('swiper-slide-active');
			var isDup = slide.classList.contains('swiper-slide-duplicate');
			if (!isActive || isDup) {
				slide.setAttribute('aria-hidden', 'true');
			} else {
				slide.removeAttribute('aria-hidden');
			}
		});
	}

	deptSwiper.on('slideChange', updateDeptA11y);
	updateDeptA11y();

	document.querySelector('.dept-card').addEventListener('click', function(e) {
		if (e.target.closest('.dept-btn-pause')) {
			deptSwiper.autoplay.stop();
			document.querySelector('.dept-card').classList.add('dept-paused');
			document.querySelector('.main-dept-swiper .swiper-wrapper').setAttribute('aria-live', 'off');
			return;
		}
		if (e.target.closest('.dept-btn-play')) {
			deptSwiper.autoplay.start();
			document.querySelector('.dept-card').classList.remove('dept-paused');
			document.querySelector('.main-dept-swiper .swiper-wrapper').setAttribute('aria-live', 'polite');
			return;
		}
	});

	/* 섹션 스크롤 진입 애니메이션 */
	var observer = new IntersectionObserver(function(entries) {
		entries.forEach(function(entry) {
			if (entry.isIntersecting) {
				entry.target.classList.add('is-visible');
			} else if (entry.boundingClientRect.top > 0) {
				entry.target.classList.remove('is-visible');
			}
		});
	}, { threshold: 0.12 });

	document.querySelectorAll('.main-container > article:not(:first-child)').forEach(function(el) {
		observer.observe(el);
	});

	/* aside SNS 텍스트 테마 — li 각각의 위치 기준으로 article별 개별 반전 */
	var asideItems = document.querySelectorAll('.aside-sns-menu > li');
	var asideArticles = document.querySelectorAll('.main-container > article[data-aside-theme]');

	if (asideItems.length && asideArticles.length) {
		function updateAsideTheme() {
			asideItems.forEach(function(item) {
				var rect = item.getBoundingClientRect();
				var centerY = rect.top + rect.height / 2;
				var theme = 'dark';
				asideArticles.forEach(function(article) {
					var aRect = article.getBoundingClientRect();
					if (centerY >= aRect.top && centerY < aRect.bottom) {
						theme = article.dataset.asideTheme || 'dark';
					}
				});
				item.dataset.theme = theme;
			});
		}
		window.addEventListener('scroll', updateAsideTheme, { passive: true });
		updateAsideTheme();
	}

});
