<?php
// GET 파라미터 변수 암호 인코딩
function Encoding64( $param ) {
    return base64_encode($param);
}

// GET 파라미터 변수 암호 디코딩
function Decoding64( $param ) {
    $exp_prm = explode( "&", str_replace("||", "", base64_decode($param)) );
    foreach ( $exp_prm as $key => $value ) {
        $element = explode("=", $value);
        $ret[$element[0]] = $element[1];
    }
    return $ret;
}

if (!function_exists('redirect')) {
    // move page to url
    // @param string $url - web url
    function redirect($url) {
        echo "<meta http-equiv='refresh' content='0; URL=".$url."'>";
        exit;
    }
}

function go_back($msg="") {
    echo "<script>";
    if ( $msg ) echo "alert('".$msg."');";
    echo "history.go(-1); </script>";
    exit;
}

if (!function_exists('alert')) {
    function alert($msg) {
        str_replace('\\', '\\\\', $msg);
        echo "<script> alert('".$msg."'); </script>";
    }
}



function MsgView($go, $Msg="") {
    echo"<script>";
    if ( $Msg ) echo " alert('$Msg'); ";
    echo "history.go($go); </script> ";
    exit;
}

// (관리자페이지) 허용 IP 거르기
function allow_ip_setting ( $ip ) {
    foreach ( explode(".", $ip) as $k => $v ) {
        if ( $k == 3 ) break;
        else {
            if ( $user_IP != "" ) $user_IP .= ".";
            $user_IP .= $v;
        }
    }
    // 허용 IP
    $admission_IP = array(
        "112.217.216"			// adbank IP
    ,"127.0.0"				// localhost
    );
    while (list ($key, $val) = each ($admission_IP)) {
        if ($val==$user_IP){
            $adminssion = "Y";
            break;
        }
    }
    return $adminssion;
}

//로그 입력 : 구분(등록, 수정, 삭제) / 테이블명 / 글번호 / 작성자
function log_history($gubun, $table, $board_id, $writer = ''){
    global $adb;

    $sql = " select max(BOARD_NO), min(PARENT) from ".TABLE_LOG_HISTORY;
    $row = $adb->getRow($sql, array(), DB_FETCHMODE_ASSOC);
    // 구분번호
    $insert_id = $row[BOARD_NO]+1;
    $parent = $row[PARENT]-1;

    if($_SESSION['__MEMBER_ID__'] == '') $logWriter = $writer;
    else $logWriter = $_SESSION['__MEMBER_ID__'];

    if($gubun == '수정' || $gubun == '삭제') $board_id .= '번';
    else if($gubun == '등록') $board_id .= '신규';

    $historyTitle = $logWriter."님이 '".$table."' 테이블에서 ".$board_id." 게시물을 ".$gubun."하였습니다.";
    $historyContents = "작성자 : $logWriter <br/>
							IP : ".$_SERVER['REMOTE_ADDR']."<br/>
							테이블 : ".$table."<br/>							
							행위 : ".$gubun;
    $fields_and_values = array(
        'BOARD_NO'			=> $insert_id,
        'PARENT'            => $parent,
        'CATEGORY'			=> 1,
        'WRITER'			=> 'log',
        'REMOTE_ADDR'		=> $_SERVER['REMOTE_ADDR'],
        'TITLE'				=> $historyTitle,
        'CONTENTS'			=> $historyContents,
        'RTIME'				=> time()
    );

    $error = $adb->autoExecute(TABLE_LOG_HISTORY, $fields_and_values);
}

