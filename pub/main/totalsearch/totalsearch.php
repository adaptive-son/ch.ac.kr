<!doctype html>
<html lang="ko">
	<?
// 개별 페이지 실행 방지. 해당 문자열은 inc.constant.php에 정의된다.
define("__AF__", TRUE);
// adframe 템플릿 페이지 설정.
include($_SERVER["DOCUMENT_ROOT"] . "/adframe/af_common.php");
require_once (ADFRAME_ROOT_PATH."/lib/class_bbs.php");
?>
	<head>
		<? include "../include/meta.php" ?>
		<title>
			통합검색 &lt; 춘해보건대학교
		</title>
	</head>

	<body>

		<!-- popup -->
		<? include("../../_common/top_popup.php");?>
		<!-- //popup -->

		<!-- quick menu -->
		<? include "../include/quickmenu.php" ?>
		<!-- //quick menu -->
		<!-- wrapper -->
		<div class="wrapper" id="wrapper">
			<!-- header -->
			<header>
				<? include "../include/header.php" ?>
			</header>
			<!-- //header -->

			<!-- sub visual -->
			<? include "./sub_visual.php" ?>
			<!-- //sub visual -->

			<!-- container -->
			<?
			if(!$_POST['keyword']){
			$keyword = $_POST['top-search-form'];
			}else {
			$keyword = $_POST['keyword'];
			}

			if(!$_POST['keyword'] && !$_POST['top-search-form']){
			$keyword = urldecode($_GET['keyword']);
			}

			if($type == ""){$type = "all";}
			if($type == "all"){$type_name = "전체";}
			else if($type == "board"){$type_name = "게시판";}
			else if($type == "contents"){$type_name = "메뉴";}


			/** 게시판 **/
			$row['board_id'] = "bbs_main";

			$search_table = $board_table = $row['board_id'];

			$board_id_[$num] = $row['board_id'];

			$sql_search = "select * from $search_table where title like '%$keyword%' or content like '%$keyword%' order by idx desc";

			$search_result = DBquery($sql_search);
			$search_board_count = @mysql_num_rows($search_result);

			/** 게시판 끝 **/

			/** 메뉴 **/
			//$sql_search_contents = "select * from xboard_board_bistgall where TITLE like '%$keyword%' or CONTENTS like '%$keyword%' order by BOARD_NO desc";

			$sql_search_contents = "select * from af_tree where TREE_ID='main' and (NAME like '%$keyword%' OR CONTENTS like '%$keyword%')";
			$search_contents_result = DBquery($sql_search_contents);
			$search_contents_count = @mysql_num_rows($search_contents_result);

			/** 메뉴 끝 **/

			$search_count = $search_board_count + $search_contents_count;

			$p = $p;
			if($p == '') $p = 1;
			$pagerow = 10;

			$s = ($p - 1) * $pagerow;
			?>
			<section>
				<div class="container" id="container">
					<!-- contents navigation, content options -->
					<? include "../include/contents_navigation.php" ?>
					<!-- contents navigation, content options -->

					<div class="container-wrapper">

						<div class="lnb-wrapper">
							<div class="lnb-area">
								<? include "../include/lnb01.php" ?>
							</div>
						</div>
						<!-- contents  -->
						<article>
							<div class="contents" id="contents">


								<h3 class="contents-title">
									통합검색<?=$site_id;?>
									<span class="arrow"></span>
								</h3>

								<div class="contents-wrapper">
									<!-- CMS 시작 -->

									<div class="tabmenu-wrapper ratio no-mobile-title">
										<ul class="depth3">
											<li <?php if($type=="all"){?>class="active"<?php } ?>>
												<a href="/totalsearch/totalsearch.php?type=all&keyword=<?=$keyword?>" id="tabmenu1">
													전체
												</a>
											</li>
											<li <?php if($type=="board"){?>class="active"<?php } ?>>
												<a href="/totalsearch/totalsearch.php?type=board&keyword=<?=$keyword?>" id="tabmenu2">
													게시판
												</a>
											</li>
											<li <?php if($type=="contents"){?>class="active"<?php } ?>>
												<a href="/totalsearch/totalsearch.php?type=contents&keyword=<?=$keyword?>" id="tabmenu3">
													메뉴
												</a>
											</li>
										</ul>
									</div>



						<div class="totalsearch-wrapper">
							<div class="form-search-wrapper">
								<form action="" method="">
									<fieldset>
										<div class="form-search-area">
											<label for="totalsearch">
												<img src="../img02/icon/icon_search05.png" alt="" />
											</label>
											<input type="text" id="keyword" name="keyword" value="<?=$keyword?>" title="검색할 내용을 입력하세요." />
											<button type="button">
												검색
											</button>
										</div>
									</fieldset>
								</form>
							</div>


							<div class="totalsearch-list">
								<? 
								if($type == "all"){$what_count='search_count';}
								else if($type == "board"){$what_count='search_board_count';}
								else if($type == "contents"){$what_count='search_contents_count';}
								if($$what_count > 0) {?>
								<div class="title-area">
									<h4>
										통합검색결과
									</h4>

									<p class="word-result">
										<strong class="word-keyword">‘<?=$keyword?>’</strong> 에 대한 <?=$type_name?> <strong class="word-total">총 <?=$$what_count?>건</strong> 입니다.
									</p>
								</div>
								<? } else { ?>
								<div class="title-area">
									<h4>
										통합검색결과
									</h4>

									<p class="word-result">
										<strong class="word-keyword">‘<?=$keyword?>’</strong> 에 대한 <?=$type_name?> 결과가 없습니다.
									</p>
								</div>
								<? } ?>


								<div class="totalsearch-area">
									<? if($search_board_count > 0 && ($type=="all" || $type=="board")) {?>
									<? if($type == "all"){ ?>
									<h5 class="title-type02">
										게시판
									</h5>
									<? } ?>
									<?
									$count_limit = 0;
									$limit = 10;


									while ($row_board = mysql_fetch_array($search_result)) {	
										if($count_limit < $limit){
											$content = cut_str(strip_tags_attributes($row_board['content']),300);	

											$sql_cat = "select TREE_NO, NAME, PARENT, DEPTH from af_tree where TREE_ID='main' and CONTENTS='{$row_board['code']}'";
											$result_cat = DBquery($sql_cat);
											$row_cat = mysql_fetch_array($result_cat);
											$cat_parent = $row_cat['PARENT'];

											$sql_sub1 = "select TREE_NO, NAME, PARENT, DEPTH from af_tree where TREE_NO = $cat_parent";
											if($row_cat['DEPTH'] == 3){
												$sql_sub2 = "select TREE_NO, NAME, PARENT from af_tree where TREE_NO = (select PARENT from af_tree where TREE_NO = $cat_parent)"; 

												$result_sub2 = DBquery($sql_sub2);
												$row_sub2 = mysql_fetch_array($result_sub2);
												$sub_name2 = $row_sub2['NAME'];
											}
												$result_sub1 = DBquery($sql_sub1);
												$row_sub1 = mysql_fetch_array($result_sub1);
												$sub_name1 = $row_sub1['NAME'];

											if($type != "all"){
												$limit = $search_board_count;
											}
											$encode_str = "site_id=main&pagecnt=".$pagecnt."&idx=".$row_board['idx']."&Boardkey=".$row_board['code']."&DBTable=bbs_main";
											$list_data=Encode64($encode_str); //각 레코드 정보

											$list[] = array(
												'board_id_'	=> 'bbs_main',
												'menu_'		=> $row_cat['TREE_NO'],
												'depth' => $row_cat['DEPTH']+1,
												'no_'		=> $row_board['idx'],
												'title_'	=> $row_board['title'],
												'date_'		=>  substr($row_board['writeday'],0,10),
												'content_'	=> $content,
												'sub_name2'	=> $sub_name2,
												'sub_name1'	=> $sub_name1,
												'cat_name'	=> $row_cat['NAME'],
												'list_data' => $list_data,
											);

										}
										$count_limit++;			
									}



									for($i = $s; $i < $s + $pagerow; $i++){
									if($list[$i]){
									?>
									<div class="totalsearch-box">
										<a href="/board/board.php?site_id=main&TREE_NO=<?=$list[$i]['menu_']?>&DEPTH=<?php echo $list[$i]['depth']?>&bbs=see&letter_no=<?=$list[$i]['no_']?>&data=<?php echo $list[$i]['list_data']?>">
											<strong class="title-wrapper">
												<span class="title">
													<?=$list[$i]['title_']?>
												</span>
												<span class="date">
													<?=$list[$i]['date_']?>
												</span>
											</strong>
											<span class="substance">
												<?=str_replace($keyword,"<strong style='color:red;'>".$keyword."</strong>",$list[$i]['content_'])?>
											</span>

											<span class="category">
												<?if($list[$i]['sub_name2']){echo $list[$i]['sub_name2']." &gt; ";}?><?=$list[$i]['sub_name1']?> &gt; <?=$list[$i]['cat_name']?>
											</span>
										</a>
									</div>	
									<?
									}
									}

									?>
										<!-- 페이징 처리 -->
								<?
								$get_arg = 'menu='.$_GET['menu'].'&type='.$_GET['type'] . '&keyword=' . urlencode($_GET['keyword']) . '&p=' . $_GET['p'] .'&child=' .$child;
								//echo $get_arg;
								//?menu=285&type=board&menu=285&child=288&keyword=%EC%9E%A5%ED%95%99

								$page_info = array(
									'url'		=> 'totalsearch.php',
									'total_row'	=> $search_board_count,
									'p'			=> $p,
									'row_num'	=> $pagerow,
									'page'		=> 10,
									'param'		=> $get_arg,
									'info'		=> 'search'
								);


								$paging = pageLink($page_info);
								//print_r($paging);
								$tplAssign['page'] = $paging;
								//print_r($paging);
								//print_r($paging);

								?>
								<!-- 페이징 네비게이션 시작 -->
								<? if($type != "all"){ ?>
								<p class="paging-navigation">
									<?php if($paging["prev"]!=''){?><a href="<?php echo $paging["prev"]?>" class="btn-first">맨 처음 페이지로 이동</a><?php }?>
									<?php if($paging["back"]!=''){?><a href="<?php echo $paging["back"]?>" class="btn-preview">이전 페이지로 이동</a><?php }?>
									<?
									for($i=0; $i<count($paging['link']); $i++){
									if($paging['link'][$i]['get'] == ""){
									?>
									<strong><?=$paging['link'][$i]['p']?></strong>
									<?
									}else{
									?>
									<a href="<?=$paging['link'][$i]['get']?>"><?=$paging['link'][$i]['p']?></a>
									<?
									}
									}
									?>
									<?php if($paging["go"]!=''){?><a href="<?php echo $paging["go"]?>" class="btn-next" style="margin-left: 20px">다음 페이지로 이동</a><?php }?>
									<?php if($paging["next"]!=''){?><a href="<?php echo $paging["next"]?>" class="btn-last">맨 마지막 페이지로 이동</a><?php }?>
								</p>
								<? } ?>
								<!-- 페이징 네비게이션 끝// -->
								<!-- 페이징 처리 끝 -->
								</div>
								<? } ?>

								<!-- 컨텐츠 -->
								<? if($search_contents_count > 0 && ($type=="all" || $type=="contents")) {?>
								<div class="totalsearch-area mt20">
									<? if($type == "all"){ ?>
									<h5 class="title-type02">
										메뉴
									</h5>
									<? } ?>

									<? 
									$count_limit = 0;
									$limit = 4;
									while ($row_contents = mysql_fetch_array($search_contents_result)) { 

										if($count_limit < $limit){
											$contents_list[] = array(
												'no_'		=> $row_contents['TREE_NO'],
												'depth'=> $row_contents['DEPTH']+1,	
												'cms_name_'=> $row_contents['NAME'],			
												'cms_text1_' => $row_contents['CONTENTS']
											); 
											if($type != "all"){
												$limit = $search_contents_count;
											}
										}
									$count_limit++;
									}
									?>
									<ul class="ul-list01">
									<? 

									for($i = $s; $i < $s + $pagerow; $i++){
										if($contents_list[$i]){
									?>
										<li>
											<a href="/contents/contents_view.php?site_id=main&TREE_NO=<?=$contents_list[$i]['no_']?>&DEPTH=<?php echo $contents_list[$i]['depth']?>">
												<?=$contents_list[$i]['cms_name_']?>
											</a>
										</li>
									<? } }	?>
									</ul>
								</div>
								<!-- 페이징 처리 -->
								<?
								$get_arg = 'menu='.$_GET['menu'].'&type='.$_GET['type'] . '&keyword=' . urlencode($_GET['keyword']) . '&p=' . $_GET['p'] .'&child=' .$child;
								//echo $get_arg;
								//?menu=285&type=board&menu=285&child=288&keyword=%EC%9E%A5%ED%95%99

								$page_info = array(
									'url'		=> 'totalsearch.php',
									'total_row'	=> $search_contents_count,
									'p'			=> $p,
									'row_num'	=> $pagerow,
									'page'		=> 10,
									'param'		=> $get_arg,
									'info'		=> 'search'
								);


								$paging = pageLink($page_info);
								//print_r($paging);
								$tplAssign['page'] = $paging;
								//print_r($paging);
								//print_r($paging);

								?>
								<!-- 페이징 네비게이션 시작 -->
								<? if($type != "all"){ ?>
								<p class="paging-navigation">
									<?php if($paging["prev"]!=''){?><a href="<?php echo $paging["prev"]?>" class="btn-first">맨 처음 페이지로 이동</a><?php }?>
									<?php if($paging["back"]!=''){?><a href="<?php echo $paging["back"]?>" class="btn-preview">이전 페이지로 이동</a><?php }?>
									<?
									for($i=0; $i<count($paging['link']); $i++){
									if($paging['link'][$i]['get'] == ""){
									?>
									<strong><?=$paging['link'][$i]['p']?></strong>
									<?
									}else{
									?>
									<a href="<?=$paging['link'][$i]['get']?>"><?=$paging['link'][$i]['p']?></a>
									<?
									}
									}
									?>
									<?php if($paging["go"]!=''){?><a href="<?php echo $paging["go"]?>" class="btn-next" style="margin-left: 20px">다음 페이지로 이동</a><?php }?>
									<?php if($paging["next"]!=''){?><a href="<?php echo $paging["next"]?>" class="btn-last">맨 마지막 페이지로 이동</a><?php }?>
								</p>
								<? } ?>
								<!-- 페이징 네비게이션 끝// -->
								<!-- 페이징 처리 끝 -->

							</div>
							<? } ?>
						</div>
					</div>


					<!-- //CMS 끝 -->
				</div>

				<!-- 담당자 -->
				<? /*include "../include/manager_information.php"*/ ?>
				<!-- //담당자 -->
				</div>
			</article>
		<!-- //contents  -->
		</div>

	</div>
</section>
<!-- //container -->

<!-- footer -->
<footer>
	<? include "../include/footer.php" ?>
</footer>
<!-- //footer -->
</div>
<!-- //wrapper -->
<script>
	menuOn(0, 0, 0);
</script>
</body>

</html>