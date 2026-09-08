<?php
include __DIR__ . "/nav_data.php";

// menu.php가 만드는 $PAGENAME1/$lnb_no는 1차 뎁스가 숨김(MENU_ON=N) 처리된 경우
// (또는 그 외 이유로) 비어 있는 경우가 있어 신뢰하지 않고, af_tree를 PARENT로 직접
// 타고 올라가 실제 최상위(1차 뎁스) 조상의 TREE_NO/이름을 항상 직접 구한다.
$navTop1TreeNo = null;
$navTop1Name = null;
$navTop1Hidden = false;
if ( isset($TREE_NO) && $TREE_NO ) {
	$navi_row = $adb->getRow("SELECT * FROM af_tree WHERE TREE_NO='".$TREE_NO."'", DB_FETCHMODE_ASSOC);
	while ( $navi_row && $navi_row[DEPTH] > 0 ) {
		$navi_row = $adb->getRow("SELECT * FROM af_tree WHERE TREE_NO='".$navi_row[PARENT]."'", DB_FETCHMODE_ASSOC);
	}
	if ( $navi_row ) {
		$navTop1TreeNo = $navi_row[TREE_NO];
		$navTop1Name = $navi_row[NAME];
		$navTop1Hidden = ( $navi_row[MENU_ON] == 'N' );
	}
}

$pageName1 = $navTop1Name ? $navTop1Name : ( $PAGENAME1 ? str_replace("&lt;", "", $PAGENAME1) : "국제교류처" );
$pageName2 = str_replace("&lt;", "", $PAGENAME2);
$curIdx1 = ( isset($PAGEINDEX1) && isset($GLOBAL2_NAV[$PAGEINDEX1]) ) ? $PAGEINDEX1 : null;

// 1차 뎁스 목록: meta.php에서 이미 만들어진 실제 메뉴($menu_1depth, MENU_ON='Y'만 포함 — 숨김 메뉴는 자동 제외)를 사용.
// 정적 페이지 등 메뉴 데이터가 없는 경우에만 nav_data.php의 고정 목록으로 대체한다.
// 단, 현재 페이지의 1차 뎁스 자체가 대메뉴에서 숨김 처리된 경우(인트로 전용 링크 등)에는
// 다른 카테고리로 옮겨가지 못하도록 자기 자신만 표시한다.
$navDepth1List = array();
if ( $navTop1Hidden ) {
	$navDepth1List[] = array('name' => $navTop1Name, 'href' => '#');
} elseif ( !empty($menu_1depth) ) {
	foreach ( $menu_1depth as $v ) {
		$navDepth1List[] = array('name' => $v[NAME], 'href' => $v[LINK_URL] ? $v[LINK_URL] : '#');
	}
} else {
	foreach ( $GLOBAL2_NAV as $cat ) {
		$navDepth1List[] = array('name' => $cat['name'], 'href' => $cat['href']);
	}
}

// 2차 뎁스 목록: lnb.php와 동일한 개념으로 $menu_2depth[$navTop1TreeNo](실제 CMS 메뉴)를 사용.
// 정적 페이지처럼 $navTop1TreeNo가 없을 때만 nav_data.php의 고정 목록으로 대체한다.
$navDepth2List = array();
if ( $navTop1TreeNo && !empty($menu_2depth[$navTop1TreeNo]) ) {
	foreach ( $menu_2depth[$navTop1TreeNo] as $v ) {
		$navDepth2List[] = array('name' => $v[NAME], 'href' => $v[LINK_URL] ? $v[LINK_URL] : '#');
	}
} elseif ( $curIdx1 ) {
	$navDepth2List = $GLOBAL2_NAV[$curIdx1]['items'];
} elseif ( $pageName2 ) {
	$navDepth2List = array(array('name' => $pageName2, 'href' => '#'));
}
?>
<div class="contents-navigation-wrapper">
	<div class="contents-navigation-area">
		<div class="contents-navigation">
			<a href="../main/index.php" class="home">
				<span>HOME</span>
			</a>
			<ul>
				<li class="control">
					<button type="button" class="butest">
						<?php echo $pageName1 ?>
					</button>
					<ul>
						<?php foreach ( $navDepth1List as $cat ) { ?>
						<li>
							<a href="<?php echo $cat['href'] ?>">
								<span class="title"><?php echo $cat['name'] ?></span>
							</a>
						</li>
						<?php } ?>
					</ul>
				</li>
				<?php if ( $pageName2 ) { ?>
				<li class="control">
					<button type="button" class="butest">
						<?php echo $pageName2 ?>
					</button>
					<ul>
						<?php foreach ( $navDepth2List as $item ) { ?>
						<li>
							<a href="<?php echo $item['href'] ?>">
								<span class="title"><?php echo $item['name'] ?></span>
							</a>
						</li>
						<?php } ?>
					</ul>
				</li>
				<?php } ?>
			</ul>
		</div>

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
				<button type="button" class="print" onclick="printWin(); return false;">
					Print
				</button>
			</li>
		</ul>
		<!-- 폰트 설정 및 프린트 -->
	</div>
</div>
