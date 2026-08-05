<?php
// adframe 공통 인클루드 파일
include_once "../_common.php";
// 접속로그
include_once( dirname(__FILE__)."/lib/log.access.forPrivate.php" );
$DBTable = "recruit_index";

$idx = $_POST['idx'];
$subject = addslashes($_POST['subject']);
$start_date = addslashes($_POST['start_date']);
$end_date = addslashes($_POST['end_date']);

$query = " subject = '".$subject."',";
$query .= " start_date = '".$start_date."',";
$query .= " end_date = '".$end_date."'";

if($idx){ //업데이트
    $sql = "UPDATE ".$DBTable." SET ".$query." WHERE idx='".$idx."'";
    $result = DBquery($sql);
    $msg = "수정";
    $url = "./recruit_write.php?idx=".$idx;
    if ( $pgidx > 0 ) log_Access_ForPrivate("recruit-categorywrite-update");
}else{
    $sql = "INSERT INTO ".$DBTable." SET ".$query.", gubun='', aq_datetime=now()";
    $result = DBquery($sql);
    $msg = "등록";
    $url = "./";
    if ( $pgidx > 0 ) log_Access_ForPrivate("recruit-categorywrite-newinsert");
}
if ( $result ) {
    echo "<script type='text/javascript'>alert('".$msg." 되었습니다.'); location.href='".$url."'</script>";
} else {
    echo "<script type='text/javascript'>alert('오류가 발생하였습니다. ".$msg."되지 않았습니다.'); history.back();</script>";
}
?>