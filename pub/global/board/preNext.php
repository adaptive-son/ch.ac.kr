
<div class="preview-next">


    <? if(!empty($Prev)){
		$encode_str = "idx=".$Prev[idx]."";
		$list_data=Encode64($encode_str); //각 레코드 정보
		/* 대표 홈페이지 오픈 하면 해당영역 지우기 */
		/*if(TREE_ID=="main") {
			$href_link="/board/board.php?site_id=".TREE_ID."&TREE_NO=".$TREE_NO."&DEPTH=".$DEPTH."&bbs=see&data=".$list_data."";
		} else if (TREE_ID!="main" && TREE_ID!="" && $TREE_NO!="" && $DEPTH!="") {
			$href_link="/board/board.php?site_id=".TREE_ID."&TREE_NO=".$TREE_NO."&DEPTH=".$DEPTH."&bbs=see&data=".$list_data."";
		} else if ($TREE_NO=="" && $DEPTH=="") {
			$href_link="/history/history_photo.php?bbs=see&data=".$list_data."";
		}*/
		/* --대표 홈페이지 오픈 하면 해당영역 지우기-- */
		if ($TREE_NO=="" && $DEPTH=="") {
			$href_link="/history/history_photo.php?bbs=see&data=".$list_data."";
		} else {
			$href_link="/board/board.php?site_id=".TREE_ID."&TREE_NO=".$TREE_NO."&DEPTH=".$DEPTH."&bbs=see&data=".$list_data."";
		}
        $prev_name=$Prev['title'];
    }else{
        $href_link="#";
        $prev_name="이전글이 없습니다.";
    }
    ?>
    <a href="<?=$href_link?>" class="line">
        <dl>
            <dt class="preview">이전글</dt>
            <dd><?=$prev_name?></dd>
        </dl>
    </a>


    <? if(!empty($Next)){
		$encode_str = "idx=".$Next[idx]."";
		$list_data=Encode64($encode_str); //각 레코드 정보
		/* 대표 홈페이지 오픈 하면 해당영역 지우기 */
		/*if(TREE_ID=="main") {
			$href_link="/board/board.php?site_id=".TREE_ID."&TREE_NO=".$TREE_NO."&DEPTH=".$DEPTH."&bbs=see&data=".$list_data."";
		} else if (TREE_ID!="main" && TREE_ID!="" && $TREE_NO!="" && $DEPTH!="") {
			$href_link="/board/board.php?site_id=".TREE_ID."&TREE_NO=".$TREE_NO."&DEPTH=".$DEPTH."&bbs=see&data=".$list_data."";
		} else if ($TREE_NO=="" && $DEPTH=="") {
			$href_link="/history/history_photo.php?bbs=see&data=".$list_data."";
		}*/
		/* --대표 홈페이지 오픈 하면 해당영역 지우기-- */
		
		if ($TREE_NO=="" && $DEPTH=="") {
			$href_link="/history/history_photo.php?bbs=see&data=".$list_data."";
		} else {
			$href_link="/board/board.php?site_id=".TREE_ID."&TREE_NO=".$TREE_NO."&DEPTH=".$DEPTH."&bbs=see&data=".$list_data."";
		}
        $next_name=$Next['title'];
    }else{
        $href_link="#";
        $next_name="다음글이 없습니다.";
    }
    ?>
    <a href="<?=$href_link?>">
        <dl>
            <dt class="next">
                다음글
            </dt>
            <dd>
                <?=$next_name?>
            </dd>
        </dl>
    </a>
</div>
