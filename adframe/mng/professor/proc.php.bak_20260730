<? include "../_common.php" ?>

<?php
// 업로드 파일 경로
$file_path = PROFESSOR_FILE_PATH;
if($mode=="u" || $mode=="d") {

    $sql = " select * from ".TABLE_PROFESSOR." where idx = '$idx' ";
    $cnt = mysql_num_rows(mysql_query($sql));
    if($cnt < 1) alert_msg("교수를 찾을 수 없습니다.");
}

if($mode=="" || $mode=="u") {
    // 추가, 수정

    if ( $_FILES[b_file][tmp_name]) {
        // 한글 파일명은 타임스탬프로 리네임한 후에 업로드 한다. 디비에는 원래 파일명과 리네임명을 동시에 저장한다.
        $orgFileName = $_FILES[b_file][name];
        $extName = array_pop(explode(".", strtolower($orgFileName)));
        $timeStamp = date("ymdHis",time());
        $renameFileName = $timeStamp . "." . $extName;
        // 사진업로드
        upload_file($_FILES[b_file][tmp_name], $renameFileName, $file_path);
        // 임시파일 삭제
        unlink($_FILES[b_file][tmp_name]);
        // 파일 업데이트 쿼리
        $sql_file_sub = ", file_name = '".$renameFileName."', file_org = '".$orgFileName."' ";
    }

    $career_tmp = addslashes($career); //경력사항에 ' 들어간 경우 db에러 처리

    $sql_common = "
        name = '$name',
        position	= '$position',
        office		= '$office',
        tel	= '$tel',
        email = '$email',
        researchresult_s = '$researchresult_s',
        responsibility1 = '$responsibility1',
		responsibility2 = '$responsibility2',
        del_yn='N',
        career2 = '$career2',
        site_id = '$_SESSION[sel_site_id]',
        sort = '$sort',
		etc1 = '$etc1'
    ";

}



if($mode=="") {
    //sort = (select max(sort)+1 from ".TABLE_PROFESSOR."a WHERE site_id = '$_SESSION[sel_site_id]' )
    $sql_insert =", regi_date=now()";
    $sql = " insert into ".TABLE_PROFESSOR." set ".$sql_common.$sql_file_sub.$sql_insert;
    //$sql = " update ".TABLE_PROFESSOR." set sort='$sort' WHERE idx ='$idx'";
} else if ($mode=="u") {
    $sql_update =", modi_date=now() ";
	if($_FILES['b_file']['tmp_name']=="" && $_POST['del_file']=="1"){
		$sql_file_sub = ", file_name = '', file_org = '' ";
	}
    $sql = " update ".TABLE_PROFESSOR." set ".$sql_common.$sql_file_sub.$sql_update." WHERE idx = '$idx'" ;

} else if ($mode=="d") {

    // 파일 삭제
    $sql = " select * from ".TABLE_PROFESSOR."  WHERE idx = '$idx'" ;
    $row = $adb->getRow($sql);
    unlink($file_path."/".$row[file_name]);

    $sql = " update  ".TABLE_PROFESSOR." set del_yn='Y' WHERE idx = '$idx'" ;
}
$result = mysql_query($sql) or die(mysql_error());

if($mode=="u") {
    alert_href("list.php","정상적으로 수정되었습니다.");
}else if($mode=="d"){
    alert_href("list.php","정상적으로 삭제되었습니다.");
}else {
    alert_href("list.php","저장되었습니다.");
}

?>


