<?php
// 1차 뎁스 메뉴가 숨김(MENU_ON=N) 처리된 경우 menu.php에서 만드는 $PAGENAME1이 비므로
// af_tree를 PARENT로 직접 타고 올라가 실제 최상위 카테고리명을 보정한다.
// (include/lnb.php의 동일 보정 로직 참고 — 이 파일은 lnb.php보다 먼저 include되므로 여기서도 별도로 필요)
if ( isset($TREE_NO) && $TREE_NO && trim(str_replace("&lt;", "", $PAGENAME1)) == "" ) {
	$sv_fallback_row = $adb->getRow("SELECT * FROM af_tree WHERE TREE_NO='".$TREE_NO."'", DB_FETCHMODE_ASSOC);
	while ( $sv_fallback_row && $sv_fallback_row[DEPTH] > 0 ) {
		$sv_fallback_row = $adb->getRow("SELECT * FROM af_tree WHERE TREE_NO='".$sv_fallback_row[PARENT]."'", DB_FETCHMODE_ASSOC);
	}
	if ( $sv_fallback_row ) $PAGENAME1 = $sv_fallback_row[NAME]." &lt; ";
}

$pageName1 = $PAGENAME1 ? str_replace("&lt;", "", $PAGENAME1) : "국제교류처";
?>
<div class="sub-visual">
	<img src="../img/sub01/img_subvisual_pc.jpg" alt="" class="pc" />
	<img src="../img/sub01/img_subvisual_mobile.jpg" alt="" class="mobile" />
	<div class="word-slogan-wrapper">
		<p class="title">
			<?php echo $pageName1 ?>
		</p>
	</div>
</div>
