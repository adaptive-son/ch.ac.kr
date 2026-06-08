<?php
	include_once("../_common.php");
	if($_SERVER['REMOTE_ADDR']=="112.217.216.250"){
		$_SESSION['ID'] = '2293';
	}
	//echo $_SESSION['ID'];
	//오픈된 회의가 있는지 확인
	$check = mysql_fetch_array(mysql_query("SELECT count(*) as cnt, idx FROM teamjang_meeting WHERE showYN='Y' order by idx DESC LIMIT 1"));

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
						teamjang_meeting_content_new
					WHERE
						m_idx='{$parent['idx']}'
					ORDER BY m_order asc";
	$res = mysql_query($sql);

	$i=1;
	$k=0;
	while($row = mysql_fetch_array($res)){
		$result['m_content'][$row['m_order']] = $row['m_content'];
		$i++;
		$k++;
	}

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


if($k>0){
	$mode = "p_u";
}else{
	$mode = "p_w";
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
<input type="hidden" name="m_writer" value=""/>
<input type="hidden" name="m_page" value="part_write.php" />
<input type="hidden" name="mode" value="<?php echo $mode?>" />
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
	<?php if($parent['idx']<164){ ?>
	<tbody>
	<?php if(in_array($_SESSION['ID'],$교무처['member'])){?>
	<tr height="34" bgcolor="FAFAFA" <?php if(in_array($_SESSION['ID'],$교무처['member'])){?><?php }else{ ?>style="display:none"<?php } ?>>
		<th rowspan="5">교무처</th>
		<th style="padding:0px 10px;">교원인사/학술/전공심화과정</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="1" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][1]?></textarea>
		</td>
	</tr>
	<!--tr height="34" bgcolor="FAFAFA" <?php if(in_array($_SESSION['ID'],$교무처['member'])){?><?php }else{ ?>style="display:none"<?php } ?>>
		<th style="padding:0px 10px;">전공심화과정</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="2" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][2]?></textarea>
		</td>
	</tr-->
	<tr height="34" bgcolor="FAFAFA" <?php if(in_array($_SESSION['ID'],$교무처['member'])){?><?php }else{ ?>style="display:none"<?php } ?>>
		<th style="padding:0px 10px;">학적</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="3" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][3]?></textarea>
		</td>
	</tr>
	<tr height="34" bgcolor="FAFAFA" <?php if(in_array($_SESSION['ID'],$교무처['member'])){?><?php }else{ ?>style="display:none"<?php } ?>>
		<th style="padding:0px 10px;">수업/교무</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="4" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][4]?></textarea>
		</td>
	</tr>
	<tr height="34" bgcolor="FAFAFA" <?php if(in_array($_SESSION['ID'],$교무처['member'])){?><?php }else{ ?>style="display:none"<?php } ?>>
		<th style="padding:0px 10px;">교수학습<br />지원센터</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="5" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][5]?></textarea>
		</td>
	</tr>
	<!--tr height="34" bgcolor="FAFAFA" <?php if(in_array($_SESSION['ID'],$교무처['member'])){?><?php }else{ ?>style="display:none"<?php } ?>>
		<th style="padding:0px 10px;">원격교육<br />지원센터</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="39" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][39]?></textarea>
		</td>
	</tr>
	<tr height="34" bgcolor="FAFAFA" <?php if(in_array($_SESSION['ID'],$교무처['member'])){?><?php }else{ ?>style="display:none"<?php } ?>>
		<th style="padding:0px 10px;">창의교양<br />교육센터</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="38" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][38]?></textarea>
		</td>
	</tr-->
	<tr height="34" bgcolor="FAFAFA" <?php if(in_array($_SESSION['ID'],$교무처['member'])){?><?php }else{ ?>style="display:none"<?php } ?>>
		<th style="padding:0px 10px;">교육혁신<br />지원센터</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="6" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][6]?></textarea>
		</td>
	</tr>
	
	<?php } ?>
	<?php if(in_array($_SESSION['ID'],$입학처['member'])==true){?>
	<tr height="34" bgcolor="FAFAFA" <?php if(in_array($_SESSION['ID'],$입학처['member'])==false){?>style="display:none;"<?php } ?>>
		<th rowspan="3">입학처</th>
		<th style="padding:0px 10px;">일반</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="7" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][7]?></textarea>
		</td>
	</tr>
	
	<tr height="34" bgcolor="FAFAFA" <?php if(in_array($_SESSION['ID'],$입학처['member'])==false){?>style="display:none;"<?php } ?>>
		<th style="padding:0px 10px;">입시홍보</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="41" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][42]?></textarea>
		</td>
	</tr>
	<!--
	<tr height="34" bgcolor="FAFAFA" <?php if(in_array($_SESSION['ID'],$입학처['member'])==false){?>style="display:none;"<?php } ?>>
		<th style="padding:0px 10px;">입시 일반</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="42" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][42]?></textarea>
		</td>
	</tr>-->
	<tr height="34" bgcolor="FAFAFA" <?php if(in_array($_SESSION['ID'],$입학처['member'])==false){?>style="display:none;"<?php } ?>>
		<th style="padding:0px 10px;">혁신지원사업</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="42" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][41]?></textarea>
		</td>
	</tr>
	<?php } ?>
	<?php if(in_array($_SESSION['ID'],$학생처['member'])==true){?>
	<tr height="34" bgcolor="FAFAFA" <?php if(in_array($_SESSION['ID'],$학생처['member'])==false){?>style="display:none"<?php } ?>>
		<th rowspan="9">학생처</th>
		<th style="padding:0px 10px;">장학</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="8" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][8]?></textarea>
		</td>
	</tr>
	<tr height="34" bgcolor="FAFAFA" <?php if(in_array($_SESSION['ID'],$학생처['member'])==false){?>style="display:none"<?php } ?>>
		<th style="padding:0px 10px;">학생</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="9" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][9]?></textarea>
		</td>
	</tr>
        <tr height="34" bgcolor="FAFAFA" <?php if(in_array($_SESSION['ID'],$학생처['member'])==false){?>style="display:none"<?php } ?>>
            <th style="padding:0px 10px;">생활관</th>
            <td style="padding:5px">
                <input type="hidden" name="m_order[]" value="53" />
                <textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][53]?></textarea>
            </td>
        </tr>
        <tr height="34" bgcolor="FAFAFA" <?php if(in_array($_SESSION['ID'],$학생처['member'])==false){?>style="display:none"<?php } ?>>
            <th style="padding:0px 10px;">피트니스 센터</th>
            <td style="padding:5px">
                <input type="hidden" name="m_order[]" value="54" />
                <textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][54]?></textarea>
            </td>
        </tr>
	<!--tr height="34" bgcolor="FAFAFA" <?php if(in_array($_SESSION['ID'],$학생처['member'])==false){?>style="display:none"<?php } ?>>
		<th style="padding:0px 10px;">국제개발협력센터</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="12" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][12]?></textarea>
		</td>
	</tr-->
        <tr height="34" bgcolor="FAFAFA" <?php if(in_array($_SESSION['ID'],$학생처['member'])==false){?>style="display:none"<?php } ?>>
            <th style="padding:0px 10px;">보건실</th>
            <td style="padding:5px">
                <input type="hidden" name="m_order[]" value="10" />
                <textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][10]?></textarea>
            </td>
        </tr>
	<tr height="34" bgcolor="FAFAFA"<?php if(in_array($_SESSION['ID'],$학생처['member'])==false){?>style="display:none"<?php }?>>
		<th style="padding:0px 10px;">학생상담센터</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="50" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][50]?></textarea>
		</td>
	</tr>
	<tr height="34" bgcolor="FAFAFA"<?php if(in_array($_SESSION['ID'],$학생처['member'])==false){?>style="display:none"<?php }?>>
		<th style="padding:0px 10px;">인권센터</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="36" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][36]?></textarea>
		</td>
	</tr>
        <tr height="34" bgcolor="FAFAFA" <?php if(in_array($_SESSION['ID'],$학생처['member'])==false){?>style="display:none"<?php } ?>>
            <th style="padding:0px 10px;">사회공헌센터</th>
            <td style="padding:5px">
                <input type="hidden" name="m_order[]" value="11" />
                <textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][11]?></textarea>
            </td>
        </tr>
        <tr height="34" bgcolor="FAFAFA" <?php if(in_array($_SESSION['ID'],$학생처['member'])==false){?>style="display:none"<?php } ?>>
            <th style="padding:0px 10px;">장애학생지원센터</th>
            <td style="padding:5px">
                <input type="hidden" name="m_order[]" value="44" />
                <textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][44]?></textarea>
            </td>
        </tr>


	<?php } ?>
	<?php if(in_array($_SESSION['ID'],$기획처['member'])==true){?>
	<tr height="34" bgcolor="FAFAFA" <?php if(in_array($_SESSION['ID'],$기획처['member'])==false){?>style="display:none"<?php }?>>
		<th rowspan="3">기획처</th>
		<th style="padding:0px 10px;">기획,인사</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="13" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][13]?></textarea>
		</td>
	</tr>
	<!--tr height="34" bgcolor="FAFAFA" <?php if(in_array($_SESSION['ID'],$기획처['member'])==false){?>style="display:none"<?php }?>>
		<th style="padding:0px 10px;">인사</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="14" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][14]?></textarea>
		</td>
	</tr-->
	<tr height="34" bgcolor="FAFAFA" <?php if(in_array($_SESSION['ID'],$기획처['member'])==false){?>style="display:none"<?php }?>>
		<th style="padding:0px 10px;">입시홍보</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="15" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][15]?></textarea>
		</td>
	</tr>
	<tr height="34" bgcolor="FAFAFA" <?php if(in_array($_SESSION['ID'],$기획처['member'])==false){?>style="display:none"<?php }?>>
		<th style="padding:0px 10px;">IR성과관리센터</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="16" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][16]?></textarea>
		</td>
	</tr>
	<!--tr height="34" bgcolor="FAFAFA" <?php if(in_array($_SESSION['ID'],$기획처['member'])==false){?>style="display:none"<?php }?>>
		<th style="padding:0px 10px;">글로벌센터</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="17" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][17]?></textarea>
		</td>
	</tr-->
	<?php } ?>
	<?php if(in_array($_SESSION['ID'],$행정처['member'])==true){ ?>
	<tr height="34" bgcolor="FAFAFA" <?php if(in_array($_SESSION['ID'],$행정처['member'])==false){ ?>style="display:none"<?php } ?>>
		<th>행정처</th>
		<th style="padding:0px 10px;">-</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="18" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][18]?></textarea>
		</td>
	</tr>
	<?php } ?>
	<?php if(in_array($_SESSION['ID'],$산학협력['member'])==true){ ?>
	<tr height="34" bgcolor="FAFAFA" <?php if(in_array($_SESSION['ID'],$산학협력['member'])==false){ ?>style="display:none"<?php }?>>
		<th rowspan="10">산학협력(처)단</th>
		<th style="padding:0px 10px;">본부</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="19" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][19]?></textarea>
		</td>
	</tr>
	<!--tr height="34" bgcolor="FAFAFA" <?php if(in_array($_SESSION['ID'],$산학협력['member'])==false){ ?>style="display:none"<?php }?>>
		<th style="padding:0px 10px;">LINC 3.0<br/>사업단</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="21" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][21]?></textarea>
		</td>
	</tr-->
	<tr height="34" bgcolor="FAFAFA" <?php if(in_array($_SESSION['ID'],$산학협력['member'])==false){ ?>style="display:none"<?php }?>>
		<th style="padding:0px 10px;">현장실습<br/>지원센터</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="22" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][22]?></textarea>
		</td>
	</tr>
	<tr height="34" bgcolor="FAFAFA" <?php if(in_array($_SESSION['ID'],$산학협력['member'])==false){ ?>style="display:none"<?php }?>>
		<th style="padding:0px 10px;">취창업진로<br/>지원센터</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="23" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][23]?></textarea>
		</td>
	</tr>
	<!--tr height="34" bgcolor="FAFAFA" <?php if(in_array($_SESSION['ID'],$산학협력['member'])==false){ ?>style="display:none"<?php }?>>
		<th style="padding:0px 10px;">다목적시뮬<br/>레이션센터</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="24" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][24]?></textarea>
		</td>
	</tr-->
	<tr height="34" bgcolor="FAFAFA" <?php if(in_array($_SESSION['ID'],$산학협력['member'])==false){ ?>style="display:none"<?php }?>>
		<th style="padding:0px 10px;">임상시뮬<br/>레이션센터</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="25" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][25]?></textarea>
		</td>
	</tr>
	<tr height="34" bgcolor="FAFAFA" <?php if(in_array($_SESSION['ID'],$산학협력['member'])==false){ ?>style="display:none"<?php }?>>
		<th style="padding:0px 10px;">기업협업<br/>지원센터</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="26" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][26]?></textarea>
		</td>
	</tr>
	<tr height="34" bgcolor="FAFAFA" <?php if(in_array($_SESSION['ID'],$산학협력['member'])==false){ ?>style="display:none"<?php }?>>
		<th style="padding:0px 10px;">건강안전<br/>지원센터</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="46" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][46]?></textarea>
		</td>
	</tr>
	<tr height="34" bgcolor="FAFAFA" <?php if(in_array($_SESSION['ID'],$산학협력['member'])==false){ ?>style="display:none"<?php }?>>
		<th style="padding:0px 10px;">수목진단<br/>센터</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="47" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][47]?></textarea>
		</td>
	</tr>
	<tr height="34" bgcolor="FAFAFA" <?php if(in_array($_SESSION['ID'],$산학협력['member'])==false){ ?>style="display:none"<?php }?>>
		<th style="padding:0px 10px;">늘돌봄<br/>지원센터</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="48" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][48]?></textarea>
		</td>
	</tr>
	<tr height="34" bgcolor="FAFAFA" <?php if(in_array($_SESSION['ID'],$산학협력['member'])==false){ ?>style="display:none"<?php }?>>
		<th style="padding:0px 10px;">웰니스문화<br/>관광센터</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="55" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][55]?></textarea>
		</td>
	</tr>
	<tr height="34" bgcolor="FAFAFA" <?php if(in_array($_SESSION['ID'],$산학협력['member'])==false){ ?>style="display:none"<?php }?>>
		<th style="padding:0px 10px;">언어치료<br/>센터</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="56" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][56]?></textarea>
		</td>
	</tr>
	<?php } ?>
	<?php if(in_array($_SESSION['ID'],$혁신지원사업단['member'])==true){	?>
	<tr height="34" bgcolor="FAFAFA" <?php if(in_array($_SESSION['ID'],$혁신지원사업단['member'])==false){ ?>style="display:none"<?php }?>>
		<th colspan="2">혁신지원사업단1</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="20" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][20]?></textarea>
		</td>
	</tr>
	<?php } ?>
	<?php /* if(in_array($_SESSION['ID'],$Hive사업단['member'])==true){	?>
	<tr height="34" bgcolor="FAFAFA" <?php if(in_array($_SESSION['ID'],$Hive사업단['member'])==false){ ?>style="display:none"<?php }?>>
		<th colspan="2">고등직업교육거점지구사업(HiVE)단</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="43" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][43]?></textarea>
		</td>
	</tr>
	<?php } */ ?>
	<?php if(in_array($_SESSION['ID'],$도서관['member'])==true){?>
	<tr height="34" bgcolor="FAFAFA" <?php if(in_array($_SESSION['ID'],$도서관['member'])==false){?>style="display:none"<?php }?>>
		<th>도서관</th>
		<th style="padding:0px 10px;">-</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="34" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][34]?></textarea>
		</td>
	</tr>
	<?php } ?>
	<?php if(in_array($_SESSION['ID'],$평생교육원['member'])==true){	?>
		<tr height="34" bgcolor="FAFAFA" <?php if(in_array($_SESSION['ID'],$평생교육원['member'])==false){	?>style="display:none;"<?php }?>>
		<th rowspan="<?php  if ( $parent['idx'] > 133 || $parent['idx']=="") {echo "5";}else{echo "5";} ?>">평생교육원</th>
		<th style="padding:0px 10px;">울주군사업</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="29" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][29]?></textarea>
		</td>
	</tr>
	<!--tr height="34" bgcolor="FAFAFA" <?php if(in_array($_SESSION['ID'],$평생교육원['member'])==false){	?>style="display:none;"<?php }?>>

		<th style="padding:0px 10px;">로컬크리에이터 2급 교육 시범사업(혁신지원사업)</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="45" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][45]?></textarea>
		</td>
	</tr-->
	<!--tr height="34" bgcolor="FAFAFA" <?php if(in_array($_SESSION['ID'],$평생교육원['member'])==false){	?>style="display:none;"<?php }?>>

		<th style="padding:0px 10px;">교육청 사업<br />(학교안전부장연수)</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="45" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][45]?></textarea>
		</td>
	</tr-->
	<!--tr height="34" bgcolor="FAFAFA" <?php if(in_array($_SESSION['ID'],$평생교육원['member'])==false){	?>style="display:none;"<?php }?>>
		<th style="padding:0px 10px;">심장초음파 연수과정</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="28" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][28]?></textarea>
		</td>
	</tr-->
	<!--
	<tr height="34" bgcolor="FAFAFA" <?php if(in_array($_SESSION['ID'],$평생교육원['member'])==false){	?>style="display:none;"<?php }?>>
		<th style="padding:0px 10px;">평생교육 실습 사업</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="30" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][30]?></textarea>
		</td>
	</tr>
	-->

    <?
    // 2024.02.17 평생교육원 수정사항 반영
    if ( $parent['idx'] > 133 ) {
    ?>
        <tr height="34" bgcolor="FAFAFA" <?php if(in_array($_SESSION['ID'],$평생교육원['member'])==false){	?>style="display:none;"<?php }?>>
            <th style="padding:0px 10px;">LiFE 2.0 사업(성인학습자지원센터)</th>
            <td style="padding:5px">
                <input type="hidden" name="m_order[]" value="28" />
                <textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][28]?></textarea>
            </td>
        </tr>
        <tr height="34" bgcolor="FAFAFA" <?php if(in_array($_SESSION['ID'],$평생교육원['member'])==false){	?>style="display:none;"<?php }?>>
            <th style="padding:0px 10px;">울산연구원 사업(인재평생교육센터)</th>
            <td style="padding:5px">
                <input type="hidden" name="m_order[]" value="27" />
                <textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][27]?></textarea>
            </td>
        </tr>
        <tr height="34" bgcolor="FAFAFA" <?php if(in_array($_SESSION['ID'],$평생교육원['member'])==false){	?>style="display:none;"<?php }?>>
            <th style="padding:0px 10px;">심장초음파 연수과정(대한방사선사협회)</th>
            <td style="padding:5px">
                <input type="hidden" name="m_order[]" value="52" />
                <textarea name="m_content[]" style="width:100%;height:+++++150px;"><?php echo $result['m_content'][52]?></textarea>
            </td>
        </tr>
    <? } else { ?>
        <tr height="34" bgcolor="FAFAFA" <?php if(in_array($_SESSION['ID'],$평생교육원['member'])==false){	?>style="display:none;"<?php }?>>
            <th style="padding:0px 10px;">울산연구원 사업(평생교육연구실)</th>
            <td style="padding:5px">
                <input type="hidden" name="m_order[]" value="35" />
                <textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][35]?></textarea>
            </td>
        </tr>
        <tr height="34" bgcolor="FAFAFA" <?php if(in_array($_SESSION['ID'],$평생교육원['member'])==false){	?>style="display:none;"<?php }?>>
            <th style="padding:0px 10px;">평생학습지원(U-RUN)센터</th>
            <td style="padding:5px">
                <input type="hidden" name="m_order[]" value="34" />
                <textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][34]?></textarea>
            </td>
        </tr>
    <? } ?>
        <tr height="34" bgcolor="FAFAFA" <?php if(in_array($_SESSION['ID'],$평생교육원['member'])==false){	?>style="display:none;"<?php }?>>
            <th style="padding:0px 10px;">일반업무</th>
            <td style="padding:5px">
                <input type="hidden" name="m_order[]" value="31" />
                <textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][31]?></textarea>
            </td>
        </tr>



	<?php } ?>
	<?php if(in_array($_SESSION['ID'],$전산소['member'])==true){?>
	<tr height="34" bgcolor="FAFAFA" <?php if(in_array($_SESSION['ID'],$전산소['member'])==false){?>style="display:none"<?php }?>>
		<th>정보전산원</th>
		<th style="padding:0px 10px;">-</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="32" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][32]?></textarea>
		</td>
	</tr>
	<!--tr height="34" bgcolor="FAFAFA" <?php if(in_array($_SESSION['ID'],$전산소['member'])==false){?>style="display:none"<?php }?>>
		<th style="padding:0px 10px;">빅데이터센터</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="33" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][33]?></textarea>
		</td>
	</tr-->
	<?php } ?>
	<?php if(in_array($_SESSION['ID'],$국제교류원['member'])==true){?>
	<tr height="34" bgcolor="FAFAFA" <?php if(in_array($_SESSION['ID'],$국제교류원['member'])==false){?>style="display:none"<?php }?>>
		<th rowspan="3">국제교류원</th>
		<th style="padding:0px 10px;">공통</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="49" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][49]?></textarea>
		</td>
	</tr>
	<tr height="34" bgcolor="FAFAFA" <?php if(in_array($_SESSION['ID'],$국제교류원['member'])==false){?>style="display:none"<?php }?>>
		<th style="padding:0px 10px;">국제개발협력센터</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="12" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][12]?></textarea>
		</td>
	</tr>
	<tr height="34" bgcolor="FAFAFA" <?php if(in_array($_SESSION['ID'],$국제교류원['member'])==false){?>style="display:none"<?php }?>>
		<th style="padding:0px 10px;">글로벌센터</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="17" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][17]?></textarea>
		</td>
	</tr>
	<?php } ?>

	<?php /* if(in_array($_SESSION['ID'],$학생상담['member'])==true){?>
	<tr height="34" bgcolor="FAFAFA" <?php if(in_array($_SESSION['ID'],$학생상담['member'])==false){?>style="display:none"<?php }?>>
		<th>학생상담연구소</th>
		<th style="padding:0px 10px;">-</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="35" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][35]?></textarea>
		</td>
	</tr>
	<?php }  ?>
	<?php if(in_array($_SESSION['ID'],$인권센터['member'])==true){?>
	<tr height="34" bgcolor="FAFAFA"<?php if(in_array($_SESSION['ID'],$인권센터['member'])==false){?>style="display:none"<?php }?>>
		<th>인권센터</th>
		<th style="padding:0px 10px;">-</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="36" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][36]?></textarea>
		</td>
	</tr>
	<?php } */?>
	<?php if(in_array($_SESSION['ID'],$기타['member'])==true){ ?>
	<tr height="34" bgcolor="FAFAFA" <?php if(in_array($_SESSION['ID'],$기타['member'])==false){ ?>style="display:none"<?php }?>>
		<th>기타</th>
		<th style="padding:0px 10px;">생명윤리위원회</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="37" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][37]?></textarea>
		</td>
	</tr>
	<?php } ?>
	</tbody>
	<?php } else {
		include "part_write_202501.php";
	} 
	?>
