<script src="/adframe/mng/js/jquery.form.min.js"></script>
<script src="/adframe/bbs/Extention/Editor/ckeditor/ckeditor.js"></script>
<script src="/adframe/bbs/Extention/Editor/ckeditor/adapters/jquery.js"></script>
<textarea name="fm_content" id="fm_content" style="width: 100%; height: 300px;"><?=$bbs_row[content]?></textarea>
<script>
	$('#fm_content').ckeditor();

	//객체 생성
	var ajaxImage = {};
	// ckeditor textarea id
	ajaxImage["id"] = "fm_content";
	// 업로드 될 디렉토리
	ajaxImage["uploadDir"] = "upload";
	// 한 번에 업로드할 수 있는 이미지 최대 수
	ajaxImage["imgMaxN"] = 10;
	// 허용할 이미지 하나의 최대 크기(MB)
	ajaxImage["imgMaxSize"] = 20;
</script>