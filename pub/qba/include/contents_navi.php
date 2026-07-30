<div class="contents-navigation-wrapper">
    <div class="contents-navigation">
            <span class="icon-home">Home</span>
            <span class="icon-gt">&gt;</span>
            <?
            for ( $i = 1 ; $i <= $DEPTH ; $i ++ ) {
                if ( ${"PAGENAME".($i+1)} == "" ) {
                    ?>
                    <strong><?=str_replace("&lt;", "", ${"PAGENAME".$i})?></strong>
                    <?
                } else {
                    ?>
                    <span class="location"><?=str_replace("&lt;", "", ${"PAGENAME".$i})?></span>
                    <span class="icon-gt">&gt;</span>
                    <?
                }
            }
            ?>
    </div>
</div>