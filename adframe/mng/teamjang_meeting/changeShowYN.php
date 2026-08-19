<?php
	include "../_common.php";
	$_showYN = ( $_GET['showYN'] == "Y" ) ? "Y" : "N";
	$_idx = (int)$_GET['idx'];
	$sql = "update teamjang_meeting set showYN = '{$_showYN}' where idx='{$_idx}'";

	$result = mysql_query($sql) or die (mysql_error());
?>