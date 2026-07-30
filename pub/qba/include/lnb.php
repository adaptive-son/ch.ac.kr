<div class="lnb-wrapper">
    <!-- lnb menu -->
    <div class="lnb-area">
		<? if ( strlen(str_replace("&lt;", "", $PAGENAME1)) > 30 ) { ?>
            <h2><a class="topmenu<?=$PAGEINDEX1?>"><?=str_replace("&lt;", "", $PAGENAME1)?></a></h2><span class="arrow"></span>
        <? } else { ?>
            <h2><a class="topmenu<?=$PAGEINDEX1?>"><?=str_replace("&lt;", "", $PAGENAME1)?></a></h2><span class="arrow"></span>
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
                    <a href="<?=$lnb_href?>" class="topmenu<?=$PAGEINDEX1?>-<?=($k+1)?>" <?if($v[cnt] ==0) echo $v[LINK_TARGET];?>>
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