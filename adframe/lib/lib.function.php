<?
	//#####################   스크립트 함수   #########################
	function alert_none($msg) {
		echo "<script> alert('".$msg."'); </script>";
	}

	function alert_replace($url, $msg="") {
		echo " <script> ";
		if ( $msg != "" ) echo " alert('".$msg."'); ";
		echo " location.replace('".$url."'); ";
		echo " </script> ";
		exit;
	}

	function alert_href($url, $msg="") {
		echo " <script> ";
		if ( $msg != "" ) echo " alert('".$msg."'); ";
		echo " location.href = '".$url."'; ";
		echo " </script> ";
		exit;
	}

	function alert_close($msg) {
		echo " <script> ";
		if ( $msg != "" ) echo " alert('".$msg."'); ";
		echo " self.close(); ";
		echo " </script> ";
		exit;
	}

	function alert_back($msg) {
		echo " <script> ";
		if ( $msg != "" ) echo " alert('".$msg."'); ";
		echo " history.back('-1') ";
		echo " </script> ";
		exit;
	}
?>


<?php

// 세션변수 생성
$poll_s_table			= "poll_s";
$poll_etc_table		= "poll_etc";
$poll_m_table			= "poll_m";
$banner_table			= "banner";
$popup_table			= "popup";
//$tel_table				= "TEL";
$tel_table				= "tel";
$haksa_table			= "haksa";
$food_table				= "food";
$food2_table			= "food2";
$cyber_table			= "cyber";
$info1_table			= "information_1";
$info2_table			= "information_2";
$info3_table			= "information_3";
$info4_table			= "information_4";
$info5_table			= "information_5";
$info6_table			= "information_6";
$proposal_table			= "proposal";
$proposal_reply_table	= "proposal_reply";
$link_table				= "link_table";

/*
 * 사이트관리, 코드관리 추가
 */

$site_mng_table        = "site_mng";
$code_table             =	"code";
$code_detail_table      =	"code_detail";
$menu_damdang_table      =	"front_menu_manager";

$g_list_rows = "20";

$curdate = date("Y-m-d", time());
$curtime = date("H:i:s", time());
$now     = $curdate . " " . $curtime;
$prefix = time();

$g_word_dir    = $DOCUMENT_ROOT."_Avar/word/";
$g_banner_dir    = $DOCUMENT_ROOT."_Avar/banner/";
$g_banner    = "/_Avar/banner/";

$g_img_dir    = $DOCUMENT_ROOT."_Avar/img/";
$g_image_ext = "gif;jpg;jpeg;png";
$g_word_ext = "hwp;doc;pdf;txt;xls;xlsx;cvs;ppt";

function set_session($session_name, $value)
{
    // PHP 버전별 차이를 없애기 위한 방법
    $$session_name = $_SESSION["$session_name"] = $value;
}

// mysql_query function
function DBquery($qry)
{
    return mysql_query($qry);
}

// mysql_fetch_array function
function DBarray($qry)
{
    $result = @mysql_query($qry) or die("Qry Err : $qry");
    return mysql_fetch_array($result);
}

// mysql_query 와 mysql_error 를 한꺼번에 처리
function sql_query($sql, $error=TRUE)
{
    if ($error)
        $result = @mysql_query($sql) or die("<p>$sql<p>" . mysql_errno() . " : " .  mysql_error() . "<p>error file : $_SERVER[PHP_SELF]");
    else
        $result = @mysql_query($sql);
    return $result;
}
// 결과값에서 한행 연관배열(이름으로)로 얻는다.
function sql_fetch_array($qry)
{
    $row = @mysql_fetch_assoc($qry);
    return $row;
}
function sql_fetch($sql, $error=TRUE)
{
    $result = sql_query($sql, $error);
    //$row = @sql_fetch_array($result) or die("<p>$sql<p>" . mysql_errno() . " : " .  mysql_error() . "<p>error file : $_SERVER['PHP_SELF']");
    $row = sql_fetch_array($result);
    return $row;
}

// DB 연결
function sql_connect($host, $user, $pass, $charset)
{
    if (strtolower($charset) == 'utf-8') @mysql_query(" set names utf8 ");
    else if (strtolower($charset) == 'euc-kr') @mysql_query(" set names euckr ");
    return @mysql_connect($host, $user, $pass);
}


// DB 선택
function sql_select_db($db, $connect, $charset)
{
    if (strtolower($charset) == 'utf-8') @mysql_query(" set names utf8 ");
    else if (strtolower($charset) == 'euc-kr') @mysql_query(" set names euckr ");
    return @mysql_select_db($db, $connect);
}

// mysql_affected_rows function
function DBaffected($qry)
{
    $result = @mysql_query($qry) or die("Qry Err. : $qry");
    return mysql_affected_rows();
}

// @param string $path - file or directory path
function get_file_perm($path) {
    return substr(sprintf("%o", fileperms($path)),-3);
}

// @param string $str - string formated page
function del_tag($str) {
    $str = str_replace(">", "&gt;", $str);
    $str = str_replace("<", "&lt;", $str);
    return $str;
}

// @param char $value - null return false;
function return_bit($value) {
    $bit = ($value) ? 1 : 0;
    return $bit;
}

// @param integer $num
// @param integer $size
function mk_num($num, $size) {
    if(strlen($num) < $size) {
        $plus = $size - strlen($num);
        for($i=0; $i<$plus; $i++) {
            $num = '0'.$num;
        }
    }
    return $num;
}

// @param array $ar
// @param char $ch
function array_to_str($ar, $ch) {
    for($i=0; $i<count($ar); $i++) {
        $str .= ($i==count($ar)-1) ? $ar[$i] : $ar[$i].$ch;
    }
    return $str;
}

// return file extension
// @param string $file_name
function get_ext($file_name) {
    $tmp = explode(".", $file_name);
    $ext = $tmp[count($tmp)-1];
    return $ext;
}

// return whether it is true or not
// @param string $email - email address
function is_email($email) {
    $url = trim($email);
    if(eregi("^[\xA1-\xFEa-z0-9._-]+@[\xA1-\xFEa-z0-9_-]+\.[a-z0-9._-]+$", $url)) return true;
    else return false;
}


// @param int $size - file size from byte
function convert_size($size) {
    if(!$size) return "0 Byte";
    if($size<1024) {
        return ($size." Byte");
    } elseif($size >1024 && $size< 1024 * 1024)  {
        return sprintf("%0.1f KB",$size / 1024);
    } else {
        return sprintf("%0.2f MB",$size / (1024 * 1024));
    }
}

// @param string $str
function auto_link($str) {
    $homepage_pattern = "/([^\"\'\=\>])(mms|http|HTTP|ftp|FTP|telnet|TELNET)\:\/\/(.[^ \n\<\"\']+)/";
    $str = preg_replace($homepage_pattern,"\\1<a href=\\2://\\3 target=_blank>\\2://\\3</a>", " ".$str);
    return $str;
}


// 제목 길이 자르는 함수, UTF-8 로 변경 otep
function cut_str($str, $len, $suffix="")
{
    if($suffix==""){
        $suffix="...";
    }
    if ( function_exists("mb_substr") ) {
        $s = mb_substr($str, 0, $len, 'UTF-8');
    } else {
        $s = substr($str, 0, $len);
    }

    if (strlen($s) >= $len)
        $s= $s.$suffix;
    return $s ;
}

//====================== 페이지 나누기 ======================//
function pageLink($args) {
    //if($args['total_row'] == 0) $args['total_row'] = 1;
    $tp = @floor(($args['total_row']-1)/$args['row_num'] +1 ); //(TotalPage)전체 페이지 수
    if($tp == 0) $tp = 1;
    $sp = (floor(($args['p']-1)/$args['page'])) * $args['page'] + 1; //페이지 숫자 표시 --> 시작
    $ep = $sp + $args['page']; //페이지 숫자 표시 --> 끝
    //echo $tp;

    if($tp < $ep) { //나타낼 리스트 페이지 수가 기본 페이지 표시 수보다 작을 경우
        $ep = $tp + 1;
        $disable_next = 1;
    }
    //$prev ;
    //$prev = $sp - 1;
    $prev = $sp - ($args['page']);	// 이전 페이지 리스트 제일 첫페이지로 가도록 수정(2005.05.18 김창근)
    $next = $sp + $args['page'];
    if($sp != 1) {
        $_prev = $args['url'] . '?' .$args['param']."&p=".$prev;
    }

    if($args['p'] != '1') {
        $go_back = $args['url'] . '?' .$args['param']."&p=".($args['p'] - 1);
    }



    for($i=$sp; $i<$ep; $i++)
    {
        if($i==$args['p']) {
            $page_link[] = array(
                'p'	=> $i,
                'get'	=> ''
            );
        } else {
            $page_link[] = array(
                'p'	=> $i,
                'get'	=> $args['url'] . '?' .$args['param']."&p=".$i
            );
        }
    }

    if(!$disable_next) {
        $_next .= $args['url'] . '?' .$args['param']."&p=".$next;
    }

    if($args['p'] != $tp) {
        $go_next = $args['url'] . '?' .$args['param']."&p=".($args['p'] + 1);
    }
    $page = array (
        'back'		=> $go_back,
        'prev'		=> $_prev,
        'link'	=> $page_link,
        'next'		=> $_next,
        'go'		=> $go_next
    );


    return $page;
}

function script($script) {	// 자바스크립트 실행, 배열이 들어오면 일일이 실행
    echo "<script>\n";
    if(is_array($script)) {
        for($i=0; $i<count($script); $i++) {
            echo $script[$i]."\n";
        }
    } else {
        echo $script."\n";
    }
    echo '</script>'."\n";;
}

// 메일전송함수
function mailsend($fromname,$frommail,$tomail,$subject,$msg){
    $headers = "Return-Path: <".$frommail.">\n";
    $headers .= "Content-Type: text/page;\n";
    $headers .= "From: ".$fromname." <".$frommail.">\n";
    $headers .= "X-Sender: <".$frommail.">\n";
    $headers .= "X-Mailer: PHP\n"; // mailer
    $headers .= "X-Priority: 1\n"; // Urgent message!

    // 에러 발생시 반송 주소
    $headers .= "Reply-To: ".$fromname." <".$frommail.">\n";
    $headers .= "MIME-Version: 1.0\n";

    $result = @mail($tomail,$subject,$msg, $headers);
    return $result;
}

// 계층형 차트 만들기 함수 .. 재귀함수
/*
function mk_tree($chart_no='') {
	global $adb, $tree_table;
	if($chart_no == '') {
		$sql = "Select * From $tree_table where DEPTH=1 order by order_no asc";
	} else {
		$sql = "Select * From $tree_table Where TREE_NO!=$chart_no AND PARENT=$chart_no order by ORDER_NO asc";	}

	$res = $adb->query($sql);
	//print_r($res);
	for($i=0; $row = $res->fetchRow(DB_FETCHMODE_ASSOC); $i++) {
		$chart[] = array(
			'no'		=> $row['TREE_NO'],
			'parent'	=> $row['PARENT'],
			'depth'		=> $row['DEPTH'],
			'name'		=> $row['NAME']
		);

		//if($row['tree_type'] == 1) {
			$return_array = mk_chart($row['TREE_NO']);
			if(is_array($return_array)) $chart = array_merge($chart, $return_array);
		//}
	}
	//print_r($chart);
	return $chart;
}
*/

class ImgClass {
    var $sumWidth = 300;
    var $sumHeight = 300;
    function ImgClass($w=0, $h=0) {
        if($w>0) $this->sumWidth = $w;
        if($h>0) $this->sumHeight = $h;
    }

    function setSize($w, $h) {
        $this->sumWidth = $w;
        $this->sumHeight = $h;
    }

    function imageResize(&$w, &$h) {
        //echo $this->sumHeight;
        if($this->sumWidth<$w || $this->sumHeight<$h) {

            $basicRatio = @round($this->sumWidth/$this->sumHeight,3);
            $imgRatio = @round($w/$h,5);
            if($basicRatio > $imgRatio) {	// 이미지 기준 비율보다 실제 사진 비율이 작으면 세로가 크다.
                $sq = @round($this->sumHeight/$h,5);
                $returnH = $this->sumHeight;
                $returnW = round($w * $sq);
            } else {
                $sq = @round($this->sumWidth/$w,5);
                $returnH = round($h * $sq);
                $returnW = $this->sumWidth;
            }
            //echo $returnW.":".$returnH."<BR>";
            $w = $returnW;
            $h = $returnH;

        }
    }
}

//	입학상담 메일 보낼 교수 아이디
//	081211.입학홍보처 이동석주임 요청으로 간호과를 제외한 모든학과장에게만 메일발송
$PS_MAIL_ARR = array(
//	'1'		=> '1042',
    '1'		=> '1050',
    '2'		=> '1065',
    '3'		=> '1056',
    '4'		=> '1066',
    '5'		=> '1073',
    '6'		=> '1031',
    '7'		=> '1048',
    '8'		=> '1044',
    '9'		=> '1082',
    '10'	=> '1020',
//	'11'	=> '1069',
    '11'	=> '1033',
    '12'	=> '1054',
    '13'	=> '1034',
    '14'	=> '1036',
    '0'		=> '2043'
);

//사용함수
function alert_msg($msg, $url="") {
    global $HTTP_REFERER, $g_dir, $g_homepage_index;

    if ($url == "")
    {
        $url = "history.go(-1)";
    }
    else
        $url = "document.location.href = '$url'";

    if ($msg != "")
        echo "<script language='javascript'>alert('$msg');$url;</script>";
    else
        echo "<script language='javascript'>$url;</script>";
    exit;
}

// 현재페이지,총페이지수,한페이지에 보여줄 목록수,URL
function pagelisting($cur_page, $total_page, $n, $url) {
    //$retValue = "<table border='0' cellpadding='0' cellspacing='0'><tr>";
    if ($cur_page > 1) {
        $retValue .= "<a href='" . $url . "1'><<</a>";
        $retValue .= "<a href='" . $url . ($cur_page-1) . "'><</a>";
    }
    //$retValue .= "<td>&nbsp;";
    $start_page = ( ( (int)( ($cur_page - 1 ) / 10 ) ) * 10 ) + 1;
    //echo (int)(($cur_page - 1) / 10);
    $end_page = $start_page + 9;
    if ($end_page >= $total_page) $end_page = $total_page;
    //if ($start_page > 1) $retValue .= "<a href='" . $url . ($start_page-1) . "'>[이전10개]</a> ";
    if ($total_page > 1)
        for ($k=$start_page;$k<=$end_page;$k++)
            if ($cur_page != $k) $retValue .= " <a href='$url$k'>$k</a> ";
            else $retValue .= " <strong>$k</strong> ";
    //if ($total_page > $end_page) $retValue .= "<a href='" . $url . ($end_page+1) . "'>[다음10개]</a>";
    //$retValue .= "&nbsp;</td>";
    if ($cur_page < $total_page) {
        $retValue .= "<a href='$url" . ($cur_page+1) . "'>></a>";
        $retValue .= "<a href='$url$total_page'>>></a>";
    }
    //$retValue .= "</tr></table>";
    return $retValue;
}

