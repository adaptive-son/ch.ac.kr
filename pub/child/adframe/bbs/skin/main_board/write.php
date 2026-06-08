<!-- 2023.03.06 추가작업 타이틀에 상세보기 문구 추가 -->
<script>
	$(function() {
		if($(".tabmenu-wrapper").css("display") == "block") {
			var tempTabmenuTitile = $(".tabmenu-wrapper ul li.active a").text();
			$("#title").prepend("글작성 &lt; " + tempTabmenuTitile + " &lt; ");
		} else {
			$("#title").prepend("글작성 &lt; ");
		}
	});
</script>
<!-- //2023.03.06 추가작업 -->

<div class="board-area">
	<form name="writeform" method="POST" action="/adframe/bbs/module_wte.php?site_id=<?=TREE_ID?>&TREE_NO=<?=$TREE_NO?>&DEPTH=<?=$DEPTH?>" enctype="multipart/form-data">

        <input type="hidden" name="site_id" value="<?=TREE_ID?>">
        <input type="hidden" name="ref" value="<?=$bbs_row[ref]?>">
        <input type="hidden" name="re_step" value="<?=$bbs_row[re_step]?>">
        <input type="hidden" name="re_level" value="<?=$bbs_row[re_level]?>">
        <input type="hidden" name="data" value="<?=$data?>">
        <input type="hidden" name="BURL" value="<?=$PHP_SELF?>">
        <input type="hidden" name="Confirm" value="define">
        <input type="hidden" name="BoardKey" value="<?=$BoardKey?>">
		<fieldset>
			<legend class="blind">글쓰기</legend>

			<div class="board-write">

				<? if($SecAdmin == 1 && $configBBS[board_key] != "2617" && $configBBS[board_key] != "2629" ) { ?>
					<dl>
						<dt>
							<label>
								공지사항
							</label>
						</dt>
						<dd>
                            <div class="checked-notice">
                                <input type="checkbox" id="use_notice" name="fm_notice" value="Y"/>
                                <label for="use_notice">
                                    공지여부 선택
                                </label>
                            </div>
                            <div class="input-period-wrapper">
                                <div class="input-period-area">
                                    <input type="text" id="notice_start" name="fm_notice_start" class="sdate datepicker" value="" size="15" maxlength="10" readonly="readonly" title="공지사항 개시 시작">
                                </div>
                                <span class="word-unit">~</span>
                                <div class="input-period-area">
                                    <input type="text" id="notice_end" name="fm_notice_end" class="edate datepicker" readonly="readonly" title="공지사항 개시 마감">
                                </div>
                            </div>
						</dd>
					</dl>
				<? } ?>
                <?
                if ( $configBBS[board_secure] == "Y" ) {
                    ?>
                    <dl>
                        <dt>
                            <label for="view_secret">
                                비밀글
                            </label>
                        </dt>
                        <dd>
                            <input type="checkbox" id="view_secret" name="view_secret" value="Y" <?if($bbs_row[view_secret] == "Y"){?>checked disabled<?}?>/>
                            <input type="hidden" id="secret" name="secret" value="<?=$bbs_row[view_secret]?>">
                            <label for="view_secret">
                                <strong>* 체크시 비밀글로 등록됩니다. </strong>
                            </label>
                        </dd>
                    </dl>
                    <?
                }
                if ( count($board_category) > 0 ) {
                    ?>
                    <dl>
                        <dt>
                            <label for="fm_category">
                                카테고리
                            </label>
                        </dt>
                        <dd>
                            <select id="fm_category" name="fm_category" title="카테고리 분류">
                                <?=$category_list?>
                            </select>
                        </dd>
                    </dl>
                <? } ?>
				<dl>
					<dt>
						<label for="fm_name">
							작성자
						</label>
					</dt>
					<dd>
						<?
                        if($auto_bbs_input != "true"){ ?>
							<strong><?=$auto_bbs_username?></strong>
							<input type="hidden" id="fm_name" name="fm_name" value="<?=$auto_bbs_username?>"  />
						<? }else{ ?>
							<input type="text" id="fm_name" name="fm_name" value="<?=$auto_bbs_username?>" class="w30" />
						<? } ?>
					</dd>
				</dl>
                <!--
				<dl>
						<dt>
							<label for="writeday">
								작성일
							</label>
						</dt>
						<dd>
							<input type="text" id="writeday" name="writeday" value="<?=$bbs_row[writeday]?>" class="w30" />
						</dd>
					</dl>-->


				<? if($auto_bbs_input == "true" && $auto_bbs_userpwd){ ?>
					<input type="hidden" name="fm_pwd" value="<?=$auto_bbs_userpwd?>" />
				<? }else{ ?>
					<dl>
						<dt>
							<label for="fm_pwd">
								비밀번호
							</label>
						</dt>
						<dd>
							<input type="password" id="fm_pwd" name="fm_pwd" value="<?=$auto_bbs_userpwd?>" class="w30"  minlength="4"/>
						</dd>
					</dl>
				<? } ?>
				<dl>
					<dt>
						<label for="fm_title">
							제목
						</label>
					</dt>
					<dd>
						<input type="text" id="fm_title" name="fm_title" value="" />
					</dd>
				</dl>

                <? if($bbs_row){ //답변시?>
                <dl>

                    <dt>
                        <label for="board-write-contents">
                            원본 글 내용
                        </label>
                    </dt>
                    <dd>
                    <?
                    $content = $bbs_row[content];
                    if (strpos($content, "adframe/bbs/") === false) {
                        $content = str_replace("bbs/", "adframe/bbs/", $content);
                    }
                    $content = preg_replace("/(\<img )([^\>]*)(\>)/i", "\\1 name='target_resize_image[]'  \\2 \\3", $content);
                    echo stripslashes(htmlspecialchars_decode($content));
                    ?>
                    </dd>
                </dl>
                <? } ?>
				<dl>
					<dt>
						<label for="fm_content">
							내용
						</label>
					</dt>
					<dd style="display: block">

						<?php if($configBBS[module_editor]!="None.php"){?>

							<p class="point-color03 pb10 pt20">
								크로스에디터 영역 - 편집영역 다음탭 : Esc, 편집영역 이전탭 : Shift+Esc
							</p>     
						
							<!--
							<textarea name="fm_content" id="fm_content" style="display: none;"></textarea>
							-->
                        <script type="text/javascript" src="/manage/js/namo_scripteditor.js"> </script>
                        <script type="text/javascript">
                            var CrossEditor = new NamoSE("Namo");
                            CrossEditor.params.Width = "100%";
                            CrossEditor.params.UserLang = "auto";
                            CrossEditor.params.FullScreen = false;
                            CrossEditor.EditorStart();
                        </script>
                        <? }else{?>
<textarea name="fm_content" id="fm_content" style="width:100%;height:250px"></textarea>
							<?}?>
					</dd>
				</dl>

				<? include ADFRAME_ROOT_PATH."/bbs/module/uploader/".$configBBS[module_uploader]; ?>

				<div id="html_element" style="width: 300px; margin: 0 auto"></div>

			</div>

			<div class="btns-area">
					<a href="<?=$PHP_SELF?>?site_id=<?=TREE_ID?>&TREE_NO=<?=$TREE_NO?>&DEPTH=<?=$DEPTH?>&bbs=list&data=<?=$data?>" class="btn-m02 btns-color04 depth2">
                        목록
                    </a>
                   <input type="button" value="작성" class="btn-m02 btns-color01 depth2" onclick="javascript:bbsSendit();"/>
               <!--     <input type="submit" id="btnReg" value="등록" class="btn-m02 btns-color01 depth2" />-->
            </div>

		</fieldset>
	</form>
</div>