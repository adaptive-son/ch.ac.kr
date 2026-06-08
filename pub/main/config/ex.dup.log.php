  <?
	// 문자열 캐릭터 셋 바꾸기 
	function ChgCharset ( $msg ) {
		return iconv("cp949", "utf-8", $msg);
	}
	// 변수 초기화
	if ( !$s_id ) $s_id = $_SESSION[ID];

	// 중복 로그인 방지 클래스
	Class AvoidDuplication {
		
		// Table 이름
		private $tbl_session = "login_session";
		private $tbl_block = "login_block";
		
		// 생성자
		function __construct() {
			// 'admin'인 경우, 블럭 처리 제외
			if ( $_SESSION[ID] != "admin" ) { 
				// 현재 페이지가 로그아웃 페이지가 아닌 경우, 동일 아이디 접속 방지
				if ( $PHP_SELF != "/sso/logout.php" ) $this->processing();
			}
		}
		
		// 동일 아이디 접속 로그 확인 
		function blockChk($id) {
			// 로그인 정보가 존재할 경우에 접속로그 확인
			if ( $id || $id != "" ) {
				$sql = "select * from ".$this->tbl_block." where memId = '{$id}' and code = '{$_SESSION[secureSessionId]}' ";
				$cnt = mysql_num_rows(sql_query($sql));
				// 로그인되어 있는 아이디인 경우
				if ($cnt!=0) {
					$msg = ChgCharset("동일한 아이디로 접속한 정보가 존재합니다. 로그인을 할 수 없습니다.");
					echo "<script> alert('".$msg."'); location.replace('../sso/logout.php'); </script>";
				} 
			}
		}
		
		// 동일 아이디 접속 여부 확인
		function processing() {
			// 세션 아이디
			global $s_id;
			// 현재시간 (초)
			$nowTime = time();
			// 접근 IP
			$IP = $_SERVER["REMOTE_ADDR"];
			// 세션값
			$sessKey = $_SESSION[secureSessionId];
			
			// 아이디 블럭처리 유지시간 (30분)
			$time = 60*15;

			$this->pre_processing();
			
			// 로그인한 경우
			if ( $s_id || $s_id != "" ) {
				$sql = "SELECT *, count(*) as cnt FROM ".$this->tbl_session." WHERE memId = '{$s_id}' ";
				$row = mysql_fetch_assoc(sql_query($sql));
				$resTime = $nowTime - $row[regdate];
				
				if ($row[cnt] == "0") {
					// 로그인한 아이디가 없는 경우
					echo ChgCharset("처음 로그인<BR>");
					$sql = "INSERT INTO ".$this->tbl_session." (memId, sessKey, remoteIP, regdate) VALUES ('{$s_id}','{$sessKey}','{$IP}','{$nowTime}')";
					sql_query($sql);
				} else {
					// 로그인한 아이디가 있는 경우
					if ( $resTime > $time ) {
						// 마지막 접속시간으로부터 일정 시간이 지나면 블럭초기화
						$this->duplicationDel($s_id);
					}
					if ($row[remoteIP] != $IP || $row[sessKey] != $sessKey) {
						// 현재 접속한 IP와 기록에 남겨진 IP 비교하여 다르거나, 세션키값이 다른 경우 -> 블럭처리
						$sql ="INSERT INTO ".$this->tbl_block." (memId, regdate, code) VALUES ('{$s_id}','$nowTime','{$sessKey}')";
						sql_query($sql);
					} else {
						// 마지막 접속시간 업데이트
						$sql = "UPDATE ".$this->tbl_session." SET regdate = '{$nowTime}', remoteIP = '{$IP}', sessKey = '{$sessKey}' WHERE memId = '{$s_id}'";
						sql_query($sql);
					}
				}
			}

			// 접속로그 확인
			$this->blockChk($s_id);

		}

		// 일정시간 이상 업데이트되지 않는 기록 삭제 
		function pre_processing() {
			$limit_time = 60*15;			// 블럭유지 시간
			$sql = " select memId, ( unix_timestamp(now()) - regdate ) as last_time from ".$this->tbl_session;
			$rs = mysql_query($sql);
			while ( $rows = mysql_fetch_assoc($rs) ) {
				if ( $rows[last_time] > $limit_time ) $this->processingStop($rows[memId]);
			}
		}
		
		// 로그아웃, 일정시간 사용이 없어서 강제로그아웃, 세션등록테이블에서 해당아이디 삭제
		function processingStop($mem_id = "") {
			if ( $mem_id != "" ) $memId = $mem_id;
			else {
				global $s_id;
				$memId = $s_id;
			}
			$sql = "delete from ".$this->tbl_session." where memId = '{$memId}'";
			sql_query($sql);
			$this->duplicationDel($memId);
		}
		 
		// 차단 해제 ( 로그아웃, 세션 유지시간 종료 등 )
		function duplicationDel($mem_id) {
			$sql = "SELECT * FROM ".$this->tbl_block." WHERE memId = '$mem_id'";
			$cnt = mysql_num_rows(sql_query($sql));
			if ($cnt!=0) {
				$sql = "DELETE FROM ".$this->tbl_block." WHERE memId = '$mem_id'";
				sql_query($sql);
			} 
		}
	}

	$aDupli = new AvoidDuplication();

?>