<?php  
	include_once("../../_common.php"); 
	
	$mode = $_POST['mode'];
	switch($mode){
		case "w": //회의 오픈
				if($_POST['idx']){ //수정
					$sql = "UPDATE teamjang_meeting SET
										m_gubun = '".addslashes($_POST['m_gubun'])."'
										,m_date = '".addslashes($_POST['m_date'])."'
										,m_place = '".addslashes($_POST['m_place'])."'
										,m_record = '".addslashes($_POST['m_record'])."'
										,m_memo = '".addslashes($_POST['m_memo'])."'
										,m_member = '".addslashes($_POST['m_member'])."'
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
										'".addslashes($_POST['m_gubun'])."'
										,'".addslashes($_POST['m_date'])."'
										,'".addslashes($_POST['m_place'])."'
										,'".addslashes($_POST['m_record'])."'
										,'".addslashes($_POST['m_writer'])."'
										,'".addslashes($_POST['m_memo'])."'
										,'".addslashes($_POST['m_member'])."'
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
				
				if($_POST['idx']){ //수정
						$sql = "update teamjang_meeting_content set m_update_writer = '{$_SESSION['ID']}' ";
						for($i=1; $i<71; $i++){
							if(isset($_POST['m_content'.$i])){
								$sql .= "				,m_content$i = '".addslashes($_POST['m_content'.$i])."'";
							}
						}
						$sql .= "				where 
											idx = '{$_POST['idx']}'
						";
						$result = mysql_query($sql) or die(mysql_error());
					
					$msg = "작성하였습니다.";
					$url = $m_page."?idx=".$_POST['idx'];
				}else{ //생성
					$sql = "INSERT INTO teamjang_meeting_content (
										m_idx
										,m_part
										,m_part_writer
										,m_content1
										,m_content2
										,m_content3
										,m_content4
										,m_content5
										,m_content6
										,m_content7
										,m_content8
										,m_content9
										,m_content10
										,m_content11
										,m_content12
										,m_content13
										,m_content14
										,m_content15
										,m_content16
										,m_content17
										,m_content18
										,m_content19
										,m_content20
										,m_content21
										,m_content22
										,m_content23
										,m_content24
										,m_content25
										,m_content26
										,m_content27
										,m_content28
										,m_content29
										,m_content30
										,m_content31
										,m_content32
										,m_content33
										,m_content34
										,m_content35
										,m_content36
										,m_content37
										,m_content38
										,m_content39
										,m_content40
										,m_content41
										,m_content42
										,m_content43
										,m_content44
										,m_content45
										,m_content46
										,m_content47
										,m_content48
										,m_content49
										,m_content50
										,m_content51
										,m_content52
										,m_content53
										,m_content54
										,m_content55
										,m_content56
										,m_content57
										,m_content58
										,m_content59
										,m_content60
										,m_content61
										,m_content62
										,m_content63
										,m_content64
										,m_content65
										,m_content66
										,m_content67
										,m_content68
										,m_content69
										,m_content70
										,m_write_date
									) values (
										'{$_POST['m_idx']}'
										,'{$part_idx}'
										,'{$_SESSION['ID']}'
										,'{$m_content1}'
										,'{$m_content2}'
										,'{$m_content3}'
										,'{$m_content4}'
										,'{$m_content5}'
										,'{$m_content6}'
										,'{$m_content7}'
										,'{$m_content8}'
										,'{$m_content9}'
										,'{$m_content10}'
										,'{$m_content11}'
										,'{$m_content12}'
										,'{$m_content13}'
										,'{$m_content14}'
										,'{$m_content15}'
										,'{$m_content16}'
										,'{$m_content17}'
										,'{$m_content18}'
										,'{$m_content19}'
										,'{$m_content20}'
										,'{$m_content21}'
										,'{$m_content22}'
										,'{$m_content23}'
										,'{$m_content24}'
										,'{$m_content25}'
										,'{$m_content26}'
										,'{$m_content27}'
										,'{$m_content28}'
										,'{$m_content29}'
										,'{$m_content30}'
										,'{$m_content31}'
										,'{$m_content32}'
										,'{$m_content33}'
										,'{$m_content34}'
										,'{$m_content35}'
										,'{$m_content36}'
										,'{$m_content37}'
										,'{$m_content38}'
										,'{$m_content39}'
										,'{$m_content40}'
										,'{$m_content41}'
										,'{$m_content42}'
										,'{$m_content43}'
										,'{$m_content44}'
										,'{$m_content45}'
										,'{$m_content46}'
										,'{$m_content47}'
										,'{$m_content48}'
										,'{$m_content49}'
										,'{$m_content50}'
										,'{$m_content51}'
										,'{$m_content52}'
										,'{$m_content53}'
										,'{$m_content54}'
										,'{$m_content55}'
										,'{$m_content56}'
										,'{$m_content57}'
										,'{$m_content58}'
										,'{$m_content59}'
										,'{$m_content60}'
										,'{$m_content61}'
										,'{$m_content62}'
										,'{$m_content63}'
										,'{$m_content64}'
										,'{$m_content65}'
										,'{$m_content66}'
										,'{$m_content67}'
										,'{$m_content68}'
										,'{$m_content69}'
										,'{$m_content70}'
										,now()
									)
					";

					$result = mysql_query($sql) or die(mysql_error());
					$msg = "작성하였습니다.";
					$url = "part_write.php";
				}
				
			break;
	}

	echo "<script>alert('".$msg."');location.href='".$url."'</script>";
?>