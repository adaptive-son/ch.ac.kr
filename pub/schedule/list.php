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

    <title><?=$PAGENAME3.$PAGENAME2.$PAGENAME1._TAG_TITLE?></title>
</head>

<body>
	<!-- wrapper -->
	<div class="wrapper" id="wrapper">
		<!-- header -->
		<? include("../".$TREE_ID."/include/header.php");?>
		<!-- //header -->

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
								학과 학사일정
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
								$sql = " SELECT * FROM ".TABLE_SCHEDULE." WHERE del_yn='N' AND (site_id='".$site_id."' OR site_id='main') AND schedule_start_date BETWEEN '".$qry_BeginDay."' AND '".$qry_EndDay."' ORDER BY schedule_start_date, schedule_end_date ";
							} else if ($site_id=="main") {
								$sql = " SELECT * FROM ".TABLE_SCHEDULE." WHERE del_yn='N' AND site_id='main' AND schedule_start_date BETWEEN '".$qry_BeginDay."' AND '".$qry_EndDay."' ORDER BY schedule_start_date, schedule_end_date ";
							}

							$rs = $adb->query($sql);

							if($_SERVER['REMOTE_ADDR'] == "112.217.216.250"){
								//echo $sql;
							}

							for ( $i = 0 ; $rows = $rs->fetchRow(DB_FETCHMODE_ASSOC) ; $i++ ) {
								$row_schedule[$rows['schedule_no']] = $rows;
							}
							?>

							<div class="schedule_head">
								<h4>
									<b id="year">
										<?=$targetYear?>
									</b> 학년도 학사일정

								</h4>
								<button class="prev" onclick="location.href='<?=$targetYear_href?>&targetYear=<?=$targetYear-1?>'">
									<b id="prevYear">
										<?=$targetYear-1?>
									</b>
								</button>
								<button class="next" onclick="location.href='<?=$targetYear_href?>&targetYear=<?=$targetYear+1?>'">
									<b id="nextYear">
										<?=$targetYear+1?>
									</b>
								</button>

								<div class="month">
									<div>
										<ul id="schedule_month">
											<? for ( $i = 1 ; $i < 13 ; $i++ ) {
												$i = str_pad($i, 1, '0', STR_PAD_LEFT); ?>
												<li class="cal<?=$i?>">
													<button onclick="fn_scrollFocus('cal<?=$i?>')">
														<?=$i?>월
													</button>
												</li>
											<? } ?>
										</ul>
									</div>
								</div>
							</div>

							<div id="schedule_list" class="schedule_list">
								<?
									$week = array("일" , "월"  , "화" , "수" , "목" , "금" ,"토");
									$montheng_arr = array("", "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");

									$i = 1;
									while ($i < 13) {
										$month = str_pad($i, 1, '0', STR_PAD_LEFT);
										$montheng = $montheng_arr[$i];
										$i++
								?>
								<div name="cal<?=$i?>">
									<h5><?=$month?>월<span><?=$montheng;?></span></h5>
									<!--
									<ul id="ulTemplate_1">
									-->
									<ul>
										 <?
											$cnt = 0 ; //스케쥴 카운트
											foreach ( $row_schedule as $k => $v ) {
												// 시작일 요일
												$start_weekday = $week[date("w", strtotime($v[schedule_start_date]))];
												// 시작일 일
												$schedule_start_date = substr($v[schedule_start_date], 8);
												// 시작일 월
												$schedule_start_month = substr($v[schedule_start_date], 5, -3);

												// 종료일 요일
												$end_weekday = $week[date("w", strtotime($v[schedule_end_date]))];
												// 종료일 일
												$schedule_end_date = substr($v[schedule_end_date], 8);
												// 종료일 월
												$schedule_end_month = substr($v[schedule_end_date], 5, -3);

												if($month==$schedule_start_month){
													$cnt++
										?>
										<li>
											<time>
												<?
													//시작일자와 종료일자가 같을 경우
													if ($v[schedule_start_date] == $v[schedule_end_date]) {
												?>
												<?=$schedule_start_month."-".$schedule_start_date?>(<?=$start_weekday;?>)
												<?
													//시작일자와 종료일자가 다를 경우
													} else if ($v[schedule_start_date] != $v[schedule_end_date]) { ?>
												<?=$schedule_start_month."-".$schedule_start_date?>(<?=$start_weekday;?>)
													~<?=$schedule_end_month."-".$schedule_end_date?>(<?=$end_weekday;?>)
												<?
													}
												?>
											</time>
											<?=str_replace("\n", "<br/>", $v[schedule_memo]);?>
										</li>
										<?
												}//if 문 끝
											} //end 스케쥴 for 문
										?>
										<? if($cnt == 0){ ?>
												<li>이달의 일정이 없습니다.</li>
										<? } ?>
									</ul>
								</div>
								<?   }//end 12 month for?>
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
			function fn_scrollFocus(cal) {
				$("#schedule_month li").removeClass("on");
				$("#schedule_month ."+cal).addClass("on");
				var offset = $("[name='"+cal+"']").offset();
				$('html, body').animate({scrollTop : offset.top}, 400);
			}
		</script>

		<!-- footer -->
		<? include("../_common/footer.php");?>
		<!-- //footer -->
	</div>
	<!-- //wrapper -->
</body>
</html>
