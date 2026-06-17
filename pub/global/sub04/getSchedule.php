<?php
header("Content-Type: application/json");

define("__AF__", TRUE);
// adframe 템플릿 페이지 설정.
include($_SERVER["DOCUMENT_ROOT"] . "/adframe/af_common.php");


$startDate = preg_match('/^\d{4}-\d{2}-\d{2}$/', $_GET['startDate']) ? $_GET['startDate'] : '';
$endDate   = preg_match('/^\d{4}-\d{2}-\d{2}$/', $_GET['endDate'])   ? $_GET['endDate']   : '';
$sql = " SELECT * FROM ".TABLE_SCHEDULE." WHERE del_yn='N' AND site_id='global' AND schedule_start_date BETWEEN '".$startDate."' AND '".$endDate."' ORDER BY schedule_start_date, schedule_end_date ";
$rs = $adb->query($sql);

for ( $i = 0 ; $rows = $rs->fetchRow(DB_FETCHMODE_ASSOC) ; $i++ ) {
    $schedule[$i]['title'] = $rows['schedule_memo'];
    $schedule[$i]['start'] = $rows['schedule_start_date'];
    $schedule[$i]['end'] = $rows['schedule_end_date'];
}
echo(json_encode($schedule));
?>