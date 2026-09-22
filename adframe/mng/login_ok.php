<?php
include_once("_common.php");


switch ( $command ) {
    case "":
        alert_back("정상적으로 로그인 하시기 바랍니다.");
        break;
    case "loginAction" :
        // 세션 초기화
        session_unset();
        $sql = "select member.id, member.name, member.password as pwd,  adm.adm_group, member.user_type from ".TABLE_MEMBER." member 
        INNER JOIN ".TABLE_ADMIN." adm ON adm.id = member.id
        where member.del_yn='N' AND member.id = '".$id."'  ";
        $row = $adb->getRow($sql);

        $isValid = false;
		//echo $row['pwd'];
//echo crypt($password, $row['pwd']);exit;
        if (crypt($password, $row['pwd'])==$row['pwd']) {
            $isValid = true;
        } else {
            /* Invalid */
            $isValid = false;
        }

if($_SERVER["REMOTE_ADDR"]=="112.217.216.250"){
//	echo "test<br>";
//	chad_hadm / rhdglch0401 crypt('rhdglch0401', PASSWORD_BCRYPT) 1$jAZ1jlafrKo // 1$NhHblA2EH0s
//	exit;
}
        if ( count($row) == "0" || $isValid == false  ) {
            alert_back("관리자 계정 정보를 다시 확인해주시기 바랍니다.");
        } else {
            //권한이 사이트 관리자일때
            if($row['adm_group']=="S" || $row['adm_group']=="A"){
                    $selSite_sql ="SELECT mng.site_id FROM  ".TABLE_SITE_MNG." mng   INNER JOIN site_admin adm ON adm.site_id = mng.site_id ";
                    $selSite_sql .=" WHERE mng.use_yn ='Y' ";
                    $selSite_sql .=" AND adm.id = '".$row[id]."' ";
                    $selSite_sql .=" ORDER BY mng.site_no asc LIMIT 1";
                    $site_row = $adb->getRow($selSite_sql);
                    if ( count($site_row) == "0" ) {
                        alert_back("관리 사이트가 선택되지 않았습니다.");
                    }else{
                        $_SESSION['sel_site_id'] = $site_row['site_id'];
                    }

                    $selSite_sql2 ="SELECT mng.site_id FROM  ".TABLE_SITE_MNG." mng   INNER JOIN site_admin adm ON adm.site_id = mng.site_id ";
                    $selSite_sql2 .=" WHERE mng.use_yn ='Y' ";
                    $selSite_sql2 .=" AND adm.id = '".$row[id]."' ";
                    $selSite_sql2 .=" ORDER BY mng.site_no asc";
                    $pg_result = $adb->query($selSite_sql2);

                    for ( $i = 0 ; $pg_row = $pg_result->fetchRow() ; $i++ ) {
                        $site_list[$i]= $pg_row['site_id'];
                     }
            }

            // 세션 등록
            $__ARR_SESSION = array("ADMIN_GROUP"=>$row['adm_group'],"ADMIN_SITE"=>$site_list, "MEMBER_ID"=>$row[id], "MEMBER_UNAME"=>$row[name],"MEMBER_GROUP"=>$row[user_type], "S_CHECK"=>"OK");
            foreach ( $__ARR_SESSION as $k => $v ){
                $_SESSION[$k] = $v;
            }
        }
//print_R($_SESSION);exit;
        include_once("./include/__footer.php");
        if ( $_SESSION["ADMIN_GROUP"] == "A" ) {
            alert_replace("/");
        } else {
            alert_replace("./");
        }
        break;
    case "loginEmployeeAction" :
        // 교직원(학사정보시스템) 연동 로그인
        // 홈페이지(pub/main 등)의 교직원 로그인과 동일한 방식으로 학사 DB에서 직접 인증한다.
        session_unset();

        include_once($_SERVER['DOCUMENT_ROOT']."/pub/main/config/mssql_conn.php");

        $ms_con = sqlsrv_connect($ms_tds, array(
            "Database" => $ms_db,
            "UID" => $ms_id,
            "PWD" => $ms_pw,
            "CharacterSet" => "UTF-8",
            "TrustServerCertificate" => true,
        ));

        if (!$ms_con) {
            alert_back("학사정보시스템 연결에 실패하였습니다.");
            break;
        }

        $rs = sqlsrv_query($ms_con, "SELECT [dbo].[SF_IS_AUTH_SHA256](?,?)", array($id, $password));
        $result = $rs ? sqlsrv_fetch_array($rs, SQLSRV_FETCH_NUMERIC) : null;

        if (!$result || $result[0] < 1) {
            sqlsrv_close($ms_con);
            alert_back("교직원 아이디 또는 비밀번호가 일치하지 않습니다.");
            break;
        }

        $rs1 = sqlsrv_query($ms_con, "select emplnamk, emplnumb, postname, emptype from V_ADB_EMPLOYEE WHERE emplnumb = ?", array($id));
        $row1 = $rs1 ? sqlsrv_fetch_array($rs1, SQLSRV_FETCH_ASSOC) : null;
        sqlsrv_close($ms_con);

        if (!$row1) {
            alert_back("교직원 정보를 찾을 수 없습니다.");
            break;
        }

        $emp_id = trim($row1['emplnumb']);
        $emp_name = trim($row1['emplnamk']);
        $emp_type = trim($row1['emptype']);

        // 홈페이지 로그인과 동일한 구분 매핑: 시간강사/조교/교수 -> F(관리자 화면상 교원권한), 그 외 -> E(직원권한)
        if (strpos(",".$emp_type, "시간") !== false) {
            $division = "F";
        } else if (strpos(",".$emp_type, "교수") !== false) {
            $division = "F";
        } else if (strpos(",".$emp_type, "조교") !== false) {
            $division = "F";
        } else {
            $division = "E";
        }

        $__ARR_SESSION = array("ADMIN_GROUP"=>$division, "MEMBER_ID"=>$emp_id, "MEMBER_UNAME"=>$emp_name, "MEMBER_GROUP"=>$division, "S_CHECK"=>"OK", "sel_site_id"=>"main");
        foreach ( $__ARR_SESSION as $k => $v ){
            $_SESSION[$k] = $v;
        }

        alert_replace("./");
        break;

    case "logoutAction" :
        session_unset();
        alert_replace("/adframe/mng/login.php", "로그아웃 되었습니다.");
        break;
}
?>
