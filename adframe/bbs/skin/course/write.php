<script src="https://www.google.com/recaptcha/api.js?render=6LdDR8gUAAAAAEu64Etam_opVz38W6kbNagaiWVs"></script>
<script>
    grecaptcha.ready(function() {
        grecaptcha.execute('6LdDR8gUAAAAAEu64Etam_opVz38W6kbNagaiWVs', { action: 'contactForm' }).then(function (token) {
            $('#g-recaptcha-response').val(token);
        }, function (reason) {
            console.log(reason);
        });
    });
</script>
<div class="board-area">
	<form name="writeform" method="POST" action="/adframe/bbs/module_wte.php?TREE_NO=<?=$TREE_NO?>&DEPTH=<?=$DEPTH?>" enctype="multipart/form-data">

        <input type="hidden" name="site_id" value="<?=TREE_ID?>">
        <input type="hidden" name="ref" value="<?=$bbs_row[ref]?>">
        <input type="hidden" name="re_step" value="<?=$bbs_row[re_step]?>">
        <input type="hidden" name="re_level" value="<?=$bbs_row[re_level]?>">
		<input type="hidden" name="board_seq" value="<?=$bbs_row[board_seq]?>">
        <input type="hidden" name="data" value="<?=$data?>">
        <input type="hidden" name="BURL" value="<?=$PHP_SELF?>">
        <input type="hidden" name="Confirm" value="define">
        <input type="hidden" name="BoardKey" value="<?=$BoardKey?>">
        <input type="hidden" name="recaptcha" id="g-recaptcha-response" value="">
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
						<?
                        if($auto_bbs_input != "true"){ ?>
							<strong><?=$auto_bbs_username?></strong>
							<input type="hidden" id="fm_name" name="fm_name" value="<?=$auto_bbs_username?>"  />
						<? }else{ ?>
							<input type="text" id="fm_name" name="fm_name" value="<?=$auto_bbs_username?>" class="w30" />
						<? } ?>
					</dd>
				</dl>


				<? if($auto_bbs_input == "true" && $auto_bbs_userpwd){ ?>
					<input type="hidden" name="fm_pwd" value="<?=$auto_bbs_userpwd?>" />
				<? }else{ ?>
					<dl>
						<dt>
							<label for="password">
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
						<label for="title">
							제목
						</label>
					</dt>
					<dd>
						<input type="text" id="fm_title" name="fm_title" value="" style="width: 700px" />
					</dd>
				</dl>
				<dl>
					<dt>
						<label for="board-write-contents">
							내용
						</label>
					</dt>
					<dd>
						<? include ADFRAME_ROOT_PATH."/bbs/module/editor/".$configBBS[module_editor]; ?>
						<!--<textarea id="" name="" cols="50" rows="5"></textarea>-->
					</dd>
				</dl>

				<? include ADFRAME_ROOT_PATH."/bbs/module/uploader/".$configBBS[module_uploader]; ?>

				<div id="html_element" style=" width: 300px; margin: 0 auto"></div>

			</div>

			<div class="btns-area">
					<a href="<?=$PHP_SELF?>?site_id=<?=TREE_ID?>&TREE_NO=<?=$TREE_NO?>&DEPTH=<?=$DEPTH?>&bbs=list&data=<?=$data?>" class="btn-m02 btns-color04 depth2">
                        목록
                    </a>
                    <input type="button" value="작성" class="btn-m02 btns-color01 depth2" onclick="javascript:bbsSendit();"/>
            </div>

		</fieldset>
	</form>
</div>