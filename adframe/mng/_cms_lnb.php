<div class="lnb">
    <h1>
        <?=HEAD_TITLE?>
    </h1>

    <?php

		if($_SESSION['ADMIN_GROUP']=="F" || $_SESSION['ADMIN_GROUP']=="E"){
			$sql = " select * from ".TABLE_BOARD_MNG." where idx > 0 AND site_id='main' and length(board_key) >2 order by board_key asc";
		}else if($_SESSION['MEMBER_ID']=="global_korea" || $_SESSION['MEMBER_ID']=="global_global" || $_SESSION['MEMBER_ID']=="global_dev") {
			$sql = " select * from ".TABLE_BOARD_MNG." where idx > 0 AND site_id='$_SESSION[sel_site_id]' and length(board_key) >2 and board_name like '%_".$_SESSION['MEMBER_UNAME']."'  order by board_key asc";
		}else{
			$sql = " select * from ".TABLE_BOARD_MNG." where idx > 0 AND site_id='$_SESSION[sel_site_id]' and length(board_key) >2 order by board_key asc";
		}
    //echo $sql;

    $rs = $adb->query($sql);
    // 총 레코드 수
    $numrows = $rs->numRows();


    ?>

    <div id="lnb">
        <ul>
            <div id="lnb">
                <ul>
                    <li class="on">
                        <!-- 메뉴 1차 DEPTH -->
                        <a href="javascript:;" class="depth" target="ifrm_index">게시판관리</a>
                        <ul style="display: none;">
                            <?php
                            $pg_result = $adb->query($sql);

                            for ( $i = 0 ; $pg_row = $pg_result->fetchRow() ; $i++ ) {
                                ?>
                                <li class="noDepth">
                                    <!-- 메뉴 2차 DEPTH -->
                                    <a href="/adframe/mng/bbs_manager/index.php?managerBoard=<?=$pg_row[board_key]?>&board_id=<?=$pg_row[board_id]?>" target="ifrm_index"><?=$pg_row[board_name]?></a>
                                </li>

                            <?
                            }

                            ?>

							<?php
										if($_SESSION['MEMBER_ID']=="4002"){
							?>
							<li class="noDepth"><a href="/adframe/mng/bbs_manager/index.php?managerBoard=2610&board_id=bbs_main" target="ifrm_index">채용공고</a></li>
							<?php } ?>
								<?php
										if($_SESSION['sel_site_id']=="cook"){
							?>
							<li class="noDepth"><a href="/adframe/mng/bbs_manager/index.php?managerBoard=2610&board_id=bbs_main" target="ifrm_index">공지사항</a></li>
							<?php } ?>
                        </ul>
                    </li>
                    <?php

                    // 2020.12.28 추가 / 학생관리자 권한(A)인 경우, 게시판 권한만 보이게
                    if ( $_SESSION["ADMIN_GROUP"] != "A" ) {
                    ?>

                    <?php
                    if($_SESSION['ADMIN_GROUP']=="F" || $_SESSION['ADMIN_GROUP']=="E"){
                    ?>
                    <?php
                    if($_SESSION['ID']=="2364") {
                    ?>
                    <li>
                        <a href="javascript:;">회원관리</a>
                        <ul style="display:none">
                            <li class="noDepth"><a href="./member/adm.list.php" target="ifrm_index">운영자관리</a></li>
                        </ul>
                    </li>
                    <?php
                    }
                    ?>					
                    <li class="">
                        <!-- 메뉴 1차 DEPTH -->
                        <a href="javascript:;" class="depth">학과장회의</a>
                        <ul style="display: none;">
						<?php
							if($_SESSION['ID']=="2364"){
						?>
                            <li class="noDepth">
                                <!-- 메뉴 2차 DEPTH -->
                                <a href="/adframe/mng/teamjang_meeting/set_member.php" target="ifrm_index">담당자지정</a>
                            </li>
						<?php } ?>
						<?php
							if($_SESSION['ID']=="2832" || $_SESSION['ID']=="2835" ||$_SESSION['ID']=="2826" || $_SESSION['ID']=="2919" || $_SESSION['ID']=="2049" || $_SESSION['ID']=="2606" || $_SESSION['ID']=="2688" || $_SESSION['ID']=="2824" || $_SESSION['ID']=="2015" || $_SESSION['ID']=="2364"){
						?>
						<li class="noDepth">
                                <!-- 메뉴 2차 DEPTH -->
                                <a href="/adframe/mng/teamjang_meeting/" target="ifrm_index">학과장회의</a>
                            </li>
						<?php } ?>
							<li class="noDepth">
                                <!-- 메뉴 2차 DEPTH -->
                                <a href="/adframe/mng/teamjang_meeting/part_write.php" target="ifrm_index">학과장회의 계획서 작성</a>
                            </li>
                        </ul>
                    </li>
					<?php
							if($_SESSION['ID']=="2311" || $_SESSION['ID']=="2115" ||$_SESSION['ID']=="2071"){
						?>
                    <li class="">
                        <a href="javascript:;" class="depth"> 교원채용 </a>
                        <ul style="display: none;">
                            <li class="noDepth">
                                <a href="/adframe/mng/recruit/" target="ifrm_index">교원채용관리</a>
                            </li>
                            <li class="noDepth">
                                <a href="/adframe/mng/recruit2/" target="ifrm_index">교원채용관리(겸임)</a>
                            </li>
							<li class="noDepth">
                                <a href="/adframe/mng/recruit5/" target="ifrm_index">교원채용관리(연구교원)</a>
                            </li>
                            <li class="noDepth">
                                <a href="/adframe/mng/recruit3/" target="ifrm_index">강사채용관리</a>
                            </li>
                        </ul>
                    </li>
					<?php } ?>
                    <?php
                    }
                    ?>
					<?php
					$memberAuthSql = "SELECT * FROM set_member where gubun='recruit_employee'";
					$memberAuthRs = $adb->query($memberAuthSql);
					$memberAuth = $memberAuthRs->fetchRow() ;
					$memberAuthId1 = explode(",",$memberAuth['member_id']);;
					$memberAuthId2 = explode(",",$memberAuth['member_id2']);
					$memberAuthId3 = explode(",",$memberAuth['member_id3']);
					
					$memberAuthId = array_merge($memberAuthId1, $memberAuthId2, $memberAuthId3);

					if(in_array($_SESSION['ID'],$memberAuthId)==true){
					?>
					<li class="">
                        <a href="javascript:;" class="depth"> 직원채용 </a>
                        <ul style="display: none;">
							
							<?php if(in_array($_SESSION['ID'],$memberAuthId1)==true){?>
                            <li class="noDepth">
                                <a href="/adframe/mng/employment/index.php?gubun=직원" target="ifrm_index">직원채용관리</a>
                            </li>
							<?php } ?>
							<?php if(in_array($_SESSION['ID'],$memberAuthId2)==true){?>
							<li class="noDepth">
                                <a href="/adframe/mng/employment/index.php?gubun=산학협력단" target="ifrm_index">산학협력단채용</a>
                            </li>
							<?php } ?>
							<?php if(in_array($_SESSION['ID'],$memberAuthId3)==true){?>
							<li class="noDepth">
                                <a href="/adframe/mng/employment/index.php?gubun=한국어강사" target="ifrm_index">한국어강사채용</a>
                            </li>
							<?php } ?>
							<?php if($_SESSION['ID']=="2364"){?>
							<li class="noDepth">
                                <a href="/adframe/mng/site_manager/set_recruit_employee_member.php" target="ifrm_index">권한관리</a>
                            </li>
							<?php } ?>
						</ul>
					</li>
					<?php  } ?>
                    <li class="">
                        <!-- 메뉴 1차 DEPTH -->
                        <a href="javascript:;" class="depth">메뉴관리</a>
                        <ul style="display: none;">
                            <li class="noDepth">
                                <!-- 메뉴 2차 DEPTH -->
                                <a href="/adframe/mng/menu/tree.manage.php?id=<?=$_SESSION[sel_site_id]?>" target="ifrm_index">홈페이지 관리</a>
                            </li>
                        </ul>
                    </li>
		
                    <li class="">
                        <!-- 메뉴 1차 DEPTH -->
                        <a href="javascript:;" class="depth" target="ifrm_index">사이트운영관리</a>
                        <ul style="display: none;">
							<?
								//대표 홈페이지와 학교기업 언어치료센터가 아닐 경우 교수관리 메뉴 보여짐-20.12.02 shlee
								if($_SESSION[sel_site_id]!="main" && $_SESSION[sel_site_id]!="chslc" && $_SESSION['sel_site_id']!="global") {
							?>
                            <li class="noDepth">
                                <!-- 메뉴 2차 DEPTH -->
                                <a href="/adframe/mng/professor/list.php" target="ifrm_index">교수관리</a>
                            </li>
							<? } ?>
							<?
								//대표 홈페이지와 학교기업 언어치료센터가 아닐 경우 교수관리 메뉴 보여짐-20.12.02 shlee
								//if($_SESSION[sel_site_id]=="main" || $_SESSION[sel_site_id]=="child") {
							?>
                            <li class="noDepth">
                                <!-- 메뉴 2차 DEPTH -->
                                <a href="/adframe/mng/popup/popup.list.php" target="ifrm_index">팝업관리</a>
                            </li>
							<? //} ?>
                            <li class="noDepth">
                                <!-- 메뉴 2차 DEPTH -->
                                <a href="/adframe/mng/schedule/schedule.inc.php" target="ifrm_index">일정관리</a>
                            </li>
							<?
								if($_SESSION[sel_site_id]=="main") {
							?>
							<li class="noDepth">
                                <!-- 메뉴 2차 DEPTH -->
                                <a href="/adframe/mng/category/tree.manage.php" target="ifrm_index">규정집 카테고리 관리</a>
                            </li>
							<li class="noDepth">
                                <a href="/adframe/mng/banner/banner.list.php" target="ifrm_index">배너관리</a>
                            </li>
							<li class="noDepth">
                                <a href="/adframe/mng/toppopup/toppopup.list.php" target="ifrm_index">상단 팝업 관리</a>
                            </li>
							<li class="noDepth">
                                <a href="/adframe/mng/tel/tel.list.php" target="ifrm_index">전화번호 관리</a>
                            </li>
							<li class="noDepth">
                                <a href="/adframe/mng/part/part.list.php" target="ifrm_index">공지사항 부서 관리</a>
                            </li>
							<? } ?>
                        </ul>
                    </li>
					<li class="">
                        <!-- 메뉴 1차 DEPTH -->
                        <a href="http://maintenance.adaptive.co.kr/?id=chadmin" class="depth" target="_blank">유지보수 게시판</a>
                    </li>
                    <? } ?>
					<?php
                    if($_SESSION['MEMBER_ID']=="global_korea"){
					?>
					<li>
                        <a href="javascript:;">한국어연수프로그램</a>
                        <ul style="display:none">
                            <li class="noDepth"><a href="./schedule/schedule.inc.php" target="ifrm_index">한국어연수프로그램</a></li>
                        </ul>
                    </li>
					<?php
					}
					?>
                </ul>


            </div>
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
