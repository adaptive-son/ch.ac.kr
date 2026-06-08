<?php
// 개별 페이지 실행 방지. 해당 문자열은 inc.constant.php에 정의된다.
define("__AF__", TRUE);
// adframe 템플릿 페이지 설정.
include($_SERVER["DOCUMENT_ROOT"] . "/adframe/af_common.php");
?>
<!doctype html>
<html lang="ko">

<head>
    <? include_once( $_SERVER["DOCUMENT_ROOT"] . "/include/meta.php" ); ?>
    <title>
        채용공고 &lt; 춘해보건대학교
    </title>
	<style type="text/css">
		.table-type03 td input {
			height: 35px;
		}
	</style>
	<script>
		function goPage(idx){
			$(function(){
				$("#idx").val(idx);
				$("#frm").submit();
			});
		}
	</script>
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
        <? include_once( $_SERVER["DOCUMENT_ROOT"] . "/include/header.php" ); ?>
        <link rel="stylesheet" type="text/css" href="./css/notokr.css" media="all"/>
		<!--
        <link rel="stylesheet" type="text/css" href="./css/default.css" media="all"/>
		-->
        <link rel="stylesheet" type="text/css" href="./css/layout_20180724.css" media="all"/>
        <link rel="stylesheet" type="text/css" href="./css/style.css" media="all"/>
    </header>
    <!-- //header -->
	<form name="frm" id="frm" action="recruit_check.php" method="post">
		<input type="hidden" name="resume_num" id="idx" value="" />
	</form>
    <!-- sub visual -->
    <div class="sub-visual">
        <img src="../img02/sub01/img_subvisual_pc.jpg" alt="" class="pc" />
        <img src="../img02/sub01/img_subvisual_mobile.jpg" alt="" class="mobile" />
        <p>
            <strong>
                채용지원서
            </strong>
            <span>

            </span>
        </p>
    </div>
    <!-- //sub visual -->

    <section>
        <div class="container" id="container">
            <!-- contents navigation, content options -->
            <? include "../include/contents_navigation.php" ?>
            <!-- contents navigation, content options -->

            <div class="container-wrapper">

                <div class="lnb-wrapper">
                    <div class="lnb-area">
                        <? include_once( $_SERVER["DOCUMENT_ROOT"] . "/include/lnb01.php" ); ?>
                    </div>
                </div>
                <!-- contents  -->
                <article>
                    <div class="contents" id="contents">

                        <?php
                        // 현재 진행중 공고 확인
                        $today = date("Y-m-d");
                        $sql = "SELECT * FROM recruit_index_employment WHERE date(start_date) <= date(now()) AND date(end_date) >= date(now())";
                        $res = mysql_query($sql);
						$rows = mysql_num_rows($res);
                        ?>

                        <h3 class="contents-title">
                            채용지원서
                            <span class="arrow"></span>
                        </h3>
                       
						<div class="table-type03 ml20">
							<table >
								<colgroup>
									<col width="80px">
									<col width="*">
									<col width="120px">
									<col width="150px">
								</colgroup>
								<thead>
									<tr>
										<th>번호</th>
										<th>제목</th>
										<th>등록일</th>
										<th>지원하기</th>
									</tr>
								</thead>
								<tbody>
									<?php if($rows == 0){?>
									<tr>
										<td colspan="4">진행중인 채용공고가 없습니다.</td>
									</tr>
									<?php 
										}else{ 
											$i=1;
											while($row = mysql_fetch_array($res)){
									?>

									<tr>
										<th scope="row" class="bg01"><?php echo $i;?></th>
										<td class="left">
											<?php echo $row['subject']?>
										</td>
										<td><?php echo substr($row['aq_datetime'],0,10)?></td>
										<td>
											<div class="btns-area" style="margin-top:0px;">
												<a href="javascript:void(0)" onclick="goPage('<?php echo $row['idx']?>')" style="min-width:120px !important;" class="btn-download type01" >
													<span style="padding-left:30px !important">
														<strong>지원하기</strong>
													</span>
												</a>
											</div>
										</td>
									</tr>
									<?php
												$i++;
											}
										} 
									?>
								</tbody>
							</table>
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
    <? include_once( $_SERVER["DOCUMENT_ROOT"] . "/include/footer.php" ); ?>
</footer>
<!-- //footer -->
</div>
<!-- //wrapper -->
<script>
    menuOn(0, 0, 0);
</script>
</body>

</html>