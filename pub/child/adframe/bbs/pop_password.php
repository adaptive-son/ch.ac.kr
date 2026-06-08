					<!-- 비밀글 비밀번호 입력 -->
					<div class="layerpopup-password-wrapper" style="display: none;">
						<div class="layerpopup-password-area">
							<form method="POST" name="pwdForm" id="pwdForm">
                                <fieldset>
                                    <legend class="blind">
                                        비밀번호
                                    </legend>
                                    <input type="hidden" name="data" id="data">
                                    <input type="hidden" name="site_id" id="site_id" value="<?=TREE_ID?>">
                                    <input type="hidden" name="TREE_NO" id="TREE_NO" value="<?=$TREE_NO?>">
                                    <input type="hidden" name="DEPTH" id="DEPTH" value="<?=$DEPTH?>">
                                    <input type="hidden" name="CHILD" id="CHILD" value="<?=$CHILD?>">


                                    <div class="layerpopup-password-area">
                                        <label for="board-password">
                                            <span class="icon-secret">
                                                <img src="/_common/img/board/icon_secret@2x.png" alt="비밀글">
                                            </span>
                                            비밀번호를 입력해주세요.
                                        </label>

                                        <input type="password" id="chkPwd" name="pwd" value="">
                                    </div>
                                    <div class="footer-button-wrapper">
                                        <button type="button" class="btn-cancel">
                                            취소
                                        </button>

                                        <button type="button" id="btnConfirm" name="btnConfirm" class="btn-confirm">
                                            확인
                                        </button>
                                    </div>
                                    <!-- 비밀번호 입력 폼 -->

								</fieldset>
							</form>
                            <button type="button" class="btn-layerpopup-close">
                                창닫기
                            </button>
						</div>
					</div>
					<!-- //비밀글 비밀번호 입력 -->



                    <script>
                        $(document).ready(function() {
                            /* 비밀글 비밀번호 입력 취소*/
                            $(".mask-layerpopup, .btn-layerpopup-close, .btn-cancel").on("click", function() {
                                $(".layerpopup-password-wrapper").hide();
                                $(".mask-layerpopup").fadeOut(300);
                                $('#chkPwd').val("");
                                $('#btnConfirm').removeAttr('flag');
                            });


                            $('#btnConfirm').bind("click", function() {
                                if ($('#chkPwd').val() == '') {
                                    alert("패스워드를 입력하여 주십시오.");
                                    return false;
                                }

                                 // 클래스에 정의된 함수 호출
                                 if ($('#btnConfirm').attr('flag') == 'mod') {
                                    bbsEdit();
                                 } else if ($('#btnConfirm').attr('flag') == 'del') {
                                    bbsDel();
                                 }else{
                                    chk_password();
                                 }
                                 //chk_password();
                            });

                        });

                        function chk_secret(data){
                            var form=document.pwdForm;
                            form.data.value = data;
                            /*form.TREE_NO.value = tree_no;
                            form.DEPTH.value = depth;
                            form.child.value = child;*/

                            event.preventDefault();
                            $(".mask-layerpopup").fadeIn(300, function() {
                                $(".layerpopup-password-wrapper").show();
                            });
                        }


                        function chk_password() {
                            var form=document.pwdForm;
                            if ($('#chkPwd').val() == '') {
                                alert("패스워드를 입력하여 주십시오.");
                                return false;
                            }else{
                                form.action='/adframe/bbs/module_pw.php?data='+form.data.value+'&BURL=<?=$PHP_SELF?>&secret=ok';
                                form.submit();
                            }
                        }
                    </script>