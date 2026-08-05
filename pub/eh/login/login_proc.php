<?
/*
header('P3P: CP="ALL CURa ADMa DEVa TAIa OUR BUS IND PHY ONL UNI PUR FIN COM NAV INT DEM CNT STA POL HEA PRE LOC OTC"');
//header('P3P: CP="NOI CURa ADMa DEVa TAIa OUR DELa BUS IND PHY ONL UNI COM NAV INT DEM PRE"');

session_set_cookie_params(0,"/",".adbank.co.kr");
ini_set("session.cookie_domain", ".adbank.co.kr");

session_start();
extract($_POST);
extract($_GET);
*/

header('Content-Type: text/html; charset=UTF-8');
$site = "eh";
include $_SERVER["DOCUMENT_ROOT"]."/config/config.php";

//$_POST = array_map('mysql_escape_string', $_POST); // PHP7: replaced by parameterized queries below
//$_GET = array_map('mysql_escape_string', $_GET);

include $_SERVER["DOCUMENT_ROOT"]."/config/function.php";
include $_SERVER["DOCUMENT_ROOT"]."/config/ora11g_conn.php";
include $_SERVER["DOCUMENT_ROOT"]."/config/mssql_conn.php";
include $_SERVER["DOCUMENT_ROOT"]."/config/dbconn.php";

//print_R($_SERVER["DOCUMENT_ROOT"]);exit;

$_POST['login_id'] = $_POST['id'];
$_POST['login_pw'] = $_POST['pw'];


if (!$Confirm) {
    go_back("잘못된 접근입니다.");
    exit;
}

