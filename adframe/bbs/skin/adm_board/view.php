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
			<? if($configBBS[origin_board_skin]=="main_press"){?>
			<dl>
                <dt>
                    <strong>제목 링크</strong>
                </dt>
                <dd>
                    <?=$view_row[etc_char1]?>
                </dd>
            </dl>
			<dl>
                <dt>
                    <strong>신문사1</strong>
                </dt>
                <dd>
					<?=$view_row[etc_char2]?>
                </dd>
            </dl>
			<dl>
                <dt>
                    <strong>신문사1 링크</strong>
                </dt>
                <dd>
                    <?=$view_row[etc_char3]?>
                </dd>
            </dl>
			<dl>
                <dt>
                    <strong>신문사2</strong>
                </dt>
                <dd>
                    <?=$view_row[etc_char4]?>
                </dd>
            </dl>
			<dl>
                <dt>
                    <strong>신문사2 링크</strong>
                </dt>
                <dd>
                    <?=$view_row[etc_char5]?>
                </dd>
            </dl>
			<dl>
                <dt>
                    <strong>신문사3</strong>
                </dt>
                <dd>
                    <?=$view_row[etc_char6]?>
                </dd>
            </dl>
			<dl>
                <dt>
                    <strong>신문사3 링크</strong>
                </dt>
                <dd>
                    <?=$view_row[etc_char7]?>
                </dd>
            </dl>
			<? } ?>
			<? if($configBBS[origin_board_skin]=="sanhak"){?>
			<dl>
                <dt>
                    <strong>URL</strong>
                </dt>
                <dd>
                    <a href="<?=$view_row[etc_char2]?>" target="_blank" title="새창열림">
						<?=$view_row[etc_char2]?>
					</a>
                </dd>
            </dl>
			<? } ?>
            <dl class="half-box01">
                <dt>
                    등록일
                </dt>
                <dd>
                    <?=$writeday[0]?>-<?=$writeday[1]?>-<?=$writeday[2]?>
                </dd>
            </dl>
			<? if($BoardKey!="2610") { ?>
            <dl class="half-box02">
                <dt>
                    작성자
                </dt>
                <dd>
                    <?=$bbs_name?>
                </dd>
            </dl>
			<? } else if ($BoardKey=="2610") {?>
			<dl class="half-box02">
                <dt>
                    부서명
                </dt>
                <dd>
                    <?=$view_row[etc_char3]?>
                </dd>
            </dl>
			<? } ?>
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

        <div class="board-contents clear" style="border-bottom:1px solid #0f0f0f;">



            <?
				$content = preg_replace("/(\<img )([^\>]*)(\>)/i", "\\1 name='target_resize_image[]'  \\2 \\3", $content);
				echo stripslashes(htmlspecialchars_decode($content));
			?>
			<?php
			//첨부파일 중 PDF 파일이 있으면 바로 노출
			
			if ( $filev > 0 ) { 
				for ( $i = 0 ; $i < $filev; $i++ ) {
					$file_name_array = explode(".",$upfile_name[$i]);

					if($file_name_array[1]=="pdf" || $file_name_array[1]=="PDF"){
						
			?>
			
			<div class="pdf-box-area pc-only">
				<object data="/data/bbs_upload/<?php echo $upfile_path[$i]?>" type="application/pdf" id="pdf"></object>
			</div>
			<?
					}
				}
			}
			?>

            <? if($configBBS[origin_board_skin]!="sanhak" && $configBBS[origin_board_skin]!="course" && $configBBS[origin_board_skin]!="main_press" && $view_row[etc_char1]!=""){?>
                <div>
                    <iframe width="80%" height="450" src="https://www.youtube.com/embed/<?=$view_row[etc_char1]?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            <?}?>
		</div>
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