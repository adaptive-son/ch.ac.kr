<?
include "../_common.php";
include_once("../include/header.bootstrap.php");

if ( $no != "" ) {
    $sql = " select * from guide_menu where no = '$no' ";
    $view = $adb->getRow($sql, DB_FETCHMODE_ASSOC);
}
?>
<style type="text/css">
    .boardView			   {width:500px; border-bottom:2px #cdcdcd solid; border-top:2px #777777 solid; border-right:1px #ffffff solid;}
    .boardView th				{color:#666666;padding:8px 5px 8px 15px; border-bottom:1px solid #e5e5e5; background-color:#f6f6f6; font-size:11px; text-align:left;border-right:1px solid #e5e5e5; white-space: nowrap;}
    .boardView td				{color:#777; font-size:12px; padding:8px; border-bottom:solid 1px #dbe1e8; text-align:left;}
    .boardView td input[type="text"] {padding:3px 4px 2px 3px; border:1px solid #c7c7c7; margin-right:3px;}

    input[type="submit"].btn2, input[type="button"].btn2 {
        display: inline-block;
        vertical-align: middle;
        height: 35px;
        line-height: 35px;
        min-width: 105px;
        padding: 0 10px;
        margin-bottom: 20px;
        text-align: center;
        border: 0;
        font-weight: bold;
        color: #fff;
        background: #3A98A0;
        cursor: pointer;
    }
</style>
<script>
    function check_submit(f) {
        if(f.title.value == ""){
            alert("메뉴명을 입력하세요.");
            return false;
        }
        if(f.page_no.value == ""){
            alert("PDF 페이지 번호를 입력하세요.");
            return false;
        }
    }

    // 엔터키로 폼이 바로 제출되는 것을 방지
    $(document).ready(function() {
        $("form[name='writeform'] input[type='text']").on("keydown", function(e) {
            if ( e.key === "Enter" || e.keyCode === 13 ) {
                e.preventDefault();
            }
        });
    });
</script>

<div id="wrapper container">
    <p style="text-align:left;padding-bottom:10px;padding-top:10px;font-size:14px; ">
        <span style="display:inline-block;width:8px;height:8px;background:#3A98A0;margin-right:6px;"></span><strong style="vertical-align:10%;"> 메뉴 <?=($no!="")?"수정":"추가"?></strong>
    </p>

    <form name="writeform" method="post" action="./proc.php" onsubmit="return check_submit(this);">
        <input type="hidden" name="no" value="<?=$no?>">
        <input type="hidden" name="w" value="<?=$w?>">

        <table class="boardView">
            <colgroup>
                <col style="width:30%;">
                <col style="width:70%;">
            </colgroup>
            <tr>
                <th>메뉴명</th>
                <td><input type="text" id="title" name="title" value="<?= $view[title] ?>" style="width:90%;"></td>
            </tr>
            <tr>
                <th>PDF 페이지 번호</th>
                <td>
                    <input type="text" id="page_no" name="page_no" value="<?= $view[page_no] ?>" style="width:60px;">
                    <span style="font-size:9pt;color:#999;"> 이 메뉴 클릭 시 PDF의 몇 페이지를 보여줄지</span>
                </td>
            </tr>
            <tr>
                <th>순서</th>
                <td><input type="text" id="sort" name="sort" value="<?= ($view[sort] !== null) ? $view[sort] : '0' ?>" style="width:60px;"></td>
            </tr>
            <tr>
                <th>사용여부</th>
                <td>
                    <select name="use_yn">
                        <?
                        $arr_selectUse = array("Y"=>"사용", "N"=>"사용하지않음");
                        foreach ( $arr_selectUse as $k => $v ) {
                            ?>
                            <option value="<?=$k?>" <? if ( $k == $view[use_yn] || ($view[use_yn]=="" && $k=="Y") ) echo "selected"; ?>> <?=$v?> </option>
                        <? } ?>
                    </select>
                </td>
            </tr>
        </table>

        <div style="text-align: center; width:500px;">
            <input type="submit" class="btn2" value="확인">
            <input type="button" class="btn2" style="background-color:#999;" onclick="javascript:history.back();" value="목록">
        </div>
    </form>
</div>

<? include_once("../include/__footer.php"); ?>
