<?
// adframe 공통 인클루드 파일
include_once "../_common.php";

// 검색
if ( $searchstring ) {
    $search_qry = " AND $search LIKE '%".$searchstring."%' ";
}
$sql = "select member.* FROM ".TABLE_MEMBER." member 
        LEFT JOIN ".TABLE_ADMIN." adm ON adm.id = member.id 
        WHERE member.del_yn='N' AND adm.idx IS NULL ";

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
    <link rel="stylesheet" href="../css/popup.css" />
    <title> 관리자페이지 </title>

    <SCRIPT>
        function selMember(memberId, memberName){
            opener.selMember(memberId, memberName);
            self.close();
        }
    </SCRIPT>

</head>
<body>

<!-- wrapper -->
<div class="popup-wrapper" id="wrapper">
    <!-- header -->
    <div class="popup-header">
        <h1>회원 검색</h1>
    </div>
    <!-- //header -->

    <!-- contents -->
    <div class="popup-container" id="container">
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
                                $arr_searchSelect = array("id"=>"사용자ID", "name"=>"사용자명");
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


                <div class="board-list">
                    <table style="width: 100%" summary="이 표는 게시판에 대해 목록정보를 제공하는 표입니다.">
                        <colgroup>
                            <col style="width: *" />
                            <col style="width: 30%" />
                            <col style="width: 30%" />
                            <col style="width: 30%" />
                        </colgroup>
                        <thead>
                        <tr>
                            <?
                            $arr_title = array("번호","아이디", "이름", "선택");
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
                            $sql .= " order by adm.idx asc limit ".$offset.", ".$LIMIT;
                            $pg_result = $adb->query($sql);

                            for ( $i = 0 ; $pg_row = $pg_result->fetchRow() ; $i++ ) {
                                ?>
                                <tr>
                                    <td>
                                        <?=$letter_no?>
                                    </td>
                                    <td><?=$pg_row[id]?></td>
                                    <td><?=$pg_row[name]?></td>
                                    <td>
                                       <button type="button" onclick="selMember('<?=$pg_row[id]?>','<?=$pg_row[name]?>')">선택</button>
                                    </td>
                                </tr>
                                <? $letter_no--; } } ?>
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