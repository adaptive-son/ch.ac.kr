<?
// 메뉴별 Sub-visual 설정 
// pc 
$_sub_visual_path_pc = "/img/sub" . str_pad($PAGEINDEX1, 2, 0, STR_PAD_LEFT) . "/img_subvisual_pc.jpg";
if ( !file_exists($_SERVER["DOCUMENT_ROOT"].$_sub_visual_path_pc) ) {
	$_sub_visual_path_pc = "/img/sub01/img_subvisual_pc.jpg";
} 
// mobile
$_sub_visual_path_mboile = "/img/sub" . str_pad($PAGEINDEX1, 2, 0, STR_PAD_LEFT) . "/img_subvisual_mobile.jpg";
if ( !file_exists($_SERVER["DOCUMENT_ROOT"].$_sub_visual_path_mobile) ) {
	$_sub_visual_path_mobile = "/img/sub01/img_subvisual_mobile.jpg";
} 
?>

<div class="sub-visual">
    <img src="<?=$_sub_visual_path_pc?>" alt="" class="pc">
    <img src="<?=$_sub_visual_path_mobile?>" alt="" class="mobile">

    <div class="word-slogan-wrapper">
        <p class="title">
			<? if ( strlen(str_replace("&lt;", "", $PAGENAME1)) > 30 ) { ?>
				<?=str_replace("&lt;", "", $PAGENAME1)?>
			<? } else { ?>
				<?=str_replace("&lt;", "", $PAGENAME1)?>
			<? } ?>
        </p>
        <p class="type0101">
			미래 문화관광산업을 선도할 관광전문가 양성
		</p>

		<p class="type0201">
			웰니스문화관광과
		</p>
    </div>
</div>