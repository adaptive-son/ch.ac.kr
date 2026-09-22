<? include "../_common.php" ?>

<?php
if($mode=="u" || $mode=="d") {

    $sql = " select * from ".TABLE_ADMIN." where id = '$id' ";
    $cnt = mysql_num_rows(mysql_query($sql));
    if($cnt < 1) alert_msg("회원을 찾을 수 없습니다.");
}


if($mode=="") {
    $sql = " insert into ".TABLE_ADMIN." (id, adm_group,regi_date,modi_date) 
    values ('".$id."','".$adm_group."',now(),now())  ";
} else if ($mode=="u") {
    $sql = " update ".TABLE_ADMIN." set adm_group='".$adm_group."' , modi_date = now() where id = '$id'" ;
} else if ($mode=="d") {
    $sql = " delete from ".TABLE_ADMIN." where id = '$id' ";
}
$result = mysql_query($sql) or die(mysql_error());

$sql = "delete from site_admin where id='$id'";
$result = mysql_query($sql) or die(mysql_error());

// 사이트별 하위메뉴/게시판 세부권한 초기화 후 재저장
$sql = "delete from admin_menu_auth where id='".addslashes($id)."'";
$result = mysql_query($sql) or die(mysql_error());

for($i=0; $i<count($_POST['cms_site_id']); $i++){
    $siteId = $_POST['cms_site_id'];

    $sql = " INSERT INTO
                  site_admin (
                     site_id,
                     id,
                     regi_date
                  )
               VALUES (
                  '$siteId[$i]',
                  '$id',
                  now()
               )";

      $result = mysql_query($sql) or die(mysql_error());

    // 세부 메뉴/게시판 권한 ("선택 허용"으로 지정된 사이트만 제한 저장, "전체 허용"이면 행을 남기지 않음)
    $siteMode = isset($_POST['site_mode'][$siteId[$i]]) ? $_POST['site_mode'][$siteId[$i]] : "all";
    if ($siteMode == "custom") {
        $menuKeys = isset($_POST['site_menu'][$siteId[$i]]) ? $_POST['site_menu'][$siteId[$i]] : array();
        if (count($menuKeys) == 0) $menuKeys = array("__none__");
        foreach ($menuKeys as $menuKey) {
            $sql = "INSERT INTO admin_menu_auth (id, site_id, menu_type, menu_key, regi_date)
                    VALUES ('".addslashes($id)."','".addslashes($siteId[$i])."','menu','".addslashes($menuKey)."', now())";
            $result = mysql_query($sql) or die(mysql_error());
        }

        $boardKeys = isset($_POST['site_board'][$siteId[$i]]) ? $_POST['site_board'][$siteId[$i]] : array();
        if (count($boardKeys) == 0) $boardKeys = array("__none__");
        foreach ($boardKeys as $boardKey) {
            $sql = "INSERT INTO admin_menu_auth (id, site_id, menu_type, menu_key, regi_date)
                    VALUES ('".addslashes($id)."','".addslashes($siteId[$i])."','board','".addslashes($boardKey)."', now())";
            $result = mysql_query($sql) or die(mysql_error());
        }
    }
}


if($mode=="u") {
    alert_href("adm.list.php","정상적으로 수정되었습니다.");
}else if($mode=="d"){
    alert_href("adm.list.php","정상적으로 삭제되었습니다.");
}else {
    alert_href("adm.list.php","저장되었습니다.");
}

?>


