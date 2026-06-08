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
        yearRange: "-100:+0",
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
								<option value="<?=$bbs_row2['TREE_NO'];?>" ><?=$bbs_row2['NAME'];?></option>
							<? } ?>
						</select>
						<select id="child" name="fm_etc_char2">
							<option value="">2차카테고리</option>
							<?
								$bbs_qry3 = "SELECT * FROM af_category WHERE  DEPTH='1' ORDER BY ORDER_NO ASC";
								$bbs_result3=DBquery($bbs_qry3);
								while($bbs_row3=mysql_fetch_array($bbs_result3)) {
							?>
							<option parent="<?=$bbs_row3['PARENT'];?>" value="<?=$bbs_row3['TREE_NO'];?>" style="display: none;"><?=$bbs_row3['NAME'];?></option>
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
                        <input type="text" id="fm_etc_char3" name="fm_etc_char3" value=""  />
                    </dd>
                </dl>
				<dl>
                    <dt>
                        <label for="writer">
                            순서
                        </label>
                    </dt>
                    <dd>
                        <input type="text" id="fm_etc_char4" name="fm_etc_char4" value=""  />
                    </dd>
                </dl>
                <dl>
                    <dt>
                        <label for="board-write-contents">
                            내용
                        </label>
                    </dt>
                    <dd>
                        <textarea name="fm_content" id="fm_content" style="display: none;"></textarea>

                        <? include ADFRAME_ROOT_PATH."/bbs/module/editor/".$configBBS[module_editor]; ?>
                    </dd>
                </dl>


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
