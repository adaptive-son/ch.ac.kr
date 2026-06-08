
<?php
//카테고리
if($configBBS[board_category]){
?>
<div class="tabmenu-wrapper ratio mb30">
    <ul class="depth<?=count($board_category)?>">


    <?php
    $category_href = $PHP_SELF."?site_id=".TREE_ID."&TREE_NO=".$TREE_NO."&DEPTH=".$DEPTH;


    for ($i=0; $i<count($board_category); $i++) {
        $category_option .= '<li';
        if ( $_REQUEST['category'] == $board_category[$i]) 
			{$category_option .= " class='active' ";}
		else if ( $_REQUEST['category'] == '' && $i ==0) 
			{$category_option .= " class='active' ";}
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

<div class="fix">
	<?

			$bbs_result=DBquery($bbs_qry);
			$selected_category = ''; //선택된 게시글

			if($numrows<1) {
				?>
				<li> 등록된 정보가 없습니다. </li>
				<?
			}else{


			$s_letter=$letter_no; //페이지별 시작 글번호

			/*if ($_SERVER['REMOTE_ADDR']=="112.217.216.250"){ 

					
					//echo $bbs_qry."<br/>";
					$imgQuery = "select * from bbs_radi_file WHERE up_file_idx = '1599107593'";
					//$result = DBquery($imgQuery);
					$result = mysql_query($imgQuery)  or  print(mysql_error());
					echo $result."<br/>";
					print_r($result->num_rows);
			}*/

			while($bbs_row=mysql_fetch_array($bbs_result))
			{

			$site_id = $_GET['site_id'];
            $encode_str = "site_id=".$site_id."&pagecnt=".$pagecnt."&idx=".$bbs_row[idx]."&letter_no=".$s_letter."&offset=".$offset;
            $encode_str.= "&search=".$search."&searchstring=".urlencode($searchstring);
            $encode_str.= "&Boardkey=".$bbs_row[code]."&Sub_No=".$bbs_row[sub_no]."&DBTable=".$configBBS[board_id];

			//if ($_SERVER['REMOTE_ADDR']=="112.217.216.250") echo $encode_str;


			$list_data=Encode64($encode_str); //각 레코드 정보
			// 사진첩에서 공지기능 사용안됨
			$list_no = $letter_no;
			
			// 첨부파일 이미지 로딩 경로
			$img_path = BBS_LOAD_PATH;

			if($_GET['category'] == '' && $i==0){ 
				$selected_category = $bbs_row[category];
			} else if(!empty($_GET['category'])){
				$selected_category = $_GET['category'];
			}


			// 첨부파일 조회
			//if($bbs_row[up_file_idx] != '1599107593'){
			$imgQuery = "select * from ".$configBBS[board_id]."_file WHERE up_file_idx = '".$bbs_row[up_file_idx]."'";
			//$imgQuery = "select * from bbs_radi_file WHERE up_file_idx = '1599107593'";
			//if ($_SERVER['REMOTE_ADDR']=="112.217.216.250"){ echo $img_path.$imgQuery."<br/>"; }
			//$result = DBquery($imgQuery);
			$result = mysql_query($imgQuery) or die (mysql_error());
			if( !$result ) exit( "DB 오류 : ".mysql_error() );

			//if ($_SERVER['REMOTE_ADDR']=="112.217.216.250"){ print_r($result); }
			
			if ($_SERVER['REMOTE_ADDR']=="112.217.216.250"){ 
				//print_r(@mysql_fetch_array($result2));
				//echo "<img src='https://radi.ch.ac.kr/data/bbs_upload/upfile_data/2020-09/2020-09-03/1599107593c0e5704ffed5f575335636128620ef7f.jpg'/>";
			}

			for($i=0; $img_row=@mysql_fetch_array($result); $i++) {			
			?>

			<div class="company-wrap">
				<div class="company-box">
					<a href="<?=$bbs_row[etc_char2]?>" target="_blank" title="새창열림">
						<?//if($bbs_row[up_file_idx] != '1599107593'){?>
							<img src="<?=$img_path."/".$img_row[up_filepath]?>" alt="<?=$bbs_row[title]?>" />
						<?//} else{?>
							
						<?//}?>
					</a>
				</div>
				<strong>
					<?=$bbs_row[title]?>
				</strong>
			</div>
			<?
					}
					//}
					$letter_no--;
				}//while
            }
            ?>
	<p class="paging-navigation">
		<?php
		$Obj=new CList($PHP_SELF,$pagecnt,$offset,$numrows,$PAGEBLOCK,$LIMIT,$search,$searchstring,"");
		echo $Obj->putList(true,"이전 페이지로 이동","다음 페이지로 이동");
		?>
    </p>
</div>


<div class="btns-area">
    <div class="btns-right">
        <? if($SecAdmin == 1) BBSButtonLink($_BBS_Written, "글작성", "", "btn-m02 btns-color01"); ?>
    </div>
</div>




