<?php
	include_once "../_common.php";
	$DBTable = "set_member";
	
	$sql = "SELECT * FROM ".$DBTable;
	$result = DBquery($sql);
	$row=mysql_fetch_array($result);
?>
<link rel="stylesheet" type="text/css" href="../js/jquery-ui.css" />
<script type="text/javascript" src="../js/jquery.js" ></script>
<script type="text/javascript" src="../js/jquery-ui.min.js" ></script>
<div align="left">
<font color="#616161"><h4>직원채용 권한</h4></font>
<p>허용하실 직번을 ","로 구분하여 입력하세요.</p>
<form name="frm" method="POST" action="./proc_member.php"/>
<input type="hidden" name="gubun" value="recruit_employee"/>
<table border="0" cellpadding="0" cellspacing="1" bgcolor="D8D8D8" width="70%" >
	<colgroup>
		<col width="150px" />
		<col width="150px" />
		<col width="*" />
	</colgroup>
	<tbody>
	<tr height="34" bgcolor="FAFAFA">
		<th rowspan="3">사번</th>
		<th >직원채용</th>
		<td style="padding:10px">
			<textarea name="memberId" style="width:100%;height:200px" ><?php echo $row['member_id']?></textarea>
		</td>
	</tr>
	<tr height="34" bgcolor="FAFAFA">
		<th >산학협력단채용</th>
		<td style="padding:10px">
			<textarea name="memberId2" style="width:100%;height:200px" ><?php echo $row['member_id2']?></textarea>
		</td>
	</tr>
	<tr height="34" bgcolor="FAFAFA">
		<th >한국어강사채용</th>
		<td style="padding:10px">
			<textarea name="memberId3" style="width:100%;height:200px" ><?php echo $row['member_id3']?></textarea>
		</td>
	</tr>
	</tbody>
</table><br />
<table width="70%" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td style="text-align:center"><input type="submit" class='btn1' value='적용' style="cursor:pointer"/></td>
	</tr>
</table>
</form>
</div>