
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
					<?
						//if($_SERVER['REMOTE_ADDR']=="112.217.216.250") echo $_SERVER["HTTP_HOST"].$PHP_SELF;
					?>
                </p>
            </div>
        </fieldset>
    </form>

    <div class="board-list01">
        <table>
            <caption></caption>
            <thead>
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
            </thead>
            <tbody>
            <?php
            $bbs_result = DBquery($bbs_qry);
            if ($numrows<1) {
            ?>
            <tr>
                <td colspan="6">
                    등록된 정보가 없습니다.
                </td>
            </tr>
                <?php
            } else {
            // 게시판 출력 로직
            $s_letter=$letter_no; //페이지별 시작 글번호


            while($bbs_row=mysql_fetch_array($bbs_result))
            {
			
            $encode_str = "site_id=".$site_id."&pagecnt=".$pagecnt."&idx=".$bbs_row[idx]."&letter_no=".$s_letter."&offset=".$offset;
            $encode_str.= "&search=".$search."&searchstring=".$searchstring;
            $encode_str.= "&Boardkey=".$bbs_row[code]."&Sub_No=".$bbs_row[sub_no]."&DBTable=".$configBBS[board_id];
            if($_SERVER['REMOTE_ADDR']=="112.217.216.250"){
                //print_r($bbs_row);
			}
            $list_data=Encode64($encode_str); //각 레코드 정보

            //새글이미지
            if(BetweenPeriod($bbs_row[writeday],"1") > 0) $newImg = "<img src='/_common/img/board/icon_new01@2x.gif' class='icon-new' alt='새글' />";
            else $newImg = "";

            $writeday = explode("-",substr($bbs_row[writeday],0,11));
            $writeday = $writeday[0]."-".$writeday[1]."-".$writeday[2];

            // 첨부파일 존재 여부
            // 2016.07.15 첨부 파일 가져오는 필드를 변경.
            //$file_exists = $bbs_row[up_file_idx];
            $file_exists = $bbs_row[up_file];

            if($bbs_row[re_level]>0){	//답변
                $wid=20*$bbs_row[re_level]; //레벨 이미지 길이
                $level_img = "<span class='icon-reply' style='margin-left:".$wid."px'>Re</span>";
            }else{
                $level_img = "";
            }

            $patternkey = "/$searchstring/i";
            $BBS_Title  = StringCut($bbs_row[title],0,$configBBS[board_titlecut],'UTF-8','...');
            if(!empty($searchstring) && $search == "title") {
                $BBS_Title = preg_replace($patternkey, "<font color=000000 style=background-color:FFF000;>$searchstring</font>", $BBS_Title);
            }

            /*if ($configBBS[board_category] && $bbs_row['category']) {
                $BBS_Title = "<span class='mr05'>[".$bbs_row['category']."]</span>" . $BBS_Title;
            }*/

            //$bbs_name = OnlyCut($bbs_row[name],20);
            $bbs_name = StringCut($bbs_row[name],0,20,'UTF-8','');

            //if($bbs_row[notice] == "Y") $list_no = "<img src='/bbs/skin/$configBBS[board_skin]/images/notice.gif' alt='공지사항' width='51' height='25'>";
            if($bbs_row[top_yn] == "Y") {
                $list_no = '<img src="/_common/img/board/icon_notice@2x.png" alt="공지사항" class="icon-notice">';
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
                    <?=$BBS_TitleLink?>
                    <? if($configBBS[board_commentuse]=="Y" && $bbs_row[comment_cnt]>0){?>
                        <span class="comment-count">(<?=$bbs_row[comment_cnt]?>)</span>
                    <?}?>
                </td>
                <td class="file">
                    <?php
						if ($file_exists) {
                    ?>
                    <img src="/_common/img/board/icon_download@2x.png" class="icon-file" alt="첨부파일">
					<?php
						}
					?>
                </td>
                <td class="writer">
                    <?=$bbs_name?>
                </td>
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

<div class="btns-area">
    <div class="btns-right">
        <? BBSButtonLink($_BBS_Written, "글작성", "", "btn-m02 btns-color01");?>
    </div>
</div>

<div class="mask-layerpopup" style="display: none;"></div>
<? include("../board/check_password.php");?>
