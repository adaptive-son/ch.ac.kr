<script language="JavaScript">
    function bluringIMG(){
        if(event.srcElement.tagName=="A"||event.srcElement.tagName=="IMG") document.body.focus();
    }
    document.onfocusin=bluringIMG;

    function sizeModify(img){
        if (img.width > <?=$configBBS[board_viewimgwidth]?>){
            img.width = <?=$configBBS[board_viewimgwidth]?> ;
        }
    }
    function PopupIMG(FURL,WIDTH,HEIGHT,VALUED){
        window.open(FURL+'?data='+VALUED,'popup','width='+WIDTH+',height='+HEIGHT+',scrollbars=no,stauts=no');
    }

    function DisplayDetail(divname,state) {
        if(state == 1) {
            document.getElementById(divname).style.display = "";
        }
        else {
            document.getElementById(divname).style.display = "none";
        }
    }
</script>
<div class="board-area">

    <? global $TREE_NO, $DEPTH; // 메뉴 설정을 위한 변수 정의 ?>

    <div class="board-view">
        <div class="title-area">
            <h4>
                <?=$view_row[title]?>
            </h4>
        </div>

        <div class="board-view-information">
			<dl>
                <dt>
                    작성자
                </dt>
                <dd>
                    <?=$bbs_name?>
                </dd>
            </dl>

            <dl class="board-view-date">
                <dt>
                    등록일
                </dt>
                <dd>
                    <?=$writeday[0]?>-<?=$writeday[1]?>-<?=$writeday[2]?>
                </dd>
            </dl>

            <dl>
                <dt>
                    조회수
                </dt>
                <dd>
                    <?=$view_row[readnum]?>
                </dd>
            </dl>
        </div>

		<!--<?
			if($filev>0) {
		?>
        <dl class="attached-file-wrapper">
            <dt>
                첨부파일
            </dt>
            <dd>
                <?
                for($i=0; $i < $filev; $i++) {
                    echo "<p>".$upfile_link[$i]."</p>";
                }
                ?>
            </dd>
        </dl>
		<? } ?>-->

		<div class="board-contents">

			<div class="card-slider-wrapper">
				<div class="swiper-container" id="card-slider">
					<div class="swiper-wrapper">
						<?
							for($i=0; $i < $filev; $i++) {
						?>
						<div class="swiper-slide">
							<?=$upfile_imgview2[$i]?>
						</div>
						<? } ?>
					</div>

					<div class="card-pagination-wrapper">
						<div class="swiper-pagination"></div>
					</div>
				</div>
				
				<button type="button" class="btn-prev">
					Previous
				</button>
				<button type="button" class="btn-next">
					Next
				</button>
			</div>

		</div>

        <? include("../board/preNext.php");?>
    </div>

    <ul class="board-view-sns">
        <li style="display: inline">
            <a href="#" data-toggle="sns_share"  data-service="naver" data-title="네이버 SNS공유">
                <img src="/_common/img/icon/icon_naver01.jpg" alt="NAVER">
            </a>
        </li>
        <!--
        <li>
            <a href="#" data-toggle="sns_share"  data-service="kakao" data-title="카카오톡 SNS공유">
                <img src="/_common/img/icon/icon_kakaotalk01.jpg" alt="KAKAOTALK">
            </a>
        </li>-->
        <li style="display: inline">
            <a href="#" data-toggle="sns_share" data-service="facebook" data-title="FACEBOOK SNS공유">
                <img src="/_common/img/icon/icon_facebook01.jpg" alt="FACEBOOK">
            </a>
        </li>
        <li style="display: inline">
            <a href="#" data-toggle="sns_share" data-service="twitter" data-title="TWITER SNS공유">
                <img src="/_common/img/icon/icon_twiter01.jpg" alt="TWITER">
            </a>
        </li>
        <li style="display: inline">
            <a href="#" onclick="fn_copy_url()">
                <img src="/_common/img/icon/icon_url01.jpg" alt="URL">
            </a>
        </li>
    </ul>


    <div class="btns-area">
        <div class="btns-left">
            <form method="POST" name="<? if($permEdit == 1 || $SecAdmin == 1) { echo "pwdForm"; }?>">
                <input type="hidden" id="secAdmin" name="secAdmin" value="<?=$SecAdmin?>">
                <input type="hidden" id="permEdit" name="permEdit" value="<?=$permEdit?>">
                <input type="hidden" name="site_id" id="site_id" value="<?=TREE_ID?>">
                <input type="hidden" name="TREE_NO" id="TREE_NO" value="<?=$TREE_NO?>">
                <input type="hidden" name="DEPTH" id="DEPTH" value="<?=$DEPTH?>">
                <input type="hidden" name="CHILD" id="CHILD" value="<?=$CHILD?>">
                <input type="hidden" name="data" id="data" value="<?=$data?>">
                <input type="hidden" id="pwd" name="pwd" value="<?if($permEdit == 1){echo $view_row[pwd];}?>">
                <input type="hidden" id="chk" name="chk" value="ok"/>

                <?
                //echo $_BBS_Password;
                // $SecAdmin : 관리자 권한이 존재할 경우, 비밀번호 확인없이 게시글 제어 권한 부여 By.Son 2020.12.29
                /*if ( $SecAdmin == 1 || $permEdit == 1 ) {
                    BBSButtonLink($_BBS_Replied, "답변", "", "btn-m02 btns-color03 depth4");
                    BBSButtonLink($_BBS_Modified, "수정", "", "btn-m02 btns-color02 depth4");
                    BBSButtonLink($_BBS_Deleted, "삭제", "", "btn-m02 btns-color02 depth4");
                } else {
                    BBSButtonLink($_BBS_Replied, "답변", "", "btn-m02 btns-color03 depth4 open-password");
                    BBSButtonLink($_BBS_Modified, "수정", "", "btn-m02 btns-color02 depth4 open-password");
                    BBSButtonLink($_BBS_Deleted, "삭제", "", "btn-m02 btns-color02 depth4 open-password");
                }*/
                ?>
            </form>
        </div>

        <div class="btns-right">
            <a href="<?=$PHP_SELF?>?site_id=<?=TREE_ID?>&TREE_NO=<?=$TREE_NO?>&DEPTH=<?=$DEPTH?>&bbs=list&data=<?=$data?>" class="btn-m02 btns-color01 depth4">
                목록
            </a>
        </div>
    </div>
</div>

<div class="mask-layerpopup" style="display: none;"></div>
<? if($permEdit != 1 && $SecAdmin != 1) {
    include("../board/check_password.php");
}?>


<script>
	/* card slide */
	var cardSlider01 = new Swiper('#card-slider', {
		loop: true,
		autoHeight: true, 
		navigation: {
			nextEl: '.btn-next',
			prevEl: '.btn-prev',
		},
		pagination: {
			el: '.swiper-pagination',
			clickable: true,
			renderBullet: function (index, className) {
			return '<span class="' + className + '">' + (index + 1) + '</span>';
			},
		},
	});
</script>