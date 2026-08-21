<? include "../_common.php" ?>

<?php

if($mode=="" || $mode=="u") {
    // 추가, 수정
    $sql_common = "
		schedule_no = '$schedule_no',
        schedule_start_date = '$schedule_start_date',
        schedule_end_date	= '$schedule_end_date',
        schedule_memo		= '$schedule_memo',
        del_yn='N',
        site_id = '$_SESSION[sel_site_id]'
    ";

}



if($mode=="") {
    $sql = " insert into ".TABLE_SCHEDULE." set ".$sql_common;
} else if ($mode=="u") {
    $sql = $sql = " update ".TABLE_SCHEDULE." set ".$sql_common." WHERE schedule_no = '$schedule_no'" ;

} else if ($mode=="d") {

    // 파일 삭제
    $sql = " select * from ".TABLE_SCHEDULE."  WHERE schedule_no = '$schedule_no'" ;
    $row = $adb->getRow($sql);
    $sql = " update  ".TABLE_SCHEDULE." set del_yn='Y' WHERE schedule_no = '$schedule_no'" ;
}
$result = mysql_query($sql) or die(mysql_error());

if($mode=="u") {
    alert_href("schedule.inc.php","정상적으로 수정되었습니다.");
}else if($mode=="d"){
    alert_href("schedule.inc.php","정상적으로 삭제되었습니다.");
}else {
    alert_href("schedule.inc.php","저장되었습니다.");
}

?>


