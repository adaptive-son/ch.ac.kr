<?php
// Get방식으로 넘어온 변수를 Decode하는 함수
function Decode64($sending_data){

	$vars=explode("&",base64_decode(str_replace("||","",$sending_data)));

	$vars_num=count($vars);
	for($i=0;$i<$vars_num;$i++){
		$elements=explode("=",$vars[$i]);
		$var[$elements[0]]=$elements[1];
	}
	return $var;
}

function go_back($msg="") {
    echo "<script>";
    if ( $msg ) echo "alert('".$msg."');";
    echo "history.go(-1); </script>";
    exit;
}



function mb_basename($path) { return end(explode('/',$path)); }
function utf2euc($str) { return iconv("UTF-8","EUC-KR", $str); }
function is_ie() {
	if(!isset($_SERVER['HTTP_USER_AGENT']))return false;
	if(strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false) return true; // IE8
	if(strpos($_SERVER['HTTP_USER_AGENT'], 'Windows NT 6.1') !== false) return true; // IE11
	return false;
}


?>
<?

	$_POST = array_map('mysql_escape_string', $_POST);
	$_GET = array_map('mysql_escape_string', $_GET);

	if(strpos($_SERVER['HTTP_REFERER'], $_SERVER['HTTP_HOST']) == false)  exit;

	/*
	 *	HEADER() 설정 차이로 인해 기본 라이브러리를 별도로 설정
	*/
	include($_SERVER['DOCUMENT_ROOT'] . "/adframe/common/inc.constant.php");
	// Pear 라이브러리 디렉토리 설정
	ini_set("include_path", ADFRAME_ROOT_PATH."/lib/Pear");
	require_once(ADFRAME_ROOT_PATH . "/common/dsn.ini.php");
	require_once("DB.php");
	$adb = DB::connect($dsn);

	mysql_query("set session character_set_connection=utf8;");
	mysql_query("set session character_set_results=utf8;");
	mysql_query("set session character_set_client=utf8;");
	/*
	 *	HEADER() 설정 차이로 인해 기본 라이브러리를 별도로 설정
	*/

    $DRS = $adb->getRow("SELECT * FROM employment WHERE wr_id='".$_GET['idx']."'", DB_FETCHMODE_ASSOC);

	if(!file_exists("/home/dev/pub/main".$DRS['file_name2']))	go_back("파일이 존재하지 않습니다.");
	
	$dn = "1"; // 1 이면 다운 0 이면 브라우져가 인식하면 화면에 출력
	$dn_yn = ($dn) ? "attachment" : "inline";
	$bin_txt = "1";
	$bin_txt = ($bin_txt) ? "r" : "rb";
	$file="/home/dev/pub/main".$DRS['file_name2'];

	$dnfile=$DRS['s_file_name2'];

	header("Cache-control: private");
	if(preg_match("/(MSIE 5.0|MSIE 5.1|MSIE 5.5|MSIE 6.0)/", $HTTP_USER_AGENT))
	{
	  if(strstr($HTTP_USER_AGENT, "MSIE 5.5"))
	  {
	    header("Content-Type: doesn/matter");
	    Header("Content-Length: ".(string)(filesize("$file")));
	    Header("Content-Disposition: filename=$dnfile");
	    Header("Content-Transfer-Encoding: binary");
	    Header("Pragma: no-cache");
	    Header("Expires: 0");

	  }

	  if(strstr($HTTP_USER_AGENT, "MSIE 5.0"))
	  {
	    Header("Content-type: file/unknown");
	    header("Content-Disposition: attachment; filename=$dnfile");
	    Header("Content-Description: PHP3 Generated Data");
	    header("Pragma: no-cache");
	    header("Expires: 0");
	  }

	  if(strstr($HTTP_USER_AGENT, "MSIE 5.1"))
	  {
	    Header("Content-type: file/unknown");
	    header("Content-Disposition: attachment; filename=$dnfile");
	    Header("Content-Description: PHP3 Generated Data");
	    header("Pragma: no-cache");
	    header("Expires: 0");
	  }

	  if(strstr($HTTP_USER_AGENT, "MSIE 6.0"))
	  {
	    Header("Content-type: application/x-msdownload");
	    Header("Content-Length: ".(string)(filesize("$file")));   // 이부부을 넣어 주어야지 다운로드 진행 상태가 표시
	    Header("Content-Disposition: attachment; filename=$dnfile");
	    Header("Content-Transfer-Encoding: binary");
	    Header("Pragma: no-cache");
	    Header("Expires: 0");
	  }
	} else {
	  Header("Content-type: file/unknown");
	  Header("Content-Length: ".(string)(filesize("$file")));
	  Header("Content-Disposition: $dn_yn; filename=$dnfile");
	  Header("Content-Description: PHP3 Generated Data");
	  Header("Pragma: no-cache");
	  Header("Expires: 0");
	}

	if (is_file("$file")) {
	  $fp = fopen("$file", "rb");

	  if (!fpassthru($fp))
	    fclose($fp);

	} else {
	    echo"
			<script>
			alert('해당 파일이나 경로가 존재하지 않습니다');
			history.back();
			</script>
			";
		exit;
	}

?>
