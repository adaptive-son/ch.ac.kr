<?
include "../_common.php";
include_once("../include/header.bootstrap.php");

$site_id = $_SESSION[sel_site_id];

$semesters = array(
    "march"   => "3월학기 모집",
    "sept"    => "9월학기 모집",
    "trainee" => "연수생 입학",
);

$rows = array();
foreach ( $semesters as $key => $label ) {
    $rows[$key] = $adb->getRow("SELECT * FROM admission_pdf WHERE site_id='$site_id' AND semester_key='$key'", DB_FETCHMODE_ASSOC);
}
?>
<style type="text/css">
    .boardView			   {width:90%; border-bottom:2px #cdcdcd solid; border-top:2px #777777 solid; border-right:1px #ffffff solid;}
    .boardView th				{color:#666666;padding:8px 5px 8px 15px; border-bottom:1px solid #e5e5e5; background-color:#f6f6f6; font-size:11px; text-align:left;border-right:1px solid #e5e5e5; white-space: nowrap;}
    .boardView td				{color:#777; font-size:12px; padding:8px; border-bottom:solid 1px #dbe1e8; text-align:left;}

    input[type="submit"].btn2 {
        display: inline-block;
        vertical-align: middle;
        height: 35px;
        line-height: 35px;
        min-width: 105px;
        padding: 0 10px;
        margin: 15px 0 30px 0;
        text-align: center;
        border: 0;
        font-weight: bold;
        color: #fff;
        background: #3A98A0;
        cursor: pointer;
    }
</style>
<div id="wrapper container">
    <p style="text-align:left;padding-bottom:10px;padding-top:10px;font-size:14px; ">
        <span style="display:inline-block;width:8px;height:8px;background:#3A98A0;margin-right:6px;"></span><strong style="vertical-align:10%;"> 정규과정 입학 PDF 관리</strong>
    </p>

    <?php foreach ( $semesters as $key => $label ) { $view = $rows[$key]; ?>
    <form name="pdfform_<?=$key?>" method="post" action="admission_proc.php" enctype="multipart/form-data">
        <input type="hidden" name="semester_key" value="<?=$key?>">
        <table class="boardView">
            <colgroup>
                <col style="width:16%;">
                <col style="width:84%;">
            </colgroup>
            <tr>
                <th><?=$label?> - 등록된 PDF</th>
                <td>
                    <?php if ( $view[pdf_name] ) { ?>
                        <a href="<?=GUIDE_LOAD_PATH?>/<?=$view[pdf_name]?>" target="_blank"><?=$view[org_pdf_name]?></a>
                        <span style="color:#aaa;">(업로드일 : <?=$view[updated_at]?>)</span>
                    <?php } else { ?>
                        등록된 PDF가 없습니다.
                    <?php } ?>
                </td>
            </tr>
            <tr>
                <th>PDF 업로드</th>
                <td>
                    <input type="file" name="pdf_file" accept="application/pdf">
                    <p style="font-size: 9pt;color: forestgreen;margin-top:5px;"> * 새로 올리면 기존 PDF를 대체합니다. </p>
                </td>
            </tr>
        </table>
        <input type="submit" class="btn2" value="<?=$label?> 업로드">
    </form>
    <?php } ?>
</div>
<? include_once("../include/__footer.php"); ?>
