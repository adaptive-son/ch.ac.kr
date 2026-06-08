<?
// adframe 공통 인클루드 파일
include_once "../_common.php";
include_once( dirname(__FILE__)."/lib/class.rList.php" );
// 접속로그
include_once( dirname(__FILE__)."/lib/log.access.forPrivate.php" );
// 개인정보 접근로그
if ( $pgidx > 0 ) log_Access_ForPrivate("recruit-applist-access");

$DBTable = "recruit_copy";
$pagecnt=$pagecnt;
$letter_no=$letter_no;
$offset=$offset;
if($searchstring) $search_qry = " AND $search LIKE '%".$searchstring."%' ";
if($_REQUEST['apply_major']){
    $search_major = " AND apply_major = '".$_REQUEST['apply_major']."'";
}
$numresults=DBquery("SELECT wr_id FROM ".$DBTable." WHERE wr_id > 0 AND resume_num='$resume_gubun' $search_qry $search_major ");
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
$pg_qry = "SELECT wr_id,kor_name,birth,apply_major,phone,email FROM ".$DBTable." WHERE  wr_id > 0 AND resume_num='$resume_gubun' $search_qry $search_major ORDER BY wr_id desc LIMIT $offset,$LIMIT";
$PHP_SELF .= '?resume_gubun='.$resume_gubun;
?>
    <link rel="stylesheet" href="../admin.css">
    <style>
        .font_s01 {font-family: 돋움;font-size:13px;color:#ffffff;font-weight:bold;}
        .btn1	  {padding-top:3px;}
    </style>
    <script type="text/JavaScript">
        var list_delete_php = 'resume_list_delete.php?resume_gubun=<?=$resume_gubun?>';
        function check_all(f)
        {
            var chk = document.getElementsByName("chk[]");

            for (i=0; i<chk.length; i++)
                chk[i].checked = f.chkall.checked;
        }
        function btn_check(f, act)
        {
            if (act == "delete") // 선택삭제
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
        function change_major(){
            var f = document.searchForm;

            f.submit();
        }
    </script>
    <script type="text/javascript">
        function GPEN_PRINT(wr_id){
            var p = window.open("./print.php?wr_id="+wr_id,"PrintWin","width=800, height=700, scrollbars=yes");
            p.focus();
        }
        function GPEN2_PRINT(wr_id){
            var p = window.open("./print2.php?wr_id="+wr_id,"PrintWin","width=800, height=700, scrollbars=yes");
            p.focus();
        }
        function GPEN3_PRINT(wr_id){
            var p = window.open("./print3.php?wr_id="+wr_id,"PrintWin","width=800, height=700, scrollbars=yes");
            p.focus();
        }
    </script>
    <div align="left">
        <font color="#616161"><h4>교원채원관리</h4></font>

        <table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="D8D8D8">
            <tr>

                <td height="34" bgcolor="FAFAFA">
                    <table border="0" align="center" cellpadding="2" cellspacing="0">
                        <form name="searchForm" action="<?=$PHP_SELF?>" method="post" onSubmit="return searchSendit();">
                            <input type="hidden" name="data" value="<?=$data?>">
                            <input type="hidden" name="MainCD" value="<?=$MainCD?>">
                            <input type="hidden" name="SubCD" value="<?=$SubCD?>">
                            <tr>
                                <td>
                                    <select name="apply_major" onchange="change_major()">
                                        <option value="">학과 선택</option>
                                        <?php
                                        $major_sql="SELECT apply_major FROM recruit_copy WHERE apply_major <> '' GROUP BY apply_major ORDER BY apply_major ASC";
                                        $major_res = mysql_query($major_sql);
                                        WHILE($major=mysql_fetch_array($major_res)){

                                            ?>
                                            <option value="<?php echo $major['apply_major']?>" <?php if($major['apply_major']==$_REQUEST['apply_major']){echo "SELECTED";}?>><?php echo $major['apply_major']?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                    <select name="search">
                                        <option value="kor_name" <? if($search=="kor_name") echo "selected"; ?>>이름</option>
                                    </select>
                                </td>
                                <td><input type="text" name="searchstring" value="<?=$searchstring?>" style="width:150px;height:23px" class="box3"></td>
                                <td><input type="image" src="../teamjang_meeting/images/search.gif" border="0" style="border:0px;"></td>
                            </tr>
                        </form>
                    </table>
                </td>
            </tr>
        </table>

        <br>
        <div>
            <p style="text-align:right">
              <input type="button" value="기초전공심사체크리스트" style="padding:10px 20px; border:0; background:#f53d3d;font-weight:bold;color:#FFFFFF;cursor:pointer" onclick="location.href='./check_list_excel.php?resume_num=<?=$resume_gubun?>&apply_major=<?php echo $apply_major?>'"/>&nbsp;&nbsp;
              <input type="button" value="전체 엑셀저장" style="padding:10px 20px; border:0; background:#f53d3d;font-weight:bold;color:#FFFFFF;cursor:pointer" onclick="location.href='./recruit_excel.php?resume_num=<?=$resume_gubun?>'"/>&nbsp;&nbsp;
              <input type="button" value="연구실적 엑셀" style="padding:10px 20px; border:0; background:#f53d3d;font-weight:bold;color:#FFFFFF;cursor:pointer" onclick="location.href='./recruit_excel_study.php?resume_num=<?=$resume_gubun?>'"/>
            </p>
        </div>
        <table border=0 cellspacing=1 cellpadding=0 width=100% bgcolor=#EEEEEE>
            <form name=fboardlist method=post>
                <tr align="center" height="30" bgcolor="#424a64">

                    <td width="30" class="font_s01"><input type="checkbox" style="border:0px;background-color:#424a64;" name=chkall value="1" onclick="check_all(this.form)"></td>
                    <td width="50" class="font_s01">번호</td>
                    <td class="font_s01" width="150">성명</td>
                    <td width="100" class="font_s01">생년월일</td>
                    <td class="font_s01" width="150">지원학과</td>
                    <td class="font_s01" width="150">휴대폰</td>
                    <td class="font_s01" width="*">이메일</td>
                    <td class="font_s01" width="100">비밀번호</td>
                    <td class="font_s01" width="200">인쇄</td>

                </tr>

                <?
                $pg_result=DBquery($pg_qry);
                if($numrows<1) {
                    ?>
                    <tr>
                        <td colspan="10" align="center" height="30"><b>목록이 없습니다.</b></td>
                    </tr>
                    <?
                }else{

                    $s_letter=$letter_no; //페이지별 시작 글번호

                    for($i=0; $pg_row=mysql_fetch_array($pg_result); $i++)
                    {

                        $s_level = "";
                        $level = strlen($pg_row[no]) / 2 - 1;

                        $data1 = mysql_fetch_array(mysql_query("SELECT * FROM recruit1 WHERE parent='$pg_row[wr_id]'"));

                        ?>
                        <tr align="center" height="30" bgcolor="#F9F9F9" OnMouseOver=style.background='#E1E4EC' OnMouseOut=style.background='#F9F9F9'>
                            <td align="center"><input type="checkbox" style="border:0px;background-color:#F9F9F9;" name=chk[] value='<?=$pg_row[wr_id]?>' ></td>
                            <td align="center" ><b><?=$letter_no?></b></td>
                            <td><a href="resume_view.php?wr_id=<?=$pg_row[wr_id]?>"><?=$pg_row[kor_name]?></a></td>
                            <td align="center"><?=$pg_row[birth]?></td>
                            <td align="center"><?=$pg_row[apply_major]?></td>
                            <td align="center"><?=$pg_row[phone]?></td>
                            <td align="center"><?=$pg_row[email]?></td>
                            <td align="center"><?=$data1[password]?></td>
                            <td align="center"><input type="button" value="기본사항 인쇄" style="padding:5px 10px; border:0; background:#f53d3d;font-weight:bold;color:#FFFFFF;cursor:pointer" onclick="GPEN_PRINT(<?=$pg_row['wr_id']?>)"/>&nbsp;<input type="button" value="자기소개서 인쇄" style="padding:5px 10px; border:0; background:#f53d3d;font-weight:bold;color:#FFFFFF;cursor:pointer" onclick="GPEN2_PRINT(<?=$pg_row['wr_id']?>)"/>&nbsp;<input type="button" value="연구실적 인쇄" style="padding:5px 10px; border:0; background:#f53d3d;font-weight:bold;color:#FFFFFF;cursor:pointer" onclick="GPEN3_PRINT(<?=$pg_row['wr_id']?>)"/></td>
                        </tr>
                        <?
                        $letter_no--;
                    }
                }

                $Obj=new RList($PHP_SELF,$pagecnt,$offset,$numrows,$PAGEBLOCK,$LIMIT,$search,$searchstring,"",$_REQUEST['apply_major']);
                ?>
        </table>

        <table style="padding-top:10px;" width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
                <td align="left"><!-- <input type=button class='btn1' value='선택수정' onclick="btn_check(this.form, 'update')"> -->
                    <input type="button" class='btn1' value='선택삭제' onclick="btn_check(this.form, 'delete')"></td>
                <td align="right"></td>
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
