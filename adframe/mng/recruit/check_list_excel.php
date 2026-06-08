<?php
header( "Content-type: application/vnd.ms-excel" );
header( "Content-type: application/vnd.ms-excel; charset=utf-8");
header( "Content-Disposition: attachment; filename = 기초전공심사체크리스트.xls" );
header( "Content-Description: PHP4 Generated Data" );
// adframe 공통 인클루드 파일
include_once "../_common.php";
// 접속로그
include_once( dirname(__FILE__)."/lib/log.access.forPrivate.php" );
// 개인정보 접근로그
if ( $pgidx > 0 ) log_Access_ForPrivate("recruit-applist-downloadExcel");

$DBTable = "recruit_copy";
$pagecnt=$pagecnt;
$letter_no=$letter_no;
$offset=$offset;
if($searchstring) {
    $search_qry = " AND $search LIKE '%".$searchstring."%' ";
}
if($apply_major){
    $search_apply_major=" AND apply_major='".$apply_major."'";
}
$pg_qry = "SELECT * FROM ".$DBTable." WHERE  wr_id > 0 AND resume_num='$resume_num' $search_qry $apply_major ORDER BY wr_id asc ";
$pg_result = mysql_query($pg_qry);

WHILE($row = mysql_fetch_array($pg_result)){
    if($row['doctor1']){
        $final_edu = $row['dDegree1'];
        $final_school = $row['doctor1'];
    }else if($row['doctor']){
        $final_edu = $row['dDegree'];
        $final_school = $row['doctor'];
    }else if($row['master1']){
        $final_edu = $row['mDegree1'];
        $final_school = $row['master1'];
    }else if($row['master']){
        $final_edu = $row['mDegree'];
        $final_school = $row['master'];
    }else if($row['univ1']){
        $final_edu = $row['uDegree1'];
        $final_school = $row['univ1'];
    }else if($row['univ']){
        $final_edu = $row['uDegree'];
        $final_school = $row['univ'];
    }else if($row['collage1']){
        $final_edu = $row['cDegree1'];
        $final_school = $row['collage1'];
    }else if($row['collage']){
        $final_edu = $row['cDegree'];
        $final_school = $row['collage'];
    }else{
        $final_edu = "";
        $final_school = $row['hSchool'];
    }
    $data = mysql_fetch_array(mysql_query("select * from recruit1 WHERE parent='$row[wr_id]'"));
    ?>
    <link rel="stylesheet" href="../admin.css">
    <table style="width:800px">
        <tr>
            <td colspan="6" style="text-align:center"><h2>2019-1학기 1차 신규 교수채용 기초&middot;전공심사 체크리스트</h2></td>
        </tr>
        <tr>
            <td colspan="6" style="text-align:right">
                ○지원자 : <?php echo $row['kor_name']?>
            </td>
        </tr>
        <tr>
            <td colspan="6" style="font-weight:bold">가.지원자격 확인</td>
        </tr>
        <tr>
            <th style="border:1px solid #000">학과명</th>
            <th style="border:1px solid #000" colspan="2">최종학위</th>
            <th style="border:1px solid #000" colspan="2">최종학위 취득학교</th>
            <th style="border:1px solid #000">이상유무</th>
        </tr>
        <tr>
            <td style="border:1px solid #000"><?php echo $row['apply_major']?></td>
            <td style="border:1px solid #000" colspan="2">
                <?php echo $final_edu?>
            </td>
            <td style="border:1px solid #000" colspan="2"><?php echo $final_school?></td>
            <td style="border:1px solid #000">&nbsp;</td>
        </tr>
        <tr>
            <td>&nbsp;<td>
            <td><td>
            <td><td>
            <td><td>
            <td><td>
            <td><td>
        </tr>
        <tr>
            <td colspan="6" style="font-weight:bold">나. 경력사항 확인(교육경력)</td>
        </tr>
        <tr>
            <th style="border:1px solid #000">기관명</th>
            <th style="border:1px solid #000">직위</th>
            <th style="border:1px solid #000">기간</th>
            <th style="border:1px solid #000">근무년월</th>
            <th style="border:1px solid #000">년수(환산)</th>
            <th style="border:1px solid #000">인정유무</th>
        </tr>
        <?php
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

        if(!$jobPeriod1[0])$jobPeriod1[0]=0; if(!$jobPeriod1[1])$jobPeriod1[1]=0;
        if(!$jobPeriod2[0])$jobPeriod2[0]=0; if(!$jobPeriod2[1])$jobPeriod2[1]=0;
        if(!$jobPeriod3[0])$jobPeriod3[0]=0; if(!$jobPeriod3[1])$jobPeriod3[1]=0;
        if(!$jobPeriod4[0])$jobPeriod4[0]=0; if(!$jobPeriod4[1])$jobPeriod4[1]=0;
        if(!$jobPeriod5[0])$jobPeriod5[0]=0; if(!$jobPeriod5[1])$jobPeriod5[1]=0;
        if(!$jobPeriod6[0])$jobPeriod6[0]=0; if(!$jobPeriod6[1])$jobPeriod6[1]=0;
        if(!$jobPeriod7[0])$jobPeriod7[0]=0; if(!$jobPeriod7[1])$jobPeriod7[1]=0;
        if(!$jobPeriod8[0])$jobPeriod8[0]=0; if(!$jobPeriod8[1])$jobPeriod8[1]=0;
        if(!$jobPeriod9[0])$jobPeriod9[0]=0; if(!$jobPeriod9[1])$jobPeriod9[1]=0;
        if(!$jobPeriod10[0])$jobPeriod10[0]=0; if(!$jobPeriod10[1])$jobPeriod10[1]=0;
        if(!$jobPeriod11[0])$jobPeriod11[0]=0; if(!$jobPeriod11[1])$jobPeriod11[1]=0;
        if(!$jobPeriod12[0])$jobPeriod12[0]=0; if(!$jobPeriod12[1])$jobPeriod12[1]=0;
        if(!$jobPeriod13[0])$jobPeriod13[0]=0; if(!$jobPeriod13[1])$jobPeriod13[1]=0;
        if(!$jobPeriod14[0])$jobPeriod14[0]=0; if(!$jobPeriod14[1])$jobPeriod14[1]=0;
        if(!$jobPeriod15[0])$jobPeriod15[0]=0; if(!$jobPeriod15[1])$jobPeriod15[1]=0;
        if($row[jpsPeriod1]){
            ?>
            <tr>
                <td style="border:1px solid #000"  ><?=$row[jobCompany1]?> </td>
                <td style="border:1px solid #000" ><?=$row[jobDegree1]?></td>
                <td style="border:1px solid #000" ><?=$row[jpsPeriod1]?> ~ <?=$row[jpePeriod1]?></td>
                <td style="border:1px solid #000" ><?=$jobPeriod1[0]?>&nbsp;년&nbsp;&nbsp;<?=$jobPeriod1[1]?>&nbsp;월</td>
                <td style="border:1px solid #000" ></td>
                <td style="border:1px solid #000" ></td>
            </tr>
            <?php
        }
        if($row[jpsPeriod2]){
            ?>
            <tr>
                <td style="border:1px solid #000" ><?=$row[jobCompany2]?></td>
                <td style="border:1px solid #000" ><?=$row[jobDegree2]?></td>
                <td style="border:1px solid #000" ><?=$row[jpsPeriod2]?> ~ <?=$row[jpePeriod2]?></td>
                <td style="border:1px solid #000" ><?=$jobPeriod2[0]?>&nbsp;년&nbsp;&nbsp;<?=$jobPeriod2[1]?>&nbsp;월</td>
                <td style="border:1px solid #000" ></td>
                <td style="border:1px solid #000" ></td>
            </tr>
            <?php
        }
        if($row[jpsPeriod3]){
            ?>
            <tr>
                <td style="border:1px solid #000"  ><?=$row[jobCompany3]?></td>
                <td style="border:1px solid #000" ><?=$row[jobDegree3]?></td>
                <td style="border:1px solid #000"  ><?=$row[jpsPeriod3]?> ~ <?=$row[jpePeriod3]?></td>
                <td style="border:1px solid #000"  ><?=$jobPeriod3[0]?>&nbsp;년&nbsp;&nbsp;<?=$jobPeriod3[1]?>&nbsp;월</td>
                <td style="border:1px solid #000" ></td>
                <td style="border:1px solid #000" ></td>
            </tr>
            <?php
        }
        if($row[jpsPeriod4]){
            ?>
            <tr>
                <td style="border:1px solid #000"  ><?=$row[jobCompany4]?></td>
                <td style="border:1px solid #000" ><?=$row[jobDegree4]?></td>
                <td style="border:1px solid #000"  ><?=$row[jpsPeriod4]?> ~ <?=$row[jpePeriod4]?></td>
                <td style="border:1px solid #000"  ><?=$jobPeriod4[0]?>&nbsp;년&nbsp;&nbsp;<?=$jobPeriod4[1]?>&nbsp;월</td>
                <td style="border:1px solid #000" ></td>
                <td style="border:1px solid #000" ></td>
            </tr>
            <?php
        }
        if($row[jpsPeriod5]){
            ?>
            <tr>
                <td style="border:1px solid #000"  ><?=$row[jobCompany5]?></td>
                <td style="border:1px solid #000" ><?=$row[jobDegree5]?></td>
                <td style="border:1px solid #000"  ><?=$row[jpsPeriod5]?> ~ <?=$row[jpePeriod5]?></td>
                <td style="border:1px solid #000"  ><?=$jobPeriod5[0]?>&nbsp;년&nbsp;&nbsp;<?=$jobPeriod5[1]?>&nbsp;월</td>
                <td style="border:1px solid #000" ></td>
                <td style="border:1px solid #000" ></td>
            </tr>
            <?php
        }
        if($row[jpsPeriod6]){
            ?>
            <tr>
                <td style="border:1px solid #000"  ><?=$row[jobCompany6]?></td>
                <td style="border:1px solid #000" ><?=$row[jobDegree6]?></td>
                <td style="border:1px solid #000"  ><?=$row[jpsPeriod6]?> ~ <?=$row[jpePeriod6]?></td>
                <td style="border:1px solid #000"  ><?=$jobPeriod6[0]?>&nbsp;년&nbsp;&nbsp;<?=$jobPeriod6[1]?>&nbsp;월</td>
                <td style="border:1px solid #000" ></td>
                <td style="border:1px solid #000" ></td>
            </tr>
            <?php
        }
        if($row[jpsPeriod7]){
            ?>
            <tr>
                <td style="border:1px solid #000"  ><?=$row[jobCompany7]?></td>
                <td style="border:1px solid #000" ><?=$row[jobDegree7]?></td>
                <td style="border:1px solid #000"  ><?=$row[jpsPeriod7]?> ~ <?=$row[jpePeriod7]?></td>
                <td style="border:1px solid #000"  ><?=$jobPeriod7[0]?>&nbsp;년&nbsp;&nbsp;<?=$jobPeriod7[1]?>&nbsp;월</td>
                <td style="border:1px solid #000" ></td>
                <td style="border:1px solid #000" ></td>
            </tr>
            <?php
        }
        if($row[jpsPeriod8]){
            ?>
            <tr>
                <td style="border:1px solid #000"  ><?=$row[jobCompany8]?></td>
                <td style="border:1px solid #000" ><?=$row[jobDegree8]?></td>
                <td style="border:1px solid #000"  ><?=$row[jpsPeriod8]?> ~ <?=$row[jpePeriod8]?></td>
                <td style="border:1px solid #000"  ><?=$jobPeriod8[0]?>&nbsp;년&nbsp;&nbsp;<?=$jobPeriod8[1]?>&nbsp;월</td>
                <td style="border:1px solid #000" ></td>
                <td style="border:1px solid #000" ></td>
            </tr>
            <?php
        }
        if($row[jpsPeriod9]){
            ?>
            <tr>
                <td style="border:1px solid #000"  ><?=$row[jobCompany9]?></td>
                <td style="border:1px solid #000" ><?=$row[jobDegree9]?></td>
                <td style="border:1px solid #000"  ><?=$row[jpsPeriod9]?> ~ <?=$row[jpePeriod9]?></td>
                <td style="border:1px solid #000"  ><?=$jobPeriod9[0]?>&nbsp;년&nbsp;&nbsp;<?=$jobPeriod9[1]?>&nbsp;월</td>
                <td style="border:1px solid #000" ></td>
                <td style="border:1px solid #000" ></td>
            </tr>
            <?php
        }
        if($row[jpsPeriod10]){
            ?>
            <tr>
                <td style="border:1px solid #000"  ><?=$row[jobCompany10]?></td>
                <td style="border:1px solid #000" ><?=$row[jobDegree10]?></td>
                <td style="border:1px solid #000"  ><?=$row[jpsPeriod10]?> ~ <?=$row[jpePeriod10]?></td>
                <td style="border:1px solid #000"  ><?=$jobPeriod10[0]?>&nbsp;년&nbsp;&nbsp;<?=$jobPeriod10[1]?>&nbsp;월</td>
                <td style="border:1px solid #000" ></td>
                <td style="border:1px solid #000" ></td>
            </tr>
            <?php
        }
        if($row[jpsPeriod11]){
            ?>
            <tr>
                <td style="border:1px solid #000"  ><?=$row[jpsPeriod11]?> ~ <?=$row[jpePeriod11]?></td>
                <td style="border:1px solid #000"  ><?=$jobPeriod11[0]?>&nbsp;년&nbsp;&nbsp;<?=$jobPeriod11[1]?>&nbsp;월</td>
                <td style="border:1px solid #000"  ><?=$row[jobCompany11]?></td>
                <td style="border:1px solid #000" ><?=$row[jobDegree11]?></td>
                <td style="border:1px solid #000" ></td>
                <td style="border:1px solid #000" ></td>
            </tr>
            <?php
        }
        if($row[jpsPeriod12]){
            ?>
            <tr>
                <td style="border:1px solid #000"  ><?=$row[jobCompany12]?></td>
                <td style="border:1px solid #000" ><?=$row[jobDegree12]?></td>
                <td style="border:1px solid #000"  ><?=$row[jpsPeriod12]?> ~ <?=$row[jpePeriod12]?></td>
                <td style="border:1px solid #000"  ><?=$jobPeriod12[0]?>&nbsp;년&nbsp;&nbsp;<?=$jobPeriod12[1]?>&nbsp;월</td>
                <td style="border:1px solid #000" ></td>
                <td style="border:1px solid #000" ></td>
            </tr>
            <?php
        }
        if($row[jpsPeriod13]){
            ?>
            <tr>
                <td style="border:1px solid #000"  ><?=$row[jobCompany13]?></td>
                <td style="border:1px solid #000" ><?=$row[jobDegree13]?></td>
                <td style="border:1px solid #000"  ><?=$row[jpsPeriod13]?> ~ <?=$row[jpePeriod13]?></td>
                <td style="border:1px solid #000"  ><?=$jobPeriod13[0]?>&nbsp;년&nbsp;&nbsp;<?=$jobPeriod13[1]?>&nbsp;월</td>
                <td style="border:1px solid #000" ></td>
                <td style="border:1px solid #000" ></td>
            </tr>
            <?php
        }
        if($row[jpsPeriod14]){
            ?>
            <tr>
                <td style="border:1px solid #000"  ><?=$row[jobCompany14]?></td>
                <td style="border:1px solid #000" ><?=$row[jobDegree14]?></td>
                <td style="border:1px solid #000"  ><?=$row[jpsPeriod14]?> ~ <?=$row[jpePeriod14]?></td>
                <td style="border:1px solid #000"  ><?=$jobPeriod14[0]?>&nbsp;년&nbsp;&nbsp;<?=$jobPeriod14[1]?>&nbsp;월</td>
                <td style="border:1px solid #000" ></td>
                <td style="border:1px solid #000" ></td>
            </tr>
            <?php
        }
        if($row[jpsPeriod15]){
            ?>
            <tr>
                <td style="border:1px solid #000"  ><?=$row[jobCompany15]?></td>
                <td style="border:1px solid #000" ><?=$row[jobDegree15]?></td>
                <td style="border:1px solid #000"  ><?=$row[jpsPeriod15]?> ~ <?=$row[jpePeriod15]?></td>
                <td style="border:1px solid #000"  ><?=$jobPeriod15[0]?>&nbsp;년&nbsp;&nbsp;<?=$jobPeriod15[1]?>&nbsp;월</td>
                <td style="border:1px solid #000" ></td>
                <td style="border:1px solid #000" ></td>
            </tr>
            <?php
        }

        ?>
        <tr>
            <td colspan="2">○ 자격여부(교육경력) : 년수 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  년, 배점 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;          점</td>
        </tr>
        <tr>
            <td colspan="6">○ 자격여부(실무경력) : 년수 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;         년, 배점 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;          점</td>
        </tr>
        <tr>
            <td>&nbsp;<td>
            <td><td>
            <td><td>
            <td><td>
            <td><td>
            <td><td>
        </tr>
        <tr>
            <td colspan="6" style="font-weight:bold">다. 연구실적물 확인(2015.3월 이후 게재된 논문으로 2018.12월 현재 출판된 것이 한함)</td>
        </tr>
        <tr>
            <th style="border:1px solid #000">연구실적물번호</th>
            <th style="border:1px solid #000">발표구분</th>
            <th style="border:1px solid #000">발표년월일 2015.03.01이후</th>
            <th style="border:1px solid #000">발표자수</th>
            <th style="border:1px solid #000">인정환산률</th>
            <th style="border:1px solid #000">인정유무</th>
        </tr>
        <?php if($data[thesis1_school]){ ?>
            <tr>
                <td style="border:1px solid #000"></td>
                <td style="border:1px solid #000">석사학위논문</td>
                <td style="border:1px solid #000"><?=$row[mDegree_date]?></td>
                <td style="border:1px solid #000"></td>
                <td style="border:1px solid #000"></td>
                <td style="border:1px solid #000"></td>
            </tr>
        <?php } ?>


        <?php if($data[thesis2_school]){ ?>
            <tr>
                <td style="border:1px solid #000"></td>
                <td style="border:1px solid #000">박사학위논문</td>
                <td style="border:1px solid #000"><?=$row[dDegree_date1]?></td>
                <td style="border:1px solid #000"></td>
                <td style="border:1px solid #000"></td>
                <td style="border:1px solid #000"></td>
            </tr>
        <?php } ?>
        <?if($data[study1_gubun]){?>
            <tr>
                <td style="border:1px solid #000"></td>
                <td style="border:1px solid #000">
                    <?
                    if($data[study1_gubun]=="1") echo "국내학술지 논문";
                    if($data[study1_gubun]=="2") echo "국외학술지 논문";
                    if($data[study1_gubun]=="3") echo "학술저서";
                    if($data[study1_gubun]=="4") echo "국내 학술대회 발표";
                    if($data[study1_gubun]=="5") echo "국외 학술대회 발표";
                    if($data[study1_gubun]=="6") echo "국제적 저명학술지(SCI, SSCI, A&HCI) 등재 논문";
                    if($data[study1_gubun]=="7") echo "기타";
                    ?></td>
                <td style="border:1px solid #000"><?=$data[study1_date]?></td>
                <td style="border:1px solid #000"><?=$data[study1_mem]?></td>
                <td style="border:1px solid #000"></td>
                <td style="border:1px solid #000"></td>
            </tr>
        <?}?>
        <?if($data[study2_gubun]){?>
            <tr>
                <td style="border:1px solid #000"></td>
                <td style="border:1px solid #000"><?
                    if($data[study2_gubun]=="1") echo "국내학술지 논문";
                    if($data[study2_gubun]=="2") echo "국외학술지 논문";
                    if($data[study2_gubun]=="3") echo "학술저서";
                    if($data[study2_gubun]=="4") echo "국내 학술대회 발표";
                    if($data[study2_gubun]=="5") echo "국외 학술대회 발표";
                    if($data[study2_gubun]=="6") echo "국제적 저명학술지(SCI, SSCI, A&HCI) 등재 논문";
                    if($data[study2_gubun]=="7") echo "기타";
                    ?></td>
                <td style="border:1px solid #000"><?=$data[study2_date]?></td>
                <td style="border:1px solid #000"><?=$data[study2_mem]?></td>
                <td style="border:1px solid #000"></td>
                <td style="border:1px solid #000"></td>
            </tr>
        <?}?>
        <?if($data[study3_gubun]){?>
            <tr>
                <td style="border:1px solid #000"></td>
                <td style="border:1px solid #000"><?
                    if($data[study3_gubun]=="1") echo "국내학술지 논문";
                    if($data[study3_gubun]=="2") echo "국외학술지 논문";
                    if($data[study3_gubun]=="3") echo "학술저서";
                    if($data[study3_gubun]=="4") echo "국내 학술대회 발표";
                    if($data[study3_gubun]=="5") echo "국외 학술대회 발표";
                    if($data[study3_gubun]=="6") echo "국제적 저명학술지(SCI, SSCI, A&HCI) 등재 논문";
                    if($data[study3_gubun]=="7") echo "기타";
                    ?></td>
                <td style="border:1px solid #000"><?=$data[study3_date]?></td>
                <td style="border:1px solid #000"><?=$data[study3_mem]?></td>
                <td style="border:1px solid #000"></td>
                <td style="border:1px solid #000"></td>
            </tr>
        <?}?>
        <?if($data[study4_gubun]){?>
            <tr>
                <td style="border:1px solid #000"></td>
                <td style="border:1px solid #000"><?
                    if($data[study4_gubun]=="1") echo "국내학술지 논문";
                    if($data[study4_gubun]=="2") echo "국외학술지 논문";
                    if($data[study4_gubun]=="3") echo "학술저서";
                    if($data[study4_gubun]=="4") echo "국내 학술대회 발표";
                    if($data[study4_gubun]=="5") echo "국외 학술대회 발표";
                    if($data[study4_gubun]=="6") echo "국제적 저명학술지(SCI, SSCI, A&HCI) 등재 논문";
                    if($data[study4_gubun]=="7") echo "기타";
                    ?></td>
                <td style="border:1px solid #000"><?=$data[study4_date]?></td>
                <td style="border:1px solid #000"><?=$data[study4_mem]?></td>
                <td style="border:1px solid #000"></td>
                <td style="border:1px solid #000"></td>
            </tr>
        <?}?>
        <?if($data[study5_gubun]){?>
            <tr>
                <td style="border:1px solid #000"></td>
                <td style="border:1px solid #000"><?
                    if($data[study5_gubun]=="1") echo "국내학술지 논문";
                    if($data[study5_gubun]=="2") echo "국외학술지 논문";
                    if($data[study5_gubun]=="3") echo "학술저서";
                    if($data[study5_gubun]=="4") echo "국내 학술대회 발표";
                    if($data[study5_gubun]=="5") echo "국외 학술대회 발표";
                    if($data[study5_gubun]=="6") echo "국제적 저명학술지(SCI, SSCI, A&HCI) 등재 논문";
                    if($data[study5_gubun]=="7") echo "기타";
                    ?></td>
                <td style="border:1px solid #000"><?=$data[study5_date]?></td>
                <td style="border:1px solid #000"><?=$data[study5_mem]?></td>
                <td style="border:1px solid #000"></td>
                <td style="border:1px solid #000"></td>
            </tr>
        <?}?>
        <?if($data[study6_gubun]){?>
            <tr>
                <td style="border:1px solid #000"></td>
                <td style="border:1px solid #000"><?
                    if($data[study6_gubun]=="1") echo "국내학술지 논문";
                    if($data[study6_gubun]=="2") echo "국외학술지 논문";
                    if($data[study6_gubun]=="3") echo "학술저서";
                    if($data[study6_gubun]=="4") echo "국내 학술대회 발표";
                    if($data[study6_gubun]=="5") echo "국외 학술대회 발표";
                    if($data[study6_gubun]=="6") echo "국제적 저명학술지(SCI, SSCI, A&HCI) 등재 논문";
                    if($data[study6_gubun]=="7") echo "기타";
                    ?></td>
                <td style="border:1px solid #000"><?=$data[study6_date]?></td>
                <td style="border:1px solid #000"><?=$data[study6_mem]?></td>
                <td style="border:1px solid #000"></td>
                <td style="border:1px solid #000"></td>
            </tr>
        <?}?>
        <?if($data[study7_gubun]){?>
            <tr>
                <td style="border:1px solid #000"></td>
                <td style="border:1px solid #000"><?
                    if($data[study7_gubun]=="1") echo "국내학술지 논문";
                    if($data[study7_gubun]=="2") echo "국외학술지 논문";
                    if($data[study7_gubun]=="3") echo "학술저서";
                    if($data[study7_gubun]=="4") echo "국내 학술대회 발표";
                    if($data[study7_gubun]=="5") echo "국외 학술대회 발표";
                    if($data[study7_gubun]=="6") echo "국제적 저명학술지(SCI, SSCI, A&HCI) 등재 논문";
                    if($data[study7_gubun]=="7") echo "기타";
                    ?></td>
                <td style="border:1px solid #000"><?=$data[study7_date]?></td>
                <td style="border:1px solid #000"><?=$data[study7_mem]?></td>
                <td style="border:1px solid #000"></td>
                <td style="border:1px solid #000"></td>
            </tr>
        <?}?>
        <?if($data[study8_gubun]){?>
            <tr>
                <td style="border:1px solid #000"></td>
                <td><?
                    if($data[study8_gubun]=="1") echo "국내학술지 논문";
                    if($data[study8_gubun]=="2") echo "국외학술지 논문";
                    if($data[study8_gubun]=="3") echo "학술저서";
                    if($data[study8_gubun]=="4") echo "국내 학술대회 발표";
                    if($data[study8_gubun]=="5") echo "국외 학술대회 발표";
                    if($data[study8_gubun]=="6") echo "국제적 저명학술지(SCI, SSCI, A&HCI) 등재 논문";
                    if($data[study8_gubun]=="7") echo "기타";
                    ?></td>
                <td style="border:1px solid #000"><?=$data[study8_date]?></td>
                <td style="border:1px solid #000"><?=$data[study8_mem]?></td>
                <td style="border:1px solid #000"></td>
                <td style="border:1px solid #000"></td>
            </tr>
        <?}?>
        <?if($data[study9_gubun]){?>
            <tr>
                <td style="border:1px solid #000"></td>
                <td style="border:1px solid #000"><?
                    if($data[study9_gubun]=="1") echo "국내학술지 논문";
                    if($data[study9_gubun]=="2") echo "국외학술지 논문";
                    if($data[study9_gubun]=="3") echo "학술저서";
                    if($data[study9_gubun]=="4") echo "국내 학술대회 발표";
                    if($data[study9_gubun]=="5") echo "국외 학술대회 발표";
                    if($data[study9_gubun]=="6") echo "국제적 저명학술지(SCI, SSCI, A&HCI) 등재 논문";
                    if($data[study9_gubun]=="7") echo "기타";
                    ?></td>
                <td style="border:1px solid #000"><?=$data[study9_date]?></td>
                <td style="border:1px solid #000"><?=$data[study9_mem]?></td>
                <td style="border:1px solid #000"></td>
                <td style="border:1px solid #000"></td>
            </tr>
        <?}?>
        <?if($data[study10_gubun]){?>
            <tr>
                <td style="border:1px solid #000"></td>
                <td style="border:1px solid #000"><?
                    if($data[study10_gubun]=="1") echo "국내학술지 논문";
                    if($data[study10_gubun]=="2") echo "국외학술지 논문";
                    if($data[study10_gubun]=="3") echo "학술저서";
                    if($data[study10_gubun]=="4") echo "국내 학술대회 발표";
                    if($data[study10_gubun]=="5") echo "국외 학술대회 발표";
                    if($data[study10_gubun]=="6") echo "국제적 저명학술지(SCI, SSCI, A&HCI) 등재 논문";
                    if($data[study10_gubun]=="7") echo "기타";
                    ?></td>
                <td style="border:1px solid #000"><?=$data[study10_date]?></td>
                <td style="border:1px solid #000"><?=$data[study10_mem]?></td>
                <td style="border:1px solid #000"></td>
                <td style="border:1px solid #000"></td>
            </tr>
        <?}?>
        <?if($data[study11_gubun]){?>
            <tr>
                <td style="border:1px solid #000"></td>
                <td style="border:1px solid #000"><?
                    if($data[study11_gubun]=="1") echo "국내학술지 논문";
                    if($data[study11_gubun]=="2") echo "국외학술지 논문";
                    if($data[study11_gubun]=="3") echo "학술저서";
                    if($data[study11_gubun]=="4") echo "국내 학술대회 발표";
                    if($data[study11_gubun]=="5") echo "국외 학술대회 발표";
                    if($data[study11_gubun]=="6") echo "국제적 저명학술지(SCI, SSCI, A&HCI) 등재 논문";
                    if($data[study11_gubun]=="7") echo "기타";
                    ?></td>
                <td style="border:1px solid #000"><?=$data[study11_date]?></td>
                <td style="border:1px solid #000"><?=$data[study11_mem]?></td>
                <td style="border:1px solid #000"></td>
                <td style="border:1px solid #000"></td>
            </tr>
        <?}?>
        <?if($data[study12_gubun]){?>
            <tr>
                <td style="border:1px solid #000"></td>
                <td style="border:1px solid #000"><?
                    if($data[study12_gubun]=="1") echo "국내학술지 논문";
                    if($data[study12_gubun]=="2") echo "국외학술지 논문";
                    if($data[study12_gubun]=="3") echo "학술저서";
                    if($data[study12_gubun]=="4") echo "국내 학술대회 발표";
                    if($data[study12_gubun]=="5") echo "국외 학술대회 발표";
                    if($data[study12_gubun]=="6") echo "국제적 저명학술지(SCI, SSCI, A&HCI) 등재 논문";
                    if($data[study12_gubun]=="7") echo "기타";
                    ?></td>
                <td style="border:1px solid #000"><?=$data[study12_date]?></td>
                <td style="border:1px solid #000"><?=$data[study12_mem]?></td>
                <td style="border:1px solid #000"></td>
                <td style="border:1px solid #000"></td>
            </tr>
        <?}?>
        <?if($data[study13_gubun]){?>
            <tr>
                <td style="border:1px solid #000"></td>
                <td style="border:1px solid #000"><?
                    if($data[study13_gubun]=="1") echo "국내학술지 논문";
                    if($data[study13_gubun]=="2") echo "국외학술지 논문";
                    if($data[study13_gubun]=="3") echo "학술저서";
                    if($data[study13_gubun]=="4") echo "국내 학술대회 발표";
                    if($data[study13_gubun]=="5") echo "국외 학술대회 발표";
                    if($data[study13_gubun]=="6") echo "국제적 저명학술지(SCI, SSCI, A&HCI) 등재 논문";
                    if($data[study13_gubun]=="7") echo "기타";
                    ?></td>
                <td style="border:1px solid #000"><?=$data[study13_date]?></td>
                <td style="border:1px solid #000"><?=$data[study13_mem]?></td>
                <td style="border:1px solid #000"></td>
                <td style="border:1px solid #000"></td>
            </tr>
        <?}?>
        <?if($data[study14_gubun]){?>
            <tr>
                <td style="border:1px solid #000"></td>
                <td style="border:1px solid #000"><?
                    if($data[study14_gubun]=="1") echo "국내학술지 논문";
                    if($data[study14_gubun]=="2") echo "국외학술지 논문";
                    if($data[study14_gubun]=="3") echo "학술저서";
                    if($data[study14_gubun]=="4") echo "국내 학술대회 발표";
                    if($data[study14_gubun]=="5") echo "국외 학술대회 발표";
                    if($data[study14_gubun]=="6") echo "국제적 저명학술지(SCI, SSCI, A&HCI) 등재 논문";
                    if($data[study14_gubun]=="7") echo "기타";
                    ?></td>
                <td style="border:1px solid #000"><?=$data[study14_date]?></td>
                <td style="border:1px solid #000"><?=$data[study14_mem]?></td>
                <td style="border:1px solid #000"></td>
                <td style="border:1px solid #000"></td>
            </tr>
        <?}?>
        <?if($data[study15_gubun]){?>
            <tr>
                <td style="border:1px solid #000"></td>
                <td style="border:1px solid #000"><?
                    if($data[study15_gubun]=="1") echo "국내학술지 논문";
                    if($data[study15_gubun]=="2") echo "국외학술지 논문";
                    if($data[study15_gubun]=="3") echo "학술저서";
                    if($data[study15_gubun]=="4") echo "국내 학술대회 발표";
                    if($data[study15_gubun]=="5") echo "국외 학술대회 발표";
                    if($data[study15_gubun]=="6") echo "국제적 저명학술지(SCI, SSCI, A&HCI) 등재 논문";
                    if($data[study15_gubun]=="7") echo "기타";
                    ?></td>
                <td style="border:1px solid #000"><?=$data[study15_date]?></td>
                <td style="border:1px solid #000"><?=$data[study15_mem]?></td>
                <td style="border:1px solid #000"></td>
                <td style="border:1px solid #000"></td>
            </tr>
        <?}?>
        <?if($data[study16_gubun]){?>
            <tr>
                <td style="border:1px solid #000"></td>
                <td style="border:1px solid #000"><?
                    if($data[study16_gubun]=="1") echo "국내학술지 논문";
                    if($data[study16_gubun]=="2") echo "국외학술지 논문";
                    if($data[study16_gubun]=="3") echo "학술저서";
                    if($data[study16_gubun]=="4") echo "국내 학술대회 발표";
                    if($data[study16_gubun]=="5") echo "국외 학술대회 발표";
                    if($data[study16_gubun]=="6") echo "국제적 저명학술지(SCI, SSCI, A&HCI) 등재 논문";
                    if($data[study16_gubun]=="7") echo "기타";
                    ?></td>
                <td style="border:1px solid #000"><?=$data[study16_date]?></td>
                <td style="border:1px solid #000"><?=$data[study16_mem]?></td>
                <td style="border:1px solid #000"></td>
                <td style="border:1px solid #000"></td>
            </tr>
        <?}?>
        <?if($data[study17_gubun]){?>
            <tr>
                <td style="border:1px solid #000"></td>
                <td style="border:1px solid #000"><?
                    if($data[study17_gubun]=="1") echo "국내학술지 논문";
                    if($data[study17_gubun]=="2") echo "국외학술지 논문";
                    if($data[study17_gubun]=="3") echo "학술저서";
                    if($data[study17_gubun]=="4") echo "국내 학술대회 발표";
                    if($data[study17_gubun]=="5") echo "국외 학술대회 발표";
                    if($data[study17_gubun]=="6") echo "국제적 저명학술지(SCI, SSCI, A&HCI) 등재 논문";
                    if($data[study17_gubun]=="7") echo "기타";
                    ?></td>
                <td style="border:1px solid #000"><?=$data[study17_date]?></td>
                <td style="border:1px solid #000"><?=$data[study17_mem]?></td>
                <td style="border:1px solid #000"></td>
                <td style="border:1px solid #000"></td>
            </tr>
        <?}?>
        <?if($data[study18_gubun]){?>
            <tr>
                <td style="border:1px solid #000"></td>
                <td style="border:1px solid #000"><?
                    if($data[study18_gubun]=="1") echo "국내학술지 논문";
                    if($data[study18_gubun]=="2") echo "국외학술지 논문";
                    if($data[study18_gubun]=="3") echo "학술저서";
                    if($data[study18_gubun]=="4") echo "국내 학술대회 발표";
                    if($data[study18_gubun]=="5") echo "국외 학술대회 발표";
                    if($data[study18_gubun]=="6") echo "국제적 저명학술지(SCI, SSCI, A&HCI) 등재 논문";
                    if($data[study18_gubun]=="7") echo "기타";
                    ?></td>
                <td style="border:1px solid #000"><?=$data[study18_date]?></td>
                <td style="border:1px solid #000"><?=$data[study18_mem]?></td>
                <td style="border:1px solid #000"></td>
                <td style="border:1px solid #000"></td>
            </tr>
        <?}?>
        <?if($data[study19_gubun]){?>
            <tr>
                <td style="border:1px solid #000"></td>
                <td style="border:1px solid #000"><?
                    if($data[study19_gubun]=="1") echo "국내학술지 논문";
                    if($data[study19_gubun]=="2") echo "국외학술지 논문";
                    if($data[study19_gubun]=="3") echo "학술저서";
                    if($data[study19_gubun]=="4") echo "국내 학술대회 발표";
                    if($data[study19_gubun]=="5") echo "국외 학술대회 발표";
                    if($data[study19_gubun]=="6") echo "국제적 저명학술지(SCI, SSCI, A&HCI) 등재 논문";
                    if($data[study19_gubun]=="7") echo "기타";
                    ?></td>
                <td style="border:1px solid #000"><?=$data[study19_date]?></td>
                <td style="border:1px solid #000"><?=$data[study19_mem]?></td>
                <td style="border:1px solid #000"></td>
                <td style="border:1px solid #000"></td>
            </tr>
        <?}?>
        <?if($data[study20_gubun]){?>

            <tr>
                <td style="border:1px solid #000"></td>
                <td style="border:1px solid #000"><?
                    if($data[study20_gubun]=="1") echo "국내학술지 논문";
                    if($data[study20_gubun]=="2") echo "국외학술지 논문";
                    if($data[study20_gubun]=="3") echo "학술저서";
                    if($data[study20_gubun]=="4") echo "국내 학술대회 발표";
                    if($data[study20_gubun]=="5") echo "국외 학술대회 발표";
                    if($data[study20_gubun]=="6") echo "국제적 저명학술지(SCI, SSCI, A&HCI) 등재 논문";
                    if($data[study20_gubun]=="7") echo "기타";
                    ?></td>
                <td style="border:1px solid #000"><?=$data[study20_date]?></td>
                <td style="border:1px solid #000"><?=$data[study20_mem]?></td>
                <td style="border:1px solid #000"></td>
                <td style="border:1px solid #000"></td>
            </tr>
        <?php } ?>
        <tr>
            <td colspan="6">○ 연구실적물 :    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;       %, 배점  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;         점      </td>
        </tr>
        <tr>
            <td>&nbsp;<td>
            <td><td>
            <td><td>
            <td><td>
            <td><td>
            <td><td>
        </tr>
        <tr >
            <td colspan="6" style="text-align:center;">2018년  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  월   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  일</td>
        </tr>
        <tr>
            <td>&nbsp;<td>
            <td><td>
            <td><td>
            <td><td>
            <td><td>
            <td><td>
        </tr>
        <tr >
            <td colspan="6" style="text-align:right">기초전공심사위원 1  :      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;           (서명)</td>
        </tr>
        <tr >
            <td colspan="6" style="text-align:right">기초전공심사위원 2  :        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;         (서명)</td>
        </tr>
        <tr >
            <td colspan="6" style="text-align:right">기초전공심사위원 3  :        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;         (서명)</td>
        </tr>
        <tr>
            <td>&nbsp;<td>
            <td><td>
            <td><td>
            <td><td>
            <td><td>
            <td><td>
        </tr>
        <tr>
            <td>&nbsp;<td>
            <td><td>
            <td><td>
            <td><td>
            <td><td>
            <td><td>
        </tr>
        <tr>
            <td>&nbsp;<td>
            <td><td>
            <td><td>
            <td><td>
            <td><td>
            <td><td>
        </tr>
        <tr>
            <td>&nbsp;<td>
            <td><td>
            <td><td>
            <td><td>
            <td><td>
            <td><td>
        </tr>
    </table>
    <?php
}
?>