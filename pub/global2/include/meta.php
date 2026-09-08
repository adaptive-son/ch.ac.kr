<?php
// 개별 페이지 실행 방지. 해당 문자열은 inc.constant.php에 정의된다.
define("__AF__", TRUE);
// adframe 템플릿 페이지 설정.
include($_SERVER["DOCUMENT_ROOT"] . "/adframe/af_common.php");
define("_TAG_TITLE",get_site_info('site_name',$_GET['site_id']));
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0" />
<meta name="format-detection" content="telephone=no" />

<!-- url공유 썸네일 이미지 지정 (간호학과 이미지가 잘못 걸려있어 제거 - 추후 국제교류처용 이미지로 교체 예정) -->


<?php

if($_GET['site_id']==""){
    define("TREE_ID", get_site_id());
    define("site_id", get_site_id());
}else{
    define("TREE_ID", $_GET['site_id']);
    define("site_id", $_GET['site_id']);
}
include_once ($_SERVER["DOCUMENT_ROOT"] . "/_common/design_global.php");
include_once ($_SERVER["DOCUMENT_ROOT"] . "/_common/menu.php");

$SERVER_NAME_ex = TREE_ID;
if(strpos(preg_replace("`\/[^/]*\.php$`i", "/", $_SERVER['PHP_SELF']), "adframe")==false) {
    if($nowPage != "/index.php" && $nowPage != "/page/index.php") { //메인 리다이렉트시 통계페이지 접속하지 않음
        include_once($_SERVER['DOCUMENT_ROOT']."/assets/js/logger.php");
    }
}
?>

	