</table><br />
<?php
}
?>
<?php
if($m_part_2['cnt'] > 0){
	$part_member_sql = "SELECT * FROM teamjang_meeting_member where m_part_gubun='2' order By idx asc";
	$part_member_res = mysql_query($part_member_sql);

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
	<?php
		WHILE($part_member=mysql_fetch_array($part_member_res)){

			$part_member_data = $part_member['m_member'];
			$part_member_data_array = explode(",",$part_member_data);
			${$part_member['m_part']}[idx] = $part_member['idx'];
			${$part_member['m_part']}[member] = $part_member_data_array;
			$part_data = mysql_fetch_array(mysql_query("SELECT * FROM teamjang_meeting_class_content_new WHERE m_idx='{$parent['idx']}' and m_part='{$part_member['m_part']}'"));

	?>
		<?php if(in_array($_SESSION['ID'],${$part_member['m_part']}['member'])==true){ ?>
		<input type="hidden" name="m_part[]" value="<?php echo $part_member['m_part']?>" />
		<!--
		<tr height="34" bgcolor="FAFAFA" <?php if(in_array($_SESSION['ID'],${$part_member['m_part']}['member'])==false){ ?>style="display:none"<?php }?>>
			<th rowspan="3"><?php echo $part_member['m_part']?></th>
			<th>지난 주<br />학과행사</th>
			<td style="padding:5px"><textarea name="m_content_past[]" style="width:100%;height:150px;"><?php echo $part_data['m_content_past']?></textarea></td>
			<?
				$num++;
			?>
		</tr>
		-->
		<tr height="34" bgcolor="FAFAFA" <?php if(in_array($_SESSION['ID'],${$part_member['m_part']}['member'])==false){ ?>style="display:none"<?php }?>>
			<th rowspan="2"><?php echo $part_member['m_part']?></th>
			<th>이번 주<br />학과행사</th>
			<td style="padding:5px"><textarea name="m_content_this[]" style="width:100%;height:150px;"><?php echo $part_data['m_content_this']?></textarea></td>
			<?
				$num++;
			?>
		</tr>
		<tr height="34" bgcolor="FAFAFA" <?php if(in_array($_SESSION['ID'],${$part_member['m_part']}['member'])==false){ ?>style="display:none"<?php }?>>
			<th>다음 주<br />학과행사</th>
			<td style="padding:5px"><textarea name="m_content_next[]" style="width:100%;height:150px;"><?php echo $part_data['m_content_next']?></textarea></td>
			<?
				$num++;
			?>
		</tr>
		<?php } ?>
	<?php
	}
	?>
	</tbody>
</table><br />
<?php
}
?>
<table width="70%" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td style="text-align:center"><input type="submit" class='btn1' value='등록' style="cursor:pointer"/></td>
	</tr>
</table>

</form>
</div>
