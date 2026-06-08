<?php
	//include "../_common.php";
	$conn=mysql_connect('localhost', 'root', 'se130901'); //db 연결부분
	$db=mysql_select_db("ch_2020", $conn);

	$parent = mysql_fetch_array(mysql_query("SELECT * FROM teamjang_meeting WHERE idx='{$_GET['idx']}'"));

	$sql = "SELECT
						*
					FROM
						teamjang_meeting_content_new
					WHERE
						m_idx='{$_GET['idx']}'";
	$res = mysql_query($sql);
	while($row = mysql_fetch_array($res)){
		$result['m_content'][$row['m_order']] = $row['m_content'];
	}


$title = $row['m_gubun']." 주간업무보고";
//if($_SERVER['REMOTE_ADDR']!="112.217.216.250"){
header( "Content-type: application/vnd.ms-excel; charset=euc-kr");
header( "Content-Disposition: attachment; filename = ".$title."_".date("Y-m-d").".xls" );
header( "Content-Description: PHP4 Generated Data" );
//}
?>
<style>
	table{
		border-collapse:collapse;
	}
	br{
	mso-data-placement:same-cell;
	}
	th{
		font-size:0.8em;
	}
	td{
		font-size:0.8em;
		padding:3px;
	}
</style>
<table style="width:800px;">
	<tr>
		<td style="text-align:center;max-height:50px"></td>
		<td><img src="https://www.ch.ac.kr/adframe/mng/teamjang_meeting/logo.png" style="margin:0;padding0"/></td>
		<td colspan="6" style="text-align:center;"><h1>학 과 장 회 의 록</h1></td>
		<td><img src="https://www.ch.ac.kr/adframe/mng/teamjang_meeting/logo.png" style="margin:0;padding0"/></td>
		<td ></td>
	</tr>
	<tr>
		<td style="width:80px;"></td>
		<td style="width:80px;"></td>
		<td style="width:80px;"></td>
		<td style="width:80px;"></td>
		<td style="width:80px;"></td>
		<td style="width:80px;"></td>
		<td style="width:80px;"></td>
		<td style="width:80px;"></td>
		<td style="width:80px;"></td>
		<td style="width:80px;"></td>
	</tr>
	<tr>
		<th style="height:30px; line-height:30px; border-top:2px solid #000;border-left:2px solid #000;">차수</th>
		<td colspan="9" style="border-left:1px solid #000;border-top:2px solid #000;border-right:2px solid #000"><?php echo $parent['m_gubun']?></td>
	</tr>
	<tr>
		<th style="height:30px; line-height:30px; border-top:1px solid #000;border-left:2px solid #000;">일시</th>
		<td colspan="9" style="border-left:1px solid #000;border-top:1px solid #000;border-right:2px solid #000"><?php echo $parent['m_date']?></td>
	</tr>
	<tr>
		<th style="height:30px; line-height:30px; border-top:1px solid #000;border-left:2px solid #000;">장소</th>
		<td colspan="4" style="border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000"><?php echo $parent['m_place']?></td>
		<th style="height:30px; line-height:30px; border-top:1px solid #000;border-left:1px solid #000;">기록</th>
		<td colspan="4" style="border-left:1px solid #000;border-top:1px solid #000;border-right:2px solid #000"><?php echo $parent['m_record']?></td>
	</tr>
	<tr>
		<th style="height:30px; line-height:30px; border-top:1px solid #000;border-left:2px solid #000;">내용</th>
		<td colspan="9" style="border-left:1px solid #000;border-top:1px solid #000;border-right:2px solid #000"><?php echo $parent['m_memo']?></td>
	</tr>
	<tr>
		<th style="height:30px; line-height:30px; border-top:1px solid #000;border-left:2px solid #000;border-bottom:2px solid #000">참석대상</th>
		<td colspan="9" style="border-left:1px solid #000;border-top:1px solid #000;border-right:2px solid #000;border-bottom:2px solid #000"><?php echo $parent['m_member']?></td>
	</tr>
	<tr>
		<td colspan="10"></td>
	</tr>
	<tr>
		<td colspan="4" style="height:30px;line-height:30px;background:#D0EAED;text-align:center;padding:0;"><div style="border:1px solid #000">부서별 전달사항</div></td>
		<td colspan="6" style="border-top:0;">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="10"></td>
	</tr>
	<tr>
		<th colspan="3" style="height:30xp;border:1px solid #000;">구분</th>
		<td colspan="7" style="text-align:center;border:1px solid #000;">업무내용</td>
	</tr>
	<?php 
	if($_GET['idx']<165){
	?>
	<tr>
		<th rowspan="5" style="border:1px solid #000;">교<br/>무<br/>처</th>
		<th colspan="2" style="height:30px;border:1px solid #000;">교원인사/학술/전공심화과정</td>
		<td colspan="7" style="border:1px solid #000;">
			<?php 
				echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][1])))?>
		</td>
	</tr>
	<!--tr>
		<th colspan="2" style="height:30px;border:1px solid #000;">전공심화과정</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][2])))?></td>
	</tr-->
	<tr>
		<th colspan="2" style="height:30px;border:1px solid #000;">학적</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][3])))?></td>
	</tr>
	<tr>
		<th colspan="2" style="height:30px;border:1px solid #000;">수업/교무</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][4])))?></td>
	</tr>
	<tr>
		<th colspan="2" style="height:30px;border:1px solid #000;">교수학습지원센터</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][5])))?></td>
	</tr>
	<!--tr>
		<th colspan="2" style="height:30px;border:1px solid #000;">원격교육지원센터</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][39])))?></td>
	</tr>
	<tr>
		<th colspan="2" style="height:30px;border:1px solid #000;">창의교양요육센터</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][38])))?></td>
	</tr-->
	<tr>
		<th colspan="2" style="height:30px;border:1px solid #000;">교육혁신지원센터</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][6])))?></td>
	</tr>
	<tr>
		<th style="border:1px solid #000;" rowspan="3">입<br/>학<br/>처</th>
		<th colspan="2" style="height:30px;border:1px solid #000;">일반</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][7])))?></td>
	</tr>

	<tr>
		<th colspan="2" style="height:30px;border:1px solid #000;">입시홍보</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br($result['m_content'][42])?></td>
	</tr>

	<!--tr>
		<th colspan="2" style="height:30px;border:1px solid #000;">입시일반</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][42])))?></td>
	</tr-->
	<tr>
		<th colspan="2" style="height:30px;border:1px solid #000;">혁신지원사업</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][41])))?></td>
	</tr>
	<tr>
		<th rowspan="9" style="border:1px solid #000;">학<br/>생<br/>처</th>
		<th colspan="2" style="height:30px;border:1px solid #000;">장학</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][8])))?></td>
	</tr>
	<tr>
		<th colspan="2" style="height:30px;border:1px solid #000;">학생</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][9])))?></td>
	</tr>
    <tr>
        <th colspan="2" style="height:30px;border:1px solid #000;">생활관</td>
        <td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][53])))?></td>
    </tr>
    <tr>
        <th colspan="2" style="height:30px;border:1px solid #000;">피트니스 센터</td>
        <td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][54])))?></td>
    </tr>
	<!--tr>
		<th colspan="2" style="height:30px;border:1px solid #000;">국제개발협력센터</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br($result['m_content'][12])?></td>
	</tr-->
    <tr>
        <th colspan="2" style="height:30px;border:1px solid #000;">보건실</td>
        <td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][36])))?></td>
    </tr>
    
    <tr>
        <th colspan="2" style="height:30px;border:1px solid #000;">학생상담센터</td>
        <td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][50])))?></td>
    </tr>
	<tr>
        <th colspan="2" style="height:30px;border:1px solid #000;">인권센터</td>
        <td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][50])))?></td>
    </tr>
	<tr>
		<th colspan="2" style="height:30px;border:1px solid #000;">사회공헌센터</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][11])))?></td>
	</tr>
	<tr>
		<th colspan="2" style="height:30px;border:1px solid #000;">장애학생지원센터</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][44])))?></td>
	</tr>
	<tr>
		<th rowspan="3" style="border:1px solid #000;">기<br/>획<br/>처</th>
		<th colspan="2" style="height:30px;border:1px solid #000;">기획,인사</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][13])))?></td>
	</tr>
	<!--tr>
		<th colspan="2" style="height:30px;border:1px solid #000;">일상회복지원팀</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br($result['m_content'][10])?></td>
	</tr>
	<tr>
		<th colspan="2" style="height:30px;border:1px solid #000;">인권센터</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br($result['m_content'][36])?></td>
	</tr>

	<tr>
		<th colspan="2" style="height:30px;border:1px solid #000;">인사</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br($result['m_content'][14])?></td>
	</tr-->
	<tr>
		<th colspan="2" style="height:30px;border:1px solid #000;">입시홍보</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][15])))?></td>
	</tr>
	<tr>
		<th colspan="2" style="height:30px;border:1px solid #000;">IR성과관리센터</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][16])))?></td>
	</tr>
	<!--tr>
		<th colspan="2" style="height:30px;border:1px solid #000;">글로벌센터</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br($result['m_content'][17])?></td>
	</tr-->
	<tr>
		<th style="border:1px solid #000;">행정처</th>
		<th colspan="2" style="height:30px;border:1px solid #000;">-</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][18])))?></td>
	</tr>
	<tr>
		<th rowspan="8" style="border:1px solid #000;">산<br/>학<br/>협<br/>력<br />(처)<br />단</th>
		<th colspan="2" style="height:30px;border:1px solid #000;">본부</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][19])))?></td>
	</tr>
	<!--tr>
		<th colspan="2" style="height:30px;border:1px solid #000;">LINC 3.0사업단</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][21])))?></td>
	</tr-->
	<tr>
		<th colspan="2" style="height:30px;border:1px solid #000;">현장실습지원센터</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][22])))?></td>
	</tr>
	<tr>
		<th colspan="2" style="height:30px;border:1px solid #000;">취창업진로지원센터</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][23])))?></td>
	</tr>
	<!--tr>
		<th colspan="2" style="height:30px;border:1px solid #000;">다목적시뮬레이션센터</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][24])))?></td>
	</tr-->
	<tr>
		<th colspan="2" style="height:30px;border:1px solid #000;">임상시뮬레이션센터</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][25])))?></td>
	</tr>
	<tr>
		<th colspan="2" style="height:30px;border:1px solid #000;">기업협업지원센터</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][26])))?></td>
	</tr>
	<tr>
		<th colspan="2" style="height:30px;border:1px solid #000;">건강안전 지원센터</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][46])))?></td>
	</tr>
	<tr>
		<th colspan="2" style="height:30px;border:1px solid #000;">수목진단센터</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][47])))?></td>
	</tr>
	<tr>
		<th colspan="2" style="height:30px;border:1px solid #000;">늘돌봄 지원센터</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][48])))?></td>
	</tr>

	<tr>
		<th colspan="3" style="border:1px solid #000;">혁신지원사업단</th>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][20])))?></td>
	</tr>
	<!--tr>
		<th colspan="3" style="border:1px solid #000;">고득직업교육거점지구사업(HiVE)단</th>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][43])))?></td>
	</tr-->
	<tr>
		<th style="border:1px solid #000;">도서관</th>
		<th colspan="2" style="height:30px;border:1px solid #000;">-</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][34])))?></td>
	</tr>
	<!--tr>
        <th colspan="2" style="height:30px;border:1px solid #000;">인권센터</td>
		<th colspan="2" style="height:30px;border:1px solid #000;">-</td>
        <td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][36])))?></td>
    </tr-->
	<tr>
		<th rowspan="<?php if ( $_GET["idx"] > 133 ) {echo "5";}else{echo "5";}?>" style="border:1px solid #000;">평<br/>생<br/>교<br/>육<br />원</th>
		<th colspan="2" style="height:30px;border:1px solid #000;">울주군사업</td>
		<td colspan="7" style="border:1px solid #000;">
			<?php 
				$content = $result['m_content'][29];
				$content = str_replace("<","(",$content);
				$content = str_replace(">",")",$content);
				echo nl2br($content);
				//echo nl2br(str_replace("(","<",$result['m_content'][29]))?></td>
	</tr>
	<!--tr>
		<th colspan="2" style="height:30px;border:1px solid #000;">로컬크리에이터 2급 교육 시범사업(혁신지원사업)</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br($result['m_content'][45])?></td>
	</tr-->
	<!--tr>
		<th colspan="2" style="height:30px;border:1px solid #000;">교육청 사업<br />(학교안전부장연수)</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br($result['m_content'][45])?></td>
	</tr-->
    <!--
	<tr>
		<th colspan="2" style="height:30px;border:1px solid #000;">평생교육 실습 사업</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br($result['m_content'][30])?></td>
	</tr>
    -->
    <?
    // 20204.02.17 이후 변경내용 적용 :: 순서변경 및 신규항목 추가
    if ( $_GET["idx"] > 133 ) {
    ?>
        <tr>
            <th colspan="2" style="height:30px;border:1px solid #000;">LiFE 2.0 사업(성인학습자지원센터)</td>
            <td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][28])))?></td>
        </tr>
        <tr>
            <th colspan="2" style="height:30px;border:1px solid #000;">울산연구원 사업(평생교육연구실)</td>
            <td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][27])))?></td>
        </tr>
        <tr>
            <th colspan="2" style="height:30px;border:1px solid #000;">심장초음파 연수과정(대한방사선사협회)</td>
            <td colspan="7" style="border:1px solid #000;"><?php echo nl2br($result['m_content'][52])?></td>
        </tr>
    <? } else { ?>
        <tr>
            <th colspan="2" style="height:30px;border:1px solid #000;">울산연구원 사업(인재평생교육센터)</td>
            <td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][27])))?></td>
        </tr>
        <tr>
            <th colspan="2" style="height:30px;border:1px solid #000;">LiFE 2.0 사업(성인학습자지원센터)</td>
            <td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][28])))?></td>
        </tr>
        <tr>
            <th colspan="2" style="height:30px;border:1px solid #000;">울산광역시 교육청 사업</td>
            <td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][51])))?></td>
        </tr>
    <? } ?>
	<tr>
		<th colspan="2" style="height:30px;border:1px solid #000;">일반업무</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][31])))?></td>
	</tr>

	<tr>
		<th style="border:1px solid #000;">정보전산원</th>
		<th colspan="2" style="height:30px;border:1px solid #000;">-</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][32])))?></td>
	</tr>
	<!--tr>
		<th colspan="2" style="height:30px;border:1px solid #000;">빅데이터센터</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][33])))?></td>
	</tr-->
	<tr>
		<th rowspan="3" style="border:1px solid #000;">국제교류원</th>
		<th colspan="2" style="height:30px;border:1px solid #000;">공통</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][49])))?></td>
	</tr>
	<tr>
		<th colspan="2" style="height:30px;border:1px solid #000;">국제개발협력센터</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][12])))?></td>
	</tr>
	<tr>
		<th colspan="2" style="height:30px;border:1px solid #000;">글로벌센터</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][17])))?></td>
	</tr>

	<!--tr>
		<th style="border:1px solid #000;">학생<br/>상담<br />연구소</th>
		<th colspan="2" style="height:30px;border:1px solid #000;">-</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br($result['m_content'][35])?></td>
	</tr>
	<tr>
		<th style="border:1px solid #000;">인권<br/>센터</th>
		<th colspan="2" style="height:30px;border:1px solid #000;">-</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br($result['m_content'][36])?></td>
	</tr-->
	<tr>
		<th style="border:1px solid #000;">기타</th>
		<th colspan="2" style="height:30px;border:1px solid #000;">생명윤리위원회</td>
		<td colspan="7" style="border:1px solid #000;"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$result['m_content'][37])))?></td>
	</tr>
	<?php 
		}else{ 
		include "meeting_xls_202501.php";
		} 
	?>
	<tr>
		<td colspan="10"></td>
	</tr>
	<tr>
		<td colspan="4" style="height:30px;line-height:30px;background:#D0EAED;text-align:center;padding:0;"><div style="border:1px solid #000">학과별 주간행사</div></td>
		<td colspan="6" style="border-top:0;">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="10"></td>
	</tr>
	<tr>
		<th colspan="2" style="border:1px solid #000;">구분</th>
