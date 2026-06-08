<?php
// adframe 공통 인클루드 파일
include_once "../_common.php";
// 접속로그
include_once( dirname(__FILE__)."/lib/log.access.forPrivate.php" );
$DBTable = "recruit_index_employment";

$idx = $_POST['idx'];
$subject = $_POST['subject'];
$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];
$gubun = $_POST['gubun'];

$query = " subject = '".$subject."',";
$query .= " start_date = '".$start_date."',";
$query .= " end_date = '".$end_date."',";
$query .= " gubun = '".$gubun."'";

if($idx){ //업데이트
    $sql = "UPDATE ".$DBTable." SET ".$query." WHERE idx='".$idx."'";
    $result = DBquery($sql);
    $msg = "수정";
    $url = "./recruit_write.php?idx=".$idx;
    if ( $pgidx > 0 ) log_Access_ForPrivate("recruit-categorywrite-update");
}else{
    $sql = "INSERT INTO ".$DBTable." SET ".$query.", aq_datetime=now()";
    $result = DBquery($sql);
    $msg = "등록";
    $url = "./";
    if ( $pgidx > 0 ) log_Access_ForPrivate("recruit-categorywrite-newinsert");
}
echo "<script type='text/javascript'>alert('".$msg." 되었습니다.'); location.href='".$url."'</script>"
?>