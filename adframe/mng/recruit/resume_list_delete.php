<?
// adframe 공통 인클루드 파일
include_once "../_common.php";
// 접속로그
include_once( dirname(__FILE__)."/lib/log.access.forPrivate.php" );
include_once( dirname(__FILE__)."/../employment/lib/func.delete_apply_file.php" );
for($i=0; $i<count($chk); $i++){
    $del_idx = $chk[$i];
    // 첨부파일 삭제 (DB 행 삭제 전에 경로 조회)
    $frow = mysql_fetch_array(mysql_query("SELECT file_name FROM recruit_copy WHERE wr_id='$del_idx'"));
    if ($frow) delete_apply_file($frow['file_name']);
    $sql = "DELETE FROM recruit_copy WHERE wr_id='$del_idx'";
    mysql_query($sql);
    $sql2 = "DELETE FROM recruit1 WHERE parent='$del_idx'";
    mysql_query($sql2);
}
// 개인정보 접근로그
if ( $pgidx > 0 ) log_Access_ForPrivate("recruit-app-delete");
echo "<script>alert('삭제되었습니다.');location.href='recruit.php?resume_gubun=$resume_gubun'</script>";
?>