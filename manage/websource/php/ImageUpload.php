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
	
	$imageUNameEncode = $_POST["imageUNameEncode"];
	if (strtolower($imageUNameEncode) == "utf-8")
		header("Content-type: text/html; charset=utf-8");

	$defaultUPath = $_POST["defaultUPath"];
	$imageDomain = $_POST["imageDomain"];
	$imageEditorFlag = $_POST["imageEditorFlag"];
	$imageModify = $_POST["imagemodify"];
	$useExternalServer = $_POST["useExternalServer"];
	$checkPlugin = $_POST["checkPlugin"];
	$fileType = $_POST["fileType"];
	
	if (!checkLanguageVersion($supportVersion))
		executeScript("setInsertImageFile", "fail_language", "PHP" . $supportVersion, $useExternalServer, $imageDomain, $imageEditorFlag, $checkPlugin);
	
	$encConvertFunc = checkEncodeCharsetFunction();
	if ($encConvertFunc == "false")
		executeScript("setInsertImageFile", "fail_function", "", $useExternalServer, $imageDomain, $imageEditorFlag, $checkPlugin);

	$imageUPath = $_POST["imageUPath"];

	$protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://';
	$imageUPathHost = $protocol . $_SERVER["HTTP_HOST"];

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
			$imageUPathHost = "http://" . substr($imageTemp, 0, strpos($imageTemp, "/"));
		}elseif (substr($imageUPath, 0 , 8) == "https://"){
			$imageTemp = substr($imageUPath, 8);
			$imageUPath = substr($imageTemp, strpos($imageTemp, "/"));
			$imageUPathHost = "https://" . substr($imageTemp, 0, strpos($imageTemp, "/"));
		}elseif (substr($imageUPath, 0 , 1) != "/"){
			executeScript("setInsertImageFile", "invalid_path", "", $useExternalServer, $imageDomain, $imageEditorFlag, $checkPlugin);
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
		executeScript("setInsertImageFile", "invalid_path", "", $useExternalServer, $imageDomain, $imageEditorFlag, $checkPlugin);
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

		$imageUNameType = $_POST["imageUNameType"];

		if ($imageUNameType == "real") {
			if ($encConvertFunc == "mb_convert")
				$fileBaseName = mb_convert_encoding(base64_decode($_POST["imageTempFName"]), strtolower($imageUNameEncode), "utf-8");
			else
				$fileBaseName = iconv("utf-8", strtolower($imageUNameEncode), base64_decode($_POST["imageTempFName"]));
			
			if($imageFileName == "blob")
				$fileBaseName = fileNameTimeSetting();

		} elseif ($imageUNameType == "random")
			 $fileBaseName = fileNameTimeSetting();
		else {
			$fileBaseName = $_POST["imageTempFName"];
			if (substr($fileBaseName, -1) != "/")
				$fileBaseName = str_replace("/", "==NamOSeSlaSH==", $fileBaseName);
		}

		if(strrpos($imageFileName, ".") == false && $checkPlugin == "false") {
			$imageFileName = fileNameTimeSetting() . "." . $fileType;
		}

		$fileBaseName = str_replace(" ", "_", $fileBaseName);
		$fileExtension = substr($imageFileName, (strrpos($imageFileName, ".") + 1));
		$fileExtension = strtolower($fileExtension);

		if (!isImageValid($fileExtension, $_POST["imageKind"]))
			executeScript("setInsertImageFile", "invalid_image", getImageKind($_POST["imageKind"]), $useExternalServer, $imageDomain, $imageEditorFlag, $checkPlugin);

		if(strlen($uploadFileExtBlockList) > 0 && !isArray($uploadFileExtBlockList, $fileExtension)){
			executeScript("setInsertImageFile", "UploadFileExtBlock", "", $useExternalServer, $imageDomain, $imageEditorFlag, $checkPlugin);
		}

		if ($imageFileSize > doubleval($_POST["imageSizeLimit"]))
			executeScript("setInsertImageFile", "invalid_size", $_POST["imageSizeLimit"], $useExternalServer, $imageDomain, $imageEditorFlag, $checkPlugin);
			
		/*
		* 2016.03.23 [4.0] hylee
		* image check
		*/	
		if ($_POST["imageKind"] == "image" || $_POST["imageKind"] == "backgroundimage") {
			$imgCheck = getImageSize($imageFileTempName);
			$oriWidthCheck = $imgCheck[0];
			$oriHeightCheck = $imgCheck[1];
			if($oriWidthCheck <= 0 || $oriHeightCheck <=  0) {
				executeScript("setInsertImageFile", "fail_image", getImageKind($_POST["imageKind"]), $useExternalServer, $imageDomain, $imageEditorFlag, $checkPlugin);
			}
		} /* end */

		$uploadFileSubDir = $_POST["uploadFileSubDir"];
		$imageMainDir = getImageMainDir($_POST["imageKind"]);

		if ($uploadFileSubDir == "false") {
			if($_POST["imageUPath"] == "") {
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
				executeScript("setInsertImageFile", "invalid_path", "",$useExternalServer,  $imageDomain, $imageEditorFlag, $checkPlugin);
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

		$urlFilePath = $imageUPathHost . $imageUPath;

		if ($uploadFileSubDir == "false") {
			if($_POST["imageUPath"] == "")
				$urlFilePath .= $imageMainDir . "/" . $fileRealName;
			else
				$urlFilePath .= $fileRealName;
		}
		else
			$urlFilePath .= $imageMainDir . "/" . $subDir . "/" . $fileRealName;

		$fileOrgPath = $_POST["imageOrgPath"];
		if ($fileOrgPath && $fileOrgPath != "")
			$fileOrgPath .= "|" . $urlFilePath;

		/*
		 * h 수정 2020.11.06
		 * https 에서 이미지 수정안됨 오류 수정
		 */
        if (substr($defaultUPath, 0 , 8) == "https://"){
            $urlFilePath = str_replace("http://","https://",$urlFilePath);
		}


		$returnParam = "{";
		$returnParam .= "\"imageURL\":\"" . str_replace("'", "\\\"", $urlFilePath) . "\",";
		$returnParam .= "\"imageTitle\":\"" . $_POST["imageTitle"] . "\",";
		$returnParam .= "\"imageAlt\":\"" . $_POST["imageAlt"] . "\",";
		$returnParam .= "\"imageWidth\":\"" . $_POST["imageWidth"] . "\",";
		$returnParam .= "\"imageWidthUnit\":\"" . $_POST["imageWidthUnit"] . "\",";
		$returnParam .= "\"imageHeight\":\"" . $_POST["imageHeight"] . "\",";
		$returnParam .= "\"imageHeightUnit\":\"" . $_POST["imageHeightUnit"] . "\",";
		$returnParam .= "\"imageSize\":\"" . $imageFileSize . "\",";

		$returnParam .= "\"imageMarginLeft\":\"" . $_POST["imageMaginLeft"] . "\",";
		$returnParam .= "\"imageMarginLeftUnit\":\"" . $_POST["imageMaginLeftUnit"] . "\",";
		$returnParam .= "\"imageMarginRight\":\"" . $_POST["imageMaginRight"] . "\",";
		$returnParam .= "\"imageMarginRightUnit\":\"" . $_POST["imageMaginRightUnit"] . "\",";
		$returnParam .= "\"imageMarginTop\":\"" . $_POST["imageMaginTop"] . "\",";
		$returnParam .= "\"imageMarginTopUnit\":\"" . $_POST["imageMaginTopUnit"] . "\",";
		$returnParam .= "\"imageMarginBottom\":\"" . $_POST["imageMaginBottom"] . "\",";
		$returnParam .= "\"imageMarginBottomUnit\":\"" . $_POST["imageMaginBottomUnit"] . "\",";

		$returnParam .= "\"imageAlign\":\"" . $_POST["imageAlign"] . "\",";
		$returnParam .= "\"imageId\":\"" . $_POST["imageId"] . "\",";
		$returnParam .= "\"imageClass\":\"" . $_POST["imageClass"] . "\",";
		$returnParam .= "\"imageBorder\":\"" . $_POST["imageBorder"] . "\",";
		$returnParam .= "\"imageKind\":\"" . $_POST["imageKind"] . "\",";
		$returnParam .= "\"imageOrgPath\":\"" . $fileOrgPath . "\",";
		if ($_POST["imageKind"] == "image") {
			$oriImg = getImageSize($imageFileTempName);
			$returnParam .= "\"imageOrgWidth\":\"" . $oriImg[0] . "\",";
			$returnParam .= "\"imageOrgHeight\":\"" . $oriImg[1] . "\",";
		}	
		if ($imageModify == "true")
			$returnParam .= "\"imageModify\":\"true\",";
		$returnParam .= "\"editorFrame\":\"" . $_POST["editorFrame"] . "\"";
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

		if ($imageEditorFlag == "flashPhoto") {		
			$scriptValue = "{";
			$scriptValue .= "\"result\":\"success\",";
			$scriptValue .= "\"imageURL\":\"" . $urlFilePath . "\",";
			$scriptValue .= "\"addmsg\":" . $returnParam;
			$scriptValue .= "}";

			/*
			$json = new Services_JSON();
			$test = $json->decode($scriptValue);
			
			if($test->result == "success"){
				echo $scriptValue;
			}else{
				executeScript("setInsertImageFile", "fail_image", "", $useExternalServer, $imageDomain, $imageEditorFlag, $checkPlugin);
			}
			*/

			/*
			$resultTest = json_decode($scriptValue);
			if (json_last_error() === JSON_ERROR_NONE) {
				echo $scriptValue;
			}else{
				executeScript("setInsertImageFile", "fail_image", "", $useExternalServer, $imageDomain, $imageEditorFlag, $checkPlugin);
			}
			*/
			echo $scriptValue;
		} else {
			executeScript("setInsertImageFile", "success", $returnParam, $useExternalServer, $imageDomain, $imageEditorFlag, $checkPlugin);
		}
	} else
		executeScript("setInsertImageFile", "fail_image", "", $useExternalServer, $imageDomain, $imageEditorFlag, $checkPlugin);
?>