// 현재페이지,총페이지수,한페이지에 보여줄 목록수,URL
function pagelisting_box($cur_page, $total_page, $n, $url) {
    $retValue = "<p class=\"paging_navigation\">";
    if ($cur_page > 1) {
        $retValue .= "<a href='" . $url . "1' class=\"paging_btns\"><img src=\"/conf/make_img/board/btn_first.gif\" alt=\"처음 페이지로 이동\" /></a>\n";
        //$retValue .= "<a href='" . $url . ($cur_page-1) . "' class=\"paging_btns\" style=\"margin-right: 20px\"><img src=\"/conf/make_img/board/btn_preview.gif\" alt=\"이전 페이지로 이동\" /></a>";
    } else {
        //$retValue .= "<a href='#' class=\"paging_btns\"><img src=\"/conf/make_img/board/btn_first.gif\" alt=\"처음 페이지로 이동\" /></a>\n";
        //$retValue .= "<a href='#' class=\"paging_btns\" style=\"margin-right: 20px\"><img src=\"/conf/make_img/board/btn_preview.gif\" alt=\"이전 페이지로 이동\" /></a>";
    }
    $retValue .= "";
    $start_page = ( ( (int)( ($cur_page - 1 ) / 10 ) ) * 10 ) + 1;
    //echo (int)(($cur_page - 1) / 10);
    $end_page = $start_page + 9;
    if ($end_page >= $total_page) $end_page = $total_page;
    if ($start_page > 1) $retValue .= "<a href='" . $url . ($start_page-1) . "' class=\"paging_btns\" style=\"margin-right: 20px\" ><img src=\"/conf/make_img/board/btn_preview.gif\" alt=\"이전 페이지로 이동\" /></a>\n";
    if ($total_page > 1)
        for ($k=$start_page;$k<=$end_page;$k++)
            if ($cur_page != $k) $retValue .= "<a href='$url$k'>$k</a>\n";
            else $retValue .= "<strong>$k</strong>\n";

    if ($total_page == 1 and $k == 0){
        $retValue .= "<strong>$total_page</strong>";
    }

    if ($total_page > $end_page) $retValue .= "<a href='" . $url . ($end_page+1) . "' class=\"paging_btns\" style=\"margin-left: 20px\" ><img src=\"/conf/make_img/board/btn_next.gif\" alt=\"다음 페이지로 이동\" /></a>\n";
    $retValue .= "";
    if ($cur_page < $total_page) {
        //$retValue .= "<a href='$url" . ($cur_page+1) . "' class=\"paging_btns\" style=\"margin-left: 20px\" ><img src=\"/conf/make_img/board/btn_next.gif\" alt=\"다음 페이지로 이동\" /></a>";
        $retValue .= "<a href='$url$total_page' class=\"paging_btns\" ><img src=\"/conf/make_img/board/btn_last.gif\" alt=\"마지막 페이지로 이동\" /></a>\n";
    } else {
        //$retValue .= "<a href='#' class=\"paging_btns\" style=\"margin-left: 20px\" ><img src=\"/conf/make_img/board/btn_next.gif\" alt=\"다음 페이지로 이동\" /></a>\n";
        //$retValue .= "<a href='#' class=\"paging_btns\"><img src=\"/conf/make_img/board/btn_last.gif\" alt=\"마지막 페이지로 이동\" /></a>";
    }
    $retValue .= "</p>";
    return $retValue;
}

// 사이버홍보관 리스팅
function pagelisting2($cur_page, $total_page, $n, $url) {
    $retValue = "<table border='0' cellpadding='0' cellspacing='0'><tr>";
    if ($cur_page > 1) {
        $retValue .= "<td><a href='" . $url . ($cur_page-1) . "'><img src='./images/list_prev.gif' alt='' align=absmiddle /></a></td>";
    } else {
        $retValue .= "<td><img src='./images/list_prev.gif' alt='' align=absmiddle /></td>";
    }
    $retValue .= "<td>";
    $start_page = ( ( (int)( ($cur_page - 1 ) / 10 ) ) * 10 ) + 1;
    //echo (int)(($cur_page - 1) / 10);
    $end_page = $start_page + 9;
    if ($end_page >= $total_page) $end_page = $total_page;
//	  if ($start_page > 1) $retValue .= "<a href='" . $url . ($start_page-1) . "'>[이전10개]</a> ";
    if ($total_page > 1)
        for ($k=$start_page;$k<=$end_page;$k++)
            if ($cur_page != $k) $retValue .= "<font color='#FF7000'><a href='$url$k'>$k</a></font> <font color='#000000'>|</font> ";
            else $retValue .= "<b style='color:#FF7000'>$k</b> <font color='#000000'>|</font> ";
//	  if ($total_page > $end_page) $retValue .= "<a href='" . $url . ($end_page+1) . "'>[다음10개]</a>";
    $retValue .= "</td>";
    if ($cur_page < $total_page) {
        $retValue .= "<td><a href='$url" . ($cur_page+1) . "'><img src='./images/list_next.gif' alt='' align=absmiddle  /></a></td>";
    } else {
        $retValue .= "<td><img src='./images/list_next.gif' alt='' align=absmiddle  /></td>";
    }
    $retValue .= "</tr></table>";
    return $retValue;
}

// 제안마당
function pagelisting3($cur_page, $total_page, $n, $url) {
    $retValue = "<table border='0' cellpadding='0' cellspacing='0'><tr>";
    if ($cur_page > 1) {
        $retValue .= "<td><a href='" . $url . "1'><img src='/board/images/list_left.gif' alt='처음' align=absmiddle /></a>&nbsp;</td>";
        $retValue .= "<td><a href='" . $url . ($cur_page-1) . "'><img src='/board/images/list_prev.gif' alt='pre' align=absmiddle /></a></td>";
    } else {
        $retValue .= "<td>&nbsp;</td>";
        $retValue .= "<td>&nbsp;</td>";
    }
    $retValue .= "<td>&nbsp;";
    $start_page = ( ( (int)( ($cur_page - 1 ) / 10 ) ) * 10 ) + 1;
    //echo (int)(($cur_page - 1) / 10);
    $end_page = $start_page + 9;
    if ($end_page >= $total_page) $end_page = $total_page;
    if ($start_page > 1) $retValue .= "<a href='" . $url . ($start_page-1) . "'><img src='/board/images/list_prev2.gif' alt='이전10개' align=absmiddle /></a> ";
    if ($total_page > 1)
        for ($k=$start_page;$k<=$end_page;$k++)
            if ($cur_page != $k) $retValue .= " <a href='$url$k'> [$k] </a> ";
            else $retValue .= " <b>$k</b> ";
    if ($total_page > $end_page) $retValue .= "<a href='" . $url . ($end_page+1) . "'><img src='/board/images/list_next2.gif' alt='다음10개' align=absmiddle /></a>";
    $retValue .= "&nbsp;</td>";
    if ($cur_page < $total_page) {
        $retValue .= "<td><a href='$url" . ($cur_page+1) . "'><img src='/board/images/list_next.gif' alt='next' align=absmiddle /></a></td>";
        $retValue .= "<td>&nbsp;<a href='$url$total_page'><img src='/board/images/list_right.gif' alt='마지막' align=absmiddle /></a></td>";
    } else {
        $retValue .= "<td>&nbsp;</td>";
        $retValue .= "<td></td>";
    }
    $retValue .= "</tr></table>";
    return $retValue;
}

function moon($syear,$smonth,$sday) {
    $m[ 0] = 31;
    $m[ 1] = 0 ;
    $m[ 2] = 31;
    $m[ 3] = 30;
    $m[ 4] = 31;
    $m[ 5] = 30;
    $m[ 6] = 31;
    $m[ 7] = 31;
    $m[ 8] = 30;
    $m[ 9] = 31;
    $m[10] = 30;
    $m[11] = 31;
    $kk=
        "1212122322121,1212121221220,1121121222120,2112132122122,2112112121220,2121211212120,2212321121212,2122121121210,2122121212120,1232122121212,".
        "1212121221220,1121123221222,1121121212220,1212112121220,2121231212121,2221211212120,1221212121210,2123221212121,2121212212120,1211212232212,".
        "1211212122210,2121121212220,1212132112212,2212112112210,2212211212120,1221412121212,1212122121210,2112212122120,1231212122212,1211212122210,".
        "2121123122122,2121121122120,2212112112120,2212231212112,2122121212120,1212122121210,2132122122121,2112121222120,1211212322122,1211211221220,".
        "2121121121220,2122132112122,1221212121120,2121221212110,2122321221212,1121212212210,2112121221220,1231211221222,1211211212220,1221123121221,".
        "2221121121210,2221212112120,1221241212112,1212212212120,1121212212210,2114121212221,2112112122210,2211211412212,2211211212120,2212121121210,".
        "2212214112121,2122122121120,1212122122120,1121412122122,1121121222120,2112112122120,2231211212122,2121211212120,2212121321212,2122121121210,".
        "2122121212120,1212142121212,1211221221220,1121121221220,2114112121222,1212112121220,2121211232122,1221211212120,1221212121210,2121223212121,".
        "2121212212120,1211212212210,2121321212221,2121121212220,1212112112210,2223211211221,2212211212120,1221212321212,1212122121210,2112212122120,".
        "1211232122212,1211212122210,2121121122210,2212312112212,2212112112120,2212121232112,2122121212110,2212122121210,2112124122121,2112121221220,".
        "1211211221220,2121321122122,2121121121220,2122112112322,1221212112120,1221221212110,2122123221212,1121212212210,2112121221220,1211231212222,".
        "1211211212220,1221121121220,1223212112121,2221212112120,1221221232112,1212212122120,1121212212210,2112132212221,2112112122210,2211211212210,".
        "2221321121212,2212121121210,2212212112120,1232212122112,1212122122120,1121212322122,1121121222120,2112112122120,2211231212122,2121211212120,".
        "2122121121210,2124212112121,2122121212120,1212121223212,1211212221220,1121121221220,2112132121222,1212112121220,2121211212120,2122321121212,".
        "1221212121210,2121221212120,1232121221212,1211212212210,2121123212221,2121121212220,1212112112220,1221231211221,2212211211220,1212212121210,".
        "2123212212121,2112122122120,1211212322212,1211212122210,2121121122120,2212114112122,2212112112120,2212121211210,2212232121211,2122122121210";
    for($i=0; $i<160; $i++) {
        $dt[$i] = 0;
        for($j=0; $j<12; $j++) {
            if ($kk[$i*14+$j]=='1'||$kk[$i*14+$j]=='3') $dt[$i] = $dt[$i] + 29;
            if ($kk[$i*14+$j]=='2'||$kk[$i*14+$j]=='4') $dt[$i] = $dt[$i] + 30;
        }
        if ($kk[$i*14+12]=='1'||$kk[$i*14+$j]=='3') $dt[$i] = $dt[$i] + 29;
        if ($kk[$i*14+12]=='2'||$kk[$i*14+$j]=='4') $dt[$i] = $dt[$i] + 30;
    }

    /* 1. 1. 1. - 1910. 2. 10. */
    $td1 = 1880*365 + 1880/4 - 1880/100 + 1880/400 + 30;
    // printf("%d %d %d <BR>",$syear,$smonth, $sday);

    /* ## 1. 1. 1. - $syear. $smonth. $sday. ## */
    $k11 = $syear-1;
    $td2 = $k11*365 + $k11/4 - $k11/100 + $k11/400;
    $ll = $syear%400==0 || $syear%100!=0 && $syear%4==0;

    if($ll) $m[1] = 29;
    else $m[1] = 28;
    for($i=0; $i<$smonth-1; $i++) $td2 = $td2 + $m[$i];
    $td2 = $td2 + $sday;

    /* ## 1881. 1. 30. - $syear. $smonth. $sday. ## */
    $td = $td2 - $td1 + 1;

    /* ## Lunar Year Caculation ## */
    $td0 = $dt[0];
    for($i=0; $i<163; $i++) {
        if( $td <= $td0 ) break;
        $td0 = $td0 + $dt[$i+1];
    }
    $lyear = $i + 1881; /* Calculated Lunar Year */

    /* ## Lunar Month Calculation ## */
    $td0 = $td0 - $dt[$i];
    $td = $td - $td0;
    if($kk[$i*14+12] != '0') $jcount = 13;
    else $jcount = 12;
    $m2 = 0;
    for($j=0; $j<$jcount; $j++) {
        if( $kk[$i*14+$j] <='2' ) $m2++;
        if( $kk[$i*14+$j] <='2' ) $m1 = $kk[$i*14+$j]-'0' + 28;
        else $m1 = $kk[$i*14+$j]-'0' + 26;
        if( $td <= $m1 ) break;
        $td = $td - $m1;
    }
    $m0 = $j;
    $lmonth = $m2; /* Calculated Lunar Month */

    $lday = $td; /* Calculated Lunar Day */

    $i = ($td2+4) % 10;
    $j = ($td2+2) % 12;
    $i1 = ($lyear+6) % 10;
    $j1 = ($lyear+8) % 12;

    $yun="";
    if( $kk[($lyear-1881)*14+12] != '0' && $kk[($lyear-1881)*14+m0] > '2' ) $yun="윤년";
    $outbuff=sprintf("%d-%02d-%02d",$lyear, $lmonth, $lday);
    return($outbuff);
}

// 파일의 확장자 검사
// check_file_ext("파일명", "허용확장자리스트 ;로 구분");
function check_file_ext($filename, $allow_ext)
{
    if ($filename == "") return true;
    $ext = get_file_ext($filename);
    $allow_ext = explode(";", $allow_ext);
    $sw_allow_ext = false;
    for ($i=0; $i<count($allow_ext); $i++)
        if ($ext == $allow_ext[$i]) // 허용하는 확장자라면
        {
            $sw_allow_ext = true;
            break;
        }
    return $sw_allow_ext;
}

function get_file_ext($filename)
{
    if ($filename == "") return "";
    $type = explode(".", $filename);
    $ext = strtolower($type[count($type)-1]);
    return $ext;
}

function upload_file($srcfile, $destfile, $dir)
{
    if ($destfile == "") return false;
    // 업로드 한후 , 퍼미션을 변경함
    @move_uploaded_file($srcfile, "$dir/$destfile");
    @chmod("$dir/$destfile", 0666);
    return true;
}

//글자 자르기.
function cutstr($msg, $cut_size, $tail="...") {
    // 2015-05-08 변수초기화.(php버전업에 따라서 변수선언에 대해 조금더 엄격해짐.)
    $snowtmp="";
    $han="0";
    $eng="";
    if ($cut_size<=0) return $msg;

    // 계속이어쓰는 문자열을 자른다.
    $max_len = 100;
    if(strlen($msg) > $max_len)
        if(!eregi(" ", $msg))
            $msg = mb_substr($msg,0,$max_len,'UTF-8');

    for($i=0;$i<$cut_size;$i++)
        if(@ord($msg[$i])>127) $han++;
        else $eng++;

    $cut_size=$cut_size+(int)$han*0.6;

    //echo $cut_size; exit;
    $snow=1;
    for ($i=0;$i<strlen($msg);$i++) {
        if ($snow>$cut_size) { return $snowtmp.$tail;}
        if (ord($msg[$i])<=127) {
            $snowtmp.= $msg[$i];
            if ($snow%$cut_size==0) { return $snowtmp.$tail; }
        } else {
            if ($snow%$cut_size==0) { return $snowtmp.$tail; }
            $snowtmp.=$msg[$i].$msg[++$i];
            $snow++;
        }
        $snow++;
    }

    return $snowtmp;
}

// GD이용 썸네일 만들기
function thumnail($file, $save_filename, $save_path, $max_width, $max_height)
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

    if($img_width > $max_width || $img_height > $max_height)
    {
        if($img_width == $img_height)
        {
            $dst_width = $max_width;
            $dst_height = $max_height;
        }elseif($img_width > $img_height){
            $dst_width = $max_width;
            $dst_height = ceil(($max_width / $img_width) * $img_height);
        }else{
            $dst_height = $max_height;
            $dst_width = ceil(($max_height / $img_height) * $img_width);
        }
    }else{
        $dst_width = $img_width;
        $dst_height = $img_height;
    }
    if($dst_width < $max_width) $srcx = ceil(($max_width - $dst_width)/2); else $srcx = 0;
    if($dst_height < $max_height) $srcy = ceil(($max_height - $dst_height)/2); else $srcy = 0;

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
        ImageJPEG($dst_img, $save_path.$save_filename);
    }elseif($img_info[2] == 3){
        ImagePNG($dst_img, $save_path.$save_filename);
    }
    ImageDestroy($dst_img);
    ImageDestroy($src_img);
}

//태그제거
function strip_tags_attributes($string){
    $search = array ("'<SCRIPT[^>]*?>.*?'si", // 자바 스크립트 제거
        "'<[\/\!]*?[^<>]*?>'si", // HTML 태그 제거
        "'<\!\-\-(.*)?\-\->'si", //주석제거
        "'([\r\n])[\s]+'",
        "'&(quot|#34);'i", // HTML 엔티티 치환
        "'&(amp|#38);'i",
        "'&(lt|#60);'i",
        "'&(gt|#62);'i",
        "'&(nbsp|#160);'i",
        "'&(iexcl|#161);'i",
        "'&(cent|#162);'i",
        "'&(pound|#163);'i",
        "'&(copy|#169);'i",
        "'&#(\d+);'e"); // php로 실행
    $replace = array ("", "", "", "\\1", "\"", "&", "<", ">", " ", chr(161), chr(162), chr(163), chr(169), "chr(\\1)");
    $body = preg_replace($search,$replace,$string);
    return $body;
}