//로그인로그 입력 : 구분(등록, 수정, 삭제) / 테이블명 / 글번호 / 작성자
function log_admin(){
    global $adb;

    $sql = " select max(BOARD_NO), min(PARENT) from ".TABLE_LOG_ADMIN;
    $row = $adb->getRow($sql, array(), DB_FETCHMODE_ASSOC);

    $insert_id = $row[0]+1;
    $parent = $row[1]-1;

    $logWriter = $_SESSION['__MEMBER_ID__'];

    $historyTitle = "[".date('Y.m.d H:i:s', time())."] ".$logWriter."님이 로그인하였습니다.";
    $historyContents = "계정명 : $logWriter <br/>
								IP : ".$_SERVER['REMOTE_ADDR']."<br/>";
    $fields_and_values = array(
        'BOARD_NO'			=> $insert_id,
        'PARENT'            => $parent,
        'CATEGORY'			=> 1,
        'WRITER'			=> 'log',
        'REMOTE_ADDR'		=> $_SERVER['REMOTE_ADDR'],
        'TITLE'				=> $historyTitle,
        'CONTENTS'			=> $historyContents,
        'RTIME'				=> time()
    );

    $error = $adb->autoExecute('xboard_board_log_admin', $fields_and_values);
}

function desc_columns($tbl_name) {
    global $adb;

    $sql = " SHOW COLUMNS FROM ".$tbl_name;
    $rs = $adb->query($sql);
    for ( $i = 0 ; $row = $rs->fetchRow(DB_FETCHMODE_ASSOC) ; $i++ ) {
        $arr[] = $row[Field];
    }
    return $arr;
}

// 변수 또는 배열의 이름과 값을 얻어냄. print_r() 함수의 변형
// 아래가 출력이 보기 편하다.
function print_r2($var)
{
    ob_start();
    print_r($var);
    $str = ob_get_contents();
    ob_end_clean();
    $str = preg_replace("/ /", "&nbsp;", $str);
    echo nl2br("<span style='font-family:Tahoma, 굴림; font-size:9pt;'>$str</span>");
}

// 디렉토리정보 로드
function get_dir_list($dir)
{
    $result_array = array();

    $dirname = $dir;
    $handle = opendir($dirname);
    while ($file = readdir($handle))
    {
        if($file == "."||$file == "..") continue;

        if (is_dir($dirname.$file)) $result_array[] = $file;

    }
    closedir($handle);
    sort($result_array);

    return $result_array;
}

function get_file_list($path, $arr=array()){
    $dir = opendir($path);
    while($file = readdir($dir)){
        if($file == '.' || $file == '..'){
            continue;
        }else if(is_dir($path.'/'.$file)){
            $arr = get_file_list($path.'/'.$file, $arr);
        }else{
            $arr[] = $path.'/'.$file;
        }

    }
    closedir($dir);
    return $arr;
}


// 게시판 생성 함수. class_bbs.php 를 참조한다.
function create_bbs($board_key, $category_no="0", $SecAdmin="0", $bbs_userqry="", $bbs_subqry="", $bbs_subcolumnqry="",$is_site_type="front"){
    global $bbs;

    $Obj=new Sub_BBSStart();

    $Obj->makebbs($bbs, $board_key, $category_no, $SecAdmin, $bbs_userqry, $bbs_subqry, $bbs_subcolumnqry, $is_site_type);
}


// Get방식으로 넘어온 변수를 Decode하는 함수
function Decode64($sending_data){

    //global $EncoderKey;

    $vars=explode("&",base64_decode(str_replace("||","",$sending_data)));
    //$vars=explode("&",base64_decode(str_replace($EncoderKey,"",$sending_data)));

    $vars_num=count($vars);
    for($i=0;$i<$vars_num;$i++){
        $elements=explode("=",$vars[$i]);
        $var[$elements[0]]=$elements[1];
        //echo " $elements[0] = $elements[1] <br> ";
    }
    return $var;
}

// Get 방식 변수 암호화 함수
function Encode64($data)
{
    //global $EncoderKey;
    //$data = rand_str(5, 0).$data.rand_str(3, 0)

    //return base64_encode($data.$EncoderKey);
    return base64_encode($data)."||";
}

