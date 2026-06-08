<?
include_once("../_common.php");
require_once(ADFRAME_ROOT_PATH."/lib/class_bbs.php");

// 넘어온 관리게시판이 있을때
if($_GET['managerBoard']){
    unset($_SESSION["managerBoardKey"]);
    $_SESSION["managerBoardKey"] = $_GET['managerBoard'];
}


?>
<!doctype html>
<html lang="ko">
<head>
    <? include_once("../include/__meta.php"); ?>
</head>
<body style="background-color: #fff;">
<!-- wrapper -->
<div class="wrapper" id="wrapper" style="padding: 0; min-height: 550px;">
    <!-- container -->
    <div class="container" id="container" style="background: none;">
        <!-- contents -->
        <div class="contents" id="contents">
            <!-- contents area -->
            <div class="contents-area">
                <?
                //매니저 그룹 컬럼값 가져오기
                $BBSCheck_row = DBarray("SELECT board_skin, manager_group FROM ".TABLE_BOARD_MNG." WHERE board_key='".$_SESSION["managerBoardKey"]."'");

                // 썸네일 이미지가 필요한 경우, 서브쿼리에 파일 내용 가져오기
                if($BBSCheck_row[board_skin] == "event" || $BBSCheck_row[board_skin] == "gallery"){
                    $cbbs_subcolumnqry = ", (select idx from [[BBSDBTABLE]]_file where file_type > 0 and file_type < 4 and up_file_idx = A.up_file_idx limit 0,1) as file_idx";
                } else {
                    $cbbs_subcolumnqry = "";
                }
                create_bbs($_SESSION["managerBoardKey"], "", "1", "", "", $cbbs_subcolumnqry, "admin");
                //게시판 시퀀스, 카테고리번호, 관리자는 1(일반은0), 유저아이디, 서브검색쿼리, 서브컬럼쿼리, 사이트타입
                ?>
            </div>
            <!-- //contents area -->
        </div>
        <!-- //contents -->
    </div>
    <!-- //container -->

</div>
<!-- //wrapper -->
<? include_once("../include/__footer.php"); ?>

<script>
    $(document).ready(function() {
        //rsize();
    });
    function rsize() {
        var iframe = document.getElementById('inneriframe');
        var wrapper = document.getElementById('wrapper');
        var height = Math.max( document.body.offsetHeight, document.body.scrollHeight );
        iframe.src = 'http://info.iuk.ac.kr/Libs/auto_size.htm?height='+height;
    }
</script>
<iframe name="inneriframe" id="inneriframe" width="100%" height="0" style="border: 0px;"></iframe>

</body>
</html>
