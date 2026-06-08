<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<title>전산 정보자원 서비스 평가 실시</title>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-image: url(img/bg.gif);
	background-repeat: repeat-x;
}
td, input {font-size:11px; color:#464646;}
.pad5 {padding:8px;}
-->
</style>
<SCRIPT LANGUAGE="JavaScript">
<!--
function Check(obj) {
	if(obj.login_id.value == '') {
		alert("ID를 입력하세요");
		obj.login_id.focus();
		return false;
	}
	if(obj.login_pw.value == '') {
		alert("비밀번호를 입력하세요");
		obj.login_pw.focus();
		return false;
	}
}
//-->
</SCRIPT>
</head>

<body>
<table border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top"><img src="img/title.gif" width="700" height="249"></td>
  </tr>
  <tr>
    <td height="250" align="center" valign="middle"><table width='380' border='0' cellspacing='0' cellpadding='1'>
    	<form name="frm_login" onSubmit="return Check(this)" method="post" action="https://www.ch.ac.kr/login/login_proc.php">
		  <input type="hidden" name="site" value="">
		  <input type="hidden" name="mainform" value="">
		  <input type="hidden" name="Confirm" value="login">
		  <input type="hidden" name="returnURI" value="/research/2015/research.php">
        <tr>
          <td height="40" align="center" bgcolor="#ce060b" style="color:#FFFFFF; font-weight:bold;">로그인을 하셔야 설문에 참여하실 수 있습니다.</td>
        </tr>
        <tr>
          <td bgcolor="#ce060b"><table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td align="center" valign="middle" bgcolor="#FFFFFF" style="padding:10px;"><table bgcolor='#FFFFFF' border='0' cellspacing='0' cellpadding='3'>
              	<tr>
                  <td height="9" align='right'></td>
                  <td align='center'></td>
                  <td>
						<table border="0" cellspacing="0" cellpadding="0">
						<tr> 
						<td width="25"> 
						<input type="radio" name="divide" class="input_none" value="student" checked>
						</td>
						<td width="50">학생</td>
						<td width="25"> 
						<input type="radio" name="divide" value="employee" class="input_none">
						</td>
						<td width="50">교직원</td>
						</tr>
						</table>
                  </td>
                </tr>
                <tr>
                  <td height="9" align='right'><strong>학번 / 직번</strong></td>
                  <td align='center'>:</td>
                  <td><input type="text" name="login_id" style="border:1px solid #A8A8A8;height:18px;width:150px;" tabindex=1></td>
                </tr>
                <tr>
                  <td height="9" align='right'><strong>비밀번호</strong></td>
                  <td align='center'>:</td>
                  <td><input type="password" name="login_pw" style="border:1px solid #A8A8A8;height:18px;width:150px;" tabindex=2></td>
                </tr>
              </table></td>
            </tr>
          </table>          </td>
        </tr>
        <tr>
          <td align="center" style="padding-top:15px;"><input type="image" src="img/btn2.gif" width="281" height="68"></td>
        </tr>
    </form>
      </table></td>
  </tr>
</table>
</body>
</html>
