<script language="javascript" src="/bbs/Extention/Uploader/MakeUCC/makeucc.js"></script> 
<script language = "javascript">
	var UCC = new MakeUCC();
	
	UCC.SetID("iuk");
	UCC.SetURL("http://<?=$_SERVER['HTTP_HOST']?>/bbs/Extention/Uploader/MakeUCC");

	UCC.SetLimitTime("0");
	UCC.SetFrameSize("600x400");	// 기본 320x240

	UCC.SetUploadType("FTP");
	UCC.SetFtpDir("/www.iuk.ac.kr/bbs/upfile_data_ucc");
	
	UCC.CreateConverter();
	
	function convert(oform) 
	{

		UCC.Convert(true, 100);
		oform.SelectFile.value = UCC.GetSelectFile();   //변환 완료 후 원본 파일명을 리턴. 웹페이지에 표시할 경우 사용
		//alert("SelectFile = " + UCC.GetSelectFile());
	}

	function upload(oform) 
	{

		oform.VideoFile.value = UCC.GetUploadVideoFile();  // 변환된 영상 파일명 리턴
		oform.ImageFile.value = UCC.GetUploadImageFile();  // 변환된 섬네일 파일명 리턴
		oform.FileSize.value = UCC.GetVideoFileSize();  // 변환된 영상 파일 사이즈 리턴
		oform.PlayTime.value = UCC.GetPlayTime();  // 변환된 영상 파일의 재생 시간 리턴	


		if(oform.SelectFile.value != "") {
			UCC.Upload('VOD', '0');
			oform.submit();
		}else{
			oform.submit();	
		}
	}
</script>