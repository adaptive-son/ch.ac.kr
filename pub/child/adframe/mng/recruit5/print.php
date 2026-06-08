<?
// adframe 공통 인클루드 파일
define("__AF__", TRUE);
// adframe 공통 인클루드 파일
include_once(dirname(__FILE__) . "/../../af_common.php");
// 접속로그
include_once( dirname(__FILE__)."/../recruit/lib/log.access.forPrivate.php" );
// 개인정보 접근로그
if ( $pgidx > 0 ) log_Access_ForPrivate("recruit2-appinfo-pinrt");

if($wr_id != ""){
    $sql1 = " select * from recruit_copy_research where wr_id = '$wr_id' ";
    $data1 = mysql_fetch_array(mysql_query($sql1));
    $date = mysql_fetch_array(mysql_query("select * from recruit_research WHERE parent='$wr_id'"));

}
?>
<script type="text/javascript">
    function GPEN_PRINT(wr_id){
        var p = window.open("./print.php?wr_id="+wr_id,"PrintWin","width=800, height=700, scrollbars=yes");
        p.focus();
    }
</script>
<link rel="stylesheet" href="../admin.css">
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
    function prt(){
        document.getElementById("btn").style.display = "none";

        IEPageSetupX.header = "";
        IEPageSetupX.footer = "";
        IEPageSetupX.topMargin=0
        IEPageSetupX.bottomMargin=5
        IEPageSetupX.rightMargin=5
        IEPageSetupX.leftMargin=5
        IEPageSetupX.PrintBackground = true;
        IEPageSetupX.PaperSize = "A4";
        IEPageSetupX.Preview();

        document.getElementById("btn").style.display = "";


    }
	print();
    -->
</SCRIPT>
<script>
    function Installed()
    {
        if (typeof(document.all("IEPageSetupX"))!="undefined" && document.all("IEPageSetupX")!=null)
            return true;
        else
            return false;
    }
    function PrintTest()
    {
        if (!Installed())
            alert("컨트롤이 설치되지 않았습니다. 정상적으로 인쇄되지 않을 수 있습니다.")
        else
            alert("정상적으로 설치되었습니다.");
    }
</SCRIPT>
<SCRIPT language="JavaScript" for="IEPageSetupX" event="OnError(ErrCode, ErrMsg)">
    alert('에러 코드: ' + ErrCode + "\n에러 메시지: " + ErrMsg);
</SCRIPT>
<!--OBJECT id='IEPageSetupX' classid="clsid:41C5BC45-1BE8-42C5-AD9F-495D6C8D7586" codebase="./cab/IEPageSetupX.cab#version=1,3,0,2" style="width:0;height:0">
    <!--<param name="copyright" value="http://isulnara.com">--
    <div style="position:absolute;top:276;left:320;width:300;height:68;border:solid 1 #99B3A0;background:#D8D7C4;overflow:hidden;z-index:1;visibility:visible;"><FONT style='font-family: "굴림", "Verdana"; font-size: 9pt; font-style: normal;'><BR>&nbsp;&nbsp;인쇄 여백제어 컨트롤이 설치되지 않았습니다.&nbsp;&nbsp;<BR>&nbsp;&nbsp;<a href="./cab/IEPageSetupX.exe"><font color=red>이곳</font></a>을 클릭하여 수동으로 설치하시기 바랍니다.&nbsp;&nbsp;</FONT></div>
