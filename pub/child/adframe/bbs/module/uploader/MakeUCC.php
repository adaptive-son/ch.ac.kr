<? 
	//수정시 처리
    $file_result = DBquery("SELECT * FROM ".$configBBS[board_id]."_file WHERE up_file_idx='".$up_file_idx."'");
    
    if($up_file_count > 0){
	    while($file_row=mysql_fetch_array($file_result)){
			$exp_file_name = explode("/", $file_row[up_filename]);
			$real_file_name = $exp_file_name[(count($exp_file_name)-1)];
			if ($file_row[up_filepath]){
				$file_script .= "<input type='checkbox' name='up_file_del[]' value='".$file_row[idx]."'> 파일 삭제 ";
			}
	    }
	}

?>
		<dl class="writer-add-file">
			<dt>
				<label for="blank_area">
					대표이미지 첨부
				</label>
			</dt>
			<dd>
				<div class='file-box'><input type='file' id="blank_area" name='up_file[]'></div>
			</dd>
			<dd class="file-info-area">
				<p class="file-info">
					<label for="" style="margin-right: 15px;">
						<?=$real_file_name?>
					</label>
					<?=$file_script?>
				</p>
			</dd>
		</dl>
