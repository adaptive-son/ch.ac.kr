<?php
    include_once ("_common.php");

    $return_url = $_SERVER[HTTP_REFERER];
    if ( $return_url == "" ) {
        $msg = "올바르지 못한 접근경로입니다.";
        $return_url = "/";
    } else {
        foreach ( $_GET as $k => $v ) ${$k} = $v;
        $dataArr = Decode64($data);

        $sql_chk = " select * from ".$dataArr[DBTable]."_comment where idx = '".$idx."' ";
        $rs_chk = mysql_query($sql_chk);
        if ( mysql_num_rows($rs_chk) <= 0 ) {
            $msg = "해당 댓글은 없거나 이미 삭제되었습니다.";
        } else {
            $sql_del = " update  ".$dataArr[DBTable]."_comment set del_yn='Y'  where idx = '".$idx."' ";
            mysql_query($sql_del);
            $msg = "삭제되었습니다.";
        }
    }

    //cyhwang 2022-07-28 춘해대 소스취약점 패치
    $return_url = urlencode($return_url);
    echo "<script> ";
    if ( $msg != "" ) echo " alert('".$msg."'); ";
    echo " location.replace('".$return_url."'); ";
    echo "</script>";

?>
