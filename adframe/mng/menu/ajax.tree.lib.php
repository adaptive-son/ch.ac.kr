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
        // 2026.10.02 - $TREE_NO 를 정수로 고정하여 SQL 인젝션 차단
        $del_tree_no = (int)$TREE_NO;
        if ( $del_tree_no <= 0 ) { $data = "ERROR: invalid parameter"; break; }
        // 상위메뉴 삭제
        $sql = " DELETE FROM ".TABLE_TREE." WHERE TREE_NO = '".$del_tree_no."' AND TREE_ID = '".$TREE_ID."' ";
        $adb->query($sql);
        // 하위메뉴 삭제
        $sql = " DELETE FROM ".TABLE_TREE." WHERE PARENT = '".$del_tree_no."' AND TREE_ID = '".$TREE_ID."' ";
        $adb->query($sql);
        break;

    // 메뉴 순서 저장
    case 'order':

        // 2026.10.02 - 메뉴 순서 저장 : INSERT ... ON DUPLICATE KEY UPDATE -> CASE 를 쓴 단일 UPDATE
        //  (1) 기존 INSERT 구문에 TREE_ID(NOT NULL, 기본값 없음)가 빠져 있어, 서버 sql_mode 의
        //      STRICT_TRANS_TABLES 설정에서 "Field 'TREE_ID' doesn't have a default value"(1364)로
        //      쿼리 전체가 실패 → 순서가 한 건도 저장되지 않았음
        //  (2) 순서 저장은 기존 메뉴를 갱신하는 작업이므로 UPDATE 가 맞다. 메뉴명 입력 전의 임시
        //      식별번호(lib.ztree.custom.js 가 5000+n 으로 부여)는 DB에 행이 없어 매칭되지 않으므로,
        //      그것이 새 행으로 INSERT 되어 쓰레기 행이 쌓이던 문제도 함께 사라진다.
        //  (3) TREE_ID 를 WHERE 조건에 넣어 다른 사이트의 메뉴가 갱신될 여지를 없앤다.
        //  (4) 한 건씩 UPDATE 를 돌리면 af_tree(MyISAM)의 테이블락을 메뉴 수만큼 잡았다 놓게 되어,
        //      사이트 조회 트래픽과 맞물리며 저장이 수 초씩 걸렸다(대표 사이트 기준 200건 이상).
        //      max_execution_time(30초)을 넘기면 중간에 끊겨 절반만 저장되는데 MyISAM 은 롤백이
        //      없다. 그래서 CASE 로 묶어 단일 UPDATE 1회로 처리한다 — 락도 1회, 중단 위험도 없다.
        $upd_tree_id = isset($_GET['TREE_ID']) ? preg_replace("/[^A-Za-z0-9_]/", "", $_GET['TREE_ID']) : "";
        if ( $upd_tree_id == "" ) {
            $data = "ERROR: TREE_ID is empty";
            break;
        }

        $exp_line   = explode( "|", $_GET['data'] );            // 라인 구분
        $case_pnt   = "";                                       // PARENT   용 CASE 절
        $case_ord   = "";                                       // ORDER_NO 용 CASE 절
        $case_dep   = "";                                       // DEPTH    용 CASE 절
        $in_list    = "";                                       // 대상 TREE_NO 목록
        $upd_cnt    = 0;                                        // 갱신 대상 건수
        $skip_cnt   = 0;                                        // 형식 불일치로 건너뛴 건수
        foreach ( $exp_line as $k => $v ) {
            $exp_var = explode( ",", $v );                      // 변수 구분
            if ( count($exp_var) < 4 ) { $skip_cnt++; continue; }

            $upd_tree_no  = (int)$exp_var[0];                   // 식별번호
            $upd_parent   = (int)$exp_var[1];                   // 부모식별번호
            $upd_order_no = (int)$exp_var[2];                   // 정렬번호
            $upd_depth    = (int)$exp_var[3];                   // Depth 번호
            if ( $upd_tree_no <= 0 ) { $skip_cnt++; continue; } // 식별번호가 깨진 라인만 제외

            $case_pnt .= " WHEN ".$upd_tree_no." THEN ".$upd_parent;
            $case_ord .= " WHEN ".$upd_tree_no." THEN ".$upd_order_no;
            $case_dep .= " WHEN ".$upd_tree_no." THEN ".$upd_depth;
            if ( $in_list != "" ) $in_list .= ", ";
            $in_list .= $upd_tree_no;
            $upd_cnt++;
        }

        if ( $upd_cnt == 0 ) {
            $data = "ERROR: no valid row";
            break;
        }

        // 값은 전부 (int) 로 고정되어 있고 TREE_ID 는 화이트리스트를 거쳤다.
        // ELSE 절을 둬 혹시 CASE 에 없는 행이 걸려도 기존 값을 유지한다.
        $sql  = " UPDATE ".TABLE_TREE." SET ";
        $sql .= " PARENT = CASE TREE_NO".$case_pnt." ELSE PARENT END ";
        $sql .= " , ORDER_NO = CASE TREE_NO".$case_ord." ELSE ORDER_NO END ";
        $sql .= " , DEPTH = CASE TREE_NO".$case_dep." ELSE DEPTH END ";
        $sql .= " WHERE TREE_ID = '".$upd_tree_id."' AND TREE_NO IN ( ".$in_list." ) ";

        $result = $adb->query($sql);
        if ( PEAR::isError($result) ) {
            $data = "ERROR: ".$result->getMessage()." / ".$result->getDebugInfo();
        } else {
            $data = "DONE ".$upd_cnt.( $skip_cnt > 0 ? " (skip ".$skip_cnt.")" : "" );
        }
        break;
}
echo $data;
include "../include/__footer.php";

