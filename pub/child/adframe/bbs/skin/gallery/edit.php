<div class="board-area">
	<form name="writeform" method="POST" action="/adframe/bbs/module_edt.php?TREE_NO=<?=$TREE_NO?>&DEPTH=<?=$DEPTH?>" enctype="multipart/form-data">
        <input type="hidden" name="site_id" value="<?=urlencode($_GET['site_id'])?>">
		<input type="hidden" name="data" value="<?=$data?>">
		<input type="hidden" name="BURL" value="<?=$PHP_SELF?>">
		<input type="hidden" name="Confirm" value="define">

		<fieldset>
			<legend class="blind">글쓰기</legend>

			<div class="board-write">

				<? if($SecAdmin == 1 ) { ?>
					<dl>
						<dt>
							<label for="use_notice">
								공지사항
							</label>
						</dt>
						<dd>
                            <div class="checked-notice">
                                <input type="checkbox" id="use_notice" name="fm_notice" value="use_notice" value="Y" <? if($bbs_row[notice] == "Y") echo " checked"; ?> />
                                <label for="use_notice">
                                    공지여부 선택
                                </label>
                            </div>
                            <div class="input-period-wrapper">
                                <div class="input-period-area">
                                    <input type="text" id="notice_start" name="fm_notice_start" class="sdate datepicker" value="<?=$bbs_row[notice_start]?>" size="15" maxlength="10" readonly="readonly">
                                </div>
                                <span class="word-unit">~</span>
                                <div class="input-period-area">
                                    <input type="text" id="notice_end" name="fm_notice_end" class="edate datepicker" value="<?=$bbs_row[notice_end]?>" readonly="readonly">
                                </div>
                            </div>
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
					</dl>
					-->

				<? } ?>
                <?
                if ( $configBBS[board_secure] == "Y" ) {
                    ?>
                    <dl>
                        <dt>
                            <label for="use_notice">
                                비밀글
                            </label>
                        </dt>
                        <dd>
                            <input type="checkbox" id="view_secret" name="view_secret" value="Y" <?if($bbs_row[view_secret] == "Y"){?>checked<?}?>/>
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
                            <label for="type">
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
						<label for="writer">
							작성자
						</label>
					</dt>
					<dd>
						<input type="text" id="fm_name" name="fm_name" value="<?=$bbs_row[name]?>" class="w30" readonly/>
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
                            <input type="password" id="fm_pwd" name="fm_pwd" value="" class="w30" />
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
						<input type="text" id="fm_title" name="fm_title" value="<?=$bbs_row[title]?>" style="width: 700px" />
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
				<?
					if($configBBS[board_secure]=="N") {
				?>
				<dl>
					<dt>
						<label for="title">
							유튜브 ID
						</label>
					</dt>
					<dd>
						<input type="text" id="fm_etc_char1" name="fm_etc_char1" value="<?=$bbs_row[etc_char1]?>" class="w30"  /><br>
						<p class="mb10 point-color01">
							※ https://youtu.be/를 제외한 나머지를 입력해주세요.
						</p>
					</dd>
				</dl>
				<? } ?>

				<? include ADFRAME_ROOT_PATH."/bbs/module/uploader/".$configBBS[module_uploader]; ?>

			</div>

			<div class="btns-area">
                <div class="btns-area">
                    <a href="<?=$PHP_SELF?>?site_id=<?=TREE_ID?>&TREE_NO=<?=$TREE_NO?>&DEPTH=<?=$DEPTH?>&bbs=list&data=<?=$data?>" class="btn-m02 btns-color04 depth2">
                        목록
                    </a>
                    <input type="button" value="작성" class="btn-m02 btns-color01 depth2" onclick="javascript:bbsSendit();"/>
                </div>
			</div>

		</fieldset>
	</form>
</div>
