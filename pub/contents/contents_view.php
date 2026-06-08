<?php
// 개별 페이지 실행 방지. 해당 문자열은 inc.constant.php에 정의된다.
define("__AF__", TRUE);
// adframe 템플릿 페이지 설정.
include($_SERVER["DOCUMENT_ROOT"] . "/adframe/af_common.php");
require_once (ADFRAME_ROOT_PATH."/lib/class_bbs.php");

if($_SERVER["REMOTE_ADDR"] == "112.217.216.250"){
  //print_r($rs_infoContents);
  //print_r($menu_3depth['16002'][3]);


}

//통학버스안내 임시처리 : 2022-02-10
//통학버스안내 임시처리 삭제 : 2022-02-18
/*
if($_GET['TREE_NO'] == "16183" | $_GET['TREE_NO'] == "16184"){

  $dvChar = strpos($_SERVER["HTTP_REFERER"],'?') !== false ? "&":"?";
  alert_href($_SERVER["HTTP_REFERER"].$dvChar."popup=/popup/20220210.html&popupw=520&popuph=500");
  //echo $_SERVER["HTTP_REFERER"];
  exit;
}
*/
?>
<!doctype html>
<html lang="ko">
<head>
    <?
    if($TREE_ID=="") $TREE_ID = $_GET['site_id'];
    define(TREE_ID,$TREE_ID);
    include("../".$TREE_ID."/include/meta.php");

    if ( $TREE_NO == "" || !$TREE_NO ) go_back("페이지를 찾을 수 없습니다.");
    else {
        $sql_infoContents = " SELECT * FROM ".TABLE_CMS_CONTENTS." WHERE TREE_ID = '".TREE_ID."' AND TREE_NO = '".$TREE_NO."' ";
		//echo $sql_infoContents;
        $rs_infoContents = $adb->getRow($sql_infoContents, DB_FETCHMODE_ASSOC);

        if($_SERVER["REMOTE_ADDR"] == "112.217.216.250"){
          //print_r($rs_infoContents);
          //print_r($menu_3depth['16002'][3]);
        }
    }
    ?>
    <title><?=$PAGENAME4.$PAGENAME3.$PAGENAME2.$PAGENAME1._TAG_TITLE?></title>
</head>
<body>
	<!-- skip navigation -->
	<p class="skip-navigation">
		<a href="#contents">본문 바로가기</a>
	</p>
	<!-- //skip navigation -->


	<!-- popup -->
	<?
		if($TREE_ID=="main") include "../_common/top_popup.php"
	?>
	<!-- //popup -->


