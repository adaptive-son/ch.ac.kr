<?
	/*
	header('P3P: CP="ALL CURa ADMa DEVa TAIa OUR BUS IND PHY ONL UNI PUR FIN COM NAV INT DEM CNT STA POL HEA PRE LOC OTC"');
	//header('P3P: CP="NOI CURa ADMa DEVa TAIa OUR DELa BUS IND PHY ONL UNI COM NAV INT DEM PRE"'); 
		
	session_set_cookie_params(0,"/",".adbank.co.kr");
	ini_set("session.cookie_domain", ".adbank.co.kr");
	
	session_start();
	extract($_POST);
	extract($_GET);
	*/
	exit;
	
	include $_SERVER["DOCUMENT_ROOT"]."/config/config.php";
	
	$_POST = array_map('mysql_escape_string', $_POST);
	$_GET = array_map('mysql_escape_string', $_GET);

	include $_SERVER["DOCUMENT_ROOT"]."/config/function.php";
	include $_SERVER["DOCUMENT_ROOT"]."/config/ora11g_conn.php";



	$oradb=new ora11g();
	$oradb->con();

	//$loginQue = "SELECT a.emplnamk, a.EMPLNUMB, a.postcode, a.homephon, b.passnumb, c.postname from choonhae.employee a, choonhae.UserPass b, choonhae.postcode c WHERE a.postcode=c.postcode AND a.EMPLNUMB = b.useridnt AND EMPLNUMB='".$_GET['key']."' ";
	//$loginQue = "SELECT a.emplnamk, a.EMPLNUMB, a.postcode, a.homephon, b.passnumb from choonhae.employee a, choonhae.UserPass b WHERE a.EMPLNUMB = b.useridnt AND EMPLNUMB='".$_GET['key']."' ";
	$loginQue = "SELECT a.emplnamk, a.EMPLNUMB, a.postcode, a.homephon, a.handphon, b.passnumb from choonhae.employee a, choonhae.UserPass b WHERE a.EMPLNUMB = b.useridnt AND emplnamk='".$_GET['key']."' ";
	$rs=$oradb->query($loginQue);
	
	echo $rs[HANDPHON];
	
	$oradb->discon();


?>