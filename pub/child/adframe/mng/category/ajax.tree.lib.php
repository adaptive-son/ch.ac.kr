<?
include "../_common.php";

switch ( $mode ) {
    // 메뉴 삭제
    case 'del':
        // 상위메뉴 삭제
        $sql = " DELETE FROM ".TABLE_CATEGORY." WHERE TREE_NO = '".$TREE_NO."' ";
        $adb->query($sql);
        // 하위메뉴 삭제
        $sql = " DELETE FROM ".TABLE_CATEGORY." WHERE PARENT = '".$TREE_NO."' ";
        $adb->query($sql);
        break;

    // 메뉴 순서 저장
    case 'order':

        $exp_line = explode( "||", $_POST[data] );              // 라인 구분
        foreach ( $exp_line as $k => $v ) {
            $exp_var = explode( "//", $v );                     // 변수 구분
            if ( $sql_sub != "" ) $sql_sub .= ", ";             // 삽입값 구분
            $sql_sub .= " ( ";
            for ( $i = 0 ; $i < count($exp_var) ; $i++ ) {
                if ( $i != 0 ) $sql_sub .= ", ";
                $sql_sub .= " '".$exp_var[$i]."' ";
            }
            $sql_sub .= " ) ";
        }

        $sql = " INSERT INTO ".TABLE_CATEGORY." ( TREE_NO, PARENT, ORDER_NO, DEPTH ) VALUES ".$sql_sub;
        $sql .= " ON DUPLICATE KEY UPDATE TREE_NO = VALUES(TREE_NO), PARENT = VALUES(PARENT) , ORDER_NO = VALUES(ORDER_NO) , DEPTH = VALUES(DEPTH) ";

        $adb->query($sql);
        $data = "DONE";
        break;
}

echo $data;

include "../include/__footer.php";
?>