<!-- wrapper -->
<div class="wrapper" id="wrapper">
    <!-- header -->
    <? include("../".$TREE_ID."/include/header.php");?>
    <!-- //header -->


	<!-- quick menu -->
	<?
		if($TREE_ID=="main") {
	?>
			<div class="aside-quickmenu-wrapper" id="public-quickmenu">
				<button>
					<span>
						QUICK<br />
						MENU
					</span>

					<img src="/_common/img02/quickmenu/icon_arrow01.png" alt="" />
				</button>

				<!-- 퀵메뉴는 추후 학과들에게도 큇메뉴가 추가된다고 하여 assets쪽에 작업을 하였습니다 -->
				<? include "../_common/quickmenu.php" ?>
				<!-- //퀵메뉴는 추후 학과들에게도 큇메뉴가 추가된다고 하여 assets쪽에 작업을 하였습니다 -->
			</div>
	<? } ?>
	<!-- //quick menu -->


    <!-- sub visual -->
    <? include("../".$TREE_ID."/include/sub_visual.php"); ?>
    <!-- sub visual -->

    <!-- container -->
    <section>
        <div class="container" id="container">
			<? include("../".$TREE_ID."/include/contents_navi.php");?>
            <div class="container-wrapper">
			<!-- lnb -->
			<?
				include("../".$TREE_ID."/include/lnb.php");
			?>
			<!-- //lnb -->
            <!-- contents -->
            <article>
                <div class="contents" id="contents">
                    <h3 class="contents-title">
						<?
							//대표 홈페이지 이고 $DEPTH가 4인 경우 부모의 메뉴명을 가져옴 - 20.12.04 shlee
							$PARENT = ${"find_".$DEPTH."depth"}[$TREE_NO][PARENT];
							if($DEPTH=="4" && $TREE_ID=="main") {
								echo ${"find_3depth"}[$PARENT][NAME];
							} else {
								echo ${"find_".$DEPTH."depth"}[$TREE_NO][NAME];
							}
						?>
                        <span class="arrow"></span>
                    </h3>

                    <!-- contents-wrapper -->
                    <div class="contents-wrapper">

						<?
							//글로벌 인재양성센터 게시판 예외처리- 20.12.17 shlee
							if($TREE_ID=="main" && ($TREE_NO=="16183" || $TREE_NO=="16184")) {
						?>
							<p style="text-align:center;">(2026년 2월 25일 기준)</p>
						<?
							}
						?>


                        <?
                        if ( $TREE_ID!="main" && ${"find_".$DEPTH."depth"}[$TREE_NO][ETC1] != "TABUPPER" ) {
                            echo stripslashes(htmlspecialchars_decode($rs_infoContents[CONTENTS]));
                            // 담당자 정보
                            $STAFF_NAME = $rs_infoContents[STAFF];
                            $STAFF_TEL = $rs_infoContents[STAFF_TEL];
                            $STAFF_UPDATE = $rs_infoContents[STAFF_REGDATE];
                        } else if ($TREE_ID=="main" && $DEPTH=="4") {
							//대학 대표 홈페이지고 4차메뉴일 경우 탭처리 - 20.12.07 shlee
						?>
						<div class="tabmenu-wrapper ratio no-mobile-title">
							<?
								$sql_tabContents2 = " SELECT * FROM af_tree WHERE TREE_ID = '".TREE_ID."' AND PARENT = '".$PARENT."' AND MENU_ON='Y' ORDER BY ORDER_NO ASC";
						//echo $sql_tabContents2;
								$rs = DBquery($sql_tabContents2);
								$tabdepth = mysql_num_rows($rs);
								// 기본 탭메뉴 6개 기본
								if ($tabdepth >= 6) $tabdepth = "6";
								//부설기관쪽 하위메뉴에 적용될 갯수 - 20.12.09 shlee
								if ($PARENT=="16034") $tabdepth = "5";
								//시설안내쪽 하위메뉴에 적용될 갯수 - 20.12.18 shlee
								if ($PARENT=="16108") $tabdepth = "3";
							?>
							<ul class="depth<?=$tabdepth;?>">
							<?
								
								while($bbs_row2=mysql_fetch_array($rs)){
								if ($bbs_row2[ETC1] == "LINK") {
								$LINK_URL = $bbs_row2['CONTENTS'];
								} else if ($bbs_row2[ETC1] != "BOARD") {
								$LINK_URL = "/contents/contents_view.php?site_id=main&TREE_NO=".$bbs_row2['TREE_NO']."&DEPTH=".$DEPTH."";
								} else if ($bbs_row2[ETC1] == "BOARD") {
								$LINK_URL = "/board/board.php?site_id=main&TREE_NO=".$bbs_row2['TREE_NO']."&DEPTH=".$DEPTH."";
								} 

							?>
								<li class="topmenu<?=$PAGEINDEX1?>-<?=$PAGEINDEX2?>-<?=$PAGEINDEX3?>-<?=$bbs_row2['ORDER_NO']?>">
									<a href="<?=$LINK_URL?>" <?if($bbs_row2[LINK_TARGET] == "1") {?> target="_blank" <?}?>><?=$bbs_row2['NAME']?></a>
								</li>
							<? } ?>
							</ul>

						</div>

						<?
							//글로벌 인재양성센터 게시판 예외처리- 20.12.17 shlee
							if($TREE_ID=="main" && $TREE_NO=="16047") {
						?>

							<div class="tabmenu-wrapper02">
								<ul>
									<li>
										<a href="#none" class="active" id="tabmenu1">
											소개
										</a>
									</li>
									<li>
										<a href="#none" id="tabmenu2">
											게시판
										</a>
									</li>
								</ul>
							</div>

						<? } ?>

                        <?=stripslashes(htmlspecialchars_decode($rs_infoContents[CONTENTS]))?>

						<?
							//글로벌 인재양성센터 게시판 예외처리- 20.12.17 shlee
							if($TREE_ID=="main" && $TREE_NO=="16047") {
						?>
							<div class="tab-contents" id="tab-box2">
								<?
									$dataArr=Decode64($_GET['data']);
									create_bbs("2634", "", "0", "", "", "");

								?>
							</div>
                            <script>
                                $(document).ready(function() {
                                    <?
                                    // 게시판 페이징 버튼 클릭시, 게시판 페이징 이동이 아닌, 컨텐츠 페이지로 넘어가는 내용 수정
                                    // 주의사항 : 링크를 복사하여 배포할 경우, 게시판으로 연결될 수 도 있음
                                    // By.Son 2021.01.29
                                    $board_show = "N";
                                    if ( isset($data) ) {
                                        $exp_encode_data = explode("&", base64_decode( str_replace("||", "", $data) ) );
                                        foreach ( $exp_encode_data as $exp_en_data_num => $exp_en_data_str ) {
                                            if ( strpos( strtolower($exp_en_data_str), "boardkey" ) !== false || strpos( strtolower($exp_en_data_str), "dbtable" ) !== false ) {
                                                $board_show = "Y";
                                            }
                                        }
                                    }
                                    $get_prm_bbs = "";
                                    if ( !empty($_GET['bbs']) ) $get_prm_bbs = trim($_GET['bbs']);
                                    ?>
                                    var flag_bbs_show = "<?=$board_show?>";
                                    var get_prm_bbs = "<?=$get_prm_bbs?>";
                                    if ( get_prm_bbs != "" || flag_bbs_show == "Y" ) {
                                        $("#tabmenu2").trigger("click");
                                    }
                                });
                            </script>
						<? } ?>
                        <? } else if ($TREE_ID=="main" && $DEPTH!="4") {
							echo stripslashes(htmlspecialchars_decode($rs_infoContents[CONTENTS]));
                            // 담당자 정보
                            $STAFF_NAME = $rs_infoContents[STAFF];
                            $STAFF_TEL = $rs_infoContents[STAFF_TEL];
                            $STAFF_UPDATE = $rs_infoContents[STAFF_REGDATE];

						} else { ?>
						<div class="tabmenu-wrapper ratio">
							<ul class="depth<?=count($menu_4depth[$TREE_NO])?>">
								<?
								If ( $CHILD == "" ) $CHILD = $menu_4depth[$TREE_NO][0][TREE_NO];		// 첫 페이지 내용 확인
								// 컨텐츠 내용 불러오기
								$sql_tabContents = " SELECT * FROM ".TABLE_CMS_CONTENTS." WHERE TREE_ID = '".TREE_ID."' AND TREE_NO = '".$CHILD."' ";

								$rs_tabContents = $adb->getRow($sql_tabContents, DB_FETCHMODE_ASSOC);
								// 담당자 정보
								$STAFF_NAME = $rs_tabContents[STAFF];
								$STAFF_TEL = $rs_tabContents[STAFF_TEL];
								$STAFF_UPDATE = $rs_tabContents[STAFF_REGDATE];
								// 탭메뉴 정렬
								foreach ( $menu_4depth[$TREE_NO] as $k => $v ) {
									if ( $v[TREE_NO] == $CHILD ) $tabmenuIndex = $v[ORDER_NO];
									?>
									<li id="tabmenu<?=$k+1?>" <? if ( ($k+1) == count($menu_4depth[$TREE_NO]) ) echo "class='none'"; ?> >
										<a href="<?=$v[LINK_URL]?>" <?=$v[LINK_TARGET]?>><?=$v[NAME]?></a>
									</li>
								<? } ?>
							</ul>
						</div>

                        <?=stripslashes(htmlspecialchars_decode($rs_tabContents[CONTENTS]))?>


						<script>
							tabmenuOn(<?=$tabmenuIndex?>);

							function tabmenuOn(tabmenu1) {
								var topmenu = $("#tabmenu" + tabmenu1)
								topmenu.addClass("active");
							}
						</script>
                        <? } ?>

                    </div>
                    <!-- //contents-wrapper -->

                    <!-- page information -->
					<? if($TREE_ID=="main") { ?>
                    <div class="manager-information-wrapper">
						<dl>
							<dt>
								담당부서 :
							</dt>
							<dd>
								<?=${"find_".$DEPTH."depth"}[$TREE_NO][ETC2]?>
							</dd>
						</dl>

						<!--<dl>
							<dt>
								담당자 :
							</dt>
							<dd>
								<?=${"find_".$DEPTH."depth"}[$TREE_NO][ETC3]?>
							</dd>
						</dl>

						<dl>
							<dt>
								이메일 :
							</dt>
							<dd>
								<?=${"find_".$DEPTH."depth"}[$TREE_NO][ETC4]?>
							</dd>
						</dl>-->

						<dl>
							<dt>
								전화번호 :
							</dt>
							<dd>
								<?=${"find_".$DEPTH."depth"}[$TREE_NO][ETC5]?>
							</dd>
						</dl>

					</div>
					<? } ?>
                    <!-- //page information -->
                </div>
            </article>
            <!-- //contents -->
            </div>
        </div>
    </section>
    <!-- //container -->

