<?php

//#########################################################
// 상수 설정
//#########################################################
include(dirname(__FILE__) . "/common/inc.constant.php");

//#########################################################
// 기본설정
//#########################################################

// 기본 인코딩
@header("Content-Type: text/html; charset=".CHAR_TYPE);
@header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1
@header("Pragma: no-cache"); // HTTP/1.0

//#########################################################
// 세션 설정
//#########################################################
ini_set('session.auto_start','1');
ini_set("session.cookie_domain", "".SERVICE_DOMAIN);		// 세션이 활성화될 도메인
ini_set("session.cookie_lifetime", 86400);           // 세션 적용시간 늘이기 위함 ( 20170831.By.Son )
ini_set("session.cache_expire", 86400);				// 세션 유지 시간 ( 단위 : 분 )
ini_set("session.gc_maxlifetime",86400);			// 세션 가비지 컬렉션 ( 로그인 지속 시간 / 단위 : 초 )
//ini_set("session.use_trans_sid", 0);				// PHPSESSID를 자동으로 넘기지 않음
ini_set("url_rewriter.tags","");							// 링크에 PHPSESSID가 따라다니는것을 무력화함 (해뜰녘님께서 알려주셨습니다.)

//cyhwang 2022-07-28 춘해대 소스취약점 패치
//session_set_cookie_params(0,"/");					// 세션 쿠기가 적용되는 위치
session_set_cookie_params(0, "/home/dev/data/session.cookie", SERVICE_DOMAIN);


// 세션 시작
@session_start();
//print_R(SERVER_DOMAIN);
// register_globals 설정
@extract($_GET);
@extract($_POST);
@extract($_SERVER);

// 2026-08-19 취약점 조치: site_id/TREE_ID는 코드 전반에서
// include("../".$TREE_ID."/include/header.php") 형태로 파일 경로에 그대로 쓰인다.
// 값 검증이 없으면 "../" 등 경로 순회나 "http://"를 이용한 원격 파일 포함(RFI)이
// 가능해지므로, 영문/숫자/언더스코어만 허용하는 화이트리스트로 전역 차단한다.
// (사이트 폴더가 새로 추가되어도 전부 이 형식이라 별도 유지보수가 필요 없다.)
// af_common.php는 페이지에서 직접 include된 후, meta.php 등을 거쳐 다시 한 번
// include되는 경우가 많아(include_once가 아님) 이 파일이 한 요청 안에서 두 번
// 실행될 수 있다. 그래서 함수 재선언으로 인한 fatal error를 피하기 위해 감싼다.
if ( !function_exists('_af_valid_site_id') ) {
	function _af_valid_site_id($v) {
		return preg_match('/^[a-zA-Z0-9_]+$/', $v) === 1;
	}
}
foreach ( array('site_id', 'TREE_ID') as $_afSiteIdKey ) {
	if ( isset($_GET[$_afSiteIdKey]) && !_af_valid_site_id($_GET[$_afSiteIdKey]) ) $_GET[$_afSiteIdKey] = "";
	if ( isset($_POST[$_afSiteIdKey]) && !_af_valid_site_id($_POST[$_afSiteIdKey]) ) $_POST[$_afSiteIdKey] = "";
	if ( isset($_REQUEST[$_afSiteIdKey]) && !_af_valid_site_id($_REQUEST[$_afSiteIdKey]) ) $_REQUEST[$_afSiteIdKey] = "";
}
if ( isset($site_id) && !_af_valid_site_id($site_id) ) $site_id = "";
if ( isset($TREE_ID) && !_af_valid_site_id($TREE_ID) ) $TREE_ID = "";

// Pear 라이브러리 디렉토리 설정
ini_set("include_path", ADFRAME_ROOT_PATH."/lib/Pear");

// 쿠키 경로 설정
ini_set("session.cookie_path", "/");

@umask(0000);

// 에러 메시지 확인
if(version_compare(PHP_VERSION, '5.4.0', '<')) {
	@error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED ^ E_WARNING);
	//error_reporting(E_ALL);				// 에러내용 전체보기
} else {
	@error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED ^ E_WARNING ^ E_STRICT);
}

// 개별 페이지 실행 방지
if ( !defined(ADFRAME_PREFIX) ) {
	echo " Not Defined \"ADFRMAE_PREFIX\" ";
	exit();
}

