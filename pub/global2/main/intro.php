<?php
define("__AF__", TRUE);
include($_SERVER["DOCUMENT_ROOT"] . "/adframe/af_common.php");
define("TREE_ID", "global2");
define("site_id", "global2");
include_once($_SERVER["DOCUMENT_ROOT"] . "/_common/menu.php");

$guide_menu_rs = $adb->query("SELECT * FROM guide_menu WHERE site_id='global2' AND use_yn='Y' ORDER BY sort ASC, no ASC");
?>
<!doctype html>
<html lang="ko">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
	<title>춘해보건대학교 국제교류처</title>
	<link rel="stylesheet" href="../../assets/css/reset.css">
	<link rel="stylesheet" href="../css/intro.css">
</head>
<body class="intro">
	<!-- //intro-wrap -->
	<div class="intro-wrapper">
		<div class="intro-area">
			<!-- 로고 -->
			<h1>
				<a href="../main/index.php" class="intro-logo">
					<img src="../img/intro/logo.png" alt="춘해보건대학교" />
					<strong class="intro-logo-text">국제교류처</strong>
				</a>
			</h1>

			<!-- 카드 그리드 -->
			<div class="intro-cards">

				<!-- 국제교류처 -->
				<div class="intro-card card--blue">
					<div class="card-head">
						<a href="./">
						<strong class="card-title">국제교류처</strong>
						<span class="card-title-en">Office of International Affairs</span>
						</a>
					</div>
					<div class="card-body">
						<ul class="card-menu">
							<li><a href="/contents/contents_view.php?site_id=global2&TREE_NO=16612&DEPTH=2">국제교류처 소개</a></li>
							<li><a href="/contents/contents_view.php?site_id=global2&TREE_NO=16618&DEPTH=2">입학 안내(유학생, 연수생)</a></li>
							<li><a href="/contents/contents_view.php?site_id=global2&TREE_NO=16620&DEPTH=2">외국인 전담학과</a></li>
							<li><a href="/contents/contents_view.php?site_id=global2&TREE_NO=16621&DEPTH=2">일반학과</a></li>
							<li><a href="/schedule/list.php?site_id=global2&TREE_NO=16622&DEPTH=2">유학 생활 안내</a></li>
						</ul>
						<div class="card-icon" aria-hidden="true">
							<img src="../img/intro/icon_intro01.png" alt="" />
						</div>
					</div>
				</div>

				<!-- 한국어교육센터 -->
				<div class="intro-card card--teal">
					<div class="card-head">
						<a href="<?=$find_2depth[16627][LINK_URL]?>">
						<strong class="card-title">한국어교육센터</strong>
						<span class="card-title-en">Korean Language Education Center</span>
						</a>
					</div>
					<div class="card-body">
						<ul class="card-menu">
							<li><a href="<?=$find_2depth[16627][LINK_URL]?>">한국어교육센터 소개</a></li>
							<?php while ( $guide_menu_row = $guide_menu_rs->fetchRow(DB_FETCHMODE_ASSOC) ) { ?>
							<li><a href="../guide/view.php?page=<?=$guide_menu_row[page_no]?>&menu=<?=$guide_menu_row[no]?>"><?=$guide_menu_row[title]?></a></li>
							<?php } ?>
							<li><a href="<?=$find_2depth[16634][LINK_URL]?>">공지사항</a></li>
							<li><a href="<?=$find_2depth[16635][LINK_URL]?>">FAQ</a></li>
							<li><a href="<?=$find_2depth[16636][LINK_URL]?>">포토갤러리</a></li>
							<li><a href="<?=$find_2depth[16637][LINK_URL]?>">자료실</a></li>
						</ul>
						<div class="card-icon" aria-hidden="true">
							<img src="../img/intro/icon_intro02.png" alt="" />
						</div>
					</div>
				</div>

				<!-- 글로벌센터 -->
				<div class="intro-card card--sky">
					<div class="card-head">
						<a href="<?=$find_2depth[16639][LINK_URL]?>">
						<strong class="card-title">글로벌센터</strong>
						<span class="card-title-en">Global Center</span>
						</a>
					</div>
					<div class="card-body">
						<ul class="card-menu">
							<li><a href="<?=$find_2depth[16639][LINK_URL]?>">글로벌센터 소개</a></li>
							<li><a href="<?=$find_2depth[16640][LINK_URL]?>">영어 교육</a></li>
							<li><a href="<?=$find_2depth[16641][LINK_URL]?>">해외 연수</a></li>
							<li><a href="<?=$find_2depth[16642][LINK_URL]?>">글로벌 현장학습</a></li>
							<li><a href="<?=$find_2depth[16643][LINK_URL]?>">공지사항</a></li>
							<li><a href="<?=$find_2depth[16644][LINK_URL]?>">FAQ</a></li>
							<li><a href="<?=$find_2depth[16645][LINK_URL]?>">포토갤러리</a></li>
							<li><a href="<?=$find_2depth[16646][LINK_URL]?>">자료실</a></li>
						</ul>
						<div class="card-icon" aria-hidden="true">
							<img src="../img/intro/icon_intro03.png" alt="" />
						</div>
					</div>
				</div>

				<!-- 국제개발협력센터 -->
				<div class="intro-card card--purple">
					<div class="card-head">
						<a href="<?=$find_2depth[16648][LINK_URL]?>">
						<strong class="card-title">국제개발협력센터</strong>
						<span class="card-title-en">International Development Cooperation Center</span>
						</a>
					</div>
					<div class="card-body">
						<ul class="card-menu">
							<li><a href="<?=$find_2depth[16648][LINK_URL]?>">국제개발협력센터 소개</a></li>
							<li><a href="<?=$find_2depth[16649][LINK_URL]?>">코이카 중점 사업</a></li>
							<li><a href="<?=$find_2depth[16650][LINK_URL]?>">개발협력사업</a></li>
							<li><a href="<?=$find_2depth[16651][LINK_URL]?>">공지사항</a></li>
							<li><a href="<?=$find_2depth[16652][LINK_URL]?>">FAQ</a></li>
							<li><a href="<?=$find_2depth[16653][LINK_URL]?>">포토갤러리</a></li>
							<li><a href="<?=$find_2depth[16654][LINK_URL]?>">자료실</a></li>
						</ul>
						<div class="card-icon" aria-hidden="true">
							<img src="../img/intro/icon_intro04.png" alt="" />
						</div>
					</div>
				</div>

			</div>
			<!-- //intro-cards -->
		</div>
	</div>
	<!-- //intro-wrap -->

</body>
</html>
