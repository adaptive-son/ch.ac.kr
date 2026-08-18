<?php
// 상위 카테고리가 숨김(MENU_ON=N) 처리되어 있으면 표준 메뉴 배열($lnb_no)에서 못 찾으므로
// PARENT를 직접 타고 올라가서 최상위(DEPTH=0) 카테고리를 찾는 보정 로직
if ( !$lnb_no && $TREE_NO ) {
    $lnb_fallback_row = $adb->getRow("SELECT * FROM af_tree WHERE TREE_NO='".$TREE_NO."'", DB_FETCHMODE_ASSOC);
    while ( $lnb_fallback_row && $lnb_fallback_row[DEPTH] > 0 ) {
        $lnb_fallback_row = $adb->getRow("SELECT * FROM af_tree WHERE TREE_NO='".$lnb_fallback_row[PARENT]."'", DB_FETCHMODE_ASSOC);
    }
    if ( $lnb_fallback_row ) {
        $lnb_no = $lnb_fallback_row[TREE_NO];
        if ( trim(str_replace("&lt;", "", $PAGENAME1)) == "" ) $PAGENAME1 = $lnb_fallback_row[NAME]." &lt; ";
    }
}
?>
<div class="lnb-wrapper">
    <!-- lnb menu -->
    <div class="lnb-area">
		<? if ( strlen(str_replace("&lt;", "", $PAGENAME1)) > 30 ) { ?>
            <h2><a class="topmenu<?=$PAGEINDEX1?>"><?=str_replace("&lt;", "", $PAGENAME1)?></a></h2><span class="arrow"></span>
        <? } else { ?>
            <h2><a class="topmenu<?=$PAGEINDEX1?>"><?=str_replace("&lt;", "", $PAGENAME1)?></h2></a><span class="arrow"></span>
        <? } ?>
        <ul>
            <?
            foreach ( $menu_2depth[$lnb_no] as $k => $v ) {
                //var_dump($v);
                if ( $DEPTH < 3 || $v[cnt] ==0){
                    $lnb_href = $v[LINK_URL];

                    if(strpos($v[LINK_TARGET],"blank")){
                        $window_icon = "<span class=\"new-window01\">새 창</span>";
                    }else{
                        $window_icon="";
                    }
                }else{ $lnb_href = "#lnb-menu-depth1";}
                ?>
                <li>
                    <a href="<?=$lnb_href?>" class="topmenu<?=$PAGEINDEX1?>-<?=($k+1)?><?=($v[TREE_NO]==$TREE_NO)?' active':''?>" <?if($v[cnt] ==0) echo $v[LINK_TARGET];?>>
                        <span><?=$v[NAME]?></span>
                        <span class="bg"></span>
                        <? if ( $v[cnt] > 0 ) { ?> <span class="arrow"></span> <? } ?>
                        <?=$window_icon?>
                    </a>
                    <? if ( $v[cnt] > 0 ) {
                        if(strpos($v1[LINK_TARGET],"blank")){
                            $window_icon = "<span class=\"new-window01\">새 창</span>";
                        }else{
                            $window_icon="";
                        }
                        ?>
                        <ul>
                            <? foreach ( $menu_3depth[$v[TREE_NO]] as $k1 => $v1 ) { ?>
                                <li>
                                    <a href="<?=$v1[LINK_URL]?>" <?=$v1[LINK_TARGET]?> class="topmenu<?=$PAGEINDEX1?>-<?=($k+1)?>-<?=$k1+1?>">
                                        <?=$v1[NAME]?>
                                        <span class="bg"></span>
                                        <?=$window_icon?>
                                    </a>
                                </li>
                            <? } ?>
                        </ul>
                    <? } ?>
                </li>
            <? } ?>
        </ul>
    </div>
    <!-- //lnb menu -->

</div>