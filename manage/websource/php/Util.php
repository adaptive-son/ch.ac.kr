<?php
error_reporting(E_ALL ^ E_NOTICE);

$supportVersion = "4.3.0";

function checkLanguageVersion($ver)
{
	//default : support is PHP4 >= 4.3.0
	if (function_exists('version_compare')){
		$cVersion = phpversion();
		if (version_compare($cVersion, $ver) >= 0 ) {
			return true;
		}else{
			return false;
		}
	}else{
		return false;
	}
}

function checkEncodeCharsetFunction()
{
	$funcname = "false";
	if (function_exists('mb_convert_encoding')){
		$funcname = "mb_convert";
	}else{
		if (function_exists('iconv')){
			$funcname = "iconv";
		}else{
			$funcname = "false";
		}
	}

	return $funcname;
}

function isImageValid($ext, $flag)
{
	if ($flag == "flash"){
		$imgExtensions = array('swf','wmv','avi','mp4','ogg','webm');
	}else if($flag == "file"){
		$imgExtensions = array('zip','doc','docx','xls','xlsx');
	}else{
		$imgExtensions = array('gif', 'jpeg', 'jpg', 'png', 'bmp');
	}

	if (in_array($ext, $imgExtensions)){
		return true;
	}else{
		return false;
	}
}

function isArray($appExtensions, $fileCheck)
{
	$app = explode(",", $appExtensions);
	$value = false;

	for($i=0; $i<count($app); $i++) {
		if($app[$i] == $fileCheck){
			$value = true;
		}
	}	
	return $value;
}

function getImageKind($flag)
{
	if ($flag == "flash"){
		return "swf, wmv, avi, mp4, ogg, webm";
	}else if($flag == "file"){
		return "zip, doc, docx, xls, xlsx";
	}else{
		return "gif, jpeg, jpg, png, bmp";
	}
}

function getImageMainDir($flag)
{
	if ($flag == "flash"){
		return "flashes";
	}else if ($flag == "movie"){
		return "movies";
	}else if ($flag == "file"){
		return "files";
	}else{
		return "images";
	}
}

function getChildDirectory($path, $maxcount)
{
	if ($maxcount == "" || is_null($maxcount)) $maxcount = 100;
	$childFlag = false;
	$childNum = 0;
	$childName = "";
	if (!is_dir($path)) return "";

	$handle = opendir($path);
	//$fname = readdir($handle);
	//echo count($fname);
	while ( false !== ($fname = readdir($handle))){
		$filename = $path.$fname;
		if (filetype($filename) == "dir" && intval($fname)){
			$childFlag = true;
			if (intval($fname) > $childNum){
				$childNum = intval($fname);
				$childName = $fname;
			}
		}
	}
	closedir($handle);

	if (!$childFlag){
		$childNum++;
		$childName = sprintf("%06d", $childNum);
		mkdir($path.$childName, 0775);
		chmod($path.$childName, 0775);
	}

	$childPath = ($path . $childName).DIRECTORY_SEPARATOR;
	$handle = opendir($childPath);

	$cCount = 0;
	while ( false !== ($fname = readdir($handle))){
		$filename = $childPath.$fname;
		if (filetype($filename) == "file"){
			$cCount++;
		}
	}
	closedir($handle);

	if ($cCount >= $maxcount){
		$childNum++;
		if ($childNum > 999999){
			$childName = $childNum;
		}else{
			$childName = sprintf("%06d", $childNum);
		}
		
		mkdir($path.$childName, 0775);
		chmod($path.$childName, 0775);
	}

	return $childName;
}

function checkFileUniqueName($bname, $ext, $path)
{
	$strFileName = $bname.".".$ext;
	$due_check = true;
	$strFileWholePath = $path.$strFileName;
	$due_Flie_Count = 0;

	while($due_check){
	  if (file_exists($strFileWholePath)){
		 $due_Flie_Count += 1;
		 $strFileName = $bname."_".$due_Flie_Count.".".$ext;
		 $strFileWholePath = $path.$strFileName;
	  }else{
		 $due_check = false;
	  }
	}

	return $strFileName;
}

function GetLogicalPath($targetPath) {

  if(substr($targetPath, 0, 1) == "/") {
    $SysPath = dirname($_SERVER['PHP_SELF']);

    if(substr($targetPath, -1) == "/") $targetPath = substr($targetPath, 0, -1);

    if(strlen($SysPath) == 1)
      return ".".$targetPath;
    elseif(strcmp($SysPath,$targetPath) == 0)
      return "./";  

    else {
      $s_tmp = explode("/", $SysPath);
      $r_tmp = explode("/", $targetPath);

      while(($r_tmp[$i] == $s_tmp[$i]) && $i < 10){
		$i++;
	  }
	  
	  $t_TempPath = explode("/", $targetPath, ($i+1));
	  if (count($t_TempPath) > $i){
		$t_RedPath = end($t_TempPath);
	  }else{
		$t_RedPath = "";
	  }

      if($i == count($s_tmp))
        return "./".$t_RedPath;
      else
        return str_repeat("../", count($s_tmp)-$i).$t_RedPath;
    }
  }
  else
    return $targetPath;

}