</OBJECT-->
<font color="#616161"><h4>교원채용관리</h4></font>
<!--p><input type="button" id="btn" value="인쇄" style="padding:10px 20px; border:0; background:#f53d3d;font-weight:bold;color:#FFFFFF;cursor:pointer" onclick="prt()" /></p-->
<table width="1000" class="table_box_recruit" style="margin-top:50px">
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
        <td colspan="8" class="sub_title" style="text-align:left;padding-left:10px;">접수번호 : </td>
    </tr>
    <tr>
        <td colspan="6" class="sub_title">1.지원사항</td>
        <td colspan="2" rowspan="5"><?if($data1[file_name]){?><img id="img_preview" src="<?=$data1[file_name]?>" height="200px"/><?}?></td>
    </tr>
    <tr>
        <th>지원학과</th>
        <td colspan="2" class="left">
            <?=$data1[apply_major]?>
        </td>
        <th>초빙분야</th>
        <td colspan="2" class="left">
            <?=$date[type_gubun]?>
        </td>
    </tr>
    <tr>
        <th>초빙분야 구분번호</th>
        <td colspan="2" class="left"><?=$data1[major]?></td>
        <th>담당과목명</th>
        <td colspan="2" class="left"><?=$data1[damdang_class]?></td>
    </tr>
    <tr>
        <th>성명</th>
        <td class="left" colspan="2">
            [국문]<br />
            <?=$data1[kor_name]?>
        </td>
        <td class="left" colspan="2">
            [영문]<br />
            <?=$data1[eng_name]?>
        </td>
        <td class="left">
            [한문]<br />
            <?=$data1[chi_name]?>
        </td>
    </tr>
    <tr>
        <td colspan="6" class="sub_title">2.인적사항사항</td>
    </tr>
    <tr>
        <th>성별</th>
        <td colspan="2"><?=$data1[sex]?></td>
        <th>국적</th>
        <td colspan="2"><?=$data1[country]?></td>
        <th>병역</th>
        <td><?=$data1[army]?></td>
    </tr>
    <?
    $birth = explode("-",$data1[birth]);
    ?>
    <tr>
        <th>생년월일</th>
        <td colspan="4"><?=$birth[0]?> 년&nbsp;&nbsp;<?=$birth[1]?> 월&nbsp;&nbsp;<?=$birth[2]?> 일&nbsp;&nbsp;(만<?=$data1[age]?> 세)</td>
        <th rowspan="3">연락처</th>
        <td colspan="2" rowspan="3" class="left">
            <div><span style="width:40px;display:inline-block">자택</span> : <?=$data1[hTel]?></div>
            <div style="margin-top:5px;"><span style="width:40px; display:inline-block">직장</span> : <?=$data1[jTel]?></div>
            <div style="margin-top:5px;"><span style="width:40px; display:inline-block">휴대폰</span> : <?=$data1[phone]?></div>
            <div style="margin-top:5px;"><span style="width:40px; display:inline-block">Email</span> : <?=$data1[email]?> </div>
        </td>
    </tr>
    <tr>
        <th>현주소<br />(국내연락처)</th>
        <td colspan="4" class="left">
            <div >(우편번호 : <?=$data1[zip]?>)</div>
            <div style="padding-top:5px;"><?=$data1[addr1]?></div>
            <div style="padding-top:5px;"><?=$data1[addr2]?></div>
        </td>
    </tr>
    <tr>
        <th>현근무지</th>
        <td colspan="4" class="left"><?=$data1[company]?></td>
    </tr>
	<tr>
        <th>은행명</th>
        <td colspan="3" class="left"><?=$data1[bank_name]?></td>
		 <th>계좌번호</th>
        <td colspan="3" class="left"><?=$data1[bank_account]?></td>
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
        <td colspan="2"><?=$data1[hPeriod]?></td>
        <td colspan="2"><?=$data1[hSchool]?></td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
    </tr>
    <?php
    if($data1[colleage]){
        ?>
        <tr>
            <th>전문학사1</th>
            <td colspan="2"><?=$data1[cPeriod]?></td>
            <td colspan="2"><?=$data1[colleage]?></td>
            <td><?=$data1[cMajor]?></td>
            <td><?=$data1[cDegree]?><br /> (<?=$data1[cDegree_date]?>)</td>
            <td><?=$data1[cScore]?> / <?=$data1[cTotal]?></td>
        </tr>
        <?php
    }
    if($data1[colleage1]){
        ?>
        <tr>
            <th>전문학사2</th>
            <td colspan="2"><?=$data1[cPeriod1]?></td>
            <td colspan="2"><?=$data1[colleage1]?></td>
            <td><?=$data1[cMajor1]?></td>
            <td><?=$data1[cDegree1]?><br /> (<?=$data1[cDegree_date1]?>)</td>
            <td><?=$data1[cScore1]?> / <?=$data1[cTotal1]?></td>
        </tr>
        <?php
    }

    ?>
    <tr>
        <th>학사1</th>
        <td colspan="2"><?=$data1[uPeriod]?></td>
        <td colspan="2"><?=$data1[univ]?></td>
        <td><?=$data1[uMajor]?></td>
        <td><?=$data1[uDegree]?><br /> (<?=$data1[uDegree_date]?>)</td>
        <td><?=$data1[uScore]?> / <?=$data1[uTotal]?></td>
    </tr>
    <?php
    if($data1[univ1]){
        ?>
        <tr>
            <th>학사2</th>
            <td colspan="2"><?=$data1[uPeriod1]?></td>
            <td colspan="2"><?=$data1[univ1]?></td>
            <td><?=$data1[uMajor1]?></td>
            <td><?=$data1[uDegree1]?><br /> (<?=$data1[uDegree_date1]?>)</td>
            <td><?=$data1[uScore1]?> / <?=$data1[uTotal1]?></td>
        </tr>
        <?php
    }
    ?>

    <tr>
        <th>석사1</th>
        <td colspan="2"><?=$data1[mPeriod]?></td>
        <td colspan="2"><?=$data1[master]?></td>
        <td><?=$data1[mMajor]?></td>
        <td><?=$data1[mDegree]?><br /> (<?=$data1[mDegree_date]?>)</td>
        <td><?=$data1[mScore]?> / <?=$data1[mTotal]?></td>
    </tr>
    <?php
    if($data1[master1]){
        ?>
        <tr>
            <th>석사2</th>
            <td colspan="2"><?=$data1[mPeriod1]?></td>
            <td colspan="2"><?=$data1[master1]?></td>
            <td><?=$data1[mMajor1]?></td>
            <td><?=$data1[mDegree1]?><br /> (<?=$data1[mDegree_date1]?>)</td>
            <td><?=$data1[mScore1]?> / <?=$data1[mTotal1]?></td>
        </tr>
        <?php
    }

    if($data1[doctor]){
        ?>
        <tr>
            <th>박사1</th>
            <td colspan="2"><?=$data1[dPeriod]?></td>
            <td colspan="2"><?=$data1[doctor]?></td>
            <td><?=$data1[dMajor]?></td>
            <td><?=$data1[dDegree]?><br /> (<?=$data1[dDegree_date]?>)</td>
            <td><?=$data1[dScore]?> / <?=$data1[dTotal]?></td>
        </tr>
        <?php
    }
    if($data1[doctor1]){
        ?>
        <tr>
            <th>박사2</th>
            <td colspan="2"><?=$data1[dPeriod1]?></td>
            <td colspan="2"><?=$data1[doctor1]?></td>
            <td><?=$data1[dMajor1]?></td>
            <td><?=$data1[dDegree1]?><br /> (<?=$data1[dDegree_date1]?>)</td>
            <td><?=$data1[dScore1]?> / <?=$data1[dTotal1]?></td>
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

    $jobPeriod1 = explode("-",$data1[jobPeriod1]);
    $jobPeriod2 = explode("-",$data1[jobPeriod2]);
    $jobPeriod3 = explode("-",$data1[jobPeriod3]);
    $jobPeriod4 = explode("-",$data1[jobPeriod4]);
    $jobPeriod5 = explode("-",$data1[jobPeriod5]);
    $jobPeriod6 = explode("-",$data1[jobPeriod6]);
    $jobPeriod7 = explode("-",$data1[jobPeriod7]);
    $jobPeriod8 = explode("-",$data1[jobPeriod8]);
    $jobPeriod9 = explode("-",$data1[jobPeriod9]);
	$jobPeriod10 = explode("-",$data1[jobPeriod10]);
	$jobPeriod11 = explode("-",$data1[jobPeriod11]);
	$jobPeriod12 = explode("-",$data1[jobPeriod12]);
	$jobPeriod13 = explode("-",$data1[jobPeriod13]);
	$jobPeriod14 = explode("-",$data1[jobPeriod14]);
	$jobPeriod15 = explode("-",$data1[jobPeriod15]);

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

    ?>
    <?php
    if($data1[jpsPeriod1]){
        ?>
        <tr>
            <td colspan="3"><?=$data1[jpsPeriod1]?> ~ <?=$data1[jpePeriod1]?></td>
            <td colspan="2"><?=$jobPeriod1[0]?>&nbsp;년&nbsp;&nbsp;<?=$jobPeriod1[1]?>&nbsp;월</td>
            <td colspan="2"><?=$data1[jobCompany1]?> </td>
            <td><?=$data1[jobDegree1]?></td>
        </tr>
        <?php
    }
    if($data1[jpsPeriod2]){
        ?>
        <tr>
            <td colspan="3"><?=$data1[jpsPeriod2]?> ~ <?=$data1[jpePeriod2]?></td>
            <td colspan="2"><?=$jobPeriod2[0]?>&nbsp;년&nbsp;&nbsp;<?=$jobPeriod2[1]?>&nbsp;월</td>
            <td colspan="2"><?=$data1[jobCompany2]?></td>
            <td><?=$data1[jobDegree2]?></td>
        </tr>
        <?php
    }
    if($data1[jpsPeriod3]){
        ?>
        <tr>
            <td colspan="3"><?=$data1[jpsPeriod3]?> ~ <?=$data1[jpePeriod3]?></td>
            <td colspan="2"><?=$jobPeriod3[0]?>&nbsp;년&nbsp;&nbsp;<?=$jobPeriod3[1]?>&nbsp;월</td>
            <td colspan="2"><?=$data1[jobCompany3]?></td>
            <td><?=$data1[jobDegree3]?></td>
        </tr>
        <?php
    }
    if($data1[jpsPeriod4]){
        ?>
        <tr>
            <td colspan="3"><?=$data1[jpsPeriod4]?> ~ <?=$data1[jpePeriod4]?></td>
            <td colspan="2"><?=$jobPeriod4[0]?>&nbsp;년&nbsp;&nbsp;<?=$jobPeriod4[1]?>&nbsp;월</td>
            <td colspan="2"><?=$data1[jobCompany4]?></td>
            <td><?=$data1[jobDegree4]?></td>
        </tr>
        <?php
    }
    if($data1[jpsPeriod5]){
        ?>
        <tr>
            <td colspan="3"><?=$data1[jpsPeriod5]?> ~ <?=$data1[jpePeriod5]?></td>
            <td colspan="2"><?=$jobPeriod5[0]?>&nbsp;년&nbsp;&nbsp;<?=$jobPeriod5[1]?>&nbsp;월</td>
            <td colspan="2"><?=$data1[jobCompany5]?></td>
            <td><?=$data1[jobDegree5]?></td>
        </tr>
        <?php
    }
    if($data1[jpsPeriod6]){
        ?>
        <tr>
            <td colspan="3"><?=$data1[jpsPeriod6]?> ~ <?=$data1[jpePeriod6]?></td>
            <td colspan="2"><?=$jobPeriod6[0]?>&nbsp;년&nbsp;&nbsp;<?=$jobPeriod6[1]?>&nbsp;월</td>
            <td colspan="2"><?=$data1[jobCompany6]?></td>
            <td><?=$data1[jobDegree6]?></td>
        </tr>
        <?php
    }
    if($data1[jpsPeriod7]){
        ?>
        <tr>
            <td colspan="3"><?=$data1[jpsPeriod7]?> ~ <?=$data1[jpePeriod7]?></td>
            <td colspan="2"><?=$jobPeriod7[0]?>&nbsp;년&nbsp;&nbsp;<?=$jobPeriod7[1]?>&nbsp;월</td>
            <td colspan="2"><?=$data1[jobCompany7]?></td>
            <td><?=$data1[jobDegree7]?></td>
        </tr>
        <?php
    }
    if($data1[jpsPeriod8]){
        ?>
        <tr>
            <td colspan="3"><?=$data1[jpsPeriod8]?> ~ <?=$data1[jpePeriod8]?></td>
            <td colspan="2"><?=$jobPeriod8[0]?>&nbsp;년&nbsp;&nbsp;<?=$jobPeriod8[1]?>&nbsp;월</td>
            <td colspan="2"><?=$data1[jobCompany8]?></td>
            <td><?=$data1[jobDegree8]?></td>
        </tr>
        <?php
    }
    if($data1[jpsPeriod9]){
        ?>
        <tr>
            <td colspan="3"><?=$data1[jpsPeriod9]?> ~ <?=$data1[jpePeriod9]?></td>
            <td colspan="2"><?=$jobPeriod9[0]?>&nbsp;년&nbsp;&nbsp;<?=$jobPeriod9[1]?>&nbsp;월</td>
            <td colspan="2"><?=$data1[jobCompany9]?></td>
            <td><?=$data1[jobDegree9]?></td>
        </tr>
        <?php
    } 
		if($data1[jpsPeriod10]){
        ?>
        <tr>
            <td colspan="3"><?=$data1[jpsPeriod10]?> ~ <?=$data1[jpePeriod10]?></td>
            <td colspan="2"><?=$jobPeriod10[0]?>&nbsp;년&nbsp;&nbsp;<?=$jobPeriod10[1]?>&nbsp;월</td>
            <td colspan="2"><?=$data1[jobCompany10]?></td>
            <td><?=$data1[jobDegree10]?></td>
        </tr>
        <?php
    } if($data1[jpsPeriod11]){
        ?>
        <tr>
            <td colspan="3"><?=$data1[jpsPeriod11]?> ~ <?=$data1[jpePeriod11]?></td>
            <td colspan="2"><?=$jobPeriod11[0]?>&nbsp;년&nbsp;&nbsp;<?=$jobPeriod11[1]?>&nbsp;월</td>
            <td colspan="2"><?=$data1[jobCompany11]?></td>
            <td><?=$data1[jobDegree11]?></td>
        </tr>
        <?php
    } if($data1[jpsPeriod12]){
        ?>
        <tr>
            <td colspan="3"><?=$data1[jpsPeriod12]?> ~ <?=$data1[jpePeriod12]?></td>
            <td colspan="2"><?=$jobPeriod12[0]?>&nbsp;년&nbsp;&nbsp;<?=$jobPeriod12[1]?>&nbsp;월</td>
            <td colspan="2"><?=$data1[jobCompany12]?></td>
            <td><?=$data1[jobDegree12]?></td>
        </tr>
        <?php
    } if($data1[jpsPeriod13]){
        ?>
        <tr>
            <td colspan="3"><?=$data1[jpsPeriod13]?> ~ <?=$data1[jpePeriod13]?></td>
            <td colspan="2"><?=$jobPeriod13[0]?>&nbsp;년&nbsp;&nbsp;<?=$jobPeriod13[1]?>&nbsp;월</td>
            <td colspan="2"><?=$data1[jobCompany13]?></td>
            <td><?=$data1[jobDegree13]?></td>
        </tr>
        <?php
    } if($data1[jpsPeriod14]){
        ?>
        <tr>
            <td colspan="3"><?=$data1[jpsPeriod14]?> ~ <?=$data1[jpePeriod14]?></td>
            <td colspan="2"><?=$jobPeriod14[0]?>&nbsp;년&nbsp;&nbsp;<?=$jobPeriod14[1]?>&nbsp;월</td>
            <td colspan="2"><?=$data1[jobCompany14]?></td>
            <td><?=$data1[jobDegree14]?></td>
        </tr>
        <?php
    } if($data1[jpsPeriod15]){
        ?>
        <tr>
            <td colspan="3"><?=$data1[jpsPeriod15]?> ~ <?=$data1[jpePeriod15]?></td>
            <td colspan="2"><?=$jobPeriod15[0]?>&nbsp;년&nbsp;&nbsp;<?=$jobPeriod15[1]?>&nbsp;월</td>
            <td colspan="2"><?=$data1[jobCompany15]?></td>
            <td><?=$data1[jobDegree15]?></td>
        </tr>
        <?php
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
    if($data1[etc1]){
        ?>
        <tr>
            <td colspan="3"><?=$data1[etc1]?></td>
            <td colspan="3"><?=$data1[etc1_date]?></td>
            <td colspan="2"><?=$data1[etc1_company]?></td>
        </tr>
        <?php
    }
    if($data1[etc2]){
        ?>
        <tr>
            <td colspan="3"><?=$data1[etc2]?></td>
            <td colspan="3"><?=$data1[etc2_date]?></td>
            <td colspan="2"><?=$data1[etc2_company]?></td>
        </tr>
        <?php
    }
    if($data1[etc3]){
        ?>
        <tr>
            <td colspan="3"><?=$data1[etc3]?></td>
            <td colspan="3"><?=$data1[etc3_date]?></td>
            <td colspan="2"><?=$data1[etc3_company]?></td>
        </tr>
        <?php
    }
    if($data1[etc4]){
        ?>
        <tr>
            <td colspan="3"><?=$data1[etc4]?></td>
            <td colspan="3"><?=$data1[etc4_date]?></td>
            <td colspan="2"><?=$data1[etc4_company]?></td>
        </tr>
        <?php
    }
    if($data1[etc5]){
        ?>
        <tr>
            <td colspan="3"><?=$data1[etc5]?></td>
            <td colspan="3"><?=$data1[etc5_date]?></td>
            <td colspan="2"><?=$data1[etc5_company]?></td>
        </tr>
        <?php
    }
    if($data1[etc6]){
        ?>
        <tr>
            <td colspan="3"><?=$data1[etc6]?></td>
            <td colspan="3"><?=$data1[etc6_date]?></td>
            <td colspan="2"><?=$data1[etc6_company]?></td>
        </tr>
        <?php
    }
	if($data1[etc7]){
        ?>
        <tr>
            <td colspan="3"><?=$data1[etc7]?></td>
            <td colspan="3"><?=$data1[etc7_date]?></td>
            <td colspan="2"><?=$data1[etc7_company]?></td>
        </tr>
        <?php
    }
	if($data1[etc8]){
        ?>
        <tr>
            <td colspan="3"><?=$data1[etc8]?></td>
            <td colspan="3"><?=$data1[etc8_date]?></td>
            <td colspan="2"><?=$data1[etc8_company]?></td>
        </tr>
        <?php
    }
	if($data1[etc9]){
        ?>
        <tr>
            <td colspan="3"><?=$data1[etc9]?></td>
            <td colspan="3"><?=$data1[etc9_date]?></td>
            <td colspan="2"><?=$data1[etc9_company]?></td>
        </tr>
        <?php
    }
	if($data1[etc10]){
        ?>
        <tr>
            <td colspan="3"><?=$data1[etc10]?></td>
            <td colspan="3"><?=$data1[etc10_date]?></td>
            <td colspan="2"><?=$data1[etc10_company]?></td>
        </tr>
        <?php
    }
	if($data1[etc11]){
        ?>
        <tr>
            <td colspan="3"><?=$data1[etc11]?></td>
            <td colspan="3"><?=$data1[etc11_date]?></td>
            <td colspan="2"><?=$data1[etc11_company]?></td>
        </tr>
        <?php
    }
	if($data1[etc12]){
        ?>
        <tr>
            <td colspan="3"><?=$data1[etc12]?></td>
            <td colspan="3"><?=$data1[etc12_date]?></td>
            <td colspan="2"><?=$data1[etc12_company]?></td>
        </tr>
        <?php
    }
	if($data1[etc13]){
        ?>
        <tr>
            <td colspan="3"><?=$data1[etc13]?></td>
            <td colspan="3"><?=$data1[etc13_date]?></td>
            <td colspan="2"><?=$data1[etc13_company]?></td>
        </tr>
        <?php
    }
	if($data1[etc14]){
        ?>
        <tr>
            <td colspan="3"><?=$data1[etc14]?></td>
            <td colspan="3"><?=$data1[etc14_date]?></td>
            <td colspan="2"><?=$data1[etc14_company]?></td>
        </tr>
        <?php
    }
	if($data1[etc15]){
        ?>
        <tr>
            <td colspan="3"><?=$data1[etc15]?></td>
            <td colspan="3"><?=$data1[etc15_date]?></td>
            <td colspan="2"><?=$data1[etc15_company]?></td>
        </tr>
        <?php
    }

    ?>
</table>