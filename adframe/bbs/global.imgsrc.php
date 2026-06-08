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


$noImgPath = $_SERVER['DOCUMENT_ROOT']."/_common/img/common/";
$noImgName = "img_default.jpg";

switch($_REQUEST['mode']){
    case "editor":
        $ViewFile	= $_SERVER['DOCUMENT_ROOT']."/data/editor/".$_REQUEST['date']."/".$_REQUEST['f_key'];
        $imgInfo	= getimagesize($ViewFile);
        $ViewType	= $imgInfo['mime'];
        break;
    case "noimg":
        view_thumb_crop($noImgPath,$noImgName,$_REQUEST["w"],$_REQUEST["h"]);
        break;
    default:
        $ViewFile = "/data/".$_REQUEST["mode"]."/".$_REQUEST["key"];
        $imgInfo = getimagesize($ViewFile);
        $ViewType = $imgInfo['mime'];

        break;
}
// 이제 실질적으로 서버 경로에 파일 존재여부 체크하고 파일을 불러 온다.
if (is_file($ViewFile)){
    $fp = fopen($ViewFile, "r");
    $imgView = fread($fp, filesize($ViewFile));
    fclose($fp);

    if ( $ViewType ){
        header("Content-type: ".$ViewType);
        print $imgView;
    }
}
exit;

?>