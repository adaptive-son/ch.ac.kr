
///////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////
/*레이어팝업 */
var twidePopzone;
if (twidePopzone == undefined) {
	twidePopzone = function (settings) {			
		this.init(settings);
	};
}
twidePopzone.prototype.getItems = function () {
	return $(this.item_selector,this.listwrap);
}
twidePopzone.prototype.init = function (settings) {
	
	var setInit = $.extend({auto:8000,toggleBtn:true,isPlay:true,isAutoOpen:true,isAutoClose:true},settings);
	if(setInit!=undefined){
		for(var i in setInit) { 	this[i] = setInit[i];} 
	}


	this.total = this.getItems().length;
	/*
	if( this.getItems().length >1 && (this.getItems().length % this.vcount)>0) {
		var addBlank = this.vcount - (this.getItems().length % this.vcount);
		for (var j=0;j<addBlank ;j++ )
		{
			$("ul",this.listwrap).append("<li class='blank'><img src='/_Img/Share/popupzone_nodata.gif' alt=''/></li>");
		}

	}
	*/
	
	this.$li = this.getItems();

	this.ndt = 0;
	this.pg = 0;
	this.Timer = null; this.autoTimer = null;
	
	this.getPageCount();

	//ITEM 크기, 위치 초기화
	this.setItemPosition();

	//페이지 수다시 계산
	this.getPages();
	
	this.initCtrls();


	var $this = this;
 
	$(this.btnNext).click(function(){	$this.goNextPage();	});
	$(this.btnPrev).click(function(){	$this.goPrevPage();	});
	$(this.btnStop).click(function(){$this.isPlay=false; $this.stop(); $this.btnPlay.focus();	});
	$(this.btnPlay).click(function(){$this.isPlay=true; $this.play(); $this.btnStop.focus();	});

	this.$li.bind("focus",function(){
		$this.stop();
		
		$this.goDataFix(($(this).index()));
	});
	$("a,button",this.$li).bind("focus",function(){
		$this.stop();

		var $el =$($(this).parents($this.item_selector).get(0));
		$this.goDataFix($el.index());
	});

	this.goData(0);
	if(this.isPlay){	this.play();	 }
	else { 		this.stop();  	}
	
	$(window).resize(function(){
		$this.reset();
	});
//	this.goData(1);	

	/*
	


	

	
	

	if(this.isAutoOpen){
		this.checkOpen();
	}

	*/

	

}

twidePopzone.prototype.setItemPosition = function(){
	var wrapW = $(this.listwrap).width(); var wrapH =  $(this.listwrap).height();
	var li_w = Math.floor(wrapW / this.vcount);
	var li_h = wrapH;

	var $this = this;
	this.getItems().each(function(){

		var n = $(this).index() ;		
		
		var wNum = n % $this.vcount;
		var hNum = Math.floor(n/ $this.vcount) + 1;

		if(wNum==0) $(this).addClass("first");
		else $(this).removeClass("first");

		var toTop =0; var toLeft = 0;
		
		toTop = li_h * (hNum-1);
		toLeft = li_w * wNum;
		$(this).css({"width":li_w,"height":li_h,"top":toTop,"left":toLeft});
	});
	
}

twidePopzone.prototype.getPages = function(){
	this.vpage = Math.ceil(this.$li.length / this.vcount);
//	alert(this.vpage);
}
twidePopzone.prototype.getPageCount = function(){
		//	vcount = o.line_limit;
	var chkW = $("#header").width();

	//var vcount  =2;

					
	if(chkW >= 1200){
		vcount = 2;
	}else if(chkW >= 1000){
		vcount = 2;
	}else if(chkW > 723){
		vcount = 1;
	}else{
		vcount = 1;
	}



	this.vcount = vcount;

}

