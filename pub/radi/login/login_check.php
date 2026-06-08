<?
error_reporting(E_ALL);
ini_set("display_errors", 1);

define("__AF__", TRUE);
include($_SERVER["DOCUMENT_ROOT"] . "/adframe/af_common.php");

//print_r2($_POST);

switch ( $command ) {
    case "":
        alert_back("정상적으로 로그인 하시기 바랍니다.");
        break;

    case "loginAction" :
        $divide = $_POST['divide'];
        if($divide == 'student'){
            $user_type = " AND user_type='S'";
        } else if($divide == 'employee'){
            $user_type = " AND user_type IN('E','F')"; //교원 F, 직원 E
        }
        //$test = $_SESSION['sel_site_id'];


        // 세션 초기화
        session_unset();
        $sql = "select id, name, password as pwd, user_type from admember where del_yn='N' AND id = '".$id ."'".$user_type;
        $row = $adb->getRow($sql);

        $isValid = false;
        if (crypt($password, $row['pwd']) == $row['pwd']) {
            $isValid = true;
        } else {
            /* Invalid */
            $isValid = false;
        }

        if (count($row) == "0" || $isValid == false) {
            alert_back("계정 정보를 다시 확인해주시기 바랍니다.");

        } else {
//            $sql = "select member.id, member.name, member.password as pwd, adm.adm_group, member.user_type from admember member INNER JOIN adadmin adm ON adm.id = member.id where member.del_yn='N' AND member.id = '" . $id . "'";
//            $row2 = $adb->getRow($sql);
//
//            if ($row2['adm_group'] == "S") {
//                $selSite_sql = "SELECT mng.site_id FROM  " . TABLE_SITE_MNG . " mng   INNER JOIN site_admin adm ON adm.site_id = mng.site_id ";
//                $selSite_sql .= " WHERE mng.use_yn ='Y' ";
//                $selSite_sql .= " AND adm.id = '" . $row2[id] . "' ";
//                $selSite_sql .= " ORDER BY mng.site_no asc LIMIT 1";
//                $site_row = $adb->getRow($selSite_sql);
//                if (count($site_row) == "0") {
//                    alert_back("관리 사이트가 선택되지 않았습니다.");
//                } else {
//                    $_SESSION['sel_site_id'] = $site_row['site_id'];
//                }
//
//                $selSite_sql2 = "SELECT mng.site_id FROM  " . TABLE_SITE_MNG . " mng   INNER JOIN site_admin adm ON adm.site_id = mng.site_id ";
//                $selSite_sql2 .= " WHERE mng.use_yn ='Y' ";
//                $selSite_sql2 .= " AND adm.id = '" . $row2[id] . "' ";
//                $selSite_sql2 .= " ORDER BY mng.site_no asc";
//                $pg_result = $adb->query($selSite_sql2);
//
//                for ($i = 0; $pg_row = $pg_result->fetchRow(); $i++) {
//                    $site_list[$i] = $pg_row['site_id'];
//                }
//                // 세션 등록
//                $__ARR_SESSION = array("ADMIN_GROUP" => $row2['adm_group'], "ADMIN_SITE" => $site_list, "MEMBER_ID" => $row2[id], "MEMBER_UNAME" => $row2[name], "MEMBER_GROUP" => $row2[user_type], "S_CHECK" => "OK");
//                foreach ($__ARR_SESSION as $k => $v) {
//                    $_SESSION[$k] = $v;
//                }
//            }
            // 세션 등록
            $__ARR_SESSION = array("MEMBER_ID" => $row[id], "MEMBER_UNAME" => $row[name], "MEMBER_GROUP" => $row[user_type], "S_CHECK" => "OK");
            foreach ($__ARR_SESSION as $k => $v) {
                $_SESSION[$k] = $v;
            }
        }
        alert_replace("../main/index.php", "로그인 되었습니다.");
        break;

    case "logoutAction" :
        session_unset();
        alert_replace("/main/index.php", "로그아웃 되었습니다.");
        break;

}

?>