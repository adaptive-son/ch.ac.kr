<?
include "../_common.php";
include_once("../include/header.bootstrap.php");

// 검색
if ( $searchstring ) {
    $search_qry = " where $search LIKE '%".$searchstring."%' ";
}
$sql = " select * from tel".$search_qry." ";


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
                //location.href = "proc.php?Confirm=delete&no="+i;
				location.href = "proc.php?Confirm=delete&t_num="+i;
            }
        }
    </script>
<div class="contents">
    <div class="page-header">
        <h2 class="title0201">전화번호 관리 </h2>
    </div>
    <div class="container-fluid">
        <div class="row-fluid">

            <!--<form name="searchForm" action="<?=$PHP_SELF?>" method="post" onSubmit="return searchSendit();">-->
			<form name="searchForm" action="<?=$PHP_SELF?>" method="post">
                <input type="hidden" name="data" value="<?=$data?>">
                <input type="hidden" name="MainCD" value="<?=$MainCD?>">
                <input type="hidden" name="SubCD" value="<?=$SubCD?>">

                <div class="board-search-area" style="display: inline-block; width: 95%;">
                    <div class="board-search-box" style="float: right;">
                        <select name="search" style="width: 80px;">
                            <?
                            $arr_selectSearch = array("t_category2"=>"소속", "t_telnum"=>"전화번호", "t_location"=>"위치");
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
                                <col style="width: 12.5%;" />
								<col style="width: 12.5%;" />
                                <col style="width: 12.5%;" />
								<col style="width: *;" />
                                <col style="width: 12.5%;" />
								<col style="width: 12.5%;" />
                                <col style="width: 12.5%;" />
                            </colgroup>
                            <thead>
                                <tr>
                                    <?
                                    $arr_tblTitle = array("번호", "구분", "소속", "직위", "담당업무", "전화번호", "위치", "편집"); // "URL",
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
                                    $sql .= " order by t_sort desc limit ".$offset.", ".$LIMIT;
                                    $pg_result = $adb->query($sql);

                                    for ( $i = 0 ; $pg_row = $pg_result->fetchRow() ; $i++ ) {
                                        $s_level = "";
                                        $level = strlen($pg_row[t_num]) / 2 - 1;
                                ?>
                                <tr>
                                    <td>
                                        <input type="hidden" name="way_id[<?=$i?>]" value='<?=$pg_row[t_num]?>'>
                                        <?= $letter_no ?>
                                    </td>
                                    <td>
                                        <!--<a href="write.php?w=u&t_num=<?= $pg_row[t_num] ?>"><span><?= $pg_row[t_category1] ?></span></a>-->
										<?= $pg_row[t_category1] ?>
                                    </td>
                                    <td>
										<?= $pg_row[t_category2] ?>
                                    </td>
									<td>
										<?= $pg_row[t_position] ?>
                                    </td>
									<td>
										<?= $pg_row[t_descript] ?>
                                    </td>
									<td>
										<?= $pg_row[t_telnum] ?>
                                    </td>
									<td>
										<?= $pg_row[t_location] ?>
                                    </td>
                                    <td>
                                        <a href="write.php?w=u&t_num=<?= $pg_row[t_num] ?>"><button class="btn btn-info">수정</button></a>
                                        <a href="javascript:del_data(<?= $pg_row[t_num] ?>);"><button class="btn btn-success">삭제</button></a>
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
