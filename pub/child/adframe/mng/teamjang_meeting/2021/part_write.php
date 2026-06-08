<?php
	include_once("../_common.php"); 
	
	//오픈된 회의가 있는지 확인
	$check = mysql_fetch_array(mysql_query("SELECT count(*) as cnt FROM teamjang_meeting WHERE showYN='Y'"));
	if($check['cnt']==0){
		go_back('작성시간이 아닙니다.');
	}

	$parent = mysql_fetch_array(mysql_query("SELECT 
						*
					FROM
						teamjang_meeting 
					WHERE 
						showYN = 'Y'
					ORDER BY idx DESC LIMIT 1"));

	$sql = "SELECT 
						*
					FROM
						teamjang_meeting_content
					WHERE 
						m_idx='{$parent['idx']}'
					ORDER BY idx DESC LIMIT 1";
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	
	$m_part_1 = mysql_fetch_array(mysql_query("SELECT count(*) as cnt FROM teamjang_meeting_member WHERE m_member like '%{$_SESSION['ID']}%' AND m_part_gubun='1'"));
	$m_part_2 = mysql_fetch_array(mysql_query("SELECT count(*) as cnt FROM teamjang_meeting_member WHERE m_member like '%{$_SESSION['ID']}%' AND m_part_gubun='2'"));
/*
	$교무입학처 = array("2049","2071","2115","2569","7047");
	$학생처 = array("2090","2565");
	$기획처 = array("2311","2340");
	$행정처 = array("2217","2444","2583");
	$산학협력 = array("2293","2575");
	$평생교육원 = array("2161","2579");
	$전산소 = array("2364","2554");
	$도서관 = array("2043","2592");
	$학생상담 = array("1022");
	$인권센터 = array("1022");
*/
	$part_member_sql = "SELECT * FROM teamjang_meeting_member where m_part_gubun='1' order By idx asc";
	$part_member_res = mysql_query($part_member_sql);
	WHILE($part_member=mysql_fetch_array($part_member_res)){
		$part_member_data = $part_member['m_member'];
		$part_member_data_array = explode(",",$part_member_data);
		${$part_member['m_part']}[idx] = $part_member['idx'];
		${$part_member['m_part']}[member] = $part_member_data_array;
	}

?>
<link rel="stylesheet" type="text/css" href="../js/jquery-ui.css" />
<script type="text/javascript" src="../js/jquery.js" ></script>
<script type="text/javascript" src="../js/jquery-ui.min.js" ></script>

<div align="left">
<font color="#616161"><h4><?php echo $parent['m_gubun']?> 회의 작성 (<?php echo $parent['m_date']?>)</h4></font>
<form name="frm" method="POST" action="./proc.php"/>
<input type="hidden" name="idx" value="<?=$row['idx']?>" />
<input type="hidden" name="m_idx" value="<?=$parent['idx']?>" />
<input type="hidden" name="m_writer" value="<?php echo $m_writer?>"/>
<input type="hidden" name="m_page" value="part_write.php" />
<input type="hidden" name="mode" value="p_w" />
<?php if($m_part_1['cnt'] > 0){?>
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
	<?php
	if(in_array($_SESSION['ID'],$교무입학처['member'])){
	
	?>
	<input type="hidden" name="part_idx[]" value="<?php echo $교무입학처['idx']?>" />
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
		<th style="padding:0px 10px;">교양교육<br />지원센터</th>
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
	<?php
	} if(in_array($_SESSION['ID'],$학생처['member'])){
		
	?>
	<input type="hidden" name="part_idx[]" value="<?php echo $학생처['idx']?>" />
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
	
	<?php
	} if(in_array($_SESSION['ID'],$기획처['member'])){
		
	?>
	<input type="hidden" name="part_idx[]" value="<?php echo $기획처['idx']?>" />
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
	<?php
	} if(in_array($_SESSION['ID'],$행정처['member'])){
		
	?>
	<input type="hidden" name="part_idx[]" value="<?php echo $행정처['idx']?>" />
	<tr height="34" bgcolor="FAFAFA">
		<th>행정처</th>
		<th style="padding:0px 10px;">-</th>
		<td style="padding:5px">
			<textarea name="m_content13" style="width:100%;height:150px;"><?php echo $row['m_content13']?></textarea>
		</td>
	</tr>
	<?php
	} if(in_array($_SESSION['ID'],$산학협력['member'])){
	
	?>
	<input type="hidden" name="part_idx[]" value="<?php echo $산학협력['idx']?>" />
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
	<?php
	} if(in_array($_SESSION['ID'],$평생교육원['member'])){
		
	?>
	<input type="hidden" name="part_idx[]" value="<?php echo $평생교육원['idx']?>" />
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
	<?php
	} if(in_array($_SESSION['ID'],$전산소['member'])){
		
	?>
	<input type="hidden" name="part_idx[]" value="<?php echo $전산소['idx']?>" />
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
	<?php
	} if(in_array($_SESSION['ID'],$도서관['member'])){
		
	?>
	<input type="hidden" name="part_idx[]" value="<?php echo $도서관['idx']?>" />
	<tr height="34" bgcolor="FAFAFA">
		<th>도서관</th>
		<th style="padding:0px 10px;">-</th>
		<td style="padding:5px">
			<textarea name="m_content28" style="width:100%;height:150px;"><?php echo $row['m_content28']?></textarea>
		</td>
	</tr>
	<?php
	} if(in_array($_SESSION['ID'],$학생상담['member'])){
		
	?>
	<input type="hidden" name="part_idx[]" value="<?php echo $학생상담['idx']?>" />
	<tr height="34" bgcolor="FAFAFA">
		<th>학생상담연구소</th>
		<th style="padding:0px 10px;">-</th>
		<td style="padding:5px">
			<textarea name="m_content29" style="width:100%;height:150px;"><?php echo $row['m_content29']?></textarea>
		</td>
	</tr>
	<?php
	} if(in_array($_SESSION['ID'],$인권센터['member'])){
		
	?>
	<input type="hidden" name="part_idx[]" value="<?php echo $인권센터['idx']?>" />
	<tr height="34" bgcolor="FAFAFA">
		<th>인권센터</th>
		<th style="padding:0px 10px;">-</th>
		<td style="padding:5px">
			<textarea name="m_content30" style="width:100%;height:150px;"><?php echo $row['m_content30']?></textarea>
		</td>
	</tr>
	<?php
	} if(in_array($_SESSION['ID'],$기타['member'])){
		
	?>
	<input type="hidden" name="part_idx[]" value="<?php echo $기타['idx']?>" />
	<tr height="34" bgcolor="FAFAFA">
		<th>기타</th>
		<th style="padding:0px 10px;">-</th>
		<td style="padding:5px">
			<textarea name="m_content31" style="width:100%;height:150px;"><?php echo $row['m_content31']?></textarea>
		</td>
	</tr>
	<?php
	}
	?>
	</tbody>
</table><br />
<?php
}
?>
<?php 
if($m_part_2['cnt'] > 0){
	$part_member_sql = "SELECT * FROM teamjang_meeting_member where m_part_gubun='2' order By idx asc";
	$part_member_res = mysql_query($part_member_sql);
	WHILE($part_member=mysql_fetch_array($part_member_res)){
		$part_member_data = $part_member['m_member'];
		$part_member_data_array = explode(",",$part_member_data);
		${$part_member['m_part']}[idx] = $part_member['idx'];
		${$part_member['m_part']}[member] = $part_member_data_array;
	}
?>
<table border="0" cellpadding="0" cellspacing="1" bgcolor="D8D8D8" width="70%" >
	<colgroup>
		<col width="10%" >
		<col width="20%" >
		<col width="70%" />
	</colgroup>
	<thead>
		<tr>
			<th>구분</th>
			<th colspan="2" style="text-align:center;">내용</th>
		</tr>
	</thead>
	<tbody>
		<?php if(in_array($_SESSION['ID'],$간호학과['member'])){	?>
		<input type="hidden" name="part_idx[]" value="12" />
		<tr bgcolor="FAFAFA">
			<th rowspan="3">간호학과</th>
			<th>지난 주<br />학과행사</th>
			<td style="padding:5px"><textarea name="m_content32" style="width:100%;height:150px;"><?php echo $row['m_content32']?></textarea></td>
		</tr>
		<tr bgcolor="FAFAFA">
			<th>이번 주<br />학과행사</th>
			<td style="padding:5px"><textarea name="m_content33" style="width:100%;height:150px;"><?php echo $row['m_content33']?></textarea></td>
		</tr>
		<tr bgcolor="FAFAFA">
			<th>다음 주<br />학과행사</th>
			<td style="padding:5px"><textarea name="m_content34" style="width:100%;height:150px;"><?php echo $row['m_content34']?></textarea></td>
		</tr>
		<?php } ?>
		<?php if(in_array($_SESSION['ID'],$치위생과['member'])){	?>
		<input type="hidden" name="part_idx[]" value="13" />
		<tr height="34" bgcolor="FAFAFA">
			<th rowspan="3">치위생과</th>
			<th>지난 주<br />학과행사</th>
			<td style="padding:5px"><textarea name="m_content35" style="width:100%;height:150px;"><?php echo $row['m_content35']?></textarea></td>
		</tr>
		<tr bgcolor="FAFAFA">
			<th>이번 주<br />학과행사</th>
			<td style="padding:5px"><textarea name="m_content36" style="width:100%;height:150px;"><?php echo $row['m_content36']?></textarea></td>
		</tr>
		<tr bgcolor="FAFAFA">
			<th>다음 주<br />학과행사</th>
			<td style="padding:5px"><textarea name="m_content37" style="width:100%;height:150px;"><?php echo $row['m_content37']?></textarea></td>
		</tr>
		<?php } ?>
				
		<?php if(in_array($_SESSION['ID'],$작업치료과['member'])){	?>
		<input type="hidden" name="part_idx[]" value="14" />
		<tr height="34" bgcolor="FAFAFA">
			<th rowspan="3">작업치료과</th>
			<th>지난 주<br />학과행사</th>
			<td style="padding:5px"><textarea name="m_content38" style="width:100%;height:150px;"><?php echo $row['m_content38']?></textarea></td>
		</tr>
		<tr bgcolor="FAFAFA">
			<th>이번 주<br />학과행사</th>
			<td style="padding:5px"><textarea name="m_content39" style="width:100%;height:150px;"><?php echo $row['m_content39']?></textarea></td>
		</tr>
		<tr bgcolor="FAFAFA">
			<th>다음 주<br />학과행사</th>
			<td style="padding:5px"><textarea name="m_content40" style="width:100%;height:150px;"><?php echo $row['m_content40']?></textarea></td>
		</tr>
		<?php } ?>
		<?php if(in_array($_SESSION['ID'],$응급구조과['member'])){	?>
		<input type="hidden" name="part_idx[]" value="15" />
		<tr height="34" bgcolor="FAFAFA">
			<th rowspan="3">응급구조과</th>
			<th>지난 주<br />학과행사</th>
			<td style="padding:5px"><textarea name="m_content41" style="width:100%;height:150px;"><?php echo $row['m_content41']?></textarea></td>
		</tr>
		<tr bgcolor="FAFAFA">
			<th>이번 주<br />학과행사</th>
			<td style="padding:5px"><textarea name="m_content42" style="width:100%;height:150px;"><?php echo $row['m_content42']?></textarea></td>
		</tr>
		<tr bgcolor="FAFAFA">
			<th>다음 주<br />학과행사</th>
			<td style="padding:5px"><textarea name="m_content43" style="width:100%;height:150px;"><?php echo $row['m_content43']?></textarea></td>
		</tr>
		<?php } ?>
		<?php if(in_array($_SESSION['ID'],$안경광학과['member'])){	?>
		<input type="hidden" name="part_idx[]" value="16" />
		<tr height="34" bgcolor="FAFAFA">
			<th rowspan="3">안경광학과</th>
			<th>지난 주<br />학과행사</th>
			<td style="padding:5px"><textarea name="m_content44" style="width:100%;height:150px;"><?php echo $row['m_content44']?></textarea></td>
		</tr>
		<tr bgcolor="FAFAFA">
			<th>이번 주<br />학과행사</th>
			<td style="padding:5px"><textarea name="m_content45" style="width:100%;height:150px;"><?php echo $row['m_content45']?></textarea></td>
		</tr>
		<tr bgcolor="FAFAFA">
			<th>다음 주<br />학과행사</th>
			<td style="padding:5px"><textarea name="m_content46" style="width:100%;height:150px;"><?php echo $row['m_content46']?></textarea></td>
		</tr>
		<?php } ?>
		<?php if(in_array($_SESSION['ID'],$방사선과['member'])){	?>
		<input type="hidden" name="part_idx[]" value="17" />
		<tr height="34" bgcolor="FAFAFA">
			<th rowspan="3">방사선과</th>
			<th>지난 주<br />학과행사</th>
			<td style="padding:5px"><textarea name="m_content47" style="width:100%;height:150px;"><?php echo $row['m_content47']?></textarea></td>
		</tr>
		<tr bgcolor="FAFAFA">
			<th>이번 주<br />학과행사</th>
			<td style="padding:5px"><textarea name="m_content48" style="width:100%;height:150px;"><?php echo $row['m_content48']?></textarea></td>
		</tr>
		<tr bgcolor="FAFAFA">
			<th>다음 주<br />학과행사</th>
			<td style="padding:5px"><textarea name="m_content49" style="width:100%;height:150px;"><?php echo $row['m_content49']?></textarea></td>
		</tr>
		<?php } ?>
		<?php if(in_array($_SESSION['ID'],$물리치료과['member'])){	?>
		<input type="hidden" name="part_idx[]" value="18" />
		<tr height="34" bgcolor="FAFAFA">
			<th rowspan="3">물리치료과</th>
			<th>지난 주<br />학과행사</th>
			<td style="padding:5px"><textarea name="m_content50" style="width:100%;height:150px;"><?php echo $row['m_content50']?></textarea></td>
		</tr>
		<tr bgcolor="FAFAFA">
			<th>이번 주<br />학과행사</th>
			<td style="padding:5px"><textarea name="m_content51" style="width:100%;height:150px;"><?php echo $row['m_content51']?></textarea></td>
		</tr>
		<tr bgcolor="FAFAFA">
			<th>다음 주<br />학과행사</th>
			<td style="padding:5px"><textarea name="m_content52" style="width:100%;height:150px;"><?php echo $row['m_content52']?></textarea></td>
		</tr>
		<?php } ?>
		<?php if(in_array($_SESSION['ID'],$언어치료과['member'])){	?>
		<input type="hidden" name="part_idx[]" value="19" />
		<tr height="34" bgcolor="FAFAFA">
			<th rowspan="3">언이치료과</th>
			<th>지난 주<br />학과행사</th>
			<td style="padding:5px"><textarea name="m_content53" style="width:100%;height:150px;"><?php echo $row['m_content53']?></textarea></td>
		</tr>
		<tr bgcolor="FAFAFA">
			<th>이번 주<br />학과행사</th>
			<td style="padding:5px"><textarea name="m_content54" style="width:100%;height:150px;"><?php echo $row['m_content54']?></textarea></td>
		</tr>
		<tr bgcolor="FAFAFA">
			<th>다음 주<br />학과행사</th>
			<td style="padding:5px"><textarea name="m_content55" style="width:100%;height:150px;"><?php echo $row['m_content55']?></textarea></td>
		</tr>
		<?php } ?>
		<?php if(in_array($_SESSION['ID'],$보건의료융합계열['member'])){	?>
		<input type="hidden" name="part_idx[]" value="20" />
		<tr height="34" bgcolor="FAFAFA">
			<th rowspan="3">보건의료융합계열</th>
			<th>지난 주<br />학과행사</th>
			<td style="padding:5px"><textarea name="m_content56" style="width:100%;height:150px;"><?php echo $row['m_content56']?></textarea></td>
		</tr>
		<tr bgcolor="FAFAFA">
			<th>이번 주<br />학과행사</th>
			<td style="padding:5px"><textarea name="m_content57" style="width:100%;height:150px;"><?php echo $row['m_content57']?></textarea></td>
		</tr>
		<tr bgcolor="FAFAFA">
			<th>다음 주<br />학과행사</th>
			<td style="padding:5px"><textarea name="m_content58" style="width:100%;height:150px;"><?php echo $row['m_content58']?></textarea></td>
		</tr>
		<?php } ?>
		<?php if(in_array($_SESSION['ID'],$유아교육과['member'])){	?>
		<input type="hidden" name="part_idx[]" value="21" />
		<tr height="34" bgcolor="FAFAFA">
			<th rowspan="3">유아교육과</th>
			<th>지난 주<br />학과행사</th>
			<td style="padding:5px"><textarea name="m_content59" style="width:100%;height:150px;"><?php echo $row['m_content59']?></textarea></td>
		</tr>
		<tr bgcolor="FAFAFA">
			<th>이번 주<br />학과행사</th>
			<td style="padding:5px"><textarea name="m_content60" style="width:100%;height:150px;"><?php echo $row['m_content60']?></textarea></td>
		</tr>
		<tr bgcolor="FAFAFA">
			<th>다음 주<br />학과행사</th>
			<td style="padding:5px"><textarea name="m_content61" style="width:100%;height:150px;"><?php echo $row['m_content61']?></textarea></td>
		</tr>
		<?php } ?>
		<?php if(in_array($_SESSION['ID'],$사회복지과['member'])){	?>
		<input type="hidden" name="part_idx[]" value="22" />
		<tr height="34" bgcolor="FAFAFA">
			<th rowspan="3">사회복지과</th>
			<th>지난 주<br />학과행사</th>
			<td style="padding:5px"><textarea name="m_content62" style="width:100%;height:150px;"><?php echo $row['m_content62']?></textarea></td>
		</tr>
		<tr bgcolor="FAFAFA">
			<th>이번 주<br />학과행사</th>
			<td style="padding:5px"><textarea name="m_content63" style="width:100%;height:150px;"><?php echo $row['m_content63']?></textarea></td>
		</tr>
		<tr bgcolor="FAFAFA">
			<th>다음 주<br />학과행사</th>
			<td style="padding:5px"><textarea name="m_content64" style="width:100%;height:150px;"><?php echo $row['m_content64']?></textarea></td>
		</tr>
		<?php } ?>
		<?php if(in_array($_SESSION['ID'],$요가과['member'])){	?>
		<input type="hidden" name="part_idx[]" value="23" />
		<tr height="34" bgcolor="FAFAFA">
			<th rowspan="3">요가과</th>
			<th>지난 주<br />학과행사</th>
			<td style="padding:5px"><textarea name="m_content65" style="width:100%;height:150px;"><?php echo $row['m_content65']?></textarea></td>	
		</tr>
		<tr bgcolor="FAFAFA">
			<th>이번 주<br />학과행사</th>
			<td style="padding:5px"><textarea name="m_content66" style="width:100%;height:150px;"><?php echo $row['m_content66']?></textarea></td>		
		</tr>
		<tr bgcolor="FAFAFA">
			<th>다음 주<br />학과행사</th>
			<td style="padding:5px"><textarea name="m_content67" style="width:100%;height:150px;"><?php echo $row['m_content67']?></textarea></td>			
		</tr>
		<?php } ?>
	<?php
	/*
	$part2_member_sql = "SELECT * FROM teamjang_meeting_member where m_part_gubun='2' order By idx asc";
	$part2_member_res = mysql_query($part2_member_sql);
	$num = 32;
	WHILE($part2_member=mysql_fetch_array($part2_member_res)){
		$part2_member_data = $part2_member['m_member'];
		$part2_member_data_array = explode(",",$part2_member_data);

		if(in_array($_SESSION['ID'],$part2_member_data_array)){
			echo $num;
	?>
		<input type="hidden" name="part_idx[]" value="<?php echo $part2_member['idx']?>" />
		<tr height="34" bgcolor="FAFAFA">
			<th><?php echo $part2_member['m_part']?></th>
			
			<td style="padding:5px"><textarea name="m_content<?php echo $num?>" style="width:100%;height:150px;"><?php echo $row['m_content'.$num]?></textarea></td>
			<?
				$num++;
			?>
			<td style="padding:5px"><textarea name="m_content<?php echo $num?>" style="width:100%;height:150px;"><?php echo $row['m_content'.$num]?></textarea></td>
			<?
				$num++;
			?>
			<td style="padding:5px"><textarea name="m_content<?php echo $num?>" style="width:100%;height:150px;"><?php echo $row['m_content'.$num]?></textarea></td>
			<?
				$num++;
			?>
		</tr>
	<?php 
		}
	
	} 
	*/
	?>
	</tbody>
</table>
<?php
}
?>
<table width="70%" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td style="text-align:center"><input type="submit" class='btn1' value='등록' style="cursor:pointer"/>&nbsp;<input type="button" class='btn1' value='뒤로' onclick="history.back();" style="cursor:pointer"></td>
	</tr>
</table>

</form>
</div>