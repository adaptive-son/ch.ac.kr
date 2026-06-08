<?
// adframe 공통 인클루드 파일
include_once "../_common.php";

// 검색
if ( $searchstring ) {
    $search_qry = " AND $search LIKE '%".$searchstring."%' ";
}
$sql = " select * from ".TABLE_BOARD_MNG." where idx > 0 ".$search_qry;
$rs = $adb->query($sql);
// 총 레코드 수
$numrows = $rs->numRows();

$pagecnt=$pagecnt;
$letter_no=$letter_no;
$offset=$offset;
// 페이지 번호
if ( $pagecnt == "" || !$pagecnt ) $pagecnt = '0';
// 페이지당 목록 수
$LIMIT	= 999999;
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

    <SCRIPT LANGUAGE="JavaScript">
        // 게시판 복사
        function copyBBSCode(BCODE) {
            try {
                var bResult = false;
                if( window.clipboardData ) { // IE
                    BCODE = BCODE.replace(/\'/g,'"');
                    BCODE = BCODE + "\n//게시판 시퀀스, 카테고리번호, 관리자는 1(일반은0), 유저아이디, 서브검색쿼리, 서브컬럼쿼리 ";
                    bResult = window.clipboardData.setData("Text", BCODE);
                } else {
                    alert( "게시판 생성코드 복사는 IE전용입니다.");
                    return;
                }
                if( bResult == true) {
                    alert("게시판 삽입 Function이 복사되었습니다.\n Ctrl+V 로 붙여넣기 하세요.");
                    return;
                }
            } catch (e) {
                alert( e.description );
            }
        }

        // 권한설정
        function config_auth(idx) {
            // 보류
            //alert("준비 중 입니다.");
            //return;
            location.href = "auth.php?idx="+idx;
            //window.open("auth.php?idx="+idx, "pop_"+idx, "width=780,height=480,scrollbars=yes");
        }

        // 게시판 삭제
        function oneDel(idx){
            if(confirm("정말 삭제 처리하시겠습니까? \n데이타 안전성을 위해 삭제 시 게시물은 삭제되지 않습니다.\n※삭제는 직접 DB에서 해야합니다.")){
                location.href = 'proc.php?Confirm=delete&idx='+idx+'';
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
                사이트 관리
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
                                    $arr_searchSelect = array("board_id"=>"게시판ID", "board_name"=>"게시판이름");
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
                            <a href="add.php" class="btn-type01">
                                추가
                            </a>
                        </div>
                    </div>

                    <div class="board-list">
                        <table style="width: 100%" summary="이 표는 게시판에 대해 목록정보를 제공하는 표입니다.">
                            <colgroup>
                                <col style="width: *" />
                                <col style="width: 15%" />
                                <col style="width: 15%" />
                                <col style="width: 15%" />
                                <col style="width: 15%" />
                                <col style="width: 15%" />
                            </colgroup>
                            <thead>
                            <tr>
                                <?
                                $arr_title = array("게시판이름", "게시판ID", "게시판코드", "스킨명", "관리", "");
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
                                    $sql .= " order by board_key asc limit ".$offset.", ".$LIMIT;
                                    $pg_result = $adb->query($sql);

                                    for ( $i = 0 ; $pg_row = $pg_result->fetchRow() ; $i++ ) {

                                        $s_level = "";
                                        $level = strlen($pg_row[board_key]);
                                        if ( $level == 2 ) {
                                            $td_padding_val = "20px";
                                        } else { // 2단계 이상
                                            $td_padding_val = "30px";
                                            $s_level = "<img src='../make_img/board/node.gif' border='0' align='absmiddle' alt='".($level+1)."단계 분류' style='margin-right: 10px;'>";
                                        }
                                        $bbs_key = $pg_row[board_key];
                                ?>
                                <tr>
                                    <td class="left" style="padding-left: <?=$td_padding_val?>;">
                                        <?=$s_level?>
                                        <? if ( $level > 2 ) { ?>
                                            <a href="index.php?managerBoard=<?=$bbs_key?>"><?=$pg_row[board_name]?></a>
                                        <? } else { ?>
                                            <a href="add.php?w=u&idx=<?=$pg_row[idx]?>"><b><?=$pg_row[board_name]?></b></a>
                                        <? } ?>
                                    </td>
                                    <td><?=$pg_row[board_id]?></td>
                                    <td><?=$bbs_key?></td>
                                    <td><?=$pg_row[board_skin]?></td>
                                    <td>
                                        <? if( $level > 2 ) { ?>
                                            <a href="javascript:void(0)" onclick="config_auth('<?=$pg_row[idx]?>')">[권한설정]</a>
                                            <!--<a href="javascript:void(0)" onclick="copyBBSCode('create_bbs(\'<?=$pg_row[board_key]?>\', \'\', \'0\', \'\', \'\', \'\');')">[Make BBS]</a>-->
                                        <? } ?>
                                    </td>
                                    <td>
                                        <a href="add.php?w=u&idx=<?=$pg_row[idx]?>"><img src="../make_img/board/btn_modify.gif" align="absmiddle" alt="수정"></a>
                                        <? if( $level <= 2 ){ ?>
                                        <a href="add.php?board_key=<?=$pg_row[board_key]?>"><img src="../make_img/board/btn_insert.gif" align="absmiddle" alt="추가"></a>
                                         <? } ?>
                                        <a href="javascript:oneDel(<?=$pg_row[idx]?>);"><img src="../make_img/board/btn_delete.gif" align="absmiddle" alt="삭제"></a>
                                    </td>
                                </tr>
                                <? $letter_no--; } } ?>
                            </tbody>
                        </table>
                    </div>
                </fieldset>

            </div>
        </div>
        <!-- //contents -->
    </div>
    <!-- //wrapper -->

</body>
</html>