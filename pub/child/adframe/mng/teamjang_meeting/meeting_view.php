<?php
	include_once("../_common.php");

	$parent = mysql_fetch_array(mysql_query("SELECT * FROM teamjang_meeting WHERE idx='{$_GET['idx']}'"));


	$sql = "SELECT
						*
					FROM
						teamjang_meeting_content_new
					WHERE
						m_idx='{$_GET['idx']}' order by m_order asc";
	$res = mysql_query($sql);

	$rows = mysql_num_rows($res);

	while($row = mysql_fetch_array($res)){
		$result['m_content'][$row['m_order']] = $row['m_content'];
	}

	if($rows > 0){
		$mode = "p_u_1";
	}else{
		$mode = "p_w_2";
	}
?>
<link rel="stylesheet" type="text/css" href="../js/jquery-ui.css" />
<script type="text/javascript" src="../js/jquery.js" ></script>
<script type="text/javascript" src="../js/jquery-ui.min.js" ></script>

<div align="left">
<font color="#616161"><h4><?php echo $parent['m_gubun']?>&nbsp;회의 작성</h4></font>
<form name="frm" method="POST" action="./proc.php" onsubmit="return check_form(this)" />
<input type="hidden" name="m_idx" value="<?=$parent['idx']?>" />
<input type="hidden" name="m_writer" value="<?php echo $_SESSION['MEMBER_ID']?>"/>
<input type="hidden" name="mode" value="<?php echo $mode?>" />

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
	<?php 
	if($_GET['idx']<165){
	?>
	<tbody>

	<tr height="34" bgcolor="FAFAFA">
		<th rowspan="5">교무처</th>
		<th style="padding:0px 10px;">교원인사/학술/전공심화과정</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="1" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][1]?></textarea>
		</td>
	</tr>
	<!--tr height="34" bgcolor="FAFAFA">
		<th style="padding:0px 10px;">전공심화과정</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="2" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][2]?></textarea>
		</td>
	</tr-->
	<tr height="34" bgcolor="FAFAFA">
		<th style="padding:0px 10px;">학적</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="3" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][3]?></textarea>
		</td>
	</tr>
	<tr height="34" bgcolor="FAFAFA">
		<th style="padding:0px 10px;">수업/교무</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="4" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][4]?></textarea>
		</td>
	</tr>
	<tr height="34" bgcolor="FAFAFA">
		<th style="padding:0px 10px;">교수학습<br />지원센터</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="5" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][5]?></textarea>
		</td>
	</tr>
	<!--tr height="34" bgcolor="FAFAFA">
		<th style="padding:0px 10px;">원격교육<br />지원센터</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="39" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][39]?></textarea>
		</td>
	</tr>
	<tr height="34" bgcolor="FAFAFA">
		<th style="padding:0px 10px;">창의교양<br />교육센터</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="38" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][38]?></textarea>
		</td>
	</tr-->
	<tr height="34" bgcolor="FAFAFA">
		<th style="padding:0px 10px;">교육혁신<br />지원센터</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="6" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][6]?></textarea>
		</td>
	</tr>
	<tr height="34" bgcolor="FAFAFA">
		<th rowspan="3">입학처</th>
		<th style="padding:0px 10px;">일반</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="7" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][7]?></textarea>
		</td>
	</tr>
	
	<tr height="34" bgcolor="FAFAFA">
		<th style="padding:0px 10px;">입시홍보</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="41" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][42]?></textarea>
		</td>
	</tr>

	<!--tr height="34" bgcolor="FAFAFA">
		<th style="padding:0px 10px;">입시 일반</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="42" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][42]?></textarea>
		</td>
	</tr-->
	<tr height="34" bgcolor="FAFAFA">
		<th style="padding:0px 10px;">혁신지원사업</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="42" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][41]?></textarea>
		</td>
	</tr>

	<tr height="34" bgcolor="FAFAFA">
		<th rowspan="9">학생처</th>
		<th style="padding:0px 10px;">장학</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="8" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][8]?></textarea>
		</td>
	</tr>
	<tr height="34" bgcolor="FAFAFA">
		<th style="padding:0px 10px;">학생</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="9" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][9]?></textarea>
		</td>
	</tr>
    <tr height="34" bgcolor="FAFAFA">
        <th style="padding:0px 10px;">생활관(기숙사)</th>
        <td style="padding:5px">
            <input type="hidden" name="m_order[]" value="53" />
            <textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][53]?></textarea>
        </td>
    </tr>
    <tr height="34" bgcolor="FAFAFA">
        <th style="padding:0px 10px;">학생상담 센터</th>
        <td style="padding:5px">
            <input type="hidden" name="m_order[]" value="54" />
            <textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][54]?></textarea>
        </td>
    </tr>
	<!--tr height="34" bgcolor="FAFAFA">
		<th style="padding:0px 10px;">국제개발협력센터</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="12" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][12]?></textarea>
		</td>
	</tr-->
    <tr height="34" bgcolor="FAFAFA">
        <th style="padding:0px 10px;">보건실</th>
        <td style="padding:5px">
            <input type="hidden" name="m_order[]" value="10" />
            <textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][10]?></textarea>
        </td>
    </tr>
    <tr height="34" bgcolor="FAFAFA">
        <th style="padding:0px 10px;">학생상담센터</th>
        <td style="padding:5px">
            <input type="hidden" name="m_order[]" value="50" />
            <textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][50]?></textarea>
        </td>
    </tr>
	<tr height="34" bgcolor="FAFAFA">
        <th style="padding:0px 10px;">인권센터</th>
        <td style="padding:5px">
            <input type="hidden" name="m_order[]" value="36" />
            <textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][36]?></textarea>
        </td>
    </tr>
    
	<tr height="34" bgcolor="FAFAFA">
		<th style="padding:0px 10px;">사회공헌센터</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="11" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][11]?></textarea>
		</td>
	</tr>
	<tr height="34" bgcolor="FAFAFA">
		<th style="padding:0px 10px;">장애학생지원센터</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="44" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][44]?></textarea>
		</td>
	</tr>
	<!--tr height="34" bgcolor="FAFAFA">
		<th rowspan="3">기획처</th>
		<th style="padding:0px 10px;">기획,인사</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="13" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][13]?></textarea>
		</td>
	</tr>
	<!--tr height="34" bgcolor="FAFAFA">
		<th style="padding:0px 10px;">인사</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="14" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][14]?></textarea>
		</td>
	</tr-->
	<!--tr height="34" bgcolor="FAFAFA">
		<th style="padding:0px 10px;">홍보</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="15" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][15]?></textarea>
		</td>
	</tr>
	<tr height="34" bgcolor="FAFAFA">
		<th style="padding:0px 10px;">성과관리센터</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="16" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][16]?></textarea>
		</td>
	</tr>
	<!--tr height="34" bgcolor="FAFAFA">
		<th style="padding:0px 10px;">글로벌센터</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="17" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][17]?></textarea>
		</td>
	</tr-->

	<tr height="34" bgcolor="FAFAFA">
		<th>행정처</th>
		<th style="padding:0px 10px;">-</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="18" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][18]?></textarea>
		</td>
	</tr>

	<tr height="34" bgcolor="FAFAFA">
		<th rowspan="10">산학협력(처)단</th>
		<th style="padding:0px 10px;">본부</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="19" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][19]?></textarea>
		</td>
	</tr>
	<!--tr height="34" bgcolor="FAFAFA">
		<th style="padding:0px 10px;">LINC 3.0<br/>사업단</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="21" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][21]?></textarea>
		</td>
	</tr-->
	<tr height="34" bgcolor="FAFAFA">
		<th style="padding:0px 10px;">현장실습<br/>지원센터</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="22" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][22]?></textarea>
		</td>
	</tr>
	<tr height="34" bgcolor="FAFAFA">
		<th style="padding:0px 10px;">취창업진로<br/>지원센터</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="23" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][23]?></textarea>
		</td>
	</tr>
	<!--tr height="34" bgcolor="FAFAFA">
		<th style="padding:0px 10px;">다목적시뮬<br/>레이션센터</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="24" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][24]?></textarea>
		</td>
	</tr-->
	<tr height="34" bgcolor="FAFAFA">
		<th style="padding:0px 10px;">임상시뮬<br/>레이션센터</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="25" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][25]?></textarea>
		</td>
	</tr>
	<tr height="34" bgcolor="FAFAFA">
		<th style="padding:0px 10px;">기업협업<br />지원센터</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="26" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][26]?></textarea>
		</td>
	</tr>
	<tr height="34" bgcolor="FAFAFA">
		<th style="padding:0px 10px;">건강안전<br />지원센터</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="46" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][46]?></textarea>
		</td>
	</tr>
	<tr height="34" bgcolor="FAFAFA">
		<th style="padding:0px 10px;">수목진단<br />센터</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="47" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][47]?></textarea>
		</td>
	</tr>
	<tr height="34" bgcolor="FAFAFA">
		<th style="padding:0px 10px;">늘돌봄<br />지원센터</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="48" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][48]?></textarea>
		</td>
	</tr>
	<tr height="34" bgcolor="FAFAFA">
		<th style="padding:0px 10px;">웰니스문화<br />관광센터</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="55" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][55]?></textarea>
		</td>
	</tr>
	<tr height="34" bgcolor="FAFAFA">
		<th style="padding:0px 10px;">언어치료<br />센터</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="56" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][56]?></textarea>
		</td>
	</tr>
	
	<tr height="34" bgcolor="FAFAFA">
		<th colspan="2">혁신<br/>지원사업단</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="20" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][20]?></textarea>
		</td>
	</tr>
	<?php /* ?>
	<tr height="34" bgcolor="FAFAFA">
		<th colspan="2">고등직업교육거점지구사업(HiVE)단</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="43" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][43]?></textarea>
		</td>
	</tr>
	<?php */ ?>
	<tr height="34" bgcolor="FAFAFA">
		<th>도서관</th>
		<th style="padding:0px 10px;">-</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="34" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][34]?></textarea>
		</td>
	</tr>
	<!--tr height="34" bgcolor="FAFAFA">
        <th>인권센터</th>
		<th style="padding:0px 10px;">-</th>
        <td style="padding:5px">
            <input type="hidden" name="m_order[]" value="36" />
            <textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][36]?></textarea>
        </td>
    </tr-->
	<tr height="34" bgcolor="FAFAFA">
		<th rowspan="<?php if ( $_GET["idx"] > 133 ) {echo "5"; }else{echo "5";}?>">평생교육원</th>
		<th style="padding:0px 10px;"><!--울산인재평생<br/>교육진흥원<br />사업-->울주군사업</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="29" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][29]?></textarea>
		</td>
	</tr>
