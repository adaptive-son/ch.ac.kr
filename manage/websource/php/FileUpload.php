<?php
	error_reporting(E_ALL ^ E_NOTICE);
	include "./Util.php";
	//include "./JSON.php";

	//2018-11-20[4.2.0.12]vaccine로직 주석(수정된 빌드로 나갈 때 추가)
	//include "./Vaccine.php";
	
	if (strtolower($_GET["licenseCheck"]) == "true") { 
		echo htmlspecialchars($_SERVER["SERVER_ADDR"]); 
		exit; 
	}
	 
	$imageUNameEncode = $_POST["fileUNameEncode"];
	if (strtolower($imageUNameEncode) == "utf-8")
		header("Content-type: text/html; charset=utf-8");

	$defaultUPath = $_POST["defaultUPath"];
	$fileDomain = $_POST["fileDomain"];
	$fileEditorFlag = $_POST["fileEditorFlag"];
	$fileModify = $_POST["filemodify"];
	$useExternalServer = $_POST["useExternalServer"];

	$checkPlugin = "false";
	 
	if (!checkLanguageVersion($supportVersion))
		executeScript("setInsertFile", "fail_language", "PHP" . $supportVersion, $useExternalServer, $fileDomain, $fileEditorFlag, $checkPlugin);
	
	$encConvertFunc = checkEncodeCharsetFunction();
	if ($encConvertFunc == "false")
		executeScript("setInsertFile", "fail_function", "", $useExternalServer, $fileDomain, $fileEditorFlag, $checkPlugin);

	$imageUPath = $_POST["fileUPath"];

	$protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://';
	$fileUPathHost = $protocol . $_SERVER["HTTP_HOST"];

	$imagePhysicalPath = "";

	$uploadFileExtBlockList = "";

	//2018-11-20[4.2.0.12]vaccine로직 주석(수정된 빌드로 나갈 때 추가)
	//$strVaccinePath = "";
	//include "./VaccinePath.php";

	include "./ImagePath.php";
	include "./UploadFileExtBlockList.php";


	if ($imageUPath) {
		if (substr($imageUPath, 0 , 7) == "http://") {
			$imageTemp = substr($imageUPath, 7);
			$imageUPath = substr($imageTemp, strpos($imageTemp, "/"));
			$fileUPathHost = "http://" . substr($imageTemp, 0, strpos($imageTemp, "/"));
		}elseif (substr($imageUPath, 0 , 8) == "https://"){
			$imageTemp = substr($imageUPath, 8);
			$imageUPath = substr($imageTemp, strpos($imageTemp, "/"));
			$fileUPathHost = "https://" . substr($imageTemp, 0, strpos($imageTemp, "/"));
		}elseif (substr($imageUPath, 0 , 1) != "/"){
			executeScript("setInsertFile", "invalid_path", "", $useExternalServer, $fileDomain, $fileEditorFlag, $checkPlugin);
		}
	} else {
		if (substr($defaultUPath, 0 , 7) == "http://") {
			$imageTemp = substr($defaultUPath, 7);
			$imageUPath = substr($imageTemp, strpos($imageTemp, "/"));
		}elseif (substr($defaultUPath, 0 , 8) == "https://"){
			$imageTemp = substr($defaultUPath, 8);
			$imageUPath = substr($imageTemp, strpos($imageTemp, "/"));
		}else{
			$imageUPath = $defaultUPath;
		}
	}

	if ($imagePhysicalPath) {
		if (substr($imagePhysicalPath, -1) != DIRECTORY_SEPARATOR)
			$imagePhysicalPath .= DIRECTORY_SEPARATOR;
	} elseif (!@chdir(GetLogicalPath($imageUPath)))
		executeScript("setInsertFile", "invalid_path", "", $useExternalServer, $fileDomain, $fileEditorFlag, $checkPlugin);
	else
		$imagePhysicalPath = getcwd() . DIRECTORY_SEPARATOR;

	if (substr($imageUPath, -1) != "/")
		$imageUPath .= "/";

	if (isset($_FILES["imageFile"]) && !is_null($_FILES["imageFile"]["tmp_name"])) {
		$imageFileName = $_FILES["imageFile"]["name"];
		$imageFileType = $_FILES["imageFile"]["type"];
		$imageFileSize = $_FILES["imageFile"]["size"];
		$imageFileTempName = $_FILES["imageFile"]["tmp_name"];

		if(strpos(strtolower($imageFileName),".php") || strpos(strtolower($imageFileName),".js") || strpos(strtolower($imageFileName),".html") || strpos(strtolower($imageFileName),".htm")){
			executeScript("setInsertFile", "UploadFileExtBlock", "", $useExternalServer, $fileDomain, $fileEditorFlag, $checkPlugin);
		}

		$special_pattern = "/[#%\/;:+*?<>|\\\]/";
		if(preg_match($special_pattern, $imageFileName)){
			executeScript("setInsertFile", "invalid_name", "", $useExternalServer, $fileDomain, $fileEditorFlag, $checkPlugin);
		}

		$imageUNameType = $_POST["fileUNameType"];

		if ($imageUNameType == "real") {
			if ($encConvertFunc == "mb_convert")
				$fileBaseName = mb_convert_encoding(base64_decode($_POST["fileTempFName"]), strtolower($imageUNameEncode), "utf-8");
			else
				$fileBaseName = iconv("utf-8", strtolower($imageUNameEncode), base64_decode($_POST["fileTempFName"]));
		} elseif ($imageUNameType == "random")
			 $fileBaseName = fileNameTimeSetting();
		else {
			$fileBaseName = $_POST["fileTempFName"];
			if (substr($fileBaseName, -1) != "/")
				$fileBaseName = str_replace("/", "==NamOSeSlaSH==", $fileBaseName);
		}

		$fileBaseName = str_replace(" ", "_", $fileBaseName);
		$fileExtension = substr($imageFileName, (strrpos($imageFileName, ".") + 1));
		$fileExtension = strtolower($fileExtension);

		if(strlen($uploadFileExtBlockList) > 0 && !isArray($uploadFileExtBlockList, $fileExtension)){
			executeScript("setInsertFile", "UploadFileExtBlock", "", $useExternalServer, $fileDomain, $fileEditorFlag, $checkPlugin);
		}

		if ($imageFileSize > doubleval($_POST["fileSizeLimit"]))
			executeScript("setInsertFile", "invalid_size", $_POST["fileSizeLimit"], $useExternalServer, $fileDomain, $fileEditorFlag, $checkPlugin);

		$uploadFileSubDir = $_POST["uploadFileSubDir"];
		$imageMainDir = getImageMainDir($_POST["fileKind"]);

		if ($uploadFileSubDir == "false") {
			if($_POST["fileUPath"] == "") {
				$imagePhysicalPath .= $imageMainDir . DIRECTORY_SEPARATOR;
				if (!is_dir($imagePhysicalPath)) {
					mkdir($imagePhysicalPath, 0775);
					chmod($imagePhysicalPath, 0775);
				}
			}
		} else {
			$imagePhysicalPath .= $imageMainDir . DIRECTORY_SEPARATOR;
			if (!is_dir($imagePhysicalPath)){
				mkdir($imagePhysicalPath, 0775);
				chmod($imagePhysicalPath, 0775);
			}

			$subDir = getChildDirectory($imagePhysicalPath, $_POST["imageMaxCount"]);
			if ($subDir == "")
				executeScript("setInsertFile", "invalid_path", "",$useExternalServer,  $fileDomain, $fileEditorFlag, $checkPlugin);
			else
				$imagePhysicalPath = $imagePhysicalPath . $subDir . DIRECTORY_SEPARATOR;
		}
		
		$fileRealName = checkFileUniqueName($fileBaseName, $fileExtension, $imagePhysicalPath);
		$moveFilePath = $imagePhysicalPath . $fileRealName;

		if ($imageUNameType == "real") {
			if ($encConvertFunc == "mb_convert")
				$fileRealName = mb_convert_encoding($fileRealName, "utf-8", strtolower($imageUNameEncode));
			else
				$fileRealName = iconv(strtolower($imageUNameEncode), "utf-8", $fileRealName);
		}

		$urlFilePath = $fileUPathHost . $imageUPath;

		if ($uploadFileSubDir == "false") {
			if($_POST["fileUPath"] == "")
				$urlFilePath .= $imageMainDir . "/" . $fileRealName;
			else
				$urlFilePath .= $fileRealName;
		}
		else
			$urlFilePath .= $imageMainDir . "/" . $subDir . "/" . $fileRealName;
		
		$fileOrgPath = $_POST["imageOrgPath"];
		if ($fileOrgPath && $fileOrgPath != "")
			$fileOrgPath .= "|" . $urlFilePath;
		
		$returnParam = "{";

		$returnParam .= "\"fileURL\":\"" . str_replace("'", "\\\"", $urlFilePath) . "\",";
		$returnParam .= "\"fileTitle\":\"" . $_POST["fileTitle"] . "\",";
		$returnParam .= "\"fileId\":\"" . $_POST["fileId"] . "\",";
		$returnParam .= "\"fileKind\":\"" . $_POST["fileKind"] . "\",";
		$returnParam .= "\"fileType\":\"" . $fileExtension . "\",";
		$returnParam .= "\"fileSize\":\"" . $imageFileSize . "\",";
		$returnParam .= "\"editorFrame\":\"" . $_POST["editorFrame"] . "\",";
		$returnParam .= "\"fileModify\":\"" . $_POST["fileModify"] . "\",";
		$returnParam .= "\"fileClass\":\"" . $_POST["fileClass"] . "\"";
		
		$returnParam .= "}";
			
		move_uploaded_file($imageFileTempName, $moveFilePath);
		

		//2018-11-20[4.2.0.12]vaccine로직 주석(수정된 빌드로 나갈 때 추가)
		/*
		if (strlen($strVaccinePath) <= 0 ) {
			$strVaccinePath = $imagePhysicalPath . "../../../vse";
		}
		$strName = checkVirusFile ($moveFilePath, $imagePhysicalPath . "/", $strVaccinePath);
		if (strlen($strName) > 0) {
			$msg = "found virus (" . $strName . ")";
			executeScript("setInsertImageFile", "virus", $msg, $useExternalServer, $imageDomain, $imageEditorFlag, "false");
		}	
		*/
		
		executeScript("setInsertFile", "success", $returnParam, $useExternalServer, $fileDomain, $fileEditorFlag, $checkPlugin);
	} else
		executeScript("setInsertFile", "fail_image", "", $useExternalServer, $fileDomain, $fileEditorFlag, $checkPlugin);
?>
