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
    <title><?=$PAGENAME3.$PAGENAME2.$PAGENAME1._TAG_TITLE?></title>
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

            <!-- contents_navi -->
            <? include("../".$TREE_ID."/include/contents_navi.php");?>
            <!-- //contents_navi -->

            <div class="container-wrapper">
                <!-- lnb -->
                <? include("../".$TREE_ID."/include/lnb.php");?>
                <!-- //lnb -->

                <!-- contents -->
                <article>
                    <div class="contents" id="contents">
                        <?php
                        $file_path = PROFESSOR_LOAD_PATH;
                        $sql_proInfo = " SELECT * FROM ".TABLE_PROFESSOR." WHERE idx = '".$idx."' ";
                        $row = $adb->getRow($sql_proInfo, DB_FETCHMODE_ASSOC);
                        ?>
                        <h3 class="contents-title">
                            교수소개
                            <span class="arrow"></span>
                        </h3>

                        <div class="contents-wrapper">
                            <!-- CMS 시작 -->


                            <div class="professor-wrapper">
                                <div class="professor-area">
                                    <div class="image center-crop">
                                        <img src="<?=$file_path."/".$row[file_name]?>" alt="<?=$row[name]?>" />
                                    </div>

                                    <h4>
                                        <?=$row[name]?>
                                    </h4>

                                    <ul>
                                        <li>
                                            <strong>
                                                직위
                                            </strong>
                                            <?=$row[position]?>
                                        </li>
                                        <li>
                                            <strong>
                                                담당과목
                                            </strong>
                                            <?=$row[responsibility]?>
                                        </li>
                                        <li>
                                            <strong>
                                                연구실
                                            </strong>
                                            <?=$row[office]?>
                                        </li>
                                        <li>
                                            <strong>
                                                연락처
                                            </strong>
                                            <?=$row[tel]?>(<?=$row[email]?>)
                                        </li>
                                        <?if($row[career2]!=""){?>
                                            <li>
                                                <strong>
                                                    가족회사 및<br />
                                                    산업체관련 경력
                                                </strong>
                                                <?=$row[career2]?>
                                            </li>
                                        <? }?>
                                    </ul>

                                    <a href="javascript:history.back(-1);" class="btn-detail-view">
                                        목록
                                    </a>
                                </div>

                            </div>

                            <div class="contents-area">
                                <h4 class="title-type01">
                                    학력
                                </h4>

                                <div class="contents-box">
                                    <ul class="ul-list01">
                                        <?=nl2li($row[achievement])?>
                                    </ul>
                                </div>
                            </div>

                            <div class="contents-area">
                                <h4 class="title-type01">
                                    경력
                                </h4>

                                <div class="contents-box">
                                    <ul class="ul-list01">
                                        <?=nl2li($row[career])?>
                                    </ul>
                                </div>
                            </div>

                            <? if($row[researchresult_s]!="1"){?>
                            <div class="contents-area">
                                <h4 class="title-type01">
                                    연구실적
                                </h4>
                                <div class="contents-box">
                                    <ul class="ul-list01">
                                       <?=nl2li($row[researchresult])?>
                                    </ul>
                                </div>
                            </div>
                            <? }?>



                            <!-- //CMS 끝 -->
                        </div>
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