//게시판 메인 노출함수
function board_export($board_id, $board_row, $title_limit="0", $use_img="0", $width_img="0", $height_img="0", $use_ucc="0", $width_ucc="0", $height_ucc="0", $use_contents="0", $contents_limit="0", $link_url) {
    $board_table = "xboard_board_".$board_id;

    //board5 언론보도게시판

    if($board_id == "board5"){
        $sql    = " select * from $board_table where FLAG1='Y' and FLAG3='Y' and FLAG4='N'
			  and TITLE like '%뉴시스%' 
			  or B.TITLE like '%KNN%' 
			  or B.TITLE like '%KBS%' 
			  or B.TITLE like '%MBC%' 
			  or B.TITLE like '%연합뉴스%' 
			  or B.TITLE like '%부산일보%' 
			  or B.TITLE like '%국제신문%'  
			  or B.TITLE like '%조선일보%'
			  or B.TITLE like '%중앙일보%'
			  or B.TITLE like '%동아일보%'
			  or B.TITLE like '%메트로%'  
			  or B.TITLE like '%포커스%'
			  or B.TITLE like '%포 커스%' 
			  or B.TITLE like '%focus%' 
			  or B.TITLE like '%FOCUS%' 
			  
			order by NOTICE DESC, RANK DESC,  PARENT ASC, CHILD ASC  limit 0, $board_row ";
    }
    //else{
    $sql    = " select * from $board_table where FLAG1='Y' and FLAG3='Y' and FLAG4='N' order by NOTICE DESC, RANK DESC,  PARENT ASC, CHILD ASC  limit 0, $board_row ";
    //}
    $result = mysql_query($sql) or die (mysql_error());

    while($row=mysql_fetch_array($result)) {
        if($row['USE_SECRET']=="1") {
            $url = "<img src='http://www1.dit.ac.kr/board/images/key.gif' align='absmiddle' border=0> <a href='".$link_url."?v_url=/xboard/confirm.php?board_id=".$board_id."&no=".$row['BOARD_NO']."&mode=secret_view' title='".$row['TITLE']."'>";
        } else {
            $url = "<a href='".$link_url."?v_url=/xboard/view.php?board_id=".$board_id."&no=".$row['BOARD_NO']."' title='".$row['TITLE']."'>";
        }
        if($row['DEPTH']*1 > 0)
            $url = "[Re]".$url;
        if($title_limit > 0) {
            $ttl = $url."".cutstr(strip_tags_attributes($row['TITLE']),$title_limit)."</a>";
        } else {
            $ttl = $url."".$row['TITLE']."</a>";
        }
        $newicon = ($row['RTIME'] > time() - (3600*24)) ? '1' : '0';
        if($newicon=='1')	$ttl .= "<img src='/main/images/main/icon_new.gif'>";
        $TITLE[] = $ttl;



        $contents = str_replace("&nbsp;","",strip_tags_attributes($row['CONTENTS']));

        if($use_contents > 0 && $contents_limit > 0) {
            $CONTENTS[] = $url."".cutstr(stripcslashes($contents),$contents_limit)."</a>";
        } else {
            $CONTENTS[] = $url."".stripcslashes($contents)."</a>";
        }

        $root_dir = (dirname(__FILE__) . '/../');

        if($use_img > 0) {
            $sql_img = " select FILE_NAME from XBOARD_FILE_TABLE where BOARD_ID = '$board_id' and PARENT = '" . $row['BOARD_NO'] . "'  and REMARKS='T'";
            $row_img = mysql_fetch_array(mysql_query($sql_img));

            $imgC = new ImgClass($width_img,$height_img);
            //if($row_img[FILE_NAME]!="" && file_exists($root_dir . "/xvar/DATA/".$board_id."/".$row_img[FILE_NAME])){
            if($row_img['FILE_NAME']!="" && file_exists($root_dir . "/xvar/DATA/".$board_id."/".$row_img['FILE_NAME'])){
                $size = @getimagesize($root_dir . "/xvar/DATA/".$board_id."/".$row_img['FILE_NAME']);
                $imgC->imageResize($size[0], $size[1]);

                $IMAGE[] = $url."<img src='/xvar/DATA/".$board_id."/".$row_img['FILE_NAME']."' width='".$size['0']."' height='".$size['1']."' border='0' title='".$row['TITLE']."'></a>";
            }else{
                $size = @getimagesize($root_dir . "/main/images/main/sample_img.gif");
                $imgC->imageResize($size['0'], $size['1']);

                $IMAGE[] = $url."<img src='/main/images/main/sample_img.gif' width='".$size['0']."' height='".$size['1']."' border='0' title='".$row['TITLE']."'></a>";
            }
        }

        if($use_ucc > 0) {
            $imgC = new ImgClass($width_ucc,$height_ucc);
            if($row[ImageFile]!="" && file_exists($root_dir . "/xvar/ucc/ThumbnailImg/".$row['ImageFile'])){
                $size = @getimagesize($root_dir . "/xvar/ucc/ThumbnailImg/".$row['ImageFile']);
                $imgC->imageResize($size['0'], $size['1']);

                $UCC[] = $url."<img src='/xvar/ucc/ThumbnailImg/".$row['ImageFile']."' width='".$size['0']."' height='".$size['1']."' border='0' title='".$row['TITLE']."'></a>";
            } else {
                $size = @getimagesize($root_dir . "/main/images/main/sample_img.gif");
                $imgC->imageResize($size['0'], $size['1']);

                $UCC[] = $url."<img src='/main/images/main/sample_img.gif' width='".$width_img."' height='".$height_img."' border='0' title='".$row['TITLE']."'></a>";
            }
        }
        $RTIME[] = date("Y.m.d",$row['RTIME']);
    }
    $row[0] = $TITLE;
    $row[1] = $CONTENTS;
    $row[2] = $IMAGE;
    $row[3] = $UCC;
    $row[4] = $RTIME;

    return $row;
}

//게시판 메인 노출함수
function board_export2($board_id, $board_row, $title_limit="0", $use_img="0", $width_img="0", $height_img="0", $use_ucc="0", $width_ucc="0", $height_ucc="0", $use_contents="0", $contents_limit="0", $link_url) {
    $board_table = "xboard_board_".$board_id;

    if($board_id == "board5"){
        $sql    = " select * from $board_table where FLAG1='Y' and FLAG3='Y' and FLAG4='N'
			  and TITLE like '%[뉴시스]%' 
			  or TITLE like '%[연합뉴스]%' 
			  or TITLE like '%[부산일보]%' 
			  or TITLE like '%[국제신문]%'  
			  or TITLE like '%[메트로]%'  
			  or TITLE like '%[포커스]%'  
			order by NOTICE DESC, RANK DESC,  PARENT ASC, CHILD ASC  limit 0, $board_row ";
    }else{
        $sql    = " select * from $board_table where FLAG1='Y' and FLAG3='Y' and FLAG4='N' order by NOTICE DESC, RANK DESC,  PARENT ASC, CHILD ASC  limit 0, $board_row ";
    }

    $result = mysql_query($sql) or die (mysql_error());

    while($row=mysql_fetch_array($result)) {
        if($row['USE_SECRET']=="1") {
            $url = "<img src='http://www1.dit.ac.kr/board/images/key.gif' align='absmiddle' border=0> <a href='".$link_url."?v_url=/xboard/confirm.php?board_id=".$board_id."&no=".$row['BOARD_NO']."&mode=secret_view' title='".$row['TITLE']."'>";
        } else {
            $url = "<a href='".$link_url."?v_url=/xboard/view.php?board_id=".$board_id."&no=".$row['BOARD_NO']."' title='".$row['TITLE']."'>";
        }
        if($row['DEPTH']*1 > 0)
            $url = "[Re]".$url;
        if($title_limit > 0) {
            $ttl = $url."".cutstr(strip_tags_attributes($row['TITLE']),$title_limit)."</a>";
        } else {
            $ttl = $url.$row['TITLE']."</a>";
        }
        $newicon = ($row['RTIME'] > time() - (3600*24)) ? '1' : '0';
        if($newicon=='1')	$ttl .= "<img src='/main/images/main/icon_new.gif'>";
        $TITLE[] = $ttl;



        $contents = str_replace("&nbsp;","",strip_tags_attributes($row['CONTENTS']));

        if($use_contents > 0 && $contents_limit > 0) {
            $CONTENTS[] = $url.cutstr(stripcslashes($contents),$contents_limit)."</a>";
        } else {
            $CONTENTS[] = $url.stripcslashes($contents)."</a>";
        }

        $root_dir = (dirname(__FILE__) . '/../');

        if($use_img > 0) {
            $sql_img = " select FILE_NAME from XBOARD_FILE_TABLE where BOARD_ID = '$board_id' and PARENT = '$row[BOARD_NO]'  and REMARKS='T'";
            $row_img = mysql_fetch_array(mysql_query($sql_img));

            $imgC = new ImgClass($width_img,$height_img);
            if($row_img['FILE_NAME']!="" && file_exists($root_dir . "/xvar/DATA/".$board_id."/".$row_img['FILE_NAME'])){
                $size = @getimagesize($root_dir . "/xvar/DATA/".$board_id."/".$row_img['FILE_NAME']);
                $imgC->imageResize($size[0], $size[1]);

                $IMAGE[] = $url."<img src='/xvar/DATA/".$board_id."/".$row_img['FILE_NAME']."' width='".$size[0]."' height='".$size[1]."' border='0' title='".$row['TITLE']."'></a>";
            }else{
                $size = @getimagesize($root_dir . "/main/images/main/sample_img.gif");
                $imgC->imageResize($size[0], $size[1]);

                $IMAGE[] = $url."<img src='/main/images/main/sample_img.gif' width='".$size[0]."' height='".$size[1]."' border='0' title='".$row['TITLE']."'></a>";
            }
        }
        // 2015-05-08 변수초기화.(php버전업에 따라서 변수선언에 대해 조금더 엄격해짐.)
        $UCC="";
        if($use_ucc > 0) {
            $imgC = new ImgClass($width_ucc,$height_ucc);
            if($row[ImageFile]!="" && file_exists($root_dir . "/xvar/ucc/ThumbnailImg/".$row['ImageFile'])){
                $size = @getimagesize($root_dir . "/xvar/ucc/ThumbnailImg/".$row['ImageFile']);
                $imgC->imageResize($size[0], $size[1]);

                $UCC[] = $url."<img src='/xvar/ucc/ThumbnailImg/".$row['ImageFile']."' width='".$size[0]."' height='".$size[1]."' border='0' title='".$row['TITLE']."'></a>";
            } else {
                $size = @getimagesize($root_dir . "/main/images/main/sample_img.gif");
                $imgC->imageResize($size[0], $size[1]);

                $UCC[] = $url."<img src='/main/images/main/sample_img.gif' width='".$width_img."' height='".$height_img."' border='0' title='".$row['TITLE']."'></a>";
            }
        }
        $RTIME[] = date("Y.m.d",$row['RTIME']);
    }
    $row[0] = $TITLE;
    $row[1] = $CONTENTS;
    $row[2] = $IMAGE;
    $row[3] = $UCC;
    $row[4] = $RTIME;

    return $row;
}



//게시판 메인 노출함수
function board_export3($board_id, $board_row, $title_limit="0", $use_img="0", $width_img="0", $height_img="0", $use_ucc="0", $width_ucc="0", $height_ucc="0", $use_contents="0", $contents_limit="0", $link_url) {
    $board_table = "xboard_board_".$board_id;

    //board5 언론보도게시판

    if($board_id == "board5"){
        $sql    = " select * from $board_table where FLAG1='Y' and FLAG3='Y' and FLAG4='N'
			  and TITLE like '%[뉴시스]%' 
			  or B.TITLE like '%[KNN]%' 
			  or B.TITLE like '%[KBS]%' 
			  or B.TITLE like '%[MBC]%' 
			  or B.TITLE like '%[연합뉴스]%' 
			  or B.TITLE like '%[부산일보]%' 
			  or B.TITLE like '%[국제신문]%'  
			  or B.TITLE like '%[조선일보]%'
			  or B.TITLE like '%[중앙일보]%'
			  or B.TITLE like '%[동아일보]%'
			  or B.TITLE like '%[메트로]%'  
			  or B.TITLE like '%[포커스]%' 
			order by NOTICE DESC, RANK DESC,  PARENT ASC, CHILD ASC  limit 0, $board_row ";
    }
    //else{
    $sql    = " select * from $board_table where FLAG1='Y' and FLAG3='Y' and FLAG4='N' order by NOTICE DESC, RANK DESC,  PARENT ASC, CHILD ASC  limit 0, $board_row ";
    //}
    $result = mysql_query($sql) or die (mysql_error());

    while($row=mysql_fetch_array($result)) {
        if($row['USE_SECRET']=="1") {
            $url = "<img src='http://www1.dit.ac.kr/board/images/key.gif' align='absmiddle' border=0> <a href='".$link_url."?v_url=/xboard/confirm.php?board_id=".$board_id."&no=".$row['BOARD_NO']."&mode=secret_view' title='".$row['TITLE']."'>";
        } else {
            $url = "<a href='".$link_url."?v_url=/xboard/view.php?board_id=".$board_id."&no=".$row['BOARD_NO']."' title='".$row['TITLE']."'>";
        }
        if($row['DEPTH']*1 > 0)
            $url = "[Re]".$url;
        if($title_limit > 0) {
            $ttl = $url."<span class='b_redtxt'>".cutstr(strip_tags_attributes($row['TITLE']),$title_limit)."</span></a>";
        } else {
            $ttl = $url."".$row['TITLE']."</a>";
        }
        $newicon = ($row['RTIME'] > time() - (3600*24)) ? '1' : '0';
        if($newicon=='1')	$ttl .= "<img src='/main/images/main/icon_new.gif'>";
        $TITLE[] = $ttl;



        $contents = str_replace("&nbsp;","",strip_tags_attributes($row['CONTENTS']));

        if($use_contents > 0 && $contents_limit > 0) {
            $CONTENTS[] = $url."<span class='small'>".cutstr(stripcslashes($contents),$contents_limit)."</span></a>";
        } else {
            $CONTENTS[] = $url."<span class='small'>".stripcslashes($contents)."</span></a>";
        }

        $root_dir = (dirname(__FILE__) . '/../');

        if($use_img > 0) {
            $sql_img = " select FILE_NAME from XBOARD_FILE_TABLE where BOARD_ID = '$board_id' and PARENT = '$row[BOARD_NO]'  and REMARKS='T'";
            $row_img = mysql_fetch_array(mysql_query($sql_img));

            $imgC = new ImgClass($width_img,$height_img);
            //if($row_img[FILE_NAME]!="" && file_exists($root_dir . "/xvar/DATA/".$board_id."/".$row_img[FILE_NAME])){
            if($row_img['FILE_NAME']!="" && file_exists($root_dir . "/xvar/DATA/".$board_id."/".$row_img['FILE_NAME'])){
                $size = @getimagesize($root_dir . "/xvar/DATA/".$board_id."/".$row_img['FILE_NAME']);
                $imgC->imageResize($size[0], $size[1]);


                if(!file_exists($root_dir . "/xvar/DATA/".$board_id."/Thumnail/".$row_img['FILE_NAME'])){

                    thumnail($root_dir . "/xvar/DATA/".$board_id."/".$row_img['FILE_NAME'], $row_img['FILE_NAME'], "../xvar/DATA/".$board_id."/Thumnail/",  $size[0], $size[1]);
                    //echo "<img src='$imgthum_src'>";

                }else{
                    //echo "<img src='$imgthum_src'>";

                }

                $IMAGE[] = $url."<img src='/xvar/DATA/".$board_id."/Thumnail/".$row_img['FILE_NAME']."' width='".$size[0]."' height='".$size[1]."' border='0' title='".$row['TITLE']."'></a>";


            }else{
                $size = @getimagesize($root_dir . "/main/images/main/sample_img.gif");
                $imgC->imageResize($size[0], $size[1]);

                $IMAGE[] = $url."<img src='/main/images/main/sample_img.gif' width='".$size[0]."' height='".$size[1]."' border='0' title='".$row['TITLE']."'></a>";
            }
        }

        if($use_ucc > 0) {
            $imgC = new ImgClass($width_ucc,$height_ucc);
            if($row[ImageFile]!="" && file_exists($root_dir . "/xvar/ucc/ThumbnailImg/".$row['ImageFile'])){
                $size = @getimagesize($root_dir . "/xvar/ucc/ThumbnailImg/".$row['ImageFile']);
                $imgC->imageResize($size[0], $size[1]);

                $UCC[] = $url."<img src='/xvar/ucc/ThumbnailImg/".$row['ImageFile']."' width='".$size[0]."' height='".$size[1]."' border='0' title='".$row['TITLE']."'></a>";
            } else {
                $size = @getimagesize($root_dir . "/main/images/main/sample_img.gif");
                $imgC->imageResize($size[0], $size[1]);

                $UCC[] = $url."<img src='/main/images/main/sample_img.gif' width='".$width_img."' height='".$height_img."' border='0' title='".$row['TITLE']."'></a>";
            }
        }
        $RTIME[] = date("Y/m/d",$row['RTIME']);
    }
    $row[0] = $TITLE;
    $row[1] = $CONTENTS;
    $row[2] = $IMAGE;
    $row[3] = $UCC;
    $row[4] = $RTIME;

    return $row;
}