twidePopzone.prototype.reset = function () {

	this.resetDatas();

}
twidePopzone.prototype.initCtrls = function () {
	var $this = this;

	//$this.numbtns.html("");
	$("button",$this.numbtns).remove();
	$("button",$this.numbtns).unbind("click");
	if($this.vpage>1){
		for(var i=1;i<=$this.vpage;i++){
			$this.numbtns.append("<button type='button'><span>GO PAGE " +i+"</span></button>");
		}
		
		$("button",$this.numbtns).each(function(){

			$(this).click(function(){
				var this_Pg= $(this).index() + 1; 
				$this.goPage(this_Pg);
				return false;
			});

			
		});
		$(this.btnNext).show();
		$(this.btnPrev).show();
		 if(this.toggleBtn){
			 if(this.isPlay){ $(this.btnStop).show(); $(this.btnPlay).hide();}
			else { $(this.btnPlay).show(); $(this.btnStop).hide(); }
		 }else{
			 $(this.btnPlay).show();		$(this.btnStop).show();
		
		 }
		
	}else{
		$(this.btnNext).hide();
		$(this.btnPrev).hide();
		$(this.btnPlay).hide();
		$(this.btnStop).hide();
		


	}

}


twidePopzone.prototype.resetDatas = function(){

	var org_vcount = this.vcount;
	var org_vpage = this.vpage;
	this.getPageCount();
	
	//페이지 수다시 계산
	this.getPages();
	
	//ITEM 크기, 위치 초기화
	this.setItemPosition();
	this.initCtrls();

	//this.goPage(this.pg);
	//var resetFlag = false;
	 var resetFlag = true;
	//if(org_vcount!=this.vcount || org_vpage != this.vpage){ }
	this.goData(this.ndt,{effect:false,reset:resetFlag});
	
}

twidePopzone.prototype.goDataFix = function (n) {
	clearTimeout(this.Timer);	
	this.stop();
	var wNum = n % this.vcount;
	var hNum = Math.floor(n/ this.vcount) + 1;
	this.goPage(hNum,{setDataNum:n});
}
twidePopzone.prototype.goData = function (n,opt) {
	clearTimeout(this.Timer);	
	var $this = this;
	var wNum = n % this.vcount;
	var hNum = Math.floor(n/ this.vcount) + 1;

	this.ndt = n;
	
	if(opt==undefined){		var opt = {effect:true};	}
	opt.setDataNum = n;
	this.goPage(hNum,opt);



}
twidePopzone.prototype.goPage = function (goPg,opt) {
	clearTimeout(this.Timer);	
	var $this = this;
	
	if(goPg<1) goPg = 1;
	var orgPg = this.pg;
	
	if(opt==undefined){
		var opt = {effect:true};
	}

	

	if(orgPg!=goPg || opt.reset ==true ){
		


		var wrapW = $(this.listwrap).width(); var wrapH =  $(this.listwrap).height();
		var li_w = Math.floor(wrapW / this.vcount);
		var li_h = wrapH;

		
		this.getItems().each(function(){

			var n = $(this).index() ;		
			
			var wNum = n % $this.vcount;
			var hNum = Math.floor( n / $this.vcount) + 1;

			var toTop =0; var toLeft = 0; var zIndex = 1;
			toTop = li_h ;			toLeft = li_w * wNum;

			if(hNum==goPg){
				toTop = 0; zIndex = 10;
			}else{
				toTop = li_h; zIndex = 1;
			}


			if(opt.effect){
				var sEft = {"toTop":li_h *(-1), "toLeft":toLeft};
				if(hNum==goPg){
					$(this).stop()
						.css({"width":li_w,"height":li_h,opacity:0,left:sEft.toLeft,"top":sEft.toTop,"left":sEft.toLeft,"z-index":zIndex}).show()
						.animate({"width":li_w,"height":li_h,opacity:1,left:toLeft,"top":toTop,"left":toLeft,"z-index":zIndex},300,function(){

					});
				}else{
					$(this).stop()
						.animate({"width":li_w,"height":li_h,opacity:0,left:toLeft,"top":toTop,"left":toLeft,"z-index":zIndex},300,function(){

					});
				}

			}else{
				
				$(this).css({"width":li_w,"height":li_h,"top":toTop,"left":toLeft,"z-index":zIndex,"opacity":1});
			}
		});
	


		this.pg =  goPg;
		if(opt.setDataNum!=undefined) this.ndt = opt.setDataNum;
		else{
			this.ndt = (goPg -1 ) * this.vcount;
		}

		//alert(this.ndt);
		
		

		//alert(this.ndt);
	}
	
	var pgOnIcon = $("button",$this.numbtns).eq(this.pg-1);
	$("button",$this.numbtns).not(pgOnIcon).removeClass("over");
	$("button",$this.numbtns).not(pgOnIcon).removeClass("is-over");
	pgOnIcon.addClass("over");
	pgOnIcon.addClass("is-over");

		if(this.isPlay) this.Timer = setTimeout(function(){
			$this.goNextPage();
		},$this.auto);
		
}

