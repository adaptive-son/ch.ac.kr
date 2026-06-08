<?
//@ini_set("display_errors", 'On');
//@error_reporting(E_ALL);
?>

<h2 class="title0201"><?=$configBBS[board_name]?></h2>
<script>
    $.datepicker.setDefaults({
        dateFormat: 'yy-mm-dd',
        prevText: '이전 달',
        nextText: '다음 달',
        monthNames: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
        monthNamesShort: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
        dayNames: ['일', '월', '화', '수', '목', '금', '토'],
        dayNamesShort: ['일', '월', '화', '수', '목', '금', '토'],
        dayNamesMin: ['일', '월', '화', '수', '목', '금', '토'],
        showMonthAfterYear: true,
        changeMonth : true,
        changeYear : true,
        yearRange: "-100:+10",
        yearSuffix: '년'
    });


    $(function() {
        $(".datepicker").datepicker({
            dateFormat: 'yy-mm-dd'
        }).attr('readonly','readonly');
    });

	function write_confirm(obj) {
		if(obj.fm_title.value.length <= 0) {
			alert("제목을 입력하십시오");
			obj.fm_title.focus();
			return false;
		}
	}

	// 두 날짜의 차이를 일단위로 계산 23.06.02 KDG
	const getDateDiff = (d1, d2) => {
		const date1 = new Date(d1);
		const date2 = new Date(d2);
		const diffDate = date1.getTime() - date2.getTime();
	  
	  return Math.abs(diffDate / (1000 * 60 * 60 * 24)); // 밀리세컨 * 초 * 분 * 시 = 일
	}

