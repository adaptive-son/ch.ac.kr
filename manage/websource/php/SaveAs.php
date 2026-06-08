<?php
	error_reporting(E_ALL ^ E_NOTICE);

	if ($_POST["save_string"] != null && $_POST["save_string"] != ""){
		
		header("Content-type: text/html; charset=utf-8"); 
		header("Content-Disposition: attachment; filename=untitled.html"); 
		$sHTML = urldecode($_POST["save_string"]);
		$sHTML = str_replace("\\'","'",$sHTML);
		$sHTML = str_replace("~~NamoSE_PlusChar","+",$sHTML);
		echo pack("C3" , 0xef, 0xbb, 0xbf);
		echo $sHTML;

	}else{

		exit;
	}

?>
