        <?php $tree_id = 'admin'//관리자 메뉴  ?>
		<div class="lnb">
			<h1>
                <?=HEAD_TITLE?>
			</h1>


            <div id="lnb">

                <?
                // 메뉴 정보
                $sql_lnb = " SELECT *, ( SELECT COUNT(*) FROM ".TABLE_TREE." WHERE PARENT = a.TREE_NO ) AS cnt FROM ".TABLE_TREE." AS a ";
                $sql_lnb .= " WHERE TREE_ID = '".$tree_id."' AND MENU_ON = 'Y' ORDER BY PARENT, ORDER_NO ";
                //echo $sql_lnb;
                $rs_lnb = $adb->query($sql_lnb);
                for ( $i = 0 ; $row_lnb = $rs_lnb->fetchRow(DB_FETCHMODE_ASSOC); $i++ ) {
                    // ####### 기본 정보 ########
                    if ( $row_lnb[LINK_TARGET] == "1" ) $row_lnb[LINK_TARGET] = " target = '_blank' ";	// 새창열림
                    else {
                        if ( $row_lnb[ETC1] == "MENU" ) $row_lnb[LINK_TARGET] = " ";
                        else $row_lnb[LINK_TARGET] = " target = 'ifrm_index' ";
                    }
                    // 링크 주소 설정
                    switch ( $row_lnb[ETC1] ) {
                        case 'MENU': $row_lnb[LINK_URL] = "javascript:;"; break;
                        case 'LINK': $row_lnb[LINK_URL] = urldecode($row_lnb[CONTENTS]); break;
                        default: $row_lnb[LINK_URL] = "javascript:;"; break;				// 메뉴관리에서는 링크와 메뉴를 제외하고는 사용하지 않을듯함
                    }
                    if ( $row_lnb[LINK_URL] == "#" ) $row_lnb[LINK_URL] = "javascript:;";

                    // 하위 메뉴존재 여부 확인
                    if ( $row_lnb[cnt] > 0 ) $row_lnb[DEPTH_SUB] = " class='depth' ";
                    else $row_lnb[DEPTH_SUB] = " ";

                    // 1차 DEPTH
                    if ( $row_lnb[DEPTH] == "0" ) {
                        $menu_1depth[] = $row_lnb;							//	상단, 좌측 메뉴를 위해 배열로 저장
                        $find_1depth[$row_lnb[TREE_NO]] = $row_lnb;		//	페이지 정보를 구분하기 위해 배열로 저장
                    }
                    // 2차 DEPTH
                    if ( $row_lnb[DEPTH] == "1" ) {
                        $menu_2depth[$row_lnb[PARENT]][] = $row_lnb;
                        $find_2depth[$row_lnb[TREE_NO]] = $row_lnb;		//	페이지 정보를 구분하기 위해 배열로 저장
                    }
                    // 3차 DEPTH
                    if ( $row_lnb[DEPTH] == "2" ) {
                        $menu_3depth[$row_lnb[PARENT]][] = $row_lnb;
                        $find_3depth[$row_lnb[TREE_NO]] = $row_lnb;		//	페이지 정보를 구분하기 위해 배열로 저장
                    }
                    // 4차 DEPTH ( 탭메뉴 )
                    if ( $row_lnb[DEPTH] == "3" ) {
                        $menu_4depth[$row_lnb[PARENT]][] = $row_lnb;
                        $find_4depth[$row_lnb[TREE_NO]] = $row_lnb;		//	페이지 정보를 구분하기 위해 배열로 저장
                    }
                }

                ?>

                <ul>
                    <? foreach ( $menu_1depth as $k1 => $v1 ) { ?>
                        <li>
                            <!-- 메뉴 1차 DEPTH -->
                            <a href="<?=$v1[LINK_URL]?>" <?=$v1[DEPTH_SUB]?> <?=$v1[LINK_TARGET]?> >
								<?=$v1[NAME]?></a>
                            <? if ( $v1[cnt] > 0 ) { ?>
                                <ul>
                                    <? foreach ( $menu_2depth[$v1[TREE_NO]] as $k2 => $v2 ) { ?>
                                        <li>
                                            <!-- 메뉴 2차 DEPTH -->
                                            <a href="<?=$v2[LINK_URL]?>" <?=$v2[DEPTH_SUB]?> <?=$v2[LINK_TARGET]?> ><?=$v2[NAME]?></a>
                                            <? if ( $v2[cnt] > 0 ) { ?>
                                                <ul>
                                                    <? foreach ( $menu_3depth[$v2[TREE_NO]] as $k3 => $v3 ) { ?>
                                                        <li>
                                                            <!-- 메뉴 3차 DEPTH -->
                                                            <a href="<?=$v3[LINK_URL]?>" <?=$v3[DEPTH_SUB]?> <?=$v3[LINK_TARGET]?> ><?=$v3[NAME]?></a>
                                                        </li>
                                                    <? } ?>
                                                </ul>
                                            <? } ?>
                                        </li>
                                    <? } ?>
									<?php
									if($v1['TREE_NO']=="16227"){
									?>
									<li >
										<!-- 메뉴 2차 DEPTH -->
										<a href="/adframe/mng/teamjang_meeting/set_member.php" target="ifrm_index">담당자지정</a>
									</li>
									<li>
										<!-- 메뉴 2차 DEPTH -->
										<a href="/adframe/mng/teamjang_meeting/" target="ifrm_index">학과장회의</a>
									</li>
									<li>
										<!-- 메뉴 2차 DEPTH -->
										<a href="/adframe/mng/teamjang_meeting/part_write.php" target="ifrm_index">학과장회의 계획서 작성</a>
									</li>
									<?php
									}
									?>
                                </ul>
                            <? } ?>
                        </li>
                    <? } ?>
                </ul>


            </div>
		</div>

        <!--
		<script type="text/javascript">

			// 메뉴 depth 페이지 전역 변수
			var menuDepth = 0;
			var powerinstance;
			jQuery(function($){ // on DOM load
				powerinstance = new Powerlistmenu({
					menuid: 'powermenu1' // id of main nav container
				})
			});

			// powerlistmenu 에서 depth별로 상태 업데이트.
			// 자체 라이브러리에서는 라이브러리 정보를 제공하지 않음..
			function updateDepthInfo(menuDepth) {
				menuDepth = menuDepth * 1; // casting
				if (menuDepth == 0) {
					addImgDepth(3);
				} else if (menuDepth == 1) {
					addImgDepth(2);
				} else {
					addImgDepth(1);
				}
			}

			function addImgDepth(imgCnt) {
				var imgHtml = '<img src="./make_img/common/icon_circle01.png" alt="" />';
				var rtnHtml = "";
				for (var i=0; i<imgCnt; i++) {
					rtnHtml += imgHtml;
				}
				$('.count-depth-area').empty().html(rtnHtml);
			}

		</script>
		-->
        <script>
            /* lnb */
            (function ($) {
                var lnbUI = {
                    click: function (target, speed) {
                        var _self = this, $target = $(target);
                        _self.speed = speed || 300;
                        $target.each(function () {
                            if (findChildren($(this))) {
                                return;
                            }
                            $(this).addClass('noDepth');
                        });
                        function findChildren(obj) {
                            return obj.find('> ul').length > 0;
                        }

                        $target.on('click', 'a', function (e) {
                            e.stopPropagation();
                            var $this = $(this), $depthTarget = $this.next(), $siblings = $this.parent().siblings();
                            $this.parent('li').find('ul li').removeClass('on');
                            $siblings.removeClass('on');
                            $siblings.find('ul').slideUp(250);
                            if ($depthTarget.css('display') == 'none') {
                                _self.activeOn($this);
                                $depthTarget.slideDown(_self.speed);
                            } else {
                                $depthTarget.slideUp(_self.speed);
                                _self.activeOff($this);
                            }
                            $this.parent().addClass("on");
                        })
                    }, activeOff: function ($target) {
                        $target.parent().removeClass('on');
                    }, activeOn: function ($target) {
                        $target.parent().addClass('on');
                    }
                };

                // Call lnbUI
               $(function(){ lnbUI.click('#lnb li', 300) });
            }(jQuery));
        </script>
