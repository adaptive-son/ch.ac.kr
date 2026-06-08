<?php
	include_once("../_common.php"); 
	
	$sql = "SELECT 
						*
					FROM
						teamjang_meeting_content
					WHERE 
						m_idx='{$_GET['idx']}'";
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	

?>
<link rel="stylesheet" type="text/css" href="../js/jquery-ui.css" />
<script type="text/javascript" src="../js/jquery.js" ></script>
<script type="text/javascript" src="../js/jquery-ui.min.js" ></script>

<div align="left">
<font color="#616161"><h4><?php echo $parent['m_idx']?>회의 작성</h4></font>
<form name="frm" method="POST" action="./proc.php" onsubmit="return check_form(this)" />
<input type="hidden" name="idx" value="<?=$row['idx']?>" />
<input type="hidden" name="m_idx" value="<?=$parent['idx']?>" />
<input type="hidden" name="m_writer" value="<?php echo $m_writer?>"/>
<input type="hidden" name="m_page" value="meeting_view.php" />
<input type="hidden" name="mode" value="p_w" />

<table border="0" cellpadding="0" cellspacing="1" bgcolor="D8D8D8" width="70%" >
	<colgroup>
		<col width="25px" >
		<col width="80px" >
		<col width="*" >
	</colgroup>
	<thead>
		<tr>
			<th colspan="2">구분</th>
			<th style="text-align:center;">업무내용</th>
		</tr>
	</thead>
	<tbody>

	<tr height="34" bgcolor="FAFAFA">
		<th rowspan="5">교무입학처</th>
		<th style="padding:0px 10px;">교무</th>
		<td style="padding:5px">
			<textarea name="m_content1" style="width:100%;height:150px;"><?php echo $row['m_content1']?></textarea>
		</td>
	</tr>
	<tr height="34" bgcolor="FAFAFA">
		<th style="padding:0px 10px;">교수학습<br />지원센터</th>
		<td style="padding:5px">
			<textarea name="m_content2" style="width:100%;height:150px;"><?php echo $row['m_content2']?></textarea>
		</td>
	</tr>
	<tr height="34" bgcolor="FAFAFA">
		<th style="padding:0px 10px;">교육혁신<br />지원센터</th>
		<td style="padding:5px">
			<textarea name="m_content3" style="width:100%;height:150px;"><?php echo $row['m_content3']?></textarea>
		</td>
	</tr>
	<tr height="34" bgcolor="FAFAFA">
		<th style="padding:0px 10px;">교육교양<br />지원센터</th>
		<td style="padding:5px">
			<textarea name="m_content68" style="width:100%;height:150px;"><?php echo $row['m_content68']?></textarea>
		</td>
	</tr>
	<tr height="34" bgcolor="FAFAFA">
		<th style="padding:0px 10px;">입시</th>
		<td style="padding:5px">
			<textarea name="m_content4" style="width:100%;height:150px;"><?php echo $row['m_content4']?></textarea>
		</td>
	</tr>
	
	<tr height="34" bgcolor="FAFAFA">
		<th rowspan="6">학생처</th>
		<th style="padding:0px 10px;">장학</th>
		<td style="padding:5px">
			<textarea name="m_content5" style="width:100%;height:150px;"><?php echo $row['m_content5']?></textarea>
		</td>
	</tr>
	<tr height="34" bgcolor="FAFAFA">
		<th style="padding:0px 10px;">학생</th>
		<td style="padding:5px">
			<textarea name="m_content6" style="width:100%;height:150px;"><?php echo $row['m_content6']?></textarea>
		</td>
	</tr>
	<tr height="34" bgcolor="FAFAFA">
		<th style="padding:0px 10px;">감염병 총괄관리팀</th>
		<td style="padding:5px">
			<textarea name="m_content9" style="width:100%;height:150px;"><?php echo $row['m_content9']?></textarea>
		</td>
	</tr>
	<tr height="34" bgcolor="FAFAFA">
		<th style="padding:0px 10px;">창의인성<br/>융복합센터</th>
		<td style="padding:5px">
			<textarea name="m_content7" style="width:100%;height:150px;"><?php echo $row['m_content7']?></textarea>
		</td>
	</tr>
	<tr height="34" bgcolor="FAFAFA">
		<th style="padding:0px 10px;">봉사센터</th>
		<td style="padding:5px">
			<textarea name="m_content8" style="width:100%;height:150px;"><?php echo $row['m_content8']?></textarea>
		</td>
	</tr>
	<tr height="34" bgcolor="FAFAFA">
		<th style="padding:0px 10px;">국제개발협력센터</th>
		<td style="padding:5px">
			<textarea name="m_content69" style="width:100%;height:150px;"><?php echo $row['m_content69']?></textarea>
		</td>
	</tr>
	
	<tr height="34" bgcolor="FAFAFA">
		<th rowspan="3">기획처</th>
		<th style="padding:0px 10px;">기획</th>
		<td style="padding:5px">
			<textarea name="m_content10" style="width:100%;height:150px;"><?php echo $row['m_content10']?></textarea>
		</td>
	</tr>
	<tr height="34" bgcolor="FAFAFA">
		<th style="padding:0px 10px;">대학평가인<br/>증지원센터</th>
		<td style="padding:5px">
			<textarea name="m_content11" style="width:100%;height:150px;"><?php echo $row['m_content11']?></textarea>
		</td>
	</tr>
	<tr height="34" bgcolor="FAFAFA">
		<th style="padding:0px 10px;">글로벌인재<br/>양성센터</th>
		<td style="padding:5px">
			<textarea name="m_content12" style="width:100%;height:150px;"><?php echo $row['m_content12']?></textarea>
		</td>
	</tr>
	
	<tr height="34" bgcolor="FAFAFA">
		<th>행정처</th>
		<th style="padding:0px 10px;">-</th>
		<td style="padding:5px">
			<textarea name="m_content13" style="width:100%;height:150px;"><?php echo $row['m_content13']?></textarea>
		</td>
	</tr>
	
	<tr height="34" bgcolor="FAFAFA">
		<th rowspan="8">산학협력(처)단</th>
		<th style="padding:0px 10px;">본부</th>
		<td style="padding:5px">
			<textarea name="m_content14" style="width:100%;height:150px;"><?php echo $row['m_content14']?></textarea>
		</td>
	</tr>
	<tr height="34" bgcolor="FAFAFA">
		<th style="padding:0px 10px;">대학혁신<br/>지원사업단</th>
		<td style="padding:5px">
			<textarea name="m_content15" style="width:100%;height:150px;"><?php echo $row['m_content15']?></textarea>
		</td>
	</tr>
	<tr height="34" bgcolor="FAFAFA">
		<th style="padding:0px 10px;">LINC+<br/>사업단</th>
		<td style="padding:5px">
			<textarea name="m_content16" style="width:100%;height:150px;"><?php echo $row['m_content16']?></textarea>
		</td>
	</tr>
	<tr height="34" bgcolor="FAFAFA">
		<th style="padding:0px 10px;">현장실습<br/>지원센터</th>
		<td style="padding:5px">
			<textarea name="m_content17" style="width:100%;height:150px;"><?php echo $row['m_content17']?></textarea>
		</td>
	</tr>
	<tr height="34" bgcolor="FAFAFA">
		<th style="padding:0px 10px;">취창업지원<br/>센터</th>
		<td style="padding:5px">
			<textarea name="m_content18" style="width:100%;height:150px;"><?php echo $row['m_content18']?></textarea>
		</td>
	</tr>
	<tr height="34" bgcolor="FAFAFA">
		<th style="padding:0px 10px;">다목적시뮬<br/>레이션센터</th>
		<td style="padding:5px">
			<textarea name="m_content19" style="width:100%;height:150px;"><?php echo $row['m_content19']?></textarea>
		</td>
	</tr>
	<tr height="34" bgcolor="FAFAFA">
		<th style="padding:0px 10px;">임상시뮬<br/>레이션센터</th>
		<td style="padding:5px">
			<textarea name="m_content20" style="width:100%;height:150px;"><?php echo $row['m_content20']?></textarea>
		</td>
	</tr>
	<tr height="34" bgcolor="FAFAFA">
		<th style="padding:0px 10px;">융합기술신<br/>속대응센터</th>
		<td style="padding:5px">
			<textarea name="m_content21" style="width:100%;height:150px;"><?php echo $row['m_content21']?></textarea>
		</td>
	</tr>
	
	<tr height="34" bgcolor="FAFAFA">
		<th rowspan="5">평생교육원</th>
		<th style="padding:0px 10px;">학점은행제<br />교학업무</th>
		<td style="padding:5px">
			<textarea name="m_content22" style="width:100%;height:150px;"><?php echo $row['m_content22']?></textarea>
		</td>
	</tr>
	<tr height="34" bgcolor="FAFAFA">
		<th style="padding:0px 10px;">울주군<br/>사업</th>
		<td style="padding:5px">
			<textarea name="m_content23" style="width:100%;height:150px;"><?php echo $row['m_content23']?></textarea>
		</td>
	</tr>
	<tr height="34" bgcolor="FAFAFA">
		<th style="padding:0px 10px;">울산인재평생<br/>교육진흥원<br />사업</th>
		<td style="padding:5px">
			<textarea name="m_content24" style="width:100%;height:150px;"><?php echo $row['m_content24']?></textarea>
		</td>
	</tr>
	<tr height="34" bgcolor="FAFAFA">
		<th style="padding:0px 10px;">전문대학<br/>혁진시원<br />사업<br />(대학III유형)</th>
		<td style="padding:5px">
			<textarea name="m_content25" style="width:100%;height:150px;"><?php echo $row['m_content25']?></textarea>
		</td>
	</tr>
	<tr height="34" bgcolor="FAFAFA">
		<th style="padding:0px 10px;">울산교육청<br/>연수사업</th>
		<td style="padding:5px">
			<textarea name="m_content26" style="width:100%;height:150px;"><?php echo $row['m_content26']?></textarea>
		</td>
	</tr>
	
	<tr height="34" bgcolor="FAFAFA">
		<th rowspan="2">전산소</th>
		<th style="padding:0px 10px;">본부</th>
		<td style="padding:5px">
			<textarea name="m_content27" style="width:100%;height:150px;"><?php echo $row['m_content27']?></textarea>
		</td>
	</tr>
	<tr height="34" bgcolor="FAFAFA">
		<th style="padding:0px 10px;">빅데이터센터</th>
		<td style="padding:5px">
			<textarea name="m_content70" style="width:100%;height:150px;"><?php echo $row['m_content70']?></textarea>
		</td>
	</tr>
	
	<tr height="34" bgcolor="FAFAFA">
		<th>도서관</th>
		<th style="padding:0px 10px;">-</th>
		<td style="padding:5px">
			<textarea name="m_content28" style="width:100%;height:150px;"><?php echo $row['m_content28']?></textarea>
		</td>
	</tr>
	
	<input type="hidden" name="part_idx[]" value="<?php echo $학생상담['idx']?>" />
	<tr height="34" bgcolor="FAFAFA">
		<th>학생상담연구소</th>
		<th style="padding:0px 10px;">-</th>
		<td style="padding:5px">
			<textarea name="m_content29" style="width:100%;height:150px;"><?php echo $row['m_content29']?></textarea>
		</td>
	</tr>
	
	<tr height="34" bgcolor="FAFAFA">
		<th>인권센터</th>
		<th style="padding:0px 10px;">-</th>
		<td style="padding:5px">
			<textarea name="m_content30" style="width:100%;height:150px;"><?php echo $row['m_content30']?></textarea>
		</td>
	</tr>
	
	<tr height="34" bgcolor="FAFAFA">
		<th>기타</th>
		<th style="padding:0px 10px;">-</th>
		<td style="padding:5px">
			<textarea name="m_content31" style="width:100%;height:150px;"><?php echo $row['m_content31']?></textarea>
		</td>
	</tr>
	
	</tbody>
