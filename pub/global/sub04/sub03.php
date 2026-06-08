<!doctype html>
<html lang="ko">
<head>
	<? include "../include/meta.php" ?>
	<title>
		한국어연수 과정 &lt; 한국어교육원 &lt; 국제교류처 - 춘해보건대학교
	</title>
	<script>
		var year ="";
		$(function(){
			$("button.fc-next-button").on('click',function(){
				year = "2023"
			});
		});
		var year = showYear(year);

	</script>
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
							한국어교육원
						</span>
						<span class="icon-gt">
							&gt;
						</span>
						<span class="location">
							한국어연수 프로그램
						</span>
						<!-- 3차뎁스 있을 시 아래 코드 사용 -->
						<!-- <span class="icon-gt">
							&gt;
						</span>
						<strong>
							인사말
						</strong> -->
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
								한국어연수 과정
								<span class="arrow"></span>
							</h3>

							<div class="contents-wrapper">
							<!-- CMS 시작 -->

							<script src="../../assets/js/index.global.min.js"></script>

								<script>
									
									document.addEventListener('DOMContentLoaded', function() {
										var calendarEl = document.getElementById('calendar');
										var calendar = new FullCalendar.Calendar(calendarEl, {
											initialView: 'dayGridMonth', // 초기 로드 될때 보이는 캘린더 화면 (기본 설정: 달)
											headerToolbar: { // 헤더에 표시할 툴 바
												start: 'prev',
												center: 'title',
												end: 'next'
											},
											//                                                editable: true,
											//                                                selectable: true,
											businessHours: false,
											dayMaxEvents: true,
											locale: 'ko', // 한국어 설정
											expandRows: true, // 화면에 맞게 높이 재설정
											height: '925px', // calendar 높이 설정
											events: function(info, successCallback){
												var start = info.start;
												var end = info.end;
												var startDate = start.getFullYear()+"-"+('0' + (start.getMonth() + 1)).slice(-2)+"-"+('0' + start.getDate()).slice(-2)
												var endDate = end.getFullYear()+"-"+('0' + (end.getMonth() + 1)).slice(-2)+"-"+('0' + end.getDate()).slice(-2)
												
												$.ajax({
													url : "getSchedule.php",
													type : "get",
													dataType: "json",
													data : {
														startDate : startDate,
														endDate : endDate
													},
													success : function(data) {
														var events = [];
														var result = JSON.stringify(data);

														for(var i=0; i < data.length; i++){
															var dataSet = data[i];
console.log(dataSet.start)
															events.push({
																title : dataSet.title
																,start : dataSet.start
																,end : dataSet.end
															});
														}


														successCallback(events);	
													},
													error : function(request) {
														console.log(request);
													}
												});
											},
										});
										calendar.render();
									});
								</script>

									

                                <div class="contents-area">
                                    <div class="schdule-wrapper">
                                        <div id='calendar'></div>
                                    </div>
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
