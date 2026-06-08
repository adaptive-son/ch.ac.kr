<?
class ora11g {
        var $ORA_USER;	//오라클 사용자
        var $ORA_PASSWD;	//오라클 암호
        var $ORA_DNS;	//오라클 DNS
        var $db;	//db접속
        var $autocommit = true;	//자동커밋
        var $debug=false;	//디버그모드
        
        var $error = array();

        //오라클 접속정보 초기화
        function ora11g($user='bada', $passwd='bada2048', $dns='ORA7') {
			  
				if($dns == "ORA7") {
					$db_dns = "(DESCRIPTION =
						(ADDRESS_LIST = 
					  	(ADDRESS = (PROTOCOL = TCP)(HOST = miracle.ch.ac.kr)(PORT = 1521)) 
						) 
						(CONNECT_DATA = 
					  	(SID = ORA7
					  	) 
						) 
					)";
				}else{
					$db_dns = $this->ORA_DNS;
				}
                $this->ORA_USER=$user;
                $this->ORA_PASSWD=$passwd;
                $this->ORA_DNS=$db_dns;
                //echo $db_dns;
        }
        
        //오라클 접속
        function con() {
                $this->db= OCILogon($this->ORA_USER,$this->ORA_PASSWD,$this->ORA_DNS) or die("DB Connect Error");
        }

        //오라클 접속 해제
        function discon() {
                return @OCILogoff($this->db);
        }

        //에러메세지 출력
        function error($mes) {
			$this->discon();
			echo "<script language=Javascript>
					alert(\"$mes\");
				</script>";
			exit;
        }

        function autocommit($autocommit = false) {
			$this->autocommit=$autocommit;
        }

        //값이 문자열경우 '' 붙여줌
        function set_str($str) {
			
			//무시할 문자열
			$chk="sysdate|nextval|curval|null";
			
			if(!preg_match("/$chk/i", $str)) {
			        $var=intval($str);
			        $ok=("$str"=="$var");
			        if(!$ok ){
			            $str="'".$str."'";
			        }else{
			        	$str="'".$str."'";
			        }
			}
			return $str;
        }
        
        
        /***************************** 퀴리 날리기 *******************************************/
        //일반 퀴리
        function query($query) {
            if($this->debug) echo $query;
            
            //echo $query;
            //exit;
            
            $stmt = @OCIParse($this->db, $query);
            

            if (!$stmt) {	//에러가 났을경우
                    $erra=OCIError($stmt);
                    $this->error("SQL Error: $erra[code] $erra[message]"); 
            }
         	
         	$err=@OCIExecute($stmt);
            if (!$err) {	//에러가 났을경우
            	
                    $erra=OCIError($err);
                    $this->error("SQL Error: $erra[code] $erra[message]"); 
            }
            if(@OCIFetchinto($stmt, &$value, OCI_ASSOC)) {
                    @OCIFreeStatement($stmt);
                    return $value;	//배열형태로 전송
            } else {
                    @OCIFreeStatement($stmt);
                    return false;
            }
        }

        //여러개의 결과용 퀴리
        function querys($query) {
                if($this->debug) echo $query;

                $stmt = @OCIParse($this->db, $query);
                if (!$stmt) {	//에러가 났을경우
                        $erra=OCIError($stmt);
                        $this->error("SQL Error: $erra[code] $erra[message]"); 
                }
         $err=OCIExecute($stmt);
                if (!$err) {	//에러가 났을경우
                        $erra=OCIError($err);
                        $this->error("SQL Error: $erra[code] $erra[message]"); 
                }
                while (@OciFetchinto($stmt,&$row,OCI_ASSOC)) {
                        $value[]=$row;

                }

                @OCIFreeStatement($stmt);
                return $value;	//배열형태로 전송
        }

        //한개의 값만 출력
        function queryone($query) {
                if($this->debug) echo $query;
                
                //echo $query;
                //exit;
                $stmt = @OCIParse($this->db, $query);
                if (!$stmt) {	//에러가 났을경우
                        $erra=OCIError($stmt);
                        $this->error("SQL Error: $erra[code] $erra[message]"); 
                }
         $err=@OCIExecute($stmt);
                if (!$err) {	//에러가 났을경우
                        $erra=OCIError($err);
                        $this->error("SQL Error: $erra[code] $erra[message]"); 
                }
                if(@OciFetchinto($stmt,&$value,OCI_NUM )) {
                        @OCIFreeStatement($stmt);
                        return $value[0];
                } else {
                        @OCIFreeStatement($stmt);
                        return false;
                }
        }
        /***************************** 퀴리 날리기 *******************************************/



		/***************************** insert & update & delete 쿼리 *******************************************/
        //insert & update & delete 용 퀴리
        function squery($query) {
            if($this->debug) echo $query;

            $stmt = @OCIParse($this->db, $query);
            if (!$stmt) {	//에러가 났을경우
                    $erra=OCIError($stmt);
                    $this->error("SQL Error: $erra[code] $erra[message]"); 
            }

         	if($this->autocommit) {
                        $err=@OCIExecute($stmt);
            } else {
             $err=@OCIExecute($stmt, OCI_DEFAULT);
            }

            if (!$err) {	//에러가 났을경우
                    $erra=OCIError($err);
                    $this->error("SQL Error: $erra[code] $erra[message]");
            }
            $count=@OCIRowCount($stmt);
            @OCIFreeStatement($stmt);
            
            return $count;
        }        

        //배열형태로 인설트
        function squery_inarr($dbname, $query_arr, $addcolumn="", $addvalue="") {
            $arr_total=count($query_arr);	//전체 배열수
            foreach($query_arr as $key=>$val) {
                $set.=$key;
                $input.=$this->set_str($val);

                $arr_total--;
                if($arr_total > 0) {
                        $set.=", ";
                        $input.=", ";
                }
            }
            
            if($addcolumn)	$addqryC = ",".$addcolumn;
            if($addvalue)	$addqryV = ", '".$addvalue."'";
            
            //sql문 생성
            $sql="insert into $dbname($set$addqryC) values($input$addqryV)";
            //echo $sql;
            //exit;
            if($this->debug) echo $sql;
            $stmt = @OCIParse($this->db, $sql);
            if (!$stmt) {	//에러가 났을경우
                    $erra=OCIError($stmt);
                    $this->error("SQL Error: $erra[code] $erra[message]"); 
            }
         
         	if($this->autocommit) {
            	$err=@OCIExecute($stmt);
            } else {
            	$err=@OCIExecute($stmt, OCI_DEFAULT);
            }

            if (!$err) {	//에러가 났을경우
                $erra=OCIError($err);
                $this->error("SQL Error: $erra[code] $erra[message]");
            }
            @OCIFreeStatement($stmt);
        }

        //콤마 형태로 업데이트
        function squery_upcomma($dbname, $query_arr, $where) {
            
            $query = $query_arr;
                
            //sql문 생성
            $sql="update $dbname set $query $where";
            //echo $sql;
            //exit;
            if($this->debug) echo $sql;
            $stmt = @OCIParse($this->db, $sql);
            if (!$stmt) {	//에러가 났을경우
                    $erra=OCIError($stmt);
                    $this->error("SQL Error: $erra[code] $erra[message]"); 
            }
         
         	if($this->autocommit) {
         		$err=@OCIExecute($stmt);
            } else {
            	$err=@OCIExecute($stmt, OCI_DEFAULT);
            }

            if (!$err) {	//에러가 났을경우
                $erra=OCIError($err);
                $this->error("SQL Error: $erra[code] $erra[message]"); 
            }
            //$count=@OCIRowCount($stmt);
            //@OCIFreeStatement($stmt);
            return $count;
        }
        
        
        //배열형태로 업데이트
        function squery_uparr($dbname, $query_arr, $where) {
            $arr_total=count($query_arr);	//전체 배열수
            foreach($query_arr as $key=>$val) {
                $query .= $key ."= ".$this->set_str($val)."";

                $arr_total--;
                if($arr_total > 0) {
                        $query.=", ";
                }
            }
                
            //sql문 생성
            $sql="update $dbname set $query $where";
            
            if($this->debug) //echo $sql;
            $stmt = @OCIParse($this->db, $sql);
            if (!$stmt) {	//에러가 났을경우
                    $erra=OCIError($stmt);
                    $this->error("SQL Error: $erra[code] $erra[message]"); 
            }
         
         	if($this->autocommit) {
         		$err=@OCIExecute($stmt);
            } else {
            	$err=@OCIExecute($stmt, OCI_DEFAULT);
            }

            if (!$err) {	//에러가 났을경우
                $erra=OCIError($err);
                $this->error("SQL Error: $erra[code] $erra[message]"); 
            }
            $count=@OCIRowCount($stmt);
            @OCIFreeStatement($stmt);
            return $count;
        }

        //clob형식 입력 퀴리(배열형)
        function squery_inclob($dbname, $query_arr, $lobname, $lobdata) {
            $arr_total=count($query_arr);	//전체 배열수
            foreach($query_arr as $key=>$val) {
                    $set.=$key;
                    $input.=$this->set_str($val);

                    $arr_total--;
                    if($arr_total > 0) {
                            $set.=", ";
                            $input.=", ";
                    }
            }
            
            $sql="insert into $dbname($set, $lobname) values($input, empty_clob()) returning $lobname into :CONTB";        //sql문 생성
            if($this->debug) echo $sql;

            $clob = OCINewDescriptor($this->db, OCI_D_LOB); 
            $stmt = @OCIParse($this->db, $sql);
            if (!$stmt) {                //에러가 났을경우
                    $erra=OCIError($stmt);
                    $this->error("SQL Error: $erra[code] $erra[message]"); 
            }

            OCIBindByName ($stmt, ":CONTB", &$clob, -1, OCI_B_CLOB); 
         	$err=@OCIExecute($stmt, OCI_DEFAULT);
            $clob->save($lobdata);
            $this->commit();
        
            if (!$err) {	//에러가 났을경우
                    $erra=OCIError($err);
                    $this->error("SQL Error: $erra[code] $erra[message]"); 
            }
            @OCIFreeDesc($clob);
            @OCIFreeStatement($stmt);
        }

        //CLOB 형식 업데이트용
        function squery_upclob($dbname, $query_arr, $lobname, $lobdata, $where) {
            $arr_total=count($query_arr);        //전체 배열수
            foreach($query_arr as $key=>$val) {
                $query .= $key ."=".$this->set_str($val);

                $arr_total--;
                if($arr_total > 0) {
                        $query.=", ";
                }
            }
                
            //sql문 생성
            $sql="update $dbname set $query, $lobname=empty_clob() $where returning $lobname into :CONTB ";
            if($this->debug) echo $sql;
			//$stmt = @OCIParse($this->db, $sql);

            $clob = OCINewDescriptor($this->db, OCI_D_LOB); 
            $stmt = @OCIParse($this->db, $sql);
            if (!$stmt) {                //에러가 났을경우
                    $erra=OCIError($stmt);
                    $this->error("SQL Error: $erra[code] $erra[message]"); 
            }
            OCIBindByName ($stmt, ":CONTB", &$clob, -1, OCI_B_CLOB); 
            $err=OCIExecute($stmt, OCI_DEFAULT); 
            if (!$err) {                //에러가 났을경우
                    $erra=OCIError($err);
                    $this->error("SQL Error: $erra[code] $erra[message]"); 
            }
            $count=@OCIRowCount($stmt);
            $clob->save($lobdata);
            $this->commit();
            @OCIFreeDesc($clob); 
            @OCIFreeStatement($stmt);
            return $count;
        }

        /***************************** insert & update & delete 쿼리 *******************************************/
        function commit() {        //커밋
                return @OCICommit($this->db);
        }

        function rollback() {        //롤백
                return @OCIRollback($this->db);
        }

}




