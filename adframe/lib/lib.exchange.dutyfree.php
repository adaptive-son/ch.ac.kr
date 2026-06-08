<?
// 면세점 환율
// Create DOM from URL or file
// 20170327.By.Son.면세점환율정보로 바꿈

// ↓ KEB 은행 실시간 정보 Parsing

header("Content-Type: text/html; charset=UTF-8");
// Url 설정
$parsingUrl = "http://fx.keb.co.kr/FER1101M.web";
// Parsing 데이터
$jsonData = file_get_contents($parsingUrl);
// 인코딩 변경
$jsonData = iconv("cp949", "utf-8", $jsonData);
$data = str_replace(" ", "", $jsonData);
$data = str_replace("통화명", "nation", $data);
$data = str_replace("매매기준율", "rate", $data);
// String > Array
$pattern = "/\\{([^{}]+)\\}/";
preg_match_all($pattern, $data, $arrData);
$result = $arrData[1];
foreach ( $result as $idx => $data ) {
    $nationName = "";
    $rateValue = "";
    $expVal = explode(",", str_replace("\"", "", $data));
    foreach ( $expVal as $key => $val ) {
        $expVal2 = explode(":", $val);
        if ( $key == 0 ) $nationName = preg_replace("/[^A-Za-z]/", "", $expVal2[1]);
        else if ( $key == 5 ) $rateValue = $expVal2[1];
        else { /* Do Nothing */}
    }
    $arrExchangeList[$nationName] = $rateValue;
}

?>