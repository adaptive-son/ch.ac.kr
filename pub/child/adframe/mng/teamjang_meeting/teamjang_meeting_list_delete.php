<?php
	include "../acheck.php"; 
	include_once("../_common.php"); 

	for($i=0; $i<count($chk); $i++){
		$del_idx = $chk[$i];
		$sql = "DELETE FROM teamjang_meeting WHERE idx='$del_idx'";

		mysql_query($sql);
	}
	// 개인정보 접근로그
	if ( $pgidx > 0 ) log_Access_ForPrivate("recruit-categorylist-delete");
	echo "<script>alert('삭제되었습니다.');location.href='index.php?pg=$pg'</script>";
?>