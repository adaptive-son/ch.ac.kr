<!--
                <div class="contents-navigation-wrapper">
					<div class="contents-navigation-area">
						<div class="contents-navigation">
							<a href="#" class="home">
								<span>HOME</span>
							</a>
							<ul>
								<li>
									<button type="button">ABOUT CHOONHAE</button>
									<ul>
										<li>
											<a href="#" class="topmenu1">
												ABOUT CHOONHAE
											</a>
										</li>
										<li>
											<a href="#" class="topmenu2">
												ACADEMICS
											</a>
										</li>
										<li>
											<a href="#" class="topmenu3">
												ORGANIZATION
											</a>
										</li>
										<li>
											<a href="#" class="topmenu3" target="_blank" title="새창 열림">
												PR CENTER
											</a>											
										</li>
										<li>
											<a href="#" class="topmenu5">
												WORLDWIDE CHOONHAE
											</a>
										</li>
										<li>
											<a href="#" class="topmenu5">
												CAMPUS GUIDE
											</a>
										</li>
									</ul>
								</li>

								<li>
									<button type="button">Mission &amp; Vision</button>

									<ul>
										<li>
											<a href="#" class="topmenu1-1">
												<span class="title">
													Mission &amp; Vision
												</span>
												<span class="bg"></span>
											</a>
										</li>

										<li>
											<a href="#" class="topmenu1-2">
												<span class="title">
													Greetings
												</span>
												<span class="bg"></span>
											</a>
										</li>

										<li>
											<a href="#" class="topmenu1-3">
												<span class="title">
													Message from the President 
												</span>
												<span class="bg"></span>
											</a>
										</li>

										<li>
											<a href="#" class="topmenu1-4">
												<span class="title">
													History
												</span>
												<span class="bg"></span>
											</a>
										</li>

										<li>
											<a href="#" class="topmenu1-5" target="_blank">
												<span class="title">
													History Hall
												</span>
												<span class="bg"></span>
											</a>
										</li>

										<li>
											<a href="#" class="topmenu1-6">
												<span class="title">
													CHOONHAE UI
												</span>
												<span class="bg"></span>
											</a>
										</li>

										<li>
											<a href="#" class="topmenu1-7">
												<span class="title">
													Location &amp; Map
												</span>
												<span class="bg"></span>
											</a>
										</li>

										<li>
											<a href="#" class="topmenu1-8">
												<span class="title">
													Choonhae Hospital
												</span>
												<span class="bg"></span>
											</a>
										</li>
									</ul>
								</li>
							</ul>
						</div> -->

						<!-- 폰트 설정 및 프린트 -->
<!--
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
								<button type="button" class="print" onclick="printWin(this.href); return false;">
									Print
								</button>
							</li>
						</ul>
					</div>
				</div>
-->
<!-- 폰트 설정 및 프린트 -->

<div class="contents-navigation-wrapper">
    <div class="contents-navigation-area">
        <div class="contents-navigation">
            <a href="../main/index.php" class="home">
                <span>HOME</span>
            </a>
            <ul>
                <?
                for ($i=1; $i<=4; $i++) {
                    ?>


                    <? if(${"PAGEINDEX".$i} > 0) { ?>
                        <li class=<?="test".$i?>>
                    <? } else { ?>
                        <li style="display:none;">
                    <? } ?>
                    <button type="button" class="butest" value="<?=str_replace(" &lt; ", "", ${"PAGENAME".$i})?>">
                        <?=str_replace(" &lt; ", "", ${"PAGENAME".$i})?> </button>
                    <ul>
                        <? foreach ( ${"find_".$i."depth"} as ${"num".$i} => ${"row".$i} ) { ?>
                            <?
                            // 첫번째 하위메뉴도 메뉴카테고리일경우 그보다 더 밑의 첫번째 하위메뉴의 링크주소를 가지고옴 ex) 대학생활
                            if ( $row1[cnt] > 0 && ( $row1[ETC1] == "MENU" ) ) {
                                $row1[LINK_URL] = $menu_2depth[$row1[TREE_NO]][0][LINK_URL];
                                $row1[LINK_TARGET] = $menu_2depth[$row1[TREE_NO]][0][LINK_TARGET];
                            }
                            if ( $row2[cnt] > 0 && ( $row2[ETC1] == "MENU" ) ) {
                                // 대학생활 > 대학생활, 학생자치활동 (2차메뉴) 링크 활성화 ( 별도 추가 ) By.Son 2021.01.13
                                if ( $i == 2 && ( $row2["TREE_NO"] == "16098" || $row2['TREE_NO'] == "16119" ) ) {
                                    $row2[LINK_URL] = $menu_4depth[$menu_3depth[$row2['TREE_NO']][0]['TREE_NO']][0]['LINK_URL'];
                                    $row2[LINK_TARGET] = $menu_4depth[$menu_3depth[$row2['TREE_NO']][0]['TREE_NO']][0]['LINK_TARGET'];
                                } else {
                                    $row2[LINK_URL] = $menu_3depth[$row2[TREE_NO]][0][LINK_URL];
                                    $row2[LINK_TARGET] = $menu_3depth[$row2[TREE_NO]][0][LINK_TARGET];
                                }
                            }
                            if ( $row3[cnt] > 0 ) {
                                $row3[LINK_URL] = $menu_4depth[$row3[TREE_NO]][0][LINK_URL];
                                $row3[LINK_TARGET] = $menu_4depth[$row3[TREE_NO]][0][LINK_TARGET];
                            }
                            if ( $row1[cnt] > 0 && ( $row1[ETC1] == "MENU" ) && ( $row1[TREE_NO] == 15992 ) ) {
                                $row1[LINK_URL] = "/contents/contents_view.php?site_id=main&TREE_NO=16011&DEPTH=4";
                            }
                            if ( $row2[cnt] > 0 && ( $row2[ETC1] == "MENU" ) && ( $row2[TREE_NO] == 15997 ) ) {
                                $row2[LINK_URL] = "/contents/contents_view.php?site_id=main&TREE_NO=16011&DEPTH=4";
                            }
                            ?>

                            <? if( $i > 1 && ${"row".$i}[PARENT] == ${"PAGENODE".($i-1)}) { ?>

                                <li class="control">
                                    <a href="<?=${"row".$i}['LINK_URL']?>" <? if ( ${"row".$i}['ETC1'] == "LINK" ) echo " target='_blank' title='새창열림' "; ?> class="topmenu<?=${"num"}.$i ?>">
                                        <span class="title"><?=${"row".$i}['NAME']?></span>
                                    </a>
                                </li>
                            <?} else if( $i == 1 && ${"row".$i}['MENU_ON']=="Y"){ ?>
                                <li class="control">
                                    <a href="<?=${"row".$i}['LINK_URL']?>" <? if ( ${"row".$i}['ETC1'] == "LINK" ) echo " target='_blank' title='새창열림' " ; ?> class="topmenu<?=${"num"}.$i ?>">
                                        <span class="title"><?=${"row".$i}['NAME']?></span>
                                    </a>
                                </li>
                            <?}?>
                        <?}?>
                    </ul>
                    </li>
                <?}?>
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
                <button type="button" class="print" onclick="printWin(this.href); return false;">
                    Print
                </button>
            </li>
        </ul>
        <!-- 폰트 설정 및 프린트 -->
    </div>
</div>