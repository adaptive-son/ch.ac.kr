<?php
	@session_start();
?>
<?php
	$isToken = $_REQUEST["isToken"];
	$SERVICE_BUSINESS_PAGE = $_SESSION["SERVICE_BUSINESS_PAGE"] == null ? "/index.php" : $_SESSION["SERVICE_BUSINESS_PAGE"];
	if($isToken == null) echo "<script> location.href = '".$SERVICE_BUSINESS_PAGE."'; </script>";
	
	$secureToken = $_REQUEST["secureToken"] == null ? "" : $_REQUEST['secureToken']; 
	$secureSessionId = $_REQUEST["secureSessionId"] == null ? "" : $_REQUEST['secureSessionId'];
	
	$AUTHORIZATION_URL = $_SESSION["AUTHORIZATION_URL"] == null ? "" : $_SESSION["AUTHORIZATION_URL"];
	$AUTHORIZATION_SSL_URL = $_SESSION["AUTHORIZATION_SSL_URL"] == null ? "" : $_SESSION["AUTHORIZATION_SSL_URL"];
	$SSID = $_SESSION["SSID"] == null ? "" : $_SESSION["SSID"];
	$REQUEST_DATA = $_SESSION["REQUEST_DATA"] == null ? "" : $_SESSION["REQUEST_DATA"];

	$sendUrl = "";
	$newToken = "";
	
	
	$timeout = 5; 
	// 0으로 하면 시간제한이 없다. 
	$sendUrl = $AUTHORIZATION_URL . "authorization";
	$param = "secureSessionId=" . $secureSessionId . "&secureToken=" . urlencode($secureToken) .
			"&REQUEST_DATA=" . $REQUEST_DATA . "&clientIP=" . $_SERVER["REMOTE_ADDR"] . "&ssid=" . $SSID;

	$curl = curl_init(); 
	curl_setopt($curl, CURLOPT_URL, $sendUrl); 
	curl_setopt($curl, CURLOPT_POST, true);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $param);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
	curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);
	curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, $timeout);  
	$data = curl_exec($curl);
	$err = curl_error($curl); // 에러 메시지 
	$errno = curl_errno($curl);// 0번 에러없음
	curl_close($curl);

	if($err == null){
		$nameValuePairs = explode("&", $data);
		for ($i = 0;  $i < count($nameValuePairs) ; $i++){
			$nameValuePair = explode("=", $nameValuePairs[$i]);
			
			if(strcmp($nameValuePair[0], "secureToken") == 0){
				$newToken = $nameValuePair[1];
			}else{
				$_SESSION[$nameValuePair[0]] = $nameValuePair[1];
			}
		}
		
		$SUCCESS_CODE = $_SESSION["SUCCESS_CODE"] == null ? "" : $_SESSION["SUCCESS_CODE"];

		if($SUCCESS_CODE == "1"){
			$stimeOut = $_SESSION["timeOut"] == null ? "5" : $_SESSION["timeOut"];

			ini_set("session.cache_expire", ($stimeOut * 60) ); 
			ini_set("session.gc_maxlifetime", ($stimeOut * 60) );  // 세션 만료시간을 한시간으로 설정
			
			$sendUrl = $AUTHORIZATION_URL . "LoginServlet";
		}else{
			if($SUCCESS_CODE == "3"){
				$SERVICE_ROLE_PAGE = $_SESSION["SERVICE_ROLE_PAGE"] == null ? "" : $_SESSION["SERVICE_ROLE_PAGE"];
				echo "<script> location.href = '".$SERVICE_ROLE_PAGE."'; </script>";
			}else{
				$SERVICE_LOGOUT_PAGE = $_SESSION["SERVICE_LOGOUT_PAGE"] == null ? "" : $_SESSION["SERVICE_LOGOUT_PAGE"];
				echo "<script> location.href = '".$SERVICE_LOGOUT_PAGE."'; </script>";
			}
		}
	}else{
		$_SESSION["USEISIGNPAGE"] = "N";
		$_SESSION["checkServer"] = "N";
		$_SESSION["Exception"] = "Y";
		$SERVICE_LOGIN_PAGE = $_SESSION["SERVICE_LOGIN_PAGE"] == null ? "" : $_SESSION["SERVICE_LOGIN_PAGE"];
		echo "<script> location.href = '".$SERVICE_LOGIN_PAGE."'; </script>";
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ko" lang="ko">
	<head>
		<META HTTP-EQUIV="Content-Type"  CONTENT="text/html; charset=utf-8">
		<META HTTP-EQUIV="Pragma" CONTENT ="no-cache">
		<META HTTP-EQUIV="Cache-control" CONTENT="no-cache">
	</head>
<body>
<form name="sendForm" method="post">
	<input type="hidden" name="secureToken" value="<?php echo $newToken; ?>" />
	<input type="hidden" name="secureSessionId" value="<?php echo $secureSessionId; ?>" />
	<input type="hidden" name="method" value="updateSecureToken" />
	<input type="hidden" name="ssid" value="<?php echo $SSID; ?>" />
</form>

<script>
	var sendUrl = "<?php echo $sendUrl; ?>";
	var sendForm = document.sendForm;
	sendForm.action = sendUrl;
	sendForm.submit();
</script>
</body>
</html>