<?
ini_set("display_errors", 1);

/*
 *	HEADER() 설정 차이로 인해 기본 라이브러리를 별도로 설정
*/
include($_SERVER['DOCUMENT_ROOT'] . "/adframe/common/inc.constant.php");
// Pear 라이브러리 디렉토리 설정
ini_set("include_path", ADFRAME_ROOT_PATH."/lib/Pear");
require_once(ADFRAME_ROOT_PATH . "/common/dsn.ini.php");
require_once("DB.php");
$adb = DB::connect($dsn);
/*
 *	HEADER() 설정 차이로 인해 기본 라이브러리를 별도로 설정
*/
foreach ( $_GET as $k => $v ) ${$k} = $v;





//이미지 파일만 썸네일로 들고옴
// 처음 등록한 이미지를 썸네일로 가져오기 ( By.Son 2021.01.27 )
$sql_thumb = " SELECT * FROM ".$board_table."_file WHERE file_type > 0 and file_type < 4 and up_file_idx = '".$idx."' order by idx  ";
$rs_thumb = $adb->getRow($sql_thumb, DB_FETCHMODE_ASSOC);

// 임시방편 가로, 세로 길이 설정 2020.12.15- shlee
$sql_wh = " select * from abbs_manager,".$board_table." where abbs_manager.board_key=".$board_table.".code and ".$board_table.".up_file_idx = '".$idx."' ";
$rw_wh = $adb->getRow($sql_wh, DB_FETCHMODE_ASSOC);
$custom_width_flag = false;
if ( $rw_wh['board_skin'] == "main_card" || $rw_wh['board_skin'] == "main_adver" ) {
    $custom_width_flag = true;
    $cwidth = '256';
    $cheight = '350';
} else if ($rw_wh['board_skin'] == "main_gallery" || $rw_wh['board_skin'] == "main_movie") {
	$custom_width_flag = true;
    $cwidth = '329';
    $cheight = '217';
} else if ($rw_wh['board_skin'] == "main_press") {
	$custom_width_flag = true;
    $cwidth = '800';
    $cheight = '532';
} else if ($rw_wh['board_skin'] == "main_news") {
	$custom_width_flag = true;
    $cwidth = '840';
    $cheight = '560';
}


switch ( $rs_thumb['file_type'] ) {
    case '1': $ext = "gif"; break;
    case '2': $ext = "jpg"; break;
    case '3': $ext = "png"; break;
    default: $ext = "jpg"; break;
}


Header("Content-type: image/".$ext);
Header("Pragma: no-cache");
Header("Expires: 0");
// 썸네일 이미지 위치 변경
$thumnail_path = str_replace("upfile_data/", "upfile_data_thumnail/", $rs_thumb['up_filepath']);
$thumnail_path = str_replace("upfile_old/", "upfile_old_thumnail/", $thumnail_path);


// 썸네일 만들기
$param['o_path']='/data/bbs_upload/'.$rs_thumb['up_filepath'];
$param['n_path']=$thumnail_path;
/*$param['width'] = '220';
$param['height'] = '180';*/
$param['width'] = '285';
if ( $custom_width_flag ) $param['width'] = $cwidth;
$param['height'] = '250';
if ( $custom_width_flag ) $param['height'] = $cheight;
$param['mode'] = 'ratio';
$param['fill_yn'] = 'Y';
$param['preview_yn'] ='Y';

getThumb($param);

//$thumnail_path = $rs_thumb[up_filepath];

// 썸네일 이미지 절대 경로
if ( $thumnail_path != "" ) $upload_path = "/data/bbs_upload/".$thumnail_path;
if ( $image = "thumnail" ) {

    if ( !file_exists($_SERVER['DOCUMENT_ROOT'].$upload_path) || $rs_thumb['up_filepath'] == "" || !$rs_thumb['up_filepath'] ) {
        $thumnail_file = $_SERVER['DOCUMENT_ROOT']."/_common/img/common/noimg.jpg";
        $thumnail_size = filesize($thumnail_file);
    } else {
        if ( file_exists($_SERVER['DOCUMENT_ROOT'].$upload_path.".thumb") ) $thumnail_file = $_SERVER['DOCUMENT_ROOT'].$upload_path.".thumb";
        else $thumnail_file = $_SERVER['DOCUMENT_ROOT'].$upload_path;
        $thumnail_size = filesize($thumnail_file);
    }
    $fp = fopen( $thumnail_file, "r" );
    $img_data = fread($fp, $thumnail_size);
    fclose($fp);

    echo $img_data;
    exit;
}