<!-- 대학안내 > 캡퍼스안내 > 통학버스안내 -->
    <script type="text/javascript">
        menuOn(<?=$PAGEINDEX1?>, <?=$PAGEINDEX2?>, <?=($PAGEINDEX3=="")?'0':$PAGEINDEX3?>, <?=$PAGEINDEX4?>);

		$(function() {
			$(".btn-view01").on("click", function() {
				var thisIdx = $(this).attr('id');
				
				$(".modal-bus-information-box").hide();
				$(".modal-bus-information-box." + thisIdx).show();
			
				$(".mask").fadeIn(150, function() {
					$(".modal-bus-information-wrapper").show();
				});
			});		

			$(".mask, .btn-modal-close").on("click", function() {
				$(".modal-bus-information-wrapper").hide();
				$(".mask").fadeOut(150);

			});
		});
    </script>
<!-- //대학안내 > 캡퍼스안내 > 통학버스안내 -->	

<!-- 대학안내 > 캠퍼스안내 > 캡퍼스맵 -->
	<script>
		$(function() {
			$(".campusmap-list > li > button").on("click", function() {
				var thisIdx = $(this).attr('id');
				
				$(".campusmap-list > li > button").removeClass('active');
				$(this).addClass('active');
				
				$(".makers, .building, .building-image > img").hide();
				$("." + thisIdx).show();
			});
			

			if($(window).width() > 1240) {
				var buildingListHeight = $(".campusmap-box01 > img").naturalHeight - $(".building-image > img").outerHeight();
				$(".campusmap-box02").css("max-height", buildingListHeight);
			} else {
				$(".campusmap-box02").css("max-height", 'initial');
			}
		});

		$( window ).resize(function() {
			if($(window).width() > 1240) {
				var buildingListHeight = $(".campusmap-box01 > img").naturalHeight - $(".building-image > img").outerHeight();
				$(".campusmap-box02").css("max-height", buildingListHeight);
			} else {
				$(".campusmap-box02").css("max-height", 'initial');
			}
		});
	</script>  
