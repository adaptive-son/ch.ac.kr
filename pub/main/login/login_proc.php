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

include $_SERVER["DOCUMENT_ROOT"]."/config/config.php";

//$_POST = array_map('mysql_escape_string', $_POST); // PHP7: mysql_escape_string 제거됨. 아래에서 파라미터 바인딩으로 대체
//$_GET = array_map('mysql_escape_string', $_GET);

include $_SERVER["DOCUMENT_ROOT"]."/config/function.php";
include $_SERVER["DOCUMENT_ROOT"]."/config/dbconn.php";
include $_SERVER["DOCUMENT_ROOT"]."/config/ora11g_conn.php";
include $_SERVER["DOCUMENT_ROOT"]."/config/mssql_conn.php";

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

        unset($_SESSION['MEMBER_GROUP']); // PHP7: session_unregister 제거됨
        unset($_SESSION['ID']);
        unset($_SESSION['MEMBER_UNAME']);
        unset($_SESSION['MEMBER_GUBUN']);

        // PHP7: mssql_connect/mssql_select_db 제거됨(mssql 확장 없음) -> sqlsrv로 대체
        $ms_con = sqlsrv_connect($ms_tds, array(
            "Database" => $ms_db,
            "UID" => $ms_id,
            "PWD" => $ms_pw,
            "CharacterSet" => "UTF-8",
            "TrustServerCertificate" => true,
        )) or die("Couldn't connect to SQL Server on $ms_tds");

        $time = time();


        //학생로그인
        if($_POST['divide'] == "student"){

            $rs = sqlsrv_query($ms_con, "SELECT [dbo].[SF_IS_AUTH_SHA256](?,?)", array($_POST['login_id'], $_POST['login_pw']));


            if (!$rs) {
                echo "DB 연결이 실패되었습니다.";
                sqlsrv_close($ms_con);
                exit;
            }


            $result = sqlsrv_fetch_array($rs, SQLSRV_FETCH_NUMERIC);
            if ($result[0] < 1) {
                sqlsrv_close($ms_con);
                mysqli_query($conn, "INSERT INTO login_error (user_id,REMOTE_ADDR,RTIME) VALUES ('".mysqli_real_escape_string($conn, $_POST['login_id'])."','".$_SERVER['REMOTE_ADDR']."','".$time."')");
                mysqli_close($conn);

                go_back("로그인 정보가 잘못되었습니다.");
                exit;
            } else {
                $rs1 = sqlsrv_query($ms_con, "SELECT korename, schoolno, email, userpass as passwd, laststat FROM V_ADB_STUDMAST WHERE schoolno=?", array($_POST['login_id']));
                $row1 = sqlsrv_fetch_array($rs1, SQLSRV_FETCH_ASSOC);

                $db_id = trim($row1['schoolno']);
                $db_pw = trim($row1['passwd']);

                $db_name = trim($row1['korename']);
                $db_divide = trim($row1['laststat']);

            }
            //교직원 로그인
        }else if($_POST['divide'] == "employee"){

            $rs = sqlsrv_query($ms_con, "SELECT [dbo].[SF_IS_AUTH_SHA256](?,?)", array($_POST['login_id'], $_POST['login_pw']));

            if($_SERVER['REMOTE_ADDR']=="112.217.216.250"){
              /*
              $loginQue1 = "select emplnamk, emplnumb, postcode, postname, homephon, callphon, passnumb, emptype from V_ADB_EMPLOYEE WHERE emplnumb ='".$_POST['login_id']."'";
              echo $loginQue1;
              $rs1= mssql_query($loginQue1, $ms_con);
              print_R(mssql_fetch_array($rs1));
              //exit;

              $db_pw = trim(mssql_result($rs1, 0, 'passnumb'));
              echo $db_pw;
              */
            }


            if (!$rs) {
                echo "DB 연결이 실패되었습니다.";
                sqlsrv_close($ms_con);
                exit;
            }
            $result = sqlsrv_fetch_array($rs, SQLSRV_FETCH_NUMERIC);
            //$rs=$oradb->query($loginQue);

            //�ֹ����� Ư������ �α��� cyhwang
            if($_SERVER['REMOTE_ADDR']=="112.217.216.250"){

              if($_POST['login_id'] == "2826" ){
                $result[0] = 1;
              }


            }
            if ($result[0] < 1) {
                sqlsrv_close($ms_con);
                go_back("로그인 정보가 잘못되었습니다.".$result[0]);
                exit;
            } else {

                $rs1 = sqlsrv_query($ms_con, "select emplnamk, emplnumb, postcode, postname, homephon, callphon, passnumb, emptype from V_ADB_EMPLOYEE WHERE emplnumb = ?", array($_POST['login_id']));
                $row1 = sqlsrv_fetch_array($rs1, SQLSRV_FETCH_ASSOC);

                $db_id = trim($row1['emplnumb']);
                $db_pw = trim($row1['passnumb']);

                $db_name = trim($row1['emplnamk']);
                $db_divide = trim($row1['emptype']);
				$site_id = trim($row1['postname']);
            }

        } else {

        }

        sqlsrv_close($ms_con);
        //$oradb->discon();
        if(  $_POST['login_id'] == "" || $_POST['login_pw'] == "")
        {
            go_back("로그인 정보가 잘못되었습니다.");
            exit;
        }
        else
        {

            // PHP7: session_register 제거됨. 아래에서 $_SESSION[...] 직접 대입으로 대체됨
			

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

			if($site_id=="��ȣ�а�"){
				$deptcode='nurs';
			}else if($site_id=="ġ������"){
				$deptcode = 'dent';
			}else if($site_id=="�۾�ġ���"){
				$deptcode = 'ot';
			}else if($site_id=="���ޱ�����"){
				$deptcode = 'op';
			}else if($site_id=="�Ȱ汤�а�"){
				$deptcode = 'yoga';
			}else if($site_id=="���ǰ�"){
				$deptcode = 'radi';
			}else if($site_id=="����ġ���"){
				$deptcode = 'pt';
			}else if($site_id=="���ġ���"){
				$deptcode = 'slt';
			}else if($site_id=="���Ʊ�����"){
				$deptcode = 'child';
			}else if($site_id=="����������"){
				$deptcode = 'hadm';
			}else if($site_id=="��ȸ������"){
				$deptcode = 'welf';
			}else if($site_id=="�䰡��"){
				$deptcode = 'yoga';
			}

            $_SESSION['MEMBER_GROUP'] = $division;
			$_SESSION['ADMIN_GROUP'] = $division;
            $_SESSION['ID'] = $db_id;
			$_SESSION['MEMBER_ID'] = $db_id;
            $_SESSION['MEMBER_UNAME'] = $db_name;
            $_SESSION['MEMBER_GUBUN'] = $db_gubun;
			$_SESSION['deptcode'] = $deptcode;
			$_SESSION['sel_site_id'] = $deptcode;
			$_SESSION['S_CHEKC'] = "OK";

			if($_SESSION['MEMBER_GROUP']=="F" || $_SESSION['MEMBER_GROUP']=="E"){
				$_SESSION['sel_site_id'] = "main";
			}

            if(empty($_SESSION['MEMBER_ID'])){
                go_back("로그인이 실패하였습니다.");
            }else{

              $target_site = !empty($_SESSION['sel_site_id']) ? $_SESSION['sel_site_id'] : "main";
              $target_host = ($target_site == "main") ? "www.ch.ac.kr" : $target_site.".ch.ac.kr";
              script(" location.href = 'https://".$target_host."/main/index.php'; ");

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

            // PHP7: session_unset()는 인자를 받지 않고 세션 전체를 지우는 함수라
            // session_unset("KEY") 형태 호출은 조용히 무시되어 세션이 전혀 지워지지
            // 않았음(로그아웃이 항상 실패로 표시되던 원인) -> unset($_SESSION[...])로 교체
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
				script(" location.href = 'https://www.ch.ac.kr/'; ");
            }
        }
        break;

}

?>