<!--
		<th colspan="2" style="height:30px;border:1px solid #000;">지난 주 학과행사</td>
		<th colspan="3" style="height:30px;border:1px solid #000;">이번 주 학과행사</td>
		<th colspan="3" style="height:30px;border:1px solid #000;">다음 주 학과행사</td>
-->
		<th colspan="8" style="height:30px;border:1px solid #000;">학과 주간행사 및 부서업무 내용</td>
	</tr>
	<?php
	$part2_member_sql = "SELECT * FROM teamjang_meeting_member where m_part_gubun='2' order By idx asc";
	$part2_member_res = mysql_query($part2_member_sql);
	$num = 32;
	WHILE($part2_member=mysql_fetch_array($part2_member_res)){
	    // 2024.02.17 이후, 사회복지과 제외
	    if ( $_GET["idx"] > 133 && $part2_member["idx"] == 22 ) continue;
		$part2_member_data = $part2_member['m_member'];
		$part2_member_data_array = explode(",",$part2_member_data);
		$part_data = mysql_fetch_array(mysql_query("SELECT * FROM teamjang_meeting_class_content_new WHERE m_idx='{$_GET['idx']}' and m_part='{$part2_member['m_part']}'"));
	?>
	
<!--
		<tr height="34" bgcolor="FAFAFA">
			<th rowspan="3" style="border:1px solid #000"><?php echo $part2_member['m_part']?></th>
			<th style="border:1px solid #000">지난 주<br />학과행사</th>
			<td colspan="8" style="height:100;padding:5px;border:1px solid #000"><?php echo nl2br($part_data['m_content_past'])?></td>
		</tr>
			<?
				$num++;
			?>
		
-->
		<tr height="34" bgcolor="FAFAFA">
			<th rowspan="2" style="border:1px solid #000"><?php echo $part2_member['m_part']?></th>
			<th style="border:1px solid #000">이번 주<br />학과행사</th>
			<td colspan="8" style="height:100;padding:5px;border:1px solid #000"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$part_data['m_content_this'])))?></td>
			<?
				$num++;
			?>
		</tr>
		<tr height="34" bgcolor="FAFAFA">
			<th style="border:1px solid #000">다음 주<br />학과행사</th>
			<td colspan="8" style="height:100;padding:5px;border:1px solid #000"><?php echo nl2br(str_replace("<","(",str_replace(">",")",$part_data['m_content_next'])))?></td>
			<?
				$num++;
			?>
		</tr>
	<?php
	}
	?>
</table>