// 보안설정 및 프레임과 상관없이 쿠키 허용
@header('P3P: CP="ALL CURa ADMa DEVa TAIa OUR BUS IND PHY ONL UNI PUR FIN COM NAV INT DEM CNT STA POL HEA PRE LOC OTC"');



// 스크립트 실행 시간 설정
if ( !isset($set_time_limit) ) $set_time_limit = 0;
@set_time_limit($set_time_limit);

// DB 관련 파일
include_once(ADFRAME_ROOT_PATH."/common/dsn.ini.php");
require_once('DB.php');
$adb = DB::connect($dsn);
if ( PEAR::isError($adb) ) die($adb->getMessage()."(".__FILE__.":".__LINE__.")");
$adb->setFetchMode(DB_FETCHMODE_ASSOC);
// 한글 깨짐 방지
mysql_query("set session character_set_connection=utf8;");
mysql_query("set session character_set_results=utf8;");
mysql_query("set session character_set_client=utf8;");

// include Library
include_once(dirname(__FILE__) . "/lib/lib.function.php");
include_once(dirname(__FILE__) . "/lib/lib.function.custom.php");
include_once(dirname(__FILE__) . "/lib/lib.password.php");
include_once(dirname(__FILE__) . "/lib/Mobile_Detect.php");
include_once(ADFRAME_ROOT_PATH."/common/denyip.php");

if(getcwd()=="/home/dev/adframe/mng"){
	if(strpos($_SERVER['REMOTE_ADDR'],"203.230.254.") !== false){
		//ok
	}elseif(strpos($_SERVER['REMOTE_ADDR'],"218.154.173.") !== false){
		//ok
	}elseif(strpos($_SERVER['REMOTE_ADDR'],"218.154.174.") !== false){
		//ok
	}elseif(strpos($_SERVER['REMOTE_ADDR'],"218.154.175.") !== false){
		//ok
	}elseif(strpos($_SERVER['REMOTE_ADDR'],"220.67.101.") !== false){
		//ok
	}elseif(strpos($_SERVER['REMOTE_ADDR'],"220.84.113.50") !== false){ //언어치료센터
		//ok
	}elseif(strpos($_SERVER['REMOTE_ADDR'],"112.217.216.") !== false){	//adbank 추가
		//ok
	}elseif(strpos($_SERVER['REMOTE_ADDR'],"125.135.90.") !== false){	//adbank 추가
	}elseif(strpos($_SERVER['REMOTE_ADDR'],"10.10.12.100") !== false){	//vpn용 가상IP
	}elseif(strpos($_SERVER['REMOTE_ADDR'],"10.10.12.101") !== false){	//vpn용 가상IP
	}elseif(strpos($_SERVER['REMOTE_ADDR'],"10.10.12.102") !== false){	//vpn용 가상IP
	}elseif(strpos($_SERVER['REMOTE_ADDR'],"10.10.12.143") !== false){	//vpn용 가상IP
	}elseif(strpos($_SERVER['REMOTE_ADDR'],"10.10.12.119") !== false){	//vpn용 가상IP
	}elseif(strpos($_SERVER['REMOTE_ADDR'],"124.59.152.238") !== false){
	}elseif(strpos($_SERVER['REMOTE_ADDR'],"172.50.1.") !== false){
	}elseif(strpos($_SERVER['REMOTE_ADDR'],"172.50.2.") !== false){
	}elseif(strpos($_SERVER['REMOTE_ADDR'],"172.50.3.") !== false){
	}elseif(strpos($_SERVER['REMOTE_ADDR'],"172.50.4.") !== false){
	}elseif(strpos($_SERVER['REMOTE_ADDR'],"172.50.5.") !== false){
	}elseif(strpos($_SERVER['REMOTE_ADDR'],"172.50.6.") !== false){
	}elseif(strpos($_SERVER['REMOTE_ADDR'],"172.50.7.") !== false){
	}elseif(strpos($_SERVER['REMOTE_ADDR'],"172.50.8.") !== false){
	}elseif(strpos($_SERVER['REMOTE_ADDR'],"172.50.9.") !== false){
		
	}else{
		//out
		echo("<script> 접근가능한 지역이 아닙니다.</script>");
		exit;
	}

}
?>
