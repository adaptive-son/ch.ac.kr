<?
// 날짜 -> 요일변경 
// data type = date ( 0000-00-00 )
// return 요일명
function date_to_day($date) {
	$exp = explode("-", $date);
	$day = date("w", mktime(0, 0, 0, $exp[2], $exp[1], $exp[0]));
	$arr_week = array("일", "월", "화", "수", "목", "금", "토");
	return $arr_week[$day];
}
?>
<!doctype html>
<html lang="ko">
<head>
	<?
    if($TREE_ID=="") $TREE_ID = $_GET['site_id'];
    define(TREE_ID,$TREE_ID);
    include("../".$TREE_ID."/include/meta.php");
    if ( $TREE_NO == "" || !$TREE_NO ) go_back("페이지를 찾을 수 없습니다.");
	else {
        $sql_infoContents = " SELECT * FROM ".TABLE_CMS_CONTENTS." WHERE TREE_ID = '".TREE_ID."' AND TREE_NO = '".$TREE_NO."' ORDER BY SORT ASC ";
        $rs_infoContents = $adb->getRow($sql_infoContents, DB_FETCHMODE_ASSOC);
    }
    ?>
	
    <title><?=$PAGENAME4.$PAGENAME3.$PAGENAME2.$PAGENAME1._TAG_TITLE?></title>
</head>

