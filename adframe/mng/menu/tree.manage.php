<?php include "../_common.php";?>

<!DOCTYPE HTML>
<html lang="ko">

<head>
    <? include_once("../include/__meta.php"); ?>
    <title> 관리자페이지 </title>
</head>
<body>
<input type="hidden" id="TREE_ID" name="TREE_ID" value="<?=$id?>">

<link rel="stylesheet" href="/adframe/mng/css/jquery.loader.css" />
<script src="/adframe/mng/js/jquery.loader.js"></script>

<!-- Tree VIew Style Sheet -->
<link rel="stylesheet" href="/adframe/mng/css/metroStyle/metroStyle.css" />
<!--
<link rel="stylesheet" href="../css/zTreeStyle/zTreeStyle.css" />
<link rel="stylesheet" href="../css/awesomeStyle/awesomeStyle.css" />
-->
<script src="/adframe/mng/js/jquery.ztree.all.min.js"></script>
<script src="/adframe/mng/js/lib.ztree.custom.js?ver=<?=date("His")?>"></script>
<script src="/adframe/mng/js/lib.function.son.custom.js"></script>

<script>
    function ifrm_infoView(id, treeno, mode) {
        if ( !treeno || treeno == "" ) {
            alert("선택된 메뉴가 없습니다.");
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
            alert("선택된 메뉴가 없습니다.");
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
        <legend class="blind">메뉴</legend>
        <h2 class="title0201">
            <?
            switch ($id) {
                case 'admin': echo "관리자 메뉴 관리"; break;
            }
            ?>
        </h2>
        <div class="menu-option-wrapper">
            <div class="menu-option-left-area">
                <div class="menu-title-area">
                    <h3 class="title0301">
                        메뉴분류 설정
                    </h3>
                </div>
                <!-- Tree View -->
                <div class="menu-option-leftbox">
                    <div class="btns-menu-box">
                        <div class="btns-left">
                            <a href="javascript:;" class="btn-type04 addParent">
                                대메뉴 추가
                            </a>
                        </div>
                        <div class="btns-right">
                            <a href="javascript:;" class="btn-type03 saveMenuList">
                                메뉴 순서 저장
                            </a>
                        </div>
                    </div>
                    <div class="menu-option-list-area" style="height: 396px; padding: 0; overflow: hidden; overflow-y: scroll;">
                        <ul id="trees" class="ztree"> </ul>
                    </div>
                    <div class="btns-menu-box">
                        <div class="btns-left">
                            <a href="javascript:;" class="btn-type04 addParent">
                                대메뉴 추가
                            </a>
                        </div>
                        <div class="btns-right">
                            <a href="javascript:;" class="btn-type03 saveMenuList">
                                메뉴 순서 저장
                            </a>
                        </div>
                    </div>
                    <!-- Tree View -->
					

                </div>
            </div>

            <div class="menu-option-right-area">
                <div class="menu-title-area">
                    <h3 class="title0301">
                        메뉴정보
                    </h3>
                    <p class="word-right">
                        <strong class="point-important">*</strong>는 필수 입력입니다.
                    </p>
                </div>

                <form name="frm_menuInfo" id="frm_menuInfo" method="POST">
                    <div class="t1 mb30">
                        <input type ="hidden" name="mode" value="<?=$mode?>" />
                        <input type ="hidden" name="TREE_NO" value="" />
                        <input type ="hidden" name="TREE_ID" value="<?=$id?>" />
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
                                    상위 메뉴
                                </th>
                                <td class="upperCategoryName"></td>
                            </tr>
                            <tr>
                                <th scope="row">
                                    메뉴명 <strong class="point-important">*</strong>
                                </th>
                                <td>
                                    <input type="text" name="NAME" placeholder="메뉴 이름을 적어주세요." />
                                </td>
                            </tr>
                            </tbody>
                        </table>

                        <table id="hidden-select-1depth" style="width: 100%">
                            <colgroup>
                                <col style="width: 30%" />
                                <col style="width: 70%" />
                            </colgroup>
                            <tbody>
                            <tr>
                                <th scope="row">
                                    새창연결
                                </th>
                                <td>
                                    <input type="checkbox" id="checkbox0101" name="LINK_TARGET" value="1"/>
                                    <label for="checkbox0101">
                                        해당 메뉴의 링크를 새창으로 연결합니다.
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">
                                    분류 <strong class="point-important">*</strong>
                                </th>
                                <td>
                                    <select id="ETC1" name="ETC1" style="width: 150px;">
                                        <option value=""> 선택 </option>
                                        <?
                                        $arr_function = array("LINK"=>"하이퍼링크", "CONTENTS"=>"컨텐츠", "BOARD"=>"게시판", "MENU"=>"메뉴카테고리", "TABUPPER"=>"탭상위메뉴", "TAB"=>"탭메뉴");
                                        foreach ( $arr_function as $k => $v ) {
                                            ?>
                                            <option value="<?=$k?>"> <?=$v?> </option>
                                        <? } ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">
                                    링크 URL / 게시판 ID
                                </th>
                                <td>
                                    <input type="text" id="CONTENTS" name="CONTENTS" value="" placeholder="링크 URL 혹은 게시판 ID를 입력하세요." />
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">
                                    표시상태
                                </th>
                                <td>
                                    <?
                                    $arr_newLink = array("Y"=>"표시", "N"=>"숨김");
                                    foreach ( $arr_newLink as $k => $v ) {
                                        ?>
                                        <input type="radio" id="radio_<?=$k?>" name="MENU_ON" value="<?=$k?>"/>
                                        <label for="radio_<?=$k?>"> <?=$v?> </label>
                                    <? } ?>
                                </td>
                            </tr>
							<?
								//대표 홈페이지일 경우에만 해당영역 노출 - 20.12.02 shlee
								if($id=="main") {
							?>
							<tr>
                                <th scope="row">
                                    담당부서
                                </th>
                                <td>
                                    <input type="text" id="ETC2" name="ETC2" value="" placeholder="담당부서" />
                                </td>
                            </tr>
							<!--<tr>
                                <th scope="row">
                                    담당자
                                </th>
                                <td>
                                    <input type="text" id="ETC3" name="ETC3" value="" placeholder="담당자" />
                                </td>
                            </tr>
							<tr>
                                <th scope="row">
                                    이메일
                                </th>
                                <td>
                                    <input type="text" id="ETC4" name="ETC4" value="" placeholder="이메일" />
                                </td>
                            </tr>-->
							<tr>
                                <th scope="row">
                                    전화번호
                                </th>
                                <td>
                                    <input type="text" id="ETC5" name="ETC5" value="" placeholder="전화번호" />
                                </td>
                            </tr>
							<?
								}
							?>
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
                        <a href="javascript:ifrm_infoView(TREE_ID, $('#frm_menuInfo input[name=TREE_NO]').val(), 'contents');" class="btn-type01" id="subfrm-contents">
                            내용 관리
                        </a>
                        <!--<a href="javascript:depth_imageInput(TREE_ID, $('#frm_menuInfo input[name=TREE_NO]').val());" class="btn-type01" id="depthMenu_image">
                            대표이미지 등록
                        </a>-->
                    </div>
                </form>
            </div>
        </div>
        <div id="sub-ifrm" style="margin-top: 25px;">
            <h3 class="title0301">
                상세 내용 정보
            </h3>
            <iframe class="reHeight-iFrm" id="sub-ifrm-control" frameborder="0" style="min-height: 450px; width: 100%; border: 1px solid #a4a7ac;"></iframe>
        </div>
    </fieldset>

</div>
<!-- //contents -->
</body>
</html>
