<?

// Menu Info
/*****************************************************************************************/

/*
if($config['is_admin_page'] == false){
	include_once ("/_common/menu.php");										// Page info(function)

	$_MENUS = array();															//key 값으로 메뉴를 찾을 수 있다. : 전역변수
	$_treemenus = array();														//트리구조 메뉴(자식 : child) : 전역변수
	$_menu = NULL;																//현재의 페이지의 메뉴
	$_menuinc = "/_common/menu.php";

	if(!$disable_menu || empty($disable_menu))	$_MENUS = get_menus($_menuinc);	// 페이지 정보 호출
}
 
function get_menus($menu_file){
    $return_menu = array();

/*
    if(!is_file($menu_file)){ exit('메뉴파일이 없습니다.'); }
    $menus = parse_ini_file($menu_file,true);
    if(!count($menus)){ exit('잘못된 메뉴파일입니다.'); } 
	
	foreach($menus as $k=>$v){
        if(!isset($menus[$v[PARENT]][CHILD])){ $menus[$v[PARENT]][CHILD] = array(); }
        if(isset($v[PARENT][0]) && isset($menus[$v[PARENT]])){
            $menus[$k][KEY] = explode("_",$k);
            unset($menus[$k][KEY][0]);
            $menus[$k][KEY] = implode("_",$menus[$k][KEY]);
            unset($menus[$k][PARENT]);
            $menus[$v[PARENT]][CHILD][] = & $menus[$k];
        }
    }

    return reset($menus);
} 

function get_menu_info($_MENUS, $_MENU_INFO){
    $result['navi']		= get_menu_navi($_MENUS, $_MENU_INFO);
	 return $result;
}

function get_menu_navi($_MENUS, $TREE_NO){
    if(empty($_MENUS[CHILD]))	return '';

    $lnb_menu = array();

    $lnb = $_MENUS[CHILD][$TREE_NO[0]-1];

    if(!empty($lnb)){
        $lnb_menu[] = str_repeat(chr(9), 6).'<div class="contents-navigation">';
        $lnb_menu[] = str_repeat(chr(9), 7).'<a href="/" class="home"><span>HOME</span></a>';
        $lnb_menu[] = str_repeat(chr(9), 7).'<ul>';
        $lnb_menu[] = str_repeat(chr(9), 8).'<li><button type="button" class="">'.$lnb['NAME'].'</button>';
        $lnb_menu[] = str_repeat(chr(9), 8).'<ul>';

        if(!empty($_MENUS[CHILD])){
            foreach($_MENUS[CHILD] as $k => $v){

                if($v['gnb_use_yn'] == "N"){
                    if(in_array($id[0], array('9', '10'))){
                        if($k != ($id[0]-1)){
                            continue;
                        }
                    } else {
                        continue;
                    }
                }
                $lnb_menu[] = str_repeat(chr(9), 9).'<li><a href="'.$v[LINK_URL].'" target="'.$v[LINK_TARGET].'">'.$v[NAME].'</a></li>';
            }
        }

        $lnb_menu[] = str_repeat(chr(9), 8).'</ul>';
        $lnb_menu[] = str_repeat(chr(9), 7).'<li>';
        $lnb_menu[] = str_repeat(chr(9), 8).'<button type="button" class="">'.$lnb[CHILD][$id[1]-1][NAME].'</button>';
        $lnb_menu[] = str_repeat(chr(9), 8).'<ul>';
        if(!empty($lnb[CHILD])){
            foreach($lnb[CHILD] as $k => $v ){
                $lnb_menu[] = str_repeat(chr(9), 9).'<li><a href="'.$v[LINK_URL].'" target="'.$v[LINK_TARGET].'">'.$v[NAME].'</a></li>';
            }
        }

        $lnb_menu[] = str_repeat(chr(9), 8).'</ul>';
        $lnb_menu[] = str_repeat(chr(9), 7).'</li>';
        $lnb_menu[] = str_repeat(chr(9), 7).'</ul>';
        $lnb_menu[] = str_repeat(chr(9), 6).'</div>';
    }

    return implode(chr(10),$lnb_menu);

}

$menu_info = get_menu_info($_MENUS, $p_menu);
 */
?>

