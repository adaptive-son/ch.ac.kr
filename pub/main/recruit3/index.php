<?
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
        강사초빙 &lt; 춘해보건대학교
    </title>
	<style type="text/css">
		.table-type03 td input {
			height: 35px;
		}
	</style>

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

    <!-- sub visual -->
    <div class="sub-visual">
        <img src="../img02/sub01/img_subvisual_pc.jpg" alt="" class="pc" />
        <img src="../img02/sub01/img_subvisual_mobile.jpg" alt="" class="mobile" />
        <p>
            <strong>
                강사초빙
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

                        <?
                        //if ( $_SERVER['REMOTE_ADDR'] == "112.217.216.250" ) {
                        $__IS_ADB = true;
                        //}

                        // 현재 진행중 공고 확인
                        $today = date("Y-m-d");
                        $sql = "SELECT idx, end_date FROM recruit_index_te WHERE date(start_date) <= date(now()) AND date(end_date) >= date(now())";
						//echo $sql;
                        $res = mysql_query($sql);
                        $row = mysql_fetch_assoc($res);
                        	
                        if ( $__IS_ADB == true ) {
                            if ( !$row || count($row) == 0 ) {
                                echo "<script>alert('진행중인 채용공고가 없습니다.'); history.back(); </script>";
                                exit;
                            } else {
                                //echo 111;
                                // 마감시간
                                //$end_dateTime = strtotime(date("2019-01-10 13:00:00"));
								$end_dateTime = strtotime(date($row['end_date'])." 18:00:00");
                                if ( strtotime(date("Y-m-d H:i:s")) >= $end_dateTime ) {
                                    echo "<script> alert('채용이 마감되었습니다.'); history.back(); </script>";
                                    	exit;
                                } else {
                                    // 채용이 진행중인 경우
                                }
                            }
                        }
                        ?>

                        <h3 class="contents-title">
                            강사초빙
                            <span class="arrow"></span>
                        </h3>
                        <form name="frm" method="POST" onsubmit="return check_form(this)">
                            <input type="hidden" name="resume_num" value="<?=$row['idx']?>" />
                            <div style="width: 800px; min-height:220px;margin:0 auto;">
                                <p class="word-type01">
                                    * 이력서 접수 및 수정을 위하여 이름과 연락처를 입력해주세요.
								</p>

								<p class="word-notice01 point-color01 word-light mb10">
								    (처음 제출하시는 분은 사용할 비밀번호를 입력해주시고,<br />
								    수정을 하실경우 처음 입력했던 비밀번호를 입력해 주세요.)
                                </p>
								<div class="table-type03 ml20">
									<table style="width:800px;">
										<colgroup>
											<col width="200px">
											<col>
										</colgroup>
										<tbody>
										<tr>
											<th scope="row" class="bg01">성명</th>
											<td class="left"><input type="text" name="wr_name"  /></td>
										</tr>
										<tr>
											<th scope="row" class="bg01">연락처</th>
											<td class="left">
												<div class="input-phone-wrapper">
													<input type="text" name="wr_hp1" maxlength="4"/> 
													<span class="word-unit">-</span>
													<input type="text" name="wr_hp2" maxlength="4" />
													<span class="word-unit">-</span>
													<input type="text" name="wr_hp3" maxlength="4" />
												</div>
											</td>
										</tr>
										<tr>
											<th scope="row" class="bg01">비밀번호</th>
											<td class="left"><input type="password" name="wr_pass"  /></td>
										</tr>
										</tbody>
									</table>
								</div><br />
								
                                <div  class="btns-area"><!-- 2020.12.30 수정작업 버튼 디자인 변경 -->
									<button type="submit" class="btns-color01 btn-m02">
										확인
									</button>
									<button type="button" class="btns-color02 btn-m02" onclick="history.back();">
										취소
									</button>
									<!--
                                    <input type="submit" value="확인" style="padding:10px 20px; border:0; background:#f53d3d;font-weight:bold;color:#FFFFFF;cursor:pointer"/>&nbsp;
                                    <input type="button" value="취소" style="padding:10px 20px; border:0; background:#585858;font-weight:bold;color:#FFFFFF;cursor:pointer" onclick="history.back();"/>
									-->
                                </div>
								
                            </div>
                        </form>
                    </div>

                </article>
                <!-- //contents  -->
            </div>
        </div>
    </section>
    <!-- //container -->

    <script>
        function check_form(f) {
            if(f.wr_name.value==""){alert("성명을 입력하십시오 ");f.wr_name.focus(); return false;}
            if(f.wr_hp1.value==""){alert("연락처를 입력하십시오"); f.wr_hp1.focus(); return false;}
            if(f.wr_hp2.value==""){alert("연락처를 입력하십시오"); f.wr_hp2.focus(); return false;}
            if(f.wr_hp3.value==""){alert("연락처를 입력하십시오"); f.wr_hp3.focus(); return false;}
            if(f.wr_pass.value==""){alert("비밀번호를 입력하십시오"); f.wr_pass.focus(); return false;}
            f.action = "private.php";
        }
    </script>

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