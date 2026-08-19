<?
include "../_common.php";

$site_id = $_SESSION[sel_site_id];

$no = (int)$no;

if ( $Confirm == "delete" ) {

    $sql = " delete from guide_menu where no = '".$no."' and site_id = '".addslashes($site_id)."' ";
    $adb->query($sql);

} else {

    $use_yn = ( $use_yn == "Y" ) ? "Y" : "N";

    $sql_common = "
        title   = '" . addslashes($title) . "',
        page_no = '" . intval($page_no) . "',
        sort    = '" . intval($sort) . "',
        use_yn  = '$use_yn',
        site_id = '".addslashes($site_id)."'
    ";

    if ( $no == "" || !$no ) {
        $sql = " insert into guide_menu set " . $sql_common;
    } else {
        $sql = " update guide_menu set " . $sql_common . " where no = '".$no."' and site_id = '".addslashes($site_id)."' ";
    }
    $adb->query($sql);
}

include_once("../include/__footer.php");
alert_replace("list.php");