//게시판 메인 노출함수
function board_export4($board_id, $board_row, $title_limit, $use_img="0", $width_img="0", $height_img="0", $use_ucc="0", $width_ucc="0", $height_ucc="0", $use_contents="0", $contents_limit="0", $link_url) {
    $board_table = "xboard_board_".$board_id;

    //$sql    = " select * from $board_table where FLAG1='Y' and FLAG3='Y' and FLAG4='N' order by RTIME DESC, RANK DESC,  PARENT ASC, CHILD ASC  limit 0, $board_row ";

    $sql    = " select * from $board_table order by RTIME DESC, RANK DESC,  PARENT ASC, CHILD ASC  limit 0, $board_row ";

    $result = mysql_query($sql) or die (mysql_error());

    while($row=mysql_fetch_array($result)) {
        if($row['USE_SECRET']=="1") {
            //<img src='/board/images/key.gif' align='absmiddle' border=0>
            $url = "<a href='".$link_url."?v_url=/xboard/confirm.php?board_id=".$board_id."&no=".$row['BOARD_NO']."&mode=secret_view' title='".$row['TITLE']."'>";
            $bbs_url[] = $link_url."?v_url=/xboard/confirm.php?board_id=".$board_id."&no=".$row['BOARD_NO']."&mode=secret_view";
        } else {
            $url = "<a href='".$link_url."?v_url=/xboard/view.php?board_id=".$board_id."&no=".$row['BOARD_NO']."' title='".$row['TITLE']."'>";
            $bbs_url[] = $link_url."?v_url=/xboard/view.php?board_id=".$board_id."&no=".$row['BOARD_NO'];
        }

        if($row['DEPTH']*1 > 0)
            $url = "[Re]".$url;
        if($title_limit > 0) {
            //alert($url);
            //alert(iconv("EUC-KR","UTF-8",cutstr(strip_tags_attributes($row['TITLE']),$title_limit)));
            $ttl = $url."<span class='small'>".cutstr(strip_tags_attributes($row['TITLE']),$title_limit)."</span>";
            //alert(iconv("EUC-KR","UTF-8",$ttl));
        } else {
            $ttl = $url.$row['TITLE']."";
        }
        $newicon = ($row['RTIME'] > time() - (3600*24)) ? '1' : '0';
        if($newicon=='1')	$ttl .= "<img src='/xboard/icon/list_new.gif'  border='0' alt='new' />";

        $ttl .= "</a>";

        $TITLE[] = stripslashes($ttl);
        //$TITLE[] = $row['TITLE'];
        //alert(iconv("EUC-KR","UTF-8",cutstr(strip_tags_attributes($row['TITLE']),$title_limit)));
        $bbs_title[] = cutstr(strip_tags_attributes($row['TITLE']),$title_limit);
//$bbs_title[] = mb_strimwidth($row[TITLE], "0", $title_limit, "...","EUC-KR");


        $contents = str_replace("&nbsp;","",strip_tags_attributes($row['CONTENTS']));

        if($use_contents > 0 && $contents_limit > 0) {
            $CONTENTS[] = $url.cutstr(stripcslashes($contents),$contents_limit)."</a>";
        } else {
            $CONTENTS[] = $url.stripcslashes($contents)."</a>";
        }

        $root_dir = (dirname(__FILE__) . '/../');

        if($use_img > 0) {
            $sql_img = " select FILE_NAME from xboard_file_table where BOARD_ID = '$board_id' and PARENT = '" . $row['BOARD_NO'] . "'  and REMARKS='T'";
            $row_img = mysql_fetch_array(mysql_query($sql_img));
//print_R($row_img);
            $imgC = new ImgClass($width_img,$height_img);
            if($row_img['FILE_NAME']!="" && file_exists($root_dir . "/xvar/DATA/".$board_id."/".$row_img['FILE_NAME'])){
                $size = @getimagesize($root_dir . "/xvar/DATA/".$board_id."/".$row_img['FILE_NAME']);
                $imgC->imageResize($size[0], $size[1]);

                $IMAGE[] = $url."<img src='/xvar/DATA/".$board_id."/".$row_img['FILE_NAME']."' width='".$size['0']."' height='".$size['1']."' border='0' title='".$row['TITLE']."'></a>";
                $img_src[] = "/xvar/DATA/".$board_id."/".$row_img['FILE_NAME'];

            }else{
                $size = @getimagesize($root_dir . "/main/make_img/main/photo_noimg.gif");
                $imgC->imageResize($size['0'], $size['1']);

                $IMAGE[] = $url."<img src='/main/make_img/main/photo_noimg.gif' width='".$size['0']."' height='".$size['1']."' border='0' title='".$row['TITLE']."'></a>";
                $img_src[] = "/main/make_img/main/photo_noimg.gif";
            }
        }

        if($use_ucc > 0) {
            $imgC = new ImgClass($width_ucc,$height_ucc);
            if($row['ImageFile']!="" && file_exists($root_dir . "/xvar/ucc/ThumbnailImg/".$row['ImageFile'])){
                $size = @getimagesize($root_dir . "/xvar/ucc/ThumbnailImg/".$row['ImageFile']);
                $imgC->imageResize($size['0'], $size['1']);

                $UCC[] = $url."<img src='/xvar/ucc/ThumbnailImg/".$row['ImageFile']."' width='".$size['0']."' height='".$size['1']."' border='0' title='".$row['TITLE']."'></a>";
                $img_src[] = "/main/images/main/sample_img.gif";
            } else {
                $size = @getimagesize($root_dir . "/main/make_img/main/photo_noimg.gif");
                $imgC->imageResize($size['0'], $size['1']);

                $UCC[] = $url."<img src='/main/make_img/main/photo_noimg.gif' width='".$width_img."' height='".$height_img."' border='0' title='".$row['TITLE']."'></a>";
                $img_src[] = "/main/make_img/main/photo_noimg.gif";
            }
        }
        $RTIME[] = date("Y.m.d",$row['RTIME']);
    }
    //$row['0'] = $TITLE;
    $row['0'] = $TITLE;
    $row['1'] = $CONTENTS;
    $row['2'] = $IMAGE;

    $row['3'] = $UCC;
    $row['4'] = $RTIME;
    $row['5'] = $bbs_title;
    $row['6'] = $bbs_url;
    $row['7'] = $img_src;


    return $row;
}
//게시판 메인 노출함수
function board_export5($board_id, $board_row, $title_limit="0", $use_img="0", $width_img="0", $height_img="0", $use_ucc="0", $width_ucc="0", $height_ucc="0", $use_contents="0", $contents_limit="0", $link_url) {
    $board_table = "xboard_board_".$board_id;

    //board5 언론보도게시판

    if($board_id == "board5"){
        $sql    = " select * from $board_table where FLAG1='Y' and FLAG3='Y' and FLAG4='N'
			  and TITLE like '%뉴시스%' 
			  or B.TITLE like '%KNN%' 
			  or B.TITLE like '%KBS%' 
			  or B.TITLE like '%MBC%' 
			  or B.TITLE like '%연합뉴스%' 
			  or B.TITLE like '%부산일보%' 
			  or B.TITLE like '%국제신문%'  
			  or B.TITLE like '%조선일보%'
			  or B.TITLE like '%중앙일보%'
			  or B.TITLE like '%동아일보%'
			  or B.TITLE like '%메트로%'  
			  or B.TITLE like '%포커스%'
			  or B.TITLE like '%포 커스%' 
			  or B.TITLE like '%focus%' 
			  or B.TITLE like '%FOCUS%' 
			  
			order by NOTICE DESC, RANK DESC,  PARENT ASC, CHILD ASC  limit 0, $board_row ";
    }
    //else{
    $sql    = " select * from $board_table where FLAG1='Y' and FLAG3='Y' and FLAG4='N' order by NOTICE DESC, RANK DESC,  PARENT ASC, CHILD ASC  limit 0, $board_row ";
    //}
    $result = mysql_query($sql) or die (mysql_error());

    while($row=mysql_fetch_array($result)) {
        if($row['USE_SECRET']=="1") {
            $url = "<img src='http://www1.dit.ac.kr/board/images/key.gif' align='absmiddle' border=0> <a href='".$link_url."?v_url=/xboard/confirm.php?board_id=".$board_id."&no=".$row['BOARD_NO']."&mode=secret_view' title='".$row['TITLE']."'>";
        } else {
            $url = "<a href='".$link_url."?v_url=/xboard/view.php?board_id=".$board_id."&no=".$row['BOARD_NO']."' title='".$row['TITLE']."'>";
        }
        if($row['DEPTH']*1 > 0)
            $url = "[Re]".$url;
        if($title_limit > 0) {
            $title_limit = 25;
            $ttl = $url."".cutstr(strip_tags_attributes($row['TITLE']),$title_limit)."</a>";
        } else {
            $ttl = $url."".$row['TITLE']."</a>";
        }
        $newicon = ($row['RTIME'] > time() - (3600*24)) ? '1' : '0';
        if($newicon=='1')	$ttl .= "<img src='../../../xboard/icon/list_new.gif'>";
        $TITLE[] = $ttl;



        $contents = str_replace("&nbsp;","",strip_tags_attributes($row['CONTENTS']));

        if($use_contents > 0 && $contents_limit > 0) {
            $CONTENTS[] = $url."".cutstr(stripcslashes($contents),$contents_limit)."</a>";
        } else {
            $CONTENTS[] = $url."".stripcslashes($contents)."</a>";
        }

        $root_dir = (dirname(__FILE__) . '/../');

        if($use_img > 0) {
            $sql_img = " select FILE_NAME from XBOARD_FILE_TABLE where BOARD_ID = '$board_id' and PARENT = '" . $row['BOARD_NO'] . "'  and REMARKS='T'";
            $row_img = mysql_fetch_array(mysql_query($sql_img));

            $imgC = new ImgClass($width_img,$height_img);
            //if($row_img[FILE_NAME]!="" && file_exists($root_dir . "/xvar/DATA/".$board_id."/".$row_img[FILE_NAME])){
            if($row_img['FILE_NAME']!="" && file_exists($root_dir . "/xvar/DATA/".$board_id."/".$row_img['FILE_NAME'])){
                $size = @getimagesize($root_dir . "/xvar/DATA/".$board_id."/".$row_img['FILE_NAME']);
                $imgC->imageResize($size[0], $size[1]);

                $IMAGE[] = $url."<img src='/xvar/DATA/".$board_id."/".$row_img['FILE_NAME']."' width='".$size['0']."' height='".$size['1']."' border='0' title='".$row['TITLE']."'></a>";
            }else{
                $size = @getimagesize($root_dir . "/main/images/main/sample_img.gif");
                $imgC->imageResize($size['0'], $size['1']);

                $IMAGE[] = $url."<img src='/main/images/main/sample_img.gif' width='".$size['0']."' height='".$size['1']."' border='0' title='".$row['TITLE']."'></a>";
            }
        }

        if($use_ucc > 0) {
            $imgC = new ImgClass($width_ucc,$height_ucc);
            if($row[ImageFile]!="" && file_exists($root_dir . "/xvar/ucc/ThumbnailImg/".$row['ImageFile'])){
                $size = @getimagesize($root_dir . "/xvar/ucc/ThumbnailImg/".$row['ImageFile']);
                $imgC->imageResize($size['0'], $size['1']);

                $UCC[] = $url."<img src='/xvar/ucc/ThumbnailImg/".$row['ImageFile']."' width='".$size['0']."' height='".$size['1']."' border='0' title='".$row['TITLE']."'></a>";
            } else {
                $size = @getimagesize($root_dir . "/main/images/main/sample_img.gif");
                $imgC->imageResize($size['0'], $size['1']);

                $UCC[] = $url."<img src='/main/images/main/sample_img.gif' width='".$width_img."' height='".$height_img."' border='0' title='".$row['TITLE']."'></a>";
            }
        }
        $RTIME[] = date("Y/m/d",$row['RTIME']);
    }
    $row[0] = $TITLE;
    $row[1] = $CONTENTS;
    $row[2] = $IMAGE;
    $row[3] = $UCC;
    $row[4] = $RTIME;

    return $row;
}
//게시판 메인 노출함수
function board_export6($board_id, $board_row, $title_limit="0", $use_img="0", $width_img="0", $height_img="0", $use_ucc="0", $width_ucc="0", $height_ucc="0", $use_contents="0", $contents_limit="0", $link_url) {
    $board_table = "xboard_board_".$board_id;

    //$sql    = " select * from $board_table where FLAG1='Y' and FLAG3='Y' and FLAG4='N' order by RTIME DESC, RANK DESC,  PARENT ASC, CHILD ASC  limit 0, $board_row ";

    $sql    = " select * from $board_table order by RTIME DESC, RANK DESC,  PARENT ASC, CHILD ASC  limit 0, $board_row ";

    $result = mysql_query($sql) or die (mysql_error());

    while($row=mysql_fetch_array($result)) {
        if($row['USE_SECRET']=="1") {
            //<img src='/board/images/key.gif' align='absmiddle' border=0>
            $url = "<a href='".$link_url."?v_url=/xboard/confirm.php?board_id=".$board_id."&no=".$row['BOARD_NO']."&mode=secret_view' title='".$row['TITLE']."'>";
            $bbs_url[] = $link_url."?v_url=/xboard/confirm.php?board_id=".$board_id."&no=".$row['BOARD_NO']."&mode=secret_view";
        } else {
            $url = "<a href='".$link_url."?v_url=/xboard/view.php?board_id=".$board_id."&no=".$row['BOARD_NO']."' title='".$row['TITLE']."'>";
            $bbs_url[] = $link_url."?v_url=/xboard/view.php?board_id=".$board_id."&no=".$row['BOARD_NO'];
        }
        if($row['DEPTH']*1 > 0)
            $url = "[Re]".$url;
        if($title_limit > 0) {
            $title_limit = 25;
            $ttl = $url."<span class='small'>".cutstr(strip_tags_attributes($row['TITLE']),$title_limit)."</span>";
        } else {
            $ttl = $url.$row['TITLE']."";
        }
        $newicon = ($row['RTIME'] > time() - (3600*24)) ? '1' : '0';
        if($newicon=='1')	$ttl .= "<img src='/xboard/icon/list_new.gif'  border='0' alt='new' />";

        $ttl .= "</a>";

        $TITLE[] = stripslashes($ttl);

        $bbs_title[] = cutstr(strip_tags_attributes($row['TITLE']),$title_limit);
//$bbs_title[] = mb_strimwidth($row[TITLE], "0", $title_limit, "...","EUC-KR");


        $contents = str_replace("&nbsp;","",strip_tags_attributes($row['CONTENTS']));

        if($use_contents > 0 && $contents_limit > 0) {
            $CONTENTS[] = $url.cutstr(stripcslashes($contents),$contents_limit)."</a>";
        } else {
            $CONTENTS[] = $url.stripcslashes($contents)."</a>";
        }

        $root_dir = (dirname(__FILE__) . '/../');

        if($use_img > 0) {
            $sql_img = " select FILE_NAME from xboard_file_table where BOARD_ID = '$board_id' and PARENT = '" . $row['BOARD_NO'] . "'  and REMARKS='T'";
            $row_img = mysql_fetch_array(mysql_query($sql_img));
//print_R($row_img);
            $imgC = new ImgClass($width_img,$height_img);
            if($row_img['FILE_NAME']!="" && file_exists($root_dir . "/xvar/DATA/".$board_id."/".$row_img['FILE_NAME'])){
                $size = @getimagesize($root_dir . "/xvar/DATA/".$board_id."/".$row_img['FILE_NAME']);
                $imgC->imageResize($size[0], $size[1]);

                $IMAGE[] = $url."<img src='/xvar/DATA/".$board_id."/".$row_img['FILE_NAME']."' width='".$size['0']."' height='".$size['1']."' border='0' title='".$row['TITLE']."'></a>";
                $img_src[] = "/xvar/DATA/".$board_id."/".$row_img['FILE_NAME'];

            }else{
                $size = @getimagesize($root_dir . "/main/make_img/main/photo_noimg.gif");
                $imgC->imageResize($size['0'], $size['1']);

                $IMAGE[] = $url."<img src='/main/make_img/main/photo_noimg.gif' width='".$size['0']."' height='".$size['1']."' border='0' title='".$row['TITLE']."'></a>";
                $img_src[] = "/main/make_img/main/photo_noimg.gif";
            }
        }

        if($use_ucc > 0) {
            $imgC = new ImgClass($width_ucc,$height_ucc);
            if($row['ImageFile']!="" && file_exists($root_dir . "/xvar/ucc/ThumbnailImg/".$row['ImageFile'])){
                $size = @getimagesize($root_dir . "/xvar/ucc/ThumbnailImg/".$row['ImageFile']);
                $imgC->imageResize($size['0'], $size['1']);

                $UCC[] = $url."<img src='/xvar/ucc/ThumbnailImg/".$row['ImageFile']."' width='".$size['0']."' height='".$size['1']."' border='0' title='".$row['TITLE']."'></a>";
                $img_src[] = "/main/images/main/sample_img.gif";
            } else {
                $size = @getimagesize($root_dir . "/main/make_img/main/photo_noimg.gif");
                $imgC->imageResize($size['0'], $size['1']);

                $UCC[] = $url."<img src='/main/make_img/main/photo_noimg.gif' width='".$width_img."' height='".$height_img."' border='0' title='".$row['TITLE']."'></a>";
                $img_src[] = "/main/make_img/main/photo_noimg.gif";
            }
        }
        $RTIME[] = date("Y-m-d",$row['RTIME']);
    }
    $row['0'] = $TITLE;
    $row['1'] = $CONTENTS;
    $row['2'] = $IMAGE;

    $row['3'] = $UCC;
    $row['4'] = $RTIME;
    $row['5'] = $bbs_title;
    $row['6'] = $bbs_url;
    $row['7'] = $img_src;


    return $row;
}
function board_export7($board_id, $board_row, $title_limit, $use_img="0", $width_img="0", $height_img="0", $use_ucc="0", $width_ucc="0", $height_ucc="0", $use_contents="0", $contents_limit="0", $link_url) {
    $board_table = "xboard_board_".$board_id;

    //$sql    = " select * from $board_table where FLAG1='Y' and FLAG3='Y' and FLAG4='N' order by RTIME DESC, RANK DESC,  PARENT ASC, CHILD ASC  limit 0, $board_row ";

    $sql    = " select * from $board_table order by RTIME DESC, RANK DESC,  PARENT ASC, CHILD ASC  limit 0, $board_row ";

    $result = mysql_query($sql) or die (mysql_error());

    while($row=mysql_fetch_array($result)) {
        if($row['USE_SECRET']=="1") {
            //<img src='/board/images/key.gif' align='absmiddle' border=0>
            $url = "<a href='".$link_url."?v_url=/xboard/confirm.php?board_id=".$board_id."&no=".$row['BOARD_NO']."&mode=secret_view' title='".$row['TITLE']."'>";
            $bbs_url[] = $link_url."?v_url=/xboard/confirm.php?board_id=".$board_id."&no=".$row['BOARD_NO']."&mode=secret_view";
        } else {
            $url = "<a href='".$link_url."?v_url=/xboard/view.php?board_id=".$board_id."&no=".$row['BOARD_NO']."' title='".$row['TITLE']."'>";
            $bbs_url[] = $link_url."?v_url=/xboard/view.php?board_id=".$board_id."&no=".$row['BOARD_NO'];
        }
        if($row['DEPTH']*1 > 0)
            $url = "[Re]".$url;
        if($title_limit > 0) {
            //alert(iconv("EUC-KR","UTF-8",$url));
            //alert(iconv("EUC-KR","UTF-8",cutstr(strip_tags_attributes($row['TITLE']),$title_limit)));
            //$ttl = $url."<span class='small'>".cutstr(strip_tags_attributes($row['TITLE']),$title_limit)."</span>";
            $ttl = "<span class='small'>".cutstr(strip_tags_attributes($row['TITLE']),$title_limit)."</span>";
            //alert(iconv("EUC-KR","UTF-8",$ttl));
        } else {
            $ttl = $url.$row['TITLE']."";
        }
        $newicon = ($row['RTIME'] > time() - (3600*24)) ? '1' : '0';
        if($newicon=='1')	$ttl .= "<img src='/xboard/icon/list_new.gif'  border='0' alt='new' />";

        $ttl .= "</a>";

        $TITLE[] = stripslashes($ttl);
        $URL[] = $url;
        //alert($url);
        //alert(sizeof($TITLE));
        //for($i = 0; $i < count($TITLE); $i++)
        //	alert($TITLE[0]);
        //iconv("EUC-KR","UTF-8",$url.$TITLE[0]));
        //}
        //$TITLE[] = $row['TITLE'];
        //alert(iconv("EUC-KR","UTF-8",cutstr(strip_tags_attributes($row['TITLE']),$title_limit)));
        $bbs_title[] = cutstr(strip_tags_attributes($row['TITLE']),$title_limit);
//$bbs_title[] = mb_strimwidth($row[TITLE], "0", $title_limit, "...","EUC-KR");


        $contents = str_replace("&nbsp;","",strip_tags_attributes($row['CONTENTS']));

        if($use_contents > 0 && $contents_limit > 0) {
            $CONTENTS[] = $url.cutstr(stripcslashes($contents),$contents_limit)."</a>";
        } else {
            $CONTENTS[] = $url.stripcslashes($contents)."</a>";
        }

        $root_dir = (dirname(__FILE__) . '/../');

        if($use_img > 0) {
            $sql_img = " select FILE_NAME from xboard_file_table where BOARD_ID = '$board_id' and PARENT = '" . $row['BOARD_NO'] . "'  and REMARKS='T'";
            $row_img = mysql_fetch_array(mysql_query($sql_img));
//print_R($row_img);
            $imgC = new ImgClass($width_img,$height_img);
            if($row_img['FILE_NAME']!="" && file_exists($root_dir . "/xvar/DATA/".$board_id."/".$row_img['FILE_NAME'])){
                $size = @getimagesize($root_dir . "/xvar/DATA/".$board_id."/".$row_img['FILE_NAME']);
                $imgC->imageResize($size[0], $size[1]);

                $IMAGE[] = $url."<img src='/xvar/DATA/".$board_id."/".$row_img['FILE_NAME']."' width='".$size['0']."' height='".$size['1']."' border='0' title='".$row['TITLE']."'></a>";
                $img_src[] = "/xvar/DATA/".$board_id."/".$row_img['FILE_NAME'];

            }else{
                $size = @getimagesize($root_dir . "/main/make_img/main/photo_noimg.gif");
                $imgC->imageResize($size['0'], $size['1']);

                $IMAGE[] = $url."<img src='/main/make_img/main/photo_noimg.gif' width='".$size['0']."' height='".$size['1']."' border='0' title='".$row['TITLE']."'></a>";
                $img_src[] = "/main/make_img/main/photo_noimg.gif";
            }
        }

        if($use_ucc > 0) {
            $imgC = new ImgClass($width_ucc,$height_ucc);
            if($row['ImageFile']!="" && file_exists($root_dir . "/xvar/ucc/ThumbnailImg/".$row['ImageFile'])){
                $size = @getimagesize($root_dir . "/xvar/ucc/ThumbnailImg/".$row['ImageFile']);
                $imgC->imageResize($size['0'], $size['1']);

                $UCC[] = $url."<img src='/xvar/ucc/ThumbnailImg/".$row['ImageFile']."' width='".$size['0']."' height='".$size['1']."' border='0' title='".$row['TITLE']."'></a>";
                $img_src[] = "/main/images/main/sample_img.gif";
            } else {
                $size = @getimagesize($root_dir . "/main/make_img/main/photo_noimg.gif");
                $imgC->imageResize($size['0'], $size['1']);

                $UCC[] = $url."<img src='/main/make_img/main/photo_noimg.gif' width='".$width_img."' height='".$height_img."' border='0' title='".$row['TITLE']."'></a>";
                $img_src[] = "/main/make_img/main/photo_noimg.gif";
            }
        }
        $RTIME[] = date("Y.m.d",$row['RTIME']);
    }
    //$row['0'] = $TITLE;
    $row['0'] = $TITLE;
    $row['1'] = $CONTENTS;
    $row['2'] = $IMAGE;

    $row['3'] = $UCC;
    $row['4'] = $RTIME;
    $row['5'] = $bbs_title;
    $row['6'] = $bbs_url;
    $row['7'] = $img_src;
    $row['8'] = $bbs_url;

    return $row;
}



