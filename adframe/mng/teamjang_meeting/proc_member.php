<?php  
	include_once("../_common.php"); 
	//print_R($_POST);
	$num = sql_fetch("select count(*) as cnt from teamjang_meeting_member");
	
	$count = $num['cnt'];

	for($i=1;$i<=$count;$i++){
		$query = "UPDATE teamjang_meeting_member SET m_member='{$_POST[$i]}' WHERE idx='$i'";
		sql_query($query);
	}

	echo "<script>alert('수정되었습니다.');location.href='./set_member.php'</script>";
?>