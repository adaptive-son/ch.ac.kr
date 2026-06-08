<?
// adframe 공통 인클루드 파일
include_once "../_common.php";

if ($mode == "u") {
    $sql = "select member.* from " . TABLE_MEMBER . " member 
        where member.del_yn='N' AND member.idx = '" . $idx . "'";

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
        });


        function fn_inputFormSubmit(f){
            if(!Val_Chk(f.id,"아이디"))   return false;
            if(!Val_Chk(f.name,"이름"))   return false;
            if(!SelectBox_Chk(f.member_type,"회원 유형"))   return false;
            if ($mode == "") {
                if(!Val_Chk(f.password,"패스워드"))   return false;
                if(!Val_Chk(f.password_check,"패스워드 확인"))   return false;
            }
            if ( $("input[name='password']").val() != $("input[name='password_check']").val() ) {
                alert("비밀번호가 다릅니다.");
                $("input[name='password_check']").focus();
                return;
            }
            return true;
        }




    </script>


</head>
<body>

<!-- wrapper -->
<div class="wrapper" id="wrapper" style="padding: 0; padding-left: 31px; min-height: 550px; background-color: #fff;">
    <div class="contents">
        <form name="frm_userinfo" id="frm_userinfo" method="POST" action="user.proc.php" onsubmit="return fn_inputFormSubmit(this)">
        <input type="hidden" name="mode" id="mode" value="<?=$mode?>"/>
        <input type="hidden" name="idx" id="idx" value="<?=$idx?>"/>
        <h2 class="title0201">회원 관리</h2>

        <div class="menu-title-area">
            <h3 class="title0301">
                회원 정보
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
                    <td><input type="text" name="id" id="id" value="<?= $row[id] ?>" />
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        이름<strong class="point-important">*</strong>
                    </th>
                    <td><input type="text" name="name" id="name" value="<?= $row[name] ?>"/></td>
                </tr>
                <tr>
                    <th scope="row">
                        패스워드<strong class="point-important">*</strong>
                    </th>
                    <td><input type="password" name="password" id="password" value=""></td>
                </tr>
                <tr>
                    <th scope="row">
                        패스워드 확인<strong class="point-important">*</strong>
                    </th>
                    <td><input type="password" name="password_check" id="password_check" value=""></td>
                </tr>
                <tr>
                    <th scope="row">
                        회원 유형<strong class="point-important">*</strong>
                    </th>
                    <td>
                        <?= make_selectbox('member_type', '', 'MEMBER_TYPE', $row['user_type'], ''); ?>
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

        </form>

    </div>
</div>
<!-- //wrapper -->

</body>
</html>