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
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, target-densityDpi=medium-dpi" />
	<meta name="subject" content="CHOONHAE COLLEGE OF HEALTH SCIENCES" />
	<meta name="keywords" content="CHOONHAE COLLEGE OF HEALTH SCIENCES" />
	<meta name="description" content="CHOONHAE COLLEGE OF HEALTH SCIENCES" />

	<link href="https://fonts.googleapis.com/css2?family=Noto+Serif+KR:wght@200;300;400;500;600;700;900&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="https://cdn.rawgit.com/moonspam/NanumSquare/master/nanumsquare.css">
	<link rel="stylesheet" href="/_common/css/notokr.css">
	<link rel="stylesheet" href="/_common/css/roboto.css">
	<link rel="stylesheet" href="/_common/css/reset.css">


	<link rel="stylesheet" href="/_common/css/board.css">

	<link rel="stylesheet" href="../css/contents.css">
	<link rel="stylesheet" href="../css/common.css">

	<script src="/_common/js/jquery.min.js"></script>
	<script src="/_common/js/jquery.easing.1.3.js"></script>
	<script src="/_common/js/jquery-migrate-1.2.1.min.js"></script>
	<script src="/_common/js/board.js"></script>
	<script src="/_common/js/common_eng.js"></script>

	<link rel="stylesheet" href="/_common/css/swiper.min.css">	
	<script src="/_common/js/swiper.min.js"></script>

    <?php
    
    if($_GET['site_id']==""){
        define("TREE_ID", get_site_id());
        define("site_id", get_site_id());
    }else{
        define("TREE_ID", $_GET['site_id']);
        define("site_id", $_GET['site_id']);
    }

    include_once ($_SERVER["DOCUMENT_ROOT"] . "/_common/menu_en.php");

	$SERVER_NAME_ex = TREE_ID;
if(strpos(preg_replace("`\/[^/]*\.php$`i", "/", $_SERVER['PHP_SELF']), "adframe")==false) {
    if($nowPage != "/index.php" && $nowPage != "/page/index.php") { //메인 리다이렉트시 통계페이지 접속하지 않음
        include_once($_SERVER['DOCUMENT_ROOT']."/assets/js/logger.php");
    }
}
?>



