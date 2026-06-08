<!-- // 모바일 / PC 접근 내용 확인 ( By.Son 2016-12-05 ) -->
<style type="text/css">
    .divpop table {
        width : auto!important;
    }

</style>
<script>
    function closeWin(div, chk, cookname) {
        if ( document.getElementById(chk).checked ){
            setCookie(cookname, "done", 1);
        }
        document.getElementById(div).style.visibility = "hidden";
        $('.mask-popupzone').hide();
    }
    function closeWin2(div, chk, cookname) {
        if ( chk == "checked" ){
            setCookie(cookname, "done", 1);
        }
        document.getElementById(div).style.visibility = "hidden";
        $('.mask-popupzone').hide();
    }

    function setCookie( name, value, expiredays ) {
        var todayDate = new Date();
        todayDate.setDate( todayDate.getDate() + expiredays );
        document.cookie = name + "=" + escape( value ) + "; path=/; expires=" + todayDate.toGMTString() + ";"
        //alert(document.cookie);
    }

</script>
<?
$detect = new Mobile_Detect;
$mobile_detect = $detect->isMobile();
if ( $mobile_detect ) {
    $__ACCESS_AGENT = "MOBILE";
} else {
    $__ACCESS_AGENT = "PC";
}

$today_date = date("Y-m-d");
$sql_mpop = " select * from ".TABLE_POPUP." where site_id='".site_id."' AND '".$today_date."' between gigan1 and gigan2 ";			// 기간 설정
$sql_mpop .= " and useyn like 'Y%' ";
$sql_mpop .= " order by no desc limit 0, 5 ";																							// 최신 5개의 게시물

$rs_mpop = $adb->query($sql_mpop);
while ( $row_mpop = $rs_mpop->fetchRow(DB_FETCHMODE_ASSOC) ) $rows_mpop[] = $row_mpop;

if ( $__ACCESS_AGENT == "PC" ) {
    ?>

    <script>
        $(function() {
            var cookiedata = document.cookie;
            var cookie_max_count = "5";
            for ( var i = 0 ; i < cookie_max_count ; i++ ) {
                if ( cookiedata.indexOf("maindiv"+i+"=done") < 0 ){
                    $("#divpop"+i).show();
                }
                else{
                    $("#divpop"+i).hide();
                }
            }
        });
    </script>
    <?php
    // PC 접속일 경우
    foreach ( $rows_mpop as $k => $v ) {
        ?>
        <div class="divpop" id="divpop<?=$k?>" style="position:absolute;left:<?=$v[pop_left]?>px;top:<?=$v[pop_top]?>px;z-index:9999;border:1px solid #cbcbcb;display: none;">
            <table>
                <tr>
                    <td bgcolor="black" >
                        <? if  ( $v[use_map] == "Y" ) { ?>
                            <img src="<?=POPUP_LOAD_PATH."/".$v[popup_name]?>" border="0" usemap="#map<?=$k?>" />
                            <map name="map<?=$k?>">
                                <?=htmlspecialchars_decode(stripslashes($v[map_contents]))?>
                            </map>
                        <? } else { ?>
                            <a href="<?=$v[link_url]?>" <? if ( $v[target] == "_blank" ) echo "target='$v[target]'"; ?>><img src="/data/popup/<?=$v[popup_name]?>" border="0" /></a>
                        <? } ?>
                    </td>
                </tr>
                <tr align="right">
                    <td bgcolor="black" height="30">
                        <table>
                            <tr>
                                <td><input type="checkbox" id="chkbox" value="checkbox" onClick="javascript:closeWin2('divpop<?=$k?>', 'checked', 'maindiv<?=$k?>');" style="display: block; margin-right:5px;"></td>
                                <td><img src="/_common/img/btn/close.gif" alt="오늘 하루 열지 않기" style="display: block;"/></td>
                                <td align="right"><a href="javascript:closeWin('divpop<?=$k?>', 'chkbox', 'maindiv<?=$k?>');"><img src="/_common/img/btn/close2.gif" alt="닫기" style="display: block; padding:0 5px;"/></a></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
    <? } ?>
    <?
} else {
    // 모바일 접속일 경우
    ?>

    <div class="mask-popupzone" <?php if(count($rows_mpop)==0){?> style="display: none;"<?php }?>></div>
    <div class="popupzone-wrapper" id="popupzone-wrapper" <?php if(count($rows_mpop)==0){?> style="display: none;"<?php }?>>
        <!--<div class="title-area">
            <h2>
                팝업존
            </h2>
        </div>-->
        <div class="popupzone-area">
            <div class="owl-carousel" id="popupzone-slider">
                <?php
                foreach ( $rows_mpop as $k => $v ) {

                ?>
                    <div class="item">
                    <? if  ( $v[use_map] == "Y" ) { ?>
                        <img src="<?=POPUP_LOAD_PATH."/".$v[popup_name]?>" border="0" usemap="#map<?=$k?>" />
                        <map name="map<?=$k?>">
                            <?=htmlspecialchars_decode(stripslashes($v[map_contents]))?>
                        </map>
                    <? } else { ?>
                        <a href="<?=$v[link_url]?>" <? if ( $v[target] == "_blank" ) echo "target='$v[target]'"; ?>><img src="/data/popup/<?=$v[popup_name]?>" border="0" /></a>

                    <? } ?>
                    </div>
                <?php }?>
            </div>

            <!--<div id="counter"></div>-->
			
			<div class="popupzone-footer-wrapper">
				<div class="today-checked-close">
					<input type="checkbox" id="checkbox-top-popupzone" name="" value=""/>
					<label for="checkbox-top-popupzone">
						오늘하루 열지않기
					</label>
				</div>

				<button type="button" class="btn-close" onclick="$('#popupzone-wrapper').hide(); $('.mask-popupzone').hide();">
					팝업존 창닫기
				</button>

			</div>
        </div>

		
		
<!--
        <button type="button" class="btn-close" onclick="$('#popupzone-wrapper').hide(); $('.mask-popupzone').hide(); ">
			<span>
				닫기
			</span>
            <img src="/_common/img/btn/btn_close.png" alt="창닫기" />
        </button>

        <div class="today-checked-close">
            <input type="checkbox" id="checkbox-top-popupzone" onclick="javascript:closeWin2('popupzone-wrapper', 'checked', 'popupzone-wrapper');" />
            <label for="checkbox-top-popupzone">
                오늘하루 열지않기
            </label>
        </div>
-->
    </div>
    <!-- //popup zone -->

    <script type="text/javascript">
        $(function(){
            var popupZoneSlider = $('#popupzone-slider');

            popupZoneSlider.owlCarousel({
                items:1,
                autoplay: 2000,
                loop: true,
                nav: true,
                margin: 0,
                autoHeight: true,
                responsiveClass: true,
                onInitialized: counter,
                onTranslated: counter
            });

            function counter(event) {
                var element   = event.target;
                var items     = event.item.count;
                var item      = event.item.index + 1;

                if(item > items) {
                    item = item - items
                }
                $('#counter').html(item + " / " + items)
            }

            <?php if(count($rows_mpop)>0){?>

            var cookiedata = document.cookie;
            if ( cookiedata.indexOf("popupzone-wrapper=done") < 0 ) {
                $("#popupzone-wrapper").show();
                $('.mask-popupzone').show();
            } else {
                $("#popupzone-wrapper").hide();
                $('.mask-popupzone').hide();
            }
            <?php }?>
        });
    </script>


<? } ?>
<!-- // 모바일 / PC 접근 내용 확인 -->