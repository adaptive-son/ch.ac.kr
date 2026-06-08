<?php
//수정시 처리
$file_result = DBquery("SELECT * FROM ".$configBBS[board_id]."_file WHERE up_file_idx='".$up_file_idx."'");

$confin_upload_count = $configBBS[board_upfile];

if($confin_upload_count == 0 && $configBBS[board_upfile] != 0){
	$confin_upload_count = 0;
	$script_link = "N";
}else{
	$script_link = "Y";
}

if($up_file_count > 0){
	$i=0;
	while($file_row=mysql_fetch_array($file_result)){
		if ( $file_row['up_filepath'] ) {
			$in_fileInfoArea = "<dd class='file-info-area'><p class='file-info'>";
			$in_fileInfoArea .= "<input type='checkbox' id='delete-file-".$file_row['idx']."' name='up_file_del[]' value='".$file_row[idx]."'><label for='delete-file-".$file_row['idx']."'>".$file_row['up_filename']."</label><input type='text' name='".$file_row['idx']."' value='$file_row[file_text]' placeholder='이미지 대체텍스트 입력' style='width:70%'/>";
			$in_fileInfoArea .= " <a class='btn-file-delete' href=javascript:; onclick=func_update(".$file_row['idx'].")>대체텍스트 수정</a><br />";
			$in_fileInfoArea .= "<a class='btn-file-delete' href=javascript:; onclick=func_check(".$file_row['idx'].")>파일 삭제</a></p></dd>";
			$file_script .= "add_file(\"".$in_fileInfoArea."\");";
		}else{
			//$file_script .= "add_file('');\n";
		}
		$i++;
	}
}else{
	$file_script .= "add_file('');\n";
}

?>
<dl class="writer-add-file">
	<dt>
		<label for="blank_area">
			파일첨부
		</label>
		<? if($script_link == "Y") { ?>
		<a href="javascript:add_file();">
			<img src="/adframe/mng/make_img/board/btn_plus@2x.gif" alt="파일 추가" />
		</a>
		<a href="javascript:del_file();">
			<img src="/adframe/mng/make_img/board/btn_minus@2x.gif" alt="파일 삭제" />
		</a>
		<? } ?>
	</dt>
	<dd>
		<p class="mb10 point-color01">
			※ 최대 <?=filesize_formatted($configBBS[board_upfilesize])?>까지 업로드 가능합니다
			<?php
				if($configBBS[origin_board_skin]=="course") {
			?>
				<br>
				<span style="color:red;font-weight:bold;">
					※ 파일 형식이 PDF인 파일만 업로드 해주세요.
				</span>
			<?php
				} else if($configBBS[origin_board_skin]=="sanhak") {
			?>
				<br>
				<span style="color:red;font-weight:bold;">
					※ 파일 형식이 jpg, gif, png인 파일만 업로드 해주세요.
				</span>
			<?php
				}	
			?>
		</p>
        <div class="attached-file-wrapper" id="variableFiles">
        </div>
	</dd>
</dl>

<script>
	function func_check(param){
		var idx = param;
		$('#delete-file-'+idx).prop('checked',true);
	}

	function func_update(param){
		var idx = param;
		var text = $("input:text[name='"+idx+"']").val();
		

		var params = {
				  idx      : idx
				, text     : text
				, bbs_id   : "<?php echo $configBBS[board_id]?>"
		}
			
		// ajax 통신
		 $.ajax({
			url: "/adframe/bbs/update_file_text.php",
			data: {
				idx      : idx
				, text     : text
				, bbs_id   : "<?php echo $configBBS[board_id]?>" 
			},
			success: function (result){
				console.log(result);
				alert("수정되었습니다.");
			},
			error: function(){
			}
		});
	}

	var flen = 0;
	function add_file(delete_code) {
		var upload_count = <?=$confin_upload_count?>;
		if (upload_count && flen >= upload_count) {
			alert("이 게시판은 "+upload_count+"개 까지만 파일 업로드가 가능합니다.");
			return;
		}
        var filehtml= $("#variableFiles").html();
		$("#variableFiles").append("<div class='file-box'><input type='file' name='up_file[]' onchange='checkFile(this)' title='파일 첨부"+String(flen+1)+"'><input type='text' name=\"up_file_text"+flen+"\" value='' placeholder='이미지 대체텍스트 입력' title='이미지 대체텍스트 입력"+String(flen+1)+"'/></div>");
		if (delete_code) {
            $("#variableFiles").html(filehtml+delete_code);
        }else
		{
			/* do nothing */
		}
		flen++;
	}

	<?=$file_script?>

	function del_file() {
		// file_length 이하로는 필드가 삭제되지 않아야 합니다.
		var file_length = 1;
		var file = $(".file-box").length;
		if (file>file_length)
		{
            $( ".file-box" ).last().remove();
            flen--;
		}
	}


    function checkFile(el){

        // files 로 해당 파일 정보 얻기.
        var file = el.files;

        // file[0].size 는 파일 용량 정보입니다.
        if(file[0].size > <?=$configBBS[board_upfilesize]?>){
            // 용량 초과시 경고후 해당 파일의 용량도 보여줌
            alert('<?=filesize_formatted($configBBS[board_upfilesize])?> 이하 파일만 등록할 수 있습니다.\n\n' + '현재파일 용량 : ' + (Math.round(file[0].size / 1024 / 1024 * 100) / 100) + 'MB');
        }

        // 체크를 통과했다면 종료.
        else return;

        // 체크에 걸리면 선택된 내용 취소 처리를 해야함.
        // 파일선택 폼의 내용은 스크립트로 컨트롤 할 수 없습니다.
        // 그래서 그냥 새로 폼을 새로 써주는 방식으로 초기화 합니다.
        // 이렇게 하면 간단 !?
        el.outerHTML = el.outerHTML;
    }
</script>