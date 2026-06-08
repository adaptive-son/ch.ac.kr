<?php
session_start();

$err = "<script> document.write(location.href);</script>";

$SERVICE_BUSINESS_PAGE = $_SESSION["SERVICE_BUSINESS_PAGE"] == null ? "/index.php" : $_SESSION["SERVICE_BUSINESS_PAGE"];

//print_R($err);exit;

if(strpos("isign_sso_login_include.php", $err)){
    echo "<script> location.href='".$SERVICE_BUSINESS_PAGE."'; </script>";
}

$AUTHORIZATION_URL = $_SESSION["AUTHORIZATION_URL"] == null ? "" : $_SESSION["AUTHORIZATION_URL"];
$AUTHORIZATION_SSL_URL = $_SESSION["AUTHORIZATION_SSL_URL"] == null ? "" : $_SESSION["AUTHORIZATION_SSL_URL"];
$SSID = $_SESSION["SSID"] == null ? "" : $_SESSION["SSID"];
$checkServer = $_SESSION["checkServer"] == null ? "" : $_SESSION["checkServer"];
$authMethod = $_SESSION["authMethod"] == null ? "" : $_SESSION["authMethod"];
$Exception = $_SESSION["Exception"] == null ? "" : $_SESSION["Exception"];
if($_SERVER['REMOTE_ADDR']=="112.217.216.250"){
	//print_R($_SESSION);exit;
}
if(false == ($checkServer == "Y") && false == ($checkServer == "N")){
    echo "<script> location.href='".$SERVICE_BUSINESS_PAGE."'; </script>";
}

if(true == ($checkServer == "Y") && true == ($authMethod == "idpw")){
    ?>
    <script language=javascript src="/sso/JniIssacWebJs.js"></script>
    <!-- JRE 버전 체크 : 1.6.0_x 버전 보다 작으면 JRE를 설치페이지로 이동 -->
    <script src="http://www.java.com/js/deployJava.js"></script>
    <script >
        if( !deployJava.versionCheck('1.6.0_0+') )
        {
            if (confirm('JRE를 설치합니다.\n설치를 취소 할 경우 정상동작 되지 않을 수 있습니다.')==true)
                deployJava.installLatestJRE();
            else
                alert("JRE가 설치되지 않았거나 최신버전이 아닙니다. \n페이지가 정상동작 되지 않을 수 있습니다.")
        }
    </script>
    <?php
}else{
		if($Exception=="Y" && $_SESSION['S_CHECK']=="OK"){
			echo "<script>location.href='/login/sso/business.php'</script>";
		}else if(true == ($Exception == "Y")){
			echo "<h1> 네트워크에 문제가 있습니다. 확인해주세요. </h1>";
			exit();
		}
/*
    if(true == ($Exception == "Y")){
        echo "<h1> 네트워크에 문제가 있습니다. 확인해주세요. </h1>";
        exit();
    }
	*/
}
?>
<script>
	// 쿠키 생성
    function setCookie(cName, cValue, cDay){
        var expire = new Date();
        expire.setDate(expire.getDate() + cDay);
        cookies = cName + '=' + escape(cValue) + '; path=/ '; // 한글 깨짐을 막기위해 escape(cValue)를 합니다.
        if(typeof cDay != 'undefined') cookies += ';expires=' + expire.toGMTString() + ';';
        document.cookie = cookies;
    }
 
    // 쿠키 가져오기
    function getCookie(cName) {
        cName = cName + '=';
        var cookieData = document.cookie;
        var start = cookieData.indexOf(cName);
        var cValue = '';
        if(start != -1){
            start += cName.length;
            var end = cookieData.indexOf(';', start);
            if(end == -1)end = cookieData.length;
            cValue = cookieData.substring(start, end);
        }
        return unescape(cValue);
    }


    function authServer(){

        var pageform = /*현재사용중인 form name으로 셋팅*/document.loginForm;
        if(pageform.id.value == ""){
            alert("아이디를 입력해주세요.");
            pageform.id.focus();
            return ;
        }

		//쿠키 확인
		var logined_id = getCookie('ch_login');

		if(logined_id){
			var user_id_array = logined_id.split("||");
			var login_count = Number(user_id_array[1])+1
			var ch_login_id = pageform.id.value+"||"+login_count;
		}else{
			var ch_login_id = pageform.id.value+"||1";
		}

		setCookie('ch_login',ch_login_id,1);

        if(pageform.pw.value == ""){
            alert("비밀번호를 입력해주세요.");
            pageform.pw.focus();
            return ;
        }

        var authMethod = "<?php echo $authMethod; ?>";
        if(authMethod == "idpw"){
            pageform.action = "<?php echo $AUTHORIZATION_URL; ?>LoginServlet?method=idpwProcess&ssid=<?php echo $SSID; ?>";
            encryptForm_utf8(pageform);
        }else if(authMethod == "ssl"){
            pageform.action = "<?php echo $AUTHORIZATION_SSL_URL; ?>LoginServlet?method=idpwProcessEx&ssid=<?php echo $SSID; ?>";
            pageform.submit();
        }else{
            alert("서버의 인증방식이 잘못 설정되었습니다. 관리자에게 문의하세요.");
            history.back();
        }
    }
</script>