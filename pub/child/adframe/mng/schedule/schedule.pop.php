<?
// adframe 공통 인클루드 파일
include_once "../_common.php";

if ($mode == "u") {
    $sql = "select * from " . TABLE_SCHEDULE . " where del_yn='N' AND schedule_no = '" . $schedule_no . "'";
    $vinfo = mysql_fetch_array(mysql_query($sql));
    $title = "수정";

} else if ($j == "") {
    $title = "입력";
}


?>

<!DOCTYPE HTML>
<html lang="ko">

<head>
    <? include_once("../include/__meta.php"); ?>
    <title> 관리자페이지 </title>

    <script type="text/javascript">
        $(document).ready(function(){
        });
    </script>
	<script>
		$.datepicker.setDefaults({
			dateFormat: 'yy-mm-dd',
			prevText: '이전 달',
			nextText: '다음 달',
			monthNames: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
			monthNamesShort: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
			dayNames: ['일', '월', '화', '수', '목', '금', '토'],
			dayNamesShort: ['일', '월', '화', '수', '목', '금', '토'],
			dayNamesMin: ['일', '월', '화', '수', '목', '금', '토'],
			showMonthAfterYear: true,
			changeMonth : true,
			changeYear : true,
			yearRange: "-30:+10",
			yearSuffix: '년'
		});


		$(function() {
			$(".date").datepicker({
				dateFormat: 'yy-mm-dd'
			}).attr('readonly','readonly');
		});

		function write_confirm(obj) {
			var startDt = obj.schedule_start_date.value;
			var endDt = obj.schedule_end_date.value;

			if(obj.schedule_start_date.value.length <= 0) {
				alert("일정시작일을 선택하세요");
				obj.schedule_start_date.focus();
				return false;
			} else if(obj.schedule_end_date.value.length <= 0) {
				alert("일정종료일을 선택하세요");
				obj.schedule_end_date.focus();
				return false;
			} else if(obj.schedule_memo.value.length <= 0) {
				alert("일정을 입력하세요");
				obj.schedule_memo.focus();
				return false;
			} else if(Number(startDt.replace(/-/gi,"")) > Number(endDt.replace(/-/gi,"")) ){
				alert("일정시작일이 일정종료일보다 클 수 없습니다.");
				return false;
			}
		}
	</script>
</head>
<body>

<!-- wrapper -->
<div class="wrapper" id="wrapper" style="padding: 0; padding-left: 31px; min-height: 550px; background-color: #fff;">
    <div class="contents">
        <form name="frm_userinfo" id="frm_userinfo" method="POST" action="schedule.proc.php" onSubmit="return write_confirm(this)"  enctype="multipart/form-data">
            <input type="hidden" name="mode" id="mode" value="<?=$mode?>"/>
            <input type="hidden" name="schedule_no" id="schedule_no" value="<?=$schedule_no?>"/>
            <h2 class="title0201">일정 관리</h2>

            <div class="menu-title-area">
                <h3 class="title0301">
                    일정
                </h3>
            </div>
            <div class="t1 mb30">
                <table style="width: 100%">
                    <colgroup>
                        <col style="width: 20%">
                        <col style="width: 30%">
                        <col style="width: 20%">
                        <col style="width: 30%">
                    </colgroup>
                    <tbody>
                    <tr>
						<th>일정시작일</th>
                        <td><input type="text" name="schedule_start_date" id="schedule_start_date" class="date" value="<?=$vinfo["schedule_start_date"]?>" required=""  style="display: inline-block;"/></td>
						<th>일정종료일</th>
                        <td><input type="text" name="schedule_end_date" id="schedule_end_date" class="date" value="<?=$vinfo["schedule_end_date"]?>" required=""  style="display: inline-block;"/></td>
                    </tr>
					<tr>
						<th>일정</th>
                        <td colspan="3"><textarea style="width:650px;height:80px;" name="schedule_memo" id="schedule_memo"><?=$vinfo["schedule_memo"]?></textarea></td>
					</tr>
                    </tbody>
                </table>
            </div>

            <div class="btns-center">
                <button type="submit" class="btn-type01">
                    확인
                </button>
                <a href="javascript:history.back(-1);" class="btn-type02">
                    목록
                </a>
            </div>

        </form>

    </div>
</div>
<!-- //wrapper -->

</body>
</html>