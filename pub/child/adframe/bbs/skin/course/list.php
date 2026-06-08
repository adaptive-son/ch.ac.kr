<div class="tabmenu-wrapper ratio"><!-- 탭 크기 동일한 비율로 작성할때 ratio 추가 -->
	<ul class="depth<?php if($numrows >= 6 ) echo "6"; else echo $numrows;?>">
		<?php
            $bbs_result = DBquery($bbs_qry);
			$selected_idx = ''; //선택된 게시글

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
				$i=0;
				while($bbs_row=mysql_fetch_array($bbs_result))
				{

					$site_id = $_GET['site_id'];
					$encode_str = "site_id=".$site_id."&pagecnt=".$pagecnt."&idx=".$bbs_row[idx]."&letter_no=".$s_letter."&offset=".$offset;
					$encode_str.= "&search=".$search."&searchstring=".urlencode($searchstring);
					$encode_str.= "&Boardkey=".$bbs_row[code]."&Sub_No=".$bbs_row[sub_no]."&DBTable=".$configBBS[board_id];
					$list_data=Encode64($encode_str); //각 레코드 정보

					$BBS_Title  = StringCut($bbs_row[title],0,$configBBS[board_titlecut],'UTF-8','...');

					$list_no = $letter_no;
					$BBS_TitleLink ="<li class='";
					if(empty($_GET['idx']) && $i==0){
						$BBS_TitleLink .="active";
					}else if($_GET['idx'] == $bbs_row[idx]){
						$BBS_TitleLink .="active";
					}
					$BBS_TitleLink .="'><a href='".$PHP_SELF."?site_id=".TREE_ID."&TREE_NO=".$TREE_NO."&DEPTH=".$DEPTH."&idx=".$bbs_row[idx]."' >".$BBS_Title."</a></li>";

					// 첨부파일 로딩 경로
					$pdf_path = BBS_LOAD_PATH;


					if(empty($_GET['idx']) && $i==0){
						$selected_idx = $bbs_row[idx];
					}else if(!empty($_GET['idx'])){
						$selected_idx = $_GET['idx'];
					}

				?>
					<?=$BBS_TitleLink?>
				<?
					$letter_no--;
					$i++;
				}//while

				// 첨부파일 조회

				$pdfQuery = "select * from ".$configBBS[board_id]."_file WHERE up_file_idx = (select up_file_idx from ".$configBBS[board_id]." where  idx = ".$selected_idx.")";
				$result = DBquery($pdfQuery);

			}
			?>
	</ul>
</div>
<?php
	for($i=0; $pdf_row=@mysql_fetch_array($result); $i++) {
		$encode_str = "Boardkey=".$BoardKey."&DBTable=".$configBBS[board_id]."&idx=".$pdf_row[idx]."&download=ok";
		$down_data=Encode64($encode_str);
?>
<?php if($TREE_NO !='16464' && $TREE_NO !='16465'){?>
<div class="btns-area pt0">
	<div class="btns-right">
		<a href="/adframe/bbs/download.php?data=<?=$down_data?>" class="btn-download type01 depth2" >
			<span>
				<strong>
					PDF 다운로드
				</strong>
				<img src="/_common/img/icon/icon_download01.png" alt="" />
			</span>
		</a>

		<a href="https://get.adobe.com/reader/?loc=kr" class="btn-download type02 depth2" target="_blank" title="새창 열림">
			<span>
				<strong>
					PDF 뷰어
				</strong>
				<img src="/_common/img/icon/icon_download01.png" alt="" />
			</span>
		</a>
	</div>
</div>
<?php } ?>
<!--<div class="contents-area">
	<iframe class="div-pdf" src="<?=$pdf_path."/".$pdf_row[up_filepath]?>" title="춘해보건대학교 - 간호학과"></iframe>
</div>-->

<!-- 모바일 호환되게 변경_21.08.24 shlee -->
<?
	//cyhwang 2022-07-28 춘해대 소스취약점 패치
	$pdfjsWebUri = urlencode($site_id.".ch.ac.kr".$pdf_path."/".$pdf_row[up_filepath]);
?>
<div class="contents-area">
	<iframe class="div-pdf" src="/pdfjs/web/viewer.html?file=https://<?=$pdfjsWebUri?>" title="춘해보건대학교 - 간호학과"></iframe>
</div>

<? } ?>
