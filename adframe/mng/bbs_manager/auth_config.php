<?
//권한설정 매핑
$bbs_authgroup = $_SESSION['MEMBER_GROUP'];

//유저정보
$bbs_userid = $_SESSION['MEMBER_ID'];
$bbs_username = $_SESSION['MEMBER_UNAME'];


//관리자정보
$bbs_adminid = $_SESSION['MEMBER_ID'];
$bbs_adminname = $_SESSION['MEMBER_UNAME'];
$bbs_authadmin = $_SESSION['ADMIN_GROUP'];

if($_SESSION["ADMIN_GROUP"] == "T"){
    $SecAdmin  = "1";
}else if(in_array(TREE_ID,$_SESSION["ADMIN_SITE"])){
    $SecAdmin  = "1";
}

$sql    = " select detail.code, detail.code_name from master_code master INNER JOIN  code_detail detail  
    ON master.master_idx = detail.master_idx
    WHERE master.del_yn='N' AND detail.use_yn='Y' AND master.code='MEMBER_TYPE' order by detail.order_no asc";


$result = mysql_query($sql) or die (mysql_error());


$Config_AuthArray = array(
    "관리자"=>"A"
);

//$list = array();
while( $row = mysql_fetch_array( $result ) ){
    $Config_AuthArray[$row[code_name]] = $row[code];

}
if($_SESSION["ADMIN_GROUP"]!=""){
    $bbs_authgroup = "A";
}


if($_SERVER["REMOTE_ADDR"] == "112.217.216.250"){
    //echo $sql; exit;
    //print_r2($Config_AuthArray);
    //echo TREE_ID;
    //exit;
}

?>