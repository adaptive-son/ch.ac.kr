<?
include "../_common.php";

$site_id = $_SESSION[sel_site_id];
$allowed_keys = array("march", "sept");

if ( !in_array($semester_key, $allowed_keys) ) {
    OnlyMsgView("잘못된 요청입니다.");
    exit;
}

if ( $_FILES[pdf_file][tmp_name] && $_FILES[pdf_file][size] > 0 ) {

    $orgFileName = $_FILES[pdf_file][name];
    $extName = strtolower(array_pop(explode(".", $orgFileName)));

    if ( $extName != "pdf" ) {
        OnlyMsgView("PDF 파일만 업로드할 수 있습니다.");
        exit;
    }

    $timeStamp = date("ymdHis", time());
    $renameFileName = "admission_" . $site_id . "_" . $semester_key . "_" . $timeStamp . "." . $extName;

    if ( !move_uploaded_file($_FILES[pdf_file][tmp_name], GUIDE_FILE_PATH . "/" . $renameFileName) ) {
        OnlyMsgView("업로드에 실패했습니다.");
        exit;
    }

    $exists = $adb->getRow("SELECT * FROM admission_pdf WHERE site_id='$site_id' AND semester_key='$semester_key'", DB_FETCHMODE_ASSOC);

    if ( $exists ) {
        if ( $exists[pdf_name] && file_exists(GUIDE_FILE_PATH . "/" . $exists[pdf_name]) ) {
            @unlink(GUIDE_FILE_PATH . "/" . $exists[pdf_name]);
        }
        $sql = "UPDATE admission_pdf SET
            pdf_name = '" . addslashes($renameFileName) . "',
            org_pdf_name = '" . addslashes($orgFileName) . "',
            updated_at = now()
            WHERE site_id = '$site_id' AND semester_key = '$semester_key'";
    } else {
        $sql = "INSERT INTO admission_pdf SET
            site_id = '$site_id',
            semester_key = '$semester_key',
            pdf_name = '" . addslashes($renameFileName) . "',
            org_pdf_name = '" . addslashes($orgFileName) . "',
            updated_at = now()";
    }

    $adb->query($sql);
}

include_once("../include/__footer.php");
alert_replace("admission.php");
