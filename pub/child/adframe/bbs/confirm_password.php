<?
define("__AF__", TRUE);
include_once ( $_SERVER['DOCUMENT_ROOT'] . "/adframe/af_common.php" );

$data = "";
switch ( $command ) {
	// 게시판 비밀번호 확인
	case "board-password-check":

		// 입력 비밀번호 암호화 
		$pre_sql = " select password('" . $input_password . "') from dual ";
		$input_password = $adb->getOne($pre_sql);
		// 실제 저장된 비밀번호 확인
		$sql = " SELECT pwd FROM " . $board_table . " WHERE idx = '" . $board_idx . "' ";
		$data_pwd = $adb->getOne($sql);
		if ( $data_pwd == $input_password ) {
			$data = true;
			// 게시판 수정, 삭제 권한 얻기 위함
			$_SESSION[_BBS_PASS_LOGIN] = $data_pwd;
		} else $data = false;
		break;

	default: 
		$data = "네트워크 문제로 인해 내용을 확인할 수 없습니다.";
		break;

}

echo json_encode($data);
?>