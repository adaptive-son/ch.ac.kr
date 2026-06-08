<?
include_once "../_common.php";

// 해당 테이블 Column 정보
$arr_columns = desc_columns(TABLE_CATEGORY);

// 새창으로 열림값 설정
if ( $_POST[LINK_TARGET] == "" || !$_POST[LINK_TARGET] ) $_POST[LINK_TARGET] = '0';

switch ( $mode ) {
    // 메뉴 상세 정보 저장
    case 'new':
        // 최대 TreeID 값
        $sql = " SELECT MAX(TREE_NO) FROM ".TABLE_CATEGORY;
        $_POST[TREE_NO] = ($adb->getOne($sql)) + 1;
        foreach ( $_POST as $k => $v ) {
            if ( in_array($k, $arr_columns) > 0 ) {
                if ( $sql_sub != "" ) $sql_sub .= ", ";
                if ( $k == PARENT && $v == "" ) $v = '0';
                $sql_sub .= $k." = '".$v."' ";
            }
        }
        $sql = " INSERT INTO ".TABLE_CATEGORY." SET ".$sql_sub;
        $adb->query($sql);
        break;

    // 메뉴 상세 정보 수정
    case 'edit':
        foreach ( $_POST as $k => $v ) {
            if ( $k != TREE_NO &&  in_array($k, $arr_columns) > 0 ) {
                if ( $sql_sub != "" ) $sql_sub .= ", ";
                $sql_sub .= $k." = '".$v."' ";
            }
            if ( $k == TREE_NO ) $sql_where = " WHERE ".$k." = '".$v."' ";
        }
        $sql = " UPDATE ".TABLE_CATEGORY." SET ".$sql_sub.$sql_where;
        $adb->query($sql);
        break;
}

alert_replace($HTTP_REFERER);

include_once "__footer.php";
?>