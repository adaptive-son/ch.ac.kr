<?php
session_start();

if(!$_SESSION['MEMBER_ID']){
	echo "<script>location.href='/login/login.php'</script>";
}else{
	echo "<script>location.href='/adframe/mng/'</script>";
}
?>