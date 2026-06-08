<?php
	include_once("../_common.php"); 
	$DBTable = "teamjang_meeting";
	
	$idx = $_GET['idx'];
	
	$m_writer = $_SESSION['ID'];
	if($idx){
		$sql = "SELECT * FROM ".$DBTable." WHERE idx='".$idx."'";
		$result = DBquery($sql);
		$row = mysql_fetch_array($result);
		$m_writer = $row['m_writer'];
	}else{
		$row['m_place'] = "도생관 2층 대회의실";
		$row['m_record'] = "교무처 강정임";
		$row['m_memo'] = "부서별·학과별 알림사항 전달";
		$row['m_member'] = "최병철, 정영순, 권정옥, 최영진, 남현욱, 한현용, 박인경, 김정주, 이두호, 임선영, 배영실, 서화정, 김창희, 김정술, 황연순, 김선일, 한희정, 황세현, 하미숙, 김봉환, 김창환, 오은정, 이연향, 김연래, 정은숙, 김요나, 서수민, 이혜진, 김형수, 김정이, 문주희, 노은미, 박윤희, 김미숙, 한선희, 윤영우, 남건우, 신상인, 송주연, 곽미자, 김철호, 이경훈, 박금녀, 김옥주";
	}
	$writeNM = "등록";
	if($idx){
		$writeNM = "수정";
	}
?>
<link rel="stylesheet" type="text/css" href="../js/jquery-ui.css" />
<script type="text/javascript" src="../js/jquery.js" ></script>
<script type="text/javascript" src="../js/jquery-ui.min.js" ></script>
<script type="text/javascript">
	<!--
	$(function(){
		$("#start_date,#end_date").datepicker({
			dateFormat: 'yy-mm-dd'
		});
	});

	function check_form(f){
		if(f.m_idx.value==""){alert("차수를 입력하세요."); f.m_idx.focus(); return false;}
		if(f.m_date.value==""){alert("일시를 입력하세요."); f.m_date.focus(); return false;}
		if(f.m_place.value==""){alert("장소를 입력하세요."); f.m_place.focus(); return false;}
	}
	//-->
</script>
<div align="left">
<font color="#616161"><h4>학과장회의 생성</h4></font>
<form name="frm" method="POST" action="./proc.php" onsubmit="return check_form(this)" />
<input type="hidden" name="idx" value="<?=$idx?>" />
<input type="hidden" name="m_writer" value="<?php echo $m_writer?>" />
<input type="hidden" name="mode" value="w" />
<table border="0" cellpadding="0" cellspacing="1" bgcolor="D8D8D8" width="70%" >
	<colgroup>
		<col width="150px" >
		<col width="*" >
	</colgroup>
	<tbody>
	<tr height="34" bgcolor="FAFAFA">
		<th>차수</th>
		<td style="padding-left:10px"><input type="text" name="m_gubun" value="<?=$row['m_gubun']?>" style="width:80%"/></td>
	</tr>
	<tr height="34" bgcolor="FAFAFA">
		<th>일시</th>
		<td style="padding-left:10px"><input type="text" name="m_date" value="<?=$row['m_date']?>" style="width:80%"/></td>
	</tr>
	<tr height="34" bgcolor="FAFAFA">
		<th>장소</th>
		<td style="padding-left:10px"><input type="text" name="m_place" value="<?=$row['m_place']?>" style="width:80%"/></td>
	</tr>
	<tr height="34" bgcolor="FAFAFA">
		<th>기록</th>
		<td style="padding-left:10px"><input type="text" name="m_record" value="<?=$row['m_record']?>" style="width:80%"/></td>
	</tr>
	<tr height="34" bgcolor="FAFAFA">
		<th>내용</th>
		<td style="padding-left:10px"><input type="text" name="m_memo" value="<?=$row['m_memo']?>" style="width:80%"/></td>
	</tr>
	<tr height="34" bgcolor="FAFAFA">
		<th>참석</th>
		<td style="padding-left:10px">
			<textarea name="m_member" id="m_member" name="m_member" style="width:80%;height:50px;"><?php echo nl2br($row['m_member'])?></textarea>
		</td>
	</tr>
	</tbody>
</table><br />
<table width="70%" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td style="text-align:center"><input type="submit" class='btn1' value='<?php echo $writeNM?>' style="cursor:pointer"/>&nbsp;<input type="button" class='btn1' value='목록' onclick="location.href='./index.php'" style="cursor:pointer"></td>
	</tr>
</table>
</form>
</div>