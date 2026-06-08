<?php

include_once ("_common.php");

//게시판 정보
$board_info = DBarray("SELECT * FROM ".TABLE_BOARD_MNG." WHERE board_key='".$_SESSION["managerBoardKey"]."'");

for ($i=0; $i<count($_POST['chk']); $i++){

	// 체크된 게시글의 idx를 가져옴
	$idx = $_POST['chk'][$i];
	// 해당 게시글을 삭제여부를 삭제로 업데이트함
	$sql = "UPDATE ".$board_info[board_id]." SET del_yn='Y' WHERE idx='".$idx."' ";
	$adb->query($sql);
}
//print_r($sql);
//exit;

$msg = $i."건의 게시글이 삭제되었습니다.";
$url = "/adframe/mng/bbs_manager/index.php?bbs=list&data=".$data;
alert_href($url,$msg);
?>