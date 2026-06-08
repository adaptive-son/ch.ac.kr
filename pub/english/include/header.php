<header>
	<!-- skip navigation -->
	<p class="skip-navigation">
		<a href="#contents">Skip to Contents</a>
	</p>
	<!-- //skip navigation -->
	<div class="header">
		<div class="header-wrapper">
			<div class="bg"></div>
			<div class="header-area">
				<h1>
					<a href="/english/main/index.php">
						<img src="../img03/common/logo.png" alt="" />
					</a>
				</h1>

				<ul class="right-menu">
					<li>
						<a href="../main/index.php">
							HOME
						</a>
					</li>
					<li>
						<a href="https://www.ch.ac.kr/" target="_blank" title="Open a new window">
							KOREAN
						</a>
					</li>
				</ul>

				<button type="button" class="btn-totalmenu">
					<span class="menu">
						<span></span>
						<span></span>
						<span></span>
					</span>
				</button>
			</div>

			<div class="top-menu-wrapper">
				<? include "menu.php" ?>

                <button type="button" class="btn-totalmenu">
                    <span class="menu">
						<span></span>
						<span></span>
						<span></span>
					</span>
                </button>

			</div>
		</div>
	</div>

	<div class="mask-totalmenu"></div>
        <div class="totalmenu-wrapper">
            <div class="mobile-gnb-wrapper">
                <ul>
                    <li>
                        <a href="../main/index.php">
                            <img src="../img03/common/icon_mobile_gnb0101.png" alt="" />
                            <strong>
                                HOME
                            </strong>
                        </a>
                    </li>

                    <li>
                        <a href="https://www.ch.ac.kr/" target="_blank" title="Open a new window">
                            <img src="../img03/common/icon_mobile_gnb0103.png" alt="" />
                            <strong>
                                KOREAN
                            </strong>
                        </a>
                    </li>
                <ul>

            </div>

            <!--
        <div class="totalmenu-area">
            <ul>
                <? foreach ( $menu_1depth as $k => $v ) {
                    // 메뉴카테고리일 경우, 첫번째 하위메뉴의 링크주소를 가지고 옴
                    if ( $v[cnt] > 0 && ( $v[ETC1] == "MENU" ) ) $v[LINK_URL] = $menu_2depth[$v[TREE_NO]][0][LINK_URL];

                    // 첫번째 하위메뉴도 메뉴카테고리일경우 그보다 더 밑의 첫번째 하위메뉴의 링크주소를 가지고옴 ex) 대학생활
                    if($menu_2depth[$v[TREE_NO]][0][cnt] > 0 && ($menu_2depth[$v[TREE_NO]][0][ETC1] == "MENU")){
                        $v[LINK_URL] = $menu_3depth[$menu_2depth[$v[TREE_NO]][0][TREE_NO]][0][LINK_URL];

                    }
                    ?>
                    <li>
                        <a href="<?=$v[LINK_URL]?>" class="topmenu<?=$k+1?>" <?=$v[LINK_TARGET]?>>
                                <span class="title">
									<span data-hover="<?=$v[NAME]?>">
                                        <?=$v[NAME]?>
                                    </span>
                                </span>
                        </a>
                        <div class="top-submenu">
                            <h2><a class="topmenu<?=$k+1?>"><?=$v[NAME]?></a></h2><span class="arrow"></span>
                            <ul>
                                <?
                                foreach ( $menu_2depth[$menu_1depth[$k][TREE_NO]] as $k2 => $v2 ) {
                                    // 메뉴카테고리일 경우, 첫번째 하위메뉴의 링크주소를 가지고 옴
                                    if ( $v2[cnt] > 0 && ( $v2[ETC1] == "MENU" ) ) $v2[LINK_URL] = $menu_3depth[$v2[TREE_NO]][0][LINK_URL];
                                    ?>
                                    <li>
                                        <a href="<?=$v2[LINK_URL]?>" <?=$v2[LINK_TARGET]?> class="topmenu<?=$k+1?>-<?=$k2+1?>">
                                            <span class="title"><?=$v2[NAME]?></span>
                                            <span class="bg"></span>
                                            <?php if(strpos($v2[LINK_TARGET],"blank")){?><span class="new-window01">새 창</span><?}?>
                                        </a>
                                    </li>
                                    <?
                                }
                                ?>

                            </ul>
                        </div>
                    </li>
                <?}?>
            </ul>
        </div>
        -->

            <div class="totalmenu-area">
                <div class="totalmenu-depth1">
                    <ul>
                        <?
                        foreach ( $menu_1depth as $k => $v ) {
                            // 메뉴카테고리일 경우, 첫번째 하위메뉴의 링크주소를 가지고 옴
                            if ( $v[cnt] > 0 && ( $v[ETC1] == "MENU" ) )
                                $v[LINK_URL] = $menu_2depth[$v[TREE_NO]][0][LINK_URL];
                            $v[LINK_TARGET] = $menu_2depth[$v[TREE_NO]][0][LINK_TARGET];

                            // 첫번째 하위메뉴도 메뉴카테고리일경우 그보다 더 밑의 첫번째 하위메뉴의 링크주소를 가지고옴 ex) 대학생활
                            if($menu_2depth[$v[TREE_NO]][0][cnt] > 0 && ($menu_2depth[$v[TREE_NO]][0][ETC1] == "MENU")){
                                $v[LINK_URL] = $menu_3depth[$menu_2depth[$v[TREE_NO]][0][TREE_NO]][0][LINK_URL];
                            }

                            //3차 까지 메뉴카테고리일 경우 4차 메뉴 링크 가져옴 ex)대학안내 - 20.12.21 shlee
                            if($menu_3depth[$menu_2depth[$v[TREE_NO]][0][TREE_NO]][0][cnt] > 0 && ($menu_3depth[$menu_2depth[$v[TREE_NO]][0][TREE_NO]][0][ETC1] == "MENU")){
                                $v[LINK_URL] = $menu_4depth[$menu_3depth[$menu_2depth[$v[TREE_NO]][0][TREE_NO]][0][TREE_NO]][0][LINK_URL];
                            }

                            //입학메뉴에서 입학홈페이지 링크 말고 입학상담 링크주소를 가지고옴
                            if($menu_2depth[$v[TREE_NO]][0][ETC1] == "LINK" && $menu_2depth[$v[TREE_NO]][0][LINK_TARGET] == "1"){
                                $v[LINK_TARGET] = $menu_2depth[$v[TREE_NO]][1][LINK_TARGET];
                                $v[LINK_URL] = $menu_2depth[$v[TREE_NO]][1][LINK_URL];
                            }

                            if($v[MENU_ON]=="Y") {
                                ?>
                                <li>
                                    <?
                                    if($v[cnt]>0 && $v[ETC1]=="MENU") {
                                        ?>
                                        <button type="button" class="topmenu<?=$k+1?>">
								<span>
									<?=$v[NAME]?>
								</span>
                                        </button>
                                    <? } else if($v[cnt]=="0" && $v[ETC1]=="LINK") { ?>
                                        <a href="<?=$v[LINK_URL]?>" class="topmenu<?=$k+1?>" target="_blank">
								<span>
									<?=$v[NAME]?>
								</span>
                                        </a>
                                    <? } ?>
                                </li>

                            <? } } ?>
                    </ul>
                </div>


                <div class="totalmenu-depth2-wrapper">
                    <div class="totalmenu-depth2-area">
                        <div class="totalmenu-depth2-box">
                            <?
                            foreach ( $menu_1depth as $k => $v ) {
                                if($v[cnt]>0 && $v[ETC1]=="MENU") {
                                    ?>
                                    <div class="totalmenu-depth2-group topmenu<?=$k+1?>">
                                        <h2>
                                            <?=$v[NAME]?>
                                        </h2>
                                        <ul>
                                            <?
                                            foreach ( $menu_2depth[$menu_1depth[$k][TREE_NO]] as $k2 => $v2 ) {
                                                ?>
                                                <li>
                                                    <? if($v2[cnt]>0 && $v2[ETC1]=="MENU") { ?>
                                                    <a href="/pub/english/contents/contents_view_en.php?site_id=english&TREE_NO=16263&DEPTH=3" <?=$v2[LINK_TARGET]?> class="topmenu<?=$k+1?>-<?=$k2+1?>">
                                                    <? } else { ?>
                                                    <a href="<?=$v2[LINK_URL]?>" <?=$v2[LINK_TARGET]?> class="topmenu<?=$k+1?>-<?=$k2+1?>">
                                                        <? } ?>
                                                        <span class="title">
                                                            <?=$v2[NAME]?>
                                                        </span>
                                                    </a>
                                                </li>
                                            <? } ?>
                                        </ul>
                                    </div>
                                <? } } ?>
                            </div>

                        <div class="totalmenu-depth2-box">
                            <?
                            foreach ( $menu_1depth as $k => $v ) {
                                foreach ( $menu_2depth[$v[TREE_NO]] as $k2 => $v2 ) {
                                    if($v2[cnt]>0 && $v2[ETC1]=="MENU") {
                                        ?>
                                        <div class="totalmenu-depth3-group topmenu<?=$k+1?>-<?=$k2+1?>">
                                            <h3>
                                                <button type="button">
                                                    <?=$v2[NAME]?>
                                                </button>
                                            </h3>

                                            <ul class="topmenu<?=$k+1?>-<?=$k2+1?>">
                                                <?
                                                foreach ( $menu_3depth[$v2[TREE_NO]] as $k3 => $v3 ) {
                                                    ?>
                                                    <li>
                                                        <a href="<?=$v3[LINK_URL]?>" <?=$v3[LINK_TARGET]?> class="topmenu<?=$k+1?>-<?=$k2+1?>-<?=$k3+1?>">
                                                            <?=$v3[NAME]?>
                                                            <?
                                                            if($v3[cnt]>0) {
                                                                ?>
                                                                <span class="arrow"></span>
                                                            <? } ?>
                                                        </a>
                                                    </li>
                                                <? } ?>
                                            </ul>
                                        </div>
                                    <? } } } ?>
                        </div>

                    </div>
                </div>
            </div>
            <button type="button" class="btn-mobile-close">
                <img src="../img03/common/btn_close_mobile.png" alt="totalmenu close" />
            </button>

</header>
<script>
    $(document).ready(function() {
        $('#btnLogout').bind('click', function() {
            if(confirm('로그아웃 하시겠습니까?')) {
                location.replace('/login/sso/logout.php');
            }
        })
    });
</script>