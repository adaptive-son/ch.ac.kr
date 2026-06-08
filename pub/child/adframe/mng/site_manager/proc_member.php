<?php  
	include_once("../_common.php"); 
	$num = sql_fetch("select count(*) as cnt from set_member where gubun='".$_POST['gubun']."'");
	
	$count = $num['cnt'];
	
	if($count>0){
		$query = "UPDATE set_member SET member_id='{$_POST['memberId']}', member_id2='{$_POST['memberId2']}', member_id3='{$_POST['memberId3']}' WHERE gubun='{$_POST['gubun']}'";
	}else{
		$query = "INSERT set_member (gubun, member_id, member_id2, member_id3) values ('{$_POST['gubun']}','{$_POST['memberId']}','{$_POST['memberId2']}','{$_POST['memberId3']}')";
	}
	sql_query($query);
	echo "<script>alert('적용되었습니다..');location.href='./set_".$_POST['gubun']."_member.php'</script>";
?>