<?
include_once "../_common.php";
$sql = " select * from ".TABLE_CMS_CONTENTS." where TREE_NO = '".$treeno."' and TREE_ID = '".$id."' ";
$row = $adb->getRow($sql, DB_FETCHMODE_ASSOC);
if ( count($row) > 0 ) $mode = "update";
else $mode = "insert";
?>
<!doctype html>
<html lang="ko">
<head>
    <title>관리자페이지 - <?=_TAG_TITLE?></title>
    <? include_once("../include/__meta.php"); ?>
    <script>
        <!--
        function chk_frm(frm) {
            if ( $("#TEMPLATE").val() == "" ) {
                alert("레이아웃을 선택해주세요.");
                $("#TEMPLATE").focus();
                return false;
            }
            if ( $("#ETC5").val() == "" ) {
                alert("서브도메인명을 입력해주세요.");
                $("#ETC5").focus();
                return false;
            }
            if ( $("#FOOTER_ADDR").val() == "" ) {
                alert("주소를 입력해주세요.");
                $("#FOOTER_ADDR").focus();
                return false;
            }
            if ( $("#FOOTER_TEL").val() == "" ) {
                alert("전화번호를 입력해주세요.");
                $("#FOOTER_TEL").focus();
                return false;
            }
            frm.action = "control.class.proc.php";
        }
        //-->
    </script>