// 페이지 컷◀ 1 [2][3][4][5] ▶
class PList
{
    var $g_pageName;		//설정파일명 ex) ****.php, OOOO.php

    var $g_pageCnt;			//현재페이지 번호
    var $g_offset;			//데이타베이스 시작 포인트 번호
    var $g_numRows;			//총게시물 수
    var $g_pageBlock;		//블럭당 페이지 수 ex) 5 : [1][2][3][4][5]
    var $g_limit;			//페이지당 출력 게시물 수
    var $g_search;			//검색 컬럼 ex)name,title,...
    var $g_searchstring;	//검색어

    var $g_option;			//추가 get 값  ex) &part=$part

    var $g_pniView;			//링크되지 않은 아이콘 표시 여부 ex) true,1 : 표시  false,0 : 미표시
    var $g_pIcon;			//이전 아이콘
    var $g_nIcon;			//다음 아이콘

    //
    // 생성자
    // CList( char* pagename, int pagecnt, int offset, int numrows, int pageblock, int limit, char* search, char* searchstring, char* option)
    // CList(페이지명, 현재페이지번호, DB시작offset, 총게시물수, 블럭당페이지수, 페이지당게시물수, 검색컬럼, 검색어, 추가get값)
    //
    function PList($pagename,$pagecnt,$offset,$numrows,$pageblock,$limit,$search,$searchstring,$option){

        $this->g_pageName		= $pagename;
        $this->g_pageCnt		= $pagecnt;
        $this->g_offset			= $offset;
        $this->g_numRows		= $numrows;
        $this->g_pageBlock		= $pageblock;
        $this->g_limit			= $limit;
        $this->g_search			= $search;
        $this->g_searchstring	= $searchstring;
        $this->g_option			= $option;
    }
    //
    // 아이콘 설정
    // putList( BOOL pniView, char* pre_icon, char* next_icon)
    // putList( 링크되지 않은 아이콘 표시 여부, 이전아이콘, 다음아이콘, 처음, 마지막, 한칸이전, 한칸다음
    //
    function putList($pniView,$pre_icon,$next_icon,$first_icon,$last_icon,$pre1_icon,$next1_icon){
		
        $this->g_pniView=$pniView;					//링크되지 않은 아이콘 표시 여부
        if(empty($pre_icon))	$this->g_pIcon="<<";			//이전 아이콘 설정
        else					$this->g_pIcon=$pre_icon;

        if(empty($next_icon))	$this->g_nIcon=">>";			//다음 아이콘 설정
        else					$this->g_nIcon=$next_icon;

        if(empty($first_icon))	$this->g_fIcon="처음으로";		//처음 아이콘 설정
        else					$this->g_fIcon=$first_icon;

        if(empty($last_icon))	$this->g_lIcon="마지막으로";	//마지막 아이콘 설정
        else					$this->g_lIcon=$last_icon;


        if(empty($pre1_icon))	$this->g_p1Icon="<";			//한칸이전 아이콘 설정
        else					$this->g_p1Icon=$pre1_icon;

        if(empty($next1_icon))	$this->g_n1Icon=">";			//한칸다음 아이콘 설정
        else					$this->g_n1Icon=$next1_icon;

        $this->pniPrint(); //화면 출력
    }
    //
    // 화면 출력
    //
    function pniPrint(){



        $chekpage=intval($this->g_numRows/($this->g_limit*$this->g_pageBlock)); //현제페이지 체크

        if($chekpage==$this->g_pageCnt){  //마지막 블럭일 경우....
            $pCnt=(intval($this->g_numRows/$this->g_limit)%$this->g_pageBlock)+1; //마지막 블럭 페이지수 계산
            if(!($this->g_numRows%($this->g_limit))){
                $pCnt--;
            }
        }else{
            $pCnt=$this->g_pageBlock;
        }


        $onstepcheck = ($this->g_offset/$this->g_limit)-($this->g_pageBlock*$this->g_pageCnt);

        $lastpagecnt = ceil(($this->g_numRows / $this->g_limit / $this->g_pageBlock)-1);
        $lastt = ceil($this->g_numRows / $this->g_limit);
        $lastoffset = ($lastt*$this->g_limit)-$this->g_limit;
        $lastletter_no=$this->g_numRows-(($lastt-1)*$this->g_limit);


        /*   처음   */
        $data="search=".$this->g_search."&searchstring=".$this->g_searchstring."&".$this->g_option;
        if($this->g_pniView)
            //echo "<a href=".$this->g_pageName."?".$data.">".$this->g_fIcon."</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";



            /*    이전   */
            if($this->g_pageCnt>0){				//이전페이지 있음
                $prepage=$this->g_pageCnt-1;	//이전블럭 시작페이지 설정.
                $pre_letter_no=$this->g_numRows-($this->g_pageCnt-1)*($this->g_pageBlock*$this->g_limit);	//이전블럭 시작글 번호 설정
                $data="pagecnt=".$prepage."&letter_no=".$pre_letter_no."&search=".$this->g_search."&searchstring=".$this->g_searchstring."&".$this->g_option;

                $pre_str ="<a href='".$this->g_pageName."?".$data."'>".$this->g_pIcon."</a>&nbsp;";

                echo "$pre_str"; 	//이전아이콘 링크
            }




        /*    1개 이전   */
        $p1offset=(($this->g_offset/$this->g_limit)*$this->g_limit)-$this->g_limit;
        $p1letter_no=$this->g_numRows-$p1offset;


        if($onstepcheck == 0)	$p1pageCnt = $this->g_pageCnt-1;
        else					$p1pageCnt = $this->g_pageCnt;

        $data="offset=".$p1offset."&letter_no=".$p1letter_no."&pagecnt=".$p1pageCnt."&search=".$this->g_search."&searchstring=".$this->g_searchstring."&".$this->g_option;

        if($p1offset >= 0){
            if($this->g_pniView) echo "&nbsp;<a href=".$this->g_pageName."?".$data.">".$this->g_p1Icon."</a>&nbsp;";
        }



        /* 1 [2][3][4][5] */
        $l=0;
        while($l<$pCnt){
            $loffset=$l*($this->g_limit)+($this->g_pageCnt*$this->g_limit*$this->g_pageBlock);	//시작글 지정
            $lnum=$l+( ($this->g_pageCnt)*$this->g_pageBlock)+1;					//페이지 번호 설정
            $cu_letter_no=$this->g_numRows-(($lnum-1)*$this->g_limit);		  		//시작글 번호 지정
            $en_str = "offset=".$loffset."&letter_no=".$cu_letter_no."&pagecnt=".$this->g_pageCnt;
            $en_str.= "&search=".$this->g_search."&searchstring=".$this->g_searchstring."&".$this->g_option;
            $data=$en_str;
            if($lnum==(($this->g_offset/$this->g_limit)+1))	{//현재 페이지 일 경우
                echo " <font size='2'><strong>$lnum</strong></font> ";
            }else{
                $mid_str = " <span class='nort'><a href='".$this->g_pageName."?".$data."'>".$lnum."</a></span> ";

                echo"$mid_str";
            }
            $l++;
        }




        /*    1개 다음   */
        $n1offset=(($this->g_offset/$this->g_limit)*$this->g_limit)+$this->g_limit;
        $n1letter_no=$this->g_numRows+$n1offset;


        if($onstepcheck == 9)	$n1pageCnt = $this->g_pageCnt+1;
        else					$n1pageCnt = $this->g_pageCnt;

        $data="offset=".$n1offset."&letter_no=".$n1letter_no."&pagecnt=".$n1pageCnt."&search=".$this->g_search."&searchstring=".$this->g_searchstring."&".$this->g_option;

        if($n1offset <= $lastoffset){
            if($this->g_pniView) echo "&nbsp;<a href=".$this->g_pageName."?".$data.">".$this->g_n1Icon."</a>&nbsp;";
        }




        /*    다음   */
        if($this->g_pageCnt!=$chekpage){		//다음페이지 있음
            echo "&nbsp;";
            $newpagecnt=$this->g_pageCnt+1;		//다음 블럭 시작페이지 설정
            $newt=$cu_letter_no-$this->g_limit;	//다음 블럭 시작글 번호 설정
            $data="pagecnt=".$newpagecnt."&letter_no=".$newt."&search=".$this->g_search."&searchstring=".$this->g_searchstring."&".$this->g_option;
            $next_str="<a href='".$this->g_pageName."?".$data."'>".$this->g_nIcon."</a>";

            echo $next_str;			//다음 아이콘 링크
        }


        /*   마지막   */
        $data="pagecnt=".$lastpagecnt."&letter_no=".$lastletter_no."&offset=".$lastoffset."&search=".$this->g_search."&searchstring=".$this->g_searchstring."&".$this->g_option;

        //if($this->g_pniView) echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='".$this->g_pageName."?".$data."&".$this->g_option."'>".$this->g_lIcon."</a>";

    }//function putList()
}//class



