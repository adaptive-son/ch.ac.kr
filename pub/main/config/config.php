<?
// PHP7: ext/mysql 제거로 인한 mysql_* 전면 호출 오류 방지용 호환 shim
require_once($_SERVER["DOCUMENT_ROOT"]."/adframe/common/mysql_compat_shim.php");

//header('P3P: CP="ALL CURa ADMa DEVa TAIa OUR BUS IND PHY ONL UNI PUR FIN COM NAV INT DEM CNT STA POL HEA PRE LOC OTC"');
//header('P3P: CP="ALL CURa ADMa DEVa TAIa OUR BUS IND PHY ONL UNI PUR FIN COM NAV INT DEM CNT STA POL HEA PRE LOC OTC"');
@header('P3P: CP="NOI CURa ADMa DEVa TAIa OUR DELa BUS IND PHY ONL UNI COM NAV INT DEM PRE"');

ini_set('register_globals','1'); 
ini_set('session.bug_compat_42','0'); 
ini_set('session.bug_compat_warn','0'); 
ini_set('session.auto_start','1'); 
//��������ð� 30�� ���� ( 2016-04-27 By.Son )
// cach_expire -> �д��� ( �� ������ ĳ���� ���� �������� ������� �ð� )
ini_set("session.cache_expire", 30);
// gc_maxlifetime -> �ʴ��� ( �����Ͱ� '������'�� ��޵ǰ� û���� �ð� )  -  ���� ���� �ð�
ini_set("session.gc_maxlifetime", 1800);


//set_time_limit (0);
ini_set("url_rewriter.tags","");
//session_save_path("/tmp");
//session_set_cookie_params(0,"/");

session_set_cookie_params(0,"/",".ch.ac.kr");
ini_set("session.cookie_domain", ".ch.ac.kr");

@session_start();

@extract($_POST, EXTR_SKIP);
@extract($_GET, EXTR_SKIP);
// extract($_SESSION);
// extract($_SERVER);
$PHP_SELF=$_SERVER[PHP_SELF];
//$HTTP_POST_FILES = $_FILES;
//$HTTP_REFERER=$_SERVER[HTTP_REFERER]; 
//$REMOTE_ADDR=$_SERVER[REMOTE_ADDR];


$HOMEDIR = "/home/ch/www.ch.ac.kr_new/";	//��Ʈ����

$UCC_SIZE_WIDTH = "600";
$UCC_SIZE_HEIGHT = "338";

//$MAINSITEURL = "www.ch.ac.kr";
//$LOGINURL = "http://www.ch.ac.kr";

$MAINSITEURL = "www.ch.ac.kr";
//�ӽ÷� http�� ��
//$LOGINURL = "http://www.ch.ac.kr";
$LOGINURL = "https://www.ch.ac.kr";

$AdminMail = "info@ch.ac.kr";

// ���� ��¥�� �ð�
$timecode = time();
$today = date("Y-m-d", time());
$today1 = date("Ymd", time());
$now   = date("Y-m-d H:i:s", time());

// ����
$_WEEK[0] = "��";
$_WEEK[1] = "��";
$_WEEK[2] = "ȭ";
$_WEEK[3] = "��";
$_WEEK[4] = "��";
$_WEEK[5] = "��";
$_WEEK[6] = "��";

$Config_FileLimitExt = "ext|htm|html|css|asp|aspx|js|jsp|php|php3|php4|php5|phtml|phtm|inc|cgi|phps|pl|sh|htaccess|conf";
$Config_FileImage = "jpg|jpeg|png|gif";

// file load
define(__Error20 ,"�������� ����� ���ε尡 �ƴմϴ�.");
define(__Error21 ,"html, php �������������� ���ε��Ҽ� �����ϴ�");
define(__Error22 ,"������ ũ��� 150*150 ���Ͽ��� �մϴ�");
define(__Error23 ,"������ gif �Ǵ� jpg.png ������ �������� �÷��ּ���");
define(__Error24 ,"���Ͼ��ε忡 �����Ͽ����ϴ�.");

/*
echo "\$PHPSESSID : " .  $PHPSESSID . "<br>"; 
echo "session_id() : " . session_id() . "<br>"; 
echo "session_name : " . session_name(). "<br>"; 
*/
//phpinfo();
?>