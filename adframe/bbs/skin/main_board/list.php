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
	<?
		$board_categorycnt = count($board_category)+1;
		if($board_categorycnt >= 6) $board_categorycnt = "6";
	?>
    <ul class="depth<?=$board_categorycnt?>">

    <?php
    $category_href = $PHP_SELF."?site_id=".TREE_ID."&TREE_NO=".$TREE_NO."&DEPTH=".$DEPTH;
    $category_option .= '<li';
    if($_REQUEST['category']=='') $category_option .= " class='active' ";
    $category_option .= '><a href="'.$category_href.'"';
    $category_option .= '>전체</a></li>';

    for ($i=0; $i<count($board_category); $i++) {
		$category_name = $board_category[$i];
		if($category_name=="코로나") $category_name="코로나-19대응";
        $category_option .= '<li';
        if ( $_REQUEST['category'] == $board_category[$i] ) $category_option .= " class='active' ";
        $category_option .= '><a href="'.($category_href."&amp;category=".urlencode($board_category[$i])).'"';
        $category_option .= '>'.$category_name.'</a></li>';
    }
    echo $category_option;
    ?>
    </ul>
</div>
<?
}
?>


<div class="board-area">
    <form name="searchForm" action="<?=$PHP_SELF?>?site_id=<?=TREE_ID?>&TREE_NO=<?=$TREE_NO?>&DEPTH=<?=$DEPTH?>" method="post" onSubmit="return searchSendit();">
        <fieldset>
            <legend class="blind">
                게시판 목록 검색
            </legend>
            <div class="search-wrapper">
                <div class="search-area">
                    <select name="search" title="검색 선택창">
                        <option value="title" <? if($search=="title") echo "selected"; ?>>제목</option>
                        <option value="name" <? if($search=="name") echo "selected"; ?>>내용</option>
                        <option value="content" <? if($search=="content") echo "selected"; ?>>제목 + 내용</option>
                    </select>

                    <div class="search-box">
                        <input type="hidden" name="category" value="<?=$_REQUEST['category']?>"/>
                        <input type="search" name="searchstring"  value="<?=$searchstring?>" title="검색어 입력">
                        <input type="submit" id="" name="" value="검색" class="btn-search">
                    </div>

                </div>
                <p class="total">
                    총 <strong><?=$numrows?></strong> 건의 자료가 있습니다.
                </p>
            </div>
        </fieldset>
    </form>

	<script>
		$(function() {
			var tempTitle1 = $(".contents-title").text().trim();
			var tempTitle2 = $(".tabmenu-wrapper ul li.active a").text().trim();
			if($(".board-list01 th").hasClass('writer') == true) {
				var captionTitle = tempTitle1 + " " + tempTitle2 + " 정보표 : 번호, 제목, 첨부, 작성자, 등록일, 조회에 관한 정보 제공표";
			} else {
				var captionTitle = tempTitle1 + " " + tempTitle2 + " 정보표 : 번호, 제목, 첨부, 등록일, 조회에 관한 정보 제공표";
			}

			$("caption").text(captionTitle);
		});
	</script>
    <div class="board-list01">
        <table>
            <caption></caption>
            <thead>
			<? if ($BoardKey!="2610") { ?>
            <tr>
                <th scope="col" class="number">
                    번호
                </th>
                <th scope="col" class="title">
                    제목
                </th>
                <th scope="col" class="file">
                    첨부
                </th>
                <th scope="col" class="writer">
                    작성자
                </th>
                <th scope="col" class="date">
                    등록일
                </th>
                <th scope="col" class="hit">
                    조회
                </th>
            </tr>
			<? } else if($BoardKey=="2610") { ?>
			<tr>
                <th scope="col" class="number">
                    번호
                </th>
                <th scope="col" class="title">
                    제목
                </th>
                <th scope="col" class="file">
                    첨부
                </th>
                <th scope="col" class="date">
                    등록일
                </th>
                <th scope="col" class="hit">
                    조회
                </th>
            </tr>
			<? } ?>
            </thead>
            <tbody>
            <?php
            $bbs_result = DBquery($bbs_qry);
            if ($numrows<1) {
            ?>
            <tr>
				<?
					if($BoardKey=="2610") {
						$colspan="5";
					} else {
						$colspan="6";
					}
				?>
                <td colspan="<?=$colspan?>">
                    등록된 정보가 없습니다.
                </td>
            </tr>
                <?php
            } else {
            // 게시판 출력 로직
            $s_letter=$letter_no; //페이지별 시작 글번호


            while($bbs_row=mysql_fetch_array($bbs_result))
            {

            $encode_str = "site_id=".$_GET['site_id']."&pagecnt=".$pagecnt."&idx=".$bbs_row[idx]."&letter_no=".$s_letter."&offset=".$offset;

            //$encode_str.= "&search=".$search."&searchstring=".$searchstring;
            $encode_str.= "&Boardkey=".$bbs_row[code]."&Sub_No=".$bbs_row[sub_no]."&DBTable=".$configBBS[board_id];
            if($_SERVER['REMOTE_ADDR']=="112.217.216.250"){
					//print_R($encode_str);
			}
            $list_data=Encode64($encode_str); //각 레코드 정보

            $writeday = explode("-",substr($bbs_row[writeday],0,11));
            $writeday = $writeday[0]."-".$writeday[1]."-".$writeday[2];

            // 첨부파일 존재 여부
            // 2016.07.15 첨부 파일 가져오는 필드를 변경.
            //$file_exists = $bbs_row[up_file_idx];
            $file_exists = $bbs_row[up_file];

            $patternkey = "/$searchstring/i";
            $BBS_Title  = StringCut($bbs_row[title],0,$configBBS[board_titlecut],'UTF-8','...');
            if(!empty($searchstring) && $search == "title") {
                $BBS_Title = preg_replace($patternkey, "<font color=000000 style=background-color:FFF000;>$searchstring</font>", $BBS_Title);
            }

            $bbs_name = StringCut($bbs_row[name],0,20,'UTF-8','');

            if($bbs_row[top_yn] == "Y") {
				if(TREE_ID=="global"){
					$list_no = "<img src='/assets/img/board/icon_notice@2x.png' class='icon-notice'/>";
				}else{
					$list_no = $letter_no;
				}
                $notice_class = "class='notice'";
            }
            else if ($dataArr[idx] == $bbs_row[idx] && $bbs == "see") {
                $list_no = "<img src='/bbs/skin/$configBBS[board_skin]/images/list_arrow_icon.gif'>";
                $notice_class = "";
            }
            else {
                $list_no = $letter_no;
                $notice_class = "";
            }

			//리스트 & 내용보기 권한이 없을때 링크삭제
            if($SecAdmin != 1 && $configBBS[auth_list] && @strpos(",".$configBBS[auth_list], $bbs_authgroup) == false){

                $BBS_TitleLink = $BBS_Title;
                $BBS_TitleLink .= "<div class=\"board-right-icon-wrapper\">".$newImg."</div>";
            }if($SecAdmin != 1 && $configBBS[auth_read] && @strpos(",".$configBBS[auth_read], $bbs_authgroup) == false){

                $BBS_TitleLink = $BBS_Title;
                $BBS_TitleLink .= "<div class=\"board-right-icon-wrapper\">".$newImg."</div>";
            }else{

                global $TREE_NO, $DEPTH;
                if($bbs_row['view_secret'] == "Y"){
                    if($SecAdmin == 1){
                        $BBS_TitleLink = $level_img."&nbsp;<a href='".$PHP_SELF."?site_id=".TREE_ID."&TREE_NO=".$TREE_NO."&DEPTH=".$DEPTH."&bbs=see&data=".$list_data."' >".$BBS_Title."</a>";
                    }else{
                        $BBS_TitleLink = $level_img."&nbsp;<a href='#' onclick=chk_secret('".$list_data."') >".$BBS_Title."</a>";
                    }
                    $BBS_TitleLink .= '<div class="board-right-icon-wrapper"><img src="/_common/img/board/icon_secret@2x.gif" alt="비밀글" class="icon-secret">'.$newImg.'</div>';
                }else{
                    $BBS_TitleLink = $level_img."&nbsp;<a href='".$PHP_SELF."?site_id=".TREE_ID."&TREE_NO=".$TREE_NO."&DEPTH=".$DEPTH."&bbs=see&data=".$list_data."' >".$BBS_Title."</a>";
                    $BBS_TitleLink .= "<div class=\"board-right-icon-wrapper\">".$newImg."</div>";
                }
                //  class="open-password-box"  // 비밀글일 경우, 비밀번호 입력창 보기위한 클래스명

            }
            ?>
			<tr <?=$notice_class?>>
				<td class="number">
					<?=$list_no?>
				</td>
				<td class="title left">
					<a href="<?=$PHP_SELF?>?site_id=<?=TREE_ID?>&TREE_NO=<?=$TREE_NO?>&DEPTH=<?=$DEPTH?>&bbs=see&letter_no=<?=$letter_no?>&data=<?=$list_data?>" >
						<span class="title-wrapper">
							<?
								if($bbs_row[re_level]>0){
							?>
								<span class="icon-reply">
									Re
								</span>
							<? } ?>
							<?
								if($bbs_row[top_yn] == "Y") {
							?>
							<span  class="mobile-icon-notice">
								공지
							</span>
							<? } ?>
							<? if($BoardKey=="2610" && $bbs_row[etc_char3]!="") echo "[".$bbs_row[etc_char3]."] " ?>
							<?=$bbs_row[title]?>
							<div class="board-right-icon-wrapper">
								<?
									if(BetweenPeriod($bbs_row[writeday],"1") > 0) {
								?>
								<img src="/_common/img02/board/icon_new01@2x.png" class='icon-new' alt='새글' />
								<? } ?>
								<?
									if($bbs_row['view_secret'] == "Y") {
								?>
								<img src="/_common/img02/board/icon_secret@2x.png" class='icon-new' alt='새글' />
								<? } ?>
							</div>
						</span>

						<span class="mobile-info">
							<span><? if($BoardKey!="2610") echo $bbs_name; ?></span>
							<span class="icon-bar"></span>
							<span><?=$writeday?></span>
							<span class="icon-bar"></span>
							<span><?=$bbs_row[readnum]?></span>
						</span>
					</a>
				</td>
				<td class="file">
					<?php
						if ($file_exists) {
                    ?>
                    <img src="/_common/img02/board/icon_download@2x.png" class="icon-file" alt="첨부파일">
					<?php
						}
					?>
				</td>
				<? if($BoardKey!="2610") { ?>
				<td class="writer">
					<?=$bbs_name?>
				</td>
				<? } ?>
				<td class="date">
					<?=$writeday?>
				</td>
				<td class="hit">
					<?=$bbs_row[readnum]?>
				</td>
			</tr>
            <?
                $letter_no--;
            }//while
            }
            ?>
            </tbody>
        </table>
    </div>

    <p class="paging-navigation">
        <?php
        $Obj=new CList($PHP_SELF,$pagecnt,$offset,$numrows,$PAGEBLOCK,$LIMIT,$search,$searchstring,"");
        echo $Obj->putList(true,"이전 페이지로 이동","다음 페이지로 이동");
        ?>
    </p>
</div>
<? if($TREE_NO=="16131" || $TREE_NO=="16134") {?>
<div class="btns-area">
    <div class="btns-right">
        <? BBSButtonLink($_BBS_Written, "글작성", "", "btn-m02 btns-color01");?>
    </div>
</div>
<? } ?>

<div class="mask-layerpopup" style="display: none;"></div>
<? include("../board/check_password.php");?>