// 페이지 컷◀ 1 [2][3][4][5] ▶
class SList
{
    var $g_pageName;		//설정파일명 ex) ****.php, OOOO.php

    var $g_pageCnt;			//현재페이지 번호
    var $g_offset;			//데이타베이스 시작 포인트 번호
    var $g_numRows;			//총게시물 수
    var $g_pageBlock;		//블럭당 페이지 수 ex) 5 : [1][2][3][4][5]
    var $g_limit;			//페이지당 출력 게시물 수
    var $g_search;			//검색 컬럼 ex)name,title,...
    var $g_searchstring;	//검색어

    var $g_option;			//추가 get 값  ex) &part=$part

    var $g_pniView;			//링크되지 않은 아이콘 표시 여부 ex) true,1 : 표시  false,0 : 미표시
    var $g_pIcon;			//이전 아이콘
    var $g_nIcon;			//다음 아이콘

    //
    // 생성자
    // SList( char* pagename, int pagecnt, int offset, int numrows, int pageblock, int limit, char* search, char* searchstring, char* option)
    // SList(페이지명, 현재페이지번호, DB시작offset, 총게시물수, 블럭당페이지수, 페이지당게시물수, 검색컬럼, 검색어, 추가get값)
    //
    function SList($pagename,$pagecnt,$offset,$numrows,$pageblock,$limit,$search,$searchstring,$option){
        $this->g_pageName		= $pagename;
        $this->g_pageCnt		= $pagecnt;
        $this->g_offset			= $offset;
        $this->g_numRows		= $numrows;
        $this->g_pageBlock		= $pageblock;
        $this->g_limit			= $limit;
        $this->g_search			= $search;
        $this->g_searchstring	= $searchstring;
        $this->g_option			= $option;
    }
    //
    // 아이콘 설정
    // putList( BOOL pniView, char* pre_icon, char* next_icon)
    // putList( 링크되지 않은 아이콘 표시 여부, 이전아이콘, 다음아이콘
    //
    function putList($pniView,$pre_icon,$next_icon){
        $this->g_pniView=$pniView;					//링크되지 않은 아이콘 표시 여부
        if(empty($pre_icon))	$this->g_pIcon="[이전 ".$this->g_pageBlock."개]";			//이전 아이콘 설정
        else			$this->g_pIcon=$pre_icon;

        if(empty($next_icon))	$this->g_nIcon="[다음 ".$this->g_pageBlock."개]";			//다음 아이콘 설정
        else			$this->g_nIcon=$next_icon;

        $this->pniPrint(); //화면 출력
    }
    //
    // 화면 출력
    //
    function pniPrint(){
        /*    이전   */
        if($this->g_pageCnt>0){				//이전페이지 있음

            $prepage=$this->g_pageCnt-1;	//이전블럭 시작페이지 설정.
            $pre_letter_no=$this->g_numRows-($this->g_pageCnt-1)*($this->g_pageBlock*$this->g_limit);	//이전블럭 시작글 번호 설정
            $data="pagecnt=".$prepage."&letter_no=".$pre_letter_no."&search=".$this->g_search."&searchstring=".$this->g_searchstring;

            $pre_str ="<a href='".$this->g_pageName."?".$data;
            if(!empty($this->g_option))
                $pre_str.="&".$this->g_option;
            $pre_str.="'>".$this->g_pIcon."</a>&nbsp;&nbsp;&nbsp;";

            echo "$pre_str"; 	//이전아이콘 링크
        }else{					//이전페이지 없음
            if($this->g_pniView)//아이콘 표시
                $empty_pre_str = $this->g_pIcon."&nbsp;&nbsp;";
            else				//아이콘 비표시
                $empty_pre_str = "&nbsp;&nbsp;";

            echo "$empty_pre_str";
        }

        /* 1 [2][3][4][5] */
        $chekpage=intval($this->g_numRows/($this->g_limit*$this->g_pageBlock)); //현제페이지 체크

        if($chekpage==$this->g_pageCnt){  //마지막 블럭일 경우....
            $pCnt=(intval($this->g_numRows/$this->g_limit)%$this->g_pageBlock)+1; //마지막 블럭 페이지수 계산
            if(!($this->g_numRows%($this->g_limit))){
                $pCnt--;
            }
        }else{
            $pCnt=$this->g_pageBlock;
        }

        $l=0;
        while($l<$pCnt){
            $loffset=$l*($this->g_limit)+($this->g_pageCnt*$this->g_limit*$this->g_pageBlock);	//시작글 지정
            $lnum=$l+( ($this->g_pageCnt)*$this->g_pageBlock)+1;					//페이지 번호 설정
            $cu_letter_no=$this->g_numRows-(($lnum-1)*$this->g_limit);		  		//시작글 번호 지정
            $en_str = "offset=".$loffset."&letter_no=".$cu_letter_no."&pagecnt=".$this->g_pageCnt;
            $en_str.= "&search=".$this->g_search."&searchstring=".$this->g_searchstring;
            $data=$en_str;

            if($l != 0 ) echo " | ";

            if($lnum==(($this->g_offset/$this->g_limit)+1))	//현재 페이지 일 경우
                echo" <font size='2' color='#FF9900'><b>$lnum</b></font> ";
            else{
                $mid_str = " <a href='".$this->g_pageName."?".$data;
                if(!empty($this->g_option))
                    $mid_str.="&".$this->g_option;
                $mid_str.="'><font color='#FFFFFF'>".$lnum."</font></a> ";

                echo"$mid_str";
            }
            $l++;
        }

        /*    다음   */
        if($this->g_pageCnt!=$chekpage){		//다음페이지 있음
            echo "&nbsp;&nbsp;&nbsp;";
            $newpagecnt=$this->g_pageCnt+1;		//다음 블럭 시작페이지 설정
            $newt=$cu_letter_no-$this->g_limit;	//다음 블럭 시작글 번호 설정
            $data="pagecnt=".$newpagecnt."&letter_no=".$newt."&search=".$this->g_search."&searchstring=".$this->g_searchstring;
            $next_str="<a href='".$this->g_pageName."?".$data;
            if(!empty($this->g_option))
                $next_str.="&".$this->g_option;
            $next_str.="'>".$this->g_nIcon."</a>";

            echo $next_str;			//다음 아이콘 링크
        }else{						//다음페이지 없음
            if($this->g_pniView)	//아이콘 표시
                echo"&nbsp;&nbsp;".$this->g_nIcon;
            else					//아이콘 비표시
                echo"&nbsp;&nbsp;";
        }
    }//function putList()
}//class

