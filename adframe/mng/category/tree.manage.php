<?php include "../_common.php"; ?>

<!DOCTYPE HTML>
<html lang="ko" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">

<head>
    <? include_once("../include/__meta.php"); ?>
    <title> 관리자페이지 </title>
</head>
<body>
<input type="hidden" id="PMENU" name="PMENU" value="<?=$menu?>">

<link rel="stylesheet" href="/adframe/mng/css/jquery.loader.css" />
<script src="/adframe/mng/js/jquery.loader.js"></script>

<!-- Tree VIew Style Sheet -->
<link rel="stylesheet" href="/adframe/mng/css/metroStyle/metroStyle.css" />
<!--
<link rel="stylesheet" href="../css/zTreeStyle/zTreeStyle.css" />
<link rel="stylesheet" href="../css/awesomeStyle/awesomeStyle.css" />
-->
<script src="/adframe/mng/js/jquery.ztree.all.min.js"></script>
<script src="/adframe/mng/js/lib.ztree.category.js"></script>
<script src="/adframe/mng/js/lib.function.son.custom.js"></script>

<script>
    function ifrm_infoView(id, treeno, mode) {
        if ( !treeno || treeno == "" ) {
            alert("선택된 카테고리가 없습니다.");
            return;
        }
        var param = "?menu=control&id="+id+"&control_class_mode="+mode+"&treeno="+treeno;
        var page = "";
        if ( mode == "common" ) page = "common.php";
        else if ( mode == "contents" ) page = "contents.php";
        if ( page.trim() == "" ) {
            alert("페이지를 불러오는 중, 오류가 발생했습니다.");
            return;
        }
        var url = "/adframe/mng/contents/"+page+param;
        $("#sub-ifrm-control").attr("src", url);
    }
    function depth_imageInput(id, treeno) {
        if ( !treeno || treeno == "" ) {
            alert("선택된 카테고리가 없습니다.");
            return;
        }
        var param = "?id="+id+"&treeno="+treeno;
        var url = "/adframe/mng/include/control.class.pop.php"+param;
        window.open(url, "imageInput", "width= 600px, height= 250px");
    }
</script>
<!-- contents -->
<div class="contents">
    <fieldset>
        <legend class="blind">카테고리</legend>
        <h2 class="title0201">
            카테고리 관리
        </h2>
        <div class="menu-option-wrapper">
            <div class="menu-option-left-area">
                <div class="menu-title-area">
                    <h3 class="title0301">
                        카테고리분류 설정
                    </h3>
                </div>
                <!-- Tree View -->
                <div class="menu-option-leftbox">
                    <div class="btns-menu-box">
                        <div class="btns-left">
                            <a href="javascript:;" class="btn-type04 addParent">
                                카테고리 대분류 추가
                            </a>
                        </div>
                        <div class="btns-right">
                            <a href="javascript:;" class="btn-type03 saveMenuList">
                                순서저장
                            </a>
                        </div>
                    </div>
                    <div class="menu-option-list-area" style="height: 396px; padding: 0; overflow: hidden; overflow-y: scroll;">
                        <ul id="trees" class="ztree"> </ul>
                    </div>
                    <div class="btns-menu-box">
                        <div class="btns-left">
                            <a href="javascript:;" class="btn-type04 addParent">
                                카테고리 대분류 추가
                            </a>
                        </div>
                        <div class="btns-right">
                            <a href="javascript:;" class="btn-type03 saveMenuList">
                                순서저장
                            </a>
                        </div>
                    </div>
                    <!-- Tree View -->

                </div>
            </div>

            <div class="menu-option-right-area">
                <div class="menu-title-area">
                    <h3 class="title0301">
                        카테고리정보
                    </h3>
                    <p class="word-right">
                        <strong class="point-important">*</strong>는 필수 입력입니다.
                    </p>
                </div>

                <form name="frm_menuInfo" id="frm_menuInfo" method="POST">
                    <div class="t1 mb30">
                        <input type ="hidden" name="mode" value="" />
                        <input type ="hidden" name="TREE_NO" value="" />
                        <input type ="hidden" name="PARENT" value="" />
                        <input type ="hidden" name="DEPTH" value="" />
                        <input type ="hidden" name="ORDER_NO" value="" />
                        <table style="width: 100%">
                            <colgroup>
                                <col style="width: 30%" />
                                <col style="width: 70%" />
                            </colgroup>
                            <tbody>
                            <tr>
                                <th scope="row">
                                    상위 카테고리
                                </th>
                                <td class="upperCategoryName"></td>
                            </tr>
                            <tr>
                                <th scope="row">
                                    카테고리명 <strong class="point-important">*</strong>
                                </th>
                                <td>
                                    <input type="text" name="NAME" placeholder="카테고리 이름을 적어주세요." />
                                </td>
                            </tr>
                            </tbody>
                        </table>

                    </div>

                    <div class="btns-center">
                        <a href="javascript:InsertMenu(document.frm_menuInfo);" class="btn-type01">
                            확인
                        </a>
                        <a href="javascript:resetInfo(document.frm_menuInfo);" class="btn-type01">
                            초기화
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </fieldset>

</div>
<!-- //contents -->
</body>
</html>
