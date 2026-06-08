<script>

	function bluringIMG(){
		if(event.srcElement.tagName=="A"||event.srcElement.tagName=="IMG") document.body.focus();
	}
	document.onfocusin=bluringIMG;

	function sizeModify(img){
		if (img.width > 580){
			img.width = 580 ;
		}
	}

	function openImageWinCenter(imageRef){

		return;

		var x,y,w,h,loadingMsg;
		w=300;h=100;
		x=Math.floor( (screen.availWidth-(w+12))/2 );y=Math.floor( (screen.availHeight-(h+30))/2 );

		loadingMsg="<table width=100% height=100%><tr><td valign=center align=center>&nbsp;</td></tr></table>";
		//loadingMsg = "";

		with( window.open("","",'height='+h+',width='+w+',top='+y+',left='+x+',scrollbars=yes,resizable=yes') ) {
			document.write(
				"<body topmargin=0 rightmargin=0 bottommargin=0 leftmargin=0>",
				loadingMsg,
				"<img src=\""+imageRef+"&w=&h=\" hspace=0 vspace=0 border=0 style=cursor:hand onmousedown=\"window.close();\" onload=\"document.title=this.src;document.body.removeChild(document.body.children[0]);window.resizeTo(this.width+30,this.height+35);window.moveTo(Math.floor( (screen.availWidth-(this.width+12))/2),Math.floor( (screen.availHeight-(this.height+30))/2 ));\">",
				"</body>");
			focus();
		}
	}

	function photoView(SRC) {

		img_pre = 'photo';
		ISRC = '/bbs/imgview.php?file=image&data='+SRC;

		document.images[img_pre].src = ISRC;

	}

	function bbsEdit(Fm)
	{

		var form= eval("document."+Fm);
		if(form.pwd.value==""){
			alert("비밀번호를 입력해 주십시오.");
			form.pwd.focus();
		}else{
			form.action="/bbs/module_pw.php?BURL=<?=$PHP_SELF?>&MainCD=<?=$MainCD?>&SubCD=<?=$SubCD?>&edit=ok";
			form.submit();
		}
	}

	function bbsDel(Fm)
	{
		var form= eval("document."+Fm);
		if(form.pwd.value==""){
			alert("비밀번호를 입력해 주십시오.");
			form.pwd.focus();
		}else{
			form.action="/bbs/module_pw.php?BURL=<?=$PHP_SELF?>&MainCD=<?=$MainCD?>&SubCD=<?=$SubCD?>&del=ok";
			form.submit();
		}
	}
</script>
<!-- 2023.03.06 추가작업 타이틀에 텝메뉴 및 목록까지 나오게끔 수정-->
<script>
	$(function() {
		if($(".tabmenu-wrapper").css("display") == "block") {
			var tempTabmenuTitile = $(".tabmenu-wrapper ul li.active a").text();
			$("#title").prepend("목록 &lt; " + tempTabmenuTitile + " &lt; ");
		} else {
			$("#title").prepend("목록 &lt; ");
		}
	});
</script>
<!-- //2023.03.06 추가작업 -->



<?php
//카테고리
if($configBBS[board_category]){
    ?>
    <div class="tabmenu-wrapper ratio mb55">
        <ul class="depth<?=count($board_category)+1?>">


            <?php
            $category_href = $PHP_SELF."?site_id=".TREE_ID."&TREE_NO=".$TREE_NO."&DEPTH=".$DEPTH;
            $category_option .= '<li';
            if($_REQUEST['category']=='') $category_option .= " class='active' ";
            $category_option .= '><a href="'.$category_href.'"';
            $category_option .= '>전체</a></li>';

            for ($i=0; $i<count($board_category); $i++) {
                $category_option .= '<li';
                if ( $_REQUEST['category'] == $board_category[$i] ) $category_option .= " class='active' ";
                $category_option .= '><a href="'.($category_href."&amp;category=".urlencode($board_category[$i])).'"';
                $category_option .= '>'.$board_category[$i].'</a></li>';
            }
            echo $category_option;
            ?>
        </ul>
    </div>
    <?
}
?>