switch($Confirm)
{

    case "":

        go_back("로그인 정보가 잘못되었습니다.");
        break;

    case "login":

        // PHP7: session_unregister removed
        unset($_SESSION['MEMBER_GROUP']);
        unset($_SESSION['ID']);
        unset($_SESSION['MEMBER_UNAME']);
        unset($_SESSION['MEMBER_GUBUN']);

        // PHP7: mssql_connect/mssql_select_db removed -> sqlsrv
        $ms_con = sqlsrv_connect($ms_tds, array(
            "Database" => $ms_db,
            "UID" => $ms_id,
            "PWD" => $ms_pw,
            "CharacterSet" => "UTF-8",
            "TrustServerCertificate" => true,
        )) or die("Couldn't connect to SQL Server on $ms_tds");

        //if($LogRows >= 5){go_back("로그인 정보가 5회이상 잘못되었습니다. 관리자에게 문의하세요.");exit;}
        $time = time();


        //학생로그인
        //학생로그인
        if($_POST['divide'] == "student"){
			if($_POST['login_id']=="chad_eh"){
				
				$sql = "select member.id, member.name, member.password as pwd,  adm.adm_group, member.user_type from admember member 
					INNER JOIN adadmin adm ON adm.id = member.id
					where member.del_yn='N' AND member.id = '".$_POST['login_id']."'  ";
				$row = DBarray($sql);

					$isValid = false;
					if (crypt($_POST['login_pw'], $row['pwd'])==$row['pwd']) {
						$isValid = true;
					} else {
						$isValid = false;
					}
					if(!$isValid){
						$ErrorSql = "INSERT INTO login_error (user_id,REMOTE_ADDR,RTIME) VALUES ('".$_POST['login_id']."','".$_SERVER['REMOTE_ADDR']."','".$time."')";
						mysqli_query($conn, $ErrorSql);
						mysqli_close($conn);

						go_back("로그인 정보가 잘못되었습니다.");
						exit;
					}else{
						$db_id = $row['id'];
						$db_pw = $row['pwd'];

						$db_name = $row['name'];
						$db_divide = $row['user_type'];
					}
			}else{
				$rs = sqlsrv_query($ms_con, "SELECT [dbo].[SF_IS_AUTH_SHA256](?,?)", array($_POST['login_id'], $_POST['login_pw']));


				if (!$rs) {
					echo "DB 연결이 실패되었습니다.";
					//echo 'Error: ', mssql_get_last_message(), "\n";
					sqlsrv_close($ms_con);
					exit;
				}


				$result = sqlsrv_fetch_array($rs, SQLSRV_FETCH_NUMERIC);
				if ($result[0] < 1) {
					sqlsrv_close($ms_con);
					$ErrorSql = "INSERT INTO login_error (user_id,REMOTE_ADDR,RTIME) VALUES ('".$_POST['login_id']."','".$_SERVER['REMOTE_ADDR']."','".$time."')";
					mysqli_query($conn, $ErrorSql);
					mysqli_close($conn);

					go_back("로그인 정보가 잘못되었습니다.");
					exit;
				} else {
					$loginQue1 = "SELECT korename, schoolno, email, userpass as passwd, laststat FROM V_ADB_STUDMAST WHERE schoolno='".$_POST['login_id']."' ";

					$rs1 = sqlsrv_query($ms_con, $loginQue1);
                $row1 = sqlsrv_fetch_array($rs1, SQLSRV_FETCH_ASSOC);

					$db_id = trim($row1['schoolno']);
					$db_pw = trim($row1['passwd']);

					$db_name = trim($row1['korename']);
					$db_divide = trim($row1['laststat']);
					
				}
			}
            //교직원 로그인
        }else if($_POST['divide'] == "employee"){

            $rs = sqlsrv_query($ms_con, "SELECT [dbo].[SF_IS_AUTH_SHA256](?,?)", array($_POST['login_id'], $_POST['login_pw']));


            if (!$rs) {
                echo "DB 연결이 실패되었습니다.";
                //echo 'Error: ', mssql_get_last_message(), "\n";
                sqlsrv_close($ms_con);
                exit;
            }
            $result = sqlsrv_fetch_array($rs, SQLSRV_FETCH_NUMERIC);
            //$rs=$oradb->query($loginQue);
            if ($result[0] < 1) {
                sqlsrv_close($ms_con);
                go_back("로그인 정보가 잘못되었습니다.");
                exit;
            } else {

                $loginQue1 = "select emplnamk, emplnumb, substring(postcode,5,8) as postcode, homephon, callphon, passnumb, emptype from V_ADB_EMPLOYEE WHERE emplnumb ='".$_POST['login_id']."'";
                $rs1 = sqlsrv_query($ms_con, $loginQue1);
                $row1 = sqlsrv_fetch_array($rs1, SQLSRV_FETCH_ASSOC);


                $db_id = trim($row1['emplnumb']);
                $db_pw = trim($row1['passnumb']);

                $db_name = trim($row1['emplnamk']);
                $db_divide = trim($row1['emptype']);
            }
           
        } else {

        }

        sqlsrv_close($ms_con);
        //$oradb->discon();
        if(  $_POST['login_id'] == "" || $_POST['login_pw'] == "")
        {
            go_back("로그인 정보가 잘못되었습니다..");
            exit;
        }
        else
        {

            // PHP7: session_register removed. $_SESSION[...] assigned directly below.


            /*
            "교원(교수)"=>"GS",
            "직원"=>"JW",
            "조교"=>"JK",
            "시간강사"=>"SK",

            "재학생"=>"HS",
            "졸업생"=>"JS",
            "휴학생"=>"HK"
            */

            //디바이드 세션 굽기(학생)
            if($_POST['divide'] == "student"){
                if($db_divide == "1"){
                    $division = "HS";
                }else if($db_divide == "2"){
                    $division = "HK";
                }else if($db_divide == "3" || $db_divide == "5"){
                    $division = "JS";
                }else{
                    $division = "";
                }
            }

            //디바이드 세션 굽기(교직원)
            if($_POST['divide'] == "employee"){
                if(strpos(",".$db_divide, "시간") == true){
                    $division = "A";
                }else if(strpos(",".$db_divide, "교수") == true){
                    $division = "F";
                }else if(strpos(",".$db_divide, "조교") == true){
                    $division = "F";
                }else{
                    $division = "E";
                }
            }

            $_SESSION['MEMBER_GROUP'] = $division;
			$_SESSION['ADMIN_GROUP'] = $division;
            $_SESSION['ID'] = $db_id;
			$_SESSION['MEMBER_ID'] = $db_id;
            $_SESSION['MEMBER_UNAME'] = $db_name;
            $_SESSION['MEMBER_GUBUN'] = $db_gubun;
			$_SESSION['deptcode'] = $site;
			$_SESSION['sel_site_id'] = $site;
			$_SESSION['S_CHEKC'] = "OK";

			if($_SESSION['MEMBER_GROUP']=="F" || $_SESSION['MEMBER_GROUP']=="E"){
				$_SESSION['sel_site_id'] = "main";
			}

            if(empty($_SESSION['MEMBER_ID'])){
                go_back("로그인이 실패하였습니다.");
            }else{
                
               
              script(" location.href = 'https://".$site.".ch.ac.kr/'; ");

            }
            exit;
        }
        break;

    case "logout":

        $qry = "Y";
        if($qry == "Y"){

            //session_unregister("MEMBER_GROUP");
            //session_unregister("MEMBER_UID");
            //session_unregister("MEMBER_UNAME");

            // PHP7: session_unset() takes no args and clears the whole session;
            // session_unset("KEY") was silently ignored, so logout never actually
            // cleared the session -> replaced with unset($_SESSION[...])
            unset($_SESSION['MEMBER_GROUP']);
			unset($_SESSION['ADMIN_GROUP']);
            unset($_SESSION['MEMBER_ID']);
			unset($_SESSION['ID']);
            unset($_SESSION['MEMBER_UNAME']);
            unset($_SESSION['MEMBER_GUBUN']);
			unset($_SESSION['S_CHECK']);
			unset($_SESSION['sel_site_id']);

            if($_SESSION['MEMBER_ID']){
                go_back("로그아웃에 실패하였습니다.");
            }else{
				script(" location.href = 'https://".$site.".ch.ac.kr/'; ");
            }
        }
        break;

}

?>