<body> 
	<!-- skip navigation -->
	<p class="skip-navigation">
		<a href="#contents">본문 바로가기</a>
	</p>
	<!-- //skip navigation -->	

	<!-- wrapper -->
	<div class="wrapper" id="wrapper">	
		<!-- header -->
		<? include("../".$TREE_ID."/include/header.php");?>
		<!-- //header -->

	<!-- quick menu -->
	<? 
		if($TREE_ID=="main") {
	?>
			<div class="aside-quickmenu-wrapper" id="public-quickmenu">
				<button>
					<span>
						QUICK<br />
						MENU
					</span>

					<img src="/_common/img02/quickmenu/icon_arrow01.png" alt="" />
				</button>

				<!-- 퀵메뉴는 추후 학과들에게도 큇메뉴가 추가된다고 하여 assets쪽에 작업을 하였습니다 -->
				<? include "../_common/quickmenu.php" ?>
				<!-- //퀵메뉴는 추후 학과들에게도 큇메뉴가 추가된다고 하여 assets쪽에 작업을 하였습니다 -->
			</div>
	<? } ?>
	<!-- //quick menu -->

		<!-- sub visual -->
		<? include("../".$TREE_ID."/include/sub_visual.php"); ?>
		<!-- sub visual -->


		<!-- container -->
		<section>
			<div class="container" id="container">

				<!-- contents_navi -->
				<? include("../".$TREE_ID."/include/contents_navi.php");?>
				<!-- //contents_navi -->	

				<div class="container-wrapper">
					 <!-- lnb -->
					<? include("../".$TREE_ID."/include/lnb.php");?>
					<!-- //lnb -->			
					<!-- contents  -->
					<article>
						<div class="contents" id="contents">
							<h3 class="contents-title">
								학사일정
								<span class="arrow"></span>
							</h3>

							<div class="contents-wrapper">
							<?
							$targetYear = $_GET['targetYear'];
							if ( $targetYear == "" || !$targetYear ) $targetYear = date("Y");

							// 기간 설정
							$qry_BeginDay = $targetYear."-01-01";
							$qry_EndDay = $targetYear."-12-31";

							$targetYear_href = $PHP_SELF."?site_id=".TREE_ID."&TREE_NO=".$TREE_NO."&DEPTH=".$DEPTH;

							//시작일자가 같더라도 종료일자가 이전이 먼저 노출됨
							//학과 홈페이지 학과 일정은 대표 일정과 학과 일정이 같이 노출됨 -20.11.02 shlee
							//대표 홈페이지 일정은 대표 일정만 노출됨 -20.11.02 shlee
							if ($site_id!="main") {
								$sql = " SELECT * FROM ".TABLE_SCHEDULE." WHERE del_yn='N' AND site_id='".$site_id."' OR site_id='main' AND schedule_start_date BETWEEN '".$qry_BeginDay."' AND '".$qry_EndDay."' ORDER BY schedule_start_date, schedule_end_date ";
							} else if ($site_id=="main") {
								$sql = " SELECT * FROM ".TABLE_SCHEDULE." WHERE del_yn='N' AND site_id='main' AND schedule_start_date BETWEEN '".$qry_BeginDay."' AND '".$qry_EndDay."' ORDER BY schedule_start_date, schedule_end_date ";
							}
							$rs = $adb->query($sql);
							?>
							<div class="academicCal cal_month">
							
							<div class="month_top">
								<button type="button" class="btn_prev" onclick="location.href='<?=$targetYear_href?>&targetYear=<?=$targetYear-1?>'">
									<span><?=$targetYear-1?></span>
								</button>
								<span id="SCH_YEAR"><strong><?=$targetYear?></strong> 학년도 학사일정</span>
								<button type="button" class="btn_next" onclick="location.href='<?=$targetYear_href?>&targetYear=<?=$targetYear+1?>'">
									<span><?=$targetYear+1?></span>
								</button>           
							</div>

							<ul class="month_list">
							<? for ( $i = 1; $i < 13 ; $i++ ) { ?>
								<li><a href="#month<?=$i?>" title="<?=$i?>월" id="tab-month<?=$i?>" class="a-month-list <? if ( $i == date('n') ) echo " on"; ?>" ><?=$i?></a></li>
							<? } ?>
							</ul>

							<?
							while ( $row = $rs->fetchRow(DB_FETCHMODE_ASSOC) ) {
								$exp_sdate = explode('-', $row['schedule_start_date']);
								$exp_edate = explode('-', $row['schedule_start_date']);
								$com_smonth = $exp_sdate[1];
								$com_emonth = $exp_edate[1];
								$info[$com_smonth][] = array("sdate"=>$row['schedule_start_date'], "edate"=>$row['schedule_end_date'], "memo"=>$row['schedule_memo'] );
								if ( $com_smonth != $com_emonth ) {
									$info[$com_emonth][] = array("sdate"=>$row['schedule_start_date'], "edate"=>$row['schedule_end_date'], "memo"=>$row['schedule_memo'] );
								}
							}
							for ( $i = 1 ; $i < 13 ; $i ++ ) {
							?>

							<div class="cal_group cB" id="month<?=$i?>" tabindex="0">
								<div class="calendar">
									<h4><strong class="monthTit"><?=$i?>월</strong></h4>
									<table>
										<caption><p><?=$i?>월 학사일정 상세 내용</p></caption>
										<thead>
											<tr>
											<?
											$week = array("일" , "월"  , "화" , "수" , "목" , "금" ,"토");
											foreach ( $week as $num => $nm ) {
											?>
												<th scope="col"><?=$nm?></th>
											<? } ?>
											</tr>
										</thead>
										<tbody>
											<?
											// 해당 월의 시작 요일
											$start_week = date("w", mktime(0, 0, 0, str_pad($i, 2, '0', STR_PAD_LEFT), 1, $targetYear));
											// 해당월의 마지막 날짜
											$max_day = date('t', mktime(0, 0, 0, str_pad($i, 2, '0', STR_PAD_LEFT), 1, $targetYear)); 
											?>
											<tr>
												<? for ( $j = 0; $j < $start_week; $j++ ) { ?>
												<td>
													<span class="undefined "></span>
												</td>
												<? } ?>
												<? for ( $j = 1; $j <= $max_day; $j++ ) { ?>
												<td>
													<span class="chk <? echo "sched"; ?>"> <?=$j?> </span>
												</td>
												<? 
												// 토요일 확인 - 줄바꿈
												$this_day = date("w", mktime(0, 0, 0, str_pad($i, 2, '0', STR_PAD_LEFT), str_pad($j, 2, '0', STR_PAD_LEFT), $targetYear));
												if ( ($this_day+1)%7 == 0 ) echo "</tr><tr>";
												} 
												?>
											</tr>
										</tbody>
									</table>
								</div>
								<ul class="calList_con">
									<? 
										$key = str_pad($i, 2, '0', STR_PAD_LEFT);
										if ( count($info[$key]) > 0 ) {
										foreach ( $info[$key] as $num => $data ) { 
									?>
									<li>
									<strong> 
										<?	
											$start_date = explode("-",substr($data['sdate'],0,11));
											$end_date = explode("-",substr($data['edate'],0,11));
											echo $start_date[1]."월 ".$start_date[2]."일";
											
											//시작일과 종료일이 다를 경우 종료일 표시
											if ( $data['sdate'] != $data['edate'] ) {
												echo " ~ " . $end_date[1]."월 ".$end_date[2]."일";
											}

											/*echo date_format(date_create($data['sdate']), 'n월 j일');
											echo "(" . date_to_day($data['sdate']) . ")";
											if ( $data['sdate'] != $data['edate'] ) {
												echo "~" . date_format(date_create($data['edate']), 'n월 j일');
												echo "(" . date_to_day($data['edate']) . ")";
											}*/
										?>
									</strong>
									<p class="bul_acade">
										<?=$data['memo']?>
									</p>
									<!--
									<p class="bul_holi">
										대체휴일
									</p>
									-->
									</li>
									<? } } else { ?> 
										<li>
										<p class="bul_acade">
											일정이 없습니다.
										</p>
										</li>
									<? } ?>
								</ul>
								
								<a href="#tab-month<?=$i?>" class="goto-tabmenu">
									탭메뉴로 이동
								</a>
							</div>

							<? } ?>

							</div>
							<!-- //CMS 끝 -->
							</div>
						</div>
					</article>
					<!-- //contents  -->
				</div>

			</div>
		</section>
		<!-- //container -->
		<script type="text/javascript">
			menuOn(<?=$PAGEINDEX1?>, <?=$PAGEINDEX2?>, <?=($PAGEINDEX3=="")?'0':$PAGEINDEX3?>);

			window.onload = function() {
				setTimeout (function() {
					scrollTo(0, 0);
				}, 100);
			}

			$(document).ready(function() {
				// 상단 월 클릭 이벤트 
				$("a.a-month-list").on("click", function(e) {
					e.preventDefault(); 
					$("a.a-month-list").removeClass("on");
					$(this).addClass("on");
					// todo. 해당 월 내용 이동 animation 추가 
					var idx = $(this).text().trim();
					$('html, body').animate({scrollTop : $("#month"+idx).offset().top - $(".header").outerHeight()}, 400);
					$("#month"+idx).focus();
				});

				$(".goto-tabmenu").on("click", function(e) {
					$('html, body').animate({scrollTop : $(".cal_month").offset().top - $(".header").outerHeight()}, 400);
				});

			});
		</script>

		<!-- footer -->
		<? include("../_common/main_footer.php");?>
		<!-- //footer -->
	</div>
	<!-- //wrapper -->
</body>
</html>
