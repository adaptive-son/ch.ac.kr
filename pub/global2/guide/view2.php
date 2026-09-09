<!doctype html>
<html lang="ko">
<head>
	<? include "../include/meta.php" ?>

	<?php
	$admission_tree_no = intval($_GET['TREE_NO']);

	$admission_title = ${"find_2depth"}[$admission_tree_no][NAME];
	if ( trim($admission_title) == "" ) {
		$admission_title_row = $adb->getRow("SELECT * FROM af_tree WHERE TREE_ID='global2' AND TREE_NO='".$admission_tree_no."'", DB_FETCHMODE_ASSOC);
		$admission_title = $admission_title_row[NAME] ? $admission_title_row[NAME] : "입학안내";
	}
	?>

	<title>
		<?=$admission_title?> - 춘해보건대학교 국제교류처
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

		// 이미 업로드되어 있는 "연수생 입학" PDF(admission_pdf, semester_key='trainee')를 그대로 불러온다
		$admission_row = $adb->getRow("SELECT * FROM admission_pdf WHERE site_id='global2' AND semester_key='trainee'", DB_FETCHMODE_ASSOC);
		$pdf_row = array(pdf_name => $admission_row[pdf_name]);
		$current_title = $admission_title;
		?>

		<!-- sub visual -->
		<? include "../include/sub_visual.php" ?>
		<!-- //sub visual -->

		<!-- container -->
		<section>
			<div class="container" id="container">
				<? include "../include/contents_navi.php" ?>
				<div class="container-wrapper">
					<!-- lnb : 연수생 입학은 소속 메뉴가 페이지마다 달라 표준 lnb를 그대로 사용 -->
					<? include "../include/lnb.php" ?>
					<!-- //lnb -->

					<!-- contents -->
					<article>
						<div class="contents" id="contents">
							<?php
							$admission_dept_eng_map = array(
								"국제교류처" => "INTERNATIONAL AFFAIRS OFFICE",
								"한국어교육센터" => "KOREAN LANGUAGE EDUCATION CENTER",
								"글로벌센터" => "GLOBAL CENTER",
								"국제개발협력센터" => "INTERNATIONAL DEVELOPMENT COOPERATION CENTER",
							);
							$admission_dept_eng = isset($admission_dept_eng_map[$pageName1]) ? $admission_dept_eng_map[$pageName1] : "INTERNATIONAL AFFAIRS OFFICE";
							?>
							<h3 class="contents-title guide-contents-title" data-eng-title="<?=$admission_dept_eng?>">
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
								<p style="text-align:center;"><img src="../img/common/img_preparation.jpg" alt="준비중입니다" /></p>
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
