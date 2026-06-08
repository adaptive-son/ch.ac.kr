<?
//header('P3P: CP="ALL CURa ADMa DEVa TAIa OUR BUS IND PHY ONL UNI PUR FIN COM NAV INT DEM CNT STA POL HEA PRE LOC OTC"');
//header('P3P: CP="ALL CURa ADMa DEVa TAIa OUR BUS IND PHY ONL UNI PUR FIN COM NAV INT DEM CNT STA POL HEA PRE LOC OTC"');
@header('P3P: CP="NOI CURa ADMa DEVa TAIa OUR DELa BUS IND PHY ONL UNI COM NAV INT DEM PRE"'); 

ini_set('register_globals','1'); 
ini_set('session.bug_compat_42','0'); 
ini_set('session.bug_compat_warn','0'); 
ini_set('session.auto_start','1'); 
//세션종료시간 30분 변경 ( 2016-04-27 By.Son )
// cach_expire -> 분단위 ( 분 단위로 캐시한 세션 페이지가 살아있을 시간 )
ini_set("session.cache_expire", 30);
// gc_maxlifetime -> 초단위 ( 데이터가 '쓰레기'로 취급되고 청소할 시간 )  -  세션 만료 시간
ini_set("session.gc_maxlifetime", 1800);


//set_time_limit (0);
ini_set("url_rewriter.tags","");
//session_save_path("/tmp");
//session_set_cookie_params(0,"/");

session_set_cookie_params(0,"/",".ch.ac.kr");
ini_set("session.cookie_domain", ".ch.ac.kr");

@session_start();

extract($_POST);
extract($_GET);
extract($_SESSION);
extract($_SERVER);
$PHP_SELF=$_SERVER[PHP_SELF];
//$HTTP_POST_FILES = $_FILES;
//$HTTP_REFERER=$_SERVER[HTTP_REFERER]; 
//$REMOTE_ADDR=$_SERVER[REMOTE_ADDR];


$HOMEDIR = "/home/ch/www.ch.ac.kr_new/";	//루트폴더

$UCC_SIZE_WIDTH = "600";
$UCC_SIZE_HEIGHT = "338";

//$MAINSITEURL = "www.ch.ac.kr";
//$LOGINURL = "http://www.ch.ac.kr";

$MAINSITEURL = "www.ch.ac.kr";
//임시로 http로 함
//$LOGINURL = "http://www.ch.ac.kr";
$LOGINURL = "https://www.ch.ac.kr";

$AdminMail = "info@ch.ac.kr";

// 현재 날짜와 시간
$timecode = time();
$today = date("Y-m-d", time());
$today1 = date("Ymd", time());
$now   = date("Y-m-d H:i:s", time());

// 요일
$_WEEK[0] = "일";
$_WEEK[1] = "월";
$_WEEK[2] = "화";
$_WEEK[3] = "수";
$_WEEK[4] = "목";
$_WEEK[5] = "금";
$_WEEK[6] = "토";

$Config_FileLimitExt = "ext|htm|html|css|asp|aspx|js|jsp|php|php3|php4|php5|phtml|phtm|inc|cgi|phps|pl|sh|htaccess|conf";
$Config_FileImage = "jpg|jpeg|png|gif";

// file load
define(__Error20 ,"정상적인 방법의 업로드가 아닙니다.");
define(__Error21 ,"html, php 서버관련파일은 업로드할수 없습니다");
define(__Error22 ,"사진의 크기는 150*150 이하여야 합니다");
define(__Error23 ,"사진은 gif 또는 jpg.png 형태의 웹파일을 올려주세요");
define(__Error24 ,"파일업로드에 실패하였습니다.");

/*
echo "\$PHPSESSID : " .  $PHPSESSID . "<br>"; 
echo "session_id() : " . session_id() . "<br>"; 
echo "session_name : " . session_name(). "<br>"; 
*/
//phpinfo();
?>