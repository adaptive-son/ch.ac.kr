$(function() {
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

});

