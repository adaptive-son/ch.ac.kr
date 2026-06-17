<!doctype html>
<html lang="ko">
<head>
	<? include "../include/meta.php" ?>
	<title>
		학과 학사일정 &lt; 학과소식 &lt; 웰니스문화관광과 - 춘해보건대학교
	</title>
</head>

<body> 
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
		<section>
			<div class="container" id="container">

				<div class="contents-navigation-wrapper">
					<div class="contents-navigation">
						<span class="icon-home">
							Home
						</span>
						<span class="icon-gt">
							&gt;
						</span>
						<span class="location">
							학과소식
						</span>
						<span class="icon-gt">
							&gt;
						</span>
						<strong>
							학과 학사일정
						</strong>
					</div>
				</div>	

				<div class="container-wrapper">

					<div class="lnb-wrapper">
						<div class="lnb-area">
							<? include "../include/lnb04.php" ?>
						</div>
					</div>				
					<!-- contents  -->
					<article>
						<div class="contents" id="contents">
	
							
							<h3 class="contents-title">
								학과 학사일정
								<span class="arrow"></span>
							</h3>

							<div class="contents-wrapper">
							<!-- CMS 시작 -->

							<script type="text/javascript">
								$(document).ready(function() {
									fn_init();
								});
								function fn_init(){
									var date = new Date();
									var month = date.getMonth()+1;
									if("" == "")$("#year").text(date.getFullYear());
									fn_R00();
								}
								function fn_R00(div){
									var year = parseInt($("#year").text());
									if(div == 'prev'){
										year = year - 1;
									}else if(div == 'next'){
										year = year + 1;
									};
									$("#prevYear").text(year-1);    
									$("#year").text(year);
									$("#nextYear").text(year+1);
									fn_R01();
								}
								function fn_R01(){
									fn_comm_ajax({
										url : "/ajax/CM_SH01_SVC/CM_SH01_R01.do",
										data : {"YEAR":$("#year").text(),"PARAM":"1"},
										dataType : "json",
										success : function(data) {
											var schedule = [];
											$("#schedule_list").empty();
											for(var i=1; i<=12; i++){
												var cnt = 0;
												schedule[i] = {month : i};
												schedule[i].englishMonth = fn_englishMonth(i);
												$("#listTemplate").tmpl(schedule[i]).appendTo("#schedule_list");
												for(var idx=0; idx<data.length; idx++){
													var Month = data[idx].FROM_MONTH;
													if(Month == i){
													   $("#ulTemplate").tmpl(data[idx]).appendTo("#ulTemplate_"+i);
														cnt = cnt + 1;
													}
												};
												if(cnt == 0){
													$("#noUlTemplate").tmpl(null).appendTo("#ulTemplate_"+i);
												}
											}
											var date = new Date();
											var month = date.getMonth()+1;
											fn_scrollFocus('cal'+month);
										}
									});
								}
								function fn_scrollFocus(cal) {
									$("#schedule_month li").removeClass("on");
									$("#schedule_month ."+cal).addClass("on");
									$("[name='"+cal+"']").fn_comm_scrollFocus();
								}
								function fn_summaryView() {
									location.href="CM_SH01_L02.do?MENU_SN=2114&YEAR="+$("#year").text();
								}
								function fn_englishMonth(month) {
									monthName = ['','January','February','March','April','May','June','July','Agust','September','October','November','December'];
									return monthName[month];
								}
							</script>
							<div class="schedule_head">
								<h4>
									<b id="year">2020</b> 학년도 학사일정
								</h4>
								<button class="prev" onclick="fn_R00('prev')"><b id="prevYear">2019</b></button>
								<button class="next" onclick="fn_R00('next')"><b id="nextYear">2021</b></button>
								
								<div class="month">
									<div>
										<ul id="schedule_month">
											<li class="cal1"><button onclick="fn_scrollFocus('cal1')">1월</button></li>
											<li class="cal2"><button onclick="fn_scrollFocus('cal2')">2월</button></li>
											<li class="cal3"><button onclick="fn_scrollFocus('cal3')">3월</button></li>
											<li class="cal4"><button onclick="fn_scrollFocus('cal4')">4월</button></li>
											<li class="cal5"><button onclick="fn_scrollFocus('cal5')">5월</button></li>
											<li class="cal6"><button onclick="fn_scrollFocus('cal6')">6월</button></li>
											<li class="cal7 on"><button onclick="fn_scrollFocus('cal7')">7월</button></li>
											<li class="cal8"><button onclick="fn_scrollFocus('cal8')">8월</button></li>
											<li class="cal9"><button onclick="fn_scrollFocus('cal9')">9월</button></li>
											<li class="cal10"><button onclick="fn_scrollFocus('cal10')">10월</button></li>
											<li class="cal11"><button onclick="fn_scrollFocus('cal11')">11월</button></li>
											<li class="cal12"><button onclick="fn_scrollFocus('cal12')">12월</button></li>
										</ul>
									</div>
								</div>
							</div>

							<div id="schedule_list" class="schedule_list">
								<div name="cal1">
									<h5>1월<span>January</span></h5>
									<ul id="ulTemplate_1">
										<li><time>01-25(토)</time>설날</li>
										<li><time>01-27(월)</time>대체휴일</li>
									</ul>
								</div>
								<div name="cal2">
									<h5>2월<span>February</span></h5>
									<ul id="ulTemplate_2">
										<li><time>02-03(월) ~ 02-21(금)</time>2020학년도 복학신청</li>
										<li><time>02-04(화)</time>2020학년도 정시모집 합격자 발표</li>
										<li><time>02-10(월) ~ 02-21(금)</time>2020학년도 등록 및 휴학신청</li>
										<li><time>02-13(목)</time>2019학년도 전기 학위 수여식</li>
										<li><time>02-20(목)</time>2020학년도 입학식</li>
									</ul>
								</div>
								<div name="cal3">
									<h5>3월<span>March</span></h5>
									<ul id="ulTemplate_3">
										<li>이달의 일정이 없습니다.</li>
									</ul>
								</div>
								<div name="cal4">
									<h5>4월<span>April</span></h5>
									<ul id="ulTemplate_4">
										<li><time>04-05(일)</time>식목일</li>
										<li><time>04-06(월)</time>1학기 개강(학기 개시일)</li>
										<li><time>04-15(수)</time>국회의원 선거일</li>
										<li><time>04-29(수)</time>개교기념 휴무</li>
										<li><time>04-30(목)</time>부처님오신날</li>
									</ul>
								</div>
								<div name="cal5">
									<h5>5월<span>May</span></h5>
									<ul id="ulTemplate_5">
										<li><time>05-01(금)</time>근로자의날</li>
										<li><time>05-01(금)</time>수업일수(1/4)</li>
										<li><time>05-04(월)</time>수업개시(30일)</li>
										<li><time>05-05(화)</time>어린이날</li>
										<li><time>05-20(수) ~ 05-21(목)</time>축제</li>
										<li><time>05-22(금)</time>개교기념식(제27주년)</li>
										<li><time>05-25(월) ~ 05-29(금)</time>직무수행능력평가1차</li>
										<li><time>05-28(목)</time>수업일수(2/4)</li>
									</ul>
								</div>
								<div name="cal6">
									<h5>6월<span>June</span></h5>
									<ul id="ulTemplate_6">
										<li><time>06-04(목)</time>수업개시(60일)</li>
										<li><time>06-06(토)</time>현충일</li>
										<li><time>06-23(화)</time>수업일수(3/4)</li>
									</ul>
								</div>
								<div name="cal7">
									<h5>7월<span>July</span></h5>
									<ul id="ulTemplate_7">
										<li><time>07-04(토)</time>수업개시(90일)</li>
										<li><time>07-13(월) ~ 07-17(금)</time>직무수행능력평가2차(기말고사)</li>
										<li><time>07-19(일)</time>수업일수(4/4)</li>
										<li><time>07-20(월)</time>하계방학</li>
										<li><time>07-23(목)</time>전체교직원회의</li>
									</ul>
								</div>
								<div name="cal8">
									<h5>8월<span>Agust</span></h5>
									<ul id="ulTemplate_8">
										<li><time>08-15(토)</time>광복절</li>
										<li><time>08-19(수) ~ 08-28(금)</time>2학기 복학신청</li>
										<li><time>08-24(월) ~ 08-28(금)</time>2학기 등록 및 휴학신청</li>
										<li><time>08-27(목)</time>전체교직원회의</li>
										<li><time>08-28(금)</time>후기 졸업</li>
										<li><time>08-31(월)</time>2학기 개강(학기 개시일)</li>
									</ul>
								</div>
								<div name="cal9">
									<h5>9월<span>September</span></h5>
									<ul id="ulTemplate_9">
										<li><time>09-25(금)</time>수업일수(1/4)</li>
										<li><time>09-29(화)</time>수업개시(30일)</li>
										<li><time>09-30(수) ~ 10-02(금)</time>추석</li>
									</ul>
								</div>
								<div name="cal10">
									<h5>10월<span>October</span></h5>
									<ul id="ulTemplate_10">
										<li><time>10-03(토)</time>개천절</li>
										<li><time>10-09(금)</time>한글날</li>
										<li><time>10-19(월) ~ 10-23(금)</time>직무수행능력평가1차(중간고사)</li>
										<li><time>10-21(수)</time>수업일수(2/4)</li>
										<li><time>10-29(목)</time>수업개시(60일)</li>
									</ul>
								</div>
								<div name="cal11">
									<h5>11월<span>November</span></h5>
									<ul id="ulTemplate_11">
										<li><time>11-16(월)</time>수업일수(3/4)</li>
										<li><time>11-19(목)</time>2021학년도 수학능력시험</li>
										<li><time>11-28(토)</time>수업개시(90일)</li>
									</ul>
								</div>
								<div name="cal12">
									<h5>12월<span>December</span></h5>
									<ul id="ulTemplate_12">
										<li><time>12-07(월) ~ 12-11(금)</time>직무수행능력평가 2차</li>
										<li><time>12-11(금)</time>수업일수(4/4)</li>
										<li><time>12-14(월)</time>동계방학</li>
									</ul>
								</div>
							</div>
							<script id="listTemplate" type="text/x-jquery-tmpl">
								<div name="cal{%= month %}">
									<h5>{%= month %}월<span>{%= englishMonth %}</span></h5>
									<ul id=ulTemplate_{%= month %}></ul>
								</div>
							</script>
							<script id="ulTemplate" type="text/x-jquery-tmpl">
										<li><time>{%= YMD %}</time>{%= SJ %}</li>
							</script>
							<script id="noUlTemplate" type="text/x-jquery-tmpl">
									<li>이달의 일정이 없습니다.</li>
							</script>
							<div id="foot_content">
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

		<!-- footer -->
		<footer>
			<? include "../include/footer.php" ?>
		</footer>
		<!-- //footer -->
	</div>
	<!-- //wrapper -->
	<script>
		menuOn(4, 3, 0);
	</script>
</body>
</html>
