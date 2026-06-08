<?
include "../_common.php";
if ( $Confirm == "delete" ) {
    // 쿼리 삭제
    $sql = " delete from ".TABLE_PART." where p_num = '".$p_num."' ";
    $adb->query($sql);
} else {

    $sql_common = "
        name = '$name',
        sort	= '$sort'
    ";
    if ( $p_num == "" ) {
        // 추가
        $sql = " insert into ".TABLE_PART." set ".$sql_common."";
    } else {
        // 수정
        $sql = " update ".TABLE_PART." set ".$sql_common." where p_num = '".$p_num."' ";
		/*print_r($sql);
		exit;*/

    }
    $adb->query($sql);
}
include_once("../include/__footer.php");
alert_replace("part.list.php");