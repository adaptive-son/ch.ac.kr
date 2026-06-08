<SCRIPT LANGUAGE="JavaScript">
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
</SCRIPT>
<table width="<?=$configBBS[board_width]?>" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td>

            <? if($_BBS_commented == "OK") { ?>
                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <form name="commentform" method="post" action="/bbs/module_wte.php">
                        <input type="hidden" name="data" value="<?=$data?>">
                        <input type="hidden" name="BURL" value="<?=$PHP_SELF?>">
                        <input type="hidden" name="Confirm" value="Comment">
                        <tr>
                            <td height="28" class="bbs01_border_bottom">&nbsp;</td>
                        </tr>
                        <tr>
                            <td align="left" bgcolor="#f9f9f9" class="bbs01_border_bottom" style="padding:5px 0;">
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td width="80" align="center"><img src="/bbs/skin/<?=$configBBS[board_skin]?>/images/comment_nametxt.gif" alt="댓글이름" width="36" height="11"></td>
                                        <td width="120"><input type="text" name="fm_name" value="" class="bbs_reply02"></td>
                                        <td width="80" align="center"><img src="/bbs/skin/<?=$configBBS[board_skin]?>/images/comment_pwtxt.gif" alt="댓글비밀번호" width="37" height="10"></td>
                                        <td><input type="password" name="fm_pwd" value="" class="bbs_reply02"></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td align="left" bgcolor="#f9f9f9" class="bbs01_border_bottom" style="padding:10px 0;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td width="80" align="center"><img src="/bbs/skin/<?=$configBBS[board_skin]?>/images/comment_txt.gif" alt="댓글쓰기" width="36" height="11"></td>
                                        <td><textarea name="fm_content" id="fm_content" cols="45" rows="5" value="" class="bbs_reply01"></textarea></td>
                                        <td width="4"></td>
                                        <td width="100"><a href="javascript:CommentSendit()"><img src="/bbs/skin/<?=$configBBS[board_skin]?>/images/btn_comment.gif" alt="댓글등록" ></a></td>
                                    </tr>
                                </table></td>
                        </tr>
                        <tr>
                            <td height="17"></td>
                        </tr>
                    </form>
                </table>
            <? } ?>

            <table width="100%" border="0" cellpadding="1" cellspacing="1">

                <?
                $comment_qry = "SELECT * FROM ".$configBBS[board_id]."_comment WHERE bbs_idx = '".$_SESSION["_BBS_DELETE_CONN"]."' ";
                $comment_result=DBquery($comment_qry);

                while($comment_row=mysql_fetch_array($comment_result))
                {

                    $comment_name = $comment_row[name];
                    $comment_date = substr($comment_row[writeday],0,10);
                    $comment_content = str_replace("\n","<br>", $comment_row[content]);
                    ?>
                    <tr>
                        <td><table width="100%" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td height="28" bgcolor="f9f9f9" class="bbs01_reply_title"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td><strong><?=$comment_name?> </strong> <?=$comment_date?></td>
                                                <td width="100" align="right"><a href="#" class="reply">답변</a> | <a href="#" class="reply">삭제</a></td>
                                            </tr>
                                        </table></td>
                                </tr>
                                <tr>
                                    <td bgcolor="#FFFFFF" class="bbs01_reply_txt">
                                        <?=$comment_content?>
                                    </td>
                                </tr>
                            </table></td>
                    </tr>
                    <?
                }
                ?>
                <!--
        <tr>
          <td><table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td height="28" bgcolor="f9f9f9" class="bbs01_reply_title"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td><strong>내가제일잘나가 </strong> 2011-08-15</td>
                    <td width="100" align="right"><a href="#" class="reply">답변</a> | <a href="#" class="reply">삭제</a></td>
                  </tr>
              </table></td>
            </tr>
            <tr>
              <td bgcolor="#FFFFFF" class="bbs01_reply_txt">총장보다 연봉많은 부총장을 모십니다 교수와 직원이 하나되는 연수회 개최 한국국제대-세계미래포럼 MOU
                방사선학과, 직원상조회 자연사랑 앞장 음악학과, 그랜드 피아노 페스티벌 성료 한국국제대, 부분 보직인사 단</td>
            </tr>
          </table></td>
        </tr>

        <tr>
          <td align="left" class="bbs01_sreply_title"><table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td width="30"></td>
                <td width="19"><img src="/bbs/skin/<?=$configBBS[board_skin]?>/images/reply_icon.png" alt="댓글등록" width="11" height="11"></td>
                <td height="30"><strong>내가제일잘나가 </strong> 2011-08-15</td>
                <td width="100" align="right"><a href="#" class="reply">답변</a> | <a href="#" class="reply">삭제</a></td>
              </tr>
              <tr>
                <td></td>
                <td colspan="2">내가 제일 잘먹어</td>
              </tr>
          </table></td>
        </tr>
        <tr>
          <td height="5"></td>
        </tr>


        <tr>
          <td><table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td height="28" bgcolor="f9f9f9" class="bbs01_reply_title"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td><strong>내가제일잘나가 </strong> 2011-08-15</td>
                    <td width="100" align="right"><a href="#" class="reply">답변</a> | <a href="#" class="reply">삭제</a></td>
                  </tr>
              </table></td>
            </tr>
            <tr>
              <td bgcolor="#FFFFFF" class="bbs01_reply_txt">총장보다 연봉많은 부총장을 모십니다 교수와 직원이 하나되는 연수회 개최 한국국제대-세계미래포럼 MOU
                방사선학과, 직원상조회 자연사랑 앞장 음악학과, 그랜드 피아노 페스티벌 성료 한국국제대, 부분 보직인사 단</td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td><table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td height="28" bgcolor="f9f9f9" class="bbs01_reply_title"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td><strong>내가제일잘나가 </strong> 2011-08-15</td>
                    <td width="100" align="right"><a href="#" class="reply">답변</a> | <a href="#" class="reply">삭제</a></td>
                  </tr>
              </table></td>
            </tr>
            <tr>
              <td bgcolor="#FFFFFF" class="bbs01_reply_txt">총장보다 연봉많은 부총장을 모십니다 교수와 직원이 하나되는 연수회 개최 한국국제대-세계미래포럼 MOU
                방사선학과, 직원상조회 자연사랑 앞장 음악학과, 그랜드 피아노 페스티벌 성료 한국국제대, 부분 보직인사 단</td>
            </tr>
          </table></td>
        </tr>
        -->
            </table>


        </td>
    </tr>
</table>