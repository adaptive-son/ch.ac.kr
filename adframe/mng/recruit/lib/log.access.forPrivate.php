<?
	// 개인정보 열람관련 접속기록
	function log_Access_ForPrivate( $workValue ) {
		if ( $_SESSION[ID] == "" || !$_SESSION[ID] ) {
			echo "<script> alert('허용되지 않는 접근방법입니다.'); history.back(); </script>";
			exit;
		}
		$tb_name = "log_Access";
		$sql_sub = " acc_id = '".$_SESSION[ID]."', acc_page = '".$_SERVER[PHP_SELF]."', acc_date = now(), acc_ip = '".$_SERVER['REMOTE_ADDR']."', acc_work = '".$workValue."' ";
		$sql = " insert into ".$tb_name." set ".$sql_sub;
		//echo $sql."<BR>";
		sql_query($sql);
	}
	
	// 개인정보취급 페이지 
	$arr_page = array(
								// (관리자)  온라인 장학신청 
								"\/adm\/online_janghak",
								// (관리자)  교원채용
								"\/adm\/recruit", "\/adm\/recruit2"
								);
	
	$pgidx = 0;
	foreach ( $arr_page as $k => $v ) {
		if ( preg_match("|".$v."|", $_SERVER['REQUEST_URI']) > 0 ) $pgidx++;
	}
	
	//if ( $pgidx > 0 ) log_Access_ForPrivate("show_content");

?>