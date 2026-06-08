<div class="lnb-wrapper">
    <div class="lnb-area">
        <? if ( strlen(str_replace("&lt;", "", $PAGENAME1)) > 30 ) { ?>
            <h2 style="font-size: 25px; line-height: 30px; padding-top: 25px; height: 87px"><?=str_replace("&lt;", "", $PAGENAME1)?></h2>
        <? } else { ?>
            <h2><?=str_replace("&lt;", "", $PAGENAME1)?></h2>
        <? } ?>

        <?php
        if ($_SERVER['REMOTE_ADDR'] == "112.217.216.250") {
            echo "lnb 메뉴 생성중";
            ?>

            <? var_dump($menu_2depth); ?>
            <!-- lnb menu -->
            <div class="lnb-menu">
                <ul>
                    <?
                    foreach ( $menu_2depth[$lnb_no] as $k => $v ) {
                        //var_dump($v);
                        if ( $DEPTH < 3 || $v[cnt] ==0) $lnb_href = $v[LINK_URL];
                        else $lnb_href = "#lnb-menu-depth1";
                        ?>
                        <li>
                            <a href="<?=$lnb_href?>" class="topmenu<?=$PAGEINDEX1?>-<?=($k+1)?>">
                                <span><?=$v[NAME]?></span>
                                <span class="bg"></span>
                                <? if ( $v[cnt] > 0 ) { ?> <span class="arrow"></span> <? } ?>
                            </a>
                            <? if ( $v[cnt] > 0 ) { ?>
                                <ul>
                                    <? foreach ( $menu_3depth[$v[TREE_NO]] as $k1 => $v1 ) { ?>
                                        <li>
                                            <a href="<?=$v1[LINK_URL]?>" <?=$v1[LINK_TARGET]?> class="topmenu<?=$PAGEINDEX1?>-<?=($k+1)?>-<?=$k1+1?>">
                                                <?=$v1[NAME]?>
                                                <span class="bg"></span>
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

            <?php
        } else {
            ?>
            <!-- lnb menu -->
            <div class="lnb-menu">
                <ul>
                    <?
                    foreach ( $menu_2depth[$lnb_no] as $k => $v ) {
                        if ( $DEPTH < 3 ) $lnb_href = $v[LINK_URL];
                        else $lnb_href = "#lnb-menu-depth1";
                        ?>
                        <li>
                            <a href="<?=$lnb_href?>" class="lnb-menu-depth1" id="lnbmenu<?=($k+1)?>">
                                <?=$v[NAME]?>
                            </a>
                            <? if ( $v[cnt] > 0 ) { ?>
                                <ul class="lnb-submenu" id="lnb-submenu<?=($k+1)?>">
                                    <? foreach ( $menu_3depth[$v[TREE_NO]] as $k1 => $v1 ) { ?>
                                        <li>
                                            <a href="<?=$v1[LINK_URL]?>" <?=$v1[LINK_TARGET]?> id="lnb-submenu<?=($k+1)?>_<?=$k1+1?>">
                                                <?=$v1[NAME]?>
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

            <?php
        }
        ?>

    </div>
</div>