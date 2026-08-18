<?
include "../_common.php";

$site_id = $_SESSION[sel_site_id];

if ( $_FILES[pdf_file][tmp_name] && $_FILES[pdf_file][size] > 0 ) {

    $orgFileName = $_FILES[pdf_file][name];
    $extName = strtolower(array_pop(explode(".", $orgFileName)));

    if ( $extName != "pdf" ) {
        OnlyMsgView("PDF 파일만 업로드할 수 있습니다.");
        exit;
    }

    $timeStamp = date("ymdHis", time());
    $renameFileName = "guide_" . $site_id . "_" . $timeStamp . "." . $extName;

    if ( !move_uploaded_file($_FILES[pdf_file][tmp_name], GUIDE_FILE_PATH . "/" . $renameFileName) ) {
        OnlyMsgView("업로드에 실패했습니다.");
        exit;
    }

    // 기존 등록 여부 확인
    $exists = $adb->getRow("SELECT * FROM guide_pdf WHERE site_id='$site_id'", DB_FETCHMODE_ASSOC);

    if ( $exists ) {
        // 기존 파일 삭제
        if ( $exists[pdf_name] && file_exists(GUIDE_FILE_PATH . "/" . $exists[pdf_name]) ) {
            @unlink(GUIDE_FILE_PATH . "/" . $exists[pdf_name]);
        }
        $sql = "UPDATE guide_pdf SET
            pdf_name = '" . addslashes($renameFileName) . "',
            org_pdf_name = '" . addslashes($orgFileName) . "',
            updated_at = now()
            WHERE site_id = '$site_id'";
    } else {
        $sql = "INSERT INTO guide_pdf SET
            site_id = '$site_id',
            pdf_name = '" . addslashes($renameFileName) . "',
            org_pdf_name = '" . addslashes($orgFileName) . "',
            updated_at = now()";
    }

    $adb->query($sql);
}

include_once("../include/__footer.php");
alert_replace("list.php");
