<? 
	//수정시 처리
    $file_result = DBquery("SELECT * FROM ".$configBBS[board_id]."_file WHERE up_file_idx='".$up_file_idx."'");
    
    //$confin_upload_count = $configBBS[board_upfile] - $up_file_count;
    $confin_upload_count = $configBBS[board_upfile];
    
    if($up_file_count > 0){
	    while($file_row=mysql_fetch_array($file_result)){
	    	
			if ($file_row[up_filepath]){
				$file_script .= " document.InnoAP.AddTempFile(\"".$file_row[up_filename]."\", ".$file_row[up_filesize].", \"".$file_row[idx]."\");  \n";
			}
	    }

	}

?>
<script type="text/javascript">

// 컴포넌트 로드 완료시 자동 호출되는 콜백 함수
function OnInnoAPLoad()
{
	SetInnoAPInit();
}

function SetInnoAPInit()
{
	// 파일 삭제정보 전역배열
	delArray = new Array(); 
	
	// 선택된 모든 파일제거
	document.InnoAP.RemoveAllFiles(); 

	<?=$file_script?>
}

function StartUpload(obj)
{
	// 삭제된 파일 정보를 폼에 추가
	for (var i in delArray)
	{
		var oForm = document.writeform;
		var oInput = document.createElement('<input type="hidden" name="up_file_del[]" value="' + delArray[i] + '">');
		oForm.insertAdjacentElement("afterBegin", oInput);
	}	
	// 파일과 폼을 함께 업로드
	// 전송할 파일이 없으면 true값이 리턴되며 폼만 전송
	//return InnoAPSubmit(obj);
	
	if (InnoAPSubmit(obj)){
		obj.submit();
    }
}

</script>

					<script type="text/javascript" src="/adframe/bbs/Extention/Uploader/InnoAP/InnoAP.js"></script>
					<script type="text/javascript">
					//iuk2011.adbank.co.kr
					//var Enc = "p85dYF5dMOBvVBhZX5eROedZnJL1smG9QTDNHC3ubgElYTSNkNsIMUWGFDbEtXUsZ3I+mpqoGMc4YLaZyv1VuP4ErHpBD/mvxR3ijO9rCBYbqPQYmfcnggxLBXRINgUSPjjDRdl9zN9H0W2sUcvN8s74nb5jmYhMngFvv7EU9S4Wa3/VVRJTEF9Cu4TT8rsv4qxBanbaxImARBJuobBh4u7wFfs1tr/nWf9bI4nTY6Tty19QnOb86swzXx5V6pRhuG/7ArEOpRRUNgK5lCuBJQixD2gWTt8a3WCgTm2FgztqqXfJCQcJKveRrAbbCzEug7XEEhXoHW/whxJm0d6bRhvM+/5F00dkF0JB53GzLGmGCYqyesKUuw==";
					
					//iuk.ac.kr
					var Enc = "2Q/mdhKNLByBeEnMzgp/4xprqpZ4Pba7VuAF9hzIAgeIQ5Aio8AxMy+unH5DYCKU8SjT021vcRZL822Ih7xwt6zsIsFOoOdoMU+ftvsTHuCDgM8OggDjqmIz6tT6zzN7qJuL8D1iNEHyHPLjA/2oY4Hj0PPetbssVHeHqxH+iWU1ydxno4za1jF8EBg3JqCeqiUacThMVi7r+E229XvGJ4/KV201Bv0SnufLmEBPQe+BCx/pQgyDmw==";
				
					var InputName = "up_file";
					var InputType = "array";
					
					<? if($bbs != "repair") { ?>
					var ActionFilePath = "/bbs/module_wte.php";
					<? }else{ ?>
					var ActionFilePath = "/bbs/module_edt.php";
					<? } ?>
				
					var ListStyle = "large icon";
					var ShowFullPath = "false";
					var ShowStatus = "true";
					var SetStatusWidth = "200|150|-1";
					
					var DialogListHeight = "100";
					var BkImgURL = ""; 
				
					var InnoAP_Cab = "/bbs/Extention/Uploader/InnoAP/InnoAP5.cab";
					
					InnoAPInit(<?=floor(($configBBS[board_upfilesize]/1000)*$confin_upload_count)?>, <?=floor($configBBS[board_upfilesize]/1000)?>, <?=$confin_upload_count?>, 0, "100%", 150);
					</script>
                   </td>
                  </tr>
              </table>

<script for="InnoAP" event="OnBeforeRemoveItem(index);">
if (document.InnoAP.IsTempFile(index))
{
	delArray.push(document.InnoAP.GetFileID(index));
}
</script>     
<script for="InnoAP" event="OnUploadComplete(ResponseData);">
document.write(ResponseData);
</script>