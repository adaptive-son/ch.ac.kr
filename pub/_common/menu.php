<?php

// 메뉴 정보
$sql_menu = " SELECT *, ( SELECT COUNT(*) FROM ".TABLE_TREE." WHERE PARENT = a.TREE_NO ) AS cnt FROM ".TABLE_TREE." AS a ";
$sql_menu .= " WHERE TREE_ID = '".TREE_ID."' AND MENU_ON = 'Y' ORDER BY PARENT, ORDER_NO ";
$rs_menu = $adb->query($sql_menu);
for ( $i = 0 ; $row_menu = $rs_menu->fetchRow(DB_FETCHMODE_ASSOC); $i++ ) {
    // ####### 기본 정보 ########
    // 상단메뉴 및 좌측 메뉴를 위한 파라미터
    $prm_forMenu = "site_id=".TREE_ID."&TREE_NO=".$row_menu[TREE_NO]."&DEPTH=".($row_menu[DEPTH]+1);
    // 새창열림
    if ( $row_menu[LINK_TARGET] == "1" ) $row_menu[LINK_TARGET] = " target = '_blank' ";
    else $row_menu[LINK_TARGET] = "";
    // 링크 주소 설정
    switch ( $row_menu[ETC1] ) {
        case 'MENU': $row_menu[LINK_URL] = "javascript:void(0);"; break;
        case 'LINK': if($row_menu[LINK_TARGET]==" target = '_blank' "){
            $row_menu[LINK_URL] = urldecode($row_menu[CONTENTS]);
        }else if($row_menu[CONTENTS] == '/schedule/list.php'){
            $row_menu[LINK_URL] = urldecode($row_menu[CONTENTS]."?".$prm_forMenu);
        }else{
            $row_menu[LINK_URL] = urldecode($row_menu[CONTENTS]."&".$prm_forMenu);
        }

        break;
        case 'CONTENTS':
        case 'TAB':
        case 'TABUPPER':
            $row_menu[LINK_URL] = "/contents/contents_view.php?".$prm_forMenu;
            break;
        case 'BOARD': if ($row_menu[NAME] == "산학협력") {
            $row_menu[LINK_URL] = "/board/board.php?".$prm_forMenu."&category=산학협력";
		} else {
			$row_menu[LINK_URL] = "/board/board.php?".$prm_forMenu;
		}
            break;
    }
    // 1차 DEPTH
    if ( $row_menu[DEPTH] == "0" ) {
        $menu_1depth[] = $row_menu;							//	상단, 좌측 메뉴를 위해 배열로 저장
        $find_1depth[$row_menu[TREE_NO]] = $row_menu;		//	페이지 정보를 구분하기 위해 배열로 저장
    }
    // 2차 DEPTH
    if ( $row_menu[DEPTH] == "1" ) {
        $menu_2depth[$row_menu[PARENT]][] = $row_menu;
        $find_2depth[$row_menu[TREE_NO]] = $row_menu;		//	페이지 정보를 구분하기 위해 배열로 저장
    }
    // 3차 DEPTH
    if ( $row_menu[DEPTH] == "2" ) {
        $menu_3depth[$row_menu[PARENT]][] = $row_menu;
        $find_3depth[$row_menu[TREE_NO]] = $row_menu;		//	페이지 정보를 구분하기 위해 배열로 저장
    }
    // 4차 DEPTH ( 탭메뉴 )
    if ( $row_menu[DEPTH] == "3" ) {
        // 탭메뉴 처리를 위해 재정의
        $row_menu[LINK_URL] = "/contents/contents_view.php?site_id=".TREE_ID."&TREE_NO=".$row_menu[PARENT]."&DEPTH=".$row_menu[DEPTH]."&CHILD=".$row_menu[TREE_NO] ;
        $menu_4depth[$row_menu[PARENT]][] = $row_menu;
        $find_4depth[$row_menu[TREE_NO]] = $row_menu;		//	페이지 정보를 구분하기 위해 배열로 저장
    }
}
// 페이지 정보
$PARENTNO = $TREE_NO;
for ( $i = $DEPTH ; $i > 0 ; $i-- ) {
    ${"PAGENAME".$i} = ${"find_".$i."depth"}[$PARENTNO][NAME]." &lt; ";
    ${"PAGEINDEX".$i} = ${"find_".$i."depth"}[$PARENTNO][ORDER_NO];
    if ( $i == "1" ) $lnb_no = ${"find_".$i."depth"}[$PARENTNO][TREE_NO];
    $PARENTNO = ${"find_".$i."depth"}[$PARENTNO][PARENT];
}

?>