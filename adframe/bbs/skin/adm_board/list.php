<script type="text/javascript">
	$(document).ready(function(){

		//최상단 체크박스 클릭
		$("#chkall").click(function(){
			//클릭되었으면
			if($("#chkall").prop("checked")){
				//input태그의 name이 chk인 태그들을 찾아서 checked옵션을 true로 정의
				$("input[name='chk[]']").prop("checked",true);
				//클릭이 안되있으면
			}else{
				//input태그의 name이 chk인 태그들을 찾아서 checked옵션을 false로 정의
				$("input[name='chk[]']").prop("checked",false);
			}
		})

		//선택삭제 버튼
		$("#btn-del").click(function() {
			var cnt = 0;
			$("input[name='chk[]']").each(function() {
				var checked = $(this).is(':checked');
				if (checked==true) {
					cnt = cnt+1;
				}
			});
			if(cnt==0){
				alert("삭제할 게시물을 하나 이상 선택하세요.");
				return false;
			}
			$("#frm").submit();
		});
	});
</script>
	<h2 class="title0201">
        <?=$configBBS['board_name']?>
    </h2>

<div class="board-search-area">
    <form action="<?=$PHP_SELF?>" method="POST" onsubmit="return searchSendit();">
        <fieldset>
            <legend class="blind">
                게시판 목록 검색
            </legend>
            <div class="board-search-area">
                <p class="total">
                    총 <strong><?=$numrows?></strong> 건
                </p>
                <div class="board-search-box">
                    <?php
                    //카테고리
                    if($configBBS[board_category]){
                        for ( $i = 0 ; $i < 0 ; $i++ ) {
                            $category_list .= "<option value='".$board_category[$i]."' ";
                            if ( $_REQUEST['category'] == $board_category[$i] ) $category_list .= " selected ";
                            $category_list .= " > ".$board_category[$i]." </option>";
                        }
                    ?>
                        <select name="category">
                            <option value="">전체</option>
                            <?=$category_list?>
                        </select>
                    <?}?>
                        <select name="search">
                            <?
                            $arr_searchOption = array("title"=>"제목", "name"=>"내용", "content"=>"제목 + 내용");
                            foreach ( $arr_searchOption as $k => $v ) {
                            ?>
                            <option value="<?=$k?>">
                                <?=$v?>
                            </option>
                            <? } ?>
                        </select>
                            <input type="text" name="searchstring" value="<?=$searchstring?>" title="검색어 입력" />
                            <input type="submit" class="btn-search"  value="검색"/>
                </div>
            </div>
        </fieldset>
    </form>
	<div class="btns-area">
		<div class="btns-right">
			<button class="btn-s btn-type01" type="button" id="btn-del">선택삭제</button>
		</div>
	</div>
	<form name="frm" id="frm" method="POST" action="/adframe/bbs/delete.php?board_id=<?=$configBBS[board_id]?>">
	<input type="hidden" name="data" value="<?=$data?>">
    <div class="board-list">
        <table style="width: 100%">
			<? if($BoardKey!="2610") { ?>
            <colgroup>
                <col style="width: 8%" />
				<col style="width: 8%" />
                <col style="width: auto" />
                <col style="width: 8%" />
                <col style="width: 12%" />
                <col style="width: 12%" />
                <col style="width: 10%" />
            </colgroup>
            <tbody>
            <thead>
            <tr>
				<th>
					<input type="checkbox" name="chkall" id="chkall" value="" >
				</th>
                <th class="number" scope="col">
                    번호
                </th>
                <th class="title" scope="col">
                    제목
                </th>
                <th class="file" scope="col">
                    첨부파일
                </th>
                <th class="writer" scope="col">
                    작성자
                </th>
                <th class="date" scope="col">
                    등록일
                </th>
                <th class="hit" scope="col">
                    조회
                </th>
            </tr>
            </thead>
			<? } else if($BoardKey=="2610") {?>
			<colgroup>
                <col style="width: 8%" />
				<col style="width: 8%" />
                <col style="width: auto" />
                <col style="width: 8%" />
                <col style="width: 12%" />
                <col style="width: 10%" />
            </colgroup>
            <tbody>
            <thead>
            <tr>
				<th>
					<input type="checkbox" name="chkall" id="chkall" value="" >
				</th>
                <th class="number" scope="col">
                    번호
                </th>
                <th class="title" scope="col">
                    제목
                </th>
                <th class="file" scope="col">
                    첨부파일
                </th>
                <th class="date" scope="col">
                    등록일
                </th>
                <th class="hit" scope="col">
                    조회
                </th>
            </tr>
            </thead>
			<? } ?>

            <?
			//echo $bbs_qry;
            $bbs_result = DBquery($bbs_qry);
            if ( $numrows < 1 ) {
            ?>
            <tr>
                <td colspan="7">
                    등록된 정보가 없습니다.
                </td>
            </tr>
            <?
            } else {
                $s_letter=$letter_no; //페이지별 시작 글번호

				$orgSearchstring = $searchstring;

                while ( $bbs_row = mysql_fetch_array($bbs_result) ) {

									$list_data = "";




                $encode_str = "pagecnt=".$pagecnt."&idx=".$bbs_row[idx]."&letter_no=".$s_letter."&offset=".$offset;
                $encode_str.= "&search=".$search;

								if($searchstring){

									if(preg_match("/[\xA1-\xFE][\xA1-\xFE]/", $orgSearchstring)) {
										$searchstring = rawurlencode($orgSearchstring);
										$encode_str.= "&searchstring=".$searchstring."&urlgubun=ko";;
									}else{
										$encode_str.= "&searchstring=".$searchstring."&urlgubun=";
									}


								}
                $encode_str.= "&Boardkey=".$bbs_row[code]."&Sub_No=".$bbs_row[sub_no]."&DBTable=".$configBBS[board_id];

								if($_SERVER["REMOTE_ADDR"] == "112.217.216.250"){
									if(preg_match("/[\xA1-\xFE][\xA1-\xFE]/", $orgSearchstring)) {
										//echo $encode_str."<br>";
									}

								}
                $list_data = Encode64($encode_str); //각 레코드 정보

                //새글이미지
                if(BetweenPeriod($bbs_row[writeday],"1") > 0) $newImg = "<img src = '/adframe/mng/make_img/board/icon_new.gif' alt='새글' class='board-icon' />";
                else $newImg = "";

                $writeday = explode("-",substr($bbs_row[writeday],0,11));
                $writeday = $writeday[0]."-".$writeday[1]."-".$writeday[2];

                // 첨부파일 존재 여부
                $file_exists = $bbs_row[up_file];

                if($bbs_row[re_level]>0){	//답변
                        $wid=5*$bbs_row[re_level]; //레벨 이미지 길이
                        $level_img = "<span class='icon-reply' style='margin-left:".$wid."px'>Re</span>";
                }else{
                        $level_img = "";
                }

                // 검색어 치환
                $patternkey = "/$searchstring/i";
                $BBS_Title  = StringCut($bbs_row[title],0,$configBBS[board_titlecut],'UTF-8','...');

                if ($configBBS[board_category] && $bbs_row['category']) {
                    $BBS_Title = "<span class='mr05'>[".$bbs_row['category']."]</span>" . $BBS_Title;
                }


                if(!empty($searchstring) && $search == "title") {
                    $BBS_Title = preg_replace($patternkey, "<font color='000000' style='background-color:FFF000;'>$searchstring</font>", $BBS_Title);
                }
                $bbs_name = StringCut($bbs_row[name],0,20,'UTF-8','');

                // 공지사항
                if($bbs_row[top_yn] == "Y") {
                    $list_no = '<span class="icon-notice">공지</span>';
                    $notice_class = "class='notice'";
                }
                // 답글이미지
                else if ($dataArr[idx] == $bbs_row[idx] && $bbs == "see") {
                    /*
                     *
                    // Todo : 답글 사용 확인 후 적용
                    $list_no = "<img src='/bbs/skin/$configBBS[board_skin]/images/list_arrow_icon.gif'>";
                    $notice_class = "";
                    */
                } else {
                    $list_no = $letter_no;
                    $notice_class = "";
                }

                //리스트 & 내용보기 권한이 없을때 링크삭제
                if($SecAdmin != 1 && $configBBS[auth_list] && @strpos(",".$configBBS[auth_list], $bbs_authgroup) == false){
                    $BBS_TitleLink = $BBS_Title." ".$newImg;
                }if($SecAdmin != 1 && $configBBS[auth_read] && @strpos(",".$configBBS[auth_read], $bbs_authgroup) == false){
                    $BBS_TitleLink = $BBS_Title." ".$newImg;
                }else{
                    $BBS_TitleLink = $level_img."&nbsp;<a href='".$PHP_SELF."?bbs=see&data=".$list_data."' >".$BBS_Title." ".$newImg."</a>";
                }
            ?>
            <tr <?if($bbs_row[notice] == "Y") echo " class='notice'"?>>
				<td>
					<input type="checkbox" name="chk[]" value="<?=$bbs_row['idx']?>">
					<input type="hidden" name="idx[]" value="<?=$bbs_row['idx']?>">
				</td>
                <td class="num">
                    <?=$list_no?>
                </td>
                <td class="title left">
					<?
						if($BoardKey=="2610" && $bbs_row[etc_char3]!="") echo "[".$bbs_row[etc_char3]."]" ;
					?>
                    <?=$BBS_TitleLink?>
                    <? if($configBBS[board_commentuse]=="Y" && $bbs_row[comment_cnt]>0){?>
                        <span class="comment-count">(<?=$bbs_row[comment_cnt]?>)</span>
                    <?}?>


                    <!--
                    <img src="../img/board/icon_secret.png" alt="비밀글" />
                    -->
                </td>
                <td>
                    <?php
                    if ($file_exists) {
                        ?>
                        <img src="/adframe/mng/make_img/board/icon_file.gif" class="board_icon" alt="첨부파일" />
                        <?php
                    }
                    ?>
                </td>
				<? if($BoardKey!="2610") { ?>
                <td>
                    <?=$bbs_row[name]?>
                </td>
				<? } ?>
                <td>
                    <?=$writeday?>
                </td>
                <td>
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
	</form>

    <p class="paging-navigation">
        <?php
        $Obj=new CList($PHP_SELF,$pagecnt,$offset,$numrows,$PAGEBLOCK,$LIMIT,$search,$searchstring,"");
        echo $Obj->putList(true,"이전 페이지로 이동","다음 페이지로 이동");
        ?>
    </p>
</div>

<?
// 관리자페이지에서만 버튼 보이기
if ( preg_match("|adframe|", $PHP_SELF) > 0 ) {
?>
<div class="btns-area">
    <div class="btns-right">
        <? BBSButtonLink($_BBS_Written, "글작성", "", "btn-type01"); ?>
    </div>
</div>
<? } ?>