</script>
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
    $write_action = "/adframe/bbs/module_wte.php";
    ?>

    <script src="https://www.google.com/recaptcha/api.js?render=6Lf87cMZAAAAACBy-xLjI3DfbrzPxEmTxV-_auiN"></script>

    <script type="text/javascript">
        $( document ).ready(function() {
            $("form[name='writeform']").append("<input type='hidden' name='g-recaptcha' id='g-recaptcha'/>");
        });
        grecaptcha.ready(function() {
            grecaptcha.execute('6Lf87cMZAAAAACBy-xLjI3DfbrzPxEmTxV-_auiN', {action: 'homepage'}).then(function(token) {
                // 토큰을 받아다가 g-recaptcha 에다가 값을 넣어줍니다.
                document.getElementById('g-recaptcha').value = token;
            });
        });
    </script>

    <form id="writeform" name="writeform" method="POST" enctype="multipart/form-data" onSubmit="return write_confirm(this)" action="<?=$write_action?>">
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
				<? if ( $SecAdmin == 1) { ?>
                <dl>
                    <dt>
                        <label for="use_notice">
                            공지사항
                        </label>
                    </dt>
                    <dd>
                        <input type="checkbox" id="use_notice" name="use_notice" value="Y"  <? if($bbs_row[notice] == "Y") echo " checked"; ?>/>
                        <input type="hidden" id="fm_notice" name="fm_notice" value="<? if($bbs_row[notice] == "Y") echo "Y"; ?>"/>
                        <label for="use_notice">
                            <strong>* 체크시 공지글로 등록됩니다. </strong>
                        </label>
                        <div class="input-period-wrapper mt15">
                            <div class="input-period-area">
                                <input type="text" id="notice_start" name="fm_notice_start" class="sdate datepicker" value="" size="15" maxlength="10" readonly="readonly" placeholder="공지시작일">
                            </div>
                            <span class="word-unit">~</span>
                            <div class="input-period-area">
                                <input type="text" id="notice_end" name="fm_notice_end" class="edate datepicker" readonly="readonly" placeholder="공지종료일">
                            </div>
                        </div>

						<script>
						$(document).on("change", "#use_notice", function() {
							if($("#use_notice").is(":checked")) {								
								$("[name=fm_notice_start]").attr("required" , true);
								$("[name=fm_notice_start]").attr("readonly" , false);
								$("[name=fm_notice_end]").attr("required" , true);
								$("[name=fm_notice_end]").attr("readonly" , false);
							} else {
								$("[name=fm_notice_start]").val('');
								$("[name=fm_notice_end]").val('');
								$("[name=fm_notice_start]").attr("required" , false);
								$("[name=fm_notice_start]").attr("readonly" , true);
								$("[name=fm_notice_end]").attr("required" , false);
								$("[name=fm_notice_end]").attr("readonly" , true);
							}
						});

						$(document).on("change", "#notice_end", function() {

							var noticeStart =  $("#notice_start").val();
							var noticeEnd = $("#notice_end").val();
							
							// 공지기간을 계산하여 30일을 넘지 못하도록 처리
							let datediff = getDateDiff(noticeStart, noticeEnd);
							if (datediff >= 30)
							{
							   console.log(datediff + "일");
							   alert("공지 기간은 30일을 초과 할 수 없습니다.");
							   $("#notice_end").focus();
							   return false;
							}
						})
						</script>

                    </dd>
                </dl>
                <?
                }
                if ( $configBBS[board_secure] == "Y" && $configBBS[origin_board_skin]!="sanhak" && $configBBS[origin_board_skin]!="course" && $configBBS[origin_board_skin]!="main_press" ) {
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
                        <label for="type">
                            카테고리
                        </label>
                    </dt>
                    <dd>
                        <select id="fm_category" name="fm_category" title="카테고리 분류">
							<option value="">카테고리를 선택하세요</option>
							<? if($configBBS[origin_board_skin]!="sanhak" && $configBBS[board_key]!="2610"){?>
							<option value="">전체</option>
							<? } ?>
                            <?=$category_list?>
                        </select>
                    </dd>
                </dl>
                <? } ?>
				<? if($BoardKey!="2610") {?>
                <dl>
                    <dt>
                        <label for="writer">
                            작성자
                        </label>
                    </dt>
                    <dd>
                        <? if($auto_bbs_input != "true"){ ?>
                        <strong><?=$auto_bbs_username?></strong>
                        <input type="hidden" id="fm_name" name="fm_name" value="<?=$auto_bbs_username?>"  />
                        <? }else{ ?>
                        <input type="text" id="fm_name" name="fm_name" value="<?=$auto_bbs_username?>" class="w30" />
                        <? } ?>
                    </dd>
                </dl>
				<? } else if($BoardKey=="2610") {?>
					<input type="hidden" name="fm_name" value="<?=$auto_bbs_username?>" class="w30" />
				<dl>
                    <dt>
                        <label for="writer">
                            부서명
                        </label>
                    </dt>
                    <dd>
                        <select id="parent" name="fm_etc_char3">
							<option value="">부서명을 선택하세요</option>
							<?
								$bbs_qry2 = "SELECT * FROM part WHERE use_yn is null or use_yn ='' ORDER BY name ASC, sort ASC";
								$bbs_result2=DBquery($bbs_qry2);
								while($bbs_row2=mysql_fetch_array($bbs_result2)) {
							?>
								<option value="<?=$bbs_row2['name'];?>" ><?=$bbs_row2['name'];?></option>
							<? } ?>
						</select>
                    </dd>
                </dl>
				<? } ?>

                <? if($auto_bbs_input != "true" && $auto_bbs_userpwd){ ?>
                    <input type="hidden" name="fm_pwd" value="<?=$auto_bbs_userpwd?>" />
                <? }else{ ?>
                <dl>
                    <dt>
                        <label for="password">
                            비밀번호
                        </label>
                    </dt>
                    <dd>
                        <? if (!(empty($bbs_row[ref])) && !empty($bbs_row[pwd])) { ?>
                            <input type="password" id="fm_pwd" name="fm_pwd" value="<?=$bbs_row[pwd]?>" class="w30" readonly="readonly" />
                        <?php } else { ?>
                            <input type="password" id="fm_pwd" name="fm_pwd" value="<?=$auto_bbs_userpwd?>" class="w30" />
                        <?php } ?>
                    </dd>
                </dl>
                <? } ?>
                <!--
                <dl>
                    <dt>
                        <label for="email">
                            이메일
                        </label>
                    </dt>
                    <dd>
                        <input type="email" id="email" name="email" value="" class="w50" />
                    </dd>
                </dl>
                -->
                <dl>
                    <dt>
                        <label for="title">
                            제목
                        </label>
                    </dt>
                    <dd>
                        <input type="text" id="fm_title" name="fm_title" value="" style="width: 95%;" />
                    </dd>
                </dl>
				<? if($configBBS[origin_board_skin]=="main_press"){?>
				<dl>
                    <dt>
                        <label for="title">
                            제목 링크
                        </label>
                    </dt>
                    <dd>
                        <input type="text" id="fm_etc_char1" name="fm_etc_char1" value="" style="width: 95%;" />
						<br><strong style="color:red;">http:// 또는 https:// 를 같이 입력해주세요.</strong>
                    </dd>
                </dl>
				<dl>
                    <dt>
                        <label for="title">
                            신문사1
                        </label>
                    </dt>
                    <dd>
                        <input type="text" id="fm_etc_char2" name="fm_etc_char2" value="" style="width: 95%;" />
                    </dd>
                </dl>
				<dl>
                    <dt>
                        <label for="title">
                            신문사1 링크
                        </label>
                    </dt>
                    <dd>
                        <input type="text" id="fm_etc_char3" name="fm_etc_char3" value="" style="width: 95%;" />
						<br><strong style="color:red;">http:// 또는 https:// 를 같이 입력해주세요.</strong>
                    </dd>
                </dl>
				<dl>
                    <dt>
                        <label for="title">
                            신문사2
                        </label>
                    </dt>
                    <dd>
                        <input type="text" id="fm_etc_char4" name="fm_etc_char4" value="" style="width: 95%;" />
                    </dd>
                </dl>
				<dl>
                    <dt>
                        <label for="title">
                            신문사2 링크
                        </label>
                    </dt>
                    <dd>
                        <input type="text" id="fm_etc_char5" name="fm_etc_char5" value="" style="width: 95%;" />
						<br><strong style="color:red;">http:// 또는 https:// 를 같이 입력해주세요.</strong>
                    </dd>
                </dl>
				<dl>
                    <dt>
                        <label for="title">
                            신문사3
                        </label>
                    </dt>
                    <dd>
                        <input type="text" id="fm_etc_char6" name="fm_etc_char6" value="" style="width: 95%;" />
                    </dd>
                </dl>
				<dl>
                    <dt>
                        <label for="title">
                            신문사3 링크
                        </label>
                    </dt>
                    <dd>
                        <input type="text" id="fm_etc_char7" name="fm_etc_char7" value="" style="width: 95%;" />
						<br><strong style="color:red;">http:// 또는 https:// 를 같이 입력해주세요.</strong>
                    </dd>
                </dl>
				<? } ?>
				<? if($configBBS[origin_board_skin]=="sanhak"){?>
				<dl>
					<dt>
						<label for="title">
							URL
						</label>
					</dt>
					<dd>
						<input type="text" id="fm_etc_char2" name="fm_etc_char2" value="" class="w30" />
					</dd>
				</dl>
				<? } ?>
				<?php if($configBBS[origin_board_skin]!="sanhak" && $configBBS[origin_board_skin]!="course") { ?>
                <dl>
                    <dt>
                        <label for="board-write-contents">
                            내용
                        </label>
                    </dt>
                    <dd>
                        <textarea name="fm_content" id="fm_content" style="display: none;"></textarea>
                        <?php if($configBBS[module_editor]!="None.php"){?>
                        <script type="text/javascript" src="/manage/js/namo_scripteditor.js"> </script>
                        <script type="text/javascript">
                            var CrossEditor = new NamoSE("Namo");
                            CrossEditor.params.Width = "100%";
                            CrossEditor.params.UserLang = "auto";
                            CrossEditor.params.FullScreen = false;
                            CrossEditor.EditorStart();
                        </script>
                        <? }?>
                        <?
                        //춘해대 특수
                        if($configBBS[module_editor]=="None.php"){
                            include ADFRAME_ROOT_PATH."/bbs/module/editor/".$configBBS[module_editor];
                        }
                         ?>
                    </dd>
                </dl>
				<? } ?>

                <? if($configBBS[origin_board_skin]!="sanhak" && $configBBS[origin_board_skin]!="course" && $configBBS[origin_board_skin]!="main_press"){?>
                    <dl>
                        <dt>
                            <label for="title">
                                유튜브 ID
                            </label>
                        </dt>
                        <dd>
                            https://youtube/<input type="text" id="fm_etc_char1" name="fm_etc_char1" value="" class="w30" />
							<p class="mt10 point-color01">
								※ https://youtube/제외한 나머지를 입력해주세요
							</p>
                        </dd>
                    </dl>

                <?}?>

				 <? include ADFRAME_ROOT_PATH."/bbs/module/uploader/".$configBBS[module_uploader]; ?>




                <?	/* 자동등록방지 코드 추가 */
                if(!$_SESSION['MEMBER_ID']){
                ?>
                <div>
                    <dl class="writer-add-file">
                        <dt style="padding-top:10px;">
                            자동등록방지
                        </dt>
                        <dd>
                            <img id='kcaptcha_image' />
                            <input class='ed' type=input size=10 id="writekey" name=writekey itemname="자동등록방지" required>&nbsp;&nbsp;왼쪽의 글자를 입력하세요.
                        </dd>
                    </dl>
                </div>
                <? } ?>

            </div>

            <div class="btns-area">
                <div class="btns-right">
                    <input type="submit" id="btnReg" value="등록" class="btns02 btns-type02 btns-2nd btns-mr" />
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

                // 공지글 5개 이상 못쓰게 설정
                <?php if($_SERVER["REMOTE_ADDR"]=="112.217.216.250"){ ?>
                    $.ajax({
                        url: "/adframe/bbs/notice.count.ajax.php",
                        data: {'boardKey' : <?=$BoardKey?> , 'board_id' : '<?=$configBBS['board_id']?>' },
                        success: function (result){
                            console.log(result);
                            result = jQuery.parseJSON($.trim(result));

                            if(result.success == 'true'){
                                if (result.notice_count >= 5) {
                                    alert("공지는 최대 5개까지만 가능합니다!\r\n다른 게시물을 공지 체크 해지 하시거나\r\n일반글로 게시하여 주시기 바랍니다.");
                                    $('#use_notice').prop("checked", false);
                                    $("#notice_start").val("");
                                    $("#notice_end").val("");
                                }
                            }
                        },
                        error: function(){
                        }
                    });
                <? }; ?>

                $('#fm_notice').val('Y');
            } else {
                $('#fm_notice').val('N');
            }
        });

        $('#btnReg').bind('click', function(){
            if ($('#use_notice').is(":checked")) {
                var noticeStart =  $("#notice_start").val();
                var noticeEnd = $("#notice_end").val();
                /*if(noticeStart=="" || noticeEnd==""){
                    alert("공지 기간을 설정하세요");
                    return false;
                }*/

				// 공지기간을 계산하여 30일을 넘지 못하도록 처리
				let datediff = getDateDiff(noticeStart, noticeEnd);
				if (datediff >= 30)
				{
				   console.log(datediff + "일");
				   alert("공지 기간은 30일을 초과 할 수 없습니다.");
				   $("#notice_end").focus();
				   return false;
				}

                if(noticeStart>noticeEnd){
                    alert("시작일이 종료일보다 클 수 없습니다.");
                    return false;
                }
            }
            <?php if($configBBS[module_editor]!="None.php"){?>
            document.getElementById('fm_content').value = CrossEditor.GetBodyValue();
            <?php }?>
            bbsSendit();
            return false;
        });
    });
</script>
