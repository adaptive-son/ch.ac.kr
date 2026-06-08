<?php
	@session_start();
?>
<?php
	$AUTHORIZATION_URL = $_SESSION["AUTHORIZATION_URL"] == null ? "" : $_SESSION["AUTHORIZATION_URL"];
	$AUTHORIZATION_SSL_URL = $_SESSION["AUTHORIZATION_SSL_URL"] == null ? "" : $_SESSION["AUTHORIZATION_SSL_URL"];
	$SSID = $_SESSION["SSID"] == null ? "" : $_SESSION["SSID"];
	$checkServer = $_SESSION["checkServer"] == null ? "" : $_SESSION["checkServer"];
	$SUCCESS_CODE = $_SESSION["SUCCESS_CODE"] == null ? "" : $_SESSION["SUCCESS_CODE"];
	$errMsg = $_SESSION["errMsg"] == null ? "" : $_SESSION["errMsg"];

	if((false == ($checkServer == "Y") && false == ($checkServer == "N")) || true == ($checkServer == "N")){
		$SERVICE_BUSINESS_PAGE = $_SESSION["SERVICE_BUSINESS_PAGE"] == null ? "/index.php" : $_SESSION["SERVICE_BUSINESS_PAGE"];
		session_destroy();
		echo "<script> location.href = '".$SERVICE_BUSINESS_PAGE."'; </script>";
	}
	session_destroy();
	
	$sendUrl = $AUTHORIZATION_SSL_URL . "isignplus/logout.jsp";
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ko" lang="ko">
	<head>
		<META HTTP-EQUIV="Content-Type"  CONTENT="text/html; charset=utf-8">
		<META HTTP-EQUIV="Pragma" CONTENT ="no-cache">
		<META HTTP-EQUIV="Cache-control" CONTENT="no-cache">
	</head>
<body>
<form name="sendForm" method="post">
	<input type="hidden" name="ssid" value="<?php echo $SSID; ?>" />
	<input type="hidden" name="domain" value="" />
</form>
<script>
	var SUCCESS_CODE = "<?php echo $SUCCESS_CODE; ?>";
	if(SUCCESS_CODE == "2"){
		alert('errMsg : <?php echo $errMsg; ?>');
	}

	var sendUrl = "<?php echo $sendUrl; ?>";
	var sendForm = document.sendForm;
	sendForm.action = sendUrl;
	sendForm.submit();
</script>
</body>
</html>