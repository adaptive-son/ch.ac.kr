<!doctype html>
<html lang="ko">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<script src="./assets/js/jquery.min.js"></script>
	<title>춘해대학교 - 메인 페이지 퍼블리싱</title>
	<style>
		html {
			font-size: 14px;
			font-family: sans-serif;
			line-height: 1.15;
		}
		body {
			color: #495057;
			font-size: 1rem;
			line-height: 1.5;
			background-color: #f8f9fa;
		}
		h1 {
			margin-top: 3rem;
			color: #212529;
			text-align: center;
		}
		table {
			border-collapse: collapse;
			table-layout: fixed;
			width: 100%;
			background-color: #fff;
		}
		caption {
			font-size: 0;
			width: 0;
			height: 0;
			line-height: 0;
			margin: 0;
			padding: 0;
			background: none;
			overflow: hidden;
		}
		th, td {}
		th {
			padding: 0.5rem 0;
			border: 1px solid #212529;
			background-color: #343a40;
			color: #fff;
		}
		td {
			padding: 0.25rem;
			padding-top: calc(0.25rem + 2px);
			border: 1px solid #e9ecef;
			vertical-align: top;
		}
		.container {
			width: 80%;
			margin: 0 auto;
		}
		table .num,
		table .dir,
		table .status {
			text-align: center;
		}

		td.finish {
			color: #15aabf;
		}

		/* tabmenu list */
		.tabmenu-wrapper {
			border-bottom: 1px solid #dadada
		}

		.tabmenu-wrapper > ul {
			display: block;
			margin: 0;
			padding: 0;
		}

		.tabmenu-wrapper > ul:after {
			content: "";
			display: block;
			clear: both;
		}

		.tabmenu-wrapper > ul > li {
			position: relative;
			float: left;
			margin-bottom: -1px;
			margin-right: -1px;
			list-style: none;
		}

		.tabmenu-wrapper > ul > li.active {
			z-index: 10;
		}

		.tabmenu-wrapper > ul > li > a {
			display: block;
			height: 30px;
			line-height: 30px;
			padding: 0px 20px;
			color: #777777;
			font-size: 13px;
			background: #fbfbfb;
			border: 1px solid #dadada;
			text-align: center;
			text-decoration: none;
		}

		.tabmenu-wrapper > ul > li.active > a {
			position: relative;
			color: #000000;
			background: #fff;
			border: 1px solid #0f0f0f;
			z-index: 10;
		}



		@media (max-width: 1440px) {
			.container {
				width: 98%;
			}
		}
		@media (max-width: 1023px) {
			.horizontal-scroll {
				position: relative;
				width: 100%;
				overflow-y: hidden;
				overflow-x: auto;
				background:
						linear-gradient(to right, rgba(0, 0, 0, .15), rgba(0, 0, 0, 0)) no-repeat 0 0 / 20px 100% scroll,
						linear-gradient(to right, rgba(0, 0, 0, 0), rgba(0, 0, 0, .15)) no-repeat 100% 0 / 20px 100% scroll, #fff;
			}

			.horizontal-scroll table {
				width: 80rem;
				background:
						linear-gradient(to right, #fff, rgba(255, 255, 255, 0)) no-repeat 0 0 / 80px 100% local,
						linear-gradient(to right, rgba(255, 255, 255, 0), #fff) no-repeat 100% 0 / 80px 100% local;
			}

			.horizontal-scroll::-webkit-scrollbar {
				width: 6px;
				height: 6px;
				border-radius: 6px;
				background-color: rgba(0, 0, 0, 0.05);
			}

			.horizontal-scroll::-webkit-scrollbar-thumb {
				border-radius: 6px;
				background-color: rgba(0, 0, 0, 0.25);
			}
		}
	</style>
</head>
<body>

<div class="container">

	<h1>춘해대학교 - 메인 프로그램 페이지 퍼블리싱</h1>


	<div class="list" id="list1">
		<div class="horizontal-scroll">
			<table>
				<colgroup>
					<col style="width: 3%">
					<col style="width: 14%">
					<col style="width: 3%">
					<col style="width: 14%">
					<col style="width: 3%">
					<col style="width: 10%">
					<col style="width: 10%">
					<col style="width: 16%">
					<col style="width: 4%">
					<col style="width: auto">
				</colgroup>
				<thead>
					<tr>
						<th scope="col" colspan="2">
							1 depth
						</th>
						<th scope="col" colspan="2">
							2 depth
						</th>
						<th scope="col" colspan="2">
							3 depth
						</th>
						<th scope="col">
							directory
						</th>
						<th scope="col">
							file name
						</th>
						<th scope="col">
							status
						</th>
						<th scope="col">
							description
						</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td class="num">
							00
						</td>
						<td>
							게시판
						</td>
						<td class="num">
							00
						</td>
						<td>
							공지사항 (목록)
						</td>
						<td class="num"></td>
						<td></td>
						<td class="dir">
							/sub01
						</td>
						<td>
							<a href="./sub01/sub01.php" target="_blank" title="새 창 열림">sub01.php</a>
						</td>
						<td class="status finish">
							
						</td>
						<td class="desc">
							완료
						</td>
					</tr>

					<tr>
						<td class="num">
							00
						</td>
						<td>
							게시판
						</td>
						<td class="num">
							00
						</td>
						<td>
							공지사항 (보기)
						</td>
						<td class="num"></td>
						<td></td>
						<td class="dir">
							/sub01
						</td>
						<td>
							<a href="./sub01/sub01_view.php" target="_blank" title="새 창 열림">sub01_view.php</a>
						</td>
						<td class="status finish">
							
						</td>
						<td class="desc">
							완료
						</td>
					</tr>

					<tr>
						<td class="num">
							00
						</td>
						<td>
							게시판
						</td>
						<td class="num">
							00
						</td>
						<td>
							공지사항 (쓰기)
						</td>
						<td class="num"></td>
						<td></td>
						<td class="dir">
							/sub01
						</td>
						<td>
							<a href="./sub01/sub01_write.php" target="_blank" title="새 창 열림">sub01_write.php</a>
						</td>
						<td class="status finish">
							
						</td>
						<td class="desc">
							완료
						</td>
					</tr>

					<tr>
						<td class="num">
							00
						</td>
						<td>
							게시판
						</td>
						<td class="num">
							00
						</td>
						<td>
							포토갤러리 (목록)
						</td>
						<td class="num"></td>
						<td></td>
						<td class="dir">
							/sub01
						</td>
						<td>
							<a href="./board/photo.php" target="_blank" title="새 창 열림">photo.php</a>
						</td>
						<td class="status finish">
							
						</td>
						<td class="desc">
							완료
						</td>
					</tr>

					<tr>
						<td class="num">
							04
						</td>
						<td>
							대학안내
						</td>
						<td class="num">
							01
						</td>
						<td>
							대학규정집
						</td>
						<td class="num"></td>
						<td></td>
						<td class="dir">
							/sub01
						</td>
						<td>
							<a href="./sub01/sub0301.php" target="_blank" title="새 창 열림">sub0301.php</a>
						</td>
						<td class="status finish">
						</td>
						<td class="desc">
							완료<br />
							<span style="color: red">
								https://www.hallym.ac.kr/hallym_univ/sub04/cP4/sCP3/tab1.html
							</span>
						</td>
					</tr>

					<tr>
						<td class="num">
							04
						</td>
						<td>
							대학안내
						</td>
						<td class="num">
							01
						</td>
						<td>
							전화번호 안내
						</td>
						<td class="num"></td>
						<td></td>
						<td class="dir">
							/sub01
						</td>
						<td>
							<a href="./sub01/sub0603.php" target="_blank" title="새 창 열림">sub0603.php</a>
						</td>
						<td class="status finish">
							
						</td>
						<td class="desc">
							완료<br />
							<span style="color: red">
								http://www.uc.ac.kr/www/index.php?pCode=uctel
							</span>
						</td>
					</tr>

					<tr>
						<td class="num">
							05
						</td>
						<td>
							뉴스&amp커뮤니티
						</td>
						<td class="num">
							04
						</td>
						<td>
							교내뉴스
						</td>
						<td class="num"></td>
						<td></td>
						<td class="dir">
							/sub04
						</td>
						<td>
							<a href="./sub04/sub01.php" target="_blank" title="새 창 열림">sub01.php</a>
						</td>
						<td class="status finish">
							
						</td>
						<td class="desc">
							완료<br />
							<span style="color: red">
								http://www.kit.ac.kr/kit/pr/campus-news
							</span>
						</td>
					</tr>

					<tr>
						<td class="num">
							06
						</td>
						<td>
							뉴스&amp커뮤니티
						</td>
						<td class="num">
							04
						</td>
						<td>
							교내뉴스 (보기)
						</td>
						<td class="num"></td>
						<td></td>
						<td class="dir">
							/sub04
						</td>
						<td>
							<a href="./sub04/sub01_view.php" target="_blank" title="새 창 열림">sub01_view.php</a>
						</td>
						<td class="status finish">
							
						</td>
						<td class="desc">
							완료
						</td>
					</tr>

					<tr>
						<td class="num">
							07
						</td>
						<td>
							뉴스&amp커뮤니티
						</td>
						<td class="num">
							04
						</td>
						<td>
							교내뉴스 (쓰기)
						</td>
						<td class="num"></td>
						<td></td>
						<td class="dir">
							/sub04
						</td>
						<td>
							<a href="./sub04/sub01_write.php" target="_blank" title="새 창 열림">sub01_write.php</a>
						</td>
						<td class="status finish">
							
						</td>
						<td class="desc">
							완료
						</td>
					</tr>

					<tr>
						<td class="num">
							08
						</td>
						<td>
							뉴스&amp커뮤니티
						</td>
						<td class="num">
							04
						</td>
						<td>
							언론보도
						</td>
						<td class="num"></td>
						<td></td>
						<td class="dir">
							/sub04
						</td>
						<td>
							<a href="./sub04/sub02.php" target="_blank" title="새 창 열림">sub02.php</a>
						</td>
						<td class="status finish">
							
						</td>
						<td class="desc">
							완료<br />
							<span style="color: Red">
								http://www.uc.ac.kr/info/index.php?pCode=ucwww
							</span>
						</td>
					</tr>

					<tr>
						<td class="num">
							09
						</td>
						<td>
							뉴스&amp커뮤니티
						</td>
						<td class="num">
							04
						</td>
						<td>
							홍보영상
						</td>
						<td class="num"></td>
						<td></td>
						<td class="dir">
							/sub04
						</td>
						<td>
							<a href="./sub04/sub07.php" target="_blank" title="새 창 열림">sub07.php</a>
						</td>
						<td class="status finish">
							
						</td>
						<td class="desc">
							완료
						</td>
					</tr>

					<tr>
						<td class="num">
							10
						</td>
						<td>
							뉴스&amp커뮤니티
						</td>
						<td class="num">
							04
						</td>
						<td>
							홍보영상 (보기)
						</td>
						<td class="num"></td>
						<td></td>
						<td class="dir">
							/sub04
						</td>
						<td>
							<a href="./sub04/sub07_view.php" target="_blank" title="새 창 열림">sub07_view.php</a>
						</td>
						<td class="status finish">
							
						</td>
						<td class="desc">
							완료
						</td>
					</tr>

					<tr>
						<td class="num">
							11
						</td>
						<td>
							뉴스&amp커뮤니티
						</td>
						<td class="num">
							04
						</td>
						<td>
							카드뉴스
						</td>
						<td class="num"></td>
						<td></td>
						<td class="dir">
							/sub04
						</td>
						<td>
							<a href="./sub04/sub08.php" target="_blank" title="새 창 열림">sub08.php</a>
						</td>
						<td class="status finish">
							
						</td>
						<td class="desc">
							완료<br />
							<span style="color: red">
								https://www.kca.go.kr/home/sub.do?menukey=4004&mode=view&no=1002985842
							</span>
						</td>
					</tr>

					<tr>
						<td class="num">
							12
						</td>
						<td>
							뉴스&amp커뮤니티
						</td>
						<td class="num">
							04
						</td>
						<td>
							카드뉴스 (보기)
						</td>
						<td class="num"></td>
						<td></td>
						<td class="dir">
							/sub04
						</td>
						<td>
							<a href="./sub04/sub08_view.php" target="_blank" title="새 창 열림">sub08_view.php</a>
						</td>
						<td class="status finish">
							
						</td>
						<td class="desc">
							완료
						</td>
					</tr>


					<tr>
						<td class="num">
							13
						</td>
						<td>
							대학생활
						</td>
						<td class="num">
							05
						</td>
						<td>
							학사일정
						</td>
						<td class="num"></td>
						<td></td>
						<td class="dir">
							/sub05
						</td>
						<td>
							<a href="./sub05/sub05.php" target="_blank" title="새 창 열림">sub05.php</a>
						</td>
						<td class="status finish">
							
						</td>
						<td class="desc">
							완료
							<br />
							<span style="color: red"> 
								(참고 :		https://www.kiwu.ac.kr/ko/cms/FR_CON/index.do?MENU_ID=230&SCH_YEAR=2020)
							</span>
						</td>
					</tr>

				</tbody>
			</table>
		</div>
	</div>

</div>

</body>
</html>