<!--
	<tr height="34" bgcolor="FAFAFA">
		<th style="padding:0px 10px;">로컬크리에이터 2급 교육 시범사업(혁신지원사업)</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="45" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][45]?></textarea>
		</td>
	</tr>
-->
	<!--
	<tr height="34" bgcolor="FAFAFA">
		<th style="padding:0px 10px;">평생교육 실습 사업</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="30" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][30]?></textarea>
		</td>
	</tr>
-->
<!--
	<tr height="34" bgcolor="FAFAFA">
		<th style="padding:0px 10px;"> 본부 // 학점은행제</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="40" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][40]?></textarea>
		</td>
	</tr>

	<tr height="34" bgcolor="FAFAFA">
		<th style="padding:0px 10px;"> 학점은행제<br />교학업무 // 울산연구원사업(인재평생교육센터)</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="27" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][27]?></textarea>
		</td>
	</tr>
-->
    <?
    /*
    // 2024.02.16 수정요청사항
    // 항목 수정
     (기존) 울주군사업 / 울산연구원사업(인재평생교육센터) / LIFE 2.0 사업(성인학습자지원센터) / 울산광역시 교육청 사업 / 일반업무
     (변경) 울주군사업 / LIFE 2.0 사업(성인학습자지원센터) / 울산연구원사업 / 심장초음파 연수과정 (대한방사선사협회) / 일반업무
    */
    if ( $_GET["idx"] > 133 ) {
        // 2024.02.16 이후, 순서변경 및 새로운 항목 추가
    ?>
        <tr height="34" bgcolor="FAFAFA">
            <th style="padding:0px 10px;">LiFE 2.0 사업(성인학습자지원센터)</th>
            <td style="padding:5px">
                <input type="hidden" name="m_order[]" value="28" />
                <textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][28]?></textarea>
            </td>
        </tr>
        <tr height="34" bgcolor="FAFAFA">
            <th style="padding:0px 10px;">울산연구원 사업(평생교육연구실)</th>
            <td style="padding:5px">
                <input type="hidden" name="m_order[]" value="27" />
                <textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][27]?></textarea>
            </td>
        </tr>
		<tr height="34" bgcolor="FAFAFA">
            <th style="padding:0px 10px;">심장초음파 연수과정(대한방사선사협회)</th>
            <td style="padding:5px">
                <input type="hidden" name="m_order[]" value="52" />
                <textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][52]?></textarea>
            </td>
        </tr>
      <!--  <tr height="34" bgcolor="FAFAFA">
            <th style="padding:0px 10px;">심장초음파 연수과정 (대한방사선사협회)</th>
            <td style="padding:5px">
                <input type="hidden" name="m_order[]" value="52" />
                <textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][52]?></textarea>
            </td>
        </tr> -->
		
    <? } else { ?>
        <tr height="34" bgcolor="FAFAFA">
            <th style="padding:0px 10px;">울산연구원 사업(인재평생교육센터)</th>
            <td style="padding:5px">
                <input type="hidden" name="m_order[]" value="27" />
                <textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][27]?></textarea>
            </td>
        </tr>
        <tr height="34" bgcolor="FAFAFA">
            <th style="padding:0px 10px;">LiFE 2.0 사업(성인학습자지원센터)</th>
            <td style="padding:5px">
                <input type="hidden" name="m_order[]" value="28" />
                <textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][28]?></textarea>
            </td>
        </tr>
        <tr height="34" bgcolor="FAFAFA">
            <th style="padding:0px 10px;">울산광역시 교육청 사업</th>
            <td style="padding:5px">
                <input type="hidden" name="m_order[]" value="51" />
                <textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][51]?></textarea>
            </td>
        </tr>
    <? } ?>
    <tr height="34" bgcolor="FAFAFA">
        <th style="padding:0px 10px;"><!--울산교육청<br/>연수사업-->일반업무</th>
        <td style="padding:5px">
            <input type="hidden" name="m_order[]" value="31" />
            <textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][31]?></textarea>
        </td>
    </tr>

	<tr height="34" bgcolor="FAFAFA">
		<th>정보전산원</th>
		<th style="padding:0px 10px;">-</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="32" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][32]?></textarea>
		</td>
	</tr>
	<!--tr height="34" bgcolor="FAFAFA">
		<th style="padding:0px 10px;">빅데이터센터</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="33" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][33]?></textarea>
		</td>
	</tr-->
	<tr height="34" bgcolor="FAFAFA">
		<th rowspan="3">국제교류원</th>

		<th style="padding:0px 10px;">공통</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="49" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][49]?></textarea>
		</td>
	</tr>
	<tr height="34" bgcolor="FAFAFA">
		<th style="padding:0px 10px;">국제개발협력센터</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="12" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][12]?></textarea>
		</td>
	</tr>
	<tr height="34" bgcolor="FAFAFA">
		<th style="padding:0px 10px;">글로벌센터</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="17" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][17]?></textarea>
		</td>
	</tr>



	<!--tr height="34" bgcolor="FAFAFA">
		<th>학생상담연구소</th>
		<th style="padding:0px 10px;">-</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="35" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][35]?></textarea>
		</td>
	</tr>

	<tr height="34" bgcolor="FAFAFA">
		<th>인권센터</th>
		<th style="padding:0px 10px;">-</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="36" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][36]?></textarea>
		</td>
	</tr-->

	<tr height="34" bgcolor="FAFAFA">
		<th>기타</th>
		<th style="padding:0px 10px;">생명윤리위원회</th>
		<td style="padding:5px">
			<input type="hidden" name="m_order[]" value="37" />
			<textarea name="m_content[]" style="width:100%;height:150px;"><?php echo $result['m_content'][37]?></textarea>
		</td>
	</tr>

	</tbody>
	<?php } else {
		include "./meeting_view_202501.php";
	}
	?>
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
	$part2_member_sql = "SELECT * FROM teamjang_meeting_member where m_part_gubun='2' order By m_order asc";
	$part2_member_res = mysql_query($part2_member_sql);
	$num = 32;
	WHILE($part2_member=mysql_fetch_array($part2_member_res)){
	    // 2024.02.17 이후, 사회복지과 제외
	    if ( $_GET["idx"] > 133 && $part2_member["idx"] == "22" ) continue;
		$part2_member_data = $part2_member['m_member'];
		$part2_member_data_array = explode(",",$part2_member_data);
		$part_data = mysql_fetch_array(mysql_query("SELECT * FROM teamjang_meeting_class_content_new WHERE m_idx='{$_GET['idx']}' and m_part='{$part2_member['m_part']}'"));
	?>
		<input type="hidden" name="m_part[]" value="<?php echo $part2_member['m_part']?>" />
		<!--
		<tr height="34" bgcolor="FAFAFA">
			<th rowspan="3"><?php echo $part2_member['m_part']?></th>
			<th>지난 주<br />학과행사</th>
			<td style="padding:5px"><textarea name="m_content_past[]" style="width:100%;height:150px;"><?php echo $part_data['m_content_past']?></textarea></td>
			<?
				$num++;
			?>
		</tr>
		-->
		<tr height="34" bgcolor="FAFAFA">
			<th rowspan="2"><?php echo $part2_member['m_part']?></th>
			<th>이번 주<br />학과행사</th>
			<td style="padding:5px"><textarea name="m_content_this[]" style="width:100%;height:150px;"><?php echo $part_data['m_content_this']?></textarea></td>
			<?
				$num++;
			?>
		</tr>
		<tr height="34" bgcolor="FAFAFA">
			<th>다음 주<br />학과행사</th>
			<td style="padding:5px"><textarea name="m_content_next[]" style="width:100%;height:150px;"><?php echo $part_data['m_content_next']?></textarea></td>
			<?
				$num++;
			?>
		</tr>
	<?php
	}
	?>
	</tbody>
	
</table><br />

<!--table width="70%" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td style="text-align:center"><input type="submit" class='btn1' value='등록' style="cursor:pointer"/></td>
	</tr>
</table-->

</form>
</div>
