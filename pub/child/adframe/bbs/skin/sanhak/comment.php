<script>
    function CommentSendit() {
        var cform=document.commentform;

        if(cform.fm_name.value==""){
            alert("이름을(를) 입력해 주십시오.");
            cform.fm_name.focus();
        }
        else if(cform.fm_pwd.value==""){
            alert("비밀번호을(를) 입력해 주십시오.");
            cform.fm_pwd.focus();
        }
        else if(cform.fm_content.value==""){
            alert("내용을(를) 입력해 주십시오.");

        }
        else{
            cform.submit();
        }
    }
</script>
<div class="comment-wrapper">
    <? if($_BBS_commented == "OK") { ?>
    <form name="commentform" method="post" action="/adframe/bbs/module_wte.php">
        <input type="hidden" name="data" value="<?=$data?>">
        <input type="hidden" name="BURL" value="<?=$PHP_SELF?>">
        <input type="hidden" name="Confirm" value="Comment">
        <input type="hidden" name="site_id" value="<?=TREE_ID?>">
        <input type="hidden" name="TREE_NO" value="<?=$TREE_NO?>">
        <input type="hidden" name="DEPTH" value="<?=$DEPTH?>">
        <div class="comment-form-wrapper">
            <div class="comment-form-area">
                <div class="comment-header-wapper">
                    <div class="left">
                        <div class="comment-input-wrapper">
                            <label for="fm_name">
                                작성자
                            </label>
                            <input type="text" id="fm_name" name="fm_name" value="">
                        </div>

                        <div class="comment-input-wrapper">
                            <label for="fm_pwd">
                                비밀번호
                            </label>
                            <input type="password" id="fm_pwd" name="fm_pwd" value="">
                        </div>
                    </div>
                </div>
                <div class="comment-body-wrapper">
                    <label class="blind">코멘트 입력</label>
                    <textarea id="fm_content" name="fm_content"></textarea>
                    <button type="button" id="" name="" value="" title="저장" class="btn-comment-save" onclick="CommentSendit()">
                        저장
                    </button>
                </div>
            </div>
        </div>
    </form>
    <? } ?>

    <?
    $comment_qry = "SELECT * FROM ".$configBBS[board_id]."_comment WHERE bbs_idx = '".$_SESSION["_BBS_DELETE_CONN"]."' ";
    $comment_result=DBquery($comment_qry);

    while($comment_row=mysql_fetch_array($comment_result))
    {

    $comment_name = $comment_row[name];
    $comment_date = substr($comment_row[writeday],0,10);
    $comment_content = str_replace("\n","<br>", $comment_row[content]);
    ?>
    <div class="comment-form-wrapper">
        <div class="comment-form-area">
            <div class="comment-header-wapper">
                <div class="left">
                    <p class="name">
                        <?=$comment_name?>
                    </p>
                    <p class="date">
                        <?=$comment_date?>
                    </p>
                </div>


                <div class="right">
                    <div class="small-btns">
                       <!-- <button type="button" class="reply">
                            답변
                        </button>-->
                        <button type="button" class="modify">
                            수정
                        </button>

                        <button type="button" class="delete">
                            삭제
                        </button>
                    </div>
                </div>
            </div>
            <!-- 상단 작은 버튼 클릭 시 오픈 되는 영역 -->
            <div class="comment-body-wrapper" style="display: none">
                <label class="blind">코멘트 입력</label>
                <textarea id="" name=""></textarea>
                <button type="button" id="" name="" value="" title="수정" class="btn-comment-save">
                    수정
                </button>
            </div>
            <!-- //상단 작은 버튼 클릭 시 오픈 되는 영역 -->
        </div>
        <p class="comment-information">
            <?=$comment_content?>
        </p>

    </div>

        <?
    }
    ?>

</div>