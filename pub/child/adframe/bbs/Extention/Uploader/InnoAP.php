<?

	/******************** 파일 삭제 구문 ***********************************/
	if($_POST[up_file_del]){
		
		$delete_count = count($_POST[up_file_del]);
		for($i=0; $i < $delete_count; $i++){
			$file_row = DBarray("SELECT idx, up_filepath FROM ".$configBBS[board_id]."_file WHERE up_file_idx = '".$upfileidx."' AND idx='".$_POST[up_file_del][$i]."'");

			$sdata_dirpath = str_replace("upfile_data/", "upfile_data_thumnail/", $file_row[up_filepath]); //썸네일 디렉토리

			if(file_exists($file_row[up_filepath])) unlink($file_row[up_filepath]); //파일삭제
			if(file_exists($sdata_dirpath)) unlink($sdata_dirpath); //파일삭제
			
			DBquery("DELETE FROM ".$configBBS[board_id]."_file WHERE idx=".$file_row[idx]);
			
		}
		
		DBquery("UPDATE ".$configBBS[board_id]." SET up_file = up_file - ".$delete_count." WHERE idx=".$dataArr[idx]);
		
	}
	/******************** 파일 삭제 구문 ***********************************/
	
	/******************** 파일 업로드 구문 ***********************************/
	if($_FILES[up_file][name]){
		
		//데이타저장디렉토리
		$UPDIR1 = "upfile_data/".date("Y-m");
		$UPDIR2 = "upfile_data/".date("Y-m")."/".date("Y-m-d");
		
		$UPDir = $UPDIR2;
		
		if(!file_exists($UPDIR1)) {
			mkdir($UPDIR1, 0707);
	    	$result = chmod($UPDIR1, 0707);
	    	if(!$result)	go_back("저장 디렉토리 생성에 실패하였습니다.");
		}
		if(!file_exists($UPDIR2)) {
			mkdir($UPDIR2, 0707); 
	    	$result = chmod($UPDIR2, 0707);
	    	if(!$result)	go_back("저장 디렉토리 생성에 실패하였습니다.");
		}
		
		$filei = 0;
		for($i=0; $i < count($_FILES[up_file][name]); $i++){
			
			$file_temp = $_FILES['up_file']['tmp_name'][$i]; 
			$file_name = $_FILES['up_file']['name'][$i]; 
			$file_size = $_FILES['up_file']['size'][$i];
			
			$file_savename = time().md5($file_name);
			
			$file_savepath = $UPDir."/".$file_savename;
			
			if($file_size > 0 && $file_size <= $configBBS[board_upfilesize]){	
				$file_ext = strtolower(get_ext($file_name));
				
				if(strpos($Config_FileLimitExt, $file_ext) == true) go_back("업로드 하신 파일 중 보안에 문제가 있는 파일이 있습니다.");
				
				//이미지 업로드
				$upfile_code = move_uploaded_file($file_temp, $file_savepath);
				chmod($file_savepath, 0700);
				
				if($upfile_code == 1) {
				
					//이미지인지 체크
					$tmpimg = @getimagesize($file_savepath);
					
			        if($tmpimg[2] > 0 && $tmpimg[2] < 4) {
		            	/*
		            	  gif : 1
		            	  jpg : 2
		            	  png : 3
		            	*/
		                //echo "이미지 파일".$tmpimg[2]."<br>";
		                //$img_sql = ", file_width='$tmpimg[0]', file_height='$tmpimg[1]', file_type='$tmpimg[2]' ";
		                
						$UPDIR3 = "upfile_data_thumnail/".date("Y-m");
						$UPDIR4 = "upfile_data_thumnail/".date("Y-m")."/".date("Y-m-d");
						
						$thumnail_path = $UPDIR4."/".$file_savename;
						
						if(!file_exists($UPDIR3)) {
							mkdir($UPDIR3, 0707);
					    	$result = chmod($UPDIR3, 0707);
					    	if(!$result)	go_back("저장 디렉토리 생성에 실패하였습니다.");
						}
						if(!file_exists($UPDIR4)) {
							mkdir($UPDIR4, 0707); 
					    	$result = chmod($UPDIR4, 0707);
					    	if(!$result)	go_back("저장 디렉토리 생성에 실패하였습니다.");
						}
		                
		                $thumimg_width = $configBBS[board_gallwidth];

						if($tmpimg[0] > $thumimg_width){
						
							$thumimg_height = $tmpimg[0] / $thumimg_width;
							$thumimg_height = ceil(($tmpimg[1] / $thumimg_height));
							
							Thumnail($file_savepath, $file_savename, $UPDIR4."/", $thumimg_width, $thumimg_height);
							chmod($thumnail_path, 0700);
						}
		                
		                //SQL생성
						$img_sql[$filei] = "up_file_idx = '$upfileidx', up_filename='$file_name', up_filepath='".$UPDir."/".$file_savename."', up_filesize='$file_size', datetime=now(), userIp='$_SERVER[REMOTE_ADDR]', file_width='$tmpimg[0]', file_height='$tmpimg[1]', file_type='$tmpimg[2]' ";
						
			        }else{
			        	//SQL생성
						$img_sql[$filei] = "up_file_idx = '$upfileidx', up_filename='$file_name', up_filepath='".$UPDir."/".$file_savename."', up_filesize='$file_size', datetime=now(), userIp='$_SERVER[REMOTE_ADDR]' ";
			        }
					
					/* Debug code
					echo $file_temp." --<br>";
					echo $file_name." --<br>";
					echo $file_size." --<br>";
					
					echo $file_ext."<br>";
	
					echo $file_savename."<br>";
					echo "<br>에러코드 : ".$upfile_code."<br>";
					*/
					
					
					$filei = $filei+1;
				}
			}
		}
		
		if($filei > $configBBS[board_upfile])	go_back("제한 된 파일 업로드 갯수를 초과하였습니다.");
	}
	
	/*
	for($i=0; $i < $filei; $i++){
		
		echo $img_sql[$i];
	}
	*/
	/******************** 파일 업로드 구문 ***********************************/
	
	
?>