<?php

define("__AF__", true);
include("../../af_common.php");

$CA = $_REQUEST['CA'];
$CB = $_REQUEST['CB'];
$DC = $_REQUEST['DC'];

if(strpos($_REQUEST['DL'], 'hscorp.com/page/board') == true) {
    $DLARR = explode("?", $DL);
    $DLARR1 = explode("&", $DLARR[1]);
    $DL = $DLARR[0]."?".$DLARR1[0]."&".$DLARR1[1]."&".$DLARR1[2];
} else {
    $DL = $_REQUEST['DL'];
}
$DR = $_REQUEST['DR'];
$DT = $_REQUEST['DT'];
$SC = $_REQUEST['SC'];
$SW = $_REQUEST['SW'];
$TI = $_REQUEST['TI'];
$UN = $_REQUEST['UN'];

$sql_gener = " lt_CA = '$CA',
					lt_CB = '$CB',
					lt_DC = '$DC',
					lt_DL = '$DL',
					lt_DR = '$DR',
					lt_DT = '$DT',
					lt_SC = '$SC',
					lt_SW = '$SW',
					lt_TI = '$TI',
					lt_UN = '$UN',
					lt_wdate = '$now' ";

$sql = " insert into log set $sql_gener ";
$result = mysql_query($sql) or die(mysql_error());

//페이지뷰
$now_hour = date("G");
$sql_gener_001 = "pt_".$now_hour." = pt_".$now_hour." + 1";

$sql_001 = " select pt_num from page_view where pt_un = '".$UN."' and pt_date = '$curdate' ";
$result_001 = mysql_query($sql_001) or die(mysql_error());

if(mysql_num_rows($result_001) < 1) {
    $sql_001_in = " insert into page_view set pt_un = '".$UN."', pt_date = '$curdate', $sql_gener_001 ";
} else {
    $sql_001_in = " update page_view set $sql_gener_001 where pt_un = '".$UN."' and pt_date = '$curdate' ";
}
$result_001_in = mysql_query($sql_001_in) or die(mysql_error());

//방문자수
$now_hour = date("G");
$sql_gener_002 = "vc_".$now_hour." = vc_".$now_hour." + 1";

$sql_002 = " select vc_num from visiter_count where vc_un = '".$UN."' and vc_date = '$curdate' ";
$result_002 = mysql_query($sql_002) or die(mysql_error());

if(mysql_num_rows($result_002) < 1) {
    $sql_002_in = " insert into visiter_count set vc_date = '$curdate', vc_un = '".$UN."', $sql_gener_002 ";
} else {
    $sql_002_in = " update visiter_count set $sql_gener_002 where vc_un = '".$UN."' and vc_date = '$curdate' ";
}
$result_002_in = mysql_query($sql_002_in) or die(mysql_error());

//인기페이지
$sql_003 = " select ip_num from interest_page where ip_un = '".$UN."' and ip_date = '$curdate' and ip_url like '%".$DL."%' ";
$result_003 = mysql_query($sql_003) or die(mysql_error());

if(mysql_num_rows($result_003) < 1) {
    $sql_003_in = " insert into interest_page set ip_date = '$curdate', ip_url = '".$DL."', ip_un = '".$UN."', ip_hits = ip_hits + 1 ";
} else {
    $sql_003_in = " update interest_page set ip_hits = ip_hits + 1 where ip_un = '".$UN."' and ip_date = '$curdate' and ip_url like '%".$DL."%' ";
}
$result_003_in = mysql_query($sql_003_in) or die(mysql_error());

//접속아이피
$sql_004 = " select vi_num from visiter_ip where vi_un = '".$UN."' and vi_date = '$curdate' and vi_ip like '%".$REMOTE_ADDR."%' ";
$result_004 = mysql_query($sql_004) or die(mysql_error());

if(mysql_num_rows($result_004) < 1) {
    $sql_004_in = " insert into visiter_ip set vi_date = '$curdate', vi_un = '".$UN."', vi_ip = '".$REMOTE_ADDR."', vi_hits = vi_hits + 1 ";
} else {
    $sql_004_in = " update visiter_ip set vi_hits = vi_hits + 1 where vi_un = '".$UN."' and vi_date = '$curdate' and vi_ip like '%".$REMOTE_ADDR."%' ";
}
$result_004_in = mysql_query($sql_004_in) or die(mysql_error());

//참조링크페이지
$sql_005 = " select rp_num from referrer_page where rp_un = '".$UN."' and rp_date = '$curdate' and rp_url like '%".$DR."%' ";
$result_005 = mysql_query($sql_005) or die(mysql_error());

if(mysql_num_rows($result_005) < 1) {
    $sql_005_in = " insert into referrer_page set rp_date = '$curdate', rp_url = '".$DR."', rp_un = '".$UN."', rp_hits = rp_hits + 1 ";
} else {
    $sql_005_in = " update referrer_page set rp_hits = rp_hits + 1 where rp_un = '".$UN."' and rp_date = '$curdate' and rp_url like '%".$DR."%' ";
}
$result_005_in = mysql_query($sql_005_in) or die(mysql_error());

//검색엔진
if(eregi('daum.net', $DR)) {
    $se_engine = "다음";
} elseif(eregi('naver.com', $DR)) {
    $se_engine = "네이버";
} elseif(eregi('yahoo.com', $DR)) {
    $se_engine = "야후";
} elseif(eregi('empas.com', $DR)) {
    $se_engine = "엠파스";
} elseif(eregi('lycos.co.kr', $DR)) {
    $se_engine = "라이코스";
} elseif(eregi('paran.com', $DR)) {
    $se_engine = "파란닷컴";
} elseif(eregi('nate.com', $DR)) {
    $se_engine = "네이트";
} elseif(eregi('msn', $DR)) {
    $se_engine = "MSN";
} elseif(eregi('google', $DR)) {
    $se_engine = "구글";
} elseif(eregi('allblog.net', $DR)) {
    $se_engine = "알블로그";
} else {
    $se_engine = "기타";
}
$sql_006 = " select se_num from search_engine where se_un = '".$UN."' and se_date = '$curdate' and se_engine = '".$se_engine."' ";
$result_006 = mysql_query($sql_006) or die(mysql_error());

if(mysql_num_rows($result_006) < 1) {
    $sql_006_in = " insert into search_engine set se_date = '$curdate', se_un = '".$UN."', se_engine = '".$se_engine."', se_hits = se_hits + 1 ";
} else {
    $sql_006_in = " update search_engine set se_hits = se_hits + 1 where se_un = '".$UN."' and se_date = '$curdate' and se_engine = '".$se_engine."' ";
}
$result_006_in = mysql_query($sql_006_in) or die(mysql_error());

//페이지별통계
$sql_007 = " select pa_num from PAGE_ANALYSIS where pa_date = '$curdate' and pa_location = '".$DC."' ";
$result_007 = mysql_query($sql_007) or die(mysql_error());

if(mysql_num_rows($result_007) < 1) {
    $sql_007_in = " insert into PAGE_ANALYSIS set pa_date = '$curdate', pa_location = '".$DC."', pa_hits = pa_hits + 1 ";
} else {
    $sql_007_in = " update PAGE_ANALYSIS set pa_hits = pa_hits + 1 where pa_date = '$curdate' and pa_location = '".$DC."' ";
}
$result_007_in = mysql_query($sql_007_in) or die(mysql_error());
