<?php
	session_start();
?>
<?php
	$AUTHORIZATION_URL = $_SESSION["AUTHORIZATION_URL"] == null ? "" : $_SESSION["AUTHORIZATION_URL"];
	$AUTHORIZATION_SSL_URL = $_SESSION["AUTHORIZATION_SSL_URL"] == null ? "" : $_SESSION["AUTHORIZATION_SSL_URL"];
	$SSID = $_SESSION["SSID"] == null ? "" : $_SESSION["SSID"];
	
	if(true == ($AUTHORIZATION_URL == "")){
		echo "<script> location.href = '/index.php'; </script>";
	}
	
	$sendUrl = $AUTHORIZATION_URL . "LoginServlet" . "?method=checkLogin" . "&ssid=" . $SSID;
	
	$curl = curl_init(); // Client URL Library Functions
	$timeout = 5;
	$curl_session = curl_init();
	// 0으로 하면 시간제한이 없다. 	
	curl_setopt($curl, CURLOPT_URL, $sendUrl);  
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE); 
	curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);
	curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, $timeout);  

	$data = curl_exec($curl); 
	$err = curl_error($curl); // 에러 메시지
	$err_no = curl_errno($curl);// 0번 에러없음
	
	if( $err == null ) {
		if ($data != null){
			$cutData = explode(":", $data);
			$_SESSION["authMethod"] = $cutData[0];
			$_SESSION["USEISIGNPAGE"] = $cutData[1];
			$_SESSION["checkServer"] = "Y";
		}else{
			$_SESSION["authMethod"] = "ssl";
			$_SESSION["USEISIGNPAGE"] = "N";
			$_SESSION["checkServer"] = "Y";
		}
		$_SESSION["Exception"] = "N";
	}else{
		$_SESSION["USEISIGNPAGE"] = "N";
		$_SESSION["checkServer"] = "N";
		$_SESSION["Exception"] = "Y";
		$SERVICE_LOGIN_PAGE = $_SESSION["SERVICE_LOGIN_PAGE"] == null ? "" : $_SESSION["SERVICE_LOGIN_PAGE"];
		echo "<script> location.href = '".$SERVICE_LOGIN_PAGE."'; </script>";
	}
	curl_close($curl);
	
	$sendUrl = $AUTHORIZATION_SSL_URL . "isignplus/index.jsp";

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