<? include "../_common.php" ?>
<? //include "../acheck.php"; ?>
<? //include_once("../header.admin.php"); ?>

<?
$file_path = POPUP_FILE_PATH;
function Thumnail_new($file, $save_filename, $save_path, $max_width, $max_height)
{
    $img_info = getImageSize($file);
    if($img_info[2] == 1)
    {
        $src_img = ImageCreateFromGif($file);
    }elseif($img_info[2] == 2){
        $src_img = ImageCreateFromJPEG($file);
    }elseif($img_info[2] == 3){
        $src_img = ImageCreateFromPNG($file);
    }else{
        return 0;
    }
    $img_width = $img_info[0];
    $img_height = $img_info[1];

    $dst_width = $max_width;
    $dst_height = $max_height;

    if($img_info[2] == 1)
    {
        $dst_img = imagecreate($max_width, $max_height);
    }else{
        $dst_img = imagecreatetruecolor($max_width, $max_height);
    }

    $bgc = ImageColorAllocate($dst_img, 255, 255, 255);
    ImageFilledRectangle($dst_img, 0, 0, $max_width, $max_height, $bgc);
    ImageCopyResampled($dst_img, $src_img, $srcx, $srcy, 0, 0, $dst_width, $dst_height, ImageSX($src_img),ImageSY($src_img));

    if($img_info[2] == 1)
    {
        ImageInterlace($dst_img);
        ImageGif($dst_img, $save_path.$save_filename);
    }elseif($img_info[2] == 2){
        ImageInterlace($dst_img);
        ImageJPEG($dst_img, $save_path.$save_filename, 85);
    }elseif($img_info[2] == 3){
        ImagePNG($dst_img, $save_path.$save_filename);
    }
    ImageDestroy($dst_img);
    ImageDestroy($src_img);
}

//upload 파일 삭제 및 대체 할 경우 기존 업로드 파일의 popup_name 값 구하기 위해사용
$selsql = " select * from ".TABLE_POPUP." where no = '$no' ";
$sel_result = DBquery($selsql);
$sel_val = mysql_fetch_array($sel_result);


// 한글 파일명은 타임스탬프로 리네임한 후에 업로드 한다. 디비에는 원래 파일명과 리네임명을 동시에 저장한다.
$orgFileName = $_FILES[b_file][name];   //파일 원래 이름
$extName = array_pop(explode(".", strtolower($orgFileName)));   //확장자
$timeStamp = date("ymdHis",time()); //현재 날짜,시간을 통한 upload에 쓰일 유일한 파일명 생성
$renameFileName = $timeStamp . "." . $extName; //upload용 파일명.확장자
$unlink_path= $file_path; //업로드 전체 파일 경로+파일이름

if($Confirm == "delete"){

    $sql = " delete from ".TABLE_POPUP." where no = '$no' ";
    mysql_query($sql);

    //upload파일 삭제
    @unlink($unlink_path."/".$sel_val[popup_name]."_c");
    @unlink($unlink_path."/".$sel_val[popup_name]);

}else{

    // 팝업 내용 추가 ( By.Son 2016.12.01 )
    $contents = htmlspecialchars(addslashes($_POST[fm_content]));
    $map_contents = htmlspecialchars(addslashes($_POST[map_contents]));

    // PC / MOBILE 구분
    if ( $useyn_PC == "" || !$useyn_PC ) $useyn_PC = "N";
    if ( $useyn_MB == "" || !$useyn_MB ) $useyn_MB = "N";

    $useyn = $useyn_PC."|".$useyn_MB;

    //$orgFileName이 있을 경우만 popup_name,org_popup_name 컬럼 변경하도록, 없는경우는 그대로 사용
    if($orgFileName != ''){
        //upload파일 삭제
        @unlink($unlink_path."/".$sel_val[popup_name]);
        @unlink($unlink_path."/".$sel_val[popup_name]."_c");

        $sql_common = "
					contents	= '$contents',
					link_url	= '$link_url',
					link_url_mobile = '$link_url_mobile',
					title		= '$title',
					gigan1      = '$gigan1',
					gigan2      = '$gigan2',
					target		= '$target',
					useyn		= '$useyn',
					pop_left    = '$pop_left',
					pop_top     = '$pop_top',
					popup_name = '$renameFileName',
					org_popup_name = '$orgFileName',
					use_map = '$use_map',
					map_contents = '$map_contents',
					site_id = '$_SESSION[sel_site_id]'
	    ";

    }else{  //확장자를 선택하지 않은 경우
        $sql_common = "
					contents	= '$contents',
					link_url	= '$link_url',
					link_url_mobile = '$link_url_mobile',
					title		= '$title',
					gigan1      = '$gigan1',
					gigan2      = '$gigan2',
					target		= '$target',
					useyn		= '$useyn',
					pop_left    = '$pop_left',
					pop_top     = '$pop_top',
					use_map = '$use_map',
					map_contents = '$map_contents',
					site_id = '$_SESSION[sel_site_id]'
	    ";
    }

    if($no == '') {
        //인서트
        $sql = " insert into ".TABLE_POPUP." set $sql_common ";

    } else {
        //업데이트
        $sql = " update ".TABLE_POPUP." set $sql_common where no = '$no' ";
    }

    mysql_query($sql);

    if($no == '') {
        $no = mysql_insert_id();
    }


    //url값이 없으면 메인으로 기본값 설정
    if($link_url == ""){
        $sql = " update ".TABLE_POPUP." set link_url='#none' where no = '$no' ";
        mysql_query($sql);
    }

    //파일등록
    if ($_FILES[b_file][name]){

        $file_temp = $_FILES['b_file']['tmp_name'];
        $file_size = $_FILES['b_file']['size'];


        //파일크기가 0byte보다 크거나 10240과 같거나 작을경우
        if($file_size >0 && file_size <= 10240 ){

            //이미지 파일만 업로드
            if (@ereg($extName, "png|gif|jpg|jpeg")) {
                //echo ADFRAME_ROOT_PATH.$file_path."/".$orgFileName; exit;
                               // 사진업로드
                upload_file($_FILES[b_file][tmp_name], $renameFileName, $file_path);
                //upload_file($_FILES[b_file][tmp_name], $renameFileName, $file_path)
                unlink($_FILES[b_file][tmp_name]);
            }else{
                alert_msg("이미지 파일만 업로드가 가능합니다.");
            }

        }else{
            alert_msg("파일크기가 0이거나 10mb가 넘습니다.");
        }

        // 아래 펑션 만들어 놓고 안 쓰이는 걸로 보이는데...
        //upload_file($_FILES[b_file][tmp_name], $renameFileName, ADFRAME_ROOT_PATH.$file_path);

//        $orgFilePathName = ADFRAME_ROOT_PATH.$file_path . "/" . $renameFileName;
//        $thumFilePathName = ADFRAME_ROOT_PATH.$file_path . "/" . $no."_thum.".$extName;


        // 아래코드는 썸네일 이미지를 만들다가 안할걸로 보인다. 일단 주석처리
//        $thumimg_width = 206;
//        $thumimg_height = 84;

        // ??????? 코딩하다가 만 코드
        // $tmpimg = @getimagesize($file_path."/".$no);
        //if($tmpimg[0] > $thumimg_width){

//        Thumnail_new($orgFilePathName, $thumFilePathName, ADFRAME_ROOT_PATH.$file_path, $thumimg_width, $thumimg_height);
//        @chmod($file_path, 0700);
        //}
    }
}

?>

<?
echo "<meta http-equiv='refresh' content='0;url=popup.list.php'>";
?>