</table><br />

<table border="0" cellpadding="0" cellspacing="1" bgcolor="D8D8D8" width="70%" >
	<colgroup>
		<col width="10%" >
		<col width="20%" >
		<col width="70%" >
	</colgroup>
	<thead>
		<tr>
			<th>구분</th>
			<th colspan="2" style="text-align:center;">내용</th>
		</tr>
	</thead>
	<tbody>
	<?php
	$part2_member_sql = "SELECT * FROM teamjang_meeting_member where m_part_gubun='2' order By idx asc";
	$part2_member_res = mysql_query($part2_member_sql);
	$num = 32;
	WHILE($part2_member=mysql_fetch_array($part2_member_res)){
		$part2_member_data = $part2_member['m_member'];
		$part2_member_data_array = explode(",",$part2_member_data);

	
	?>
		<tr height="34" bgcolor="FAFAFA">
			<th rowspan="3"><?php echo $part2_member['m_part']?></th>
			<th>지난 주<br />학과행사</th>
			<td style="padding:5px"><textarea name="m_content<?php echo $num?>" style="width:100%;height:150px;"><?php echo $row['m_content'.$num]?></textarea></td>
			<?
				$num++;
			?>
		</tr>
		<tr height="34" bgcolor="FAFAFA">
			<th>이번 주<br />학과행사</th>
			<td style="padding:5px"><textarea name="m_content<?php echo $num?>" style="width:100%;height:150px;"><?php echo $row['m_content'.$num]?></textarea></td>
			<?
				$num++;
			?>
		</tr>
		<tr height="34" bgcolor="FAFAFA">
			<th>다음 주<br />학과행사</th>
			<td style="padding:5px"><textarea name="m_content<?php echo $num?>" style="width:100%;height:150px;"><?php echo $row['m_content'.$num]?></textarea></td>
			<?
				$num++;
			?>
		</tr>
	<?php 
	} 
	?>
	</tbody>
</table>

<table width="70%" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td style="text-align:center"><input type="submit" class='btn1' value='등록' style="cursor:pointer"/>&nbsp;<input type="button" class='btn1' value='뒤로' onclick="location.href='./index.php'" style="cursor:pointer"></td>
	</tr>
</table>

</form>
</div>