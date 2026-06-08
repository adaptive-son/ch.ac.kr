<?
include "../_common.php";
include_once("../include/header.bootstrap.php");

if ( $no != "" ) {
    $sql = " select * from ".TABLE_BANNER." where no = '$no' ";
    $view = $adb->getRow($sql);
    //$bbs_row[content] = $view[contents];  // 사용하지 않음
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
            if(form.title.value == ""){
                alert("제목을 입력하세요.");
                return false;
            }
			if(form.link_url.value == ""){
                alert("링크 URL을 입력하세요.");
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
        <h2 class="title0201">배너관리 </h2>
    </div>
    <div class="container-fluid">
        <form name="writeform" method="post" action="./proc.php"; enctype="multipart/form-data">
            <input type="hidden" name="no" value="<?=$no?>">
            <input type="hidden" name="w" value="<?=$w?>">
            <!-- 첨부 파일 원래 파일명 -->
            <input type="hidden" name="orgFileName" id="orgFileName" value="<?= $view[org_banner_name]?>">

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
                                <!--<div class="control-group">
                                    <label class="control-label" for="typeahead">배너 위치</label>
                                    <div class="controls">
                                        <select id="select00" class="span6" name="location" class="chzn-select">
                                            <?
                                            $arr_selectLocation = array("메인배너", "서브메인배너(좌)", "서브메인배너(우)", "하단배너(좌)", "하단배너1(우)", "하단배너2(우)");
                                            foreach ( $arr_selectLocation as $k => $v ) {
                                                $location_keyVal = $k+1;
                                            ?>
                                            <option value="<?=$location_keyVal?>" <? if ( $location_keyVal == $view[location] ) echo "selected"; ?>> <?=$v?> </option>
                                            <? } ?>
                                        </select>
                                    </div>
                                </div>-->
                                <div class="control-group">
                                    <label class="control-label" for="typeahead">배너 사용여부</label>
                                    <div class="controls">
                                        <select id="select02" class="span6" name="useyn" class="chzn-select">
                                            <?
                                            $arr_selectUse = array("Y"=>"사용", "N"=>"사용하지않음");
                                            foreach ( $arr_selectUse as $k => $v ) {
                                                ?>
                                                <option value="<?=$k?>" <? if ( $k == $view[useyn] ) echo "selected"; ?>> <?=$v?> </option>
                                            <? } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="typeahead">배너 제목</label>
                                    <div class="controls">
                                        <input type="text" class="span6" id="title" name="title" value="<?= $view['title'] ?>" >
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="typeahead">배너 기간</label>
                                    <div class="controls">
                                        <p>
                                            <input type="text" class="span2" id="gigan1" name="gigan1" value="<?= $view['gigan1'] ?>">
                                            ~
                                            <input type="text" class="span2" id="gigan2" name="gigan2" value="<?= $view['gigan2'] ?>">
                                        </p>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="typeahead">링크 URL</label>
                                    <div class="controls">
                                        <input type="text" class="span6" id="link_url" name="link_url" value="<?= $view[link_url] ?>" >
                                    </div>
                                </div>
                                <!--
                                <div class="control-group forMobile">
                                    <label class="control-label" for="typeahead">링크 URL (모바일용)</label>
                                    <div class="controls">
                                        <input type="text" class="span6" id="link_url2" name="link_url2" value="<?= $view[link_url2] ?>" >
                                    </div>
                                </div>-->

                                <div class="control-group">
                                    <label class="control-label" for="select01">링크 타겟</label>
                                    <div class="controls">
                                        <select id="select01" name="target" class="chzn-select">
                                            <?
                                            $arr_selectTarget = array("새창으로 열기"=>"_blank", "현재창에서 열기"=>"");
                                            foreach ( $arr_selectTarget as $k => $v ) {
                                            ?>
                                            <option value="<?=$v?>" <? if ( $view[target] == $v ) echo "selected"; ?>> <?=$k?> </option>
                                            <? } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="fileInput">배너 이미지 등록</label>
                                    <?php if ( $view[org_banner_name] && $w ) { ?>
                                    <div class="controls">
                                        첨부파일 : <a href="/data/banner/<?= $view[banner_name];?>" target="_blank"><img src="/data/banner/<?= $view[banner_name];?>" height="30" width="100"></a><?= $view[org_banner_name];?>
                                    </div>
                                    <?php } ?>
                                    <div class="controls">
                                        <input class="input-file uniform_on span6" id="fileInput" name="b_file" type="file">
                                    </div>
                                </div>
                                <!--
                                <div class="control-group forMobile">
                                    <label class="control-label" for="fileInput2">배너 이미지 등록 (모바일용)</label>
                                    <?php if ( $view[org_banner_name2] && $w ) { ?>
                                        <div class="controls">
                                            첨부파일 : <a href="/data/banner/<?= $view[banner_name2];?>" target="_blank"><img src="/data/banner/<?= $view[banner_name2];?>" height="30" width="100"></a><?= $view[org_banner_name2];?>

                                        </div>
                                    <?php } ?>
                                    <div class="controls">
                                        <input class="input-file uniform_on span6" id="fileInput2" name="b_file2" type="file">
                                    </div>
                                </div>-->
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

<? include_once("../include/__footer.php"); ?>