<!doctype html>
<html lang="ko">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta http-equiv="Content-Script-Type" content="text/javascript" />
	<meta http-equiv="Content-Style-Type" content="text/css" />
	<meta name="subject" content="" />
	<meta name="keywords" content="" />
	<meta name="description" content="" />

	<link rel="stylesheet" type="text/css" href="https://cdn.rawgit.com/moonspam/NanumSquare/master/nanumsquare.css">
	<link rel="stylesheet" href="/_common/css/notokr.css" />
	<link rel="stylesheet" href="/_common/css/roboto.css" />
	<link rel="stylesheet" href="/_common/css/reset.css" />
	<link rel="stylesheet" href="/_common/css/swiper.css">
	<link rel="stylesheet" href="/_common/js/jquery-ui.min.css" />
	<link rel="stylesheet" href="/_common/css/main_board_pc.css" />
	<link rel="stylesheet" href="/_common/css/main_common_pc.css" />
	<link rel="stylesheet" href="/_common/css/main_contents_pc.css" />


	<script type="text/javascript" src="/_common/js/jquery.min.js"></script>
	<script type="text/javascript" src="/_common/js/jquery-ui.min.js"></script>
	<script type="text/javascript" src="/_common/js/jquery.easing.1.3.js" ></script>
	<script type="text/javascript" src="/_common/js/jquery-migrate-1.2.1.min.js"></script>
	<script type="text/javascript" src="/_common/js/main_common.js"></script>
	<script type="text/javascript" src="/_common/js/board.js"></script>
	<script type="text/javascript" src="/adframe/mng/js/basic.js"></script>
	<script type="text/javascript" src="/_common/js/swiper.min.js"></script>

	 

	<script>
		function printPage() {
			var printVal;
			printVal = opener.document.getElementById('contents').innerHTML;
			document.write(printVal);
		}
	</script>
	<title>인쇄 &gt; 춘해보건대학교</title>
	<style>
		body {
			background: #fff;
			-webkit-print-color-adjust:exact; 
		}

		#contents {
			clear: both;
			padding: 10px;
			margin-top: 0;
			border-left: 0;
			zoom: 65%;
		}

		.manager-information-wrapper {
			display: none;
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