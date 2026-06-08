<?php
// 개별 페이지 실행 방지. 해당 문자열은 inc.constant.php에 정의된다.
define("__AF__", TRUE);
// adframe 템플릿 페이지 설정.
include($_SERVER["DOCUMENT_ROOT"] . "/adframe/af_common.php");
define("_TAG_TITLE",get_site_info('site_name',$_GET['site_id']));
?>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" /> 
	<meta http-equiv="Content-Script-Type" content="text/javascript" />
	<meta http-equiv="Content-Style-Type" content="text/css" />
	<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
	<meta name="subject" content="춘해보건대학교 글로벌케어과" />
	<meta name="keywords" content="춘해보건대학교 글로벌케어과" />
	<meta name="description" content="춘해보건대학교 글로벌케어과" />

	<meta data-n-head="ssr" data-hid="og_image" property="og:image" 
	content="http://sian3.adbank.co.kr/ch_class2025_pub/globalcare/img/sns.png">
	<meta data-n-head="ssr" data-hid="card" name="twitter:card" content="http://sian3.adbank.co.kr/ch_class2025_pub/globalcare/img/sns.png">

	<link rel="stylesheet" href="/assets/css/notokr.css?ver=<?php echo time()?>">
	<link rel="stylesheet" href="/assets/css/roboto.css?ver=<?php echo time()?>">
	<link rel="stylesheet" href="/assets/css/reset.css?ver=<?php echo time()?>">
	<link rel="stylesheet" href="/assets/css/swiper.css?ver=<?php echo time()?>">
	<link rel="stylesheet" href="/assets/css/board.css?ver=<?php echo time()?>">
	<link rel="stylesheet" href="/assets/css/fullcalendar.css?ver=<?php echo time()?>">
	<link rel="stylesheet" href="/assets/css/contents.css?ver=<?php echo time()?>">

<!--	<link rel="stylesheet" href="/css/common.css?ver=<?php echo time()?>">	-->

	<!--23.11.28 추가-->
	<link rel="stylesheet" href="/css/contents.css?ver=<?php echo time()?>">
	<!--23.11.28 추가-->

	<script src="/assets/js/jquery.min.js?ver=<?php echo time()?>"></script>
	<script src="/assets/js/jquery.easing.1.3.js?ver=<?php echo time()?>"></script>
	<script src="/assets/js/jquery-migrate-1.2.1.min.js?ver=<?php echo time()?>"></script>
<!--	<script src="/assets/js/common.js?ver=<?php echo time()?>"></script>-->
	<script src="/assets/js/board.js?ver=<?php echo time()?>"></script>
	<script src="/assets/js/swiper.min.js?ver=<?php echo time()?>"></script>

	<?php
	if($_GET['site_id']==""){
		define("TREE_ID", get_site_id());
		define("site_id", get_site_id());
	}else{
		define("TREE_ID", $_GET['site_id']);
		define("site_id", $_GET['site_id']);
	}
	
	include_once ($_SERVER["DOCUMENT_ROOT"] . "/_common/design.php");	  
		  
	include_once ($_SERVER["DOCUMENT_ROOT"] . "/_common/menu.php");

	$SERVER_NAME_ex = TREE_ID;
	if(strpos(preg_replace("`\/[^/]*\.php$`i", "/", $_SERVER['PHP_SELF']), "adframe")==false) {
		if($nowPage != "/index.php" && $nowPage != "/page/index.php") { //메인 리다이렉트시 통계페이지 접속하지 않음
			include_once($_SERVER['DOCUMENT_ROOT']."/assets/js/logger.php");
		}
	}
	?>
	<!-- Google tag (gtag.js) -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-KDSLK79SY7"></script>
	<script>
	window.dataLayer = window.dataLayer || [];
	function gtag(){dataLayer.push(arguments);}
	gtag('js', new Date());

	gtag('config', 'G-KDSLK79SY7');
	</script>