<!-- //대학안내 > 캠퍼스안내 > 캡퍼스맵 -->	
	
<!-- (요가과) - 취업·진로 > 졸업생 한마디 -->	
	<script>
		var mainStudentSlider01 = new Swiper('#student-slide-area', {
			loop: true,
			autoHeight: true, // 슬라이드 반복
			autoplay: {
				delay: 10000,
				disableOnInteraction: false,
			},
			pagination: {
				el: '#main-student-pagination01'
			},
			navigation: {
				nextEl: '.student-btn-next',
				prevEl: '.student-btn-prev',
			},
		});
	</script> 
<!-- //(요가과) - 취업·진로 > 졸업생 한마디 -->	
	
<!--  (웰니스문화관광과) - 학과안내 > 교육시설·기자재 -->	
	<script>

		/* facilities swiper01 */
		 var facilitiesSwiper01 = new Swiper('#facilities-slider01', {
			loop : true, // 슬라이드 반복
			autoplay: {
				delay: 10000,
				disableOnInteraction: false,
			},
			navigation: {
				nextEl: '#facilities-btn01 .facilities-next',
				prevEl: '#facilities-btn01 .facilities-prev',
			},
		});

		$("#facilities-btn01 .swiper-button-pause").on('click', function(e){
			facilitiesSwiper01.autoplay.stop();

			$("#facilities-btn01 .swiper-button-pause").hide();
			$("#facilities-btn01 .swiper-button-play").show();
		});

		$("#facilities-btn01 .swiper-button-play").on('click', function(e){
			facilitiesSwiper01.autoplay.start();
			$("#facilities-btn01 .swiper-button-pause").show();
			$("#facilities-btn01 .swiper-button-play").hide();
		});

		/* facilities swiper02 */
		 var facilitiesSwiper02 = new Swiper('#facilities-slider02', {
			loop : true, // 슬라이드 반복
			autoplay: {
				delay: 10000,
				disableOnInteraction: false,
			},
			navigation: {
				nextEl: '#facilities-btn02 .facilities-next',
				prevEl: '#facilities-btn02 .facilities-prev',
			},
		});

		$("#facilities-btn02 .swiper-button-pause").on('click', function(e){
			facilitiesSwiper02.autoplay.stop();

			$("#facilities-btn02 .swiper-button-pause").hide();
			$("#facilities-btn02 .swiper-button-play").show();
		});

		$("#facilities-btn02 .swiper-button-play").on('click', function(e){
			facilitiesSwiper02.autoplay.start();
			$("#facilities-btn02 .swiper-button-pause").show();
			$("#facilities-btn02 .swiper-button-play").hide();
		});

		/* facilities swiper03 */
		 var facilitiesSwiper03 = new Swiper('#facilities-slider03', {
			loop : true, // 슬라이드 반복
			autoplay: {
				delay: 10000,
				disableOnInteraction: false,
			},
			navigation: {
				nextEl: '#facilities-btn03 .facilities-next',
				prevEl: '#facilities-btn03 .facilities-prev',
			},
		});

		$("#facilities-btn03 .swiper-button-pause").on('click', function(e){
			facilitiesSwiper03.autoplay.stop();

			$("#facilities-btn03 .swiper-button-pause").hide();
			$("#facilities-btn03 .swiper-button-play").show();
		});

		$("#facilities-btn03 .swiper-button-play").on('click', function(e){
			facilitiesSwiper03.autoplay.start();
			$("#facilities-btn03 .swiper-button-pause").show();
			$("#facilities-btn03 .swiper-button-play").hide();
		});

		/* facilities swiper04 */
		 var facilitiesSwiper04 = new Swiper('#facilities-slider04', {
			loop : true, // 슬라이드 반복
			autoplay: {
				delay: 10000,
				disableOnInteraction: false,
			},
			navigation: {
				nextEl: '#facilities-btn04 .facilities-next',
				prevEl: '#facilities-btn04 .facilities-prev',
			},
		});

		$("#facilities-btn04 .swiper-button-pause").on('click', function(e){
			facilitiesSwiper04.autoplay.stop();

			$("#facilities-btn04 .swiper-button-pause").hide();
			$("#facilities-btn04 .swiper-button-play").show();
		});

		$("#facilities-btn04 .swiper-button-play").on('click', function(e){
			facilitiesSwiper04.autoplay.start();
			$("#facilities-btn04 .swiper-button-pause").show();
			$("#facilities-btn04 .swiper-button-play").hide();
		});
		
		/* facilities swiper05 */
		 var facilitiesSwiper04 = new Swiper('#facilities-slider05', {
			loop : true, // 슬라이드 반복
			autoplay: {
				delay: 10000,
				disableOnInteraction: false,
			},
			navigation: {
				nextEl: '#facilities-btn05 .facilities-next',
				prevEl: '#facilities-btn05 .facilities-prev',
			},
		});

		$("#facilities-btn05 .swiper-button-pause").on('click', function(e){
			facilitiesSwiper04.autoplay.stop();

			$("#facilities-btn05 .swiper-button-pause").hide();
			$("#facilities-btn05 .swiper-button-play").show();
		});

		$("#facilities-btn04 .swiper-button-play").on('click', function(e){
			facilitiesSwiper04.autoplay.start();
			$("#facilities-btn05 .swiper-button-pause").show();
			$("#facilities-btn05 .swiper-button-play").hide();
		});

	
	</script>