<div class="contents-navigation-wrapper">
	<div class="contents-navigation-area">
		<div class="contents-navigation">
			<a href="#" class="home">
				<span>HOME</span>
			</a>
				<ul>
					<li>
						<button type="button">대학안내</button>
						<ul>
							<li>
								<a href="http://bv.ch.ac.kr/pub/contents/contents_view.php?site_id=main&TREE_NO=15997&DEPTH=2" class="topmenu1">
									대학안내
								</a>
							</li>
							<li>
								<a href="http://bv.ch.ac.kr/pub/contents/contents_view.php?site_id=main&TREE_NO=16004&DEPTH=2" class="topmenu2">
									학과안내
								</a>
							</li>
							<li>
								<a href="http://ipsiw.ch.ac.kr/page/main/index.php" class="topmenu3" target="_blank" title="새창 열림">
									입학안내
								</a>
							</li>
							<li>
								<a href="http://bv.ch.ac.kr/pub/board/board.php?site_id=main&TREE_NO=16078&DEPTH=2" class="topmenu4">
									뉴스&amp;커뮤니티
								</a>
							</li>
							<li>
								<a href="http://bv.ch.ac.kr/pub/board/board.php?site_id=main&TREE_NO=16087&DEPTH=2" class="topmenu5">
									대학생활
								</a>
							</li>
						</ul>
					</li>
					
					<? include "../main/include/contents_navi_1.php" ?>
					<? include "../main/include/contents_navi_2.php" ?>
					<? include "../main/include/contents_navi_3.php" ?>
					
						</ul>
					</li>
				</ul>
			</div>

						
		<!--

			<? foreach ( $menu_1depth as $k => $v ) { ?>

					<ul>
						<li>
						<button type="button"><?=$v2[NAME]?></button><?
						foreach ( $menu_2depth[$menu_1depth[$k][TREE_NO]] as $k2 => $v2 ) {		
						if ( $v2[cnt] > 0 && ( $v2[ETC1] == "MENU" ) ) $v2[LINK_URL] = $menu_3depth[$v2[TREE_NO]][0][LINK_URL]; ?>
								<ul>
									<li>
										<a href="<?=$v2[LINK_URL]?>" <?=$v2[LINK_TARGET]?> class="topmenu<?=$k+1?>-<?=$k2+1?>">
										<?=$v2[NAME]?>
										</a>
									</li>
								</ul>
						</li>

						<li>
						<button type="button"><?=$v3[NAME]?></button>
						<? foreach ( $menu_3depth[$v2[TREE_NO]] as $k3 => $v3 ) {  ?>
								<ul>
									<li>
										<a href="<?=$v3[LINK_URL]?>" <?=$v3[LINK_TARGET]?> class="topmenu<?=$k+1?>-<?=$k2+1?>-<?=$k3+1?>">
										<?=$v3[NAME]?>
										</a>
									</li>
								</ul>
						</li>

						<li>
						<button type="button"><?=$v4[NAME]?></button>
						<? foreach ( $menu_4depth[$v3[TREE_NO]] as $k4 => $v4 ) {  ?>
								<ul>
									<li>
										<a href="<?=$v4[LINK_URL]?>" <?=$v4[LINK_TARGET]?> class="topmenu<?=$k+1?>-<?=$k2+1?>-<?=$k3+1?>-<?=$k4+1?>">
										<?=$v4[NAME]?>
										</a>
									</li>
								</ul>
						</li>

							</a>
						</li>
						<?}?>
					<?}?>
				<?}?>
			</ul> 
		<?}?>

		

		<!-- 폰트 설정 및 프린트 -->
		<ul class="additional-function-wrapper">
			<li>
				<button type="button" class="big" onclick="zoomOut(); return false;">
					Font Big
				</button>
			</li>
			<li>
				<button type="button" class="reset" onclick="zoomReset(); return false;">
					Font Reset
				</button>
			</li>
			<li>
				<button type="button" class="small" onclick="zoomIn(); return false;">
					Font Small
				</button>
			</li>

			<li>
				<button type="button" class="print" onclick="printWin(this.href); return false;">
					Print
				</button>
			</li>
		</ul>
		<!-- 폰트 설정 및 프린트 -->
	</div>
</div>