<?
include "../_common.php";
include_once("../include/header.bootstrap.php");

// 검색
if ( $searchstring ) {
    $search_qry = " AND $search LIKE '%".$searchstring."%' ";
}
$sql = " select * from ".TABLE_BANNER." where no > 0 AND site_id='$_SESSION[sel_site_id]' ".$search_qry;
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
        function del_data(i) {
            ans = confirm("삭제하시겠습니까? \n\n삭제하시면 데이터를 복구하실 수 없습니다.");
            if ( ans == true ) {
                location.href = "proc.php?Confirm=delete&no="+i;
            }
        }
    </script>
<div class="contents">
    <div class="page-header">
        <h2 class="title0201">배너관리 </h2>
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
                            <?
                            $arr_selectSearch = array("title"=>"제목");
                            foreach ( $arr_selectSearch as $key => $val ) {
                            ?>
                            <option value="<?=$key?>" <? if ( $search == $key ) echo "selected"; ?>> <?=$val?> </option>
                            <? } ?>
                        </select>
                        <input type="text" name="searchstring" value="<?=$searchstring?>" >
                        <input type="image" src="../make_img/board/btn_search.gif" style="vertical-align: top;width: 25px; height: auto;" alt="검색" />
                    </div>
                </div>
            </form>

            <!-- block -->
            <div class="block" style="border: 1px solid #C8C8C8;">
                <div class="block-content collapse in">
                    <div class="span12">
                        <div class="table-toolbar" style="padding-top: 10px; ">
                            <div class="btn-group">
                                <a href="write.php"><button class="btn btn-success">추가 <i class="icon-plus icon-white"></i></button></a>
                            </div>
                        </div>
                        <table class="table table-hover" style="width: 100%;">
                            <colgroup>
                                <col style="width: 6%;" />
                                <col style="width: 20%;" />
                                <col style="width: 20%;" />
                                <!--<col style="width: 24%;" />-->
                                <col style="width: 10%;" />
                                <col style="width: 8%;" />
                                <col style="width: 12%;" />
                            </colgroup>
                            <thead>
                                <tr>
                                    <?
                                    $arr_tblTitle = array("번호", "이미지", "제목", "위치", "사용여부", "편집"); // "URL",
                                    foreach ( $arr_tblTitle as $key => $val ) {
                                    ?>
                                    <th> <?=$val?> </th>
                                    <? } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <? if( $numrows < 1 ) { ?>
                                <tr>
                                    <td colspan="<?=count($arr_tblTitle)?>" style="line-height: 3em; font-weight: bolder; text-align: center;">목록이 없습니다.</td>
                                </tr>
                                <?
                                } else {
                                    $s_letter = $letter_no; //페이지별 시작 글번호
                                    $sql .= " order by no desc limit ".$offset.", ".$LIMIT;
                                    $pg_result = $adb->query($sql);

                                    for ( $i = 0 ; $pg_row = $pg_result->fetchRow() ; $i++ ) {
                                        $s_level = "";
                                        $level = strlen($pg_row[no]) / 2 - 1;
                                ?>
                                <tr>
                                    <td>
                                        <input type="hidden" name="way_id[<?=$i?>]" value='<?=$pg_row[no]?>'>
                                        <?= $letter_no ?>
                                    </td>
                                    <td>
                                        <img src="<?=BANNER_LOAD_PATH?>/<?= $pg_row[banner_name] ?>" style="height: 100px; width: auto; max-width: 200px;">
                                    </td>
                                    <td>
                                        <a href="write.php?w=u&no=<?= $pg_row[no] ?>"><span><?= $pg_row[title] ?></span></a>
                                    </td>
                                    <!--<td>
                                        <a href="<?/*= $pg_row[link_url] */?>" target="_blank"><?/*= $pg_row[link_url] */?></a>
                                    </td>-->
                                    <td>
                                        <?
                                        $arr_selectLocation = array("1"=>"메인배너", "2"=>"서브메인배너(좌)", "3"=>"서브메인배너(우)", "4"=>"하단배너(좌)", "5"=>"하단배너1(우)", "6"=>"하단배너2(우)");
                                        echo $arr_selectLocation[$pg_row[location]];
                                        ?>
                                    </td>
                                    <td>
                                        <?
                                        if ( $pg_row[useyn] == "Y" ) echo "사용";
                                        else echo "사용안함";
                                        ?>
                                    </td>
                                    <td>
                                        <a href="write.php?w=u&no=<?= $pg_row[no] ?>"><button class="btn btn-info">수정</button></a>
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
