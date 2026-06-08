<?
// adframe 공통 인클루드 파일
include_once "../_common.php";

if ($mode == "u") {
    $sql = "select member.*, adm.* from " . TABLE_MEMBER . " member 
        INNER JOIN " . TABLE_ADMIN . " adm ON adm.id = member.id
        where adm.idx = '" . $idx . "'";

    $row = mysql_fetch_array(mysql_query($sql));
    $title = "수정";

} else if ($j == "") {
    $title = "입력";
}
?>

<!DOCTYPE HTML>
<html lang="ko">

<head>
    <? include_once("../include/__meta.php"); ?>
    <title> 관리자페이지 </title>

    <script type="text/javascript">
        $(document).ready(function(){
            //최상단 체크박스 클릭
            $("#checkall").click(function(){
                //클릭되었으면
                if($("#checkall").prop("checked")){
                    $("input[id=cms_site_id]").prop("checked",true);
                    //클릭이 안되있으면
                }else{
                    $("input[id=cms_site_id]").prop("checked",false);
                }
            });

            adm_group_check();

            $("#adm_group").change(function(){
                adm_group_check();
            });
        });

        function adm_group_check(){
            if($("#adm_group").val()=="T"){
                $("input[type=checkbox]").prop("checked",false);
                $("input[type=checkbox]").attr("disabled",true);
            }else{
                $("input[type=checkbox]").attr("disabled",false);
            }
        }

        function member_search()
        {
            var url= 'member.search.php?mode=regadm';
            window.open(url, "memberserach", "left=50, top=50, width=500, height=550, scrollbars=1");
        }

        function selMember(memberId, memberName){
            $("#id").val(memberId);
            $("#name").val(memberName);
        }


        function fn_inputFormSubmit(f){
            if(!Val_Chk(f.id,"아이디"))   return false;
            if(!Val_Chk(f.name,"이름"))   return false;
            if(!SelectBox_Chk(f.adm_group,"관리자유형"))   return false;
            return true;
        }




    </script>


</head>
<body>

<!-- wrapper -->
<div class="wrapper" id="wrapper" style="padding: 0; padding-left: 31px; min-height: 550px; background-color: #fff;">
    <div class="contents">
        <form name="frm_adminfo" id="frm_adminfo" method="POST" action="adm.proc.php" onsubmit="return fn_inputFormSubmit(this)">
            <input type="hidden" name="mode" id="mode" value="<?=$mode?>"/>
            <input type="hidden" name="idx" id="idx" value="<?=$idx?>"/>
            <h2 class="title0201">운영자 관리</h2>
            <div class="menu-option-wrapper">
                <div class="menu-option-left-area">
                    <div class="menu-title-area">
                        <h3 class="title0301">
                            관리자 정보
                        </h3>
                    </div>
                    <div class="t1 mb30">
                        <table style="width: 100%">
                            <colgroup>
                                <col style="width: 30%">
                                <col style="width: 70%">
                            </colgroup>
                            <tbody>
                            <tr>
                                <th scope="row">
                                    아이디<strong class="point-important">*</strong>
                                </th>
                                <td><input type="text" name="id" id="id" value="<?= $row[id] ?>" readonly/>
                                    <?php if($mode==""){?>
                                    <button type="button" onclick="member_search()">찾기</button>
                                    <? }?>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">
                                    이름<strong class="point-important">*</strong>
                                </th>
                                <td><input type="text" name="name" id="name" value="<?= $row[name] ?>" readonly/></td>
                            </tr>
                            <tr>
                                <th scope="row">
                                    관리자 유형<strong class="point-important">*</strong>
                                </th>
                                <td>
                                    <?= make_selectbox('adm_group', '', 'ADM_TYPE', $row[adm_group], 'Y'); ?>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="menu-option-right-area">
                    <div class="menu-title-area">
                        <h3 class="title0301">
                            관리 사이트 선택
                        </h3>
                        <p class="word-right">
                        </p>
                    </div>

                        <div class="t1 mb30">
                            <input type="hidden" name="mode" value="<?= $mode ?>">
                            <table style="width: 100%">
                                <colgroup>
                                    <col style="width: 10%">
                                    <col style="width: 45%">
                                    <col style="width: 45%">
                                </colgroup>
                                <tbody>
                                <tr>
                                    <th><input type="checkbox" id="checkall" /></th>
                                    <th scope="row">
                                        사이트명
                                    </th>
                                    <th>ID</th>
                                </tr>
                                <tr>
                                    <td colspan="3" style="padding: 0;">
                                        <div style="height:260px; overflow-y:auto;">
                                            <table style="width: 100%">
                                                <colgroup>
                                                    <col style="width: 10%">
                                                    <col style="width: 45%">
                                                    <col style="width: 45%">
                                                </colgroup>
                                                <tbody>
                                                <?php
                                                $site_sql = "SELECT mng.*,
                                                (SELECT COUNT(*)FROM site_admin WHERE site_id=mng.site_id AND id='" . $id . "') AS reg_cnt
                                                FROM ".TABLE_SITE_MNG." mng WHERE mng.use_yn ='Y' order by mng.site_no asc ";
                                                $result = mysql_query($site_sql) or die (mysql_error());

                                                while ($site_row = mysql_fetch_array($result)) {
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <input type="checkbox" id="cms_site_id" name="cms_site_id[]"
                                                                   value="<?= $site_row[site_id] ?>" <? if ($site_row[reg_cnt] > 0) echo "checked"; ?>>
                                                        </td>
                                                        <td><?= $site_row[site_name] ?></td>
                                                        <td><?= $site_row[site_id] ?></td>
                                                    </tr>
                                                <? } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>

                        </div>

                        <div class="btns-center">
                            <button type="submit" class="btn-type01">
                                확인
                            </button>
                            <a href="javascript:history.back(-1);" class="btn-type02">
                                목록
                            </a>
                        </div>

                </div>
            </div>
        </form>

    </div>
</div>
<!-- //wrapper -->

</body>
</html>