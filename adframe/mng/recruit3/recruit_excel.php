<?
header( "Content-type: application/vnd.ms-excel" );
header( "Content-type: application/vnd.ms-excel; charset=utf-8");
header( "Content-Disposition: attachment; filename = 강사채용리스트.xls" );
header( "Content-Description: PHP4 Generated Data" );
// adframe 공통 인클루드 파일
include_once "../_common.php";
// 접속로그
include_once( dirname(__FILE__)."/../recruit/lib/log.access.forPrivate.php" );
// 개인정보 접근로그
if ( $pgidx > 0 ) log_Access_ForPrivate("recruit-applist-downloadExcel");

$DBTable = "recruit_te_copy";

$pagecnt=$pagecnt;
$letter_no=$letter_no;
$offset=$offset;

if($searchstring) {
    $search_qry = " AND $search LIKE '%".$searchstring."%' ";
}

$pg_qry = "SELECT * FROM ".$DBTable." WHERE  wr_id > 0 AND resume_num='$resume_num' $search_qry ORDER BY wr_id asc ";
$pg_result = mysql_query($pg_qry);

?>





<table border=1 cellspacing=0 cellpadding=0 width=100% >

    <tr align="center" height="30" >

        <td>번호</td>
        <td>접수번호</td>
        <td>초빙구분</td>
        <td>접수일</td>
        <td>지원구분</td>
        <td>지원전공분야</td>
        <td>성명</td>
        <td>성별</td>
        <td>생년월일</td>
        <td>전문학사</td>
        <td>학사</td>
        <td>석사</td>
        <td>박사</td>
        <td>연구실적물</td>
        <td>결혼여부</td>
        <td>비상연락번호</td>
        <td>비고</td>

    </tr>

    <?

    $pg_result=DBquery($pg_qry);

    $k =1;
    while($pg_row=mysql_fetch_array($pg_result)){


        $s_level = "";
        $level = strlen($pg_row[no]) / 2 - 1;


        $date = mysql_fetch_array(mysql_query("SELECT * FROM recruit_te WHERE parent='$pg_row[wr_id]'"));
        $school_addr = mysql_fetch_array(mysql_query("SELECT * FROM recruit_te_school_addr WHERe parent='$pg_row[wr_id]'"));
        ?>

        <tr align="center" height="30" >
            <td><?=$k?></td>
            <td><?=$pg_row['apply_num']?></td>
            <td>
                <?=$date['type_gubun']?>
            </td>
            <td>
                <?=substr($date[wr_datetime],0,10)?>
            </td>
            <td><?=$pg_row['gubun']?></td>
            <td><?=$pg_row['apply_major']?></td>
            <td><?=$pg_row['kor_name']?></td>
            <td><?=$pg_row['sex']?></td>
            <td><?=$pg_row['birth']?></td>
            <td>
                <?
                if($pg_row['colleage']){
                    echo $pg_row['colleage']."(".$pg_row['cMajor'].")";
                }
                if($pg_row['colleage1']){echo "<br />".$pg_row['colleage1']."(".$pg_row['cMajor1'].")";}
                ?>
            </td>
            <td>
                <?
                if($pg_row['univ']){
                    echo $pg_row['univ']."(".$pg_row['uMajor'].")";
                }
                if($pg_row['univ1']){echo "<br />".$pg_row['univ1']."(".$pg_row['uMajor1'].")";}
                ?>
            </td>
            <td>
                <?php
                if($pg_row['master']){
                    echo $pg_row['master']."(".$pg_row['mMajor'].")-".$pg_row['mDegree'];
                }
                if($pg_row['master1']){echo "<br />".$pg_row['master1']."(".$pg_row['mMajor1'].")-".$pg_row['mDegree1'];}
                ?>
            </td>
            <td>
                <?
                if($pg_row['doctor']){
                    echo $pg_row['doctor']."(".$pg_row['dMajor'].")-".$pg_row['dDegree'];
                }
                if($pg_row['doctor1']){echo "<br />".$pg_row['doctor1']."(".$pg_row['dMajor1'].")-".$pg_row['dDegree1'];}
                ?>
            </td>
            <td>
                <?
                $count="0";
                if($date['thesis1_subject']){
                    $count++;
                }
                if($date['thesis2_subject']){
                    $count++;
                }
                if($date['study1_subject']){
                    $count++;
                }
                if($date['study2_subject']){
                    $count++;
                }
                if($date['study3_subject']){
                    $count++;
                }
                if($date['study4_subject']){
                    $count++;
                }
                if($date['study5_subject']){
                    $count++;
                }
                if($date['study6_subject']){
                    $count++;
                }
                if($date['study7_subject']){
                    $count++;
                }
                if($date['study8_subject']){
                    $count++;
                }
                if($date['study9_subject']){
                    $count++;
                }
                if($date['study10_subject']){
                    $count++;
                }
                if($date['study11_subject']){
                    $count++;
                }
                if($date['study12_subject']){
                    $count++;
                }
                if($date['study13_subject']){
                    $count++;
                }
                if($date['study14_subject']){
                    $count++;
                }
                if($date['study15_subject']){
                    $count++;
                }
                if($date['study16_subject']){
                    $count++;
                }
                if($date['study17_subject']){
                    $count++;
                }
                if($date['study18_subject']){
                    $count++;
                }
                if($date['study19_subject']){
                    $count++;
                }
                if($date['study20_subject']){
                    $count++;
                }
                echo $count;
                ?>
            </td>
            <td><?=$pg_row['married']?></td>
            <td><?=$pg_row['phone']?></td>
            <td>
                <?php
                $score = "0";
                if($date['thesis1_subject']){
                    $score = $score + 100;
                }
                if($date['thesis2_subject']){
                    $score = $score + 200;
                }

                if($date['study1_subject']){
                    if($date['study1_mem']=="1"){$score = $score + 100;}
                    elseif($date['study1_mem']=="2"){$score = $score + 70;}
                    elseif($date['study1_mem']=="3"){$score = $score + 50;}
                    elseif($date['study1_mem']>"3"){$score = $score + 30;}
                }

                if($date['study2_subject']){
                    if($date['study2_mem']=="1"){$score = $score + 100;}
                    elseif($date['study2_mem']=="2"){$score = $score + 70;}
                    elseif($date['study2_mem']=="3"){$score = $score + 50;}
                    elseif($date['study2_mem']>"3"){$score = $score + 30;}
                }
                if($date['study3_subject']){
                    if($date['study3_mem']=="1"){$score = $score + 100;}
                    elseif($date['study3_mem']=="2"){$score = $score + 70;}
                    elseif($date['study3_mem']=="3"){$score = $score + 50;}
                    elseif($date['study3_mem']>"3"){$score = $score + 30;}
                }
                if($date['study4_subject']){
                    if($date['study4_mem']=="1"){$score = $score + 100;}
                    elseif($date['study4_mem']=="2"){$score = $score + 70;}
                    elseif($date['study4_mem']=="3"){$score = $score + 50;}
                    elseif($date['study4_mem']>"3"){$score = $score + 30;}
                }
                if($date['study5_subject']){
                    if($date['study5_mem']=="1"){$score = $score + 100;}
                    elseif($date['study5_mem']=="2"){$score = $score + 70;}
                    elseif($date['study5_mem']=="3"){$score = $score + 50;}
                    elseif($date['study5_mem']>"3"){$score = $score + 30;}
                }
                if($date['study6_subject']){
                    if($date['study6_mem']=="1"){$score = $score + 100;}
                    elseif($date['study6_mem']=="2"){$score = $score + 70;}
                    elseif($date['study6_mem']=="3"){$score = $score + 50;}
                    elseif($date['study6_mem']>"3"){$score = $score + 30;}
                }
                if($date['study7_subject']){
                    if($date['study7_mem']=="1"){$score = $score + 100;}
                    elseif($date['study7_mem']=="2"){$score = $score + 70;}
                    elseif($date['study7_mem']=="3"){$score = $score + 50;}
                    elseif($date['study7_mem']>"3"){$score = $score + 30;}
                }
                if($date['study8_subject']){
                    if($date['study8_mem']=="1"){$score = $score + 100;}
                    elseif($date['study8_mem']=="2"){$score = $score + 70;}
                    elseif($date['study8_mem']=="3"){$score = $score + 50;}
                    elseif($date['study8_mem']>"3"){$score = $score + 30;}
                }
                if($date['study9_subject']){
                    if($date['study9_mem']=="1"){$score = $score + 100;}
                    elseif($date['study9_mem']=="2"){$score = $score + 70;}
                    elseif($date['study9_mem']=="3"){$score = $score + 50;}
                    elseif($date['study9_mem']>"3"){$score = $score + 30;}
                }
                if($date['study10_subject']){
                    if($date['study10_mem']=="1"){$score = $score + 100;}
                    elseif($date['study10_mem']=="2"){$score = $score + 70;}
                    elseif($date['study10_mem']=="3"){$score = $score + 50;}
                    elseif($date['study10_mem']>"3"){$score = $score + 30;}
                }
                if($date['study11_subject']){
                    if($date['study11_mem']=="1"){$score = $score + 100;}
                    elseif($date['study11_mem']=="2"){$score = $score + 70;}
                    elseif($date['study11_mem']=="3"){$score = $score + 50;}
                    elseif($date['study11_mem']>"3"){$score = $score + 30;}
                }
                if($date['study12_subject']){
                    if($date['study12_mem']=="1"){$score = $score + 100;}
                    elseif($date['study12_mem']=="2"){$score = $score + 70;}
                    elseif($date['study12_mem']=="3"){$score = $score + 50;}
                    elseif($date['study12_mem']>"3"){$score = $score + 30;}
                }
                if($date['study13_subject']){
                    if($date['study13_mem']=="1"){$score = $score + 100;}
                    elseif($date['study13_mem']=="2"){$score = $score + 70;}
                    elseif($date['study13_mem']=="3"){$score = $score + 50;}
                    elseif($date['study13_mem']>"3"){$score = $score + 30;}
                }
                if($date['study14_subject']){
                    if($date['study14_mem']=="1"){$score = $score + 100;}
                    elseif($date['study14_mem']=="2"){$score = $score + 70;}
                    elseif($date['study14_mem']=="3"){$score = $score + 50;}
                    elseif($date['study14_mem']>"3"){$score = $score + 30;}
                }
                if($date['study15_subject']){
                    if($date['study15_mem']=="1"){$score = $score + 100;}
                    elseif($date['study15_mem']=="2"){$score = $score + 70;}
                    elseif($date['study15_mem']=="3"){$score = $score + 50;}
                    elseif($date['study15_mem']>"3"){$score = $score + 30;}
                }
                if($date['study16_subject']){
                    if($date['study16_mem']=="1"){$score = $score + 100;}
                    elseif($date['study16_mem']=="2"){$score = $score + 70;}
                    elseif($date['study16_mem']=="3"){$score = $score + 50;}
                    elseif($date['study16_mem']>"3"){$score = $score + 30;}
                }
                if($date['study17_subject']){
                    if($date['study17_mem']=="1"){$score = $score + 100;}
                    elseif($date['study17_mem']=="2"){$score = $score + 70;}
                    elseif($date['study17_mem']=="3"){$score = $score + 50;}
                    elseif($date['study17_mem']>"3"){$score = $score + 30;}
                }
                if($date['study18_subject']){
                    if($date['study18_mem']=="1"){$score = $score + 100;}
                    elseif($date['study18_mem']=="2"){$score = $score + 70;}
                    elseif($date['study18_mem']=="3"){$score = $score + 50;}
                    elseif($date['study18_mem']>"3"){$score = $score + 30;}
                }
                if($date['study19_subject']){
                    if($date['study19_mem']=="1"){$score = $score + 100;}
                    elseif($date['study19_mem']=="2"){$score = $score + 70;}
                    elseif($date['study19_mem']=="3"){$score = $score + 50;}
                    elseif($date['study19_mem']>"3"){$score = $score + 30;}
                }
                if($date['study20_subject']){
                    if($date['study20_mem']=="1"){$score = $score + 100;}
                    elseif($date['study20_mem']=="2"){$score = $score + 70;}
                    elseif($date['study20_mem']=="3"){$score = $score + 50;}
                    elseif($date['study20_mem']>"3"){$score = $score + 30;}
                }
                echo $score."%";
                ?>
            </td>
        </tr>
        <?
        $k++;
    }


    ?>
</table>
