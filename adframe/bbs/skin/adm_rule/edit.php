
<h2 class="title0201"><?=$configBBS[board_name]?></h2>
<script src="/pub/_common/js/board.js"></script>
<style>

    .input-period-wrapper {
        max-width: 500px;
    }

    .input-period-wrapper:after {
        content: "";
        clear: both;
        display: block;
    }

    .input-period-wrapper .input-period-area {
        float: left;
        width: 45%;
    }

    .input-period-wrapper .word-unit {
        float: left;
        width: 10%;
        text-align: center;
    }

    .hide { display: none;}
</style>
<div class="board-area">
    <?
    $edit_action = "/adframe/bbs/module_edt.php";
    ?>

    <script type="text/javascript">
        $( document ).ready(function() {
            $("form[name='writeform']").append("<input type='hidden' name='g-recaptcha' id='g-recaptcha'/>");

			 $("#parent").change(function(){
			  var filter = $(this).val();
				 $('select#child option').each(function(){
				  if ( $(this).attr("parent") == filter) {     
					 $(this).show();
				  } else {
					 $(this).hide();
				  }
				});

				$('#child').find("option:not([hidden]):eq(0)").attr("selected","selected");
			  })

        });
        grecaptcha.ready(function() {
            grecaptcha.execute('6Lf87cMZAAAAACBy-xLjI3DfbrzPxEmTxV-_auiN', {action: 'homepage'}).then(function(token) {
                // 토큰을 받아다가 g-recaptcha 에다가 값을 넣어줍니다.
                document.getElementById('g-recaptcha').value = token;
            });
        });
    </script>
    <form id="writeform" name="writeform" method="POST" enctype="multipart/form-data" action="<?=$edit_action?>">
        <input type="hidden" name="ref" value="<?=$bbs_row[ref]?>">
        <input type="hidden" name="re_step" value="<?=$bbs_row[re_step]?>">
        <input type="hidden" name="re_level" value="<?=$bbs_row[re_level]?>">
        <input type="hidden" name="data" value="<?=$data?>">
        <input type="hidden" name="BURL" value="<?=$PHP_SELF?>">
        <input type="hidden" name="Confirm" value="define">
        <input type="hidden" name="BoardKey" value="<?=$BoardKey?>">
        <input type="hidden" id="secAdmin" name="secAdmin" value="<?=$SecAdmin?>">
        <fieldset>
            <legend class="blind">글쓰기</legend>

            <div class="board-write">
                <dl>
                    <dt>
                        <label for="writer">
                            작성자
                        </label>
                    </dt>
                    <dd>
                        <input type="text" name="fm_name" value="<?=$bbs_row[name]?>" class="w30" />
                    </dd>
                </dl>
                <dl>
                    <dt>
                        <label for="password">
                            비밀번호
                        </label>
                    </dt>
                    <dd>
                        <input type="password" id="fm_pwd" name="fm_pwd" value="<?=$bbs_row[pwd]?>" class="w30" />
                    </dd>
                </dl>
                <dl>
                    <dt>
                        <label for="title">
                            제목
                        </label>
                    </dt>
                    <dd>
                        <input type="text" id="fm_title" name="fm_title" value="<?=$bbs_row[title]?>" style="width: 95%;" />
                    </dd>
                </dl>
				<dl>
                    <dt>
                        <label for="category">
                            카테고리
                        </label>
                    </dt>
                    <dd>
                        <select id="parent" name="fm_etc_char1">
							<option value="">1차카테고리</option>
							<?
								$bbs_qry2 = "SELECT * FROM af_category WHERE DEPTH='0' ORDER BY ORDER_NO ASC";
								$bbs_result2=DBquery($bbs_qry2);
								while($bbs_row2=mysql_fetch_array($bbs_result2)) {
							?>
								<option value="<?=$bbs_row2['TREE_NO'];?>" <?if($bbs_row[etc_char1]==$bbs_row2[TREE_NO]) {?>selected="selected"<?}?> >
									<?=$bbs_row2['NAME'];?>
								</option>
							<? } ?>
						</select>
						<select id="child" name="fm_etc_char2">
							<option value="">2차카테고리</option>
							<?
								$bbs_qry3 = "SELECT * FROM af_category WHERE  DEPTH='1' ORDER BY ORDER_NO ASC";
								$bbs_result3=DBquery($bbs_qry3);
								while($bbs_row3=mysql_fetch_array($bbs_result3)) {
							?>
							<option parent="<?=$bbs_row3['PARENT'];?>" value="<?=$bbs_row3['TREE_NO'];?>" style="display: none;"<?if($bbs_row[etc_char2]==$bbs_row3[TREE_NO]) {?>selected="selected"<?}?>>
								<?=$bbs_row3['NAME'];?>
							</option>
							<? } ?>
						</select>
                    </dd>
                </dl>
				<dl>
                    <dt>
                        <label for="writer">
                            공포일자
                        </label>
                    </dt>
                    <dd>
                        <input type="text" id="fm_etc_char3" name="fm_etc_char3" value="<?=$bbs_row[etc_char3]?>"  />
                    </dd>
                </dl>
				<dl>
                    <dt>
                        <label for="writer">
                            순서
                        </label>
                    </dt>
                    <dd>		
                        <input type="text" id="fm_etc_char4" name="fm_etc_char4" value="<?=$bbs_row[etc_char4]?>"  />
                    </dd>
                </dl>
				<? if($configBBS[origin_board_skin]!="main_press"){ ?>
                <dl>
                    <dt>
                        <label for="board-write-contents">
                            내용
                        </label>
                    </dt>
                    <dd>
                        <? //include ADFRAME_ROOT_PATH."/bbs/module/editor/".$configBBS[module_editor]; ?>
                        <textarea name="fm_content" id="fm_content" style="display: none;"><?=$bbs_row[content];?></textarea>
                        <? include ADFRAME_ROOT_PATH."/bbs/module/editor/".$configBBS[module_editor]; ?>
                    </dd>
                </dl>
				<? } ?>

                <? include ADFRAME_ROOT_PATH."/bbs/module/uploader/".$configBBS[module_uploader]; ?>

            </div>

            <div class="btns-area">
                <div class="btns-right">
                    <input type="submit" id="btnReg" value="등록" class="btns02 btns-type02 btns-2nd btns-mr" onclick="javascript:bbsSendit();" />
                    <? $linkList = "$PHP_SELF?bbs=list&data=$data"; ?>
                    <a href="<?=$linkList?>" class="btns02 btns-type01 w45 btns-2nd btns-ml">
                        목록
                    </a>
                </div>
            </div>

        </fieldset>
    </form>
</div>
<script language="javascript">

    $(document).ready(function() {
        $('#use_notice').bind('click', function() {
            if ($('#use_notice').is(":checked")) {
                $('#fm_notice').val('Y');
            } else {
                $('#fm_notice').val('N');
            }
        });

        $('#btnReg').bind('click', function() {
            if($("#fm_title").val()==""){
                alert("제목을 입력하세요");
                return false;
            }
            if ($('#use_notice').is(":checked")) {
               var noticeStart =  $("#notice_start").val();
               var noticeEnd = $("#notice_end").val();
               /*if(noticeStart=="" || noticeEnd==""){
                   alert("공지 기간을 설정하세요");
                   return false;
               }*/
                if(noticeStart>noticeEnd){
                    alert("시작일이 종료일보다 클 수 없습니다.");
                    return false;
                }
            }

            document.getElementById('fm_content').value = CrossEditor.GetBodyValue();
            bbsSendit();
            return false;
        });
    });

</script>
