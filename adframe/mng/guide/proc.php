<?
include "../_common.php";

$site_id = $_SESSION[sel_site_id];

if ( $Confirm == "delete" ) {

    $sql = " delete from guide_menu where no = '".$no."' and site_id = '$site_id' ";
    $adb->query($sql);

} else {

    $sql_common = "
        title   = '" . addslashes($title) . "',
        page_no = '" . intval($page_no) . "',
        sort    = '" . intval($sort) . "',
        use_yn  = '$use_yn',
        site_id = '$site_id'
    ";

    if ( $no == "" ) {
        $sql = " insert into guide_menu set " . $sql_common;
    } else {
        $sql = " update guide_menu set " . $sql_common . " where no = '".$no."' and site_id = '$site_id' ";
    }
    $adb->query($sql);
}

include_once("../include/__footer.php");
alert_replace("list.php");