function OnlyMsgView($Msg)
{
    echo"
		  <script language='javascript'>
		     alert('$Msg');
		  </script>
		  ";
}
//페이지 이동함수
function ReFresh($href)
{
    echo("
      <meta http-equiv='Refresh' content='0; URL=$href' Target='_parent'>

	");
}

function ReFresh_parent($href)
{
    echo("
	<meta http-equiv='Refresh' content='0; URL=$href' Target='_parent'>

	");

}

// mysql_real_escape_string 의 alias 기능을 한다.
function escape_trim($field)
{
    if ($field) {
        $str = mysql_real_escape_string(@trim($field));

        if(PHP_VERSION < '5.3.0'){
            $str = stripslashes($str);
        }

        return $str;
    }
}

/*
 * otep 추가
 * 2015-07-09
 * cms 권한관리 멤버구분 select box
 */
function select_dept_member_poistion($code,$type="")
{
    if($type == "num"){
        $member_positions = explode(",",$code);
    }

    //$str = "<select name='$field' id='$field'>";
    $sql = " Select * From xboard_position_table Where POSITION_CODE!=1  order by POSITION_CODE asc ";
    $result = sql_query($sql);
    for($i=0; $row=sql_fetch_array($result); $i++){
        $select = "";
        if($code != "" and $code == $row['code_nm']){
            $select = " selected='selected' ";
        }

        if($type=="num"){

            for($k=0; $k<count($member_positions); $k++){
                if($code != "" and $member_positions[$k] == $row['POSITION_CODE']){
                    $select = " selected='selected' ";
                }
            }

            $str .= "<option value=".$row['POSITION_CODE']." $select >";
        }else{
            $str .= "<option value=".$row['POSITION_CODE']." $select >";
        }

        $str .= $row['POSITION_NAME']."";
        $str .= "</option>";
    }

    return $str;
}

//학과/기관 이름  selectbox
function select_dept_name($code,$type="")
{
    if($type == "num"){
        $manager_group = explode(",",$code);
    }

    //$str = "<select name='$field' id='$field'>";
    $sql = " Select * From gigu_xtree Where DEPTH=3 order by PARENT asc, ORDER_NO asc ";
    $result = sql_query($sql);
    for($i=0; $row=sql_fetch_array($result); $i++){
        $select = "";
        if($code != "" and $code == $row['NAME']){
            $select = " selected='selected' ";
        }

        if($type=="num"){

            for($k=0; $k<count($manager_group); $k++){
                if($code != "" and $manager_group[$k] == $row['TREE_NO']){
                    $select = " selected='selected' ";
                }
            }

            $str .= "<option value=".$row['TREE_NO']." $select >";
        }else{
            $str .= "<option value=".$row['NAME']." $select >";
        }

        $str .= $row['NAME']."";
        $str .= "</option>";
    }

    $sql = " Select * From gigu_xtree Where PARENT = '29' and TREE_NO != '29' order by PARENT asc, ORDER_NO asc ";
    $result = sql_query($sql);
    for($i=0; $row=sql_fetch_array($result); $i++){
        $select = "";
        if($code != "" and $code == $row['NAME']){
            $select = " selected='selected' ";
        }

        if($type=="num"){
            for($k=0; $k<count($manager_group); $k++){
                if($code != "" and $manager_group[$k] == $row['TREE_NO']){
                    $select = " selected='selected' ";
                }
            }

            $str .= "<option value=".$row['TREE_NO']." $select >";
        }else{
            $str .= "<option value=".$row['NAME']." $select >";
        }

        $str .= $row[NAME]."";
        $str .= "</option>";
    }
    //$str .= "</select>";

    return $str;
}

//학과 이름  selectbox
function select_class_name($code,$type="")
{
    if($type == "num"){
        $manager_group = explode(",",$code);
    }

    //$str = "<select name='$field' id='$field'>";
    $sql = " Select * From gigu_xtree Where DEPTH=3 order by PARENT asc, ORDER_NO asc ";
    $result = sql_query($sql);
    for($i=0; $row=sql_fetch_array($result); $i++){
        $select = "";
        if($code != "" and $code == $row['NAME']){
            $select = " selected='selected' ";
        }

        if($type=="num"){

            for($k=0; $k<count($manager_group); $k++){
                if($code != "" and $manager_group[$k] == $row['TREE_NO']){
                    $select = " selected='selected' ";
                }
            }

            $str .= "<option value=".$row['TREE_NO']." $select >";
        }else{
            $str .= "<option value=".$row['NAME']." $select >";
        }

        $str .= $row['NAME']."";
        $str .= "</option>";
    }

    $sql = " Select * From gigu_xtree Where PARENT = '29' and TREE_NO != '29' order by PARENT asc, ORDER_NO asc ";
    $result = sql_query($sql);
    for($i=0; $row=sql_fetch_array($result); $i++){
        $select = "";
        if($code != "" and $code == $row['NAME']){
            $select = " selected='selected' ";
        }

        if($type=="num"){
            for($k=0; $k<count($manager_group); $k++){
                if($code != "" and $manager_group[$k] == $row['TREE_NO']){
                    $select = " selected='selected' ";
                }
            }

            $str .= "<option value=".$row['TREE_NO']." $select >";
        }else{
            $str .= "<option value=".$row['NAME']." $select >";
        }

        $str .= $row[NAME]."";
        $str .= "</option>";
    }
    //$str .= "</select>";

    return $str;
}

//학과/기관 이름  출력
function print_dept_name($code)
{
    $sql = " Select * From gigu_xtree Where TREE_NO = '$code'  ";
    $result = sql_fetch($sql);
    return $result['NAME'];
}

//교수채용 학과이름
function recruit_dept($way_part){
    $wr_major_list = "";
    $sql = " Select * From gigu_xtree Where TREE_NO in (".$way_part.") order by PARENT asc, ORDER_NO asc ";
    $result = sql_query($sql);
    $cnt = mysql_num_rows($result);
    $cnt = $cnt - 1;
    for($i=0; $row=sql_fetch_array($result); $i++){
        if($i < $cnt){ $comma = ", "; }else{ $comma = ""; }
        $wr_major_list .= $row[NAME].$comma;
    }
    return $wr_major_list;
}


//학과선택 셀렉트 박스
function dept_select($code, $fd_name){

    $str = "<select name='$fd_name' id='$fd_name'>";
    $sql = " select * from ipsi_dept_code where ipsi = '신입' order by hak_seq asc ";
    $result = sql_query($sql);
    for($i=0; $row=sql_fetch_array($result); $i++){
        if($i == 0){
            $str .= "<option value=''>";
            $str .= "선택";
            $str .= "</option>";
        }
        $select = "";
        if($code != "" and $code == $row['dept_code']){
            $select = " selected ";
        }
        $str .= "<option value=".$row['dept_code']." $select >";
        //$str .= $row['dept_name']." (".$row['part'].")";
        $str .= $row['dept_name'];
        $str .= "</option>";
    }
    $str .= "</select>";

    return $str;
}
//학과선택 셀렉트 박스
function dept_view($code){
    $sql = " select * from ipsi_dept_code where ipsi = '신입' and dept_code = '$code' order by idx asc ";
    $result = sql_fetch($sql);

    $str = $result['dept_name'];

    return $str;
}

function dept_view2($code){
    $sql = " select * from ipsi_dept_code where ipsi = '편입' and dept_code = '$code' order by idx asc ";
    //alert($sql);
    $result = sql_fetch($sql);

    $str = $result['dept_name'];

    return $str;
}

//수시모집구분
function susi_select($code, $fd_name){

    $str = "<select name='$fd_name' id='$fd_name'>";
    $sql = " select * from ipsi_period where ipsi_code != '' order by idx asc ";
    $result = sql_query($sql);
    for($i=0; $row=sql_fetch_array($result); $i++){
        if($i == 0){
            $str .= "<option value=''>";
            $str .= "선택";
            $str .= "</option>";
        }
        $select = "";
        if($code != "" and $code == $row['ipsi_code']){
            //if($row['ipsi_code']=="12"){
            $select = " selected ";
        }
        $str .= "<option value=".$row['ipsi_code']." $select >";
        $str .= $row['ipsi_name'];
        $str .= "</option>";
    }
    $str .= "</select>";

    return $str;
}



function susi_view($code){
    $sql = " select * from ipsi_period where ipsi_code = '$code' ";
    $result = sql_fetch($sql);
    $str = $result['ipsi_name'];
    if($result['ipsi_name'] == ""){
        $str = "재학생";
    }

    return $str;
}

function major_dept($cat){
    $sql = "SELECT * FROM ipsi_dept_code WHERE ipsi='".$cat."' ORDER BY idx asc";
    $result = sql_query($sql);

    $str = "";
    for($i=0; $row=sql_fetch_array($result); $i++){
        $str .= "<option value=\"".$row[dept_code]."\">".$row[dept_name]."</option>";
    }
    return $str;
}

function major_dept_select($code, $fd_name){

    $str = "<select name='$fd_name' id='$fd_name'>";
    $sql = " select * from ipsi_dept_code where ipsi = '편입' order by idx asc ";
    $result = sql_query($sql);
    for($i=0; $row=sql_fetch_array($result); $i++){
        if($i == 0){
            $str .= "<option value=''>";
            $str .= "선택";
            $str .= "</option>";
        }
        $select = "";
        if($code != "" and $code == $row['dept_code']){
            $select = " selected ";
        }
        $str .= "<option value=".$row['dept_code']." $select >";
//		$str .= $row['dept_name']." (".$row['part'].")";
        $str .= $row['dept_name'];
        $str .= "</option>";
    }
    $str .= "</select>";

    return $str;
}

function major_select($code, $fd_name){

    $str = "<select name='$fd_name'>";
    $sql = " select * from ipsi_major where ipsi_code != '' order by idx asc ";
    $result = sql_query($sql);
    for($i=0; $row=sql_fetch_array($result); $i++){
        $select = "";
        if($code != "" and $code == $row['ipsi_code']){
            $select = " selected ";
        }
        $str .= "<option value=".$row['ipsi_code']." $select >";
        $str .= $row['ipsi_name'];
        $str .= "</option>";
    }
    if($i == 0){
        $str .= "<option value='' >";
        $str .= "";
        $str .= "</option>";
    }
    $str .= "</select>";

    return $str;
}

function major_view($code){

    $sql = " select * from ipsi_major where ipsi_code = '$code' ";
    $result = sql_fetch($sql);
    $str = $result['ipsi_name'];
    if($result['ipsi_name'] == ""){
        $str = "";
    }

    return $str;
}


function dept_view_major($code){

    $sql = " select * from ipsi_dept_code where ipsi = '편입' and dept_code = '$code' order by idx asc ";
    $result = sql_fetch($sql);

    $str = $result['dept_name'];

    return $str;
}


function cms_view($cms_code, $type=""){

    $cms_txt = array();

    $CMSQue = " SELECT *, (select cms_name from cms_category where cms_id = substr(A.cms_id,1,4) ) as pcms_name  FROM cms_category A WHERE cms_id='".$cms_code."' ";
    $CMS = DBarray($CMSQue);

    $cms_txt['cms_name'] = $CMS['cms_name'];
    $cms_txt['cms_location'] = $CMS['cms_location'];
    $cms_txt['cms_tel'] = $CMS['cms_tel'];



    if(empty($CMS['idx'])){
        go_back("CMS 내용이 존재하지 않습니다.");
    }

    if($CMS['cms_img']){
        $CMSIMG = "<img src='/CMSEditor/image_main/".$CMS['cms_img']."' width='190' height='140' class='contents_info_img' alt='".$CMS['cms_name']." 사진' />";
    }else{
        $CMSIMG = "<img src='/CMSEditor/no_image.gif' width='190' height='140' class='contents_info_img' alt='".$CMS['cms_name']." 사진' />";
    }
    $cms_txt['CMSIMG'] = $CMSIMG;

    if($CMS['cms_homepage']){
        $CMSHomepagetxt = "http://".$CMS['cms_homepage'];
        $CMSHomepage = "<a href='http://".$CMS['cms_homepage']."' target='_balnk' title='새창열림' ><img src='/main/make_img/common/btn_homepage.png' alt='홈페이지' /></a>";
    }else{
        $CMSHomepagetxt = "#";
        $CMSHomepage = "&nbsp;";
    }
    $cms_txt['CMSHomepagetxt'] = $CMSHomepagetxt;
    $cms_txt['CMSHomepage'] = $CMSHomepage;

    if($CMS['cms_email']){
        $CMSEmail = "<a href='mailto:".$CMS['cms_email']."'>".$CMS['cms_email']."</a>";
    }else{
        $CMSEmail = "&nbsp;";
    }
    $cms_txt['CMSEmail'] = $CMSEmail;

    if($CMS['cms_date'] == "0000-00-00 00:00:00"){
        $cms_date = "";
    }else{
        $cms_date = substr($CMS['cms_date'],0,10);
    }
    $cms_txt['cms_date'] = $cms_date;

    $damdang_name = $CMS['damdang_name'];
    $cms_txt['damdang_name'] = $damdang_name;

    $damdang_tel = $CMS['damdang_tel'];
    $cms_txt['damdang_tel'] = $damdang_tel;

    $CMSTitle = array($CMS['cms_title1'],$CMS['cms_title2'],$CMS['cms_title3'],$CMS['cms_title4'],$CMS['cms_title5'],$CMS['cms_title6']);
    $cms_txt['CMSTitle'] = $CMSTitle;

    $CMS['cms_text1'] = open_tag_check($CMS['cms_text1']);
    $CMS['cms_text2'] = open_tag_check($CMS['cms_text2']);
    $CMS['cms_text3'] = open_tag_check($CMS['cms_text3']);
    $CMS['cms_text4'] = open_tag_check($CMS['cms_text4']);
    $CMS['cms_text5'] = open_tag_check($CMS['cms_text5']);
    $CMS['cms_text6'] = open_tag_check($CMS['cms_text6']);

    if($type == ""){

        echo $CMS['cms_text1'].$CMS['cms_text2'].$CMS['cms_text3'].$CMS['cms_text4'].$CMS['cms_text5'].$CMS['cms_text6'];


        //return $cms_txt;
    }elseif($type == "ch" or $type == "jp"){
        echo $CMS['cms_text_1'].$CMS['cms_text_2'].$CMS['cms_text_3'].$CMS['cms_text_4'].$CMS['cms_text_5'].$CMS['cms_text_6'];
    }else{
        $CMSContent = array($CMS['cms_text1'],$CMS['cms_text2'],$CMS['cms_text3'],$CMS['cms_text4'],$CMS['cms_text5'],$CMS['cms_text6']);
        for($i=0; $i < count($CMSContent); $i++){
            if($CMSContent[$i]) {
                if($CMSTitle[$i]){ echo "<h5 class=\"contents_title02 underline01 mb20\">".$CMSTitle[$i]."</h5>"; }
                echo $CMSContent[$i];
            }
        }
        //$cms_txt['CMSContent'] = $CMSContent;
        //return $cms_txt;
    }


}

function cms_view_utf8($cms_code){
    $CMSQue = " SELECT *, (select cms_name from cms_category where cms_id = substr(A.cms_id,1,4) ) as pcms_name  FROM cms_category A WHERE cms_id='".$cms_code."' ";

    $CMS = DBarray($CMSQue);

    $cms_txt = $CMS['cms_text1'].$CMS['cms_text2'].$CMS['cms_text3'].$CMS['cms_text4'].$CMS['cms_text5'].$CMS['cms_text6'];


    //$cms_txt = iconv("euc-kr","utf-8",$cms_txt);

    if($cms_txt == ""){
        $cms_txt = "No Contents";
    }

    return $cms_txt;
}


function link_dept($cat){
    //학과학부링크 1
    //부속기관 2

    if(substr(dirname($_SERVER['PHP_SELF']),0,5) =='/main' || substr(dirname($_SERVER['PHP_SELF']),0,7) =='/school' || substr(dirname($_SERVER['PHP_SELF']),0,5) =='/ipsi' || $_SERVER['HTTP_HOST']=='ipsi.chu.ac.kr'){
        //메인과 학부홈페이지면 그냥 pass
    }else{
        @mysql_query(" set names utf8 ");
    }
    $sql = " select * from link_table where lt_category = '".$cat."' order by lt_rank desc, lt_id asc ";

    $result = sql_query($sql);
    $str = "";
    if($cat=="1"){$depart_url="http://www.chu.ac.kr";}
    else{$depart_url="";}
    for($i=0; $row=sql_fetch_array($result); $i++){

        $str .= "<option value=\"".$depart_url.$row['lt_url']."\">".$row['lt_name']."</option>";
    }
    if($i==0){
        $str = "<option value=\"\" ></option>";
    }

    echo $str;

}





function open_tag_check($str){
    $contents = $str;

    $contents = str_replace("<BR>","<br/>",$contents);
    $contents = str_replace("<BR >","<br/>",$contents);
    $contents = str_replace("<br>","<br/>",$contents);
    $contents = str_replace("<br >","<br/>",$contents);
    $contents = @preg_replace("/(\<br )([^\>]*)(\>)/i", "\\1 \\2 /\\3", $contents);
    $contents = @preg_replace("/(\<img )([^\>]*)(\>)/i", "\\1 \\2 /\\3", $contents);
    $contents = str_replace("//>","/>",$contents);

    return $contents;
}


/*
 * author : otep
 * description : 셀렉트박스 태그형태를 만듬
 * name
 * option : class나 style 등 기타 옵션값
 * codeId : 코드 대분류
 * value : 선택값
 *
 */
function make_selectbox( $name, $option, $master_code, $value, $default)
{

    $sql    = " select detail.code, detail.code_name from master_code master INNER JOIN  code_detail detail  
    ON master.master_idx = detail.master_idx
    WHERE master.del_yn='N' AND detail.use_yn='Y' AND master.code='$master_code' order by detail.order_no asc";

    $result = mysql_query($sql) or die (mysql_error());

    $tag= "<select name=" .$name." id=" .$name."  $option>";
    if($default=='Y')  $tag= $tag. " <option value=''>------선택하세요------</option>";
    while($row=mysql_fetch_array($result)) {
        if($value==$row["code"]) {
            $tag= $tag. "<option value='" . $row["code"] ."' selected>" . $row["code_name"] . "</option>";
        }else{
            $tag= $tag."<option value='" . $row["code"]  ."'>" . $row["code_name"] . "</option>";
        }

    }
    $tag= $tag. "</select>";

    print $tag;
}

/*
 * author : otep
 * description : 라디오 버튼 태그형태를 만듬
 * name
 * option : class나 style 등 기타 옵션값
 * codeId : 코드 대분류
 * value : 선택값
 *
 */
function make_radio( $name, $option, $master_code, $value)
{

    $sql    = " select detail.code, detail.code_name from master_code master INNER JOIN  code_detail detail  
    ON master.master_idx = detail.master_idx
    WHERE master.del_yn='N' AND detail.use_yn='Y' AND master.code='$master_code' order by detail.order_no asc";
    $result = mysql_query($sql) or die (mysql_error());

    $tag ='';
    $num = 1;
    while($row=mysql_fetch_array($result)) {
        if($value==$row["code"]) {
            $tag= $tag. "<input type='radio' name='". $name . "' id='". $name.$num . "'  ".$option . " value=". $row["code"] ."' checked><label for='". $name.$num . "'>" . $row["code_name"] . "</label>";
        }else{
            $tag= $tag. "<input type='radio' name='". $name . "' id='". $name.$num . "'  ".$option . " value=". $row["code"] ."' ><label for='". $name.$num ."'>" . $row["code_name"] . "</label>";
        }
        $num++;
    }

    print $tag;
}


function make_radio_member_position( $name, $option, $value)
{
    $sql    = " select * from xboard_position_table  where POSITION_CODE != 1   order by POSITION_CODE asc";
    $result = mysql_query($sql) or die (mysql_error());

    $tag ='';
    $num = 1;
    while($row=mysql_fetch_array($result)) {
        if($value==$row["POSITION_CODE"]) {
            $tag= $tag. "<input type='radio' name='". $name . "' id='". $name.$num . "'  ".$option . " value=". $row["POSITION_CODE"] ."' checked><label for='". $name.$num . "'>" . $row["POSITION_NAME"] . "</label>";
        }else{
            $tag= $tag. "<input type='radio' name='". $name . "' id='". $name.$num . "'  ".$option . " value=". $row["POSITION_CODE"] ."' ><label for='". $name.$num ."'>" . $row["POSITION_NAME"] . "</label>";
        }
        $tag=$tag."&nbsp;";
        $num++;
    }

    print $tag;
}


function get_code_detail($master_code, $code){
    $sql    = " select detail.code_name from master_code master INNER JOIN  code_detail detail  
    ON master.master_idx = detail.master_idx
    where master.del_yn='N' AND detail.use_yn='Y' AND master.code='$master_code' AND detail.code='$code'";
    $result = mysql_query($sql) or die (mysql_error());

    while($row=mysql_fetch_array($result)) {
        print $row["code_name"];

    }
}


//첨부파일 다운로드
//2015-07-10 otep
//attach_file 테이블 추가함
function get_attach_file_info($file_seq){
    $sql    = "  select * from ATTACH_FILE WHERE file_seq='$file_seq'";
    $result = mysql_query($sql) or die (mysql_error());

    while($row=mysql_fetch_array($result)) {
        print "<a href='/conf/download.php?file_seq=".$row['file_seq']."'>".$row['file_name']."[".$row['file_size']."byte]</a>";

    }
}

function get_attach_file_row($file_seq){
    $sql    = "  select * from ATTACH_FILE WHERE file_seq='$file_seq'";
    $result = mysql_query($sql) or die (mysql_error());
    return mysql_fetch_array($result);
}


//front menu 생성
//2depth 까지 지원

function make_menu($parent_no='') {
    global $menuTable, $idx, $site_no;

    if($parent_no == '') {
        $sql = "SELECT * FROM ".$menuTable." WHERE SITE_NO=".$site_no." AND DEPTH=1 AND MENU_ON='Y' ORDER BY ORDER_NO ASC";

    } else {

        $sql = "Select * From $menuTable  Where SITE_NO=".$site_no." AND  parent=$parent_no  AND DEPTH=2 AND MENU_ON='Y' order by ORDER_NO asc";
    }
    $res = DBquery($sql);
    $numrows=@mysql_num_rows($res);

    if($numrows>0) {

        for ($i = 0; $row = @mysql_fetch_array($res); $i++) {
            $top_menu_function = $row['MENU_FUNCTION'];
            if ($top_menu_function == 'contents') {
                //$link = "/ipsi/contents/contentsView.php?menu=" . $row['TREE_NO']; // 원래코드
                //2015-10-23 배지열
                if(strpos($row['CONTENTS'],"guide")){
                    $link ="/ipsi/contents/contentsView.php?menu=".$row['TREE_NO']."&con=".$row['CONTENTS'];
                } else if(strpos($row['CONTENTS'],"sub05")){
                    $link = $row['CONTENTS'];
                } else{
                    $link ="/ipsi/contents/contentsView.php?menu=".$row['TREE_NO'];
                }
            } else if ($top_menu_function == 'board') {
                $link = "/ipsi/board/list.php?menu=" . $row['TREE_NO'] . "&board_id=" . $row['BOARD_ID']."&re=1";
            } else if ($top_menu_function == 'depth') {
                $link = $row['CONTENTS'];
            } else  if($top_menu_function=='link'){
                $link =$row['CONTENTS'];
            } else {
                $link = $row['CONTENTS'] . getP($row['CONTENTS']) . "menu=" . $row['TREE_NO'];
            }

            if (!empty($row['LINK_TARGET'])) {
                $target = "target=" . $row['LINK_TARGET'];
            } else {
                $target = "";
            }

            if($row['NAME']=='수험생 정보(연락처) 수정'){
                $name="수험생 정보<span class=span-br></span>(연락처) 수정";
            }else if($row['NAME']=="면접대상확인/면접고사 안내"){
                $name="면접대상확인/<span class=span-br></span>면접고사 안내";
            }else if($row['NAME']=="합격자조회 및 등록금고지서 출력"){
                $name="합격자조회 및/<span class=span-br></span>등록금고지서 출력";
            }else if ($row['NAME'] == "등록금(예치금) 납부확인"){		// 2015.12.04 추가. 손창인
                $name="등록금(예치금)<span class=span-br></span>납부확인";
            }else{
                $name=$row['NAME'];
            }


            $top_menu[] = array(
                'tree_no' => $row['TREE_NO'],
                'name' => $name,
                'link' => $link,
                'target' => $target
            );
        }
    }
    return $top_menu;

}

//otep
//관리자- 사용자 메뉴 리스트
//트리구조로 나타낸다.
function make_front_menu_admin($parent_no='') {
    global $adb, $menuTable, $site_no;
    if($parent_no=='') {
        $sql = "SELECT b.* ,c.manager_group, c.member_positions, (SELECT count(*) FROM front_menu_xtree a WHERE a.PARENT=b.TREE_NO and a.DEPTH > b.DEPTH)  as node_count FROM ".$menuTable." b ";
        $sql = $sql . " LEFT OUTER JOIN cms_contents_auth c on c.tree_no = b.TREE_NO ";
        //최고관리자가 아닌 경우 게시판을 제외한 권한이 있는  메뉴리스트들을 보여준다.
        //$sql = $sql. " WHERE b.SITE_NO=".$site_no." AND b.DEPTH=1 AND b.MENU_ON='Y' ";
        // 개인정보 등 기타 메뉴에 대한 항목 관리를 위해 추가 ( By.Son 2016.05.09 )
        $sql = $sql. " WHERE b.SITE_NO=".$site_no." AND b.DEPTH=1 ";
        if($_SESSION['__MEMBER_POSITION__']!=1)
            $sql = $sql."  AND ( c.manager_group like '%".$_SESSION['__MEMBER_DEPT__']."%' OR c.member_positions like '%".$_SESSION['__MEMBER_POSITION__']."%' ) ";
        $sql = $sql. " ORDER BY b.ORDER_NO ASC ";
    } else {
        $sql = "Select b.*, c.manager_group, c.member_positions, (SELECT count(*) FROM front_menu_xtree a WHERE  a.PARENT=b.TREE_NO and a.DEPTH > b.DEPTH)  as node_count From ".$menuTable." b ";
        $sql = $sql . " LEFT OUTER JOIN cms_contents_auth c on c.tree_no = b.TREE_NO ";
        $sql = $sql. "Where b.SITE_NO=".$site_no." AND  b.parent=$parent_no AND b.DEPTH!=1 AND b.MENU_ON='Y'";
        //최고관리자가 아닌 경우 게시판을 제외한 권한이 있는  메뉴리스트들을 보여준다.
        if($_SESSION['__MEMBER_POSITION__']!=1)
            $sql = $sql." AND ( c.manager_group like '%".$_SESSION['__MEMBER_DEPT__']."%' OR c.member_positions like '%".$_SESSION['__MEMBER_POSITION__']."%' ) ";

        $sql= $sql. "order by b.ORDER_NO asc";
    }

    $pg_result=DBquery($sql);
    $numrows=@mysql_num_rows($pg_result);

    $res = $adb->query($sql);

    for($i=0; $row=mysql_fetch_array($pg_result); $i++) {
        $menu[] = array(
            'no'		=> $row['TREE_NO'],
            'parent'	=> $row['PARENT'],
            'depth'		=> $row['DEPTH'],
            'name'		=> $row['NAME'],
            'contents'	=> $row['CONTENTS'],
            'link_target'	=> $row['LINK_TARGET'],
            'node_count'	=> $row['node_count']
        );

        if($row['MENU_FUNCTION']=='contents') {
            // $link = "edit_contents.php?tree_no=" . $row['TREE_NO'];
            $link = "edit_contents.php?tree_no=" . $row['TREE_NO']."&site_no=".$site_no;
        }else if($row['MENU_FUNCTION']==='board') {
            $link="/xboard/xboard.php?cms=admin&board_id=".$row['BOARD_ID'];
        }else {
            $link="#none";
        }

        echo "<li><a href=".$link." onclick=go_page(this)>".$row['NAME']."<span>[".$row['MENU_FUNCTION']."]</span></a>";



        echo "<div class=btn_area>";
        if($row['MENU_FUNCTION']=='contents'||$row['MENU_FUNCTION']=='board'){
            echo "<a href=".$link." onclick=go_page(this)><img src=/conf/img/btn_modify.gif alt=수정 ></a>";
        }else{
            echo "<a href=/xtree/xtree.php?cmd=tree_in&no=".$row['TREE_NO']."&tree_id=FRONT_MENU&site_no=".$site_no."&p=c onclick=go_page(this) class=btn><img src=/conf/img/btn_modify.gif alt=수정 ></a>";
        }

        //수정
        echo "<a href=/xtree/xtree.php?cmd=tree_in&no=".$row['TREE_NO']."&tree_id=FRONT_MENU&site_no=".$site_no."&p=c onclick=go_page(this) class=btn><img src=/conf/img/btn_menu_modify.gif alt=메뉴수정 ></a>";



        //권한관리
        if($_SESSION['__MEMBER_POSITION__']==1) {
            /*
            if ($row['MENU_FUNCTION'] != 'board') {
                if ($row['manager_group'] != null || $row['member_positions'] != null) {
                    $auth_check = "_on";
                } else {
                    $auth_check = "";
                };
                echo "<a href=#none onclick=config_auth('" . $row[TREE_NO] . "') class=btn> <img src='/conf/img/btn_md" . $auth_check . ".gif'></a>";
            } else if ($row['MENU_FUNCTION'] === 'board') {
                echo "<a href=/xboard/admin.php?board_id=" . $row['BOARD_ID'] . "&cmd=perm&mode=cms&site_no=" . $site_no . " class=btn><img src='/conf/img/btn_md_on.gif'></a>";
            }*/
            if ($row['manager_group'] != null || $row['member_positions'] != null) {
                $auth_check = "_on";
            } else {
                $auth_check = "";
            };
            echo "<a href=#none onclick=config_auth('" . $row[TREE_NO] . "') class=btn> <img src='/conf/img/btn_md" . $auth_check . ".gif'></a>";
        }
        echo "</div>";

        if($row['node_count']>0){
            echo "<ul>";
            $return_array = make_front_menu_admin($row['TREE_NO']);
            if(is_array($return_array)) $menu = array_merge($menu, $return_array);
            echo "</ul>";
        }

        echo "</li>";
    }

    return $menu;

}

/*
 * 최고관리자가 아닌 운영자가 접속 했을때
 * 권한이 있는 메뉴만 보여준다.
 */
function make_front_menu($parent_no='',$depth) {
    global $adb, $menuTable, $site_no;
    if($depth=='') $depth=1;
    if($parent_no=='') {
        $sql = "SELECT b.* ,c.manager_group, c.member_positions, (SELECT count(*) FROM front_menu_xtree a WHERE a.PARENT=b.TREE_NO and a.DEPTH > b.DEPTH)  as node_count FROM ".$menuTable." b ";
        $sql = $sql . " LEFT OUTER JOIN cms_contents_auth c on c.tree_no = b.TREE_NO ";
        $sql = $sql. " WHERE b.SITE_NO=".$site_no." AND b.DEPTH=".$depth." AND b.MENU_ON='Y' ";
        //최고관리자가 아닌 경우 게시판을 제외한 권한이 있는  메뉴리스트들을 보여준다.
        if($_SESSION['__MEMBER_POSITION__']!=1)
            $sql = $sql." AND b.menu_function != 'board' AND ( c.manager_group like '%".$_SESSION['__MEMBER_DEPT__']."%' OR c.member_positions like '%".$_SESSION['__MEMBER_POSITION__']."%' ) ";
        $sql = $sql. "ORDER BY b.ORDER_NO ASC";

    } else {
        $sql = "Select b.*, c.manager_group, c.member_positions, (SELECT count(*) FROM front_menu_xtree a WHERE  a.PARENT=b.TREE_NO and a.DEPTH > b.DEPTH)  as node_count From ".$menuTable." b ";
        $sql = $sql . " LEFT OUTER JOIN cms_contents_auth c on c.tree_no = b.TREE_NO ";
        $sql = $sql. "Where b.SITE_NO=".$site_no." AND  b.parent=$parent_no AND b.DEPTH!=1 AND b.MENU_ON='Y'";
        //최고관리자가 아닌 경우 게시판을 제외한 권한이 있는  메뉴리스트들을 보여준다.
        if($_SESSION['__MEMBER_POSITION__']!=1)
            $sql = $sql." AND b.menu_function != 'board' AND ( c.manager_group like '%".$_SESSION['__MEMBER_DEPT__']."%' OR c.member_positions like '%".$_SESSION['__MEMBER_POSITION__']."%' ) ";
        $sql= $sql. "order by b.ORDER_NO asc";
    }

    $pg_result=DBquery($sql);
    $numrows=@mysql_num_rows($pg_result);

    //최고관리자가 아닌데 depth1이 설정안되어있으면...2부터 검색
    if($depth==1 && $_SESSION['__MEMBER_POSITION__']!=1){
        make_front_menu('',2);
    }
    $res = $adb->query($sql);

    for($i=0; $row=mysql_fetch_array($pg_result); $i++) {


        $menu[] = array(
            'no'		=> $row['TREE_NO'],
            'parent'	=> $row['PARENT'],
            'depth'		=> $row['DEPTH'],
            'name'		=> $row['NAME'],
            'contents'	=> $row['CONTENTS'],
            'link_target'	=> $row['LINK_TARGET'],
            'node_count'	=> $row['node_count']
        );

        if($row['MENU_FUNCTION']=='contents') {
            $link = "edit_contents.php?tree_no=" . $row['TREE_NO'];
        }else if($row['MENU_FUNCTION']==='board') {
            $link="/xboard/xboard.php?cms=admin&board_id=".$row['BOARD_ID'];
        }else {
            $link="#none";
        }

        echo "<li><a href=".$link." onclick=go_page(this)>".$row['NAME']."<span>[".$row['MENU_FUNCTION']."]</span></a>";


        echo "<div class=btn_area>";
        if($row['MENU_FUNCTION']=='contents'||$row['MENU_FUNCTION']=='board'){
            echo "<a href=".$link." onclick=go_page(this)><img src=/conf/img/btn_modify.gif alt=수정 ></a>";
        }else{
            echo "<a href=/xtree/xtree.php?cmd=tree_in&no=".$row['TREE_NO']."&tree_id=FRONT_MENU&site_no=".$site_no."&p=c onclick=go_page(this) class=btn><img src=/conf/img/btn_modify.gif alt=수정 ></a>";
        }

        //수정
        echo "<a href=/xtree/xtree.php?cmd=tree_in&no=".$row['TREE_NO']."&tree_id=FRONT_MENU&site_no=".$site_no."&p=c onclick=go_page(this) class=btn><img src=/conf/img/btn_menu_modify.gif alt=메뉴수정 ></a>";


        //권한관리
        if($_SESSION['__MEMBER_POSITION__']==1) {
            /*
            if ($row['MENU_FUNCTION'] != 'board') {
                if ($row['manager_group'] != null || $row['member_positions'] != null) {
                    $auth_check = "_on";
                } else {
                    $auth_check = "";
                };
                echo "<a href=#none onclick=config_auth('" . $row[TREE_NO] . "') class=btn> <img src='/conf/img/btn_md" . $auth_check . ".gif'></a>";
            } else if ($row['MENU_FUNCTION'] === 'board') {
                echo "<a href=/xboard/admin.php?board_id=" . $row['BOARD_ID'] . "&cmd=perm&mode=cms&site_no=" . $site_no . " class=btn><img src='/conf/img/btn_md_on.gif'></a>";
            }
            */
            if ($row['manager_group'] != null || $row['member_positions'] != null) {
                $auth_check = "_on";
            } else {
                $auth_check = "";
            };
            echo "<a href=#none onclick=config_auth('" . $row[TREE_NO] . "') class=btn> <img src='/conf/img/btn_md" . $auth_check . ".gif'></a>";
        }
        echo "</div>";

        if($row['node_count']>0){
            echo "<ul>";
            $return_array = make_front_menu($row['TREE_NO'],'');
            if(is_array($return_array)) $menu = array_merge($menu, $return_array);
            echo "</ul>";
        }

        echo "</li>";
    }

    return $menu;

}


//my sql md5 변환
function sql_password($value)
{
// mysql 4.0x 이하 버전에서는 password() 함수의 결과가 16bytes
// mysql 4.1x 이상 버전에서는 password() 함수의 결과가 41bytes
    $row = sql_fetch(" select password('$value') as pass ");
    return $row[pass];
}

function formatSizeUnits($bytes)
{
    if ($bytes >= 1073741824)
    {
        $bytes = number_format($bytes / 1073741824, 2) . ' GB';
    }
    elseif ($bytes >= 1048576)
    {
        $bytes = number_format($bytes / 1048576, 2) . ' MB';
    }
    elseif ($bytes >= 1024)
    {
        $bytes = number_format($bytes / 1024, 2) . ' KB';
    }
    elseif ($bytes > 1)
    {
        $bytes = $bytes . ' bytes';
    }
    elseif ($bytes == 1)
    {
        $bytes = $bytes . ' byte';
    }
    else
    {
        $bytes = '0 bytes';
    }

    return $bytes;
}

function injection_filer($value){
	$value = preg_replace('/([\x00-\x08\x0b-\x0c\x0e-\x19])/', '',$value);
	$value = preg_replace("/union[^\x21-\x7e]/i", "union&nbsp", $value);
	$value = preg_replace("/select[^\x21-\x7e]/i", "select&nbsp", $value);
	$value = preg_replace("/insert[^\x22-\x7e]/i", "insert&nbsp", $value);
	$value = preg_replace("/drop[^\x21-\x7e]/i", "drop&nbsp", $value);
	$value = preg_replace("/update[^\x21-\x7e]/i", "update&nbsp", $value);
	$value = preg_replace("/and[^\x21-\x7e]/i", "and&nbsp", $value);
	$value = preg_replace("/or[^\x21-\x7e]/i", "or&nbsp", $value);
	$value = preg_replace("/if[^\x21-\x7e]/i", "if&nbsp", $value);
	$value = preg_replace("/[^\x21-\x7e]union/i", "&nbspunion", $value);
	$value = preg_replace("/[^\x21-\x7e]select/i", "&nbspselect", $value);
	$value = preg_replace("/[^\x21-\x7e]insert/i", "&nbspinsert", $value);
	$value = preg_replace("/[^\x21-\x7e]drop/i", "&nbspdrop", $value);
	$value = preg_replace("/[^\x21-\x7e]update/i", "&nbspupdate", $value);
	$value = preg_replace("/[^\x21-\x7e]and/i", "&nbspand", $value);
	$value = preg_replace("/[^\x21-\x7e]or/i", "&nbspor", $value);
	$value = preg_replace("/[^\x21-\x7e]if/i", "&nbspif", $value);
	$value = preg_replace("/[\+%\\;\^~|\!\?\*$#\[\]\{\}]/i", "", $value);
	$value = preg_replace("/</", "&lt", $value);
	$value = preg_replace("/>/", "&gt", $value);
	$value = preg_replace("/'/i", "&#39", $value);
	$value = preg_replace("/`/i", "&#96", $value);
	$value = preg_replace('/"/', "&quot", $value);
	$value = preg_replace("/--/i", "&#95;&#95;", $value);
	 
	$value = preg_replace("/&/", "&amp", $value);
	$value = preg_replace("/&ampamp/", "&amp", $value);
	$value = preg_replace("/&ampnbsp/", "&nbsp", $value);
	$value = preg_replace("/&amplt/", "&lt", $value);
	$value = preg_replace("/&ampgt/", "&gt", $value);
	$value = preg_replace("/&amp#39/", "&#39", $value);
	$value = preg_replace("/&amp#96/", "&#96", $value);
	$value = preg_replace("/&ampquot/", "&quot", $value);
	$value = preg_replace("/&amp#95/", "&#95", $value);

	return $value;
}
?>
