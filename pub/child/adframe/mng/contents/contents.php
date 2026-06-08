<?
include_once "../_common.php";
$sql = " select * from ".TABLE_CMS_CONTENTS." where TREE_NO = '".$treeno."' and TREE_ID = '".$id."' ";
$row = $adb->getRow($sql, DB_FETCHMODE_ASSOC);

//메뉴 정보 가지고 오기
$sql_menu = " SELECT * FROM ".TABLE_TREE." WHERE TREE_NO = '".$treeno."' and TREE_ID = '".$id."' ";
$rs_menu = $adb->getRow($sql_menu, DB_FETCHMODE_ASSOC);

if ( count($row) > 0 ) $mode = "update";
else $mode = "insert";
?>
<!doctype html>
<html lang="ko">
<head>
    <title>관리자페이지<?=$sql_menu?></title>
    <? include_once("../include/__meta.php"); ?>
        <script type="text/javascript" src="/adframe/bbs/Extention/Editor/smart_editor/js/HuskyEZCreator.js"></script>
    <script>
        var oEditors = [];
        $(function() {
			//미리보기 페이지 링크
            $("#preview-page").click(function() {
                window.open("/contents/contents_Preview.php?site_id=<?=$id?>&TREE_NO=<?=$treeno?>&DEPTH=<?=$rs_menu['DEPTH']+1?>");
            });

            nhn.husky.EZCreator.createInIFrame({
                oAppRef: oEditors,
                elPlaceHolder: "CONTENTS",
                sSkinURI: "/adframe/bbs/Extention/Editor/smart_editor/SmartEditor2Skin.html",
                fCreator: "createSEditor2",
                htParams: {
                    bSkipXssFilter: true
                }
            });
        });

        function chk_frm(frm) {

            if (oEditors != undefined) {
                oEditors.getById["CONTENTS"].exec("UPDATE_CONTENTS_FIELD", []);
            }
            $('#CONTENTS').val( $('#CONTENTS').val() == '<p>&nbsp;</p>' ? '' :  $('#CONTENTS').val());
            var content = frm.CONTENTS.value;
            frm.action = "proc.php";
        }

    </script>
</head>
<body>
<!-- wrapper -->
<div class="wrapper" id="wrapper" style="padding: 0; min-height: 100px; height: auto; width: 100%; min-width: 100px; overflow: hidden;">
    <div class="contents" style="width: inherit; min-width: inherit;">

        <div class="board-area" style="width: calc(100%-50px); padding: 20px;">
            <form name="control-class-common" id="control-class-common" method="POST" onsubmit="javascript:chk_frm(this);" enctype="multipart/form-data">
                <input type="hidden" name="mode" id="mode" value="<?=$mode?>" />
                <input type="hidden" name="TREE_ID" id="TREE_ID" value="<?=$id?>"/>
                <input type="hidden" name="TREE_NO" id="TREE_NO" value="<?=$treeno?>"/>
                <input type="hidden" name="STAFF_REGDATE" id="STAFF_REGDATE" value="<?=date("Y-m-d H:i:s")?>" />
                <fieldset>
                    <legend class="blind">글쓰기</legend>

                    <div class="board-write01">
                        <dl>
                            <dt>
                                <label for="board-write-contents">
                                    내용
                                </label>
                            </dt>
                            <dd>
                                <textarea id="CONTENTS" name="CONTENTS" cols="50" rows="5" style="width: 100%;">
                                    <?=stripslashes($row[CONTENTS]);?>
                                </textarea>
                            </dd>
                        </dl>
                        <!--<dl>
                            <dt>
                                <label for="STAFF">
                                    담당자
                                </label>
                            </dt>
                            <dd>
                                <input type="text" name="STAFF" id="STAFF" style="width: 95%;" value="<?=$row[STAFF]?>" placeholder="담당자 이름">
                            </dd>
                        </dl>
                        <dl>
                            <dt>
                                <label for="STAFF_TEL">
                                    전화번호
                                </label>
                            </dt>
                            <dd>
                                <input type="text" name="STAFF_TEL" id="STAFF_TEL" style="width: 95%;" value="<?=$row[STAFF_TEL]?>" placeholder="담당자 전화번호">
                            </dd>
                        </dl>-->
                    </div>
                    <div class="btns-area">
                        <div class="btns-right">
                            <a href="javascript:;" class="btns-type01" id="preview-page">
                                미리보기
                            </a>
                            <input type="submit" value="확인" class="btns-type02" />
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>


    </div>
</div>
<!-- //wrapper -->
<? include_once("__footer.php"); ?>
</body>
</html>