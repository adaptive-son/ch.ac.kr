<?
// adframe 공통 인클루드 파일
include_once "../_common.php";

// 검색
if ( $searchstring ) {
    $search_qry = " AND $search LIKE '%".$searchstring."%'  ";
}
$sql = "select * from ".TABLE_SCHEDULE." WHERE site_id ='".$_SESSION[sel_site_id]."' and del_yn='N'".$search_qry;

$rs = $adb->query($sql);
// 총 레코드 수
$numrows = $rs->numRows();

$pagecnt=$pagecnt;
$letter_no=$letter_no;
$offset=$offset;
// 페이지 번호
if ( $pagecnt == "" || !$pagecnt ) $pagecnt = '0';
// 페이지당 목록 수
$LIMIT	= 50;
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

<!DOCTYPE HTML>
<html lang="ko">

<head>
    <? include_once("../include/__meta.php"); ?>
    <title> 관리자페이지 </title>

	<SCRIPT>
        function del(url) {
            var ans = confirm("해당 일정을 삭제 하시겠습니까?");
            if ( ans == true ) {
                location.href = url;
            }
        }
    </SCRIPT>

</head>
<body>

<!-- wrapper -->
<div class="wrapper" id="wrapper" style="padding: 0; padding-left: 31px; min-height: 550px; background-color: #fff;">
    <!-- contents -->
    <div class="contents">

        <h2 class="title0201">
            일정 관리
        </h2>
        <div class="board-area">
            <fieldset>
                <div class="board-search-area">
                    <form name="searchForm" method="POST" action="<?=$PHP_SELF?>" onsubmit="return searchSendit();">
                        <input type="hidden" name="data" value="<?=$data?>">
                        <input type="hidden" name="MainCD" value="<?=$MainCD?>">
                        <input type="hidden" name="SubCD" value="<?=$SubCD?>">
                        <div class="board-search-box">
                            <select name="search">
                                <?
                                $arr_searchSelect = array("schedule_memo"=>"일정");
                                foreach ( $arr_searchSelect as $k => $v ) {
                                    ?>
                                    <option value="<?=$k?>" <? if ( $search == $k ) echo "selected"; ?>> <?=$v?> </option>
                                <? } ?>
                            </select>
                            <input type="text" name="searchstring" value="<?=$searchstring?>" />
                            <input type="image" id="btn-search-submit" src="../make_img/board/btn_search.gif" alt="검색" />
                        </div>
                    </form>
                </div>

                <div class="btns-area">
                    <div class="btns-right">
                        <a href="schedule.pop.php" class="btn-type01">
                            추가
                        </a>
                    </div>
                </div>

                <div class="board-list">
                    <table style="width: 100%" summary="이 표는 게시판에 대해 목록정보를 제공하는 표입니다.">
                        <colgroup>
                            <col style="width: *" />
                            <col style="width: 40%" />
							<col style="width: 15%" />
                            <col style="width: 15%" />
							<col style="width: 15%" />
                        </colgroup>
                        <thead>
                        <tr>
                            <?
                            $arr_title = array("번호", "일정", "시작일", "종료일", "관리");
                            foreach ( $arr_title as $k => $v ) {
                                ?>
                                <th scope="col" <? if ( $k == ( count($arr_title) - 1 ) ) echo " class='none' "; ?>> <?=$v?> </th>
                            <? } ?>
                        </tr>
                        </thead>
                        <tbody>
                        <? if ( $numrows == 0 ) { ?>
                            <tr>
                                <td colspan="<?=count($arr_title)?>" style="line-height: 3em;">
                                    목록이 없습니다.
                                </td>
                            </tr>
                            <?
                        } else {
                            $s_letter = $letter_no; //페이지별 시작 글번호
                            $sql .= " order by schedule_no desc limit ".$offset.", ".$LIMIT;

                            $pg_result = $adb->query($sql);

                            for ( $i = 0 ; $pg_row = $pg_result->fetchRow() ; $i++ ) {
                                ?>
                                <tr>
                                    <td>
                                        <?=$letter_no?>
                                    </td>
									<td>
										<?=$pg_row[schedule_memo]?>
									</td>
                                    <td><?=$pg_row[schedule_start_date]?></td>
                                    <td><?=$pg_row[schedule_end_date]?></td>
                                    <td>
                                        <a href="schedule.pop.php?mode=u&schedule_no=<?= $pg_row[schedule_no]?>"><img src="../make_img/board/btn_modify.gif" align="absmiddle" alt="수정"></a>
                                        <a href="javascript:del('schedule.proc.php?mode=d&schedule_no=<?=$pg_row[schedule_no]?>')"><img src="../make_img/board/btn_delete.gif" align="absmiddle" alt="삭제"></a>
                                    </td>
                                </tr>
                                <? $letter_no--; 
								} 
								} ?>
                        </tbody>
                    </table>
                </div>
            </fieldset>

            <p class="paging-navigation">
                <?php
                $Obj=new PList($PHP_SELF,$pagecnt,$offset,$numrows,$PAGEBLOCK,$LIMIT,$search,$searchstring,"");
                echo $Obj->putList(true,"이전 페이지로 이동","다음 페이지로 이동"); ?>
            </p>

        </div>
    </div>
    <!-- //contents -->
</div>
<!-- //wrapper -->

</body>
</html>