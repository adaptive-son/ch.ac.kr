<?php
// 개별 페이지 실행 방지. 해당 문자열은 inc.constant.php에 정의된다.
define("__AF__", TRUE);

include($_SERVER["DOCUMENT_ROOT"] . "/adframe/af_common.php");

//$board_code =$_REQUEST['BoardKey'];
//$board_id = $_REQUEST['board_id'];
$board_code =$_REQUEST['boardKey'];
$board_id = $_REQUEST['board_id'];

//"SELECT COUNT(*) FROM abbs_manager as a, ".$board_id." as b WHERE a.board_key = b.code AND b.code=".$board_code." AND b.notice='Y' AND b.del_yn='N' ";
$sql = "SELECT COUNT(*) as noticeCount FROM abbs_manager as a, ".$board_id." as b WHERE a.board_key = b.code AND b.code=".$board_code." AND b.notice='Y' AND b.del_yn='N' ";
$data = mysql_query($sql);
$row = mysql_fetch_assoc($data);
//print_r($sql);
//print_r($row['noticeCount']);
$result = Array();
$result["success"] = "true";
$result["notice_count"] = $row["noticeCount"];

//echo json_encode($result, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
//echo $row['noticeCount'];
echo json_encode($result);

?>