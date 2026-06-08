<!doctype html>
<html lang="ko">
<?
// 개별 페이지 실행 방지. 해당 문자열은 inc.constant.php에 정의된다.
define("__AF__", TRUE);
// adframe 템플릿 페이지 설정.
include($_SERVER["DOCUMENT_ROOT"] . "/adframe/af_common.php");
require_once (ADFRAME_ROOT_PATH."/lib/class_bbs.php");
?>
<head>
    <?
    if($TREE_ID=="") $TREE_ID = $_GET['site_id'];
    define(TREE_ID,$TREE_ID);
    include("../".$TREE_ID."/include/meta.php");

    if ( $TREE_NO == "" || !$TREE_NO ) go_back("페이지를 찾을 수 없습니다.");
    else {
        $sql_infoContents = " SELECT * FROM ".TABLE_CMS_CONTENTS." WHERE TREE_ID = '".TREE_ID."' AND TREE_NO = '".$TREE_NO."' ";
        $rs_infoContents = $adb->getRow($sql_infoContents, DB_FETCHMODE_ASSOC);
    }
    ?>
    <title><?=$PAGENAME4.$PAGENAME3.$PAGENAME2.$PAGENAME1._TAG_TITLE?></title>
</head>
<body>
<!-- skip navigation -->
<p class="skip-navigation">
    <a href="#contents">Skip to Contents</a>
</p>
<!-- //skip navigation -->


<!-- popup -->
<?
if($TREE_ID=="main") include "../_common/top_popup.php"
?>
<!-- //popup -->

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

<!-- wrapper -->
<div class="wrapper" id="wrapper">
    <!-- header -->
    <? include("../".$TREE_ID."/include/header.php");?>
    <!-- //header -->

    <!-- sub visual -->
    <? include("../".$TREE_ID."/include/sub_visual.php"); ?>
    <!-- sub visual -->

    <!-- container -->
    <section>
        <div class="container" id="container">
            <? include("../".$TREE_ID."/include/contents_navigation.php");?>
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
                                    $sql_tabContents2 = " SELECT * FROM af_tree WHERE TREE_ID = '".TREE_ID."' AND PARENT = '".$PARENT."' ORDER BY ORDER_NO ASC";
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
                                            if ($bbs_row2[ETC1] != "BOARD") {
                                                $LINK_URL = "/contents/contents_view_en.php?site_id=main&TREE_NO=".$bbs_row2['TREE_NO']."&DEPTH=".$DEPTH."";
                                            }  else if ($bbs_row2[ETC1] == "LINK") {
                                                $LINK_URL = $bbs_row2['CONTENTS'];
                                            }

                                            ?>
                                            <li class="topmenu<?=$PAGEINDEX1?>-<?=$PAGEINDEX2?>-<?=$PAGEINDEX3?>-<?=$bbs_row2[ORDER_NO]?>">
                                                <a href="<?=$LINK_URL?>" <?=$v[LINK_TARGET]?>><?=$bbs_row2['NAME']?></a>
                                            </li>
                                        <? } ?>
                                    </ul>

                                </div>

                            <?=stripslashes(htmlspecialchars_decode($rs_infoContents[CONTENTS]))?>

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

    <script type="text/javascript">
        menuOn(<?=$PAGEINDEX1?>, <?=$PAGEINDEX2?>, <?=($PAGEINDEX3=="")?'0':$PAGEINDEX3?>, <?=$PAGEINDEX4?>);
    </script>
	
	<!-- WORLDWIDE CHOONHAE > Partner Institutions, WORLDWIDE CHOONHAE > International Programs-->
	<script>
	var swiper01 = new Swiper('#facilities-slider01', {
		loop : true, // 슬라이드 반복
		slidesPerView: 1,
		autoplay: {
			delay: 3000,
			disableOnInteraction: false,
		},
		navigation: {
			nextEl: '#facilities-slider01 .facilities-button-next',
			prevEl: '#facilities-slider01 .facilities-button-prev',
		},
	});

	$("#facilities-slider01 .facilities-button-pause").on('click', function(e){
		swiper01.autoplay.stop();

		$("#facilities-slider01 .facilities-button-pause").hide();
		$("#facilities-slider01 .facilities-button-play").show();
	});

	$("#facilities-slider01 .facilities-button-play").on('click', function(e){
		swiper01.autoplay.start();
		$("#facilities-slider01 .facilities-button-pause").show();
		$("#facilities-slider01 .facilities-button-play").hide();
	});
	</script> 
	<!-- //WORLDWIDE CHOONHAE > Partner Institutions, //WORLDWIDE CHOONHAE > International Programs -->
	
	
	
	

    <!-- footer -->
    <?
        include("../english/include/footer.php");
    ?>
    <!-- //footer -->
</div>
<!-- //wrapper -->



</body>
</html>