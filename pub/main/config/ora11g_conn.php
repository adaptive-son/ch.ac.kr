<?
class ora11g {
        var $ORA_USER;	//����Ŭ �����
        var $ORA_PASSWD;	//����Ŭ ��ȣ
        var $ORA_DNS;	//����Ŭ DNS
        var $db;	//db����
        var $autocommit = true;	//�ڵ�Ŀ��
        var $debug=false;	//����׸��
        
        var $error = array();

        //����Ŭ �������� �ʱ�ȭ
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
        
        //����Ŭ ����
        function con() {
                $this->db= OCILogon($this->ORA_USER,$this->ORA_PASSWD,$this->ORA_DNS) or die("DB Connect Error");
        }

        //����Ŭ ���� ����
        function discon() {
                return @OCILogoff($this->db);
        }

        //�����޼��� ���
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

        //���� ���ڿ���� '' �ٿ���
        function set_str($str) {
			
			//������ ���ڿ�
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
        
        
        /***************************** ���� ������ *******************************************/
        //�Ϲ� ����
        function query($query) {
            if($this->debug) echo $query;
            
            //echo $query;
            //exit;
            
            $stmt = @OCIParse($this->db, $query);
            

            if (!$stmt) {	//������ �������
                    $erra=OCIError($stmt);
                    $this->error("SQL Error: $erra[code] $erra[message]"); 
            }
         	
         	$err=@OCIExecute($stmt);
            if (!$err) {	//������ �������
            	
                    $erra=OCIError($err);
                    $this->error("SQL Error: $erra[code] $erra[message]"); 
            }
            if(@OCIFetchinto($stmt, $value, OCI_ASSOC)) {
                    @OCIFreeStatement($stmt);
                    return $value;	//�迭���·� ����
            } else {
                    @OCIFreeStatement($stmt);
                    return false;
            }
        }

        //�������� ����� ����
        function querys($query) {
                if($this->debug) echo $query;

                $stmt = @OCIParse($this->db, $query);
                if (!$stmt) {	//������ �������
                        $erra=OCIError($stmt);
                        $this->error("SQL Error: $erra[code] $erra[message]"); 
                }
         $err=OCIExecute($stmt);
                if (!$err) {	//������ �������
                        $erra=OCIError($err);
                        $this->error("SQL Error: $erra[code] $erra[message]"); 
                }
                while (@OciFetchinto($stmt,$row,OCI_ASSOC)) {
                        $value[]=$row;

                }

                @OCIFreeStatement($stmt);
                return $value;	//�迭���·� ����
        }

        //�Ѱ��� ���� ���
        function queryone($query) {
                if($this->debug) echo $query;
                
                //echo $query;
                //exit;
                $stmt = @OCIParse($this->db, $query);
                if (!$stmt) {	//������ �������
                        $erra=OCIError($stmt);
                        $this->error("SQL Error: $erra[code] $erra[message]"); 
                }
         $err=@OCIExecute($stmt);
                if (!$err) {	//������ �������
                        $erra=OCIError($err);
                        $this->error("SQL Error: $erra[code] $erra[message]"); 
                }
                if(@OciFetchinto($stmt,$value,OCI_NUM )) {
                        @OCIFreeStatement($stmt);
                        return $value[0];
                } else {
                        @OCIFreeStatement($stmt);
                        return false;
                }
        }
        /***************************** ���� ������ *******************************************/



		/***************************** insert & update & delete ���� *******************************************/
        //insert & update & delete �� ����
        function squery($query) {
            if($this->debug) echo $query;

            $stmt = @OCIParse($this->db, $query);
            if (!$stmt) {	//������ �������
                    $erra=OCIError($stmt);
                    $this->error("SQL Error: $erra[code] $erra[message]"); 
            }

         	if($this->autocommit) {
                        $err=@OCIExecute($stmt);
            } else {
             $err=@OCIExecute($stmt, OCI_DEFAULT);
            }

            if (!$err) {	//������ �������
                    $erra=OCIError($err);
                    $this->error("SQL Error: $erra[code] $erra[message]");
            }
            $count=@OCIRowCount($stmt);
            @OCIFreeStatement($stmt);
            
            return $count;
        }        

        //�迭���·� �μ�Ʈ
        function squery_inarr($dbname, $query_arr, $addcolumn="", $addvalue="") {
            $arr_total=count($query_arr);	//��ü �迭��
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
            
            //sql�� ����
            $sql="insert into $dbname($set$addqryC) values($input$addqryV)";
            //echo $sql;
            //exit;
            if($this->debug) echo $sql;
            $stmt = @OCIParse($this->db, $sql);
            if (!$stmt) {	//������ �������
                    $erra=OCIError($stmt);
                    $this->error("SQL Error: $erra[code] $erra[message]"); 
            }
         
         	if($this->autocommit) {
            	$err=@OCIExecute($stmt);
            } else {
            	$err=@OCIExecute($stmt, OCI_DEFAULT);
            }

            if (!$err) {	//������ �������
                $erra=OCIError($err);
                $this->error("SQL Error: $erra[code] $erra[message]");
            }
            @OCIFreeStatement($stmt);
        }

        //�޸� ���·� ������Ʈ
        function squery_upcomma($dbname, $query_arr, $where) {
            
            $query = $query_arr;
                
            //sql�� ����
            $sql="update $dbname set $query $where";
            //echo $sql;
            //exit;
            if($this->debug) echo $sql;
            $stmt = @OCIParse($this->db, $sql);
            if (!$stmt) {	//������ �������
                    $erra=OCIError($stmt);
                    $this->error("SQL Error: $erra[code] $erra[message]"); 
            }
         
         	if($this->autocommit) {
         		$err=@OCIExecute($stmt);
            } else {
            	$err=@OCIExecute($stmt, OCI_DEFAULT);
            }

            if (!$err) {	//������ �������
                $erra=OCIError($err);
                $this->error("SQL Error: $erra[code] $erra[message]"); 
            }
            //$count=@OCIRowCount($stmt);
            //@OCIFreeStatement($stmt);
            return $count;
        }
        
        
        //�迭���·� ������Ʈ
        function squery_uparr($dbname, $query_arr, $where) {
            $arr_total=count($query_arr);	//��ü �迭��
            foreach($query_arr as $key=>$val) {
                $query .= $key ."= ".$this->set_str($val)."";

                $arr_total--;
                if($arr_total > 0) {
                        $query.=", ";
                }
            }
                
            //sql�� ����
            $sql="update $dbname set $query $where";
            
            if($this->debug) //echo $sql;
            $stmt = @OCIParse($this->db, $sql);
            if (!$stmt) {	//������ �������
                    $erra=OCIError($stmt);
                    $this->error("SQL Error: $erra[code] $erra[message]"); 
            }
         
         	if($this->autocommit) {
         		$err=@OCIExecute($stmt);
            } else {
            	$err=@OCIExecute($stmt, OCI_DEFAULT);
            }

            if (!$err) {	//������ �������
                $erra=OCIError($err);
                $this->error("SQL Error: $erra[code] $erra[message]"); 
            }
            $count=@OCIRowCount($stmt);
            @OCIFreeStatement($stmt);
            return $count;
        }

        //clob���� �Է� ����(�迭��)
        function squery_inclob($dbname, $query_arr, $lobname, $lobdata) {
            $arr_total=count($query_arr);	//��ü �迭��
            foreach($query_arr as $key=>$val) {
                    $set.=$key;
                    $input.=$this->set_str($val);

                    $arr_total--;
                    if($arr_total > 0) {
                            $set.=", ";
                            $input.=", ";
                    }
            }
            
            $sql="insert into $dbname($set, $lobname) values($input, empty_clob()) returning $lobname into :CONTB";        //sql�� ����
            if($this->debug) echo $sql;

            $clob = OCINewDescriptor($this->db, OCI_D_LOB); 
            $stmt = @OCIParse($this->db, $sql);
            if (!$stmt) {                //������ �������
                    $erra=OCIError($stmt);
                    $this->error("SQL Error: $erra[code] $erra[message]"); 
            }

            OCIBindByName ($stmt, ":CONTB", $clob, -1, OCI_B_CLOB);
         	$err=@OCIExecute($stmt, OCI_DEFAULT);
            $clob->save($lobdata);
            $this->commit();
        
            if (!$err) {	//������ �������
                    $erra=OCIError($err);
                    $this->error("SQL Error: $erra[code] $erra[message]"); 
            }
            @OCIFreeDesc($clob);
            @OCIFreeStatement($stmt);
        }

        //CLOB ���� ������Ʈ��
        function squery_upclob($dbname, $query_arr, $lobname, $lobdata, $where) {
            $arr_total=count($query_arr);        //��ü �迭��
            foreach($query_arr as $key=>$val) {
                $query .= $key ."=".$this->set_str($val);

                $arr_total--;
                if($arr_total > 0) {
                        $query.=", ";
                }
            }
                
            //sql�� ����
            $sql="update $dbname set $query, $lobname=empty_clob() $where returning $lobname into :CONTB ";
            if($this->debug) echo $sql;
			//$stmt = @OCIParse($this->db, $sql);

            $clob = OCINewDescriptor($this->db, OCI_D_LOB); 
            $stmt = @OCIParse($this->db, $sql);
            if (!$stmt) {                //������ �������
                    $erra=OCIError($stmt);
                    $this->error("SQL Error: $erra[code] $erra[message]"); 
            }
            OCIBindByName ($stmt, ":CONTB", $clob, -1, OCI_B_CLOB);
            $err=OCIExecute($stmt, OCI_DEFAULT); 
            if (!$err) {                //������ �������
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

        /***************************** insert & update & delete ���� *******************************************/
        function commit() {        //Ŀ��
                return @OCICommit($this->db);
        }

        function rollback() {        //�ѹ�
                return @OCIRollback($this->db);
        }

}




/**************************  ��뿹�� *****************************************************/
/*
//�ʱ�ȭ ���� �ٸ� db���ӽ� ora9('���̵�','��ȣ','dns');
$oradb=new ora11g();
$oradb->con(); //����
$sql="select count(id) from ���̺����� where id='aaa' ";
$num=$oradb->queryone($sql);	//�ϳ��� ���� �޾ƿ´� ������ false

$sql = "INSERT INTO ���̺�����(�÷���1,�÷���1,�÷���3,�÷���4) values(������1�.nextval, ������2, ������3, ������4) ";
$num=$oradb->squery($sql);	//������Ʈ&�μ�Ʈ��&delete ���� return ������Ʈ, �μ�Ʈ ����

$sql="select �÷���1,�÷���1,�÷���3,�÷���4 from ���̺����� where �÷���1='������1' ";
$val=$oradb->query($sql);	//�Ϲ� ���� $val[�÷���1] �������� �迭�� ���� ����´�. Ű���� �빮���� ������ false

$sql="select �÷���1,�÷���1,�÷���3,�÷���4 from ���̺����� where �÷���1='������1' ";
$val=$oradb->querys($sql);	//������ ����� �Ϲ����� $val[0][�÷���1] ���� �迭�� ����´� ������ false


//�迭���·� Ű��=�ʵ������ �ؼ� �����
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

//db���� �迭�� �־ �μ�Ʈ�Ѵ�.
$oradb->squery_inarr('board', $sql_data);



//�������� ���� �迭�� ���� ���. ������Ʈ�� db��, �迭, ����
$num=$oradb->squery_uparr('baord', $sql_data, " where no=10");//������Ʈ ���� ����


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
//CLOB���� ����Ÿ�� �μ�Ʈ�ϱ� ���� ���� db��, �迭, CLOB�ʵ��, CLOB����Ÿ
$oradb->squery_inclob('gggg', $sql_data, 'CONT', $cont);

$sql_data = Array (
                SUBCLASS_CODE => $cate,
                Title => $title,
                Reg_NickName => $this->user_nick,
                Open_Flag => $open,
                PICKFLAG => $popen,
                HTML_Flag => $html
        );
//clob�� ������Ʈ �Լ� db��, �迭, clob�ʵ��, clob����Ÿ, ���� return ������Ʈ ����
$num=$oradb->squery_upclob('gggg', $sql_data, 'CONT', $cont, " where no=$no");


$oradb->discon(); //��������

///��Ÿ
$oradb->autocommit(true);	//commit() �� rollback() �� ����� �� �ְ��Ѵ�. �⺻ false
$oradb->debug=true;	//����׸��;; sql���� ��µȴ�.

*/

?>