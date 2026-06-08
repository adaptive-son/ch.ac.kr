<?
// adframe 공통 인클루드 파일
include_once "../_common.php";
include_once "auth_config.php";

$auth_row = $adb->getRow("SELECT * FROM ".TABLE_BOARD_MNG." WHERE idx='".$_GET[idx]."'"); //게시판 정보

?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset='utf-8' />
    <link rel="stylesheet" href="../css/common.css" />
    <link rel="stylesheet" href="../css/board.css" />
    <link rel="stylesheet" href="../css/admin.auth.css" type="text/css">
    <script type="text/javascript" src="../js/jquery-1.10.1.min.js"></script>
    <script type="text/javascript" src="../js/jquery-ui.js"></script>
    <link type="text/css" rel="stylesheet" href="../js/jquery-ui.css" />
    <link type="text/css" rel="stylesheet" href="../css/jquery.multiselect.css" />
    <script type="text/javascript" src="../js/jquery.scrollTo.js"></script>
    <script type="text/javascript" src="../js/jquery.multiselect.js"></script>
<style>
    .multiselect {
        width: 500px;
        height: 140px;
    }
    .box { float: left; width: 50%; height:200px;}
</style>
<script type="text/javascript">
    $(function(){
        $.extend($.ui.multiselect.locale, {
            addAll:'전체추가',
            removeAll:'전체삭제',
            itemsCount:'개 선택'
        });
        $(".multiselect").multiselect();
    });
    function SubmitIt(){
        var form = document.BoxForm;
        form.submit();
    }
</script>
</head>
<body>
<div class="wrapper" id="wrapper" style="padding: 0; padding-left: 31px; min-height: 550px; background-color: #fff;">
    <!-- contents -->
    <div class="contents">

        <h2 class="title0201">
            <?=$auth_row[board_name]?> 게시판 권한설정
        </h2>

<form name="pform" method="post" action="proc.php">
    <input type="hidden" name="Confirm" value="auth">
    <input type="hidden" name="idx" value="<?=$idx?>">

    <div class="board-search-area">
        <input type="checkbox" name="fm_auth_admin" value="Y" <? if($auth_row[auth_admin] == "Y") echo " checked"; ?>>
        <strong>관리자 전용</strong> (다른 권한이 무시되고 공지사항기능으로만 동작)
    </div>

    <div>
        <div class="box">
            <input type="checkbox" value="Y"  name="fm_auth_list_use"<? if($auth_row[auth_list_use] == "Y") echo " checked"; ?>> <b>목록보기</b>
            <select name="config_menu1[]" class="multiselect" multiple="multiple">
                <?
                foreach($Config_AuthArray as $key => $value) {

                    if(strpos(",".$auth_row[auth_list], $value) == true)	$sel = " selected='selected'";
                    else													$sel = "";

                    ?>
                    <option value="<?=$value?>"<?=$sel?>><?=$key?></option>
                    <?
                }
                ?>
            </select>
        </div>

        <div class="box">
            <input type="checkbox" value="Y"  name="fm_auth_read_use"<? if($auth_row[auth_read_use] == "Y") echo " checked"; ?>> <b>내용보기</b>
            <select name="config_menu2[]" class="multiselect" multiple="multiple">
                <?
                foreach($Config_AuthArray as $key => $value) {

                    if(strpos(",".$auth_row[auth_read], $value) == true)	$sel = " selected='selected'";
                    else													$sel = "";

                    ?>
                    <option value="<?=$value?>"<?=$sel?>><?=$key?></option>
                    <?
                }
                ?>
            </select>
        </div>

        <div class="box">
            <input type="checkbox" value="Y"  name="fm_auth_write_use"<? if($auth_row[auth_write_use] == "Y") echo " checked"; ?>> <b>글쓰기</b>
            <select name="config_menu3[]" class="multiselect" multiple="multiple">
                <?
                foreach($Config_AuthArray as $key => $value) {

                    if(strpos(",".$auth_row[auth_write], $value) == true)	$sel = " selected='selected'";
                    else													$sel = "";

                    ?>
                    <option value="<?=$value?>"<?=$sel?>><?=$key?></option>
                    <?
                }
                ?>
            </select>
        </div>
        <div class="box">
            <input type="checkbox" value="Y"  name="fm_auth_reply_use"<? if($auth_row[auth_reply_use] == "Y") echo " checked"; ?>> <b>답글쓰기</b>
            <select name="config_menu4[]" class="multiselect" multiple="multiple">
                <?
                foreach($Config_AuthArray as $key => $value) {

                    if(strpos(",".$auth_row[auth_reply], $value) == true)	$sel = " selected='selected'";
                    else													$sel = "";

                    ?>
                    <option value="<?=$value?>"<?=$sel?>><?=$key?></option>
                    <?
                }
                ?>
            </select>
        </div>
        <div class="box">
            <input type="checkbox" value="Y"  name="fm_auth_comment_use"<? if($auth_row[auth_comment_use] == "Y") echo " checked"; ?>> <b>댓글쓰기</b>
            <select name="config_menu5[]" class="multiselect" multiple="multiple">
                <?
                foreach($Config_AuthArray as $key => $value) {

                    if(strpos(",".$auth_row[auth_comment], $value) == true)	$sel = " selected='selected'";
                    else													$sel = "";

                    ?>
                    <option value="<?=$value?>"<?=$sel?>><?=$key?></option>
                    <?
                }
                ?>
            </select>
        </div>
        <div class="box">
            <input type="checkbox" value="Y"  name="fm_auth_download_use"<? if($auth_row[auth_download_use] == "Y") echo " checked"; ?>> <b>파일다운로드</b>
            <select name="config_menu7[]" class="multiselect" multiple="multiple">
                <?
                foreach($Config_AuthArray as $key => $value) {

                    if(strpos(",".$auth_row[auth_download], $value) == true)	$sel = " selected='selected'";
                    else														$sel = "";

                    ?>
                    <option value="<?=$value?>"<?=$sel?>><?=$key?></option>
                    <?
                }
                ?>
            </select>
        </div>
        <!--
        <div class="box">
            <b>게시판 관리그룹</b>
            <select name="config_menu8[]" class="multiselect" multiple="multiple1">

                <?
                foreach($Config_AdminAuthArray as $key => $value) {

                    if(strpos(",".$auth_row[manager_group], $value) == true)	$sel = " selected='selected'";
                    else														$sel = "";

                    ?>
                    <option value="<?=$value?>"<?=$sel?>><?=$key?></option>
                    <?
                }
                ?>
            </select>
        </div>-->
    </div>


    <div class="btns-area" style="clear:both;">
        <div class="btns-left">
        <input type="submit" value="저장" class="btn-type01">
        </div>
    </div>
</form>
        <div class="board-search-area" style="margin-top:10px;">
            [도움말]<br>
            * 관리자 전용 : 관리자 모드에서만 답글, 쓰기, 수정 등 가능. 사용자 모드에서는 목록보기, 내용보기만 가능<br>
            * 각 권한의 체크박스를 체크하게 되면 로그인 해야지만 각각의 권한을 얻을 수 있다.<br>
            * 오른쪽 박스의 회원구분은 권한 거부, 왼쪽 박스의 회원구분은 권한 허용.<br>
            * 각 권한의 체크박스를 해제하면 로그인 하지 않고도 권한을 얻을 수 있다.
        </div>
    </div>
</div>

</body>
</html>
