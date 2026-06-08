$(function() {
    // I-frame 자동높이 조절
//    $(".reHeight-iFrm").load(function() {
    $('.reHeight-iFrm').on('load', function(){
		if ( $(this).contents().find("body") != null && $(this).contents().find('body').scrollHeight > 0 )
		{
			$(this).height($(this).contents().find('body').scrollHeight);
		}
    });
});