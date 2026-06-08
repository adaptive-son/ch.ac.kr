<?php
include_once "../_common.php";

// 변수 초기화
if ( array_key_exists("id", $_POST)) $pId = $_POST["id"];
if ( array_key_exists("level", $_POST)) $pLevel = $_POST["level"];
if ( $pId == "" || $pId == null ) $pId = "0";
if ( $pLevel == "" || $pLevel == null ) $pLevel = "";
$pId = htmlspecialchars($pId);
$TREE_ID = $_REQUEST[TREE_ID];

$sql = " SELECT *, ";
$sql .= " ( SELECT count(*) FROM ".TABLE_TREE." AS b WHERE a.TREE_NO = b.PARENT AND TREE_ID = '".$TREE_ID."' ) AS cnt ";
$sql .= " FROM ".TABLE_TREE." AS a ";
$sql .= " WHERE PARENT = '".$pId."' AND TREE_ID = '".$TREE_ID."' ORDER BY ORDER_NO ";
$rs = $adb->query($sql);
for ( $i = 0 ; $row = $rs->fetchRow(DB_FETCHMODE_ASSOC) ; $i++ ) {
    if ( $data != "" ) $data .= ", ";
    $data .= " { ";
    $data .= " id: '".$row[TREE_NO]."' ";
    $data .= " ,name: '".$row[NAME]."' ";
    if ( $row[cnt] > 0 ) $data .= " , isParent: 'true' ";
    else $data .= " , isParent: 'false' ";
    $data .= " , 'contents': '".$row[CONTENTS]."' ";
    $data .= " , 'link_target': '".$row[LINK_TARGET]."' ";
    $data .= " , 'menu_on': '".$row[MENU_ON]."' ";
    $data .= " , 'TREE_ID': '".$row[TREE_ID]."' ";
    $data .= " , 'ETC1': '".$row[ETC1]."' ";
	$data .= " , 'ETC2': '".$row[ETC2]."' "; //담당부서
	$data .= " , 'ETC3': '".$row[ETC3]."' "; //담당자
	$data .= " , 'ETC4': '".$row[ETC4]."' "; //이메일
	$data .= " , 'ETC5': '".$row[ETC5]."' "; //전화번호
	$data .= " , 'SQL': '".$row[ETC5]."' "; //전화번호
    $data .= " } ";
}
echo "[".$data."]";

include_once "../include/__footer.php";
?>
