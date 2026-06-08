<h2 class="title0201"><?=$configBBS[board_name]?></h2>
<script src="/_common/js/board.js"></script>
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
		if (oEditors != undefined) {
			oEditors.getById["fm_content"].exec("UPDATE_CONTENTS_FIELD", []);
		}
		$('#fm_content').val( $('#fm_content').val() == '<p>&nbsp;</p>' ? '' :  $('#fm_content').val());
		var content = form.fm_content.value;
		
		if(obj.fm_title.value.length <= 0) {
			alert("제목을 입력하십시오");
			obj.fm_title.focus();
			return false;
		}else if(content==""){
			alert("내용을(를) 입력해 주십시오.");
			edt.focus();
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
    $edit_action = "/adframe/bbs/module_edt.php";
    ?>
    <form id="writeform" name="writeform" method="POST" enctype="multipart/form-data" onSubmit="return write_confirm(this)" action="<?=$edit_action?>">
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
                <?php 
				/*if ( $SecAdmin == 1  && $configBBS[origin_board_skin]!="sanhak" && $configBBS[origin_board_skin]!="course" && $configBBS[origin_board_skin]!="main_press" && $configBBS[board_key]!="2610" ) { 
				*/
				if ( $SecAdmin == 1  && $configBBS[origin_board_skin]!="sanhak" && $configBBS[origin_board_skin]!="course" && $configBBS[origin_board_skin]!="main_press" ) { ?>
                    <dl>
                        <dt>
                            <label for="use_notice">
                                공지사항
                            </label>
                        </dt>
                        <dd>
                            <input type="checkbox" id="use_notice" value="Y"  <? if($bbs_row[notice] == "Y") echo " checked"; ?>/>
                            <input type="hidden" id="fm_notice" name="fm_notice" value="<? if($bbs_row[notice] == "Y") echo "Y"; ?>"/>
                            <label for="use_notice">
                                <strong>* 체크시 공지글로 등록됩니다.. </strong>
                            </label>
                            <div class="input-period-wrapper mt15">
                                <div class="input-period-area">
                                <input type="text" id="notice_start" name="fm_notice_start" class="sdate datepicker" value="<?php echo $bbs_row[notice_start];?>" size="15" maxlength="10" readonly="readonly" placeholder="공지시작일">
								</div>
								<span class="word-unit">~</span>
								<div class="input-period-area">
								<input type="text" id="notice_end" name="fm_notice_end" class="edate datepicker" value="<?php echo $bbs_row[notice_end];?>" readonly="readonly" placeholder="공지종료일">
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
                if ( $configBBS[board_secure] == "Y"  && $configBBS[origin_board_skin]!="sanhak" && $configBBS[origin_board_skin]!="course" && $configBBS[origin_board_skin]!="main_press" ) {
                ?>
                <dl>
                    <dt>
                        <label for="view_secret">
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
							<option value="">카테고리를 선택하세요</option>
							<? if($configBBS[origin_board_skin]!="sanhak" && $configBBS[board_key]!="2610"){?>
							<option <?php if($bbs_row[category]==""){?>selected="selected"<?php } ?>>전체</option>
							<? } else if( $configBBS[board_key]=="2610" && $bbs_row[category]=="" ) {?>
							<option selected="selected">카테고리를 선택하세요</option>
							<? } ?>
                            <?=$category_list?>
                        </select>
                    </dd>
                </dl>
                <? } ?>
				<? if($BoardKey!="2610") { ?>
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
				<? } else if ($BoardKey=="2610") {?>
					<input type="hidden" name="fm_name" value="<?php echo $bbs_row[name]?$bbs_row['name']:$_SESSION['MEMBER_UNAME']?>" class="w30" />
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
								$bbs_qry2 = "SELECT * FROM part ORDER BY name ASC, sort ASC";
								$bbs_result2=DBquery($bbs_qry2);
								while($bbs_row2=mysql_fetch_array($bbs_result2)) {
							?>
								<option value="<?=$bbs_row2['name'];?>" <? if($bbs_row[etc_char3]==$bbs_row2['name']) {?>selected="selected"<? } ?> ><?=$bbs_row2['name'];?></option>
							<? } ?>
						</select>
                    </dd>
                </dl>
				<? } ?>
				<dl>
                    <dt>
                        <label for="writer">
                            작성일
                        </label>
                    </dt>
                    <dd>
                        <input type="text" name="fm_writeday" value="<?=$bbs_row['writeday']?>" class="w30" />
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
				<? if($configBBS[origin_board_skin]=="main_press"){?>
				<dl>
                    <dt>
                        <label for="title">
                            제목 링크
                        </label>
                    </dt>
                    <dd>
                        <input type="text" id="fm_etc_char1" name="fm_etc_char1" value="<?=$bbs_row[etc_char1]?>" style="width: 95%;" />
                    </dd>
                </dl>
				<dl>
                    <dt>
                        <label for="title">
                            신문사1
                        </label>
                    </dt>
                    <dd>
                        <input type="text" id="fm_etc_char2" name="fm_etc_char2" value="<?=$bbs_row[etc_char2]?>" style="width: 95%;" />
                    </dd>
                </dl>
				<dl>
                    <dt>
                        <label for="title">
                            신문사1 링크
                        </label>
                    </dt>
                    <dd>
                        <input type="text" id="fm_etc_char3" name="fm_etc_char3" value="<?=$bbs_row[etc_char3]?>" style="width: 95%;" />
                    </dd>
                </dl>
				<dl>
                    <dt>
                        <label for="title">
                            신문사2
                        </label>
                    </dt>
                    <dd>
                        <input type="text" id="fm_etc_char4" name="fm_etc_char4" value="<?=$bbs_row[etc_char4]?>" style="width: 95%;" />
                    </dd>
                </dl>
				<dl>
                    <dt>
                        <label for="title">
                            신문사2 링크
                        </label>
                    </dt>
                    <dd>
                        <input type="text" id="fm_etc_char5" name="fm_etc_char5" value="<?=$bbs_row[etc_char5]?>" style="width: 95%;" />
                    </dd>
                </dl>
				<dl>
                    <dt>
                        <label for="title">
                            신문사3
                        </label>
                    </dt>
                    <dd>
                        <input type="text" id="fm_etc_char6" name="fm_etc_char6" value="<?=$bbs_row[etc_char6]?>" style="width: 95%;" />
                    </dd>
                </dl>
				<dl>
                    <dt>
                        <label for="title">
                            신문사3 링크
                        </label>
                    </dt>
                    <dd>
                        <input type="text" id="fm_etc_char7" name="fm_etc_char7" value="<?=$bbs_row[etc_char7]?>" style="width: 95%;" />
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
						<input type="text" id="fm_etc_char2" name="fm_etc_char2" value="<?=$bbs_row[etc_char2]?>" class="w30" />
					</dd>
				</dl>
				<? } ?>
                <dl>
                    <dt>
                        <label for="board-write-contents">
                            내용
                        </label>
                    </dt>
                    <dd>
                        <?
                        //춘해대 특수
                            include ADFRAME_ROOT_PATH."/bbs/module/editor/".$configBBS[module_editor];
                         ?>
                    </dd>
                </dl>


                <? if($configBBS[origin_board_skin]!="sanhak" && $configBBS[origin_board_skin]!="course" && $configBBS[origin_board_skin]!="main_press"){?>
                    <dl>
                        <dt>
                            <label for="title">
                                유튜브 ID
                            </label>
                        </dt>
						<dd>
                            https://youtube/<input type="text" id="fm_etc_char1" name="fm_etc_char1" value="<?=$bbs_row[etc_char1]?>" class="w30"  />
							<p class="mt10 point-color01">
								※ https://youtube/제외한 나머지를 입력해주세요
							</p>
                        </dd>
                    </dl>

                <?}?>
<?php
///home/dev/pub/main/adframe/bbs/module/uploader/NormalUploader.php
?>
                <?php include ADFRAME_ROOT_PATH."/bbs/module/uploader/".$configBBS[module_uploader]; ?>

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

               if(noticeStart==""){
                   alert("공지 기간을 설정하세요");
				   $("#notice_start").focus()
                   return false;
               }
				
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

            //document.getElementById('fm_content').value = CrossEditor.GetBodyValue();
			
			<?php if($configBBS[module_editor]!="None.php"){?>
			<?php if($configBBS[module_editor]=="ckeditor.php"){?>
				pasteHTML();
			<?php }else{ ?>
            document.getElementById('fm_content').value = CrossEditor.GetBodyValue();
            <?php }}?>
            bbsSendit();
            return false;
        });
    });

	function pasteHTML() {
		CKEDITOR.instances.MinBoardContents.updateElement();
	}
