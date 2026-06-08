<?php
	error_reporting(E_ALL ^ E_NOTICE);

	$check_uri = "http://crosseditor.namoeditor.co.kr/application/CELicenseCheck.php";
	$check_pinfo = "./EditorInformation.php";
	if (!file_exists($check_pinfo)){ exit; }

	include $check_pinfo;
	include "./Util.php";
	$authHostInfo = "";
	$conkey = $_GET["connection"];

	if($conkey == "ServerGr") {
		$authHostInfo = $_SERVER["SERVER_ADDR"];
	}
	else {
		$authHostInfo =	$_SERVER["HTTP_HOST"];
	}

	$check_uri .= "?editordomain=" . $authHostInfo;
	$check_uri .= "&serial=" . $ce_serial;
	$check_uri .= "&editorkey=" . $ce_editorkey;
	$editorkey = $_GET["editorkey"];

	$conval = $ce_domain . "|" . $ce_use . "|" . $ce_exp . "|" . $authHostInfo;

	$exp_check = "false";
	if($ce_exp && $ce_exp != ""){
		$exp_date = base64_decode($ce_exp);
		$today = date("Y-m-d");
		if($exp_date >= $today){
			$exp_check = "true";
		}
	}

	if ($editorkey && $editorkey != ""){
		if ($editorkey == "ProductInfo"){
			$returnParam = $ce_company.'|';
			$returnParam .= $ce_use.'|';
			$returnParam .= $ce_serial.'|';
			$returnParam .= $ce_lkt;
			echo htmlspecialchars($returnParam);
		}else{
			if($exp_check == "false"){
				echo "EXPIRE";
			}elseif (createEncodeEditorKey($ce_editorkey) == $editorkey){
				echo "SUCCESS";
			}else{
				echo "NULL";
			}
		}
	}else{

		$conval = $ce_domain . "|" . $exp_check . "|" . $authHostInfo ."|" . createEncodeEditorKey($ce_editorkey);
		//$conval = $ce_domain . "|" . $ce_exp . "|" . $authHostInfo ."|" . createEncodeEditorKey($ce_editorkey);
		echo htmlspecialchars($conval);
	}

?>