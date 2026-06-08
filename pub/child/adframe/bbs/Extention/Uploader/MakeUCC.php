<?
	/******************** 파일 삭제 구문 ***********************************/
	//if($_POST[up_file_del]){
	//	
	//	$delete_count = count($_POST[up_file_del]);
	//	for($i=0; $i < $delete_count; $i++){
	//		$file_row = DBarray("SELECT idx, up_filepath FROM ".$configBBS[board_id]."_file WHERE up_file_idx = '".$upfileidx."' AND idx='".$_POST[up_file_del][$i]."'");
	//		
	//		$sdata_dirpath = $file_row[up_filename]; //썸네일 디렉토리
	//
	//		if(file_exists($file_row[up_filepath])) @unlink($file_row[up_filepath]); //파일삭제
	//		if(file_exists($sdata_dirpath)) @unlink($sdata_dirpath); //파일삭제
	//		
	//		DBquery("DELETE FROM ".$configBBS[board_id]."_file WHERE idx=".$file_row[idx]);
	//	}
	//	
	//	DBquery("UPDATE ".$configBBS[board_id]." SET up_file = up_file - ".$delete_count." WHERE idx=".$dataArr[idx]);
	//	
	//}
	/******************** 파일 삭제 구문 ***********************************/
	
	/******************** 파일 업로드 구문 ***********************************/
		
	//if($_POST['FileSize'] > 0 && $_POST['SelectFile']){
	//
	//	/******************** 파일 삭제 구문 ***********************************/
	//
	//    $delete_count = 0;
	//    $file_result = DBquery("SELECT * FROM ".$configBBS[board_id]."_file WHERE up_file_idx='".$upfileidx."'");
	//    while($file_row=mysql_fetch_array($file_result)){
	//
	//		$sdata_dirpath = $file_row[up_filename]; //썸네일 디렉토리
	//
	//		if(file_exists($file_row[up_filepath])) @unlink($file_row[up_filepath]); //파일삭제
	//		if(file_exists($sdata_dirpath)) @unlink($sdata_dirpath); //파일삭제
	//		
	//		DBquery("DELETE FROM ".$configBBS[board_id]."_file WHERE idx=".$file_row[idx]);
	//		
	//		$delete_count = $delete_count + 1;
	//    }
	//	
	//	DBquery("UPDATE ".$configBBS[board_id]." SET up_file = up_file - ".$delete_count." WHERE idx=".$dataArr[idx]);
	//
	//	
	//	/******************** 파일 삭제 구문 ***********************************/
	//
	//
	//	$ucc_vodpath = "upfile_data_ucc/VOD/".$_POST['VideoFile'];
	//	$ucc_imgpath = "upfile_data_ucc/ThumbnailImg/".$_POST['ImageFile'];
	//	
	//	/*
	//	FTP업로드 방식이라 nobody가 권한변경안됨
	//	$result = chmod($ucc_vodpath, 0707);
	//    if(!$result)	go_back("동영상 업로드에 실패하였습니다.");
	//    
	//    $result = chmod($ucc_imgpath, 0707);
	//    if(!$result)	go_back("썸네일 업로드에 실패하였습니다.");
	//	*/
	//	
	//	$img_sql[0] = "up_file_idx = '$upfileidx', up_filename='".$ucc_imgpath."', up_filepath='".$ucc_vodpath."', up_filesize='".$_POST['FileSize']."', play_time='".$_POST['PlayTime']."', file_width='0', file_height='0', file_type='10', datetime=now(), userIp='$_SERVER[REMOTE_ADDR]' ";
	//	$filei = 1;
	//}
	/******************** 파일 업로드 구문 ***********************************/
	
	
?>