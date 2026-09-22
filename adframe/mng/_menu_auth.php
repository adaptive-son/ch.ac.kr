<?php
// 관리자 사이트별 세부 메뉴/게시판 접근권한 체크
//
// admin_menu_auth 테이블에 특정 (id, site_id, menu_type) 조합의 행이 하나도 없으면
// 세부권한이 한 번도 설정된 적이 없다는 뜻이므로 기존 동작대로 전체 허용한다(하위호환).
// 한 건이라도 있으면 그 중 명시적으로 등록된 menu_key만 허용한다.
function has_menu_auth($site_id, $menu_type, $menu_key) {
    global $adb;

    if ($_SESSION['ADMIN_GROUP'] == "T") return true;

    $id = $_SESSION['MEMBER_ID'];
    if (!$id) return false;

    $cntRow = $adb->getRow("SELECT COUNT(*) AS cnt FROM admin_menu_auth
        WHERE id='".addslashes($id)."' AND site_id='".addslashes($site_id)."' AND menu_type='".addslashes($menu_type)."'");
    if (PEAR::isError($cntRow) || !$cntRow || $cntRow['cnt'] == 0) return true;

    $row = $adb->getRow("SELECT idx FROM admin_menu_auth
        WHERE id='".addslashes($id)."' AND site_id='".addslashes($site_id)."' AND menu_type='".addslashes($menu_type)."' AND menu_key='".addslashes($menu_key)."'");
    if (PEAR::isError($row)) return true;

    return !empty($row);
}

// 권한이 없으면 즉시 종료(메뉴 숨김 뿐 아니라 직접 URL 접근도 차단)
function require_menu_auth($menu_type, $menu_key, $site_id = null) {
    if ($site_id === null) $site_id = $_SESSION['sel_site_id'];
    if (!has_menu_auth($site_id, $menu_type, $menu_key)) {
        alert_replace("/adframe/mng/index.php", "해당 메뉴에 대한 접근 권한이 없습니다.");
    }
}
