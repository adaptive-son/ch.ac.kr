<!doctype html>
<html lang="ko">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta http-equiv="Content-Script-Type" content="text/javascript" />
	<meta http-equiv="Content-Style-Type" content="text/css" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, target-densityDpi=medium-dpi" />
	<meta name="subject" content="감리교신대학교(METHODIST THEOLOGICAL UNIVERSITY) 장천생활관" />
	<meta name="keywords" content="감리교신대학교(METHODIST THEOLOGICAL UNIVERSITY) 장천생활관" />
	<meta name="description" content="감리교신대학교(METHODIST THEOLOGICAL UNIVERSITY) 장천생활관" />

	<link rel="stylesheet" href="../../assets/css/notokr.css">
	<link rel="stylesheet" href="../../assets/css/roboto.css">
	<link rel="stylesheet" href="../../assets/css/reset.css">
	<link rel="stylesheet" href="../../assets/css/board_pc.css">
	<link rel="stylesheet" href="../../assets/css/contents_pc.css">
	<link rel="stylesheet" href="../css/contents_pc.css">
	<link rel="stylesheet" href="../css/common_pc.css">


	<script src="../../assets/js/jquery.min.js"></script>
	<script src="../../assets/js/jquery.easing.1.3.js"></script>
	<script src="../../assets/js/jquery-migrate-1.2.1.min.js"></script>
	<script src="../../assets/js/common.js"></script>
	<script src="../../assets/js/board.js"></script>


	<script>
		function printPage() {
			var printVal;
			printVal = opener.document.getElementById('contents').innerHTML;
			document.write(printVal);
		}
	</script>
	<title>인쇄 &gt; 감리교신대학교(METHODIST THEOLOGICAL UNIVERSITY) 장천생활관</title>
	<style>
		body {
			background: #fff;
		}

		.title-area {
			background: #fff;
			padding: 15px 25px;
		}

		.title-area:after {
			content: "";
			clear: both;
			display: block;
		}

		.title-area h1 {
			float: left;
		}

		.title-area h1 img {
			display: block;
			width: 155px
		}

		#contents {
			clear: both;
			padding: 10px;
			margin-top: 0;
			border-left: 0;
		}
	</style>
</head>

<body onLoad="window.print();">
	<div class="contents" id="contents">
		<script>
			printPage();
		</script>

	</div>
</body>

</html>