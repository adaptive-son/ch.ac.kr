<?
    /*
     *  저장 디렉토리 변경 ( By.Son 2016.12.18 )
     *  /adframe/bbs/ -> /data/bbs/
     *  /adframe/common/inc.constant.php 파일 참고
     */

	/******************** 파일 삭제 구문 ***********************************/
	//if($_POST[up_file_del]){
	if($_delParam){
		$delete_count = count($_delParam);
		for($i=0; $i < $delete_count; $i++){
			$file_row = DBarray("SELECT idx, up_filepath FROM ".$configBBS[board_id]."_file WHERE up_file_idx = '".$upfileidx."' AND idx='".$_delParam[$i]."'");

			$sdata_dirpath = str_replace("upfile_data/", "upfile_data_thumnail/", $file_row[up_filepath]); //썸네일 디렉토리

			if(file_exists($file_row[up_filepath])) unlink($file_row[up_filepath]); //파일삭제
			if(file_exists($sdata_dirpath)) unlink($sdata_dirpath); //파일삭제

			DBquery("DELETE FROM ".$configBBS[board_id]."_file WHERE idx=".$file_row[idx]);
		}

		DBquery("UPDATE ".$configBBS[board_id]." SET up_file = up_file - ".$delete_count." WHERE idx=".$dataArr[idx]);

	}
	/******************** 파일 삭제 구문 ***********************************/
$Config_FileLimitExt = array("jpg","jpge","png","gif","JPG","hwp","hwpx","xls","xlsx","PDF","pdf","ppt","zip","bmp");
	/******************** 파일 업로드 구문 ***********************************/

	if ($_FILES[up_file][tmp_name]) {
		//데이타저장디렉토리
		$UPDIR1 = "upfile_data/" . date("Y-m");
		$UPDIR2 = "upfile_data/" . date("Y-m") . "/" . date("Y-m-d");

		$UPDir = $UPDIR2;

		if (!file_exists(BBS_FILE_PATH."/".$UPDIR1)) {
			mkdir(BBS_FILE_PATH."/".$UPDIR1, 0707);
			$result = chmod(BBS_FILE_PATH."/".$UPDIR1, 0707);
			if (!$result) go_back("저장 디렉토리 생성에 실패하였습니다.");
		}
		if (!file_exists(BBS_FILE_PATH."/".$UPDIR2)) {
			mkdir(BBS_FILE_PATH."/".$UPDIR2, 0707);
			$result = chmod(BBS_FILE_PATH."/".$UPDIR2, 0707);
			if (!$result) go_back("저장 디렉토리 생성에 실패하였습니다.");
		}

		$filei = 0;
		for ($i = 0; $i < count($_FILES[up_file][name]); $i++) {

			$file_temp = $_FILES['up_file']['tmp_name'][$i];
			$file_name = $_FILES['up_file']['name'][$i];
			$file_size = $_FILES['up_file']['size'][$i];

			$file_save_text = ${"up_file_text$i"};

			// 20151115 파일명에 홀따옴표 들어갈 경우에 sql query string 에서 당연 오류가 난다.
			//$file_name = mysql_real_escape_string($file_name);

			$file_savename = time() . md5($file_name); //파일명 변경
			//$file_savepath = $UPDir . "/" . $file_savename; //업로드 풀경로

			//파일크기가 0byte보다 크거나 설정된 업로드 최대용량보다 작을경우
			if ($file_size > 0 && $file_size <= $configBBS[board_upfilesize]) {

				$file_ext = strtolower(get_ext($file_name));
				$file_savename= $file_savename.".".$file_ext;
				$file_savepath = $UPDir . "/" . $file_savename; //업로드 풀경로

				if (in_array($file_ext,$Config_FileLimitExt) == false){
					go_back("업로드 하신 파일 중 보안에 문제가 있는 파일이 있습니다.");
				}

				//이미지 업로드
				$upfile_code = move_uploaded_file($file_temp, BBS_FILE_PATH."/".$file_savepath);
				chmod(BBS_FILE_PATH."/".$file_savepath, 0700);

				if ($upfile_code == 1) {

					//이미지인지 체크
					$tmpimg = @getimagesize(BBS_FILE_PATH."/".$file_savepath);

					if ($tmpimg[2] > 0 && $tmpimg[2] < 4) {
						/*
						  gif : 1
						  jpg : 2
						  png : 3
						*/
						//echo "이미지 파일".$tmpimg[2]."<br>";
						//$img_sql = ", file_width='$tmpimg[0]', file_height='$tmpimg[1]', file_type='$tmpimg[2]' ";

						$UPDIR3 = "upfile_data_thumnail/" . date("Y-m");
						$UPDIR4 = "upfile_data_thumnail/" . date("Y-m") . "/" . date("Y-m-d");

						$thumnail_path = $UPDIR4 . "/" . $file_savename;

						if (!file_exists(BBS_FILE_PATH."/".$UPDIR3)) {
							mkdir(BBS_FILE_PATH."/".$UPDIR3, 0707);
							$result = chmod(BBS_FILE_PATH."/".$UPDIR3, 0707);
							if (!$result) go_back("저장 디렉토리 생성에 실패하였습니다.");
						}
						if (!file_exists(BBS_FILE_PATH."/".$UPDIR4)) {
							mkdir(BBS_FILE_PATH."/".$UPDIR4, 0707);
							$result = chmod(BBS_FILE_PATH."/".$UPDIR4, 0707);
							if (!$result) go_back("저장 디렉토리 생성에 실패하였습니다.");
						}

						$thumimg_width = $configBBS[board_gallwidth];

						if ($tmpimg[0] > $thumimg_width) {

							$thumimg_height = $tmpimg[0] / $thumimg_width;
							$thumimg_height = ceil(($tmpimg[1] / $thumimg_height));

							Thumnail(BBS_FILE_PATH."/".$file_savepath, $file_savename, BBS_FILE_PATH."/".$UPDIR4 . "/", $thumimg_width, $thumimg_height);
							chmod($thumnail_path, 0700);
						}

						//SQL생성
						$img_sql[$filei] = "up_file_idx = '$upfileidx', up_filename='$file_name', up_filepath='" . $UPDir . "/" . $file_savename . "', up_filesize='$file_size', datetime=now(), userIp='$_SERVER[REMOTE_ADDR]', file_width='$tmpimg[0]', file_height='$tmpimg[1]', file_type='$tmpimg[2]', file_text='$file_save_text' ";

					} else {
						//SQL생성
						$img_sql[$filei] = "up_file_idx = '$upfileidx', up_filename='$file_name', up_filepath='" . $UPDir . "/" . $file_savename . "', up_filesize='$file_size', datetime=now(), userIp='$_SERVER[REMOTE_ADDR]' ";
					}

					$filei = $filei + 1;
				}
			}
		}

		if ($filei > $configBBS[board_upfile]) go_back("제한 된 파일 업로드 갯수를 초과하였습니다.");
	}

	/******************** 파일 업로드 구문 ***********************************/
?>
