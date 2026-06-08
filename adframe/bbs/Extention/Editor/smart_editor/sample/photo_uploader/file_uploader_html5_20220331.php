<?php
 	$sFileInfo = '';
	$headers = array();

	foreach($_SERVER as $k => $v) {
		if(substr($k, 0, 9) == "HTTP_FILE") {
			$k = substr(strtolower($k), 5);
			$headers[$k] = $v;
		}
	}

	$filename = rawurldecode($headers['file_name']);

	$filename_ext = strtolower(array_pop(explode('.',$filename)));
	$allow_file = array("jpg", "png", "bmp", "gif","jpeg");

	if(!in_array($filename_ext, $allow_file)) {
		echo "NOTALLOW_".$filename;
  } else {
		$file = new stdClass;
		$file->name = date("YmdHis").mt_rand().".".$filename_ext;
		$file->content = file_get_contents("php://input");

    //$uploadDir = $_SERVER[DOCUMENT_ROOT]."/data/smartEditorUpload/".date("Y/m")."/";
    $uploadDir = $_SERVER[DOCUMENT_ROOT]."/data/smartEditorUpload/";
		if(!is_dir($uploadDir)){
			mkdir($uploadDir, 0777);
		}

		$newPath = $uploadDir.$file->name;

		if(file_put_contents($newPath, $file->content)) {
			$sFileInfo .= "&bNewLine=true";
			$sFileInfo .= "&sFileName=" . $filename;
			$sFileInfo .= "&sFileURL=http://".$_SERVER['SERVER_NAME']."/data/smartEditorUpload/".date("Y/m")."/" . $file->name;
		}
		echo $sFileInfo;
	}
?>
