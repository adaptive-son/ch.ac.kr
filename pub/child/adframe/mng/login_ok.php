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
    case "logoutAction" :
        session_unset();
        alert_replace("/adframe/mng/login.php", "로그아웃 되었습니다.");
        break;
}
?>
