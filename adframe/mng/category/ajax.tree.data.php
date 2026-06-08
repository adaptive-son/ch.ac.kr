<?php
include_once "../_common.php";

// 변수 초기화
if ( array_key_exists("id", $_POST)) $pId = $_POST["id"];
if ( array_key_exists("level", $_POST)) $pLevel = $_POST["level"];
if ( $pId == "" || $pId == null ) $pId = "0";
if ( $pLevel == "" || $pLevel == null ) $pLevel = "";
$pId = htmlspecialchars($pId);
$PMENU = $_POST[PMENU];				// 학과 관리와 관련되어 예외 추가

$sql = " SELECT *, ";
$sql .= " ( SELECT count(*) FROM ".TABLE_CATEGORY." AS b WHERE a.TREE_NO = b.PARENT  ) AS cnt ";
$sql .= " FROM ".TABLE_CATEGORY." AS a ";
$sql .= " WHERE PARENT = '".$pId."' ORDER BY ORDER_NO ";
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
    if ( $PMENU == "control" || $PMENU == "tree" ) $data .= " , 'ETC1': '".$row[ETC1]."' ";
    $data .= " } ";
}

echo "[".$data."]";

include_once "../include/__footer.php";
?>
