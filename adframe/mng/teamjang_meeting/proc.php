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

	// 2026.10.12 - 폼으로 들어온 값과 DB 의 현재 값이 같은지 비교한다.
	//  $_POST 에는 위에서 addslashes 가 걸려 있으므로 되돌려서 비교하고,
	//  textarea 는 제출할 때 개행을 CRLF 로 바꿔 보내므로 그 차이도 흡수한다.
	//  값이 같으면 '내가 건드리지 않은 칸'이므로 UPDATE 자체를 하지 않는다.
	//  (이걸 안 하면 먼저 저장한 사람이 화면의 모든 칸을 갱신해버려, 뒤에 저장하는
	//   같은 부서 담당자가 자기 칸까지 충돌로 판정되어 아무것도 저장되지 않는다.)
	function _teamjang_same($postVal, $dbVal) {
		$a = str_replace("\r\n", "\n", (string)stripslashes($postVal));
		$b = str_replace("\r\n", "\n", (string)$dbVal);
		return $a === $b;
	}

	$mode = $_POST['mode'];

	// 2026.10.12 - 동시 작성 충돌 방지(낙관적 잠금).
	//  작성 화면을 연 시각. 이 시각 이후에 다른 담당자가 저장한 칸은 덮어쓰지 않는다.
	$m_loaded_at   = isset($_POST['m_loaded_at']) ? $_POST['m_loaded_at'] : "";
	$skip_conflict = 0;
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
					$m_gubun = isset($_POST['m_gubun'][$i]) && $_POST['m_gubun'][$i] !== '' ? $_POST['m_gubun'][$i] : 0;
					$sql = "insert into teamjang_meeting_content_new (
						m_idx
						,m_gubun
						,m_order
						,m_part_writer
						,m_content
						,m_write_date
					) VALUES (
						'{$_POST['m_idx']}'
						,'{$m_gubun}'
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
						// 2026.10.12 - 내가 손대지 않은 칸(값이 DB 와 동일)은 UPDATE 하지 않는다.
						if ( _teamjang_same($_POST['m_content'][$i], $newCheck['m_content']) ) {
							continue;
						}
						// 2026.10.12 - 내가 화면을 연 뒤 다른 담당자가 이 칸을 수정했다면 건드리지 않는다.
						if ( $m_loaded_at != "" && $newCheck['m_write_date'] != "" && $newCheck['m_write_date'] > $m_loaded_at ) {
							$skip_conflict++;
							continue;
						}
						$sql = "update teamjang_meeting_content_new set
									m_content = '{$_POST['m_content'][$i]}'
									,m_write_date = now()
								where m_idx='{$_POST['m_idx']}' and m_order = '{$_POST['m_order'][$i]}'
						";
						
					}else{
						$m_gubun = isset($_POST['m_gubun'][$i]) && $_POST['m_gubun'][$i] !== '' ? $_POST['m_gubun'][$i] : 0;
						$sql = "insert into teamjang_meeting_content_new (
								m_idx
								,m_gubun
								,m_order
								,m_part_writer
								,m_content
								,m_write_date
							) VALUES (
								'{$_POST['m_idx']}'
								,'{$m_gubun}'
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
						// 2026.10.12 - 세 칸 모두 DB 와 같으면 내가 손대지 않은 학과이므로 UPDATE 하지 않는다.
						if ( _teamjang_same($_POST['m_content_past'][$i], $newCheck2['m_content_past'])
						  && _teamjang_same($_POST['m_content_this'][$i], $newCheck2['m_content_this'])
						  && _teamjang_same($_POST['m_content_next'][$i], $newCheck2['m_content_next']) ) {
							continue;
						}
						// 2026.10.12 - 내가 화면을 연 뒤 다른 담당자가 이 칸을 수정했다면 건드리지 않는다.
						if ( $m_loaded_at != "" && $newCheck2['m_write_date'] != "" && $newCheck2['m_write_date'] > $m_loaded_at ) {
							$skip_conflict++;
							continue;
						}
						$sql = "update teamjang_meeting_class_content_new set
										m_content_past	= '{$_POST['m_content_past'][$i]}'
										,m_content_this	= '{$_POST['m_content_this'][$i]}'
										,m_content_next	= '{$_POST['m_content_next'][$i]}'
										,m_write_date	= now()
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
				$m_gubun = isset($_POST['m_gubun'][$i]) && $_POST['m_gubun'][$i] !== '' ? $_POST['m_gubun'][$i] : 0;
				$sql = "insert into teamjang_meeting_content_new (
					m_idx
					,m_gubun
					,m_order
					,m_part_writer
					,m_content
					,m_write_date
				) VALUES (
					'{$_POST['m_idx']}'
					,'{$m_gubun}'
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
			// 2026.10.12 - "있으면 UPDATE, 없으면 INSERT"(upsert) 로 보강.
			//  기존에는 UPDATE 만 있어 해당 (m_idx, m_order) / (m_idx, m_part) 행이 아직 없으면
			//  0행에 적용되고 조용히 끝났다. SQL 오류가 아니라 "작성하였습니다" 알림까지 떠서,
			//  그 회의에 처음 쓰는 부서·학과는 내용이 통째로 사라졌다. p_u 분기와 같은 방식으로 맞춘다.
			for($i=0; $i< count($_POST['m_content']);$i++){
				$chk1 = mysql_fetch_array(mysql_query("SELECT idx FROM teamjang_meeting_content_new WHERE m_idx='{$_POST['m_idx']}' and m_order = '{$_POST['m_order'][$i]}'"));
				if($chk1['idx']){
					$sql = "update teamjang_meeting_content_new set
								m_content = '{$_POST['m_content'][$i]}'
							where m_idx='{$_POST['m_idx']}' and m_order = '{$_POST['m_order'][$i]}'
					";
				}else{
					$m_gubun = isset($_POST['m_gubun'][$i]) && $_POST['m_gubun'][$i] !== '' ? $_POST['m_gubun'][$i] : 0;
					$sql = "insert into teamjang_meeting_content_new (
							m_idx
							,m_gubun
							,m_order
							,m_part_writer
							,m_content
							,m_write_date
						) VALUES (
							'{$_POST['m_idx']}'
							,'{$m_gubun}'
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
				$chk2 = mysql_fetch_array(mysql_query("SELECT idx FROM teamjang_meeting_class_content_new WHERE m_idx='{$_POST['m_idx']}' and m_part = '{$_POST['m_part'][$i]}'"));
				if($chk2['idx']){
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
				$result = mysql_query($sql) or die(mysql_error());
			}
			$msg = "작성하였습니다.";
			// 2026.10.12 - 폼은 POST 로 전송되므로 $_GET['m_idx'] 는 항상 비어 있었다. 그 결과
			//  저장 후 idx 없는 주소로 이동해 빈 화면이 떴고, 저장이 안 된 것처럼 보였다.
			$url = "meeting_view.php?idx={$_POST['m_idx']}";
			
		break;
	}
//if($_SERVER['REMOTE_ADDR']!="112.217.216.250"){
	// 2026.10.12 - 충돌로 건너뛴 항목이 있으면 조용히 넘기지 않고 함께 알린다.
	if ( $skip_conflict > 0 ) {
		$msg = $msg."\\n\\n".$skip_conflict."개 항목은 이 화면을 연 뒤 다른 담당자가 수정하여 덮어쓰지 않았습니다.\\n새로고침 후 확인해 주세요.";
	}
	echo "<script>alert('".$msg."');location.href='".$url."'</script>";

//}
?>