<?php
// adframe 공통 인클루드 파일
include_once "../_common.php";
// 접속로그
//include_once( dirname(__FILE__)."/lib/log.access.forPrivate.php" );
$DBTable = "recruit_index_employment";

$idx = $_GET['idx'];
$gubun = $_GET['gubun'];
if($idx){
    $sql = "SELECT * FROM ".$DBTable." WHERE idx='".$idx."'";
    $result = DBquery($sql);
    $row = mysql_fetch_array($result);
	$gubun = $row['gubun'];
}
?>
<link rel="stylesheet" href="../admin.css">
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
    <!--
    $(function(){
        $("#start_date,#end_date").datepicker({
            dateFormat: 'yy-mm-dd'
        });
    });

    function check_form(f){
        if(f.subject.value==""){alert("채용제목을 입력하세요."); f.subject.focus(); return false;}
        if(f.start_date.value==""){alert("접수일자를 입력하세요."); f.start_date.focus(); return false;}
        if(f.end_date.value==""){alert("접수일자를 입력하세요."); f.end_date.focus(); return false;}
		if(f.gubun.value==""){alert("채용구분을 선택하세요."); f.gubun.focus(); return false;}
    }
    //-->
</script>
<div align="left">
    <font color="#616161"><h4>채용관리</h4></font>
    <form name="frm" method="POST" action="./recruit_proc.php" onsubmit="return check_form(this)" />
    <input type="hidden" name="idx" value="<?=$idx?>" />
    <table border="0" cellpadding="0" cellspacing="1" bgcolor="D8D8D8" width="70%" >
        <colgroup>
            <col width="20%" >
            <col width="80%" >
        </colgroup>
        <tbody>
        <tr height="34" bgcolor="FAFAFA">
            <th>채용제목</th>
            <td style="padding-left:10px"><input type="text" name="subject" value="<?=$row['subject']?>" style="width:80%"/></td>
        </tr>
        <tr height="34" bgcolor="FAFAFA">
            <th>접수일자</th>
            <td style="padding-left:10px"><input type="text" id="start_date" name="start_date" value="<?=$row['start_date']?>" style="width:80px" readonly/> ~ <input type="text" id="end_date" name="end_date" value="<?=$row['end_date']?>" style="width:80px" readonly/> ex)2017-01-01형식으로 입력</td>
        </tr>
		<tr height="34" bgcolor="FAFAFA">
            <th>채용구분</th>
            <td style="padding-left:10px">
				<select id="gubun" name="gubun">
					<option value="">선택</option>
					<option value="직원" <?php if($gubun=="직원"){echo "selected";}?>>직원</option>
					<option value="산학협력단" <?php if($gubun=="산학협력단"){echo "selected";}?>>산학협력단</option>
					<option value="한국어강사" <?php if($gubun=="한국어강사"){echo "selected";}?>>한국어강사</option>
				</select
            </td>
        </tr>
        </tbody>
    </table><br />
    <table width="70%" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td style="text-align:center"><input type="submit" class='btn1' value='등록' style="cursor:pointer"/>&nbsp;<input type="button" class='btn1' value='취소' onclick="location.href='./index.php'" style="cursor:pointer"></td>
        </tr>
    </table>
    </form>
</div>