<!--  //(웰니스문화관광과) - 학과안내 > 교육시설·기자재 -->	
	
	
<!-- (메인) - 대학안내 > 대학기구 > 부설기관 > 글로벌센터 -->
	<script>
		$(function() {
			$("#tab-box2").hide();
			$(".tabmenu-wrapper02 > ul > li > a").on("click", function() {
				var tempIdx = $(this).attr('id');
				var thisIdx = tempIdx.replace(/[^0-9]/g,'');


				$(".tabmenu-wrapper02 > ul > li > a").removeClass('active');
				$(this).addClass('active');

				$(".tab-contents").hide();
				$("#tab-box" + thisIdx).show();
			});


		});
	</script>  
<!-- //(메인) - 대학안내 > 대학기구 > 부설기관 > 글로벌센터 -->
	
<!-- (메인) - 대학생활 > 학생자치활동 > 동아리 활동 > 학술전공, 사회봉사, 취미예술, 종교 -->
<script>
	$(function() {
		$(".group-menu-wrapper > ul > li > a").on("click", function() {
			$('html,body').animate({scrollTop:$(this.hash).offset().top - $(".header").outerHeight() + 1}, 500);
		});
	});
</script>	  
<!-- //(메인) - 대학생활 > 학생자치활동 > 동아리 활동 > 학술전공, 사회봉사, 취미예술, 종교 -->
<!-- 대학생활 > 대학생활 > 시설안내 > 생활관(기숙사) -->
	<script>

		/* 기숙사 slider 01 */
		var swiper01 = new Swiper('#facilities-slider01', {
			loop : true, // 슬라이드 반복
			autoplay: {
				delay: 10000,
				disableOnInteraction: false,
			},
			navigation: {
				nextEl: '.facilities-button-next',
				prevEl: '.facilities-button-prev',
			},
		});

		$(".facilities-button-pause").on('click', function(e){
			swiper01.autoplay.stop();

			$(".facilities-button-pause").hide();
			$(".facilities-button-play").show();
		});

		$(".facilities-button-play").on('click', function(e){
			swiper01.autoplay.start();
			$(".facilities-button-pause").show();


			$(".facilities-button-play").hide();
		});
	</script>
<!-- //대학생활 > 대학생활 > 시설안내 > 생활관(기숙사) -->	
	
	
	
    <!-- footer -->
	<?
		if($TREE_ID=="main") {
			include("../_common/main_footer.php");
		} else {
			include("../_common/footer.php");
		}
	?>
    <!-- //footer -->
</div>
<!-- //wrapper -->



</body>
</html>
