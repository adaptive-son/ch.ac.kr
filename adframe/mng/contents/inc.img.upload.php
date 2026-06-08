<?
error_reporting(E_ALL);
// 업로드 이미지 처리
if ( $_FILES[IMG_FILE] ) {
    $file1 = $_FILES[IMG_FILE][tmp_name];
    $file1_name = $_FILES[IMG_FILE][name];
    $file1_size = $_FILES[IMG_FILE][size];
    $file1_type = $_FILES[IMG_FILE][type];
}

$dir = "image_class";

if($file1_size>0&&$file1) {
    if(!is_uploaded_file($file1)) go_back("첨부된 파일에서 오류를 발견했습니다.");
    $file1_size=filesize($file1);

    if($file1_size>0) {

        $s_file_name1=$file1_name;
        if ( @preg_match("/inc|phtm|htm|shtm|php|dot|asp|ztx|cgi|pl/i", $s_file_name1) ) go_back("허용되지 않는 파일형식입니다.");

        //크기 검사
        if($file1_size>2000000) go_back("파일은 2MB 이하로 올리셔야 합니다.");
        $file1 = @preg_replace("/\\\\/","\\",$file1);

        $_file_name = str_replace(" ","_",$file1_name);

        if($_FILES[IMG_FILE]) {

            $_up_file1 = "cms_".time()."_".$_file_name;

            $pg_sql = " SELECT * FROM ".TABLE_CMS_CONTENTS." WHERE TREE_ID = '".$TREE_ID."' AND TREE_NO = '".$TREE_NO."' ";
            $pg_row = $adb->getRow($pg_sql);
            if( $pg_row[IMG_SFILE] != "" ) {
                @unlink($_SERVER[DOCUMENT_ROOT]."/adframe/CMSEditor/".$dir."/".$pg_row[IMG_SFILE]); //파일삭제
            }

            if(!move_uploaded_file($file1, $_SERVER[DOCUMENT_ROOT]."/adframe/CMSEditor/".$dir."/".$_up_file1)) {
                go_back("업로드 작업 중 서버에 의해 취소되었습니다.");
            }
            $file_name2 = $_up_file1;
            @chmod($file_name2,0707);       // 파일 권한 변경

        }

        $sql_file =  ", IMG_RFILE = '".$_file_name."', IMG_SFILE = '$file_name2' ";
    }
}
?>