<?
include "../_common.php";
// 업로드 파일 경로
$file_path = BANNER_FILE_PATH;
if ( $Confirm == "delete" ) {
    $no = (int)$no;
    // 파일 삭제
    $sql = " select * from ".TABLE_BANNER." where no = '".$no."' ";
    $row = $adb->getRow($sql);
    unlink($file_path."/".$row[banner_name]);
    unlink($file_path."/".$row[banner_name2]);
    // 쿼리 삭제
    $sql = " delete from ".TABLE_BANNER." where no = '".$no."' ";
    $adb->query($sql);
} else {
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
        $sql_file_sub = ", banner_name = '".$renameFileName."', org_banner_name = '".$orgFileName."' ";
    }

    if ( $_FILES[b_file2][tmp_name]) {
        // 한글 파일명은 타임스탬프로 리네임한 후에 업로드 한다. 디비에는 원래 파일명과 리네임명을 동시에 저장한다.
        $orgFileName2 = $_FILES[b_file2][name];
        $extName2 = array_pop(explode(".", strtolower($orgFileName2)));
        $timeStamp = date("ymdHis",time());
        $renameFileName2 = $timeStamp . "." . $extName2;
        // 사진업로드
        upload_file($_FILES[b_file2][tmp_name], $renameFileName2, $file_path);
        // 임시파일 삭제
        unlink($_FILES[b_file2][tmp_name]);
        // 파일 업데이트 쿼리
        $sql_file_sub2 = ", banner_name2 = '".$renameFileName2."', org_banner_name2 = '".$orgFileName2."' ";
    }

    // useyn/location은 정해진 값만 허용하는 화이트리스트로 검증
    $useyn = ( $useyn == "Y" ) ? "Y" : "N";
    $arr_allowedLocation = array("1", "2", "3", "4", "5", "6", "7");
    $location = ( in_array($location, $arr_allowedLocation) ) ? $location : "1";

    $sql_common = "
        link_url	= '".addslashes($link_url)."',
        link_url2	= '".addslashes($link_url2)."',
        gigan1      = '".addslashes($gigan1)."',
		gigan2      = '".addslashes($gigan2)."',
        title		= '".addslashes($title)."',
        slogan		= '".addslashes($slogan)."',
        target	= '".addslashes($target)."',
        useyn = '$useyn',
		sort = '".(int)$sort."',
        location = '$location',
        site_id = '".addslashes($_SESSION[sel_site_id])."'
    ";
    $no = (int)$no;
    if ( $no == "" || !$no ) {
        // 추가
        $sql = " insert into ".TABLE_BANNER." set ".$sql_common.$sql_file_sub.$sql_file_sub2;
    } else {
        // 수정
        $sql = " update ".TABLE_BANNER." set ".$sql_common.$sql_file_sub.$sql_file_sub2." where no = '".$no."' ";

    }
    $adb->query($sql);
}
include_once("../include/__footer.php");
alert_replace("banner.list.php");