//현재시간과 특정일 사이의 기간
function BetweenPeriod($datetime,$periodDay)
{//2003-02-19 11:32:15
    $now = time();
    $timeArr= explode(":",substr($datetime,11,8));
    $dayArr	= explode("-",substr($datetime,0,10));

    $mktime = mktime($timeArr[0],$timeArr[1],$timeArr[2],$dayArr[1],$dayArr[2],$dayArr[0]);
    $period	= $periodDay*24*60*60;		//기간계산

    if($now >$mktime && $now < ($mktime+$period))
        return 1;
    else if( ($mktime-$period) <$now && $now <$mktime)
        return -1;
    else
        return 0;
}

/*
 * 한글 깨짐 방지를 위해 mb_str..메서드를 사용. php 버전 4이상.
 * param 1 : 문자열 원본
 * param 2 : 자르기 시작 인덱스 (디폴트 0)
 * param 3 : 자르기 종료 인덱스
 * param 4 : 문자열 인코딩 셋. utf-8이 기본이다. 다른 인코딩 사용하지 말것.
 * param 5 : 덧붙일 문자열
 */
function StringCut($string,$start=0,$length,$charset,$addString="...") {

    if($charset==NULL) {
        $charset='UTF-8';
    }
    if ( function_exists("mb_strlen") ) {
        $str_len=mb_strlen($string,$charset);
    } else {
        $str_len=rep_mb_strlen($string);
    }

    if( $str_len > $length ) {
        /* mb_substr  PHP 4.0 이상, iconv_substr PHP 5.0 이상 */
        if ( function_exists("mb_substr") ) {
            $string=mb_substr($string,$start,$length,$charset);
        } else {
            //$string=cut_str($string,$length);
            $string = rep_mb_substr($string, $length);
        }
        $string.=$addString;

    }
    return $string;
}

// In case, not exists function "mb_strlen"
function rep_mb_strlen($str) {
    $counts = count_chars($str);
    for ( $i = 0x80; $i < 0xc0 ; $i++ ) {
        unset($counts[$i]);
    }
    return array_sum($counts);
}

// In case, not exists function "mb_substr"
function rep_mb_substr($str, $length) {
    if (!$str) return '';
    preg_match('/^([\xa1-\xfe]{2}|.){'.$length.'}/s', $str, $tmp_str);
    return (!$tmp_str[0]) ? $str : ($tmp_str[0]);
}

//Post, Get방식으로 넘어온 값 쿼리로 변환
function setQuery ($arr, $str) {
    $r_str = '';

    // $arr : $_POST 혹은 $_GET, 배열 반복
    foreach ($arr as $key=>$val) {

        // input name 이 지정한 문자열로 시작되면 적용 하고 그 문자열은 삭제
        //if (@ereg ("^$str", $key)) { // php 5.3이후 디프레케이트 6.0부터삭제
        if(preg_match("/^$str/", $key)) {

            //$key = @ereg_replace ("^$str", "", $key);  // php 5.3이후 디프레케이트 6.0부터삭제
            $key = preg_replace ("/^$str/", "", $key);

            // 문자열을 제거한 키값이 아직 존재하면 리턴해줄 문자열에 연결합니다.
            // 처음은 xxx = 'xxx' 로 두번째 부터는 ,xxx = 'xxx'로 이어줍니다.
            if (!empty($key)) {
                if (!empty($r_str)) {
                    $r_str .= ', ';
                }

                $r_str .= "${key} = '${val}'";
            }
        }
    }

    return $r_str;
}


