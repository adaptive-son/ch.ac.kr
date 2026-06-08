<?
include "../_common.php";
if ( $Confirm == "delete" ) {
    // 쿼리 삭제
    $sql = " delete from ".TABLE_TEL." where t_num = '".$t_num."' ";
    $adb->query($sql);
} else {

    $sql_common = "
        t_category1 = '$t_category1',
        t_category2	= '$t_category2',
        t_position	= '$t_position',
        t_descript  = '$t_descript',
		t_telnum    = '$t_telnum',
        t_location  = '$t_location',
        t_sort	= '$t_sort',
        t_fax = '$t_fax'
    ";
    if ( $t_num == "" ) {
        // 추가
        $sql = " insert into ".TABLE_TEL." set ".$sql_common."";
    } else {
        // 수정
        $sql = " update ".TABLE_TEL." set ".$sql_common." where t_num = '".$t_num."' ";
		/*print_r($sql);
		exit;*/

    }
    $adb->query($sql);
}
include_once("../include/__footer.php");
alert_replace("tel.list.php");