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
        교원모집 &lt; 춘해보건대학교
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
                교원모집
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
                        if(!$wr_name || !$wr_hp1 || !$wr_hp2 || !$wr_hp3 || !$wr_pass){
                            echo "<script>alert('정상적인 방법으로 이용하세요.');location.href='./'</script>";
                        }

                        //채용공고 확인
                        $check = mysql_num_rows(mysql_query("SELECT * FROM recruit_index_research WHERE idx='$resume_num'"));

                        if ( $_SERVER["REMOTE_ADDR"] == "112.217.216.250" ) {
                            // 본사접근시, 진행중인 공고여부와 상관없이 최근 데이터 접근
                            if ( empty($resume_num) ) {
                                $sql = " select * from recruit_index_research where idx = ( select max(idx) from recruit_index_bi ) ";
                                $rs = mysql_query($sql);
                                $check = mysql_num_rows($rs);
                                $row = mysql_fetch_assoc($rs);
                                $resume_num = $row['idx'];
                            }
                        }

                        if($check==0) {
                            echo "<script>alert('진행중인 채용공고가 없습니다.');history.back();</script>";
                            exit;
                        }

                        $kor_name = $wr_name;
                        //$wr_name = iconv("utf-8","euc-kr",$wr_name);
                        $resume_num = $_POST['resume_num']; //채용공고에 따라 번호를 변경할 것
                        //이미 작성한 내용인지 확인
                        $phone = $wr_hp1."-".$wr_hp2."-".$wr_hp3;

                        $sql = "SELECT * FROM recruit_copy_research WHERE kor_name='$wr_name' AND phone='$phone' AND resume_num = '$resume_num'";
                        $res = mysql_query($sql);
                        $rows = mysql_num_rows($res);
                        $row = mysql_fetch_array($res);


                        $password=$wr_pass;
                        $enc_pass = base64_encode($password);


                        if($rows > 0){
                            //$sql = "SELECT * FROM recruit WHERE kor_name='$wr_name' AND phone='$phone'";
                            //이미 작성 내용이기 때문에 수정페이지로 이동
                            echo "<script>location.href='resume.php?j=u&wr_id=$row[wr_id]&pass=$enc_pass'</script>";
                        }
                        ?>

                        <h3 class="contents-title">
                            교원모집
                            <span class="arrow"></span>
                        </h3>

                        <div class="cont">
                            <form name="frm" method="POST" action="./resume.php" onsubmit="return check_form(this)">
                                <input type="hidden" name="kor_name" value="<?=$kor_name?>" />
                                <input type="hidden" name="phone" value="<?=$phone?>" />
                                <input type="hidden" name="pass" value="<?=$enc_pass?>" />
                                <input type="hidden" name="resume_num" value="<?=$resume_num?>" />
								<div class="table-type03">
									<table>
										<colgroup>
											<col width="300px">
											<col width="">
										</colgroup>
										<tbody>
											<tr>
												<td colspan="2" style="height:40px;font-size:15px;font-weight:bold;background:#EEEEEE"><h3>개인정보제공 동의서</h3></td>
											</tr>
											<tr>
												<td colspan="2" class="left" style="height:40px;" >* 아래의 내용을 충분히 숙지하신 후 반드시 본인이 직접 개인정보 수집․이용․제공 동의 후 서명하시기 바랍니다.</td>
											</tr>
											<tr>
												<th scope="row" class="bg02">수집하는 개인정보 항목</th>
												<td class="left">성명, 주소, 생년월일, 핸드폰 번호, 전화번호, Email, 학력, 신상자료, 가족사항</td>
											</tr>
											<tr>
												<th scope="row" class="bg02">개인정보의 수집 및 이용목적</th>
												<td class="left">제공하신 정보는 우리대학 교원 채용 지원을 위해서 사용합니다.<br/>
													① 채용 정보 : 성명, 주소, 생년월일, 핸드폰 번호, 전화번호, Email, 학력, 신상자료, 가족사항</td>
											</tr>
											<tr>
												<th scope="row" class="bg02">개인정보의 보유 및 이용기간</th>
												<td class="left">수집된 개인정보의 이용목적(채용 완료)이 달성되면 파기됩니다. 다만, 법령의 규정에 의하여 일정기간 보유합니다. </td>
											</tr>
											<tr>
												<td colspan="2" class="left" style="height:40px">※ 개인정보 수집에 대한 동의를 거부할 수 있으며, 다만, 동의가 없을 경우 채용심사가 진행되지 않을 수 있음을 알려드립니다. </td>

											</tr>
											<tr>
												<td colspan="2" class="left" style="height:40px">※ 개인정보 제공자가 동의한 내용외의 다른 목적으로 활용하지 않으며, 제공된 개인정보의 이용을 거부하고자 할 때에는<br />
													개인정보 관리책임자를 통해 열람, 정정, 삭제를 요구할 수 있음 </td>

											</tr>
										</tbody>
									</table>
								</div>

                                <div style="height:50px; line-height:50px; text-align: center;"><input type="radio" name="agree" id="agree1" value="1" />&nbsp;<label for="agree1">개인정보 수집 및 이용에 동의함</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="agree" id="agree2" value="2" />&nbsp; <label for="agree2">개인정보 수집 및 이용에 동의하지 않음</label></div>
                                <div class="btns-area">
									<button type="submit" class="btns-color01 btn-m02">
										확인
									</button>
									<button type="button" class="btns-color02 btn-m02" onclick="history.back();">
										취소
									</button>
									<!--
                                    <input type="submit" value="확인" style="padding:10px 20px; border:0; background:#f53d3d;font-weight:bold;color:#FFFFFF;cursor:pointer"/>&nbsp;<input type="button" value="취소" style="padding:10px 20px; border:0; background:#585858;font-weight:bold;color:#FFFFFF;cursor:pointer" onclick="history.back();"/>
									-->
                                </div>
                            </form>
                        </div>


                    </div>

                </article>
                <!-- //contents  -->
            </div>
        </div>
    </section>
    <!-- //container -->

    <script>
        function check_form(f){
            var agree = document.getElementsByName("agree");
            var agree_num = agree.length;

            chk = 0;
            for(i=0;i<agree_num;i++){
                if(agree[i].checked==true){
                    chk++;break;
                }
            }
            if(chk==0 || agree[1].checked==true){
                alert("개인정보제공에 동의하셔야 이용가능합니다.");
                return false;
            }
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