//썸네일 만들기
function getThumb($param){
    if(empty($param['o_path']))		return array('bool' => false, 'msg' => '원본 파일 경로가 없습니다.');
    if(empty($param['n_path']))		return array('bool' => false, 'msg' => '원본 파일 경로가 없습니다.');

    // echo $param['n_path'];

    $pattern = "/";

    $arr = explode($pattern,$param['n_path']);
    $path = '';
    for($i=0;$i< sizeof($arr)-1;$i++){
        $path.=$arr[$i]."/";
    }


    $path = $_SERVER['DOCUMENT_ROOT']."/data/bbs_upload/".$path;
		if(!is_dir($path)){
			mkdir($path, 0707, true);
		}
    if(!in_array($param['mode'], array('ratio', 'fixed')))	$param['mode'] = 'ratio';
    if(empty($param['width']))		$param['width'] = 300;
    if(empty($param['height']))		$param['height'] = 300;
    if(!in_array($param['fill_yn'], array('Y', 'N')))		$param['fill_yn'] = 'N';
    if(!in_array($param['preview_yn'], array('Y', 'N')))	$param['preview_yn'] = 'Y';

    $tmp = array();
    $src = array();
    $dst = array();

    // 썸네일 이미지 갱신 기간 (1주일)
    if(file_exists($param['n_path'])){
        if(mktime() - filemtime($param['n_path']) < 60 * 60 * 24 * 7)	return array('bool' => true, 'src' => $param['n_path']);
    }

    // 미리보기 방지 대체 이미지
    if($param['preview_yn'] == 'N'){
        $param['o_path'] = './hidden.png';	// 미리보기 방지 url
    }
    else{
        // 외부서버 이미지
        if(filter_var($param['o_path'], FILTER_VALIDATE_URL)){
            $tmp['dir'] = './';	// curl 임시 다운로드 경로

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $param['o_path']);
            curl_setopt($ch, CURLOPT_NOBODY, true);
            curl_exec($ch);
            $ch_info = curl_getinfo($ch);
            curl_close($ch);

            if($ch_info['http_code'] != 200)	return array('bool' => false, 'msg' => '원본파일을 가져올수 없습니다.');
            if(array_shift(explode('/', $ch_info['content_type'])) != 'image') return array('bool' => false, 'msg' => '이미지 파일이 아닙니다.');
            $ext = str_replace(array('jpeg'), array('jpg'), array_pop(explode('/', $ch_info['content_type'])));

            $tmp['name'] = 'thumb_tmp_'.date('YmdHisu').'.'.$ext;	// curl 임시 다운로드 파일명
            $tmp['path'] = $tmp['dir'].$tmp['name'];	// curl 임시파일 전체경로

            // curl 임시파일 다운로드
            $fp = fopen($tmp['path'], 'w');
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $param['o_path']);
            curl_setopt($ch, CURLOPT_FILE, $fp);
            curl_exec($ch);
            curl_close($ch);
            fclose($fp);

            $param['o_path'] = $tmp['path'];
        }
    }

    $src['path'] = $_SERVER['DOCUMENT_ROOT'].$param['o_path'];
    $dst['path'] = $_SERVER['DOCUMENT_ROOT']."/data/bbs_upload/".$param['n_path'];
		

    $imginfo = getimagesize($src['path']);

    $src['mime'] = $imginfo['mime'];

    // 원본 이미지 리소스 호출
    switch($src['mime']){
        case 'image/jpeg' :	$src['img'] = imagecreatefromjpeg($src['path']);	break;
        case 'image/gif' :	$src['img'] = imagecreatefromgif($src['path']);		break;
        case 'image/png' :	$src['img'] = imagecreatefrompng($src['path']);		break;
        case 'image/bmp' :	$src['img'] = imagecreatefrombmp($src['path']);		break;
        // mime 타입이 해당되지 않으면 return false
        default :		return array('bool' => false, 'msg' => '이미지 파일이 아닙니다.');						break;
    }

    // 원본 이미지 크기 / 좌표 초기값
    $src['w'] = $imginfo[0];
    $src['h'] = $imginfo[1];
    $src['x'] = 0;
    $src['y'] = 0;

    // 썸네일 이미지 좌표 초기값 설정
    $dst['x'] = 0;
    $dst['y'] = 0;

    // 썸네일 이미지 가로, 세로 비율 계산
    $dst['ratio']['w'] = $src['w'] / $param['width'];
    $dst['ratio']['h'] = $src['h'] / $param['height'];

    switch($param['mode']){
        case 'ratio' :
            // 썸네일 이미지의 비율계산 (가로 == 세로)
            if($dst['ratio']['w'] == $dst['ratio']['h']){
                $dst['w'] = $param['width'];
                $dst['h'] = $param['height'];
            }
            // 썸네일 이미지의 비율계산 (가로 > 세로)
            elseif($dst['ratio']['w'] > $dst['ratio']['h']){
                $dst['w'] = $param['width'];
                $dst['h'] = round(($param['width'] * $src['h']) / $src['w']);
            }
            // 썸네일 이미지의 비율계산 (가로 < 세로)
            elseif($dst['ratio']['w'] < $dst['ratio']['h']){
                $dst['w'] = round(($param['height'] * $src['w']) / $src['h']);
                $dst['h'] = $param['height'];
            }

            if($param['fill_yn'] == 'Y'){
                $dst['canvas']['w'] = $param['width'];
                $dst['canvas']['h'] = $param['height'];
                $dst['x'] = $param['width'] > $dst['w'] ? ($param['width'] - $dst['w']) / 2 : 0;
                $dst['y'] = $param['height'] > $dst['h'] ? ($param['height'] - $dst['h']) / 2 : 0;
            }
            else{
                $dst['canvas']['w'] = $dst['w'];
                $dst['canvas']['h'] = $dst['h'];
            }
            break;
        case 'fixed' :
            // 썸네일 이미지의 비율계산 (가로 == 세로)
            if($dst['ratio']['w'] == $dst['ratio']['h']){
                $dst['w'] = $param['width'];
                $dst['h'] = $param['height'];
            }
            // 썸네일 이미지의 비율계산 (가로 > 세로)
            elseif($dst['ratio']['w'] > $dst['ratio']['h']){
                $dst['w'] = $src['w'] / $dst['ratio']['h'];
                $dst['h'] = $param['height'];

                $src['x'] = ($dst['w'] - $param['width']) / 2;
            }
            // 썸네일 이미지의 비율계산 (가로 < 세로)
            elseif($dst['ratio']['w'] < $dst['ratio']['h']){
                $dst['w'] = $param['width'];
                $dst['h'] = $src['h'] / $dst['ratio']['w'];

                $dst['y'] = 0;
            }
            $dst['canvas']['w'] = $param['width'];
            $dst['canvas']['h'] = $param['height'];
            break;
    }

    // 썸네일 이미지 리소스 생성
    $dst['img'] = imagecreatetruecolor($dst['canvas']['w'], $dst['canvas']['h']);

    // 배경색 처리
    if(in_array($src['mime'], array('image/png', 'image/gif'))){
        // 배경 투명 처리
        //imagetruecolortopalette($dst['img'], false, 255);
        imagealphablending($dst['img'], false);
        imagesavealpha($dst['img'], true);
        $bgcolor = imagecolorallocatealpha($dst['img'], 255, 255, 255, 127);
        imagefilledrectangle($dst['img'], 0, 0, $dst['canvas']['w'],$dst['canvas']['h'], $bgcolor);
    }
    else{
        // 배경 흰색 처리
        $bgclear = imagecolorallocate($dst['img'],255,255,255);
        imagefill($dst['img'],0,0,$bgclear);
    }

    // 원본 이미지 썸네일 이미지 크기에 맞게 복사
    imagecopyresampled($dst['img'] ,$src['img'] ,$dst['x'] ,$dst['y'] ,$src['x'] ,$src['y'] ,$dst['w'] ,$dst['h'] ,$src['w'] ,$src['h']);

    

    ImageInterlace($dst['img']);
//print_R($dst['path']);exit;
    // 썸네일 이미지 리소스를 기반으로 실제 이미지 생성
    switch($src['mime']){
        case 'image/jpeg' :	imagejpeg($dst['img'], $dst['path'],99);	break;
        case 'image/gif' :	imagegif($dst['img'], $dst['path']);	break;
        case 'image/png' :	imagepng($dst['img'], $dst['path'],9);	break;
        case 'image/bmp' :	imagebmp($dst['img'], $dst['path']);	break;
    }

    // 원본 이미지 리소스 종료
    imagedestroy($src['img']);
    // 썸네일 이미지 리소스 종료
    imagedestroy($dst['img']);
    // curl 임시파일 삭제
    if(file_exists($tmp['path'])) unlink($tmp['path']);

    // 썸네일 파일경로 존재 여부 확인후 리턴
    return file_exists($dst['path']) ? array('bool' => true, 'src' => $dst['path']) : array('bool' => false, 'msg' => '파일 생성에 실패하였습니다.');
}
?>