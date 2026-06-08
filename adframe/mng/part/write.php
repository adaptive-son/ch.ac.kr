<?
include "../_common.php";
include_once("../include/header.bootstrap.php");

if ( $p_num != "" ) {
    $sql = " select * from ".TABLE_PART." where p_num = '$p_num' ";
    $view = $adb->getRow($sql);
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

        function bbsSendit() {
            var form = document.writeform;
            /*  // 사용하지 않음
            var content = form.Wec.MIMEValue;
            form.fm_content.value = content;
            */
            if(form.name.value == ""){
                alert("부서명을 입력하세요.");
                return false;
            }
        }
        $(document).ready(function() {
            $("#select00").on("change", function() {
                var _thisVal = $(this).val();
                if ( _thisVal > 3 && _thisVal < 7 ) {
                    $(".forMobile").hide();
                } else {
                    $(".forMobile").show();
                }
            });
            $("#select00").trigger("change");
        });
    </script>

    <div class="page-header">
        <h2 class="title0201">공지사항 부서 관리 </h2>
    </div>
    <div class="container-fluid">
        <form name="writeform" method="post" action="./proc.php"; enctype="multipart/form-data">
            <input type="hidden" name="p_num" value="<?=$p_num?>">
            <input type="hidden" name="w" value="<?=$w?>">
            <!-- 첨부 파일 원래 파일명 -->

            <div class="row-fluid">
                <!-- contents div -->
                <!-- block -->
                <div class="block">
                    <div class="navbar navbar-inner block-header">
                        <div class="muted pull-left">입력 정보</div>
                    </div>
                    <div class="block-content collapse in">
                        <div class="span12">
                            <fieldset>
                                <div class="control-group">
                                    <label class="control-label" for="typeahead">부서명</label>
                                    <div class="controls">
										<input type="text" class="span6" id="name" name="name" value="<?= $view['name'] ?>" >
                                    </div>
                                </div>
								<div class="control-group">
                                    <label class="control-label" for="typeahead">순서</label>
                                    <div class="controls">
										<input type="text" class="span6" id="sort" name="sort" value="<?= $view['sort'] ?>" >
                                    </div>
                                </div>

                                <div class="form-actions">
                                    <button type="submit" class="btn btn-primary">확인</button>
                                    <input type="button" class="btn" onclick="javascript:history.back();" value="목록"/>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                </div>
                <!-- /block -->
            </div>
        </form>
    </div>

<? include_once("../include/__footer.php"); ?>s