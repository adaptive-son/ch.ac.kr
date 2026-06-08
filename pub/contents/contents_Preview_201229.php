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
        $rs_infoContents = $adb->getRow($sql_infoContents, DB_FETCHMODE_ASSOC);
    }
    ?>
    <title><?=$PAGENAME4.$PAGENAME3.$PAGENAME2.$PAGENAME1._TAG_TITLE?></title>
</head>
<body>

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
			<? include("../".$TREE_ID."/include/contents_navi.php");?>
            <div class="container-wrapper">
			<!-- lnb -->
			<? include("../".$TREE_ID."/include/lnb.php");?>
			<!-- //lnb -->
            <!-- contents -->
            <article>
                <div class="contents" id="contents">
                    <h3 class="contents-title">
                        <?=${"find_".$DEPTH."depth"}[$TREE_NO][NAME]?>
                        <span class="arrow"></span>
                    </h3>

                    <!-- contents-wrapper -->
                    <div class="contents-wrapper">
						
                        <?
                        if ( ${"find_".$DEPTH."depth"}[$TREE_NO][ETC1] != "TABUPPER" ) {
                            echo stripslashes(htmlspecialchars_decode($rs_infoContents[CONTENTS]));
                            // 담당자 정보
                            $STAFF_NAME = $rs_infoContents[STAFF];
                            $STAFF_TEL = $rs_infoContents[STAFF_TEL];
                            $STAFF_UPDATE = $rs_infoContents[STAFF_REGDATE];
                        }
                        else {
                            ?>
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

						<dl>
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
						</dl>

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
        menuOn(<?=$PAGEINDEX1?>, <?=$PAGEINDEX2?>, <?=($PAGEINDEX3=="")?'0':$PAGEINDEX3?>);
    </script>

    <!-- footer -->
    <? include("../_common/footer.php");?>
    <!-- //footer -->
</div>
<!-- //wrapper -->



</body>
</html>