function getEditorAuth($filename, $conn, $conval)
{
	$result = @file_get_contents($filename);
	
	if ($result == ""){
		$result = getSocketOpen($filename);
	}

	if ($result == "valid")
		return "true";
	elseif ($result == "expire_invalid")
		return "expire";
	else
		return "false";
}

function getSocketOpen ($filename)
{
	$url = parse_url($filename);
	$host = $url['host'];
	$port = "80"; 
	$eol = "\r\n";

	$fp = @fsockopen($host, $port, $errno, $errstr, 30);
	
	if(!$fp)
	{ 
		//echo "$errstr <br>\n";
		return "false";
		//exit; 
	} 
		
	$header = "GET " . $filename . " HTTP/1.0" . $eol;
	$header .= "Host: $host:${port}" . $eol;
	$header .= "User-Agent: Web 0.1" . $eol;
	$header .= "Connection: close" . $eol;
	$header .= $eol;

	fputs($fp, $header); 
	
	while(!feof($fp)) 
	{  
		 $buffer = fgets($fp, 128);
		 if ($body == true) $output .= $buffer;
		 if ($buffer=="\r\n") $body = true; 
	}  

	fclose($fp);

	return $output;
}

function createEncodeEditorKey($genkey)
{
	 $base64_encodeText = base64_encode($genkey);

	 $str_length = strlen($base64_encodeText);
	 $strLeft = substr($base64_encodeText,0,$str_length/2);  
	 $strRight = substr($base64_encodeText,$str_length/2,$str_length);
	 
	 $strLeft_length = strlen($strLeft);
	 $strLeftSubLeft = substr($strLeft,0,$strLeft_length/2);
	 $strLeftSubRight = substr($strLeft,$strLeft_length/2,$strLeft_length);

	 $strRight_length = strlen($strRight);
	 $strRightSubLeft = substr($strRight,0,$strRight_length/2);
	 $strRightSubRight = substr($strRight,$strRight_length/2,$strRight_length);

	 $genkey = $strLeftSubLeft . $strRightSubLeft . $strRightSubRight . $strLeftSubRight;
	 
	 return $genkey;
}

function executeScript($funcname, $result, $addmsg, $useExternalServer, $userdomain, $image_editor_flag, $checkPlugin)
{
	if ($userdomain != "")
		$userdomain = "document.domain='" . $userdomain . "';";
	else
		$userdomain = "";

	if ($image_editor_flag == "flashPhoto") {
		$param = "{";
		$param .= "\"result\":\"" . $result . "\",";
		$param .= "\"imageURL\":\"\",";
		$param .= "\"addmsg\":\"" . $addmsg . "\"";
		$param .= "}";
		$returnValue = $param; 
	} else {

		if($checkPlugin == "false") {
			if ($addmsg != "") {
				$param = "{";
				$param .= "\"result\":\"" . $result . "\",";
				if (strcasecmp($result, "virus") == 0) {
					$param .= "\"addmsg\":\"" . $addmsg . "\"";
					$param .= "}";
				} else {
					$param .= "\"addmsg\":[" . $addmsg . "]";
					$param .= "}";
				}
			} else {
				$param = "{";
				$param .= "\"result\":\"" . $result . "\"";
				$param .= "}";
			}
		} else {
			if ($addmsg != "") 
				$param = "'". $result . "', '" . $addmsg . "'";
			else
				$param = "'" . $result . "'";
		}
		header('Access-Control-Allow-Origin: *');  
		if($checkPlugin == "false"){
			$returnValue = $param;
		}elseif ($useExternalServer) {
			$returnValue = "?userdomain=" . urlencode($userdomain);
			$returnValue .= "&funcname=" . urlencode($funcname);
			$returnValue .= "&param=" . urlencode($param);
			header("Location: " . $useExternalServer . $returnValue);
		} else {
			$returnValue = "<script language='javascript' type='text/javascript'>". $userdomain ."parent.window.$funcname($param);</script>";
		}
	}
	/*
	$json = new Services_JSON();
	$test = $json->decode($returnValue);
	*/
	/*
	if($test->result == "success"){
		echo $returnValue;
	}else{
		$returnValue = "{";
		$returnValue .= "\"result\":\"" . "fail_image" . "\"";
		$returnValue .= "}";
		echo $returnValue;
	}
	*/
	/*
	$resultTest = json_decode($returnValue);
	if (json_last_error() === JSON_ERROR_NONE) {
		echo $returnValue;
	}else{
		$returnValue = "{";
		$returnValue .= "\"result\":\"" . "fail_image" . "\"";
		$returnValue .= "}";
		echo $returnValue;
	}
	*/

	echo $returnValue;

	exit;
}

function fileNameTimeSetting()
{
	$pattern = "1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ";
	$rkey  = $pattern[rand(0,35)];
	$length = 7;
	for($i=0; $i<$length; $i++) {
		$rkey .= $pattern[rand(0,35)];
	}

	$dataValue = date("Ymd");
	
	$utimestamp = array_sum(explode( ' ',microtime()));
    $timestamp = floor($utimestamp); 
    $milliseconds =(string)round(($utimestamp - $timestamp) * 1000000); 
	$milliseconds = substr($milliseconds,0,3);

	$timeValue = date("His", $timestamp);
	$fileNameTime = $dataValue . $timeValue . $milliseconds . "_" . $rkey;  

	return $fileNameTime;
}
?>