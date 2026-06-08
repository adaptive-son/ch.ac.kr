<?
include $_SERVER["DOCUMENT_ROOT"]."/config/session.php";

include_once("./research_date.php");

if($date >= $date_start and $date < $date_end){

if($_SESSION['MEMBER_UID'] != ""){
	//echo $_SESSION['MEMBER_UID'];
	
	$sql = " select * from way_survey2015 where mb_id = '".$_SESSION['MEMBER_UID']."' ";
	$result = @mysql_fetch_array(mysql_query($sql));
	if($result[mb_id]){echo "<script>alert('이미 만족도 조사를 완료하셨습니다.');history.back();</script>";}
?>
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
th{
	font-size:12px;
	height:30px;
	background:"#ececec";
	text-align:left;
	padding-left:10px;
}
td {
	font-size:13px; color:#464646;
}
table.t1 td{
	padding:10px;
}
.pad5 {padding:8px;}
.style1 {padding: 8px; font-weight: bold; }
-->
</style></head>

<body>
<table border="0" cellspacing="0" cellpadding="0">
<form name="fre" onsubmit="return check_form(fre)" method="post" >	
  <tr>
    <td valign="top"><img src="img/title.gif" width="700" height="249"></td>
  </tr>
  <tr>
    <td align="center"><table width="650" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="1" bgcolor="2e5e90"></td>
          </tr>
        </table>
					<h3>1. 조사 대상자 일반적 특성(1번 ~ 4번 문항)</h3>
          <table class="t1" width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#d8d8d8" style="border-collapse:collapse;">
            <colgroup>
							<col style="width: 20%" />
							<col style="width: 80%" />
						</colgroup>
						<tr>
							<th>[문1] 평소에 자주 사용하시는 정보시스템을 선택하여 주시기 바랍니다.(다중선택 가능)</th>
						</tr>
						<tr>
							<td>
								<input type="checkbox" name="q_1[]" value="1" /> ① 학사행정시스템(hs.ch.ac.kr)<br />
								<input type="checkbox" name="q_1[]" value="2" /> ② 학생이력관리시스템(job.ch.ac.kr)<br />
								<input type="checkbox" name="q_1[]" value="3" /> ③ 학교 홈페이지(www.ch.ac.kr)<br />
								<input type="checkbox" name="q_1[]" value="4" /> ④ 학과 홈페이지(학과명.ch.ac.kr)<br />
								<input type="checkbox" name="q_1[]" value="5" /> ⑤ e클래스(lms.ch.ac.kr)<br />
								<input type="checkbox" name="q_1[]" value="6" /> ⑥ 도서관(lib.ch.ac.kr)<br />
								<input type="checkbox" name="q_1[]" value="7" /> ⑦ 평생교육원(edu.ch.ac.kr)<br />
								<input type="checkbox" name="q_1[]" value="8" /> ⑧ 입시 홈페이지(ipsiw.ch.ac.kr)<br />
								<input type="checkbox" name="q_1[]" value="9" /> ⑨ 웹메일(mail.ch.ac.kr)
							</td>
						</tr>
						<tr>
							<th>[문2]  정보시스템을 얼마나 자주 사용하십니까?</th>
						</tr>
						<tr>
							<td>
							<input type="radio" name="q_2" value="1" /> ① 매일<br />
							<input type="radio" name="q_2" value="2" /> ② 주 1~3회<br />
							<input type="radio" name="q_2" value="3" /> ③ 월 1~3회<br />
							<input type="radio" name="q_2" value="4" /> ④ 한학기 1~3회<br />
							<input type="radio" name="q_2" value="5" /> ⑤ 연 1~3회
							</td>
						</tr>
						<tr>
							<th>[문3]  정보시스템을 사용한 기간은 얼마입니까?</th>
						</tr>
						<tr>
							<td>
							<input type="radio" name="q_3" value="1" /> ① 1 개월 미만<br />
							<input type="radio" name="q_3" value="2" /> ② 6 개월 미만<br />
							<input type="radio" name="q_3" value="3" /> ③ 1년 미만<br />
							<input type="radio" name="q_3" value="4" /> ④ 1~3년<br />
							<input type="radio" name="q_3" value="5" /> ⑤ 3년 이상
							</td>
						</tr>
						<tr>
							<th>[문4]  현재 재학(재직) 중인 상태의 신분은 어떤 것입니까?</th>
						</tr>
						<tr>
							<td>
							<input type="radio" name="q_4" value="1" /> ① 학생<br />
							<input type="radio" name="q_4" value="2" /> ② 외래교수<br />
							<input type="radio" name="q_4" value="3" /> ③ 겸임교수<br />
							<input type="radio" name="q_4" value="4" /> ④ 전임교수<br />
							<input type="radio" name="q_4" value="5" /> ⑤ 직원<br />
							<input type="radio" name="q_4" value="6" /> ⑥ 조교
							</td>
						</tr>
          </table>
					<h3>2. 시스템 품질(5번 ~ 11번 문항)</h3>
          <table class="t1" width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#d8d8d8" style="border-collapse:collapse;">
            <colgroup>
							<col style="width: 20%" />
							<col style="width: 80%" />
						</colgroup>
						<tr>
							<th>[문5] 정보시스템은 사용 중 오류나 시스템 다운과 같은 시스템 장애 없이 만족스럽게 운영되고 있습니까?</th>
						</tr>
						<tr>
							<td>
								<input type="radio" name="q_5" value="1" /> ① 매우 만족<br />
								<input type="radio" name="q_5" value="2" /> ② 대체로 만족<br />
								<input type="radio" name="q_5" value="3" /> ③ 보통<br />
								<input type="radio" name="q_5" value="4" /> ④ 불만족<br />
								<input type="radio" name="q_5" value="5" /> ⑤ 매우 불만족
							</td>
						</tr>
						<tr>
							<th>[문6]  정보시스템의 처리속도는 만족스러운 편입니까? (시스템 반응 속도)</th>
						</tr>
						<tr>
							<td>
								<input type="radio" name="q_6" value="1" /> ① 매우 만족<br />
								<input type="radio" name="q_6" value="2" /> ② 대체로 만족<br />
								<input type="radio" name="q_6" value="3" /> ③ 보통<br />
								<input type="radio" name="q_6" value="4" /> ④ 불만족<br />
								<input type="radio" name="q_6" value="5" /> ⑤ 매우 불만족
							</td>
						</tr>
						<tr>
							<th>[문7]  정보시스템을 사용하기 위한 로그인 및 접속 절차는 만족스러운 편입니까?</th>
						</tr>
						<tr>
							<td>
								<input type="radio" name="q_7" value="1" /> ① 매우 만족<br />
								<input type="radio" name="q_7" value="2" /> ② 대체로 만족<br />
								<input type="radio" name="q_7" value="3" /> ③ 보통<br />
								<input type="radio" name="q_7" value="4" /> ④ 불만족<br />
								<input type="radio" name="q_7" value="5" /> ⑤ 매우 불만족
							</td>
						</tr>
						<tr>
							<th>[문8]  정보시스템을 사용하는 메뉴 구성 및 화면 구성은 만족스러운 편입니까?</th>
						</tr>
						<tr>
							<td>
								<input type="radio" name="q_8" value="1" /> ① 매우 만족<br />
								<input type="radio" name="q_8" value="2" /> ② 대체로 만족<br />
								<input type="radio" name="q_8" value="3" /> ③ 보통<br />
								<input type="radio" name="q_8" value="4" /> ④ 불만족<br />
								<input type="radio" name="q_8" value="5" /> ⑤ 매우 불만족
							</td>
						</tr>
						<tr>
							<th>[문9]  정보시스템을 통해 제공되는 정보는 학습 및 업무에 필요한 시기에 적절히 제공되는 편입니까?</th>
						</tr>
						<tr>
							<td>
								<input type="radio" name="q_9" value="1" /> ① 매우 만족<br />
								<input type="radio" name="q_9" value="2" /> ② 대체로 만족<br />
								<input type="radio" name="q_9" value="3" /> ③ 보통<br />
								<input type="radio" name="q_9" value="4" /> ④ 불만족<br />
								<input type="radio" name="q_9" value="5" /> ⑤ 매우 불만족
							</td>
						</tr>
						<tr>
							<td style="font-weight:bold;text-align:center">(10번과 11번 문항은 교직원만 응답하시오.)</td>
						</tr>
						<tr>
							<th>[문10]  정보시스템을 사용하여 보고서 작업과 연계하여 사용하기에 용이한 편입니까?</th>
						</tr>
						<tr>
							<td>
								<input type="radio" name="q_10" value="1" /> ① 매우 만족<br />
								<input type="radio" name="q_10" value="2" /> ② 대체로 만족<br />
								<input type="radio" name="q_10" value="3" /> ③ 보통<br />
								<input type="radio" name="q_10" value="4" /> ④ 불만족<br />
								<input type="radio" name="q_10" value="5" /> ⑤ 매우 불만족
							</td>
						</tr>
						<tr>
							<th>[문11]  정보시스템을 사용하여 통계 및 엑셀 등 작업과 연계하여 사용하기에 용이한 편입니까?</th>
						</tr>
						<tr>
							<td>
								<input type="radio" name="q_11" value="1" /> ① 매우 만족<br />
								<input type="radio" name="q_11" value="2" /> ② 대체로 만족<br />
								<input type="radio" name="q_11" value="3" /> ③ 보통<br />
								<input type="radio" name="q_11" value="4" /> ④ 불만족<br />
								<input type="radio" name="q_11" value="5" /> ⑤ 매우 불만족
							</td>
						</tr>
          </table>
					<h3>3. 컴퓨터 실습용 PC(12번 ~ 15번 문항)</h3>
          <table class="t1" width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#d8d8d8" style="border-collapse:collapse;">
            <colgroup>
							<col style="width: 20%" />
							<col style="width: 80%" />
						</colgroup>
						<tr>
							<th>[문12] 컴퓨터 실습실의 PC 대수가 실습에 충분하게 설치되어 있다.</th>
						</tr>
						<tr>
							<td>
								<input type="radio" name="q_12" value="1" /> ① 매우 만족<br />
								<input type="radio" name="q_12" value="2" /> ② 대체로 만족<br />
								<input type="radio" name="q_12" value="3" /> ③ 보통<br />
								<input type="radio" name="q_12" value="4" /> ④ 불만족<br />
								<input type="radio" name="q_12" value="5" /> ⑤ 매우 불만족
							</td>
						</tr>
						<tr>
							<th>[문13] 컴퓨터 실습실의 PC는 실습에 충분한 성능을 제공하고 있다.</th>
						</tr>
						<tr>
							<td>
								<input type="radio" name="q_13" value="1" /> ① 매우 만족<br />
								<input type="radio" name="q_13" value="2" /> ② 대체로 만족<br />
								<input type="radio" name="q_13" value="3" /> ③ 보통<br />
								<input type="radio" name="q_13" value="4" /> ④ 불만족<br />
								<input type="radio" name="q_13" value="5" /> ⑤ 매우 불만족
							</td>
						</tr>
						<tr>
							<th>[문14] PC 실습에 충분한 성능을 제공하지 않고 있다면 무엇인지 자유롭게 기술하여 주시기 바랍니다.</th>
						</tr>
						<tr>
							<td>
								<textarea name="q_14" style="width:100%; height:150px; padding:10px;" wrap="hard">PC 실습실 위치 : 
내용 : </textarea>
							</td>
						</tr>
						<tr>
							<th>[문15] 컴퓨터 실습실의 PC 관리상태가 양호하다.</th>
						</tr>
						<tr>
							<td>
								<input type="radio" name="q_15" value="1" /> ① 매우 만족<br />
								<input type="radio" name="q_15" value="2" /> ② 대체로 만족<br />
								<input type="radio" name="q_15" value="3" /> ③ 보통<br />
								<input type="radio" name="q_15" value="4" /> ④ 불만족<br />
								<input type="radio" name="q_15" value="5" /> ⑤ 매우 불만족
							</td>
						</tr>


          </table>
					<h3>4. 유지보수 서비스 품질 <span style="font-size:13px">(16번에서 18번 문항은 교직원만 응답하십시오.)</span></h3>
          <table class="t1" width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#d8d8d8" style="border-collapse:collapse;">
            <colgroup>
							<col style="width: 20%" />
							<col style="width: 80%" />
						</colgroup>
						<tr>
							<th>[문16] 문제발생시 해당 업무 담당자는 문제사항을 제대로 파악하는 편입니까?</th>
						</tr>
						<tr>
							<td>
								<input type="radio" name="q_16" value="1" /> ① 매우 만족<br />
								<input type="radio" name="q_16" value="2" /> ② 대체로 만족<br />
								<input type="radio" name="q_16" value="3" /> ③ 보통<br />
								<input type="radio" name="q_16" value="4" /> ④ 불만족<br />
								<input type="radio" name="q_16" value="5" /> ⑤ 매우 불만족
							</td>
						</tr>
						<tr>
							<th>[문17] 발생한 문제에 대해서 업무 담당자는 원하는 시간 및 방식으로 피드백(반응)을 해주는 편입니까?</th>
						</tr>
						<tr>
							<td>
								<input type="radio" name="q_17" value="1" /> ① 매우 만족<br />
								<input type="radio" name="q_17" value="2" /> ② 대체로 만족<br />
								<input type="radio" name="q_17" value="3" /> ③ 보통<br />
								<input type="radio" name="q_17" value="4" /> ④ 불만족<br />
								<input type="radio" name="q_17" value="5" /> ⑤ 매우 불만족
							</td>
						</tr>
						<tr>
							<th>[문18] 정보시스템 개선작업에 대해서 사용자와 의사소통이 원활한 편입니까?</th>
						</tr>
						<tr>
							<td>
								<input type="radio" name="q_18" value="1" /> ① 매우 만족<br />
								<input type="radio" name="q_18" value="2" /> ② 대체로 만족<br />
								<input type="radio" name="q_18" value="3" /> ③ 보통<br />
								<input type="radio" name="q_18" value="4" /> ④ 불만족<br />
								<input type="radio" name="q_18" value="5" /> ⑤ 매우 불만족
							</td>
						</tr>
          </table>
					<h3>5. 네트워크(인터넷) 서비스(19번 ~ 21번 문항)<!--span style="font-size:13px;"> (현재속도 : 150M, 내년이후 : 300M 예정)</span--></h3>
          <table class="t1" width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#d8d8d8" style="border-collapse:collapse;">
            <colgroup>
							<col style="width: 20%" />
							<col style="width: 80%" />
						</colgroup>
						<tr>
							<th>[문19] 네트워크(인터넷) 서비스 속도가 사용하기에 충분합니까?</th>
						</tr>
						<tr>
							<td>
								<input type="radio" name="q_19" value="1" /> ① 매우 만족<br />
								<input type="radio" name="q_19" value="2" /> ② 대체로 만족<br />
								<input type="radio" name="q_19" value="3" /> ③ 보통<br />
								<input type="radio" name="q_19" value="4" /> ④ 불만족<br />
								<input type="radio" name="q_19" value="5" /> ⑤ 매우 불만족
							</td>
						</tr>
						<tr>
							<th>[문20] 네트워크(인터넷) 서비스는 장애 없이 안정적으로 제공되고 있습니까?</th>
						</tr>
						<tr>
							<td>
								<input type="radio" name="q_20" value="1" /> ① 매우 만족<br />
								<input type="radio" name="q_20" value="2" /> ② 대체로 만족<br />
								<input type="radio" name="q_20" value="3" /> ③ 보통<br />
								<input type="radio" name="q_20" value="4" /> ④ 불만족<br />
								<input type="radio" name="q_20" value="5" /> ⑤ 매우 불만족
							</td>
						</tr>
						<tr>
							<th>[문21] 교내에서 무선인터넷 접속 시 이용 방법을 선택하여 주십시오.</th>
						</tr>
						<tr>
							<td>
								<input type="checkbox" name="q_21[]" value="1" /> ① 스마트폰<br />
								<input type="checkbox" name="q_21[]" value="2" /> ② 태블릿<br />
								<input type="checkbox" name="q_21[]" value="3" /> ③ 노트북PC(UMPC&middot;태블릿PC등 포함)<br />
								<input type="checkbox" name="q_21[]" value="4" /> ④ PMP(휴대용 멀티미디어 플레이어)<br />
								<input type="checkbox" name="q_21[]" value="5" /> ⑤ 기타
							</td>
						</tr>
						<tr>
							<th>[문22]  기타 정보시스템의 개선 사항 및 불만 사항 등에 대해서 자유롭게 기술해 주시기 바랍니다.</th>
						</tr>
						<tr>
							<td><textarea name="q_22" style="width:100%; height:150px; padding:10px;"></textarea></td>
						</td>
          </table>
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="1" bgcolor="2e5e90"></td>
            </tr>
          </table></td>
      </tr>
    </table>    </td>
  </tr>
  <tr>
    <td height="20" align="center"></td>
  </tr>
  <tr>
    <td align="center"><input type="image" src="img/btn.gif" width="281" height="68"></td>
  </tr>
</form>
</table>

<script text="text/javascript">
function check_form(f){
	
	<?if($result[mb_id] != ""){?>
		alert("이미 설문조사를 완료하셨습니다.");
		return false; 
	<?}?>
	var obj=document.getElementsByName("q_1[]");
	count=0
	for (i=0;i<obj.length ;i++ ){ 
		if(obj[i].checked==true)
		{
			count++
			//lang=f.q_1[i].value
		}
	}
	if(count==0){  
		alert("1평가문항을 선택하세요");
		return false; 
	}
	
	count=0
	for (i=0;i<f.q_2.length ;i++ ){ 
		if(f.q_2[i].checked==true)
		{
			count++
			lang=f.q_2[i].value
		}
	}
	if(count==0){  
		alert("2평가문항의 점수를 선택하세요");
		return false; 
	}
	
	count=0
	for (i=0;i<f.q_3.length ;i++ ){ 
		if(f.q_3[i].checked==true)
		{
			count++
			lang=f.q_3[i].value
		}
	}
	if(count==0){  
		alert("3평가문항의 점수를 선택하세요");
		return false; 
	}
	
	count=0
	for (i=0;i<f.q_4.length ;i++ ){ 
		if(f.q_4[i].checked==true)
		{
			count++
			lang=f.q_4[i].value
		}
	}
	if(count==0){  
		alert("4평가문항의 점수를 선택하세요");
		return false; 
	}
	
	count=0
	for (i=0;i<f.q_5.length ;i++ ){ 
		if(f.q_5[i].checked==true)
		{
			count++
			lang=f.q_5[i].value
		}
	}
	if(count==0){  
		alert("5평가문항의 점수를 선택하세요");
		return false; 
	}
	
	count=0
	for (i=0;i<f.q_6.length ;i++ ){ 
		if(f.q_6[i].checked==true)
		{
			count++
			lang=f.q_6[i].value
		}
	}
	if(count==0){  
		alert("6평가문항의 점수를 선택하세요");
		return false; 
	}
	
	count=0
	for (i=0;i<f.q_7.length ;i++ ){ 
		if(f.q_7[i].checked==true)
		{
			count++
			lang=f.q_7[i].value
		}
	}
	if(count==0){  
		alert("7평가문항의 점수를 선택하세요");
		return false; 
	}
	
	count=0
	for (i=0;i<f.q_8.length ;i++ ){ 
		if(f.q_8[i].checked==true)
		{
			count++
			lang=f.q_8[i].value
		}
	}
	if(count==0){  
		alert("8평가문항의 점수를 선택하세요");
		return false; 
	}

	count=0
	for (i=0;i<f.q_9.length ;i++ ){ 
		if(f.q_9[i].checked==true)
		{
			count++
			lang=f.q_9[i].value
		}
	}
	if(count==0){  
		alert("9평가문항의 점수를 선택하세요");
		return false; 
	}

	if(f.q_4[1].checked==true || f.q_4[2].checked==true || f.q_4[3].checked==true || f.q_4[4].checked==true){
	
	count=0
	for (i=0;i<f.q_10.length ;i++ ){ 
		if(f.q_10[i].checked==true)
		{
			count++
			lang=f.q_10[i].value
		}
	}
	if(count==0){  
		alert("10평가문항의 점수를 선택하세요");
		return false; 
	}

	count=0
	for (i=0;i<f.q_11.length ;i++ ){ 
		if(f.q_11[i].checked==true)
		{
			count++
			lang=f.q_11[i].value
		}
	}
	if(count==0){  
		alert("11평가문항의 점수를 선택하세요");
		return false; 
	}
}
	
	count=0
	for (i=0;i<f.q_12.length ;i++ ){ 
		if(f.q_12[i].checked==true)
		{
			count++
			lang=f.q_12[i].value
		}
	}
	if(count==0){  
		alert("12평가문항의 점수를 선택하세요");
		return false; 
	}
	count=0
	for (i=0;i<f.q_13.length ;i++ ){ 
		if(f.q_13[i].checked==true)
		{
			count++
			lang=f.q_13[i].value
		}
	}
	if(count==0){  
		alert("13평가문항의 점수를 선택하세요");
		return false; 
	}

	/*
		count=0
	for (i=0;i<f.q_14.length ;i++ ){ 
		if(f.q_14[i].checked==true)
		{
			count++
			lang=f.q_14[i].value
		}
	}
	if(count==0){  
		alert("14평가문항의 점수를 선택하세요");
		return false; 
	}
	*/

	count=0
	for (i=0;i<f.q_15.length ;i++ ){ 
		if(f.q_15[i].checked==true)
		{
			count++
			lang=f.q_15[i].value
		}
	}
	if(count==0){  
		alert("15평가문항의 점수를 선택하세요");
		return false; 
	}	

	if(f.q_4[1].checked==true || f.q_4[2].checked==true || f.q_4[3].checked==true || f.q_4[4].checked==true){
	
	count=0
	for (i=0;i<f.q_16.length ;i++ ){ 
		if(f.q_16[i].checked==true)
		{
			count++
			lang=f.q_16[i].value
		}
	}
	if(count==0){  
		alert("16평가문항의 점수를 선택하세요");
		return false; 
	}

	count=0
	for (i=0;i<f.q_17.length ;i++ ){ 
		if(f.q_17[i].checked==true)
		{
			count++
			lang=f.q_17[i].value
		}
	}
	if(count==0){  
		alert("17평가문항의 점수를 선택하세요");
		return false; 
	}

	count=0
	for (i=0;i<f.q_18.length ;i++ ){ 
		if(f.q_18[i].checked==true)
		{
			count++
			lang=f.q_18[i].value
		}
	}
	if(count==0){  
		alert("18평가문항의 점수를 선택하세요");
		return false; 
	}
}
	
	count=0
	for (i=0;i<f.q_19.length ;i++ ){ 
		if(f.q_19[i].checked==true)
		{
			count++
			lang=f.q_19[i].value
		}
	}
	if(count==0){  
		alert("19평가문항의 점수를 선택하세요");
		return false; 
	}

	count=0
	for (i=0;i<f.q_20.length ;i++ ){ 
		if(f.q_20[i].checked==true)
		{
			count++
			lang=f.q_20[i].value
		}
	}
	if(count==0){  
		alert("20평가문항의 점수를 선택하세요");
		return false; 
	}
	
	var obj=document.getElementsByName("q_21[]");
	count=0
	for (i=0;i<obj.length ;i++ ){ 
		if(obj[i].checked==true)
		{
			count++
			//lang=f.q_1[i].value
		}
	}
	if(count==0){  
		alert("21평가문항을 선택하세요");
		return false; 
	}
	f.action="./research_update.php";
}
</script>
	
</body>
</html>
<? 
}else{ 
?>
<script>
alert("로그인후이용해주세요.");
parent.location.href="/06_members/login.php";
location.href="research_login.php";
//window.close();
</script>
<?
	exit;
} 

}else{
?>
<script>
alert("설문조사 기간이 아닙니다.");
window.close();
history.back();
</script>
<?
	exit;
}
?>

