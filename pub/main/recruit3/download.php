<?php
	$filepath = 'hongbo2015.mp4';
	$filesize = filesize($filepath);
	$path_parts = pathinfo($filepath);
	$filename = "춘해보건대학교 홍보동영상[한국어버전].mp4";
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