twidePopzone.prototype.goNextPage = function () {
		clearTimeout(this.Timer);
		var goDt = this.pg+1;	
		if(goDt > this.vpage) goDt = 1;
		this.goPage(goDt);
}
twidePopzone.prototype.goPrevPage = function () {
		clearTimeout(this.Timer);
		var goDt = this.pg-1;	
		if(goDt<1) goDt = this.vpage;
		this.goPage(goDt);
}

twidePopzone.prototype.goNextData = function () {
	clearTimeout(this.Timer);
		var goDt = this.ndt+1;	
		if(goDt > this.total) goDt = 1;
		this.goData(goDt);
}
twidePopzone.prototype.goPrevData = function () {
		clearTimeout(this.Timer);
		var goDt = this.ndt-1;	
		if(goDt<1) goDt = this.total;
		this.goData(goDt);
}
twidePopzone.prototype.stop = function () {	this.isPlay=false; if(this.toggleBtn) { $(this.btnStop).hide();$(this.btnPlay).show(); }	 clearTimeout(this.Timer);}
twidePopzone.prototype.play = function () {	this.isPlay=true; if(this.toggleBtn) { $(this.btnPlay).hide();$(this.btnStop).show(); }	 this.goData(this.ndt);}


var twidepop ;
///////////////////////////////////////////////////////
function toggleTopWidePopups(){
	if($(".top-wide-popups").attr("isOpen")=="1"){
		closeTopWidePopups();
	}else{
		openTopWidePopups();
	}
}

function closeTopWidePopups(){
	$(".top-wide-popups").stop().animate({height:0},400);
	$(".tpop-topwide").css({'display':'none'});
	$(".top-wide-popups").attr("isOpen","0");
	$(".btn-popup").removeClass("active");
	twidepop.isPlay =false;
	twidepop.stop();
	$("#doc").removeClass("tpop-open");

	try{resizePageLayoutHeight();}catch(e){}

	$(".aside-quickmenu-wrapper").removeClass('open-popup');
}

function resetTopWidePopups(){
	twidepop.reset();

	if($(".top-wide-popups").attr("isOpen")=="1"){
	var maxHeight= 0;
		$(".top-wide-popups .tpop-topwide").each(function(){
			var h =$(this).outerHeight();
			if(h>maxHeight) maxHeight = h;
		});
		
		$(".top-wide-popups").stop().animate({height:maxHeight},400,function(){ try{resizePageLayoutHeight();}catch(e){}});
	}

	try{resizePageLayoutHeight();}catch(e){}

}
function openTopWidePopups(){		
	var maxHeight= 0;
	$(".top-wide-popups .tpop-topwide").each(function(){
		var h =$(this).outerHeight();
		if(h>maxHeight) maxHeight = h;
	});
	
	$(".top-wide-popups").stop().animate({height:maxHeight},400,function(){ try{resizePageLayoutHeight();}catch(e){}});
	$(".tpop-topwide").css({'display':'block'});
	$(".top-wide-popups").attr("isOpen","1");
	$(".btn-popup").addClass("active");
	$("#doc").addClass("tpop-open");
	twidepop.isPlay =true;
	twidepop.goData(0);
	try{resizePageLayoutHeight();}catch(e){}

	$(".aside-quickmenu-wrapper").addClass('open-popup');
}
$(".top-wide-popups .close-btn").click(function(){
	if($("#chk-close-wpopups").prop("checked")==true)
	{
		setCookie( "toppop", "done" , 24);
	}
	closeTopWidePopups();
});
