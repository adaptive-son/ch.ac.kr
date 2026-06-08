$(function() {
    fImgSize(600);
	/* 비밀번호 입력 */
	$(".open-password").on("click", function() {
		if($(this).hasClass('open-password') == true) {
			event.preventDefault();
			$(".mask-layerpopup").fadeIn(300, function() {
				$(".layerpopup-password-wrapper").show();
			});
		}
	});

	$(".mask-layerpopup, .btn-layerpopup-close").on("click", function() {
		$(".layerpopup-password-wrapper").hide();
		$(".mask-layerpopup").fadeOut(300);
	});


	/* 파일 업로드 */
	$('.upload_text').val('첨부파일을 선택하세요.');
	$('.input_file').change(function(){
		var i = $(this).val();
		$('.upload_text').val(i);
	});

	/**
	 * @description FAQ
	 */
	var $faqList = $('.faq-list');
	var $question = $faqList.find('.question');
	var $allItem = $faqList.find('.question, .answer');

	// 첫 번째 항목 활성화
	$question.eq(0).addClass('active').next().addClass('active');

	$question.on('click focusin', function () {
		function closeAll() {
			$allItem.removeClass('active');
		}

		if(!$(this).hasClass('active')) {
			closeAll();
			$(this).addClass('active').next().addClass('active');
		}
	});

    $('.datepicker, .sdate, .edate').datepicker({
        dateFormat: 'yy-mm-dd',
        monthNames : ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
        monthNamesShort : ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
        dayNames : ['일', '월', '화', '수', '목', '금', '토'],
        dayNamesShort : ['일', '월', '화', '수', '목', '금', '토'],
        dayNamesMin : ['일', '월', '화', '수', '목', '금', '토'],
        showMonthAfterYear: true,
        buttonImageOnly: true,
        changeMonth: true,
        changeYear: true
    });


    if($("#use_notice").is(":checked")==false){
        $(".sdate").attr("disabled","disabled");
        $(".edate").attr("disabled","disabled");
        $(".datepicker").datepicker('disable');
    }

	//공지사항선택
    if($("#use_notice").is(":checked")==false){
        $(".sdate").attr("disabled","disabled");
        $(".edate").attr("disabled","disabled");
        $(".datepicker").datepicker('disable');
    }

    $("#use_notice").click(function() {
        var chk = $(this).is(":checked");//.attr('checked');
        if (chk) {
            $(".datepicker").datepicker('enable');
        } else {
            $(".datepicker").datepicker('disable');

        }
    });

// 답글 쓰기 페이지 이동
    $('#btnReply').bind('click', function() {
        location.replace("<?=$_BBS_Replied?>");
    });

    /*
    $('.check-password-box .btn-close').click(function(){
        //$('#pwd').val('');
        $('#btnConfirm').removeAttr('flag');

        $('#wrapper').removeClass('fixed');
        $('.check-password-area').hide();
    });*/


    /*
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
        }else{
            chk_password();
        }
    });*/


    var fontSize = $(".board-contents > p").css('font-size');
    if(typeof  fontSize !== "undefined"){
        fontSize = parseInt(fontSize.replace('px','').replace('pt',''));
        var lineHeight = Math.floor(fontSize * 1.5);
        $(".board-contents > p").css("line-height",lineHeight+"px");
    }



    $("a[data-toggle='sns_share']").click(function(e){
        e.preventDefault();

        var _this = $(this);
        var sns_type = _this.attr('data-service');
        var href = document.URL;
        var title = _this.attr('data-title');
        var loc = "";
        var img = $("meta[name='og:image']").attr('content');

        if( ! sns_type || !href || !title) return;

        if( sns_type == 'facebook' ) {
            loc = '//www.facebook.com/sharer/sharer.php?u='+href+'&t='+title;
        }
        else if ( sns_type == 'twitter' ) {
            loc = '//twitter.com/home?status='+encodeURIComponent(href);
        }
        else if ( sns_type == 'google' ) {
            loc = '//plus.google.com/share?url='+href;
        }
        else if ( sns_type == 'pinterest' ) {

            loc = '//www.pinterest.com/pin/create/button/?url='+href+'&media='+img+'&description='+encodeURIComponent(title);
        }
        else if ( sns_type == 'kakaostory') {
            loc = 'https://story.kakao.com/share?url='+encodeURIComponent(href);
        }
        else if ( sns_type == 'band' ) {
            loc = 'http://www.band.us/plugin/share?body='+encodeURIComponent(title)+'%0A'+encodeURIComponent(href);
        }
        else if ( sns_type == 'naver' ) {
            loc = "http://share.naver.com/web/shareView.nhn?url="+encodeURIComponent(href)+"&title="+encodeURIComponent(title);
        }
        else {
            return false;
        }

        window.open(loc);
        return false;
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
    //if($("#secAdmin").val() != 1){
    if($("#permEdit").val() != 1){
        $('#btnConfirm').attr('flag', 'mod');
		
        /*
        $('#wrapper').addClass('fixed');
        $('.check-password-area').fadeIn('fast', function() {
            $('.check-password-box').show();
        });*/
        $(".mask-layerpopup").fadeIn(300, function() {
            $(".layerpopup-password-wrapper").show();
        });
    }else{
        bbsEdit();
    }
}

function call_bbsDel(){
    //if($("#secAdmin").val() != 1){
    if($("#permEdit").val() != 1){
        $('#btnConfirm').attr('flag', 'del');
        /*
        $('#wrapper').addClass('fixed');

        $('.check-password-area').fadeIn('fast', function() {
            $('.check-password-box').show();
        });
        */
        $(".mask-layerpopup").fadeIn(300, function() {
            $(".layerpopup-password-wrapper").show();
        });
    }else{
        bbsDel();
    }
}


function fn_copy_url(){
    copyTextToClipboard(document.URL);
    alert('URL 이 복사 되었습니다.');
}



function copyTextToClipboard(text) {
    var textArea = document.createElement("textarea");

    //
    // *** This styling is an extra step which is likely not required. ***
    //
    // Why is it here? To ensure:
    // 1. the element is able to have focus and selection.
    // 2. if element was to flash render it has minimal visual impact.
    // 3. less flakyness with selection and copying which **might** occur if
    //    the textarea element is not visible.
    //
    // The likelihood is the element won't even render, not even a flash,
    // so some of these are just precautions. However in IE the element
    // is visible whilst the popup box asking the user for permission for
    // the web page to copy to the clipboard.
    //

    // Place in top-left corner of screen regardless of scroll position.
    textArea.style.position = 'fixed';
    textArea.style.top = 0;
    textArea.style.left = 0;

    // Ensure it has a small width and height. Setting to 1px / 1em
    // doesn't work as this gives a negative w/h on some browsers.
    textArea.style.width = '2em';
    textArea.style.height = '2em';

    // We don't need padding, reducing the size if it does flash render.
    textArea.style.padding = 0;

    // Clean up any borders.
    textArea.style.border = 'none';
    textArea.style.outline = 'none';
    textArea.style.boxShadow = 'none';

    // Avoid flash of white box if rendered for any reason.
    textArea.style.background = 'transparent';


    textArea.value = text;

    document.body.appendChild(textArea);

    textArea.select();

    try {
        var successful = document.execCommand('copy');
        var msg = successful ? 'successful' : 'unsuccessful';
        console.log('Copying text command was ' + msg);
    } catch (err) {
        console.log('Oops, unable to copy');
    }

    document.body.removeChild(textArea);
}