/**************************  사용예제 *****************************************************/
/*
//초기화 만약 다른 db접속시 ora9('아이디','암호','dns');
$oradb=new ora11g();
$oradb->con(); //접속
$sql="select count(id) from 테이블네임 where id='aaa' ";
$num=$oradb->queryone($sql);	//하나의 값만 받아온다 없으면 false

$sql = "INSERT INTO 테이블네임(컬럼명1,컬럼명1,컬럼명3,컬럼명4) values(벨류값1�.nextval, 벨류값2, 벨류값3, 벨류값4) ";
$num=$oradb->squery($sql);	//업데이트&인설트용&delete 퀴리 return 업데이트, 인설트 갯수

$sql="select 컬럼명1,컬럼명1,컬럼명3,컬럼명4 from 테이블네임 where 컬럼명1='벨류값1' ";
$val=$oradb->query($sql);	//일반 퀴리 $val[컬럼명1] 형식으로 배열로 값이 날라온다. 키값은 대문자임 없으면 false

$sql="select 컬럼명1,컬럼명1,컬럼명3,컬럼명4 from 테이블네임 where 컬럼명1='벨류값1' ";
$val=$oradb->querys($sql);	//여러개 결과용 일반퀴리 $val[0][컬럼명1] 식의 배열로 날라온다 없으면 false


//배열형태로 키값=필드명으로 해서 만든다
$sql_data = Array (
        NO => $b_no,
        SubClass_Code => $cate,
        ID => $this->user_id,
        Title => $org[TITLE],
        PotoFile => $filename,
        Cont => $org[CONT],
        Reg_Id => $this->user_id,
        Reg_Nickname => $this->user_nick,
        OpenFlag => $open,
        filesize => $org[FILESIZE],
        Pick_Memo => $memo,
        PICK_ID => $this->dbid,
        Pick_OpenFlag => 0
);

//db명과 배열을 넣어서 인설트한다.
$oradb->squery_inarr('board', $sql_data);



//위에꺼와 같이 배열로 만들어서 사용. 업데이트용 db명, 배열, 조건
$num=$oradb->squery_uparr('baord', $sql_data, " where no=10");//업데이트 갯수 리턴


$sql_data = Array (
        NO => "mynote_seq.nextval",
        SUBCLASS_CODE => $cate,
        ID => $this->dbid,
        Title => $title,
        Reg_Id => $this->user_id,
        Reg_NickName => $this->user_nick,
        OPEN_FLAG => $open,
        PICKFLAG => $popen,
        Pick_Memo => '',
        HTML_Flag => $html,
);
//CLOB형식 데이타를 인설트하기 위한 퀴리 db명, 배열, CLOB필드명, CLOB데이타
$oradb->squery_inclob('gggg', $sql_data, 'CONT', $cont);

$sql_data = Array (
                SUBCLASS_CODE => $cate,
                Title => $title,
                Reg_NickName => $this->user_nick,
                Open_Flag => $open,
                PICKFLAG => $popen,
                HTML_Flag => $html
        );
//clob형 업데이트 함수 db명, 배열, clob필드명, clob데이타, 조건 return 업데이트 갯수
$num=$oradb->squery_upclob('gggg', $sql_data, 'CONT', $cont, " where no=$no");


$oradb->discon(); //접속해제

///기타
$oradb->autocommit(true);	//commit() 과 rollback() 을 사용할 수 있게한다. 기본 false
$oradb->debug=true;	//디버그모드;; sql문이 출력된다.

*/

?>