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