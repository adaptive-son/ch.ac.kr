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
    }
    function closeWin2(div, chk, cookname) {
        if ( chk == "checked" ){
            setCookie(cookname, "done", 1);
        }
        document.getElementById(div).style.visibility = "hidden";
    }

    function setCookie( name, value, expiredays ) {
        var todayDate = new Date();
        todayDate.setDate( todayDate.getDate() + expiredays );
        document.cookie = name + "=" + escape( value ) + "; path=/; expires=" + todayDate.toGMTString() + ";"
        //alert(document.cookie);
    }

</script>
<?
$today_date = date("Y-m-d");
$sql_mpop = " select * from ".TABLE_POPUP." where site_id='".site_id."' AND '".$today_date."' between gigan1 and gigan2 ";			// 기간 설정
$sql_mpop .= " and useyn like 'Y%' ";
$sql_mpop .= " order by no desc limit 0, 5 ";																							// 최신 5개의 게시물
$rs_mpop = $adb->query($sql_mpop);
while ( $row_mpop = $rs_mpop->fetchRow(DB_FETCHMODE_ASSOC) ) $rows_mpop[] = $row_mpop;
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
			<div class="jwxe_popup" id="divpop<?=$k?>" style="position:absolute;left:<?=$v[pop_left]?>px;top:<?=$v[pop_top]?>px;z-index:999;display: none;">
                <div class="modal-area">
                    <div class="jwxe_html jw-relative" style="width:100%;height:100%;">
                        <a href="<?=$v[link_url]?>" <? if ( $v[target] == "_blank" ) echo "target='$v[target]'"; ?>>
							<img src="/data/popup/<?=$v[popup_name]?>" border="0" />
						</a>
                    </div>
                    <div class="footer-btns-wrapper">
                        <div class="footer-btns">
                            <p>
                                <input type="checkbox" id="chkbox" value="checkbox" onClick="javascript:closeWin2('divpop<?=$k?>', 'checked', 'maindiv<?=$k?>');">
								오늘 하루 보지 않기
                            </p>
                            <a href="javascript:closeWin('divpop<?=$k?>', 'chkbox', 'maindiv<?=$k?>');">닫기</a>
                        </div>
                    </div>
                </div>
            </div>
    <? } ?>
    
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
            } else {
                $("#popupzone-wrapper").hide();
            }
            <?php }?>
        });
    </script>

