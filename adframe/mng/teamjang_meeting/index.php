<? include_once("../_common.php"); ?>
<?php
// 접속로그
if ( $pgidx > 0 ) log_Access_ForPrivate("recruit-categorylist-access");

$DBTable = "teamjang_meeting";
if($_SERVER['REMOTE_ADDR']=="112.217.216.250"){
	//$_SESSION['ID']
}
$pagecnt=$pagecnt;
$letter_no=$letter_no;
$offset=$offset;

if($searchstring) {						
	$search_qry = " AND $search LIKE '%".$searchstring."%' ";
}

$numresults=DBquery("SELECT idx FROM ".$DBTable." WHERE idx > 0 $search_qry ");

//총 레코드수
$numrows=mysql_num_rows($numresults);

$LIMIT	= 20;

//블럭당 페이지 수
$PAGEBLOCK	= 10;

//페이지 번호
if($pagecnt==""){$pagecnt=0;}

//각 페이지의 시작 글
if(!$offset){$offset=$pagecnt*$LIMIT*$PAGEBLOCK;} 


//전체페이지 수
$TotalPage = ceil($numrows / $LIMIT);
//현재페이지
$NowPage = ($offset/$LIMIT)+1;

$letter_no=($numrows+$LIMIT)-($LIMIT*$NowPage);


$pg_qry = "SELECT * FROM ".$DBTable." WHERE  idx > 0 $search_qry ORDER BY idx desc LIMIT $offset,$LIMIT";

