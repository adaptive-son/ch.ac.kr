<?
// adframe 공통 인클루드 파일
define("__AF__", TRUE);
// adframe 공통 인클루드 파일
include_once(dirname(__FILE__) . "/../../af_common.php");
// 접속로그
include_once( dirname(__FILE__)."/../recruit/lib/log.access.forPrivate.php" );
// 개인정보 접근로그
if ( $pgidx > 0 ) log_Access_ForPrivate("recruit2-appinfo-pinrt2");
if($wr_id != ""){
    $sql1 = " select * from recruit_copy_bi where wr_id = '$wr_id' ";
    $data1 = mysql_fetch_array(mysql_query($sql1));
    $date = mysql_fetch_array(mysql_query("select * from recruit_bi1 WHERE parent='$wr_id'"));

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
    <!--<param name="copyright" value="http://isulnara.com">-
    <div style="position:absolute;top:276;left:320;width:300;height:68;border:solid 1 #99B3A0;background:#D8D7C4;overflow:hidden;z-index:1;visibility:visible;"><FONT style='font-family: "굴림", "Verdana"; font-size: 9pt; font-style: normal;'><BR>&nbsp;&nbsp;인쇄 여백제어 컨트롤이 설치되지 않았습니다.&nbsp;&nbsp;<BR>&nbsp;&nbsp;<a href="./cab/IEPageSetupX.exe"><font color=red>이곳</font></a>을 클릭하여 수동으로 설치하시기 바랍니다.&nbsp;&nbsp;</FONT></div>
</OBJECT>
<p><input type="button" id="btn" value="인쇄" style="padding:10px 20px; border:0; background:#f53d3d;font-weight:bold;color:#FFFFFF;cursor:pointer" onclick="prt()" /></p-->
<div style="margin-top:50px">
    <font color="#616161"><h4><?=$data1[kor_name]?> 님</h4></font>


    <table class="table_box_recruit" style="margin:10px 0px 10px 0px;">
        <colgroup>
            <!--col width="150px">
            <col width="200px">
            <col width="350px">
            <col width="100px">
            <col width="100px">
            <col width="100px"-->
            <col width="110px">
            <col width="160px">
            <col width="300px">
            <col width="80px">
            <col width="70px">
            <col width="60px">
        </colgroup>
        <?

        ?>
        <tr>
            <td colspan="6" class="sub_title">자기소개서</td>
        </tr>
        <tr>
            <td colspan="6" class="left"><?=nl2br($date[profile])?></td>
        </tr>
    </table>
</div>
