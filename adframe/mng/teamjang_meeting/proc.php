<?php
	include_once("../_common.php");

	// 아래 코드 대부분이 $_POST 값(중첩 배열 포함)을 이스케이프 없이 그대로 SQL 문자열에
	// 삽입하므로, 여기서 한 번에 재귀적으로 이스케이프 처리한다. (기존에 개별 addslashes()가
	// 걸려있던 "w" 케이스는 이중 이스케이프를 피하기 위해 개별 addslashes()를 제거했다.)
	function _teamjang_escape_recursive($v) {
		if ( is_array($v) ) return array_map('_teamjang_escape_recursive', $v);
		return addslashes($v);
	}
	$_POST = _teamjang_escape_recursive($_POST);

	$mode = $_POST['mode'];
	switch($mode){
		case "w": //회의 오픈
				if($_POST['idx']){ //수정
					$sql = "UPDATE teamjang_meeting SET
										m_gubun = '".$_POST['m_gubun']."'
										,m_date = '".$_POST['m_date']."'
										,m_place = '".$_POST['m_place']."'
										,m_record = '".$_POST['m_record']."'
										,m_memo = '".$_POST['m_memo']."'
										,m_member = '".$_POST['m_member']."'
									WHERE idx='{$_POST['idx']}'
					";
					$result = mysql_query($sql) or die(mysql_error());
					$msg = "회의가 수정되었습니다.";
					$url = "meeting_write.php?idx=".$_POST['idx'];
				}else{ //생성
					$sql = "INSERT INTO teamjang_meeting (
										m_gubun
										,m_date
										,m_place
										,m_record
										,m_writer
										,m_memo
										,m_member
										,m_write_date
									) values (
										'".$_POST['m_gubun']."'
										,'".$_POST['m_date']."'
										,'".$_POST['m_place']."'
										,'".$_POST['m_record']."'
										,'".$_POST['m_writer']."'
										,'".$_POST['m_memo']."'
										,'".$_POST['m_member']."'
										,now()
									)
					";
					$result = mysql_query($sql) or die(mysql_error());
					$idx = mysql_insert_id();
					
					$query = "INSERT INTO teamjang_meeting_content(
											m_idx
											,m_write_date
										)values(
											'{$idx}'
											,now()
										)
					";
					mysql_query($query);
					$msg = "회의가 생성되었습니다.";
					$url = "meeting_write.php?idx=".$idx;
				}
			break;
			case "p_w":
				for($i=0; $i< count($_POST['m_content']);$i++){
					$sql = "insert into teamjang_meeting_content_new (
						m_idx
						,m_gubun
						,m_order
						,m_part_writer
						,m_content
						,m_write_date
					) VALUES (
						'{$_POST['m_idx']}'
						,'{$_POST['m_gubun'][$i]}'
						,'{$_POST['m_order'][$i]}'
						,'{$_POST['m_write']}'
						,'{$_POST['m_content'][$i]}'
						,now()
					)
					";
					$result = mysql_query($sql) or die(mysql_error());
				}


				for($i=0; $i<count($_POST['m_part']); $i++){
					$sql = "insert into teamjang_meeting_class_content_new (
						m_idx
						,m_part
						,m_part_write
						,m_content_past
						,m_content_this
						,m_content_next
						,m_write_date
					) VALUES (
						'{$_POST['m_idx']}'
						,'{$_POST['m_part'][$i]}'
						,'{$_POST['m_write']}'
						,'{$_POST['m_content_past'][$i]}'
						,'{$_POST['m_content_this'][$i]}'
						,'{$_POST['m_content_next'][$i]}'
						,now()
					)
					";
					$result = mysql_query($sql) or die(mysql_error());
				}
				$msg = "작성하였습니다.";
				$url = "part_write.php";

				
			break;
			case "p_u":
				
				for($i=0; $i< count($_POST['m_content']);$i++){
					$newCheck = mysql_fetch_array(mysql_query("SELECT * FROM teamjang_meeting_content_new WHERE m_idx='{$_POST['m_idx']}' and m_order = '{$_POST['m_order'][$i]}'"));
					
					if($newCheck['idx']){
						$sql = "update teamjang_meeting_content_new set
									m_content = '{$_POST['m_content'][$i]}'
								where m_idx='{$_POST['m_idx']}' and m_order = '{$_POST['m_order'][$i]}'
						";
						
					}else{
						$sql = "insert into teamjang_meeting_content_new (
								m_idx
								,m_gubun
								,m_order
								,m_part_writer
								,m_content
								,m_write_date
							) VALUES (
								'{$_POST['m_idx']}'
								,'{$_POST['m_gubun'][$i]}'
								,'{$_POST['m_order'][$i]}'
								,'{$_POST['m_write']}'
								,'{$_POST['m_content'][$i]}'
								,now()
							)
							";
					}
					$result = mysql_query($sql) or die(mysql_error());
				}

				for($i=0; $i<count($_POST['m_part']); $i++){
					$newCheck2 = mysql_fetch_array(mysql_query("SELECT * FROM teamjang_meeting_class_content_new WHERE m_idx='{$_POST['m_idx']}' and m_part = '{$_POST['m_part'][$i]}'"));

					if($newCheck2['idx']){
						$sql = "update teamjang_meeting_class_content_new set							
										m_content_past	= '{$_POST['m_content_past'][$i]}'
										,m_content_this	= '{$_POST['m_content_this'][$i]}'
										,m_content_next	= '{$_POST['m_content_next'][$i]}'
								where m_idx = '{$_POST['m_idx']}' and m_part = '{$_POST['m_part'][$i]}'
						";
					}else{
						$sql = "insert into teamjang_meeting_class_content_new (
							m_idx
							,m_part
							,m_part_write
							,m_content_past
							,m_content_this
							,m_content_next
							,m_write_date
						) VALUES (
							'{$_POST['m_idx']}'
							,'{$_POST['m_part'][$i]}'
							,'{$_POST['m_write']}'
							,'{$_POST['m_content_past'][$i]}'
							,'{$_POST['m_content_this'][$i]}'
							,'{$_POST['m_content_next'][$i]}'
							,now()
						)
						";
					}
					if($_SERVER['REMOTE_ADDR']=="112.217.216.250"){
						//print_R($sql);exit;
					}
					$result = mysql_query($sql) or die(mysql_error());
				}
				$msg = "작성하였습니다.";
				$url = "part_write.php";
				
			break;
	
		case "p_w_1":			
			for($i=0; $i< count($_POST['m_content']);$i++){
				$sql = "insert into teamjang_meeting_content_new (
					m_idx
					,m_gubun
					,m_order
					,m_part_writer
					,m_content
					,m_write_date
				) VALUES (
					'{$_POST['m_idx']}'
					,'{$_POST['m_gubun'][$i]}'
					,'{$_POST['m_order'][$i]}'
					,'{$_POST['m_write']}'
					,'{$_POST['m_content'][$i]}'
					,now()
				)
				";
				$result = mysql_query($sql) or die(mysql_error());
			}


			for($i=0; $i<count($_POST['m_part']); $i++){
				$sql = "insert into teamjang_meeting_class_content_new (
					m_idx
					,m_part
					,m_part_write
					,m_content_past
					,m_content_this
					,m_content_next
					,m_write_date
				) VALUES (
					'{$_POST['m_idx']}'
					,'{$_POST['m_part'][$i]}'
					,'{$_POST['m_write']}'
					,'{$_POST['m_content_past'][$i]}'
					,'{$_POST['m_content_this'][$i]}'
					,'{$_POST['m_content_next'][$i]}'
					,now()
				)
				";
				$result = mysql_query($sql) or die(mysql_error());
			}
			$msg = "작성하였습니다.";
			$url = "meeting_view.php";
			
		break;
		case "p_u_1":
			for($i=0; $i< count($_POST['m_content']);$i++){
				$sql = "update teamjang_meeting_content_new set
							m_content = '{$_POST['m_content'][$i]}'
						where m_idx='{$_POST['m_idx']}' and m_order = '{$_POST['m_order'][$i]}'
				";
				if($_SERVER['REMOTE_ADDR']=="112.217.216.250"){
					//print_R($sql);
				}
				$result = mysql_query($sql) or die(mysql_error());
			}


			for($i=0; $i<count($_POST['m_part']); $i++){
				$sql = "update teamjang_meeting_class_content_new set							
								m_content_past	= '{$_POST['m_content_past'][$i]}'
								,m_content_this	= '{$_POST['m_content_this'][$i]}'
								,m_content_next	= '{$_POST['m_content_next'][$i]}'
						where m_idx = '{$_POST['m_idx']}' and m_part = '{$_POST['m_part'][$i]}'
				";
				
				if($_SERVER['REMOTE_ADDR']=="112.217.216.250"){
					//print_R($sql);
				}
				$result = mysql_query($sql) or die(mysql_error());
			}
			$msg = "작성하였습니다.";
			$url = "meeting_view.php?idx={$_GET['m_idx']}";
			
		break;
	}
//if($_SERVER['REMOTE_ADDR']!="112.217.216.250"){
	echo "<script>alert('".$msg."');location.href='".$url."'</script>";

//}
?>