<? include "../_common.php" ?>
<? include_once("../include/header.bootstrap.php");?>

<?

if($no != "") {
    $sql = " select * from ".TABLE_POPUP." where no = '$no' ";
    $view = mysql_fetch_array(mysql_query($sql));

    //$view[contents] = str_replace("\\","",$view[contents]);

    $bbs_row[content] = $view[contents];

}
?>
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
            yearSuffix: '년'
        });


        $(function() {
            $("#gigan1, #gigan2").datepicker({
                dateFormat: 'yy-mm-dd'
            }).attr('readonly','readonly');
        });
        /* datepicker */

        function bbsSendit()
        {
            var form=document.writeform;

            //var content = form.Wec.MIMEValue;
            //form.fm_content.value = content;

            if(form.title.value == ""){
                alert("제목을 입력하세요.");
                return false;
            }

            if(form.link_url.value == ""){
                alert("링크 URL을 입력하세요.");
                return false;
            }
            return true;

        }

    </script>


    <div class="page-header">
        <h1>팝업관리 <!--<small>메인 페이지 배너 이미지 등록/수정</small>--></h1>
    </div>
    <div class="container-fluid">
        <form name="writeform" method="post" action="./popup.proc.php"; enctype="multipart/form-data" onSubmit="return bbsSendit();">
            <input type="hidden" name="no" value="<?=$no?>">
            <input type="hidden" name="w" value="<?=$w?>">

            <!-- 첨부 파일 원래 파일명 -->
            <input type="hidden" name="orgFileName" id="orgFileName" value="<?= $view[org_popup_name]?>">


            <div class="row-fluid">
                <!-- contents div -->
                <!-- block -->
                <div class="block">
                    <div class="navbar navbar-inner block-header">
                        <div class="muted pull-left">입력 정보</div>
                    </div>
                    <div class="block-content collapse in">
                        <div class="span12">
                            <form class="form-horizontal">
                                <fieldset>
                                    <? if( $view['popup_name'] != "" ){?>
                                        <div class="control-group">
                                            <label class="control-label" for="typeahead">팝업 이미지</label>
                                            <div class="controls">

                                                <img src="<?=POPUP_LOAD_PATH.'/'.$view['popup_name']?>" />

                                            </div>
                                        </div>
                                    <?} ?>
                                    <div class="control-group">
                                        <label class="control-label" for="typeahead">팝업 제목</label>
                                        <div class="controls">
                                            <input type="text" class="span6" id="title" name="title" value="<?= $view['title'] ?>" >
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" for="typeahead">팝업 내용 <span style="color:cornflowerblue;"> ( 내용을 간단히 적어주시기 바랍니다. ) </span> </label>
                                        <div class="controls">
                                            <textarea id="fm_content" name="fm_content" class="span8" rows="4"><?=htmlspecialchars_decode(stripslashes($view['contents']))?></textarea>
                                            <!--<input type="text" class="span8" id="fm_contents" name="fm_contents" value="<?= $view['contents'] ?>" >-->
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" for="typeahead">팝업 기간</label>
                                        <div class="controls">
                                            <p>
                                                <input type="text" class="span2" id="gigan1" name="gigan1" value="<?= $view['gigan1'] ?>">
                                                ~
                                                <input type="text" class="span2" id="gigan2" name="gigan2" value="<?= $view['gigan2'] ?>">
                                            </p>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" for="typeahead">팝업 좌표 설정&nbsp;&nbsp;<span style="color:cornflowerblue;">(페이지 좌측,상단부터 팝업이미지 까지의 거리 설정 - 숫자만 입력가능합니다.)</span></label>
                                        <div class="controls">
                                            <span>좌측 :&nbsp;&nbsp;</span>
                                            <input type="text" class="span1" id="pop_left" name="pop_left" value="<?= $view[pop_left] ?>" onkeydown='return onlyNumber(event)' onkeyup='removeChar(event)' style='ime-mode:disabled;'>px&nbsp;&nbsp;
                                            <span>상단 :&nbsp;&nbsp;</span>
                                            <input type="text" class="span1" id="pop_top" name="pop_top" value="<?= $view[pop_top] ?>" onkeydown='return onlyNumber(event)' onkeyup='removeChar(event)' style='ime-mode:disabled;'>px
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <div class="controls">
                                            <p> 팝업사용 유무 </p>
                                            <? $exp_view_useyn = explode("|", $view[useyn]); ?>
                                            <span style="margin: 5px 20px 5px 0px;">
										        <label for="useyn1" style="display: inline-block; vertical-align: top;"> 사용 </label>
										        <input type="checkbox" class="" id="useyn1" name="useyn_PC" value="Y" <?if($exp_view_useyn[0] == "Y") echo "checked"; ?> >
									            </span>
                                            <!--
                                            <span style="margin: 5px 0px;">
										    <label for="useyn2" style="display: inline-block; vertical-align: top;"> Mobile </label>
										    <input type="checkbox" class="" id="useyn2" name="useyn_MB" value="Y" <?if($exp_view_useyn[1] == "Y") echo "checked"; ?> >
									        </span>-->
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" for="typeahead"> 링크 URL </label>
                                        <div class="controls">
                                            <input type="text" class="span6" id="link_url" name="link_url" value="<?=$view[link_url]?>" >
                                        </div>
                                        <div class="controls">
									<span style="margin: 5px 0px;">
										<label for="use_map" style="display: inline-block; vertical-align: top;">
											** 영역선택 링크 별도 사용
											<span style="color:cornflowerblue;"> ( 영역태그만 입력해주세요. ) </span>
										</label>
										<input type="checkbox" id="use_map" name="use_map" value="Y" <? if ( $view[use_map] == "Y" ) echo "checked"; ?> >
									</span>
                                        </div>
                                        <div class="controls" id="div-map" <? if ( $view[use_map] != "Y" ) { ?> style="display: none;" <? } ?> >
                                            <textarea id="map_contents" name="map_contents" class="span8" rows="4"><?=htmlspecialchars_decode(stripslashes($view['map_contents']))?></textarea>
                                        </div>
                                        <!--
                                        <label class="control-label" for="typeahead"> 모바일 링크 URL </label>
                                        <div class="controls">
                                            <input type="text" class="span6" id="link_url_mobile" name="link_url_mobile" value="<?=$view[link_url_mobile]?>" <? if ( $exp_view_useyn[1] != "Y" ) echo "disabled"; ?>>
                                        </div>-->
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" for="select01">링크 타겟</label>
                                        <div class="controls">
                                            <select id="select01" name="target" class="chzn-select">
                                                <option value="_blank" <? if($view[target] == "_blank"){ echo " selected "; } ?> >새창</option>
                                                <option value="" <? if($view[target] == ""){ echo " selected "; } ?> >현재창</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" for="fileInput">팝업 이미지 등록</label>
                                        <?php if ( $view[org_popup_name] && $w ) { ?>
                                            <div class="controls">
                                                첨부파일 : <?= $view[org_popup_name]; ?>
                                            </div>
                                        <?php } ?>
                                        <div class="controls">
                                            <input class="input-file uniform_on" id="fileInput" name="b_file" type="file">
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-primary">확인</button>
                                        <input type="button" class="btn" onclick="javascript:history.back();" value="목록"/>
                                    </div>
                                </fieldset>
                            </form>

                        </div>
                    </div>
                </div>
                <!-- /block -->
            </div>
        </form>
    </div>

    <script language="javascript">

        $(document).ready(function() {
            $("#use_map").click(function() {
                $("#div-map").toggle();
            });
            $("#useyn2").click(function() {
                if ( $(this).is(":checked") ) {
                    $("#link_url_mobile").attr("disabled", false);
                } else {
                    $("#link_url_mobile").attr("disabled", true);
                }
            });
        });


        function onlyNumber(event){
            event = event || window.event;
            var keyID = (event.which) ? event.which : event.keyCode;
            if ( (keyID >= 48 && keyID <= 57) || (keyID >= 96 && keyID <= 105) || keyID == 8 || keyID == 46 || keyID == 37 || keyID == 39 )
                return;
            else
                return false;
        }
        function removeChar(event) {
            event = event || window.event;
            var keyID = (event.which) ? event.which : event.keyCode;
            if ( keyID == '8' || keyID == '46' || keyID == '37' || keyID == '39' || keyID == '2E' ) {
                return;
            } else {
                event.target.value = event.target.value.replace(/[^0-9]/g, "");
            }
        }

        /*
         $(document).ready(function() {
         $('#btnDelete').bind('click', function() {
         if (confirm("첨부파일을 삭제하시겠습니까?")) {
         var orgFileName = $('#orgFileName').val();
         }
         });
         });
         */



    </script>


<? //include_once("../footer.admin.php"); ?>