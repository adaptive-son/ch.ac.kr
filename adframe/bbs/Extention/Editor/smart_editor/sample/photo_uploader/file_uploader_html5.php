<?php

	$sFileInfo = '';
	$headers = array();

	function fname_make($first_name){
		$rand_str = rand(1,100);
		$fname = $first_name."_".date("YmdHis")."_".$rand_str;
		return $fname;
	}

	foreach($_SERVER as $k => $v) {
		if(substr($k, 0, 9) == "HTTP_FILE") {
			$k = substr(strtolower($k), 5);
			$headers[$k] = $v;
		}
	}


	$file = new stdClass;
	$file->name = rawurldecode($headers['file_name']);

	$name_arr = explode(".",rawurldecode($headers['file_name']));
	$name_arr_cnt = count($name_arr);
	$idx	= $name_arr_cnt-1;
	$file->name = fname_make("img").".".$name_arr[$idx];
//	$file->name = fname_make("img")."_".rawurldecode($headers['file_name']);

	$file->size = $headers['file_size'];
	$file->content = file_get_contents("php://input");

	$filename_ext = strtolower(array_pop(explode('.',$file->name)));
	$allow_file = array("jpg", "png", "bmp", "gif","jpeg");

//	if(!in_array($filename_ext, $allow_file)) {
//		echo "NOTALLOW_".$file->name;
//	} else {
    //$uploadDir = $_SERVER[DOCUMENT_ROOT]."/data/smartEditorUpload/";
    $uploadDir = "/home/dev/data/smartEditorUpload/";
		if(!is_dir($uploadDir)){
			mkdir($uploadDir, 0777);
		}

		$newPath = $uploadDir.iconv("utf-8", "cp949", $file->name);

		if(file_put_contents($newPath, $file->content)) {
			$sFileInfo .= "&bNewLine=true";
			$sFileInfo .= "&sFileName=".$file->name;
			$sFileInfo .= "&sFileURL=/data/smartEditorUpload/".$file->name;
		}

		echo $sFileInfo;
//	}

?>
