<?
include_once("../_common.php");

// 이미지 첨부 관련
include_once("./inc.img.upload.php");

// Table Columns Names
$cols = desc_columns(TABLE_CMS_CONTENTS);

$patterns = "<link rel=\"stylesheet\" href=\"/page/css/common.css\"><link rel=\"stylesheet\" href=\"/page/css/sub.css\"><link rel=\"stylesheet\" href=\"/page/css/board.css\">";

switch ( $mode ) {
    // 추가
    case 'insert':
        $sql_sub = " REGDATE = '".date("Y-m-d H:i:s")."' ".$sql_file; //, WRITER = '".$_SESSION[mb_id]."' ";  // 로그인 기능 구현 후 적용
        foreach ( $_POST as $k => $v ) {
            if ( in_array($k, $cols) > 0 && $v != "" ) {
                if ( $k == "CONTENTS" ) {
                    $v = str_replace($patterns, "", $v);
                    $v = addslashes($v);      // 따옴표 처리
                }
                $sql_sub .= ", ".$k." = '".$v."' ";
            }
        }
        $sql = " INSERT INTO ".TABLE_CMS_CONTENTS." SET ".$sql_sub;
        $adb->query($sql);
        break;

    // 수정
    case 'update':
        foreach ( $_POST as $k => $v ) {
            if ( in_array($k, $cols) > 0 && ( $k != $TREE_NO && $k != $TREE_ID ) ) {
                if ( $sql_sub != "" ) $sql_sub .= ", ";
                if ( $k == CONTENTS ) {
                    $v = str_replace($patterns, "", $v);
                    $v = addslashes(htmlspecialchars($v));      // 태그 치환, 따옴표 처리
                }
                $sql_sub .= $k." = '".$v."' ";
            }
            if ( $k == "TREE_NO" || $k == "TREE_ID" ) {
                if ( $sql_where != "" ) $sql_where .= " and ";
                $sql_where .= $k." = '".$v."' ";
            }
        }
        if ( $sql_sub != "" ) $sql_file = $sql_file;
        else $sql_file = substr($sql_file, 1);
        $sql = " UPDATE ".TABLE_CMS_CONTENTS." SET ".$sql_sub." ".$sql_file." WHERE ".$sql_where;
        $adb->query($sql);
        break;

    default:
        alert("올바르지 못한 데이터가 존재합니다.");
        break;
}
alert_replace($_SERVER["HTTP_REFERER"]);

