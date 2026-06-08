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

$_POST = array_map('mysql_escape_string', $_POST);
$_GET = array_map('mysql_escape_string', $_GET);

include $_SERVER["DOCUMENT_ROOT"]."/config/function.php";
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

        @session_unregister("MEMBER_GROUP");
        @session_unregister("ID");
        @session_unregister("MEMBER_UNAME");
        @session_unregister("MEMBER_GUBUN");

        $ms_con =  mssql_connect($ms_tds, $ms_id, $ms_pw) or die("Couldn't connect to SQL Server on $myServer");
        mssql_select_db($ms_db, $ms_con);

        $time = time();


        //학생로그인
        if($_POST['divide'] == "student"){

            $loginQue = "SELECT [dbo].[SF_IS_AUTH_SHA256]('".$_POST['login_id']."','".$_POST['login_pw']."')";

            $rs= mssql_query($loginQue, $ms_con);


            if (!$rs) {
                echo "DB 연결이 실패되었습니다.";
                //echo 'Error: ', mssql_get_last_message(), "\n";
                mssql_close ($ms_con);
                exit;
            }


            $result = mssql_fetch_array($rs);
            if ($result[0] < 1) {
                mssql_close ($ms_con);
                $ErrorSql = "INSERT INTO login_error (user_id,REMOTE_ADDR,RTIME) VALUES ('".$_POST['login_id']."','".$_SERVER['REMOTE_ADDR']."','".$time."')";
                mysql_query($ErrorSql);
                mysql_close($conn);

                go_back("로그인 정보가 잘못되었습니다.");
                exit;
            } else {
                $loginQue1 = "SELECT korename, schoolno, email, userpass as passwd, laststat FROM V_ADB_STUDMAST WHERE schoolno='".$_POST['login_id']."' ";

                $rs1= mssql_query($loginQue1, $ms_con);

                $db_id = trim(mssql_result($rs1, 0, 'SCHOOLNO'));
                $db_pw = trim(mssql_result($rs1, 0, 'PASSWD'));

                $db_name = trim(mssql_result($rs1, 0, 'KORENAME'));
                $db_divide = trim(mssql_result($rs1, 0, 'LASTSTAT'));

            }
            //교직원 로그인
        }else if($_POST['divide'] == "employee"){

            $loginQue = "SELECT [dbo].[SF_IS_AUTH_SHA256]('".$_POST['login_id']."','".$_POST['login_pw']."')";
            //echo $loginQue;exit;
            $rs= mssql_query($loginQue, $ms_con);

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
                //echo 'Error: ', mssql_get_last_message(), "\n";
                mssql_close ($ms_con);
                exit;
            }
            $result = mssql_fetch_array($rs);
            //$rs=$oradb->query($loginQue);

            //애뱅무조건 특정직원 로그인 cyhwang
            if($_SERVER['REMOTE_ADDR']=="112.217.216.250"){

              if($_POST['login_id'] == "2826" ){
                $result[0] = 1;
              }


            }
            if ($result[0] < 1) {
                mssql_close ($ms_con);
                go_back("로그인 정보가 잘못되었습니다.".$result[0]);
                exit;
            } else {

                $loginQue1 = "select emplnamk, emplnumb, postcode, postname, homephon, callphon, passnumb, emptype from V_ADB_EMPLOYEE WHERE emplnumb ='".$_POST['login_id']."'";
                $rs1= mssql_query($loginQue1, $ms_con);

                $db_id = trim(mssql_result($rs1, 0, 'emplnumb'));
                $db_pw = trim(mssql_result($rs1, 0, 'passnumb'));

                $db_name = trim(mssql_result($rs1, 0, 'emplnamk'));
                $db_divide = trim(mssql_result($rs1, 0, 'emptype'));
				$site_id = trim(mssql_result($rs1,0,'postname'));
            }

        } else {

        }

        mssql_close($ms_con);
        //$oradb->discon();
        if(  $_POST['login_id'] == "" || $_POST['login_pw'] == "")
        {
            go_back("로그인 정보가 잘못되었습니다.");
            exit;
        }
        else
        {

            @session_register("MEMBER_GROUP");
            @session_register("ID");
            @session_register("MEMBER_UNAME");
            @session_register("MEMBER_GUBUN");
			@session_register("site_id");


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

			if($site_id=="간호학과"){
				$deptcode='nurs';
			}else if($site_id=="치위생과"){
				$deptcode = 'dent';
			}else if($site_id=="작업치료과"){
				$deptcode = 'ot';
			}else if($site_id=="응급구조과"){
				$deptcode = 'op';
			}else if($site_id=="안경광학과"){
				$deptcode = 'yoga';
			}else if($site_id=="방사건과"){
				$deptcode = 'radi';
			}else if($site_id=="물리치료과"){
				$deptcode = 'pt';
			}else if($site_id=="언어치료과"){
				$deptcode = 'slt';
			}else if($site_id=="유아교육과"){
				$deptcode = 'child';
			}else if($site_id=="보건행정과"){
				$deptcode = 'hadm';
			}else if($site_id=="사회복지과"){
				$deptcode = 'welf';
			}else if($site_id=="요가과"){
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


              script(" location.href = 'https://www.ch.ac.kr/main/index.php'; ");

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

            session_unset("MEMBER_GROUP");
			session_unset("ADMIN_GROUP");
            session_unset("MEMBER_ID");
			session_unset("ID");
            session_unset("MEMBER_UNAME");
            session_unset("MEMBER_GUBUN");
			session_unset("S_CHECK");
			session_unset("sel_site_id");

            if($_SESSION['MEMBER_ID']){
                go_back("로그아웃에 실패하였습니다.");
            }else{
				script(" location.href = 'https://www.ch.ac.kr/'; ");
            }
        }
        break;

}

?>
