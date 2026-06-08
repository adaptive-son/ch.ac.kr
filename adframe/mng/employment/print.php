<?
// adframe 공통 인클루드 파일
define("__AF__", TRUE);
// adframe 공통 인클루드 파일
include_once(dirname(__FILE__) . "/../../af_common.php");
// 접속로그
include_once( dirname(__FILE__)."/lib/log.access.forPrivate.php" );
if($wr_id != ""){
    $sql1 = " select * from employment where wr_id = '$wr_id' ";

    $row = mysql_fetch_array(mysql_query($sql1));
}
?>
<link rel="stylesheet" href="../admin.css">
<script type="text/javascript">
    function GPEN_PRINT(wr_id){
        var p = window.open("./print.php?wr_id="+wr_id,"PrintWin","width=800, height=700, scrollbars=yes");
        p.focus();
    }
</script>
<style type="text/css">
    .table_box_recruit{width:100%;}
    .table_box_recruit th {background-color:#2da5e1; font-weight:bold; color:#fff; padding:10px 0px 10px 0px;border:1px solid #ddd;text-align:center;-webkit-print-color-adjust:exact;}
    .table_box_recruit thead .line_none th {border-top-color:#DDD;}
    .table_box_recruit tfoot td, .table_basic tfoot th{font-weight:bold; color:#666; text-align:center;}
    .table_box_recruit tfoot th {font-weight:bold;background:#f7f7f7; border:1px solid #ddd; text-align:center; padding-bottom:3px; padding-top:3px;}
    .table_box_recruit td, .table_basic tbody th, .table_basic tfoot th {border:1px solid #ddd; text-align:center; padding-bottom:3px; padding-top:3px; font-size:12px}
    .table_box_recruit .left {text-align:left;padding-left:10px}
    .table_box_recruit .t_line {border-top:1px solid #485f8a;}
    .table_box_recruit .bgreen{background-color:#edfbfd;}
    .table_box_recruit .bviolet{background-color:#f8edfd;}
    .table_box_recruit .borange{background-color:#ffe8d6;}
    .table_box_recruit .fbdatan{color:#c77421;font-weight:bold;}
    .table_box_recruit tbody th{border: 1px solid #ddd; background: #2DA5E1; color: #fff; font-weight: bold; text-align: center;}
    .table_box_recruit .sub_title{text-align:left;padding:10px; }
    .table_box_recruit input{border:1px solid #DFDFDF;height:25px; line-height:25px;}
    .table_box_recruit select{border:1px solid #DFDFDF; width:150px; height:25px; line-height:25px; }
    .table_box_recruit input[type="radio"]{border:none; vertical-align:middle;margin-top:-4px;}
    .table_box_recruit input[type="button"]{background:#2da5e1; padding:0px 10px; color:#FFFFFF;}
</style>
<SCRIPT LANGUAGE="JavaScript">
    <!--

	print();
    -->
</SCRIPT>

<font color="#616161"><h4>채용지원서 관리</h4></font>
<table width="1000" class="table_box_recruit">
    <colgroup>
        <col width="125px">
        <col width="125px">
        <col width="100px">
        <col width="125px">
        <col width="125px">
        <col width="125px">
        <col width="125px">
        <col width="150px">
    </colgroup>
    <tr>											
		<th>지원부서</th>
		<td colspan="3" class="left">
		   <?php echo $row['department']?>
		</td>

		<th>입사구분</th>
		<td colspan="3" class="left">
			<?php 
				if($row['careerYN']=="N"){echo "신입";}
				else{echo "경력";}
			?> 
		</td>
	</tr>
	<tr>
		<td colspan="2" rowspan="5"><?if($row[file_name]){?><img id="img_preview" src="<?=$row[file_name]?>" width="150px"/><?}else{?>사진<br />(3cm X 4cm)<br />아래의 찾아보기로 사진을 추가하세요.<img id="img_preview" style="display:none;" width="150px"/><?}?></td>
		<th>성명</th>
		<td class="left" colspan="2">
			[국문]<br />
			<?=$row['kor_name']?>
		</td>
		<td class="left" colspan="2">
			[영문]<br />
			<?=$row['eng_name']?>
		</td>
		<td class="left">
			[한문]<br />
			<?=$row['chi_name']?>
		</td>
	</tr>
	<tr>
		<th>주소</th>
		<td colspan="5" class="left">
			<div >
				(우편번호 :
					<?=$row[zonecode]?>
				)</div>
			<div style="padding-top:5px;"><?=$row[addr1]?></div>
			<div style="padding-top:5px;"><?=$row[addr2]?></div>
		</td>
	</tr>
	<tr>
		<th>전화번호</th>
		<td colspan="2"><?php echo $row['hTel']?></td>
		<th>휴대폰</th>
		<td colspan="3"><?php echo $row['phone']?></td>
	</tr>
	<tr>
		<th>생년월일</th>
		<td colspan="2">
			<?=$row['birth']?>&nbsp;&nbsp;
			(만 <?=$row[age]?> 세)
		</td>
		<th >이메일</th>
		<td colspan="3">                                                
			<?=$row[email]?>
		</td>
	</tr>
	<tr>
		<th>성별</th>
		<td colspan="2">
			<?php echo $row['sex']?>
		</td>
		<th>비상연락처</th>
		<td colspan="2"><?php echo $row['jTel']?></td>
	</tr>
</table>
<table class="table_box_recruit" style="margin-top:10px;">
	<colgroup>
		<col width="80px">
		<col width="200px">
		<col width="*">
		<col width="125px">
		<col width="125px">
		<col width="125px">
	</colgroup>
	<tr>
		<th rowspan="5">학력</th>
		<th>기간</th>
		<th>학교명</th>
		<th>전공분야</th>
		<th>성적</th>
		<th>평균평점</th>
	 </tr>
		<tr>
			<td><?=$row['hPeriod1']?> ~ <?=$row['hPeriod2']?></td>
			<td style="text-align:left"><?=$row[hSchool]?> &nbsp;고등학교(졸업)</td>
			<td>-</td>
			<td>-</td>
			<td>-</td>
		</tr>
		<tr>
			<td>
				<?=$row['cPeriod1']?> ~ <?=$row['cPeriod2']?> 
			</td>
			<td style="text-align:left">
				<?=$row['colleage']?> &nbsp;대학(<?php if($row['cEndYN']=="N"){echo "중퇴";}else if($row['cEndYN']=="F"){echo "졸업예정";}else if($row['cEndYN']=="Y"){echo "졸업";}?>)
			</td>
			<td>
				<?=$row[cMajor]?>
			</td>
			<td>
				<?=$row[cScore]?> / <?=$row[cTotal]?>
			</td>
			<td>
				<?=$row[cDegree]?>
			</td>
			
		</tr>
		<tr>
			<td >
				<?=$row['uPeriod1']?> ~ <?=$row['uPeriod2']?>
			</td>
			<td style="text-align:left">
				<?=$row[univ]?> &nbsp;대학교(<?php if($row['uEndYN']=="N"){echo "중퇴";}else if($row['uEndYN']=="F"){echo "졸업예정";}else if($row['uEndYN']=="Y"){echo "졸업";}?>)
			</td>
			<td>
				<?=$row[uMajor]?>
			</td>
			<td>
				<?=$row[uScore]?> / <?=$row[uTotal]?>
			</td>
			<td>
				<?=$row[uDegree]?>
			</td>
			
		</tr>
		<tr>
			<td>
				<?=$row['mPeriod1']?> ~ <?=$row['mPeriod2']?>
			</td>
			<td style="text-align:left">
				<?=$row[master]?>
			</td>
			<td>
				<?=$row[mMajor]?>
			</td>
			<td>
				<?=$row[mScore]?> / <?=$row[mTotal]?>
			</td>
			<td>
				<?=$row[mDegree]?>
			</td>												
		</tr>
</table>
<table class="table_box_recruit" style="margin-top:10px;">
	<colgroup>
		<col width="80px" />
		<col width="*" />
		<col width="150px" />
		<col width="250px" />
	</colgroup>
	<tr>
		<th rowspan="7">자격 및 면허</th>
		<th>자격&middot;면허명</th>
		<th>취득년월일</th>
		<th>발행기관</th>
	</tr>
	<tr>
		<td><?=$row[etc1]?>&nbsp;</td>
		<td><?=$row[etc1_date]?></td>
		<td><?=$row[etc1_company]?></td>
	</tr>
	<tr>
		<td><?=$row[etc2]?>&nbsp;</td>
		<td><?=$row[etc2_date]?></td>
		<td><?=$row[etc2_company]?></td>
	</tr>
	<tr>
		<td><?=$row[etc3]?>&nbsp;</td>
		<td><?=$row[etc3_date]?></td>
		<td><?=$row[etc3_company]?></td>
	</tr>
	<tr>
		<td><?=$row[etc4]?>&nbsp;</td>
		<td><?=$row[etc4_date]?></td>
		<td><?=$row[etc4_company]?></td>
	</tr>
	<tr>
		<td><?=$row[etc5]?>&nbsp;</td>
		<td><?=$row[etc5_date]?></td>
		<td><?=$row[etc5_company]?></td>
	</tr>
	<tr>
		<td><?=$row[etc6]?>&nbsp;</td>
		<td><?=$row[etc6_date]?></td>
		<td><?=$row[etc6_company]?></td>
	</tr>
</table>
<table class="table_box_recruit" style="margin-top:10px;">
	<colgroup>
		<col width="80px" />
		<col width="*" />
		<col width="120px" />
		<col width="120px" />
		<col width="120px" />
		<col width="200px" />
	</colgroup>
	<tr>
		<th rowspan="3">외국어 및 특기사항</th>
		<th>종류</th>
		<th>등급</th>
		<th>점수</th>
		<th>취득일</th>
		<th>발급기관</th>
	</tr>
	<tr>
		<td><?=$row['specialty1']?>&nbsp;</td>
		<td><?=$row['specialty1_degree']?></td>
		<td><?=$row['specialty1_score']?></td>
		<td><?=$row['specialty1_date']?></td>
		<td><?=$row['specialty1_nm']?></td>
	</tr>
	<tr>
		<td><?=$row['specialty2']?>&nbsp;</td>
		<td><?=$row['specialty2_degree']?></td>
		<td><?=$row['specialty2_score']?></td>
		<td><?=$row['specialty2_date']?></td>
		<td><?=$row['specialty2_nm']?></td>
	</tr>
</table>
<table class="table_box_recruit" style="margin-top:10px;">
	<colgroup>
		<col width="80px" />
		<col width="10%" />
		<col width="10%" />
		<col width="10%" />
		<col width="10%" />
		<col width="*" />
		<col width="11%" />
		<col width="*" />
		<col width="*" />
	</colgroup>
	<tr>
		<th rowspan="5">병역<br />&middot;<br />장애<br />&middot;<br />보훈</th>
		<th rowspan="2">취업지원<br />대상자여부</th>
		<td rowspan="2" colspan="2">
			<?php
			if($row['veteransYN']=="Y"){
				echo "보훈";
			}else if($row['veteransYN']=="N"){
				echo "비보훈";
			}
			?>&nbsp;
		</td>
		<th rowspan="2">보훈번호</th>
		<td rowspan="2">
			<?php echo $row['veterans_no']?>
		</td>
		<th>
			병역(군별)
		</th>
		<td colspan="2">
			<?php echo $row['army_type']?>
		</td>
	</tr>
	<tr>
		<th>계급 및 병과</th>
		<td colspan="2"><?php echo $row['army_rank']?></td>
	</tr>
	<tr>
		<th rowspan="2">장애여부</th>
		<th>장애종별</th>
		<th>장애정도</th>
		<th rowspan="2">장애인등록번호</th>
		<td rowspan="2">
			<?php echo $row['disabled_no']?>
		</td>
		<th rowspan="2">복무기간</th>
		<td rowspan="2" colspan="2">
			<?php echo $row['army_start']?>
			~ 
			<?php echo $row['army_end']?>&nbsp;&nbsp;&nbsp;&nbsp;
			(<?php echo $row['army_service_month']?>&nbsp;개월)
		</td>
	</tr>
	<tr>
		<td><?php echo $row['disabled_type']?>&nbsp;</td>
		<td><?php echo $row['disabled_degree']?></td>
	</tr>
	<tr>
		<th>저소득층<br />여부</th>
		<td colspan="2">
			<?php if($row['low_incomeYN']=="Y"){echo "대상";}else if($row['low_incomeYN']=="N"){echo "비대상";}?>
		</td>
		<th colspan="2">국민기초생활보장법 수급자 </th>
		<td><input type="checkbox" name="basic_living" value="Y" <?php if($row['basic_living']=="Y"){echo "checked";}?> disabled/></td>
		<th >한부모가족지원법<br />보호대상자</th>
		<td><input type="checkbox" name="one_parent" value="Y" <?php if($row['one_parent']=="Y"){echo "checked";}?> disabled/></td>
	</tr>
</table>
<table class="table_box_recruit" style="margin-top:10px;">
	<colgroup>
		<col width="80px" />
		<col width="*" />
		<col width="120px" />
		<col width="100px" />
		<col width="100px" />
		<col width="150px" />
		<col width="150px" />
	</colgroup>
	<tr>
		<th rowspan="4">주요<br />경력<br/>사항</th>
		<th>근무기간</th>
		<th>회사명</th>
		<th>부서</th>
		<th>직위/직급</th>
		<th>담당업무<br />(구체적으로기술)</th>
		<th>퇴직사유</th>
	</tr>
	<tr>
		<td>
			<?=$row['jobStart1']?>
			~ 
			<?=$row['jobEnd1']?>
			(<?=$row['jobYear1']?>&nbsp;년&nbsp;&nbsp;<?=$row['jobMonth1']?>&nbsp;월)
		</td>
		<td><?=$row['jobCompany1']?> </td>
		<td><?=$row['jobDepartment1']?></td>
		<td><?=$row['jobDegree1']?></td>
		<td><?=$row['jobWork1']?></td>
		<td><?=$row['retirement1']?></td>
	</tr>
	<tr>
		<td>
			<?=$row['jobStart2']?>
			~ 
			<?=$row['jobEnd2']?>
			(<?=$row['jobYear2']?>&nbsp;년&nbsp;&nbsp;<?=$row['jobMonth2']?>&nbsp;월)
		</td>
		<td><?=$row['jobCompany2']?> </td>
		<td><?=$row['jobDepartment2']?></td>
		<td><?=$row['jobDegree2']?></td>
		<td><?=$row['jobWork2']?></td>
		<td><?=$row['retirement2']?></td>
	</tr>
	<tr>
		<td>
			<?=$row['jobStart3']?>
			~ 
			<?=$row['jobEnd3']?>
			(<?=$row['jobYear3']?>&nbsp;년&nbsp;&nbsp;<?=$row['jobMonth3']?>&nbsp;월)
		</td>
		<td><?=$row['jobCompany3']?> </td>
		<td><?=$row['jobDepartment3']?></td>
		<td><?=$row['jobDegree3']?></td>
		<td><?=$row['jobWork3']?></td>
		<td><?=$row['retirement3']?></td>
	</tr>
</table>

<table class="table_box_recruit" style="margin-top:10px;">
	<tr>
		<th>자기소개서</th>
	</tr>
	<tr>
		<td style="text-align:left"><?=nl2br($row['memo1'])?></td>
	</tr>
	<tr>
		<th>자신의 생활신념, 좌우명 및 성격의 장&middot;단점</th>
	</tr>
	<tr>
		<td style="text-align:left"><?=nl2br($row['memo2'])?></td>
	</tr>
	<tr>
		<th>자신이 생각하고 있는 대인관계</th>
	</tr>
	<tr>
		<td style="text-align:left"><?=nl2br($row['memo3'])?></td>
	</tr>
	<tr>
		<th>입사지원동기와 입사 후 포부</th>
	</tr>
	<tr>
		<td style="text-align:left"><?=nl2br($row['memo4'])?></td>
	</tr>
	<tr>
		<th>입사 후 희망업무와 그 선택 이유</th>
	</tr>
	<tr>
		<td style="text-align:left"<?=nl2br($row['memo5'])?></td>
	</tr>
	<tr>
		<th>지원부서(업무) 수행을 위한 숙련도 및 수행능력 등</th>
	</tr>
	<tr>
		<td style="text-align:left"><?=nl2br($row['memo6'])?></td>
	</tr>
	<tr>
		<th>기타 자기 자신을 구체적으로 소개할 수 잇는 내용을 자유롭게 기술</th>
	</tr>
	<tr>
		<td style="text-align:left"><?=nl2br($row['memo7'])?></td>
	</tr>
</table>