//게시판 최근게시물 값 배열에 담기
function BBS_GetList($board_table , $board_code, $board_type=0, $limit_num=5, $cut_content=0, $debugmod=0, $category){
//BBS_GetList("게시판 테이블명(fullname)", "게시판코드", 보드타입, 배열에 담을 최근게시물 수, 내용글 수:html형식이라 300이상으로 잡아야...);
    /*
     *
     *  $limit_num 이 '0'일 경우, 해당 게시판의 모든 게시물을 가져옴 ( 스킨 적용을 별도로 하지 않는 게시판을 위해 데이터만 가져오는 이 함수를 사용 )
     *
     *
        $board_type=0 : 일반
        $board_type=1 : 갤러리
        $board_type=2 : UCC

        [사용방법]
        $newlist1 = BBS_GetList("bbs_com1", "3010", 0, 5, 300);

        for($i=0; $i < count($newlist1); $i++){

            //echo $newlist1[$i][title]."<br>"; //제목

            //echo $newlist1[$i][content]."<br>"; //내용

            //echo $newlist1[$i][linkdata]."<br>"; //링크데이타  <a href='파일명?bbs=see&data=$newlist1[$i][linkdata]'>
            //echo $newlist1[$i][file_src]."<br>"; //파일경로 <img src='$newlist1[$i][file_src]'> width height는 지정

            //echo $newlist1[$i][datetime]."<br>"; //등록일자
            //echo $newlist1[$i][newimg]."<br>"; //새글 아이콘

        }

    */

    if($board_type == 1){
        //$bbs_subcolumnqry = ", (select idx from ".$board_table."_file where file_type > 0 and file_type < 4 and up_file_idx = A.up_file_idx limit 0,1) as file_idx";
        $bbs_subcolumnqry = ", (select idx from ".$board_table."_file where file_type > 0 and file_type < 4 and up_file_idx = A.up_file_idx limit 0,1) as file_idx";
		$bbs_subcolumnqry .= ", (select up_filepath from ".$board_table."_file where file_type > 0 and file_type < 4 and up_file_idx = A.up_file_idx limit 0,1) as file_path";
    }else if($board_type == 2){
        //$bbs_subcolumnqry = ", (select up_filename from ".$board_table."_file where file_type = 10 and up_file_idx = A.up_file_idx limit 0,1) as up_filename";
        $bbs_subcolumnqry = ", (select up_filename from ".$board_table."_file where up_file_idx = A.up_file_idx limit 0,1) as up_filename";
		$bbs_subcolumnqry .= ", (select up_filepath from ".$board_table."_file where file_type > 0 and file_type < 4 and up_file_idx = A.up_file_idx limit 0,1) as file_path";
	} else {
        $bbs_subcolumnqry = "";
	}
	

    $bbs_qry = "SELECT * ";
    $bbs_qry .= $bbs_subcolumnqry;
    $bbs_qry .= " FROM ".$board_table." as A WHERE idx > 0 AND del_yn='N'";

	//카테고리가 존재할 경우 해당 카테고리에 해당하는 글만 들고옴 -shlee
	if($category!="") {
		$bbs_qry .="AND category = '$category'";
	} 

    // TODO :: 기존 게시판 통합 설정 - $board_code가 배열형태일때와 아닐때로 구분 ( 2016-07-11 By.Son )
    if ( strtolower(gettype($board_code)) == "array" ) {
        $board_code_val = "";
        foreach ( $board_code as $k => $v ) {
            if ( $board_code_val != "" ) $board_code_val .= ", ";
            $board_code_val .= "'".$v."'";
        }
        $bbs_qry .= " and code in (".$board_code_val.") ";
    } else {
        $bbs_qry .= " and code = '$board_code' ";
    }
    $bbs_qry .= " ORDER BY  writeday DESC, ref DESC, re_step ASC ";
    if ( $limit_num > "0" ) $bbs_qry .= " limit $limit_num ";
    if($debugmod == 1)	echo $bbs_qry;

    $result = DBquery($bbs_qry);
	if($_SERVER['REMOTE_ADDR']=="112.217.216.250"){
		//echo $bbs_qry;
	}

    for($i=0; $row=@mysql_fetch_array($result); $i++){

        $bbslimit[$i][idx] = $row[idx];

		$bbslimit[$i]['notice'] = $row['notice'];

        //게시판 제목
        $bbslimit[$i][title] = $row[title];

		//게시판 카테고리
		$bbslimit[$i][category] = $row[category];

        //게시판 등록일자
        $bbslimit[$i][datetime] = substr($row[writeday],0,10);
		
		/* 대표 홈페이지 메인화면 언론보도 링크부분- 20.12.15 shlee */
		$bbslimit[$i][etc_char1] = $row[etc_char1];

		/* 대표 홈페이지 메인화면 공지사항 부서명- 20.12.23 shlee */
		$bbslimit[$i][etc_char3] = $row[etc_char3];

        //게시판 새글
        if(BetweenPeriod($row[writeday],"1") > 0) $bbslimit[$i][newimg] = "<img src='/page/img/board/icon_new.png' border='0' align='absmiddle'>";
        else $bbslimit[$i][newimg] = "";

        //링크 데이타
        $encode_str = "pagecnt=0&idx=".$row[idx]."&letter_no=&offset=";
        $encode_str.= "&search=".$search."&searchstring=".$searchstring;
        $encode_str.= "&Boardkey=".$row[code]."&Sub_No=".$row[sub_no]."&DBTable=".$board_table;
        $list_data=Encode64($encode_str);

        $bbslimit[$i][linkdata] = $list_data;
		$bbslimit[$i][file_path] = $row[file_path];


        //타입별 이미지경로
        if($board_type == 1){
			
            /*
            $bbslimit[$i][file_idx] = $row[file_idx];

            $fileencode_str = "Boardkey=".$board_code."&DBTable=".$board_table."&idx=".$row[up_file_idx]."&download=ok";
            $file_data=Encode64($fileencode_str);
            $bbslimit[$i][file_src] = "//cis.iuk.ac.kr/bbs/image_preview.php?image=thumnail&data=".$file_data;
            */
            //$bbslimit[$i][file_src] = "/bbs/image_preview.php?data=".$file_data;
            $data = "image=thumnail&board_table=".$board_table."&idx=".$row[up_file_idx];
            $bbslimit[$i][file_src] = "/adframe/bbs/imageview.php?".$data;
            $bbslimit[$i][up_file_idx] = $row[up_file_idx];
			
        }else if($board_type == 2){
			
            if($row[up_filename]=="" ||  preg_match("/\.(gif|jpg|jpeg|png)$/i", strtolower($row[up_filename]))==0){
                if(preg_match("/<img[^>]*src=[\"']?([^>\"']+)[\"']?[^>]*>/i", $row['content'], $match)){
					$content = str_replace('\"','"',$row['content']);
					preg_match("/<img[^>]*src=[\"']?([^>\"']+)[\"']?[^>]*>/i", $content, $match);
                    $bbslimit[$i][file_src]= $match[1];
                }
            }else{
                //$bbslimit[$i][file_src] = "/adframe/bbs/".$row[up_filename];
                $data = "image=thumnail&board_table=".$board_table."&idx=".$row[up_file_idx];
                $bbslimit[$i][file_src] = "/adframe/bbs/image_preview.php?".$data;
                $bbslimit[$i][up_file_idx] = $row[up_file_idx];
            }

            $bbslimit[$i][up_filename] = $row[up_filename];
        }else{
            //$bbslimit[$i][file_src] = "/bbs/image_preview.php?image=noimg";
            //$bbslimit[$i][file_src] = "/bbs/skin/iuk_gallery/images/noimg.gif";
            $bbslimit[$i][file_src] = "/page/img/board/img_noimage.jpg";
        }


        //내용 출력시
        if($cut_content > 0){
            $bbs_content = str_replace("&nbsp;", "", $row[content]);
            $bbs_content = StringCut(trim(strip_tags($bbs_content)), 0 ,$cut_content);
            $bbslimit[$i][content] = $bbs_content;

        }

        $bbslimit[$i][view_secret]=$row[view_secret];

		// "부산항 면세점"만 해당 : 카테고리 불러오기
		if ( $board_code == "1110" ) {
			$bbslimit[$i][category] = $row[category];
		}
		// 베스트 셀러 기타 항목 추가
        if ( $board_code == "1011" ) {
            $bbslimit[$i][etc1] = $row[etc1];
            $bbslimit[$i][etc2] = $row[etc2];
            $bbslimit[$i][etc3] = $row[etc3];
            $bbslimit[$i][etc4] = $row[etc4];
            $bbslimit[$i][etc5] = $row[etc5];
        }
    }

    return $bbslimit;
}