<div class="board-area">
	<? global $TREE_NO, $DEPTH; ?>
    <form name="searchForm" action="<?=$PHP_SELF?>?site_id=<?=TREE_ID?>&TREE_NO=<?=$TREE_NO?>&DEPTH=<?=$DEPTH?>" method="post" onSubmit="return searchSendit();">
        <fieldset>
            <legend class="blind">
                게시판 목록 검색
            </legend>
            <div class="search-wrapper">
                <div class="search-area">
                    <select name="search" title="검색 선택창">
                        <option value="title" <? if($search=="title") echo "selected"; ?>>제목</option>
                        <option value="name" <? if($search=="content") echo "selected"; ?>>내용</option>
                    </select>

                    <div class="search-box">
                        <input type="search" id="searchstring" name="searchstring" value="<?=$searchstring?>" title="검색어 입력">
                        <input type="submit" id="" name="" value="검색" class="btn-search">
                    </div>

                </div>
                <p class="total">
                    총 <strong><?=$numrows?></strong> 건의 자료가 있습니다.
                </p>
            </div>
        </fieldset>
    </form>
	<div class="card-type-list01">
	<ul>
	<?
	$bbs_result=DBquery($bbs_qry);

	if($numrows<1) {
		?>
		<li> No Pictures </li>
		<?
	}else{


	$s_letter=$letter_no; //페이지별 시작 글번호

	while($bbs_row=mysql_fetch_array($bbs_result))
	{

	$encode_str = "pagecnt=".$pagecnt."&idx=".$bbs_row[idx]."&letter_no=".$s_letter."&offset=".$offset;
	$encode_str.= "&search=".$search."&searchstring=".$searchstring;
	$encode_str.= "&Boardkey=".$bbs_row[code]."&Sub_No=".$bbs_row[sub_no]."&DBTable=".$configBBS[board_id];

	$list_data=Encode64($encode_str); //각 레코드 정보

	//리스트 이미지
	//if($bbs_row[up_file]>0 && preg_match("/\.(gif|jpg|jpeg|png)$/i", strtolower($bbs_row[up_filename]))>0){
	 $sql = "select count(*) AS img_cnt from ".$configBBS[board_id]."_file where file_type=2 or file_type=3 and up_file_idx =".$bbs_row[up_file_idx];

	 $z_row = sql_fetch($sql);

	 if($bbs_row[up_file]>0 && $z_row['img_cnt']>0){
		//$fileencode_str = "Boardkey=".$BoardKey."&DBTable=".$configBBS[board_id]."&idx=".$bbs_row[up_file_idx]."&download=ok";
		//$file_data=Encode64($fileencode_str);
		//$upImg = "/adframe/bbs/imageview.php?image=thumnail&data=".$file_data;
		
		$data = "image=thumnail&board_table=".$configBBS[board_id]."&idx=".$bbs_row[up_file_idx];
		$upImg = "/adframe/bbs/image_preview.php?".$data;

	}else{
		 /* 2020-11-03 에디터에서 사진 첨부 시 썸네일 이미지 나오게 수정 by psy */
		 if(preg_match("/<img[^>]*src=[\"']?([^>\"']+)[\"']?[^>]*>/i", $bbs_row['content'], $match)){
			 $content = str_replace('\"','"',$bbs_row['content']);
			 preg_match("/<img[^>]*src=[\"']?([^>\"']+)[\"']?[^>]*>/i", $content, $match);

			 $upImg = $match[1];
		 } else {
			$upImg = "/_common/img/common/noimg.jpg";
		 }
	}

	$writeday = explode("-",substr($bbs_row[writeday],0,11));
	$writeday = $writeday[0].".".$writeday[1].".".$writeday[2];

	// 검색어 강조
	$patternkey = "/$searchstring/i";
	$BBS_Title  = StringCut($bbs_row[title],0,$configBBS[board_titlecut],'UTF-8','...');
	if(!empty($searchstring) && $search == "title") {
		$BBS_Title = preg_replace($patternkey, "<font color=000000 style=background-color:FFF000;>$searchstring</font>", $BBS_Title);
	}

		if ($configBBS[board_category] && $bbs_row['category']) {
			$BBS_Title = "<span class='mr05'>[".$bbs_row['category']."]</span>" . $BBS_Title;
		}

	$bbs_name = $bbs_row[name];

	// 사진첩에서 공지기능 사용안됨
	$list_no = $letter_no;

	//카테고리 표시
	$category_name = "";
	if($board_category && $bbs_row[sub_no] > 0){
		for($i=0; $i < count($board_category); $i++) {
			if($bbs_row[sub_no] == $i+1)	$category_name = "<strong>[".$board_category[$i]."]</strong>";
		}
	}

	//리스트 & 내용보기 권한이 없을때 링크삭제
	if($SecAdmin != 1 && $configBBS[auth_list] && @strpos(",".$configBBS[auth_list], $bbs_authgroup) == false){
		$BBS_TitleLink = $BBS_Title." ".$newImg;
		$link_url = "javascript:alert('권한이 없습니다.');";
	}if($SecAdmin != 1 && $configBBS[auth_read] && @strpos(",".$configBBS[auth_read], $bbs_authgroup) == false){
		$BBS_TitleLink = $BBS_Title." ".$newImg;
		$link_url = "javascript:alert('권한이 없습니다.');";
	}else{
		$BBS_TitleLink2 = "<a href='".$PHP_SELF."?bbs=see&data=".$list_data."'><img src=\"$upImg\" width='126' height='105' id=\"photo\" onLoad=\"sizeModify(this);\" onClick=\"openImageWinCenter(this.src)\" style=\"cursor:hand;\"></a>";
		$BBS_TitleLink = $level_img."<a href='".$PHP_SELF."?bbs=see&data=".$list_data."'><span class='subbbs_title'>".$BBS_Title."</span> ".$newImg."</a>";
		global $TREE_NO, $DEPTH;
		$link_url = $PHP_SELF."?site_id=".TREE_ID."&TREE_NO=".$TREE_NO."&DEPTH=".$DEPTH."&bbs=see&data=".$list_data;
	}

	//$imageinfo = getimagesize($HOMEDIR."bbs/data/".$bbs_row[img1]);
	?>
		
			<li>
				<a href="<?=$link_url?>">
					<span class="image center-crop no-image">
						<img src="<?=$upImg?>" alt="<?=$BBS_Title?>" />
					</span>

					<strong class="title">
						<?=$BBS_Title?>
					</strong>
					<span class="date">
						<?=$writeday?>
					</span>
				</a>
			</li>
			<?
				$letter_no--;
			}//while
			}
			$Obj=new CList($PHP_SELF,$pagecnt,$offset,$numrows,$PAGEBLOCK,$LIMIT,$search,$searchstring,"MainCD=$MainCD&SubCD=$SubCD");
			?>
		</ul>
	</div>
	<p class="paging-navigation">
		<?echo $Obj->putList(true,"이전 페이지로 이동","다음 페이지로 이동");?>
	</p>
</div>

<!--<div class="btns-area">
    <div class="btns-right">
        <? BBSButtonLink($_BBS_Written, "글작성", "", "btn-m02 btns-color01"); ?>
    </div>
</div>-->