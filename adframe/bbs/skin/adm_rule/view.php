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
<?
// 카테고리 설정
if($board_category && $view_row[category] > 0){
	$category_name = "<strong>[".$board_category[($view_row[category] - 1)]."]</strong>";
}
?>

<h2 class="title0201"><?=$configBBS[board_name]?></h2>

<!-- board view -->
<div class="board-area">

	<div class="board-view">
        <div class="board-view">
            <dl>
                <dt>
                    <strong>제목</strong>
                </dt>
                <dd>
                    <?=$category_name?><strong><?=$view_row[title]?></strong>
                </dd>
            </dl>
            <dl class="half-box01">
                <dt>
                    등록일
                </dt>
                <dd>
                    <?=$writeday[0]?>-<?=$writeday[1]?>-<?=$writeday[2]?>
                </dd>
            </dl>
            <dl class="half-box02">
                <dt>
                    작성자
                </dt>
                <dd>
                    <?=$bbs_name?>
                </dd>
            </dl>
			<dl class="half-box01">
                <dt>
                    1차 카테고리
                </dt>
                <dd>
                    <?
						// 1차 카테고리 호출 - 20.12.22 shlee
						$bbs_qry2 = "SELECT * FROM af_category WHERE TREE_NO='".$view_row[etc_char1]."'";
						$bbs_result2=DBquery($bbs_qry2);
						while($bbs_row2=mysql_fetch_array($bbs_result2)) {
					?>
						<?=$bbs_row2[NAME];?>
					<? } ?>
                </dd>
            </dl>
            <dl class="half-box02">
                <dt>
                    2차 카테고리
                </dt>
                <dd>
                    <?	
						// 2차 카테고리 호출 - 20.12.22 shlee
						$bbs_qry3 = "SELECT * FROM af_category WHERE TREE_NO='".$view_row[etc_char2]."'";
						$bbs_result3=DBquery($bbs_qry3);
						while($bbs_row3=mysql_fetch_array($bbs_result3)) {
					?>
						<?=$bbs_row3[NAME];?>
					<? } ?>
                </dd>
            </dl>
			<dl class="half-box01">
                <dt>
                    공포일자
                </dt>
                <dd>
                    <?=$view_row[etc_char3]?>
                </dd>
            </dl>
            <dl class="half-box02">
                <dt>
                    순서
                </dt>
                <dd>
                    <?=$view_row[etc_char4]?>
                </dd>
            </dl>
			
            <dl class="half-box01">
                <dt>
                    첨부파일
                </dt>
                <dd>
                    <?
                    for($i=0; $i < $filev; $i++) {
                        echo $upfile_link[$i];
                    }
                    ?>
                </dd>
            </dl>
            <dl class="half-box02 none">
                <dt>
                    조회
                </dt>
                <dd>
                    <?=$readnum?>
                </dd>
            </dl>

        </div>
		<? if($configBBS[origin_board_skin]!="main_press"){?>

        <div class="board-contents clear" style="border-bottom:1px solid #0f0f0f;">
            <?
				$content = preg_replace("/(\<img )([^\>]*)(\>)/i", "\\1 name='target_resize_image[]'  \\2 \\3", $content);
				echo stripslashes(htmlspecialchars_decode($content));
			?>
		</div>
		<? } ?>
	</div>
</div>

<div class="btns-area">
	<form method="POST" name="pwdForm">
		<input type="hidden" id="secAdmin" name="secAdmin" value="<?=$SecAdmin?>">
		<input type="hidden" id="permEdit" name="permEdit" value="<?=$permEdit?>">
		<input type="hidden" id="pwd" name="pwd" value="<?if($permEdit == 1){echo $view_row[pwd];}?>">
        <input type="hidden" id="chk" name="chk" value="ok"/>
		<?
		// 관리자페이지에서만 버튼 보이기
		if ( preg_match("|adframe|", $PHP_SELF) > 0 ) {
		?>
		<div class="btns-left">
			<?
			if ((int)$bbs_row[re_step] == 0) {
				BBSButtonLink($_BBS_Replied, "답변", "", "btns-type02 fl");
				BBSButtonLink($_BBS_Modified, "수정", "", "btns-type02 fl");
				BBSButtonLink($_BBS_Deleted, "삭제", "", "btns-type02 fl");
			}
			if ($SecAdmin && (int)$bbs_row[re_step] != 0) {
				BBSButtonLink($_BBS_Replied, "답변", "", "btns-type02 fl");
				BBSButtonLink($_BBS_Modified, "수정", "", "btns-type02 fl");
				BBSButtonLink($_BBS_Deleted, "삭제", "", "btns-type02 fl");
			}
			
			?>
		</div>
		<?
		}
		// 목록보기 링크
		$linkList = $PHP_SELF."?bbs=list&data=$data";
		?>

		<div class="btns-right">
			<a href="<?=$linkList?>" class="btns-type01">
				목록
			</a>
		</div>
	</form>
</div>
<!-- board view -->

<script>

    $(function(){
		// 답글 쓰기 페이지 이동 
        $('#btnReply').bind('click', function() {
            location.replace("<?=$_BBS_Replied?>");
        });

		 $('.check-password-box .btn-close').click(function(){
            //$('#pwd').val('');
            $('#btnConfirm').removeAttr('flag');

            $('#wrapper').removeClass('fixed');
            $('.check-password-area').hide();
        });


		$('#btnConfirm').bind("click", function() {
			if ($('#pwdParam').val() == '') {
				alert("패스워드를 입력하여 주십시오.");
				return false;
			}
			$('#pwd').val($('#pwdParam').val());
			//bbsEdit();

			// 클래스에 정의된 함수 호출
			if ($('#btnConfirm').attr('flag') == 'mod') {
				bbsEdit();
			} else if ($('#btnConfirm').attr('flag') == 'del') {
				bbsDel();
			}
		});
	});
	
    function fImgSize(MaxWidth){
        var NewImage = new Image();

        var Target=document.getElementsByName("target_resize_image[]");

        for(i=0; i<Target.length; i++){
            NewImage.src = Target[i].src;
            OldWidth = NewImage.width;
            OldHeight = NewImage.height;

            if(OldWidth >= MaxWidth){
                NewHeight = parseFloat(OldWidth / OldHeight);
                Target[i].width = MaxWidth;
                Target[i].height = parseInt(MaxWidth / NewHeight);
            }
        }
    }


	function call_bbsEdit(){
		if($("#secAdmin").val() != 1){
		//if($("#permEdit").val() != 1){
			$('#btnConfirm').attr('flag', 'mod');
			$('#wrapper').addClass('fixed');
			$('.check-password-area').fadeIn('fast', function() {
				$('.check-password-box').show();
			});
		}else{
			bbsEdit();
		}		
	}

	function call_bbsDel(){
		if($("#secAdmin").val() != 1){
			$('#btnConfirm').attr('flag', 'del');
			$('#wrapper').addClass('fixed');
			$('.check-password-area').fadeIn('fast', function() {
				$('.check-password-box').show();
			});
		}else{
			bbsDel();
		}		
	}

    window.onload=function() {
        fImgSize(900);
    }
</script>