<?php
////$httpOrigin = $_SERVER['HTTP_ORIGIN'];
////$allowedOrigin = array('https://bv.ch.ac.kr/');
////if (in_array($httpOrigin, $allowedOrigin)){
////  header("Access-Control-Allow-Origin: {$httpOrigin}");
////}
//header("Access-Control-Allow-Origin: *");
//header('Access-Control-Allow-Credentials:true');
//header("Access-Control-Max-Age: 86400");
//header("Access-Control-Allow-Headers: x-requested-with");
//header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
//header("Content-type:text/html;charset=utf-8");
//$httpOrigin = $_SERVER['HTTP_ORIGIN'];
//header('Access-Control-Allow-Methods: GET, POST');
include "../_common.php";

switch ( $mode ) {
    // 메뉴 삭제
    case 'del':
        // 상위메뉴 삭제
        $sql = " DELETE FROM ".TABLE_TREE." WHERE TREE_NO = '".$TREE_NO."' AND TREE_ID = '".$TREE_ID."' ";
        $adb->query($sql);
        // 하위메뉴 삭제
        $sql = " DELETE FROM ".TABLE_TREE." WHERE PARENT = '".$TREE_NO."' AND TREE_ID = '".$TREE_ID."' ";
        $adb->query($sql);
        break;

    // 메뉴 순서 저장
    case 'order':

        $exp_line = explode( "||", $_GET['data'] );              // 라인 구분
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

        $sql = " INSERT INTO ".TABLE_TREE." ( TREE_NO, PARENT, ORDER_NO, DEPTH ) VALUES ".$sql_sub;
        $sql .= " ON DUPLICATE KEY UPDATE TREE_NO = VALUES(TREE_NO), PARENT = VALUES(PARENT) , ORDER_NO = VALUES(ORDER_NO) , DEPTH = VALUES(DEPTH) ";

        $result = $adb->query($sql);
		$data = "DONE";
		/*
        $data = array(
			"sql"=>$sql, 
			"result"=>$result
		);
		$data = json_encode($data);
		*/
        break;
}
echo $data;
include "../include/__footer.php";

