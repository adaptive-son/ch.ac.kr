<? include_once "../_common.php"; ?>

<!DOCTYPE HTML>
<html lang="ko">

<head>
    <? include_once("../include/__meta.php"); ?>

    <?
    $sql = " select * from ".TABLE_MEMBER." member where   member.del_yn='N' AND member.id = '".$_SESSION[MEMBER_ID]."' ";

    $row = $adb->getRow($sql, array(), DB_FETCHMODE_ASSOC);

    ?>
    <title>개인정보 수정</title>
    <script>
        $(document).ready(function() {
            // 관리자 정보 수정
            $(".modifyInfo-btns").click(function() {
                var arr = ["id", "password", "password_check"];
                var msg = ["아이디를 입력하세요.", "비밀번호를 입력하세요.", "확인을 위한 비밀번호를 입력하세요."];
                for ( var i = 0 ; i < arr.length ; i++ ) {
                    if ( $("#modify_form").find("input[name='"+arr[i]+"']").val() == "" ) {
                        alert(msg[i]);
                        $("#modify_form").find("input[name='"+arr[i]+"']").focus();
                        return;
                    }
                }
                if ( $("input[name='password']").val() != $("input[name='password_check']").val() ) {
                    alert("비밀번호가 다릅니다.");
                    $("input[name='password_check']").focus();
                    return;
                }
                if ( confirm("관리자 정보를 수정하시겠습니까?") ) {
                    $("#modify_form").attr("action", "change.myinfo.proc.php");
                    $("#modify_form").submit();
                }
            });
            // 취소
            $(".listview-btns").click(function() {
                location.reload();
            });
        });
    </script>
</head>
<body>
<!-- wrapper -->
<div class="wrapper" id="wrapper" style="padding: 0; min-height: 600px;">
    <!-- container -->
    <div class="container" id="container" style="background-color: #fff;">
        <!-- contents -->
        <div class="contents" id="contents">
            <!-- contents area -->

            <h2 class="title0201">개인 정보 수정</h2>

            <div class="contents-area">

                <div class="board-area">

                    <fieldset>
                        <legend class="blind">상세보기</legend>

                        <div class="board-write">

                            <form name="modify_form" id="modify_form" method="POST">
                                <input type='hidden' name='before_id' value='<?=$row[id]?>'>

                                    <dl style="padding-left: 250px;">
                                        <dt style="width: 180px;">
                                            <label for="id">
                                                회원 아이디
                                            </label>
                                        </dt>
                                        <dd>
                                            <input type="text" name="id" id="id" value="<?=$row['id']?>" readonly>
                                        </dd>
                                    </dl>

                                    <dl style="padding-left: 250px;">
                                        <dt style="width: 180px;">
                                            <label for="password">
                                                신규 패스워드
                                            </label>
                                        </dt>
                                        <dd>
                                            <input type="password" name="password" id="password" value="">
                                        </dd>
                                    </dl>
                                    <dl style="padding-left: 250px;">
                                        <dt style="width: 180px;">
                                            <label for="password_check">
                                                신규 패스워드 확인
                                            </label>
                                        </dt>
                                        <dd>
                                            <input type="password" name="password_check" id="password_check" value="">
                                        </dd>
                                    </dl>

                            </form>

                        </div>

                        <div style="text-align:center;" class="mt35">
                            <a href="javascript:;" class="modifyInfo-btns btn-type01">
                                수정
                            </a>

                            <a href="javascript:history.back(-1)" class="listview-btns btn-type02">
                                취소
                            </a>
                        </div>

                    </fieldset>
                </div>

            </div>
        </div>
    </div>
</div>

<? if ( $adb ) $adb->disconnect(); ?>

</body>
</html>

