<?
// 개별 페이지 실행 방지. 해당 문자열은 inc.constant.php에 정의된다.
define("__AF__", TRUE);

// adframe 템플릿 페이지 설정.
include_once(dirname(__FILE__) . "/../af_common.php");

// 개별 페이지 인크루드는 별개로.
?>