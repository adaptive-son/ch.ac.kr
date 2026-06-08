<?
include "../_common.php";
include_once("../include/header.bootstrap.php");
// 검색
if ( $searchstring ) {
    $search_qry = " AND $search LIKE '%".$searchstring."%' ";
}
$sql = " select * from ".TABLE_POPUP." where no > 0 AND site_id='$_SESSION[sel_site_id]' ".$search_qry;
$rs = $adb->query($sql);
// 총 레코드 수
$numrows = $rs->numRows();

$pagecnt=$pagecnt;
$letter_no=$letter_no;
$offset=$offset;
// 페이지 번호
if ( $pagecnt == "" || !$pagecnt ) $pagecnt = '0';
// 페이지당 목록 수
$LIMIT	= 20;
//블럭당 페이지 수
$PAGEBLOCK	= 10;
//각 페이지의 시작 글
if ( !$offset ) {
    $offset = $pagecnt*$LIMIT*$PAGEBLOCK;
}
//전체페이지 수
$TotalPage = ceil($numrows / $LIMIT);
//현재페이지
$NowPage = ( $offset / $LIMIT ) + 1;
//글번호
$letter_no= ( $numrows+$LIMIT ) - ( $LIMIT*$NowPage );
?>
    <script type="text/javascript">

        function preview(no, s) {
            size = s.split('-');
            window.open("./banner_preview.php?no="+no,"_blank", "width="+size[0]+",height="+size[1]+",top=0,left=0");
        }

        function del_data(i)
        {
            ans = confirm("삭제하시겠습니까? \n\n삭제하시면 데이터를 복구하실 수 없습니다.");

            if(ans == true)
            {
                location.href = "popup.proc.php?Confirm=delete&no="+i
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
                f.action = "popup.proc.php";
                str = "수정";
            }
            else if (act == "delete") // 선택삭제
            {
                f.action = "popup.proc.php";
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
<div class="contents">
    <div class="page-header">
        <h2 class="title0201">팝업관리</h2>
    </div>
    <div class="container-fluid">
        <div class="row-fluid">

                 <form name="searchForm" action="<?=$PHP_SELF?>" method="post" onSubmit="return searchSendit();">
                     <input type="hidden" name="data" value="<?=$data?>">
                     <input type="hidden" name="MainCD" value="<?=$MainCD?>">
                     <input type="hidden" name="SubCD" value="<?=$SubCD?>">
                     <div class="board-search-area" style="display: inline-block; width: 95%;">
                         <div class="board-search-box" style="float: right;">
                             <select name="search" style="width: 80px;">
                                  <option value="title" <? if($search=="title") echo "selected"; ?>>제목</option>
                              </select>
                              <input type="text" name="searchstring" value="<?=$searchstring?>" class="box3">
                             <input type="image" src="../make_img/board/btn_search.gif" style="vertical-align: top;width: 25px; height: auto;" alt="검색">
                         </div>
                     </div>
                </form>

            <!-- block -->
            <div class="block" style="border: 1px solid #C8C8C8;">
                <div class="block-content collapse in">
                    <div class="span12">
                        <div class="table-toolbar" style="padding-top: 10px;">
                            <div class="btn-group">
                                <a href="./popup.write.php"><button class="btn btn-success">추가 <i class="icon-plus icon-white"></i></button></a>
                            </div>
                        </div>
                        <table class="table table-hover" style="width: 100%;">
                            <colgroup>
                                <col style="width: 5%" title="번호" />
                                <col style="width: 6%" title="이미지" />
                                <col style="width: *" title="제목" />
                                <!--<col style="width: 5%" title="사용" />-->
                                <col style="width: 25%" title="기간" />
                                <col style="width: 13%" title="편집" />
                            </colgroup>
                            <thead>
                            <tr>
                                <th>번호</th>
                                <th>이미지</th>
                                <th>제목</th>
                                <!--<th>사용</th>-->
                                <th>기간</th>
                                <th>편집</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?
                            if($numrows<1) {

                                ?>
                                <tr>
                                    <td colspan="9" align="center" height="30"><b>목록이 없습니다.</b></td>
                                </tr>
                                <?
                            }else {

                                $s_letter = $letter_no; //페이지별 시작 글번호
                                $sql .= " order by no desc limit ".$offset.", ".$LIMIT;
                                $pg_result = $adb->query($sql);

                                for ( $i = 0 ; $pg_row = $pg_result->fetchRow() ; $i++ ) {
                                    $s_level = "";
                                    $level = strlen($pg_row[no]) / 2 - 1;

                                    //현재 사용유무 체크 [useyn ='Y' 이고 현재 날짜가 사용가능 기간에 맞는 경우]
                                    $date = date('Y-m-d');
                                    if($pg_row[useyn] == "Y" && ($date >= $pg_row[gigan1] && $date <= $pg_row[gigan2] )){
                                        $use="Y";
                                    }else{
                                        $use="N";
                                    }

                                    ?>

                                    <tr style="background:<? if($use == 'Y') echo '#FAF4C0' ?>">
                                        <td>
                                            <input type=hidden name=way_id[<?=$i?>] value='<?=$pg_row[no]?>'><?= $letter_no ?>
                                        </td>
                                        <td>
                                            <img src="<?=POPUP_LOAD_PATH?>/<?= $pg_row[popup_name] ?>" style="height: 100px; width: auto; max-width: 200px;">
                                        </td>
                                        <td>
                                            <a href="popup.write.php?w=u&no=<?= $pg_row[no] ?>">
                                    <span><?= $pg_row[title] ?>
                                    </span>
                                            </a>
                                        </td>
                                        <!--
                            <td>
                                <span>
                                    <?=$use;?>
                                </span>
                            </td>
							-->
                                        <td>
                                            <?= $pg_row[gigan1] ?>~<?= $pg_row[gigan2] ?>
                                        </td>
                                        <td>
                                            <a href="popup.write.php?w=u&no=<?= $pg_row[no] ?>"><button class="btn btn-info">수정</button></a>
                                            <a href="javascript:del_data(<?= $pg_row[no] ?>);"><button class="btn btn-success">삭제</button></a>
                                        </td>
                                    </tr>
                                    <?
                                    $letter_no--;
                                }
                            }
                            $Obj=new PList($PHP_SELF,$pagecnt,$offset,$numrows,$PAGEBLOCK,$LIMIT,$search,$searchstring,"");
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /block -->
            <p class="paging-navigation">
                <?php echo $Obj->putList(true,"이전 페이지로 이동","다음 페이지로 이동"); ?>
            </p>
        </div>
    </div>
</div>
<? include_once("../include/__footer.php"); ?>