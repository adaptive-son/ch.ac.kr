<!doctype html>
<html lang="ko">
<head>
<?
if($TREE_ID=="") $TREE_ID = $_GET['site_id'];
include("../".$TREE_ID."/include/meta.php");

require_once (ADFRAME_ROOT_PATH."/lib/class_bbs.php");
if ( $TREE_NO == "" || !$TREE_NO ) go_back("페이지를 찾을 수 없습니다.");


//로그인 확인용 세션 출력
if($_SERVER["REMOTE_ADDR"] == "112.217.216.250"){
    //print_r2($_SESSION);
    //echo "SecAdmin===".$SecAdmin;
}
?>

<!--    <script src="/_common/js/board.js"></script>
    <link rel="stylesheet" href="/_common/css/board.css" /> -->
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

    <section>
    <!-- container -->
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
                    <script src="https://www.google.com/recaptcha/api.js?render=6Lf87cMZAAAAACBy-xLjI3DfbrzPxEmTxV-_auiN"></script>

                    <script type="text/javascript">
                        $( document ).ready(function() {
                            $("form[name='writeform']").append("<input type='hidden' name='g-recaptcha' id='g-recaptcha'/>");
                        });
                        grecaptcha.ready(function() {
                            grecaptcha.execute('6Lf87cMZAAAAACBy-xLjI3DfbrzPxEmTxV-_auiN', {action: 'homepage'}).then(function(token) {
                                // 토큰을 받아다가 g-recaptcha 에다가 값을 넣어줍니다.
                                document.getElementById('g-recaptcha').value = token;
                            });
                        });
                    </script>
                    <h3 class="contents-title"><?=${"find_".$DEPTH."depth"}[$TREE_NO][NAME]?><span class="arrow"></span></h3>

                    <div class="contents-area">

                        <?
                        $dataArr=Decode64($_GET['data']);
                        $exp_bbsCODE = explode("|",${"find_".$DEPTH."depth"}[$TREE_NO][CONTENTS]);
                        foreach ( $exp_bbsCODE as $k => $v ) {
                            if ( $v != "" ) $arr_bbsCode[] = $v;
                        }
                        if ( count($arr_bbsCode) > 1 ) $bbsCODE = $arr_bbsCode;
                        else $bbsCODE = ${"find_".$DEPTH."depth"}[$TREE_NO][CONTENTS];

                        if($bbsCODE=="") $bbsCODE = $dataArr['Boardkey'];

                        create_bbs($bbsCODE, "", "0", "", "", "");
                        ?>

                    </div>
                    <!-- //contents area -->

                    <!-- page information -->
                    <? //include("../include/page_information.php");	// 게시판에서는 페이지관리자에 대한 정보가 필요없음 ?>
                    <!-- //page information -->
                </div>
            </article>
            <!-- //contents -->
    </div>
    <!-- //container -->
    </div>

    <script type="text/javascript">
        menuOn(<?=$PAGEINDEX1?>, <?=$PAGEINDEX2?>, <?=($PAGEINDEX3=="")?'0':$PAGEINDEX3?>);

    </script>

        <!-- footer -->
        <? 
			if($TREE_ID=="main") {include("../_common/main_footer.php");}
			else {include("../_common/footer.php");}
			?>
        <!-- //footer -->
</div>
<!-- //wrapper -->
</section>


</body>
</html>