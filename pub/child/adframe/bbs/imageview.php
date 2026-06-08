<?
	/*
	 *	HEADER() 설정 차이로 인해 기본 라이브러리를 별도로 설정 
	*/
	include($_SERVER['DOCUMENT_ROOT'] . "/adframe/common/inc.constant.php");
	// Pear 라이브러리 디렉토리 설정
	ini_set("include_path", ADFRAME_ROOT_PATH."/lib/Pear");
	require_once(ADFRAME_ROOT_PATH . "/common/dsn.ini.php");
	require_once("DB.php");
	$adb = DB::connect($dsn);
	/*
	 *	HEADER() 설정 차이로 인해 기본 라이브러리를 별도로 설정 
	*/
	foreach ( $_GET as $k => $v ) ${$k} = $v;
    $sql_thumb = " SELECT * FROM ".$board_table."_file WHERE up_file_idx = '".$idx."' ";

	// 첨부파일 내용이 없는 경우, 이미지 대체
	if ( $adb->query($sql_thumb)->numRows() == 0 ) {
		Header("Content-type: image/jpg");
		Header("Pragma: no-cache");
		Header("Expires: 0");
		$thumnail_file = $_SERVER['DOCUMENT_ROOT']."/pub/_common/img/common/noimg.jpg";
		$thumnail_size = filesize($thumnail_file);
		$fp = fopen( $thumnail_file, "r" );
		$img_data = fread($fp, $thumnail_size);
		fclose($fp);
        echo $img_data;
        exit;
	}
	
    $rs_thumb = $adb->getRow($sql_thumb, DB_FETCHMODE_ASSOC);
	
    switch ( $rs_thumb[file_type] ) {
        case '1': $ext = "gif"; break;
        case '2': $ext = "jpg"; break;
        case '3': $ext = "png"; break;
        default: $ext = "jpg"; break;
    }
	Header("Content-type: image/".$ext);
	Header("Pragma: no-cache");
	Header("Expires: 0");
	// 썸네일 이미지 위치 변경
	$thumnail_path = str_replace("upfile_data/", "upfile_data_thumnail/", $rs_thumb[up_filepath]);
	$thumnail_path = str_replace("upfile_old/", "upfile_old_thumnail/", $thumnail_path);
	
	// 썸네일 이미지 절대 경로
	if ( $thumnail_path != "" ) $upload_path = BBS_LOAD_PATH."/".$thumnail_path;

	if ( $image = "thumnail" ) {
		
		if ( !file_exists($_SERVER['DOCUMENT_ROOT'].$upload_path) || $rs_thumb[up_filepath] == "" || !$rs_thumb[up_filepath] ) {
			// 썸네일은 등록되지 않아도, 기존 업로드 파일은 존재함
			if ( !file_exists($_SERVER['DOCUMENT_ROOT'].str_replace("_thumnail", "", $upload_path)) ) $thumnail_file = $_SERVER['DOCUMENT_ROOT']."/page/img/board/img_sample01.gif";
			else $thumnail_file = $_SERVER['DOCUMENT_ROOT'].str_replace("_thumnail", "", $upload_path);
			$thumnail_size = filesize($thumnail_file);
		} else {
			if ( file_exists($_SERVER['DOCUMENT_ROOT'].$upload_path.".thumb") ) $thumnail_file = $_SERVER['DOCUMENT_ROOT'].$upload_path.".thumb";
			else $thumnail_file = $_SERVER['DOCUMENT_ROOT'].$upload_path;
			$thumnail_size = filesize($thumnail_file);
		}

		$fp = fopen( $thumnail_file, "r" );
		$img_data = fread($fp, $thumnail_size);
		fclose($fp);
		
		echo $img_data;
		exit;
	}
?>