?>
<link rel="stylesheet" href="../admin.css">
<script type="text/javascript" src="../js/jquery.js"></script>
<style>
.font_s01 {font-family: 돋움;font-size:13px;color:#ffffff;font-weight:bold;}
.btn1	  {padding-top:3px;}
</style>
<style type="text/css">
<!--

.search_style1 {behavior:url(../inc/selectbox.htc); width:71px; height:10px;}
.search_style2 {behavior:url(../inc/selectbox.htc); width:180px; height:21px;}

.search_box1 { border:solid 1px #dcdcdc; width:149px; height:17px; background:url(../make_img/main/search_bg.gif) no-repeat; background-color:#FFFFFF;}


/*게시판 스타일*/

a.bbs01:link, a.bbs01:visited, a.bbs01:active { text-decoration:none; color:#8c8b8b; font-size:12px; line-height:120%;}
a.bbs01:hover { text-decoration: underline; color:#338cc3; }

a.reply:link, a.reply:visited, a.reply:active { text-decoration:none; color:#6d6d6d; font-size:11px; line-height:120%;}
a.reply:hover { text-decoration: underline; color:#000000; }

a.bbs_pagenum:link, a.bbs_pagenum:visited, a.bbs_pagenum:active { text-decoration:none; color:#888888; font-size:11px; line-height:120%;}
a.bbs_pagenum:hover { text-decoration: none; color:#516dae; font-weight:bold; }


.bbs_reply01{ padding:3px; width:400px; height:29px; border:solid 1px #dcdcdc;}

.bbs_write01 { border:solid 1px #dcdcdc; width:426px; height:17px; background-color:#FFFFFF;}
.bbs_write02{ width:425px; border:solid 1px #dcdcdc; height:85px;}
.bbs_write03 { border:solid 1px #dcdcdc; width:100px; height:17px; background-color:#FFFFFF;}

.bbs01_title_bg {background:url(/bbs/skin/<?=$configBBS[board_skin]?>/images/subject_bgc.gif) repeat-x; height:26px;}
.bbs01_title_l {background:url(/bbs/skin/<?=$configBBS[board_skin]?>/images/subject_bgl.gif) no-repeat; width:5px; height:26px;}
.bbs01_title_r {background:url(/bbs/skin/<?=$configBBS[board_skin]?>/images/subject_bgr.gif) no-repeat; width:5px; height:26px;}
.bbs01_border_bottom { border-bottom:1px solid #e3e3e3; padding:0 5px;}
.bbs01_reply_title {padding-left:21px; padding-right:13px;}
.bbs01_reply_txt { padding:10px 24px;}


.subbbs_txt td { font-size:12px; color:#8c8b8b;}
.subbbs_title { font-size:12px; color:#338cc3; font-weight: bold; padding-left:14px;}

.subbbs_s_txt { font-size:11px; color:#8c8b8b; padding-left:14px;}
.subbbs_s_txt_color { font-size:11px; color:#00bebf; }

.subbbs_body_txt { font-size:12px; color:#8c8b8b; padding:20px; }
.bbs_w_pad15{ padding:5px 0 5px 15px;}

.bbs02_imgborder{ border:1px solid #e5e5e5; width:126px; height:105px;}
.bbs02_border_bottom { border-bottom:1px solid #95acc4; padding:0 5px;} 

.bbs03_border_left { border-left:1px solid #ced9e4;} 
.bbs03_border_bottom { border-bottom:1px solid #ced9e4;} 

.bbs_box2{
font-family:돋움;
font-size:11px;
color:#6d6d6d;
padding:1px 1px 1px 1px; 
border:1px solid; background-color:#f4f4f4; 
border-color:#dedede #dedede #dedede #dedede;
}

-->
</style>
<script>
function preview(no, s) {
	size = s.split('-');
	window.open("./banner_preview.php?no="+no,"_blank", "width="+size[0]+",height="+size[1]+",top=0,left=0");
}
</script>
<script type="text/JavaScript">
var list_update_php = 'banner_list_update.php';
var list_delete_php = 'teamjang_meeting_list_delete.php';

function del_data(i)
{
	ans = confirm("삭제하시겠습니까? \n\n삭제하시면 데이터를 복구하실 수 없습니다.")

	if(ans == true)
	{ 
		location.href = "banner_update.php?Confirm=delete&no="+i
	}
}

function check_all(f)
{
    var chk = document.getElementsByName("chk[]");

    for (i=0; i<chk.length; i++)
        chk[i].checked = f.chkall.checked;
}
function btn_check(f, act)
{
    if (act == "update") // 선택수정
    { 
        f.action = list_update_php;
        str = "수정";
    } 
    else if (act == "delete") // 선택삭제
    { 
        f.action = list_delete_php;
        str = "삭제";
    } 
    else
        return;

    var chk = document.getElementsByName("chk[]");
    var bchk = false;

    for (i=0; i<chk.length; i++)
    {
        if (chk[i].checked)
            bchk = true;
    }

    if (!bchk) 
    {
        alert(str + "할 자료를 하나 이상 선택하세요.");
        return;
    }

    if (act == "delete")
    {
        if (!confirm("선택한 자료를 정말 삭제 하시겠습니까?"))
            return;
    }

    f.submit();
}
</script>
<script type="text/javascript">
function GPEN_PRINT(wr_id){
	var p = window.open("./print.php?wr_id="+wr_id,"PrintWin","width=800, height=700, scrollbars=yes");
	p.focus();
}

$(document).on('click', '.toggleBG', function () {

	var toggleBG = $(this);
	var toggleFG = $(this).children('.toggleFG');
	var toggleidx = toggleFG.attr('data-idx');
	var left = toggleFG.css('left');

	if(left == '8px') {
		toggleBG.css('background', '#CCCCCC');
		toggleActionStart(toggleFG, 'TO_LEFT');
		fnChangeShowYN(toggleidx,'N');
	}else if(left == '-7px') {
		toggleBG.css('background', '#0085ca');
		toggleActionStart(toggleFG, 'TO_RIGHT');
		fnChangeShowYN(toggleidx,'Y');
	}
});
// 토글 버튼 이동 모션 함수
function toggleActionStart(toggleBtn, LR) {
	
	// 0.01초 단위로 실행
	var intervalID = setInterval(
		function() {
			// 버튼 이동
			var left = parseInt(toggleBtn.css('left'));
			left += (LR == 'TO_RIGHT') ? 5 : -5;
			if(left >= -7 && left <= 8) {
				left += 'px';
				toggleBtn.css('left', left);
			}
		}, 10);
	setTimeout(function(){
		clearInterval(intervalID);
	}, 201);
}

function fnChangeShowYN(idx, showYN){
	var param = "idx="+idx+"&showYN="+showYN;
	$.ajax({
    url:'./changeShowYN.php', //request 보낼 서버의 경로
    type:'get', // 메소드(get, post, put 등)
    data:param, //보낼 데이터
    success: function(data) {
        //서버로부터 정상적으로 응답이 왔을 때 실행
				console.log(data);
				alert("수정되었습니다.")
    },
    error: function(err) {
        //서버로부터 응답이 정상적으로 처리되지 못햇을 때 실행
    }
	});

}
</script>
<style>
.toggleBG {background: #CCCCCC; width: 30px; height: 15px; border: 1px solid #999; border-radius: 15px;}
.toggleFG {background: #FFFFFF; width: 15px; height: 15px; border: none; border-radius: 15px; position: relative; left: -7px;}
</style>
<div align="left">
<font color="#616161"><h4>학과장 회의</h4></font>

<table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="D8D8D8">
	<tr>
		<td height="34" bgcolor="FAFAFA">
			<table border="0" align="center" cellpadding="2" cellspacing="0">
				<form name="searchForm" action="<?=$PHP_SELF?>" method="post" onSubmit="return searchSendit();">
					<input type="hidden" name="search" value="m_idx" />
					<tr>
						<td><input type="text" name="searchstring" value="<?=$searchstring?>" style="width:150px;height:23px" class="box3"></td>
						<td><input type="image" src="./images/search.gif" border="0" style="border:0px;"></td>
					</tr>
				</form>
			</table>
		</td>
	</tr>
</table>

<br>

<table border=0 cellspacing=1 cellpadding=0 width=100% bgcolor=#EEEEEE>
	<form name=fboardlist method=post>	
	<tr align="center" height="30" bgcolor="#424a64">
		<td width="30" class="font_s01"><input type="checkbox" style="border:0px;background-color:#424a64;" name=chkall value="1" onclick="check_all(this.form)"></td>
		<td width="80" class="font_s01">ONOFF</td>
		<td width="50" class="font_s01">번호</td>
		<td width="100" class="font_s01">차수</td>
		<td width="150" class="font_s01">일시</td>
		<td class="font_s01" width="150">장소</td>
		<td class="font_s01" width="*">내용</td>
		<td class="font_s01" width="150">회의록 보기</td>
		<td class="font_s01" width="150">엑셀다운로드</td>
	</tr>
 
<?
 
$pg_result=DBquery($pg_qry);
	
if($numrows<1) {
		
?>
	<tr>
		<td colspan="7" align="center" height="30"><b>목록이 없습니다.</b></td>
	</tr>
<? 
}else{
	
	$s_letter=$letter_no; //페이지별 시작 글번호

	for($i=0; $pg_row=mysql_fetch_array($pg_result); $i++)
	{
		
	$s_level = "";
  $level = strlen($pg_row[no]) / 2 - 1;

  if($pg_row['idx'] > 29){
	  $view_url = "meeting_view.php";
	  $xls_url = "";
  }else{
	  $view_url = "./2021/meeting_view.php";
	  $xls_url = "";
  }
	
?>
	<script>
		$(function(){
		<?php if($pg_row['showYN']=="Y"){?>
				$("#toggleBG<?php echo $pg_row['idx']?>").css('background','#0085ca');
				$("#toggleBG<?php echo $pg_row['idx']?> > .toggleFG").css('left','8px');
		<?php }else{ ?>
				$("#toggleBG<?php echo $pg_row['idx']?>").css('background','#cccccc');
				$("#toggleBG<?php echo $pg_row['idx']?> > .toggleFG").css('left','-7px');
		<?php } ?>
		});
	</script>
	<tr align="center" height="30" bgcolor="#F9F9F9" OnMouseOver=style.background='#E1E4EC' OnMouseOut=style.background='#F9F9F9'>
		<td align="center"><input type="checkbox" style="border:0px;background-color:#F9F9F9;" name=chk[] value='<?=$pg_row['idx']?>' ></td>
		<td align="center">
			<div class="toggleBG" id='toggleBG<?php echo $pg_row['idx']?>'>
				<div class='toggleFG' data-idx="<?php echo $pg_row['idx']?>"></div>
			</div>
		</td>
		<td align="center" ><b><?=$letter_no?></b></td>
		<td align="center"><a href="meeting_write.php?idx=<?=$pg_row['idx']?>"><?php echo $pg_row['m_gubun']?></a></td>
		<td align="center"><a href="meeting_write.php?idx=<?=$pg_row['idx']?>"><?php echo $pg_row['m_date']?></a></td>
		<td align="center"><a href="meeting_write.php?idx=<?=$pg_row['idx']?>"><?php echo $pg_row['m_place']?></a></td>
		<td align="left"><?php echo $pg_row['m_memo']?></td>
		<td align="center">
			<input type="button" value="회의록보기" style="padding:5px 10px; border:0; background:#f53d3d;font-weight:bold;color:#FFFFFF;cursor:pointer" onclick="location.href='<?php echo $view_url?>?idx=<?=$pg_row['idx']?>'"/>
		</td>
		<td align="center">
			<input type="button" value="엑셀다운로드" style="padding:5px 10px; border:0; background:#296c49;font-weight:bold;color:#FFFFFF;cursor:pointer" onclick="location.href='meeting_xls.php?idx=<?=$pg_row['idx']?>'"/>
		</td>
	</tr>
<?
	$letter_no--;
	}
}
 
$Obj=new PList($PHP_SELF,$pagecnt,$offset,$numrows,$PAGEBLOCK,$LIMIT,$search,$searchstring,"");

?>
</table>

<table style="padding-top:10px;" width="100%" border="0" cellpadding="0" cellspacing="0">
<tr>
<td align="left"><!--<input type=button class='btn1' value='선택수정' onclick="btn_check(this.form, 'update')"> -->
	<input type="button" class='btn1' value='선택삭제' onclick="btn_check(this.form, 'delete')" style="cursor:pointer" /></td>
<td align="right"><input type="button" class='btn1' value='글쓰기' onclick="location.href='meeting_write.php'" style="cursor:pointer"></td>
</tr>
</table>

</form>
<br>

<table width="100%">
<tr>
<td align="center" height="35">  
<?=$Obj->putList(true,"","","","","","");?>
</td>
</tr>
</table>

</div>
<? include_once("../footer.admin.php"); ?>
