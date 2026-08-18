<?
include "../_common.php";
include_once("../include/header.bootstrap.php");

$site_id = $_SESSION[sel_site_id];

// 현재 등록된 PDF 정보
$pdf_row = $adb->getRow("SELECT * FROM guide_pdf WHERE site_id='$site_id'", DB_FETCHMODE_ASSOC);

// 메뉴 목록
$sql = " select * from guide_menu where site_id='$site_id' order by sort asc, no asc ";
$rs = $adb->query($sql);
$numrows = $rs->numRows();
?>
<style type="text/css">
    .boardView			   {width:90%; border-bottom:2px #cdcdcd solid; border-top:2px #777777 solid; border-right:1px #ffffff solid;}
    .boardView th				{color:#666666;padding:8px 5px 8px 15px; border-bottom:1px solid #e5e5e5; background-color:#f6f6f6; font-size:11px; text-align:left;border-right:1px solid #e5e5e5; white-space: nowrap;}
    .boardView td				{color:#777; font-size:12px; padding:8px; border-bottom:solid 1px #dbe1e8; text-align:left;}
    .boardView td input[type="text"], .boardView td input[type="file"] {padding:3px 4px 2px 3px; border:1px solid #c7c7c7; margin-right:3px;}

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

    .category-box {
        width: 500px;
        border: 1px solid #cdcdcd;
        padding: 10px;
        margin-top: 10px;
        min-height: 120px;
    }
    .category-box ul { list-style: none; margin: 0; padding: 0; }
    .category-box li { padding: 5px 4px; border-bottom: 1px dotted #e5e5e5; }
    .category-box li a { color: #333; text-decoration: none; }
    .category-box li a:hover { color: #3A98A0; text-decoration: underline; }
    .category-box li .no { color: #999; font-size: 11px; margin-right: 6px; }
    .category-box li .del { float: right; color: #D03915; font-size: 11px; }

    .tip_box { background: #f6f6f6; border: 1px solid #e5e5e5; padding: 10px; font-size: 12px; color: #777; width: 500px; }
</style>
<script type="text/javascript">
    function del_data(i) {
        ans = confirm("삭제하시겠습니까? \n\n삭제하시면 데이터를 복구하실 수 없습니다.");
        if ( ans == true ) {
            location.href = "proc.php?Confirm=delete&no="+i;
        }
    }
</script>
<div id="wrapper container">
    <p style="text-align:left;padding-bottom:10px;padding-top:10px;font-size:14px; ">
        <span style="display:inline-block;width:8px;height:8px;background:#3A98A0;margin-right:6px;"></span><strong style="vertical-align:10%;"> 한국어교육센터 PDF 모집요강</strong>
    </p>

    <form name="pdfform" method="post" action="pdf_proc.php" enctype="multipart/form-data">
        <table class="boardView">
            <colgroup>
                <col style="width:16%;">
                <col style="width:84%;">
            </colgroup>
            <tr>
                <th>등록된 PDF</th>
                <td>
                    <?php if ( $pdf_row[pdf_name] ) { ?>
                        <a href="<?=GUIDE_LOAD_PATH?>/<?=$pdf_row[pdf_name]?>" target="_blank"><?=$pdf_row[org_pdf_name]?></a>
                        <span style="color:#aaa;">(업로드일 : <?=$pdf_row[updated_at]?>)</span>
                    <?php } else { ?>
                        등록된 PDF가 없습니다.
                    <?php } ?>
                </td>
            </tr>
            <tr>
                <th>PDF 업로드</th>
                <td>
                    <input type="file" name="pdf_file" accept="application/pdf">
                    <p class="muted" style="font-size: 9pt;color: forestgreen;margin-top:5px;"> * 새로 올리면 기존 PDF를 대체합니다. </p>
                </td>
            </tr>
        </table>
        <div style="text-align:left;margin-top:10px;">
            <input type="submit" class="btn2" value="업로드">
        </div>
    </form>

    <p style="text-align:left;padding-bottom:10px;padding-top:20px;font-size:14px; ">
        <span style="display:inline-block;width:8px;height:8px;background:#3A98A0;margin-right:6px;"></span><strong style="vertical-align:10%;"> 메뉴 (대메뉴별 PDF 페이지 연결)</strong>
    </p>
    <div class="tip_box">
        메뉴를 클릭하면 해당 PDF 페이지가 열립니다. "순서" 값이 작을수록 먼저 노출됩니다.
    </div>

    <div class="category-box">
        <?php if ( $numrows < 1 ) { ?>
            <p style="color:#999;">등록된 메뉴가 없습니다.</p>
        <?php } else { ?>
        <ul>
            <?php for ( $i = 0 ; $pg_row = $rs->fetchRow(DB_FETCHMODE_ASSOC) ; $i++ ) { ?>
            <li>
                <span class="no"><?=$pg_row[sort]?></span>
                <a href="write.php?w=u&no=<?=$pg_row[no]?>"><?=$pg_row[title]?> (<?=$pg_row[page_no]?>페이지)<?php if($pg_row[use_yn]!='Y'){?> [미사용]<?php } ?></a>
                <a href="javascript:del_data(<?=$pg_row[no]?>);" class="del">삭제</a>
            </li>
            <?php } ?>
        </ul>
        <?php } ?>
    </div>

    <div style="width:500px;text-align:left;margin-top:10px;">
        <a href="write.php"><input type="button" class="btn2" value="메뉴 추가"></a>
    </div>
</div>
<? include_once("../include/__footer.php"); ?>
