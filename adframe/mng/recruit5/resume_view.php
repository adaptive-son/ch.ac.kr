<?
// adframe 공통 인클루드 파일
include_once "../_common.php";
// 접속로그
include_once( dirname(__FILE__)."/../recruit/lib/log.access.forPrivate.php" );
// 개인정보 접근로그
if ( $pgidx > 0 ) log_Access_ForPrivate("recruit2-appinfo-view");

if($wr_id != ""){
    $sql = " select * from recruit_copy_research where wr_id = '$wr_id' ";
    $row = mysql_fetch_array(mysql_query($sql));

    $date = mysql_fetch_array(mysql_query("select * from recruit_bi1 WHERe parent='$row[wr_id]'"));
}
?>
<link rel="stylesheet" href="../admin.css">
<style>
    .font_s01 {font-family: 돋움;font-size:13px;color:#ffffff;font-weight:bold;}
    .btn1	  {padding-top:3px;}
</style>
<script type="text/javascript">
    function GPEN_PRINT(wr_id){
        var p = window.open("./print.php?wr_id="+wr_id,"PrintWin","width=800, height=700, scrollbars=yes");
        p.focus();
    }
</script>
<style type="text/css">
    .table_box_recruit{width:100%;}
    .table_box_recruit th {background-color:#2da5e1; font-weight:bold; color:#fff; padding:10px 0px 10px 0px;border:1px solid #ddd;text-align:center;}
    .table_box_recruit thead .line_none th {border-top-color:#DDD;}
    .table_box_recruit tfoot td, .table_basic tfoot th{font-weight:bold; color:#000; text-align:center;}
    .table_box_recruit tfoot th {font-weight:bold;background:#f7f7f7; border:1px solid #ddd; text-align:center; padding-bottom:3px; padding-top:3px;}
    .table_box_recruit td, .table_basic tbody th, .table_basic tfoot th {border:1px solid #ddd; text-align:center; padding-bottom:3px; padding-top:3px; font-size:12px}
    .table_box_recruit .left {text-align:left;padding-left:10px}
    .table_box_recruit .t_line {border-top:1px solid #485f8a;}
    .table_box_recruit .bgreen{background-color:#edfbfd;}
    .table_box_recruit .bviolet{background-color:#f8edfd;}
    .table_box_recruit .borange{background-color:#ffe8d6;}
    .table_box_recruit .fbrown{color:#c77421;font-weight:bold;}
    .table_box_recruit tbody th{border: 1px solid #ddd; background: #2DA5E1; color: #fff; font-weight: bold; text-align: center;}
    .table_box_recruit .sub_title{text-align:left;padding:10px; }
    .table_box_recruit input{border:1px solid #DFDFDF;height:25px; line-height:25px;}
    .table_box_recruit select{border:1px solid #DFDFDF; width:150px; height:25px; line-height:25px; }
    .table_box_recruit input[type="radio"]{border:none; vertical-align:middle;margin-top:-4px;}
    .table_box_recruit input[type="button"]{background:#2da5e1; padding:0px 10px; color:#FFFFFF;}
</style>
<font color="#616161"><h4>교원채용관리</h4></font>
<p><input type="button" value="인쇄" style="padding:10px 20px; border:0; background:#f53d3d;font-weight:bold;color:#FFFFFF;cursor:pointer" onclick="GPEN_PRINT(<?=$wr_id?>)"/></p>
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
        <td colspan="8" class="sub_title" style="text-align:left;padding-left:10px;">접수번호 : <?=$row['apply_num']?></td>
    </tr>
    <tr>
        <td colspan="6" class="sub_title">1.지원사항</td>
        <td colspan="2" rowspan="5"><?if($row[file_name]){?><img id="img_preview" src="<?=$row[file_name]?>" height="200px"/><?}?></td>
    </tr>
    <tr>
        <th>지원학과</th>
        <td colspan="2" class="left">
            <?=$row[apply_major]?>
        </td>
        <th>초빙분야</th>
        <td colspan="2" class="left">
            <?=$date[type_gubun]?>
        </td>
    </tr>
    <tr>
        <th>전공분야</th>
        <td colspan="2" class="left"><?=$row[major]?></td>
        <th>지원구분</th>
        <td colspan="2" class="left"><?=$row[gubun]?></td>
    </tr>
    <tr>
        <th>성명</th>
        <td class="left" colspan="2">
            [국문]<br />
            <?=$row[kor_name]?>
        </td>
        <td class="left" colspan="2">
            [영문]<br />
            <?=$row[eng_name]?>
        </td>
        <td class="left">
            [한문]<br />
            <?=$row[chi_name]?>
        </td>
    </tr>
    <tr>
        <td colspan="6" class="sub_title">2.인적사항사항</td>
    </tr>
    <tr>
        <th>성별</th>
        <td><?=$row[sex]?></td>
        <th>국적</th>
        <td colspan="3"><?=$row[country]?></td>
        <!--<th>결혼여부</th>
        <td><?/*=$row[married]*/?></td>-->
        <th>병역</th>
        <td><?=$row[army]?></td>
    </tr>
    <?
    $birth = explode("-",$row[birth]);
    ?>
    <tr>
        <th>생년월일</th>
        <td colspan="4"><?=$birth[0]?> 년&nbsp;&nbsp;<?=$birth[1]?> 월&nbsp;&nbsp;<?=$birth[2]?> 일&nbsp;&nbsp;(만<?=$row[age]?> 세)</td>
        <th rowspan="3">연락처</th>
        <td colspan="2" rowspan="3" class="left">
            <div><span style="width:40px;display:inline-block">자택</span> : <?=$row[hTel]?></div>
            <div style="margin-top:5px;"><span style="width:40px; display:inline-block">직장</span> : <?=$row[jTel]?></div>
            <div style="margin-top:5px;"><span style="width:40px; display:inline-block">휴대폰</span> : <?=$row[phone]?></div>
            <div style="margin-top:5px;"><span style="width:40px; display:inline-block">Email</span> : <?=$row[email]?> </div>
        </td>
    </tr>
    <tr>
        <th>현주소<br />(국내연락처)</th>
        <td colspan="4" class="left">
            <div >(우편번호 : <?=$row[zip]?>)</div>
            <div style="padding-top:5px;"><?=$row[addr1]?></div>
            <div style="padding-top:5px;"><?=$row[addr2]?></div>
        </td>
    </tr>
    <tr>
        <th>현근무지</th>
        <td colspan="2" class="left"><?=$row[company]?></td>
        <th> 직위 </th>
        <td class="left"> <?=$row['company_auth']?> </td>
    </tr>

    <tr>
        <th>은행명</th>
        <td colspan="4" class="left"><?=$row['bank_name']?></td>
        <th>계좌번호</th>
        <td colspan="4" class="left"><?=$row['bank_account']?></td>
    </tr>

    <tr>
        <td colspan="8" class="sub_title">3. 학력사항</td>
    </tr>
    <tr>
        <th>구분</th>
        <th colspan="2">기간</th>
        <th colspan="2">수여기관(학교명)</th>
        <th>전공</th>
        <th>학위명<br/>(학위취득일)</th>
        <th>평균평점</th>
    </tr>

    <tr>
        <th>고등학교</th>
        <td colspan="2"><?=$row[hPeriod]?></td>
        <td colspan="2"><?=$row[hSchool]?></td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
    </tr>
    <tr>
        <th>전문학사1</th>
        <td colspan="2"><?=$row[cPeriod]?></td>
        <td colspan="2"><?=$row[colleage]?></td>
        <td><?=$row[cMajor]?></td>
        <td><?=$row[cDegree]?><br /> (<?=$row[cDegree_date]?>)</td>
        <td><?=$row[cScore]?> / <?=$row[cTotal]?></td>
    </tr>
    <?php
    if($row[colleage1]){
        ?>
        <tr>
            <th>전문학사2</th>
            <td colspan="2"><?=$row[cPeriod1]?></td>
            <td colspan="2"><?=$row[colleage1]?></td>
            <td><?=$row[cMajor1]?></td>
            <td><?=$row[cDegree1]?><br /> (<?=$row[cDegree_date1]?>)</td>
            <td><?=$row[cScore1]?> / <?=$row[cTotal1]?></td>
        </tr>
        <?php
    }
    ?>
    <tr>
        <th>학사1</th>
        <td colspan="2"><?=$row[uPeriod]?></td>
        <td colspan="2"><?=$row[univ]?></td>
        <td><?=$row[uMajor]?></td>
        <td><?=$row[uDegree]?><br /> (<?=$row[uDegree_date]?>)</td>
        <td><?=$row[uScore]?> / <?=$row[uTotal]?></td>
    </tr>
    <?php
    if($row[univ1]){
        ?>
        <tr>
            <th>학사2</th>
            <td colspan="2"><?=$row[uPeriod1]?></td>
            <td colspan="2"><?=$row[univ1]?></td>
            <td><?=$row[uMajor1]?></td>
            <td><?=$row[uDegree1]?><br /> (<?=$row[uDegree_date1]?>)</td>
            <td><?=$row[uScore1]?> / <?=$row[uTotal1]?></td>
        </tr>
        <?php
    }
    ?>

    <tr>
        <th>석사1</th>
        <td colspan="2"><?=$row[mPeriod]?></td>
        <td colspan="2"><?=$row[master]?></td>
        <td><?=$row[mMajor]?></td>
        <td><?=$row[mDegree]?><br /> (<?=$row[mDegree_date]?>)</td>
        <td><?=$row[mScore]?> / <?=$row[mTotal]?></td>
    </tr>
    <?php
    if($row[master1]){
        ?>
        <tr>
            <th>석사2</th>
            <td colspan="2"><?=$row[mPeriod1]?></td>
            <td colspan="2"><?=$row[master1]?></td>
            <td><?=$row[mMajor1]?></td>
            <td><?=$row[mDegree1]?><br /> (<?=$row[mDegree_date1]?>)</td>
            <td><?=$row[mScore1]?> / <?=$row[mTotal1]?></td>
        </tr>
        <?php
    }
    ?>
    <?php
    if($row[doctor]){
        ?>
        <tr>
            <th>박사1</th>
            <td colspan="2"><?=$row[dPeriod]?></td>
            <td colspan="2"><?=$row[doctor]?></td>
            <td><?=$row[dMajor]?></td>
            <td><?=$row[dDegree]?><br /> (<?=$row[dDegree_date]?>)</td>
            <td><?=$row[dScore]?> / <?=$row[dTotal]?></td>
        </tr>
        <?php
    }
    if($row[doctor1]){
        ?>
        <tr>
            <th>박사2</th>
            <td colspan="2"><?=$row[dPeriod1]?></td>
            <td colspan="2"><?=$row[doctor1]?></td>
            <td><?=$row[dMajor1]?></td>
            <td><?=$row[dDegree1]?><br /> (<?=$row[dDegree_date1]?>)</td>
            <td><?=$row[dScore1]?> / <?=$row[dTotal1]?></td>
        </tr>
        <?php
    }
    ?>
    <tr>
        <td colspan="8" class="sub_title">4. 경력사항(경력은 증빙서류를 첨부한 것만 인정됨, 경력증명서는 우편으로 접수 받습니다.)<br />※ 최종 임용될 경우 자격 및 호봉 산출자료로 활용되오니 정확히 작성바랍니다.</td>
    </tr>
    <tr>
        <th colspan="3">기간</th>
        <th colspan="2">근무년월</th>
        <th colspan="2">근무기관명</th>
        <th>직위</th>
    </tr>
    <?
    $jobPeriod1 = explode("-",$row[jobPeriod1]);
    $jobPeriod2 = explode("-",$row[jobPeriod2]);
    $jobPeriod3 = explode("-",$row[jobPeriod3]);
    $jobPeriod4 = explode("-",$row[jobPeriod4]);
    $jobPeriod5 = explode("-",$row[jobPeriod5]);
    $jobPeriod6 = explode("-",$row[jobPeriod6]);
    $jobPeriod7 = explode("-",$row[jobPeriod7]);
    $jobPeriod8 = explode("-",$row[jobPeriod8]);
    $jobPeriod9 = explode("-",$row[jobPeriod9]);
	$jobPeriod10 = explode("-",$row[jobPeriod10]);
	$jobPeriod11 = explode("-",$row[jobPeriod11]);
	$jobPeriod12 = explode("-",$row[jobPeriod12]);
	$jobPeriod13 = explode("-",$row[jobPeriod13]);
	$jobPeriod14 = explode("-",$row[jobPeriod14]);
	$jobPeriod15 = explode("-",$row[jobPeriod15]);

    ?>
    <?php
    if($row[jpsPeriod1]){
        ?>
        <tr>
            <td colspan="3"><?=$row[jpsPeriod1]?> ~ <?=$row[jpePeriod1]?></td>
            <td colspan="2"><?=$jobPeriod1[0]?>&nbsp;년&nbsp;&nbsp;<?=$jobPeriod1[1]?>&nbsp;월</td>
            <td colspan="2"><?=$row[jobCompany1]?> </td>
            <td><?=$row[jobDegree1]?></td>
        </tr>
        <?
    }
    if($row[jpsPeriod2]){
        ?>
        <tr>
            <td colspan="3"><?=$row[jpsPeriod2]?> ~ <?=$row[jpePeriod2]?></td>
            <td colspan="2"><?=$jobPeriod2[0]?>&nbsp;년&nbsp;&nbsp;<?=$jobPeriod2[1]?>&nbsp;월</td>
            <td colspan="2"><?=$row[jobCompany2]?></td>
            <td><?=$row[jobDegree2]?></td>
        </tr>
        <?
    }
    if($row[jpsPeriod3]){
        ?>
        <tr>
            <td colspan="3"><?=$row[jpsPeriod3]?> ~ <?=$row[jpePeriod3]?></td>
            <td colspan="2"><?=$jobPeriod3[0]?>&nbsp;년&nbsp;&nbsp;<?=$jobPeriod3[1]?>&nbsp;월</td>
            <td colspan="2"><?=$row[jobCompany3]?></td>
            <td><?=$row[jobDegree3]?></td>
        </tr>
        <?
    }
    if($row[jpsPeriod4]){
        ?>
        <tr>
            <td colspan="3"><?=$row[jpsPeriod4]?> ~ <?=$row[jpePeriod4]?></td>
            <td colspan="2"><?=$jobPeriod4[0]?>&nbsp;년&nbsp;&nbsp;<?=$jobPeriod4[1]?>&nbsp;월</td>
            <td colspan="2"><?=$row[jobCompany4]?></td>
            <td><?=$row[jobDegree4]?></td>
        </tr>
        <?
    }
    if($row[jpsPeriod5]){
        ?>
        <tr>
            <td colspan="3"><?=$row[jpsPeriod5]?> ~ <?=$row[jpePeriod5]?></td>
            <td colspan="2"><?=$jobPeriod5[0]?>&nbsp;년&nbsp;&nbsp;<?=$jobPeriod5[1]?>&nbsp;월</td>
            <td colspan="2"><?=$row[jobCompany5]?></td>
            <td><?=$row[jobDegree5]?></td>
        </tr>
        <?
    }
    if($row[jpsPeriod6]){
        ?>
        <tr>
            <td colspan="3"><?=$row[jpsPeriod6]?> ~ <?=$row[jpePeriod6]?></td>
            <td colspan="2"><?=$jobPeriod6[0]?>&nbsp;년&nbsp;&nbsp;<?=$jobPeriod6[1]?>&nbsp;월</td>
            <td colspan="2"><?=$row[jobCompany6]?></td>
            <td><?=$row[jobDegree6]?></td>
        </tr>
        <?
    }
    if($row[jpsPeriod7]){
        ?>
        <tr>
            <td colspan="3"><?=$row[jpsPeriod7]?> ~ <?=$row[jpePeriod7]?></td>
            <td colspan="2"><?=$jobPeriod7[0]?>&nbsp;년&nbsp;&nbsp;<?=$jobPeriod7[1]?>&nbsp;월</td>
            <td colspan="2"><?=$row[jobCompany7]?></td>
            <td><?=$row[jobDegree7]?></td>
        </tr>
        <?
    }
    if($row[jpsPeriod8]){
        ?>
        <tr>
            <td colspan="3"><?=$row[jpsPeriod8]?> ~ <?=$row[jpePeriod8]?></td>
            <td colspan="2"><?=$jobPeriod8[0]?>&nbsp;년&nbsp;&nbsp;<?=$jobPeriod8[1]?>&nbsp;월</td>
            <td colspan="2"><?=$row[jobCompany8]?></td>
            <td><?=$row[jobDegree8]?></td>
        </tr>
        <?
    }
    if($row[jpsPeriod9]){
        ?>
        <tr>
            <td colspan="3"><?=$row[jpsPeriod9]?> ~ <?=$row[jpePeriod9]?></td>
            <td colspan="2"><?=$jobPeriod9[0]?>&nbsp;년&nbsp;&nbsp;<?=$jobPeriod9[1]?>&nbsp;월</td>
            <td colspan="2"><?=$row[jobCompany9]?></td>
            <td><?=$row[jobDegree9]?></td>
        </tr>
        <?
    }
    if($row[jpsPeriod10]){
        ?>
        <tr>
            <td colspan="3"><?=$row[jpsPeriod10]?> ~ <?=$row[jpePeriod10]?></td>
            <td colspan="2"><?=$jobPeriod10[0]?>&nbsp;년&nbsp;&nbsp;<?=$jobPeriod10[1]?>&nbsp;월</td>
            <td colspan="2"><?=$row[jobCompany10]?></td>
            <td><?=$row[jobDegree10]?></td>
        </tr>
        <?
    }if($row[jpsPeriod11]){
        ?>
        <tr>
            <td colspan="3"><?=$row[jpsPeriod11]?> ~ <?=$row[jpePeriod11]?></td>
            <td colspan="2"><?=$jobPeriod11[0]?>&nbsp;년&nbsp;&nbsp;<?=$jobPeriod11[1]?>&nbsp;월</td>
            <td colspan="2"><?=$row[jobCompany11]?></td>
            <td><?=$row[jobDegree11]?></td>
        </tr>
        <?
    }if($row[jpsPeriod12]){
        ?>
        <tr>
            <td colspan="3"><?=$row[jpsPeriod12]?> ~ <?=$row[jpePeriod12]?></td>
            <td colspan="2"><?=$jobPeriod12[0]?>&nbsp;년&nbsp;&nbsp;<?=$jobPeriod12[1]?>&nbsp;월</td>
            <td colspan="2"><?=$row[jobCompany12]?></td>
            <td><?=$row[jobDegree12]?></td>
        </tr>
        <?
    }if($row[jpsPeriod13]){
        ?>
        <tr>
            <td colspan="3"><?=$row[jpsPeriod13]?> ~ <?=$row[jpePeriod13]?></td>
            <td colspan="2"><?=$jobPeriod13[0]?>&nbsp;년&nbsp;&nbsp;<?=$jobPeriod13[1]?>&nbsp;월</td>
            <td colspan="2"><?=$row[jobCompany13]?></td>
            <td><?=$row[jobDegree13]?></td>
        </tr>
        <?
    }if($row[jpsPeriod14]){
        ?>
        <tr>
            <td colspan="3"><?=$row[jpsPeriod14]?> ~ <?=$row[jpePeriod14]?></td>
            <td colspan="2"><?=$jobPeriod14[0]?>&nbsp;년&nbsp;&nbsp;<?=$jobPeriod14[1]?>&nbsp;월</td>
            <td colspan="2"><?=$row[jobCompany14]?></td>
            <td><?=$row[jobDegree14]?></td>
        </tr>
        <?
    }if($row[jpsPeriod15]){
        ?>
        <tr>
            <td colspan="3"><?=$row[jpsPeriod15]?> ~ <?=$row[jpePeriod15]?></td>
            <td colspan="2"><?=$jobPeriod15[0]?>&nbsp;년&nbsp;&nbsp;<?=$jobPeriod15[1]?>&nbsp;월</td>
            <td colspan="2"><?=$row[jobCompany15]?></td>
            <td><?=$row[jobDegree15]?></td>
        </tr>
        <?
    }
    ?>
	
    <tr>
        <td colspan="8" class="sub_title">5. 기타사항(기타 보충적으로 기술할 사항, 자격증 포상 등)</td>
    </tr>
    <tr>
        <th colspan="3">자격증 또는 포상명</th>
        <th colspan="3">취득 및 포상일자</th>
        <th colspan="2">시행기관</th>
    </tr>
    <?php
    if($row[etc1]){
        ?>
        <tr>
            <td colspan="3"><?=$row[etc1]?></td>
            <td colspan="3"><?=$row[etc1_date]?></td>
            <td colspan="2"><?=$row[etc1_company]?></td>
        </tr>
        <?php
    }
    if($row[etc2]){
        ?>
        <tr>
            <td colspan="3"><?=$row[etc2]?></td>
            <td colspan="3"><?=$row[etc2_date]?></td>
            <td colspan="2"><?=$row[etc2_company]?></td>
        </tr>
        <?php
    }
    if($row[etc3]){
        ?>
        <tr>
            <td colspan="3"><?=$row[etc3]?></td>
            <td colspan="3"><?=$row[etc3_date]?></td>
            <td colspan="2"><?=$row[etc3_company]?></td>
        </tr>
        <?php
    }
    if($row[etc4]){
        ?>
        <tr>
            <td colspan="3"><?=$row[etc4]?></td>
            <td colspan="3"><?=$row[etc4_date]?></td>
            <td colspan="2"><?=$row[etc4_company]?></td>
        </tr>
        <?php
    }
    if($row[etc5]){
        ?>
        <tr>
            <td colspan="3"><?=$row[etc5]?></td>
            <td colspan="3"><?=$row[etc5_date]?></td>
            <td colspan="2"><?=$row[etc5_company]?></td>
        </tr>
        <?php
    }
    if($row[etc6]){
        ?>
        <tr>
            <td colspan="3"><?=$row[etc6]?></td>
            <td colspan="3"><?=$row[etc6_date]?></td>
            <td colspan="2"><?=$row[etc6_company]?></td>
        </tr>
        <?php
    }
    ?>
</table>
<table class="table_box_recruit" style="margin:10px 0px;">
    <colgroup>
        <col width="150px">
        <col width="200px">
        <col width="350px">
        <col width="100px">
        <col width="100px">
        <col width="100px">
    </colgroup>
    <tr>
        <td colspan="6" class="sub_title">자기소개서</td>
    </tr>
    <tr>
        <td colspan="6" class="left"><?=nl2br($date[profile])?></td>
    </tr>
    <tr>
        <td colspan="6" class="sub_title">연구실적목록</td>
    </tr>
    <tr>
        <td colspan="6" style="background:#eeeeee;">학위논문목록</td>
    </tr>

    <tr>
        <td rowspan="3">석사학위<br />논문</td>
        <td>취득교</td>
        <td colspan="4" class="left"><?=$date[thesis1_school]?>&nbsp;대학교&nbsp;&nbsp;<?=$date[thesis1_postgraduate]?>&nbsp;대학원&nbsp;&nbsp;<?=$date[thesis1_degree]?>&nbsp;학과&nbsp;&nbsp;<?=$date[thesis1_major]?>&nbsp;전공</td>
    </tr>
    <tr>
        <td>제목</td>
        <td colspan="4" class="left"><?=$date[thesis1_subject]?></td>
    </tr>
    <tr>
        <td>논문개요</td>
        <td colspan="4" class="left"><?=nl2br($date[thesis1_content])?></td>
    </tr>
    <tr>
        <td rowspan="3">박사학위<br />논문</td>
        <td>취득교</td>
        <td colspan="4" class="left"><?=$date[thesis2_school]?>&nbsp;대학교&nbsp;&nbsp;<?=$date[thesis2_postgraduate]?>&nbsp;대학원&nbsp;&nbsp;<?=$date[thesis2_degree]?>&nbsp;학과&nbsp;&nbsp;<?=$date[thesis2_major]?>&nbsp;전공</td>
    </tr>
    <tr>
        <td>제목</td>
        <td colspan="4"  class="left"><?=$date[thesis2_subject]?></td>
    </tr>
    <tr>
        <td>논문개요</td>
        <td colspan="4" class="left"><?=nl2br($date[thesis2_content])?></td>
    </tr>
    <tr>
        <td colspan="6" style="background:#eeeeee;">연구실적목록</td>
    </tr>
    <tr>
        <th>발표구분</th>
        <th>제목</th>
        <th >내용요지</th>
        <th>발표년월일</th>
        <th>발표자수<br />(저자수)</th>
        <th >게재지명</th>
    </tr>
    <?php
    if($date[study1_subject]){
        ?>
        <tr>
            <td>
                <?
                if($date[study1_gubun]=="1"){echo "국내학술지 논문";}
                elseif($date[study1_gubun=="2"]){echo "국외학술지 논문";}
                elseif($date[study1_gubun=="3"]){echo "학술저서";}
                elseif($date[study1_gubun=="4"]){echo "국내 학술대회 발표";}
                elseif($date[study1_gubun=="5"]){echo "국외 학술대회 발표";}
                elseif($date[study1_gubun=="6"]){echo "국제적 저명학술지(SCI, SSCI, A&HCI) 등재 논문";}
                elseif($date[study1_gubun=="7"]){echo "기타";}
                ?>
            </td>
            <td ><?=$date[study1_subject]?></td>
            <td class="left"><?=nl2br($date[study1_content])?></td>
            <td><?=$date[study1_date]?></td>
            <td><?=$date[study1_mem]?></td>
            <td ><?=$date[study1_book]?></td>
        </tr>
        <?php
    }
    if($date[study2_subject]){
        ?>
        <tr>
            <td>
                <?
                if($date[study2_gubun]=="1"){echo "국내학술지 논문";}
                elseif($date[study2_gubun=="2"]){echo "국외학술지 논문";}
                elseif($date[study2_gubun=="3"]){echo "학술저서";}
                elseif($date[study2_gubun=="4"]){echo "국내 학술대회 발표";}
                elseif($date[study2_gubun=="5"]){echo "국외 학술대회 발표";}
                elseif($date[study2_gubun=="6"]){echo "국제적 저명학술지(SCI, SSCI, A&HCI) 등재 논문";}
                elseif($date[study2_gubun=="7"]){echo "기타";}
                ?>
            </td>
            <td ><?=$date[study2_subject]?></td>
            <td class="left"><?=nl2br($date[study2_content])?></td>
            <td><?=$date[study2_date]?></td>
            <td><?=$date[study2_mem]?></td>
            <td ><?=$date[study2_book]?></td>
        </tr>
        <?php
    }
    if($date[study3_subject]){
        ?>
        <tr>
            <td>
                <?
                if($date[study3_gubun]=="1"){echo "국내학술지 논문";}
                elseif($date[study3_gubun=="2"]){echo "국외학술지 논문";}
                elseif($date[study3_gubun=="3"]){echo "학술저서";}
                elseif($date[study3_gubun=="4"]){echo "국내 학술대회 발표";}
                elseif($date[study3_gubun=="5"]){echo "국외 학술대회 발표";}
                elseif($date[study3_gubun=="6"]){echo "국제적 저명학술지(SCI, SSCI, A&HCI) 등재 논문";}
                elseif($date[study3_gubun=="7"]){echo "기타";}
                ?>
            </td>
            <td ><?=$date[study3_subject]?></td>
            <td class="left"><?=nl2br($date[study3_content])?></td>
            <td><?=$date[study3_date]?></td>
            <td><?=$date[study3_mem]?></td>
            <td ><?=$date[study3_book]?></td>
        </tr>
        <?php
    }
    if($date[study4_subject]){
        ?>
        <tr>
            <td>
                <?
                if($date[study4_gubun]=="1"){echo "국내학술지 논문";}
                elseif($date[study4_gubun=="2"]){echo "국외학술지 논문";}
                elseif($date[study4_gubun=="3"]){echo "학술저서";}
                elseif($date[study4_gubun=="4"]){echo "국내 학술대회 발표";}
                elseif($date[study4_gubun=="5"]){echo "국외 학술대회 발표";}
                elseif($date[study4_gubun=="6"]){echo "국제적 저명학술지(SCI, SSCI, A&HCI) 등재 논문";}
                elseif($date[study4_gubun=="7"]){echo "기타";}
                ?>
            </td>
            <td ><?=$date[study4_subject]?></td>
            <td class="left"><?=nl2br($date[study4_content])?></td>
            <td><?=$date[study4_date]?></td>
            <td><?=$date[study4_mem]?></td>
            <td ><?=$date[study4_book]?></td>
        </tr>
        <?php
    }
    if($date[study5_subject]){
        ?>
        <tr>
            <td>
                <?
                if($date[study5_gubun]=="1"){echo "국내학술지 논문";}
                elseif($date[study5_gubun=="2"]){echo "국외학술지 논문";}
                elseif($date[study5_gubun=="3"]){echo "학술저서";}
                elseif($date[study5_gubun=="4"]){echo "국내 학술대회 발표";}
                elseif($date[study5_gubun=="5"]){echo "국외 학술대회 발표";}
                elseif($date[study5_gubun=="6"]){echo "국제적 저명학술지(SCI, SSCI, A&HCI) 등재 논문";}
                elseif($date[study5_gubun=="7"]){echo "기타";}
                ?>
            </td>
            <td ><?=$date[study5_subject]?></td>
            <td class="left"><?=nl2br($date[study5_content])?></td>
            <td><?=$date[study5_date]?></td>
            <td><?=$date[study5_mem]?></td>
            <td ><?=$date[study5_book]?></td>
        </tr>
        <?php
    }
    if($date[study6_subject]){
        ?>
        <tr>
            <td>
                <?
                if($date[study6_gubun]=="1"){echo "국내학술지 논문";}
                elseif($date[study6_gubun=="2"]){echo "국외학술지 논문";}
                elseif($date[study6_gubun=="3"]){echo "학술저서";}
                elseif($date[study6_gubun=="4"]){echo "국내 학술대회 발표";}
                elseif($date[study6_gubun=="5"]){echo "국외 학술대회 발표";}
                elseif($date[study6_gubun=="6"]){echo "국제적 저명학술지(SCI, SSCI, A&HCI) 등재 논문";}
                elseif($date[study6_gubun=="7"]){echo "기타";}
                ?>
            </td>
            <td ><?=$date[study6_subject]?></td>
            <td class="left"><?=nl2br($date[study6_content])?></td>
            <td><?=$date[study6_date]?></td>
            <td><?=$date[study6_mem]?></td>
            <td ><?=$date[study6_book]?></td>
        </tr>
        <?php
    }
    if($date[study7_subject]){
        ?>
        <tr>
            <td>
                <?
                if($date[study7_gubun]=="1"){echo "국내학술지 논문";}
                elseif($date[study7_gubun=="2"]){echo "국외학술지 논문";}
                elseif($date[study7_gubun=="3"]){echo "학술저서";}
                elseif($date[study7_gubun=="4"]){echo "국내 학술대회 발표";}
                elseif($date[study7_gubun=="5"]){echo "국외 학술대회 발표";}
                elseif($date[study7_gubun=="6"]){echo "국제적 저명학술지(SCI, SSCI, A&HCI) 등재 논문";}
                elseif($date[study7_gubun=="7"]){echo "기타";}
                ?>
            </td>
            <td ><?=$date[study7_subject]?></td>
            <td class="left"><?=nl2br($date[study7_content])?></td>
            <td><?=$date[study7_date]?></td>
            <td><?=$date[study7_mem]?></td>
            <td ><?=$date[study7_book]?></td>
        </tr>
        <?php
    }
    if($date[study8_subject]){
        ?>
        <tr>
            <td>
                <?
                if($date[study8_gubun]=="1"){echo "국내학술지 논문";}
                elseif($date[study8_gubun=="2"]){echo "국외학술지 논문";}
                elseif($date[study8_gubun=="3"]){echo "학술저서";}
                elseif($date[study8_gubun=="4"]){echo "국내 학술대회 발표";}
                elseif($date[study8_gubun=="5"]){echo "국외 학술대회 발표";}
                elseif($date[study8_gubun=="6"]){echo "국제적 저명학술지(SCI, SSCI, A&HCI) 등재 논문";}
                elseif($date[study8_gubun=="7"]){echo "기타";}
                ?>
            </td>
            <td ><?=$date[study8_subject]?></td>
            <td class="left"><?=nl2br($date[study8_content])?></td>
            <td><?=$date[study8_date]?></td>
            <td><?=$date[study8_mem]?></td>
            <td ><?=$date[study8_book]?></td>
        </tr>
        <?php
    }
    ?>
</table>