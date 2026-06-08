<?php 
session_start();
?>
<?php
	
	/**
	  * Web-Agent 환경 설정
	  */
	$_SESSION["AUTHORIZATION_URL"] = "http://sso.ch.ac.kr/";
	$_SESSION["AUTHORIZATION_SSL_URL"] = "https://sso.ch.ac.kr/";
	$_SESSION["SSID"] = "3";
    
    /**
	  * penta라는 context path가 존재한다면 path + "origin value"로 입력한다.
	  * ex) $path = "/penta"; 
	  * $_SESSION["SERVICE_BUSINESS_PAGE"] = $path."/sso/business.php";
	  */
    $path = ".";    

	$_SESSION["SERVICE_BUSINESS_PAGE"] = $path."/business.php";
	$_SESSION["SERVICE_LOGIN_PAGE"] = "../../login/login.php";
	$_SESSION["SERVICE_LOGOUT_PAGE"] = "logout.php";
	$_SESSION["SERVICE_ROLE_PAGE"] = $path."/agentProc.php";
	$_SESSION["REQUEST_DATA"] = "NAME,ID,USER_KIND,emptype,deptcode";

	/**
	  * Web-Agent 환경 설정
	  */

	
	$isToken = $_REQUEST["isToken"] == null ? "" : $_REQUEST['isToken'];
	$reTry = $_REQUEST["reTry"] == null ? "" : $_REQUEST['reTry'];
	$method = $_REQUEST["method"] == null ? "" : $_REQUEST['method'];
	$secureToken = $_REQUEST["secureToken"] == null ? "" : $_REQUEST['secureToken']; 
	$secureSessionId = $_REQUEST["secureSessionId"] == null ? "" : $_REQUEST['secureSessionId'];
	$a = $path + "/login/login.php";
	$SERVICE_LOGIN_PAGE = $_SESSION["SERVICE_LOGIN_PAGE"] == null ? "" : $_SESSION["SERVICE_LOGIN_PAGE"];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ko" lang="ko">
	<head>
		<META HTTP-EQUIV="Content-Type"  CONTENT="text/html; charset=euc-kr">
		<META HTTP-EQUIV="Pragma" CONTENT ="no-cache">
		<META HTTP-EQUIV="Cache-control" CONTENT="no-cache">
	</head>
<body>
<form name="sendForm" method="post">
	<input type="hidden" name="isToken" value="<?php echo $isToken; ?>" />
	<input type="hidden" name="secureToken" value="<?php echo $secureToken; ?>" />
	<input type="hidden" name="secureSessionId" value="<?php echo $secureSessionId; ?>" />
</form>
<script>
	var method = "<?php echo $method; ?>";
	var isToken = "<?php echo $isToken; ?>";
	var reTry = "<?php echo $reTry; ?>";
	var sendUrl = "<?php echo $SERVICE_LOGIN_PAGE; ?>";
	var sendForm = document.sendForm;

	if(method == "checkToken"){
		
		if(reTry == "N"){
			if(isToken == "Y"){
				sendUrl = "<?php echo $path; ?>" + "/checkauth.php";//로그인 성공
			}
		}
	}else{
		sendUrl = "<?php echo $path; ?>" + "/checkserver.php";//인증서버 정보 요청
	}
	sendForm.action = sendUrl;
	sendForm.submit();
</script>
</body>
</html>