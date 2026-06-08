<!doctype html>
<html lang="ko">
<head>
<?php
if($TREE_ID=="") $TREE_ID = $_GET['site_id'];
include("../include/meta.php");
require_once (ADFRAME_ROOT_PATH."/lib/class_bbs.php");
if ( $TREE_NO == "" || !$TREE_NO ) go_back("페이지를 찾을 수 없습니다.");

?>
    <title id="title"><?=$PAGENAME4.$PAGENAME3.$PAGENAME2.$PAGENAME1._TAG_TITLE?></title>
</head>
<body>
	<!-- skip navigation -->
	<p class="skip-navigation">
		<a href="#contents">본문 바로가기</a>
	</p>
	<!-- //skip navigation -->

<!-- wrapper -->
<div class="wrapper" id="wrapper">
    <!-- header -->
    <?php
		include("../include/header.php");
	?>
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
    <? include("../include/sub_visual.php"); ?>
    <!-- sub visual -->

    <section>
    <!-- container -->
    <div class="container" id="container">

        <!-- contents_navi -->
        <? include("../include/contents_navi.php");?>
        <!-- //contents_navi -->

        <div class="container-wrapper">
            <!-- lnb -->
			<div class="lnb-wrapper">
				<div class="lnb-area">
            <? 
			include("../include/lnb0".$PAGEINDEX1.".php");
			?>
				</div>
			</div>
            <!-- //lnb -->

            <!-- contents -->
            <article>
                <div class="contents" id="contents">
                    <script src="https://www.google.com/recaptcha/api.js?render=6Lf87cMZAAAAACBy-xLjI3DfbrzPxEmTxV-_auiN"></script>

                    <script type="text/javascript">
                        $( document ).ready(function() {
                            if ( $("form[name='writeform']").length > 0 ) {
                                $("form[name='writeform']").append("<input type='hidden' name='g-recaptcha' id='g-recaptcha'/>");
                                grecaptcha.ready(function() {
                                    grecaptcha.execute('6Lf87cMZAAAAACBy-xLjI3DfbrzPxEmTxV-_auiN', {action: 'homepage'}).then(function(token) {
                                        // 토큰을 받아다가 g-recaptcha 에다가 값을 넣어줍니다.
                                        document.getElementById('g-recaptcha').value = token;
                                    });
                                });
                            }
                        });
                    </script>
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
					<?
						if ($TREE_ID=="main" && $DEPTH=="4") {
					?>
					<div class="tabmenu-wrapper ratio no-mobile-title">
						<?
							$sql_tabContents2 = " SELECT * FROM af_tree WHERE TREE_ID = '".TREE_ID."' AND PARENT = '".$PARENT."' ORDER BY ORDER_NO ASC";
							$rs = DBquery($sql_tabContents2);
							$tabdepth = mysql_num_rows($rs);
							if ($tabdepth >= 6) $tabdepth = "6";
						?>
						<ul class="depth<?=$tabdepth;?>">
						<?
							while($bbs_row2=mysql_fetch_array($rs)){
							if ($bbs_row2[ETC1] != "BOARD") {
							$LINK_URL = "/contents/contents_view.php?site_id=main&TREE_NO=".$bbs_row2['TREE_NO']."&DEPTH=".$DEPTH."";
							} else if ($bbs_row2[ETC1] == "BOARD") {
							$LINK_URL = "/board/board.php?site_id=main&TREE_NO=".$bbs_row2['TREE_NO']."&DEPTH=".$DEPTH."";
							}
							
						?>
							<li class="topmenu<?=$PAGEINDEX1?>-<?=$PAGEINDEX2?>-<?=$PAGEINDEX3?>-<?=$bbs_row2[ORDER_NO]?>">
								<a href="<?=$LINK_URL?>" <?=$v[LINK_TARGET]?>><?=$bbs_row2['NAME']?></a>
							</li>
						<? } ?>
						</ul>
						
					</div>
					<? } else if($TREE_ID=="main" && $PARENT=="16079" && $DEPTH!="4") { ?>
					<div class="tabmenu-wrapper ratio no-mobile-title">
						<ul class="depth2">
							<li class="topmenu5-2-1">
								<a href="/board/board.php?site_id=main&TREE_NO=16224&DEPTH=3">
									언론보도
								</a>
							</li>
							<li class="topmenu5-2-2">
								<a href="/board/board.php?site_id=main&TREE_NO=16225&DEPTH=3">
									2020년 이전 언론보도
								</a>
							</li>
						</ul>
					</div>
					<? } ?>
                    <div class="contents-area">

                        <?php
                        $dataArr=Decode64($_GET['data']);

                        $exp_bbsCODE = explode("|",${"find_".$DEPTH."depth"}[$TREE_NO][CONTENTS]);
                        foreach ( $exp_bbsCODE as $k => $v ) {
                            if ( $v != "" ) $arr_bbsCode[] = $v;
                        }
                        if ( count($arr_bbsCode) > 1 ) $bbsCODE = $arr_bbsCode;
                        else $bbsCODE = ${"find_".$DEPTH."depth"}[$TREE_NO][CONTENTS];

                        if($bbsCODE=="") $bbsCODE = $dataArr['Boardkey'];

                        if($_SERVER['REMOTE_ADDR']=="112.217.216.250"){
							//print_r($dataArr); exit;
                        }

                        create_bbs($bbsCODE, "", "0", "", "", "");
                        
                        ?>

                    </div>
                    <!-- //contents area -->

                    <!-- page information -->
                    <!-- //page information -->
                </div>
            </article>
            <!-- //contents -->
    </div>
    <!-- //container -->
    </div>
	</section>
    <script type="text/javascript">
        menuOn(<?=$PAGEINDEX1?>, <?=$PAGEINDEX2?>, <?=($PAGEINDEX3=="")?'0':$PAGEINDEX3?>, '<?=$PAGEINDEX4?>');

    </script>

        <!-- footer -->
        <?php 
			include("../_common/footer.php");
		?>
        <!-- //footer -->
</div>
<!-- //wrapper -->



</body>
</html>