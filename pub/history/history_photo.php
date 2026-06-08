<!doctype html>
<html lang="ko">
<?
// 개별 페이지 실행 방지. 해당 문자열은 inc.constant.php에 정의된다.
define("__AF__", TRUE);
// adframe 템플릿 페이지 설정.
include($_SERVER["DOCUMENT_ROOT"] . "/adframe/af_common.php");
require_once (ADFRAME_ROOT_PATH."/lib/class_bbs.php");
?>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta http-equiv="Content-Script-Type" content="text/javascript" />
	<meta http-equiv="Content-Style-Type" content="text/css" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, target-densityDpi=medium-dpi" />
	<meta name="subject" content="춘해보건대학교 역사관" />
	<meta name="keywords" content="춘해보건대학교 역사관" />
	<meta name="description" content="춘해보건대학교 역사관" />

	<link href="https://fonts.googleapis.com/css2?family=Noto+Serif+KR:wght@200;300;400;500;600;700;900&display=swap" rel="stylesheet">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+SC:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="https://cdn.rawgit.com/moonspam/NanumSquare/master/nanumsquare.css">
	<link rel="stylesheet" href="/_common/css/notokr.css">
	<link rel="stylesheet" href="/_common/css/roboto.css">
	<link rel="stylesheet" href="/_common/css/reset.css">
	<link rel="stylesheet" href="/_common/css/main_board.css">
	<link rel="stylesheet" href="./css/history.css">

	<script src="/_common/js/jquery.min.js"></script>
	<script type="text/javascript" src="/_common/js/board.js"></script>

	<link rel="stylesheet" href="/_common/css/swiper.min.css">	
	<script src="/_common/js/swiper.min.js"></script>
	<script src="/_common/js/swiper.thumbnails.js"></script>
	<script>
		$(function() {
			$("a, input, select, button, textarea, label").keyup(function() {
				$(this).css({'outline': 'dashed 3px #fe00f5', 'z-index': '10000'});
			});
			
			$("a, input, select, button, textarea, label").keydown(function() {
				$(this).css({'outline': 'none', 'z-index': 'initial'});
			});


			$(".tabmenu-wrapper > ul > li.active a").attr('title', '선택됨');
		});

	</script>
	<title>
		역사갤러리 &lt; 춘해보건대학교 역사관
	</title>	
</head>

<body>
	<!-- skip navigation -->
	<p class="skip-navigation">
		<a href="#contents">콘텐츠 바로가기</a>
	</p>
	<!-- //skip navigation -->

	<!-- wrapper -->
	<div class="wrapper" id="wrapper">
		<!-- header -->
		<header>
			<div class="header">
				<div class="header-wrapper">
					<h1>
						<img src="./img/logo02_white@2x.png" alt="춘해보건대학교" />
						<strong>
							역사관
						</strong>
					</h1>

					<div class="right-btns">
						<a href="../history/index.php">
							홈으로
						</a>

						<a href="../main/index.php">
							대학메인 바로가기
						</a>
					</div>
				</div>
			</div>
		</header>
		<!-- //header -->
		
		<!-- sub visual -->
		<div class="sub-visual">
			<img src="./img/img_subvisual_pc.jpg" alt="" class="pc" />
			<img src="./img/img_subvisual_mobile.jpg" alt="" class="mobile" />
			<p>
				<img src="./img/word_subvisual01.png" alt="역사갤러리" />
			</p>
		</div>
		<!-- //sub visual -->

		<!-- section -->
		<section>
			<div class="container">
				<article>
					<div class="contents" id="contents">
						<?
						$dataArr=Decode64($_GET['data']);
                        create_bbs("2636", "", "0", "", "", "");
                        ?>
					</div>
				</article>
			</div>
		</section>
		<!-- //section -->
		<!-- footer -->
		<footer>
			<div class="footer">
				<address>
					(44965) 울산광역시 울주군 웅촌면 대학길 9 춘해보건대학교   TEL : (052)270-0401~6, 0132~5    FAX : (052) 225-9889
				</address>
				<p class="copyright">
					Copyright(c)2020 Choonhae College of Health Sciences All Reight reserved.
				</p>
			</div>
		</footer>
		<!-- //footer -->
	</div>
	<!-- //wrapper -->

	<script>
		$(function() {
			$(".sub-visual > img").addClass('active');
		});
	</script>
</body>
</html>