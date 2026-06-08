<?php
	$filepath = '20160217.hwp';
	$filesize = filesize($filepath);
	$path_parts = pathinfo($filepath);
	$filename = "전임교원 신규임용 규정.hwp";
	$extension = $path_parts['extension'];
	 
	header("Pragma: public");
	header("Expires: 0");
	header("Content-Type: application/octet-stream");
	header("Content-Disposition: attachment; filename=\"$filename\"");
	header("Content-Transfer-Encoding: binary");
	header("Content-Length: $filesize");
	 
	ob_clean();
	flush();
	readfile($filepath);
?>