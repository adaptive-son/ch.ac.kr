<?php
	@session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ko" lang="ko">
	<head>
		<META HTTP-EQUIV="Content-Type"  CONTENT="text/html; charset=utf-8">
		<META HTTP-EQUIV="Pragma" CONTENT ="no-cache">
		<META HTTP-EQUIV="Cache-control" CONTENT="no-cache">
	</head>
	<body>
<?php
	$SUCCESS_CODE = $_SESSION["SUCCESS_CODE"] == null ? "" : $_SESSION["SUCCESS_CODE"];
	$SERVICE_LOGIN_PAGE = $_SESSION["SERVICE_LOGIN_PAGE"] == null ? "" : $_SESSION["SERVICE_LOGIN_PAGE"];
	$SERVICE_LOGOUT_PAGE = $_SESSION["SERVICE_LOGOUT_PAGE"] == null ? "" : $_SESSION["SERVICE_LOGOUT_PAGE"];
	if ($SUCCESS_CODE == "1"){
        // 세션 등록

        if($_SESSION['USER_KIND']=="0") $member_group = "S";
        if($_SESSION['USER_KIND']=="2") $member_group = "F"; //교원
        if($_SESSION['USER_KIND']=="3") $member_group = "E"; //직원
        if($_SESSION['USER_KIND']=="4") $member_group = "M"; //일반회원(기업)
        if($_SESSION['USER_KIND']=="5") $member_group = "A"; //관리자

        $__ARR_SESSION = array("MEMBER_ID" => $_SESSION['ID'], "MEMBER_UNAME" => $_SESSION['NAME'], "MEMBER_GROUP" => $member_group, "S_CHECK" => "OK");
        foreach ($__ARR_SESSION as $k => $v) {
            $_SESSION[$k] = $v;
        }
?>
	<!-- 내부에 작성된 내용을 삭제하고 인증 완료 후 인증작업으로 변경하세요. -->
	<script>
		location.href="/";
	</script>
	<!-- 내부에 작성된 내용을 삭제하고 인증 완료 후 인증작업으로 변경하세요. -->
<?php
	}else if ($SUCCESS_CODE == "3"){
?>
	<h1><?php echo $_SESSION["errMsg"] == null ? "" : $_SESSION["errMsg"]; ?></h1>
<?php
	}else{
?>
	<input type="button" onclick="javascript:location.href='<?php echo $SERVICE_LOGIN_PAGE; ?>'" style="cursor:hand" value="로그인" />
<?php
		}
?>
	</body>
</html>