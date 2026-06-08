<?php
	include_once "../_common.php";
	$DBTable = "teamjang_meeting_member";
	
		$sql = "SELECT * FROM ".$DBTable." ORDER BY m_order ASC";
		$result = DBquery($sql);
		
		$writeNM = "수정";

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
		
	}
	//-->
</script>
<div align="left">
<font color="#616161"><h4>학과장회의 생성</h4></font>
<p>허용하실 직번을 ","로 구분하여 입력하세요.</p>
<form name="frm" method="POST" action="./proc_member.php"/>
<table border="0" cellpadding="0" cellspacing="1" bgcolor="D8D8D8" width="70%" >
	<colgroup>
		<col width="150px" >
		<col width="*" >
	</colgroup>
	<tbody>
	<?php
	WHILE($row=mysql_fetch_array($result)){
	?>
	<tr height="34" bgcolor="FAFAFA">
		<th><?php echo $row['m_part']?></th>
		<td style="padding-left:10px">
			<input type="text" name="<?php echo $row['idx']?>" value="<?php echo $row['m_member']?>" style="width:60%"/>
		</td>
	</tr>
	<?php
}
	?>
	</tbody>
</table><br />
<table width="70%" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td style="text-align:center"><input type="submit" class='btn1' value='<?php echo $writeNM?>' style="cursor:pointer"/></td>
	</tr>
</table>
</form>
</div>