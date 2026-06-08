<?php
// 개별 페이지 실행 방지. 해당 문자열은 inc.constant.php에 정의된다.
define("__AF__", TRUE);
session_start();
// adframe 템플릿 페이지 설정.
include_once(dirname(__FILE__) . "/../af_common.php");

// 로그인 여부 확인
if ( !$_SESSION["MEMBER_ID"] && !$_SESSION["S_CHECK"] && !preg_match("|login|", $PHP_SELF) ) {
    alert_replace("https://".$_SERVER["HTTP_HOST"]."/adframe/mng/login.php");
}

//권한
// 2020.12.28 By.Son 권한 추가 "A" 온라인홍보학생 (사이트관리자권한)
if ( $_SESSION["ADMIN_GROUP"] !="T" &&  $_SESSION["ADMIN_GROUP"] !="S" && $_SESSION["ADMIN_GROUP"] !="F" && $_SESSION["ADMIN_GROUP"] !="E" && $_SESSION["ADMIN_GROUP"] !="A" && !preg_match("|login|", $PHP_SELF)) {
     alert_replace("https://".$_SERVER["HTTP_HOST"]."/adframe/mng/login.php");
}

?>