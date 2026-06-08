<div class="sub-visual">
    <?
    if($PAGEINDEX1=="7") $PAGEINDEX1="1";
    ?>
    <img src="../img03/sub0<?=$PAGEINDEX1?>/img_subvisual_pc.jpg" alt="" class="pc" />
    <img src="../img03/sub0<?=$PAGEINDEX1?>/img_subvisual_mobile.jpg" alt="" class="mobile" />
    <p>
        <strong>
            <?
            if ( strlen(str_replace("&lt;", "", $PAGENAME1)) > 30 ) {
                echo str_replace("&lt;", "", $PAGENAME1);
            } else {
                echo str_replace("&lt;", "", $PAGENAME1);
            }
            ?>
        </strong>
    </p>
</div>