</head>
<body>
<!-- wrapper -->
<div class="wrapper" id="wrapper" style="padding: 0; min-height: 100px; height: auto; width: 100%; min-width: 100px; overflow: hidden;">
    <div class="contents" style="width: inherit; min-width: inherit; padding-top: 0px;">

        <div class="board-area" style="width: calc(100%-50px); padding: 20px;">
            <form name="control-class-common" id="control-class-common" method="POST" onsubmit="javascript:chk_frm(this);" enctype="multipart/form-data">
                <input type="hidden" name="mode" value="<?=$mode?>">
                <input type="hidden" name="TREE_ID" id="TREE_ID" value="<?=$id?>"/>
                <input type="hidden" name="TREE_NO" id="TREE_NO" value="<?=$treeno?>"/>
                <fieldset>
                    <legend class="blind">글쓰기</legend>

                    <h3 class="title0301">
                        공통부분 설정
                    </h3>

                    <div class="board-write01">
                        <dl>
                            <dt>
                                <label for="type">
                                    레이아웃 설정
                                    <strong class="point-important">*</strong>
                                </label>
                            </dt>
                            <dd>
                                <select id="TEMPLATE" name="TEMPLATE" style="width: 150px;">
                                    <option value="">선택안함</option>
                                    <? for ( $i = 1 ; $i < 6 ; $i++ ) { $i = str_pad($i, 2, "0", STR_PAD_LEFT); ?>
                                        <option value="<?=$i?>" <? if ( $row[TEMPLATE] == $i ) echo "selected"; ?>>시안<?=$i?></option>
                                    <? } ?>
                                </select>
                            </dd>
                        </dl>
                        <dl>
                            <dt>
                                <label for="ETC5">
                                    서브도메인
                                    <strong class="point-important">*</strong>
                                </label>
                            </dt>
                            <dd>
                                <input type="text" id="ETC5" name="ETC5" value="<?=$row[ETC5]?>" style="width:95%;" />
                            </dd>
                        </dl>
                        <dl class="writer-add-file">
                            <dt>
                                <label for="">
                                    대표이미지
                                    <strong class="point-important">*</strong>
                                </label>
                            </dt>
                            <dd>
                                <p class="mb10 point-color01">
                                    ※ 최대 2MB 까지 업로드 가능합니다
                                </p>
                                <div class="file-box">
                                    <input type="file" id="IMG_FILE" name="IMG_FILE" value="" />
                                </div>
                            </dd>
                            <? if ( $row[IMG_RFILE] ) { ?>
                                <dd class="file-info-area">
                                    <p class="file-info">
                                        <!--<input type="checkbox" id="chk-file01" name="chk_file01" />-->
                                        <label for="chk-file01">
                                            <?=$row[IMG_RFILE]?>
                                        </label>
                                        <!--
                                        <a href="#delete" class="btn-file-delete">
                                            파일삭제
                                        </a>
                                        -->
                                    </p>
                                </dd>
                            <? } ?>
                        </dl>
                        <dl>
                            <dt>
                                <label for="FOOTER_ADDR">
                                    주소
                                    <strong class="point-important">*</strong>
                                </label>
                            </dt>
                            <dd>
                                <input type="text" id="FOOTER_ADDR" name="FOOTER_ADDR" value="<?=$row[FOOTER_ADDR]?>" style="width:95%;" />
                            </dd>
                        </dl>
                        <dl>
                            <dt>
                                <label for="FOOTER_TEL">
                                    TEL
                                    <strong class="point-important">*</strong>
                                </label>
                            </dt>
                            <dd>
                                <input type="text" id="FOOTER_TEL" name="FOOTER_TEL" value="<?=$row[FOOTER_TEL]?>" style="width:95%;" />
                            </dd>
                        </dl>
                        <dl>
                            <dt>
                                <label for="FOOTER_FAX">
                                    FAX
                                </label>
                            </dt>
                            <dd>
                                <input type="text" id="FOOTER_FAX" name="FOOTER_FAX" value="<?=$row[FOOTER_FAX]?>" style="width:95%;" />
                            </dd>
                        </dl>

                        <dl>
                            <dt>
                                <label for="ETC1">
                                    CYWORLD 클럽
                                </label>
                            </dt>
                            <dd>
                                <input type="text" id="ETC1" name="ETC1" value="<?=$row[ETC1]?>" style="width:95%;" />
                            </dd>
                        </dl>
                        <dl>
                            <dt>
                                <label for="ETC2">
                                    FACEBOOK
                                </label>
                            </dt>
                            <dd>
                                <input type="text" id="ETC2" name="ETC2" value="<?=$row[ETC2]?>" style="width:95%;" />
                            </dd>
                        </dl>
                        <dl>
                            <dt>
                                <label for="ETC3">
                                    네이버 카페
                                </label>
                            </dt>
                            <dd>
                                <input type="text" id="ETC3" name="ETC3" value="<?=$row[ETC3]?>" style="width:95%;" />
                            </dd>
                        </dl>
                    </div>

                    <h3 class="title0301">
                        메인페이지 링크 및 게시판 설정
                    </h3>

                    <div class="board-write01">
                        <!-- // 메인페이지 설정 관련 내용 -->
                        <?
                        // 메인페이지 링크 설정 - 고정값
                        switch($row[TEMPLATE]) {
                            case '01':
                                $arr_linkTitle = array("교육목표", "학사일정", "강의시간표", "입학안내", "취업정보", "커뮤니티", "학과특성", "교육과정소개", "졸업후진로");
                                $arr_recentBoard = array("공지사항", "자료실");
                                break;
                            case '02':
                                $arr_linkTitle = array("학과특성", "교육과정", "학사일정", "입학안내", "강의시간표", "졸업후진로", "취업정보");
                                $arr_recentBoard = array("공지사항", "포토갤러리");
                                break;
                            case '03':
                                $arr_linkTitle = array("학사일정", "학과특성", "교육과정", "졸업후진로", "교육목표", "입학안내", "취업정보");
                                $arr_recentBoard = array("공지사항", "자료실");
                                break;
                            case '04':
                                $arr_linkTitle = array("학과특성", "교육과정", "졸업후진로", "입학안내", "학사일정");
                                $arr_recentBoard = array("공지사항");
                                break;
                            case '05':
                                $arr_linkTitle = array("학과특성", "교육과정", "포토갤러리", "자료실", "입학안내", "취업정보", "졸업후진로", "강의시간표" );
                                $arr_recentBoard = array();
                                break;
                            default:
                                $arr_linkTitle = array();
                                $arr_recentBoard = array();
                                break;
                        }
                        foreach ( $arr_linkTitle as $k => $v ) {
                            $MAIN_LINK_NO = "MAIN_LINK".($k+1);
                            ?>
                            <dl>
                                <dt>
                                    <label for="<?=$MAIN_LINK_NO?>">
                                        링크 - <?=$v?>
                                    </label>
                                </dt>
                                <dd>
                                    <input type="text" id="<?=$MAIN_LINK_NO?>" name="<?=$MAIN_LINK_NO?>" value="<?=$row[$MAIN_LINK_NO]?>" style="width:95%;" placeholder="링크될 메뉴의 번호를 입력해주세요."/>
                                </dd>
                            </dl>
                        <? } ?>
                        <?
                        // 메인페이지 최신글 게시판 코드 - 고정값
                        foreach ( $arr_recentBoard as $k => $v ) {
                            $MAIN_BOARD_NO = "MAIN_BOARD".($k+1);
                            ?>
                            <dl>
                                <dt>
                                    <label for="<?=$MAIN_LINK_NO?>">
                                        게시판 - <?=$v?>
                                    </label>
                                </dt>
                                <dd>
                                    <input type="text" id="<?=$MAIN_BOARD_NO?>" name="<?=$MAIN_BOARD_NO?>" value="<?=$row[$MAIN_BOARD_NO]?>" style="width:95%;" placeholder="게시판 메뉴의 번호를 입력해주세요." />
                                </dd>
                            </dl>
                        <? } ?>
                        <!-- // 메인페이지 설정 관련 내용 -->
                    </div>

                    <div class="btns-area">
                        <div class="btns-right">
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