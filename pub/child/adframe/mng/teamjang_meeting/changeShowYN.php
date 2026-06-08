<?php
	include "../_common.php";
	$sql = "update teamjang_meeting set showYN = '{$_GET['showYN']}' where idx='{$_GET['idx']}'";

	$result = mysql_query($sql) or die (mysql_error());
?>