</script>
<form id="img_upload_form" action="/adframe/bbs/Extention/Editor/ckeditor/img_upload.php" enctype="multipart/form-data" method="post" style="display:none;">
	<input type='file' id="img_file" multiple="multiple" name='imgfile[]' accept="image/*">
</form>
	 
<div id="ajaxImageModal" style="display:none;">
	<div id="light" style="display: table;position: absolute;top:25%;left:25%;width:50%;height:50%; text-align:center; background-color:transparent; z-index:1002;overflow: auto;">
		<div style="display: table-cell; vertical-align: middle;">
			<img src="/adframe/bbs/Extention/Editor/ckeditor/plugins/ajaximage/loading.gif" style="user-select: none; -ms-user-select: none;">
		</div>
	</div>
</div>
<?php
if($configBBS['module_editor']=="ckeditor.php"){?>
<script>
	//객체 생성
	var ajaxImage = {};
	// ckeditor textarea id
	ajaxImage["id"] = "fm_content";
	// 업로드 될 디렉토리
	ajaxImage["uploadDir"] = "/data/smartEditorUpload/";
	// 한 번에 업로드할 수 있는 이미지 최대 수
	ajaxImage["imgMaxN"] = 10;
	// 허용할 이미지 하나의 최대 크기(MB)
	ajaxImage["imgMaxSize"] = 50;
</script>
<?php } ?>