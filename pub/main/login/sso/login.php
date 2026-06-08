<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ko" lang="ko">
	<head>
		<META HTTP-EQUIV="Content-Type"  CONTENT="text/html; charset=utf-8">
		<META HTTP-EQUIV="Pragma" CONTENT ="no-cache">
		<META HTTP-EQUIV="Cache-control" CONTENT="no-cache">
		<title>test</title>
		
		<!-- Web-Agent의 로그인페이지에 include 한다. -->
		<?php include "../sso/isign_sso_login_include.php" ?>
		<!-- Web-Agent의 로그인페이지에 include 한다. -->

	</head>
	<body>
	<form name="submitForm" method="post" action="">
		<!-- ISSAC-Web 구간 암호화를 적용하기 위하여 hidden을 추가하여야 한다. -->
		<input type="hidden" name="issacweb_data" value="">
		<!-- ISSAC-Web 구간 암호화를 적용하기 위하여 hidden을 추가하여야 한다. -->

		<!-- 아이디, 비밀번호의 파라미터 변수명은 id, pw로 변경한다. -->
		아이디 : <input type="text" name="id">
		비밀번호 : <input type="password" name="pw">
		<!-- 아이디, 비밀번호의 파라미터 변수명은 id, pw로 변경한다. -->

		<!-- 로그인 버튼을 onclick="javascript:authServer()"로 수정한다. -->
		<input type="button" OnClick="javascript:authServer();" value="전송" style="cursor:hand">
		<!-- 로그인 버튼을 onclick="javascript:authServer()"로 수정한다. -->
	</form>
	</body>
</html>