/*
 * github gist 에서 가져온 소스 : https://gist.github.com/fredacx/4278809
 * XSS filter
 *
 * This was built from numerous sources
 * (thanks all, sorry I didn't track to credit you)
 *
 * It was tested against *most* exploits here: http://ha.ckers.org/xss.html
 * WARNING: Some weren't tested!!!
 * Those include the Actionscript and SSI samples, or any newer than Jan 2011
 *
 *
 * TO-DO: compare to SymphonyCMS filter:
 * https://github.com/symphonycms/xssfilter/blob/master/extension.driver.php
 * (Symphony's is probably faster than my hack)
 */

function xss_clean($data)
{
    // Fix &entity\n;
    $data = str_replace(array('&amp;','&lt;','&gt;'), array('&amp;amp;','&amp;lt;','&amp;gt;'), $data);
    $data = preg_replace('/(&#*\w+)[\x00-\x20]+;/u', '$1;', $data);
    $data = preg_replace('/(&#x*[0-9A-F]+);*/iu', '$1;', $data);
    $data = html_entity_decode($data, ENT_COMPAT, 'UTF-8');

    // Remove any attribute starting with "on" or xmlns
    $data = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '$1>', $data);

    // Remove javascript: and vbscript: protocols
    $data = preg_replace('#([a-z]*)[\x00-\x20]*=[\x00-\x20]*([`\'"]*)[\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2nojavascript...', $data);
    $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2novbscript...', $data);
    $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*-moz-binding[\x00-\x20]*:#u', '$1=$2nomozbinding...', $data);

    // Only works in IE: <span style="width: expression(alert('Ping!'));"></span>
    $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?expression[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
    $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?behaviour[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
    $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:*[^>]*+>#iu', '$1>', $data);

    // Remove namespaced elements (we do not need them)
    $data = preg_replace('#</*\w+:\w[^>]*+>#i', '', $data);

    do
    {
        // Remove really unwanted tags
        $old_data = $data;
        $data = preg_replace('#</*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*+>#i', '', $data);
    }
    while ($old_data !== $data);

    // we are done...
    return $data;
}

// 한글, 영문 구분 함수
function is_Hangul ( $str ) {
	if ( preg_match("/[\xA1-\xFE][\xA1-\xFE]/", $str) ) $val = true;
	else $val = false;
	return $val;
}

// 초성에 따른 검색 쿼리 
function brand_order_sub_query( $keyword ) {
    if($keyword == 'ㄱ'){ 
        $strWhere = "and s_name >= '가' AND s_name < '나' "; 
    }else if($keyword == 'ㄴ'){ 
        $strWhere = "and s_name >= '나' AND s_name < '다' "; 
    }else if($keyword == 'ㄷ'){ 
        $strWhere = "and s_name >= '다' AND s_name < '라' "; 
    }else if($keyword == 'ㄹ'){ 
        $strWhere = "and s_name >= '라' AND s_name < '마' "; 
    }else if($keyword == 'ㅁ'){ 
        $strWhere = "and s_name >= '마' AND s_name < '바' "; 
    }else if($keyword == 'ㅂ'){ 
        $strWhere = "and s_name >= '바' AND s_name < '사' "; 
    }else if($keyword == 'ㅅ'){ 
        $strWhere = "and s_name >= '사' AND s_name < '아' "; 
    }else if($keyword == 'ㅇ'){ 
        $strWhere = "and s_name >= '아' AND s_name < '자' "; 
    }else if($keyword == 'ㅈ'){ 
        $strWhere = "and s_name >= '자' AND s_name < '차' "; 
    }else if($keyword == 'ㅊ'){ 
        $strWhere = "and s_name >= '차' AND s_name < '카' "; 
    }else if($keyword == 'ㅋ'){ 
        $strWhere = "and s_name >= '카' AND s_name < '타' "; 
    }else if($keyword == 'ㅌ'){ 
        $strWhere = "and s_name >= '타' AND s_name < '파' "; 
    }else if($keyword == 'ㅍ'){ 
        $strWhere = "and s_name >= '파' AND s_name < '하' "; 
    }else if($keyword == 'ㅎ'){ 
        $strWhere = "and s_name >= '하' "; 
    }else{
        $strWhere = "";
    }
    return $strWhere;
}

// 한글 첫글자의 초성 가져오기
function get_firstLetter( $str ) {
	$arr_cho = array("ㄱ", "ㄲ", "ㄴ", "ㄷ", "ㄸ", "ㄹ", "ㅁ","ㅂ", "ㅃ", "ㅅ", "ㅆ", "ㅇ", "ㅈ", "ㅉ","ㅊ", "ㅋ", "ㅌ", "ㅍ", "ㅎ");
	$unicode = array();
	$values = array();
	$lookingFor = 1;
	for ($i=0, $loop=strlen($str);$i<$loop;$i++) {
		$thisValue = ord($str[$i]);
		if ($thisValue < 128) {
			$unicode[] = $thisValue;
		} else {
			if (count($values) == 0) $lookingFor = $thisValue < 224 ? 2 : 3;
			$values[] = $thisValue;
			if (count($values) == $lookingFor) {
				$number = $lookingFor == 3 ? (($values[0]%16)*4096)+(($values[1]%64)*64)+($values[2]%64) : (($values[0]%32)*64)+($values[1]%64);
				$unicode[] = $number;
				$values = array();
				$lookingFor = 1;
			}
		}
	}
	$splitStr = '';
	while (list($key,$code) = each($unicode)) {
		if ($code >= 44032 && $code <= 55203) {
			$temp = $code-44032;
			$cho = (int)($temp/21/28);
			$splitStr.= $arr_cho[$cho];
		} else {
			$temp = array($unicode[$key]);
			foreach ($temp as $ununicode) {
				if ($ununicode < 128) {
					$splitStr.= chr($ununicode);
				} 
			}
		}
	}
	$splitStr = str_replace(' ','',$splitStr);
	return $splitStr;
}

function get_site_id(){
    $dir = getcwd(); // 현재 디렉토리명을 반환하는 PHP 함수이다.
    if($_SERVER['REMOTE_ADDR']=="127.0.0.1"){
        $temp = explode("\\", $dir);
    }else{
        $temp = explode("/", $dir);
    }

    $dirname = $temp[sizeof($temp)-2];
    return $dirname;
}

function get_site_info($col,$site_id){
    if($site_id=="")  $site_id = get_site_id();

    $sql = "SELECT * FROM ".TABLE_SITE_MNG." WHERE site_id ='".$site_id."'";
    $row = mysql_fetch_array(mysql_query($sql));
    return $row[$col];
}

function filesize_formatted($bytes)
{
    if ($bytes >= 1073741824) {
        return number_format($bytes / 1073741824, 2) . ' GB';
    } elseif ($bytes >= 1048576) {
        return number_format($bytes / 1048576, 0) . ' MB';
    } elseif ($bytes >= 1024) {
        return number_format($bytes / 1024, 2) . ' KB';
    } elseif ($bytes > 1) {
        return $bytes . ' bytes';
    } elseif ($bytes == 1) {
        return '1 byte';
    } else {
        return '0 bytes';
    }
}

function copy_directory($src, $dst)
{
    $dir = opendir($src);
    @mkdir($dst);
    while(( $file = readdir($dir)) ) {
        if (( $file != '.' ) && ( $file != '..' )) {
            if ( is_dir($src . '/' . $file) ) {
                copy_directory($src .'/'. $file, $dst .'/'. $file);
            }
            else {
                copy($src .'/'. $file,$dst .'/'. $file);
            }
        }
    }
    closedir($dir);
}

?>
