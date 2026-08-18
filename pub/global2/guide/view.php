<!doctype html>
<html lang="ko">
<head>
	<? include "../include/meta.php" ?>

	<title>
		한국어교육센터 - 춘해보건대학교 국제교류처
	</title>
</head>

<body>
	<!-- wrapper -->
	<div class="wrapper" id="wrapper">
		<!-- header -->
		<header>
			<? include "../include/header.php" ?>
		</header>
		<!-- //header -->

		<?php
		$page = intval($_GET['page']);
		if ( !$page ) $page = 1;
		$menu_no = intval($_GET['menu']);

		$pdf_row = $adb->getRow("SELECT * FROM guide_pdf WHERE site_id='global2'", DB_FETCHMODE_ASSOC);
		$menu_rs = $adb->query("SELECT * FROM guide_menu WHERE site_id='global2' AND use_yn='Y' ORDER BY sort ASC, no ASC");

		$guide_menu_list = array();
		$current_title = "한국어교육센터";
		while ( $m = $menu_rs->fetchRow(DB_FETCHMODE_ASSOC) ) {
			$guide_menu_list[] = $m;
		}
		// menu 파라미터가 없으면 첫 번째 메뉴를 기본 선택
		if ( !$menu_no && count($guide_menu_list) > 0 ) $menu_no = $guide_menu_list[0][no];

		foreach ( $guide_menu_list as $m ) {
			if ( $m[no] == $menu_no ) $current_title = $m[title];
		}

		$PAGENAME1 = "한국어교육센터";
		$PAGENAME2 = $current_title;
		?>

		<!-- sub visual -->
		<? include "../include/sub_visual.php" ?>
		<!-- //sub visual -->

		<!-- container -->
		<section>
			<div class="container" id="container">
				<div class="container-wrapper">
					<!-- lnb -->
					<div class="lnb-wrapper">
						<div class="lnb-area">
							<h2><a class="topmenu guide-title"><?=$current_title?></a></h2><span class="arrow"></span>
							<ul>
								<li>
									<a href="<?=$find_2depth[16627][LINK_URL]?>">
										<span>한국어교육센터 소개</span>
										<span class="bg"></span>
									</a>
								</li>
								<?php foreach ( $guide_menu_list as $m ) { ?>
								<li>
									<a href="view.php?page=<?=$m[page_no]?>&menu=<?=$m[no]?>" class="<?=($m[no]==$menu_no)?'active':''?>">
										<span><?=$m[title]?></span>
										<span class="bg"></span>
									</a>
								</li>
								<?php } ?>
								<li>
									<a href="<?=$find_2depth[16634][LINK_URL]?>">
										<span>공지사항</span>
										<span class="bg"></span>
									</a>
								</li>
								<li>
									<a href="<?=$find_2depth[16635][LINK_URL]?>">
										<span>FAQ</span>
										<span class="bg"></span>
									</a>
								</li>
								<li>
									<a href="<?=$find_2depth[16636][LINK_URL]?>">
										<span>포토갤러리</span>
										<span class="bg"></span>
									</a>
								</li>
								<li>
									<a href="<?=$find_2depth[16637][LINK_URL]?>">
										<span>자료실</span>
										<span class="bg"></span>
									</a>
								</li>
							</ul>
						</div>
					</div>
					<!-- //lnb -->

					<!-- contents -->
					<article>
						<div class="contents" id="contents">
							<h3 class="contents-title guide-contents-title">
								<?=$current_title?>
								<span class="arrow"></span>
							</h3>

							<div class="contents-wrapper">
								<?php if ( $pdf_row[pdf_name] ) { ?>

								<div class="btns-area btns-pdf pt0">
									<div class="btns-right">
										<a href="<?=GUIDE_LOAD_PATH?>/<?=$pdf_row[pdf_name]?>" class="btn-pdf-download" download>
											<span>모집요강 PDF다운로드</span>
											<img src="../img/icon/icon_download01.png" alt="" />
										</a>
										<a href="https://get.adobe.com/reader/?loc=kr" class="btn-pdf-download" target="_blank">
											<span>PDF뷰어 다운로드</span>
											<img src="../img/icon/icon_download01.png" alt="" />
										</a>
									</div>
								</div>

								<iframe class="div-pdf" src="../pdfjs/web/viewer.html?file=<?=GUIDE_LOAD_PATH?>/<?=$pdf_row[pdf_name]?>#page=<?=$page?>" title="<?=$current_title?>"></iframe>

								<?php } else { ?>
								<p>등록된 자료가 없습니다.</p>
								<?php } ?>
							</div>
						</div>
					</article>
					<!-- //contents -->
				</div>
			</div>
		</section>
		<!-- //container -->

		<!-- footer -->
		<footer>
			<? include "../include/footer.php" ?>
		</footer>
		<!-- //footer -->
	</div>
	<!-- //wrapper -->
</body>
</html>
