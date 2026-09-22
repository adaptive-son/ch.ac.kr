<?php
// 관리자 사이트별 하위메뉴 레지스트리 (게시판은 제외 - 게시판은 abbs_manager에서 사이트별로 동적 조회)
$GLOBALS['ADMIN_MENU_REGISTRY'] = array(
    'menu_tree'       => '메뉴관리(홈페이지 관리)',
    'professor'       => '교수관리',
    'popup'           => '팝업관리',
    'schedule'        => '일정관리',
    'banner'          => '배너관리',
    'guide_list'      => '한국어교육센터 PDF 메뉴 관리',
    'guide_admission' => '정규과정 입학 PDF 관리',
    'category'        => '규정집 카테고리 관리',
    'toppopup'        => '상단 팝업 관리',
    'tel'             => '전화번호 관리',
    'part'            => '공지사항 부서 관리',
);

// 사이트별로 실제 노출되는 정적 메뉴 키 목록.
// _cms_lnb.php 의 노출 조건과 동일하게 유지해야 한다.
function admin_menu_applicable_keys($site_id) {
    $keys = array('menu_tree', 'popup', 'schedule');

    if ($site_id != "main" && $site_id != "chslc" && $site_id != "global") {
        $keys[] = 'professor';
    }
    if ($site_id == "main" || $site_id == "global2") {
        $keys[] = 'banner';
    }
    if ($site_id == "global2") {
        $keys[] = 'guide_list';
        $keys[] = 'guide_admission';
    }
    if ($site_id == "main") {
        $keys[] = 'category';
        $keys[] = 'toppopup';
        $keys[] = 'tel';
        $keys[] = 'part';
    }
    return $keys;
}

// 사이트에 속한 게시판 목록 (게시판관리 LNB에 노출되는 것과 동일 기준)
function admin_menu_get_boards($site_id) {
    global $adb;

    if ($site_id == "global2") {
        // global2는 이관 전 구 사이트(global)의 게시판도 함께 관리
        $cond = "site_id IN ('global2','global')";
    } else {
        $cond = "site_id='".addslashes($site_id)."'";
    }
    $sql = "SELECT idx, board_id, board_name FROM ".TABLE_BOARD_MNG."
            WHERE idx > 0 AND ".$cond." AND length(board_key) > 2 ORDER BY board_key asc";
    $rs = $adb->query($sql);
    $list = array();
    if (!PEAR::isError($rs)) {
        while ($row = $rs->fetchRow()) {
            $list[] = $row;
        }
    }
    return $list;
}
