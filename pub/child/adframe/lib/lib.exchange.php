<?

/**
 *
 * 환율 API
 *
 * last-date : 2017-03-15
 *
 * 사용법 : 하루에 한번 스케쥴러에 등록 후, 사용하면 됨
 * 환율 기준국가는 네이버 등 환율 정보에 화폐단위명을 입력하면 됨
 * KEB 외환은행 정보 기준으로 데이터 파싱함
 *
 **/

// 가져올 국가 환율 정보 ( 미국 : USD / 일본 : JPY )
$nationCode = "USD";

function get_output_url($url, $find) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    preg_match_all($find, $output, $message);
    curl_close($ch);
    return $message[0];
}

function get_explode_html($contenct){
    $output = explode("<br>", $contenct);
    $message = array();
    for($i=0; $i<count($output); $i++){
        $output[$i] = strip_tags($output[$i]);
        $find = explode(":", $output[$i]);
        array_push($message, $find[0], $find[1]);
    }
    $message = array_filter($message);
    return $message;
}

$html = get_output_url('http://devremon.byus.net/dutyfree/', '/<div\s* id=\'info\'>(.*)<\/div>/');
$content = get_explode_html($html[0]);
// 오늘 환율 
$exchangeVal = $content[3];

//##########################
// DB 설정
//##########################
ini_set("include_path", "/home/adbank/bistla/adframe/lib/Pear");
include_once("/home/adbank/bistla/adframe/common/dsn.ini.php");
require_once('DB.php');
$adb = DB::connect($dsn);
if ( PEAR::isError($adb) ) die($adb->getMessage()."(".__FILE__.":".__LINE__.")");
$adb->setFetchMode(DB_FETCHMODE_ASSOC);
//##########################
// DB 설정
//##########################

$sql = " insert into tbl_exchange set nation = '". $nationCode ."', rateValue = '". $exchangeVal ."', regdate = '". date("Y-m-d H:i:s") ."' ";
$adb->query($sql);

$adb->disconnect();

echo "Complete!!";

?>