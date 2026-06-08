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

    <link rel="stylesheet" type="text/css" href="./css/notokr.css" media="all"/>
	<!--
    <link rel="stylesheet" type="text/css" href="./css/default.css" media="all"/>
	-->
    <link rel="stylesheet" type="text/css" href="./css/layout_20180724.css" media="all"/>
    <link rel="stylesheet" type="text/css" href="./css/style.css" media="all"/>
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
                        $password = base64_decode($pass);
                        //echo "<script>alert('진행중인 채용공고가 없습니다.');history.back();</script>";exit;
                        //include "../inc/head_recruit.php";
                        if($j=="" && $agree=="2"){echo "<script>alert('잘못된 접근입니다.');history.back();</script>";}
                        if($j=="u"){
                            //mysql_query("SET NAMES 'utf8'");
                            $sql = "SELECT * FROM recruit_copy_bi WHERE wr_id='$wr_id'";
                            $res = mysql_query($sql);
                            $row = mysql_fetch_array($res);
                            $kor_name = $row[kor_name];
                            $phone = $row[phone];
                            $resume_num = $row[resume_num];
                            $dateSql = "SELECT * FROM recruit_bi1 WHERE parent='$row[wr_id]'";
                            $dateRes = mysql_query($dateSql);
                            $date = mysql_fetch_array($dateRes);

                            if($row > 0){
                                $sql_chk = "SELECT * FROM recruit_bi1 WHERE parent='$wr_id' AND password='$password'";
                                $res_chk = mysql_query($sql_chk);
                                $row_chk = mysql_fetch_array($res_chk);
                                if($_SERVER['REMOTE_ADDR']!="112.217.216.250"){
                                    if(!$row_chk){
                                        echo "<script>alert('비밀번호 입력이 잘못되었습니다.');history.back();</script>";

                                    }
                                }
                            }
                        }
                        ?>

                        <script>
                            function check_form(f){
                                if(f.apply_major.value==""){alert("지원학과를 선택하세요.");f.apply_major.focus(); return false;}
                                /*
                                var type_gubun = document.getElementsByName("type_gubun");
                                var type_gubun_num = type_gubun.length;

                                type_gubun_chk = 0;
                                for(i=0;i<type_gubun_num; i++){
                                    if(type_gubun[i].checked==true){type_gubun_chk++;break;}
                                }
                                if(type_gubun_chk==0){alert("초빙구분을 선택하세요.");return false;}
                                */
                                if(f.major.vlaue==""){alert("초빙분야 구분번호를 입력하세요..");f.major.focus(); return false;}
								if(f.damdang-class.vlaue==""){alert("담당과목명을 입력하세요..");f.damdang.focus(); return false;}
                                /*
                                var gubun = document.getElementsByName("gubun");
                                var gubun_num = gubun.length;

                                chk = 0;
                                for(i=0;i<gubun_num; i++){
                                    if(gubun[i].checked==true){chk++;break;}
                                }
                                if(chk==0){alert("지원구분을 선택하세요.");return false;}
                        */
                                if(f.kor_name.value==""){alert("국문 성명을 입력하세요.");}

                                var sex = document.getElementsByName("sex");
                                var sex_num = sex.length;
                                chk1 = 0;
                                for(i=0;i<sex_num; i++){
                                    if(sex[i].checked==true){chk1++;break;}
                                }
                                if(chk1==0){alert("성별을 선택하세요");return false;}
                                if(f.bYear.value==""){alert("생년월일을 입력하세요.");f.bYear.focus();return false;}
                                if(f.bMonth.value==""){alert("생년월일을 입력하세요.");f.bMonth.focus();return false;}
                                if(f.bDay.value==""){alert("생년월일을 입력하세요.");f.bDay.focus();return false;}
                                if(f.addr1.value==""){alert("주소를 입력하세요.");f.addr1.focus(); return false;}
                                if(f.phone1.value==""){alert("휴대폰을 입력하세요.");f.phone1.focus(); return false;}
                                if(f.phone2.value==""){alert("휴대폰을 입력하세요.");f.phone2.focus(); return false;}
                                if(f.phone3.value==""){alert("휴대폰을 입력하세요.");f.phone3.focus(); return false;}
                                if(f.email.value==""){alert("이메일을 입력하세요.");f.email.focus(); return false;}
                                if(f.hPeriod1.value==""){alert("고등학교 재학기간을 입력하세요.");f.hPeriod1.focus(); return false;}
                                if(f.hPeriod2.value==""){alert("고등학교 재학기간을 입력하세요.");f.hPeriod2.focus(); return false;}
                                if(f.hSchool.value==""){alert("고등학교명을 입력하세요.");f.hSchool.focus(); return false;}
                                if(f.uPeriod1.value==""){alert("학사기간을 입력하세요.");f.uPeriod1.focus(); return false;}
                                if(f.uPeriod2.value==""){alert("학사기간을 입력하세요.");f.uPeriod2.focus(); return false;}
                                if(f.univ.value==""){alert("대학교명을 입력하세요.");f.univ.focus(); return false;}
                                if(f.uMajor.value==""){alert("학사 전공을 입력하세요.");f.uMajor.focus(); return false;}
                                if(f.uDegree.value==""){alert("학위명을 입력하세요.");f.uDegree.focus(); return false;}
                                if(f.uDegree_date.value==""){alert("학위취득일을 입력하세요.");f.uDegree_date.focus(); return false;}
                                if(f.profile.value==""){alert("자기소개서를 입력하세요.");f.profile.focus(); return false;}

                                <?if($j == ""){?>
                                if(f.file1.value==""){alert("사진을 첨부하세요.");f.profile.focus(); return false;}
                                <?}?>
                            }

                            $.fn.setPreview = function(opt){
                                "use strict"
                                var defaultOpt = {
                                    inputFile: $(this),
                                    img: null,
                                    w: 150,
                                    h: 150
                                };
                                $.extend(defaultOpt, opt);

                                var previewImage = function(){
                                    if (!defaultOpt.inputFile || !defaultOpt.img) return;

                                    var inputFile = defaultOpt.inputFile.get(0);
                                    var img       = defaultOpt.img.get(0);

                                    // FileReader
                                    if (window.FileReader) {
                                        // image 파일만
                                        if (!inputFile.files[0].type.match(/image\//)) return;

                                        // preview
                                        try {
                                            var reader = new FileReader();
                                            reader.onload = function(e){
                                                img.src = e.target.result;
                                                img.style.width  = defaultOpt.w+'px';
                                                img.style.height = defaultOpt.h+'px';
                                                img.style.display = '';
                                            }
                                            reader.readAsDataURL(inputFile.files[0]);
                                        } catch (e) {
                                            // exception...
                                        }
                                        // img.filters (MSIE)
                                    } else if (img.filters) {
                                        inputFile.select();
                                        inputFile.blur();
                                        var imgSrc = document.selection.createRange().text;

                                        img.style.width  = defaultOpt.w+'px';
                                        img.style.height = defaultOpt.h+'px';
                                        img.style.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(enable='true',sizingMethod='scale',src=\""+imgSrc+"\")";
                                        img.style.display = '';
                                        // no support
                                    } else {
                                        // Safari5, ...
                                    }
                                };

                                // onchange
                                $(this).change(function(){
                                    previewImage();
                                });
                            };


                            $(document).ready(function(){
                                var opt = {
                                    img: $('#img_preview'),
                                    w: 150,
                                    h: 150
                                };

                                $('#input_file').setPreview(opt);
                            });
                            function resume_form(val){
                                if(val=="간호학과"){
                                    document.getElementById("rm1").style.display="";
                                    document.getElementById("rm4").style.display="";
                                    document.getElementById("rm2").style.display="none";
                                    document.getElementById("rm3").style.display="none";
                                }else if (val=="응급구조과"){
                                    document.getElementById("rm1").style.display="none";
                                    document.getElementById("rm4").style.display="none";
                                    document.getElementById("rm2").style.display="";
                                    document.getElementById("rm3").style.display="";
                                }
                            }
                            function InpuOnlyNumber(obj) {
                                if (event.keyCode >= 48 && event.keyCode <= 57) { //숫자키만 입력
                                    return true;
                                } else {
                                    event.returnValue = false;
                                }
                            }
                        </script>
                        <script type="text/javascript">
                            function GPEN_PRINT(wr_id){
                                //alert("팝업이 뜨면 인쇄를 한번더 클릭해주세요.\n 인터넷 익스플로러에서만 인쇄가 가능합니다.");
                                var p = window.open("/adframe/mng/recruit2/print.php?wr_id="+wr_id,"PrintWin","width=800, height=700, scrollbars=yes");
                                p.focus();
                            }
                            function GPEN2_PRINT(wr_id){
                               // alert("팝업이 뜨면 인쇄를 한번더 클릭해주세요.\n 인터넷 익스플로러에서만 인쇄가 가능합니다.");
                                var p = window.open("/adframe/mng/recruit2/print2.php?wr_id="+wr_id,"PrintWin","width=800, height=700, scrollbars=yes");
                                p.focus();
                            }
                            function GPEN3_PRINT(wr_id){
                                //alert("팝업이 뜨면 인쇄를 한번더 클릭해주세요.\n 인터넷 익스플로러에서만 인쇄가 가능합니다.");
                                var p = window.open("/adframe/mng/recruit2/print3.php?wr_id="+wr_id,"PrintWin","width=800, height=700, scrollbars=yes");
                                p.focus();
                            }

                        </script>

                        <h3 class="contents-title">
                            교원모집
                            <span class="arrow"></span>
                        </h3>

                        <div id="contents_recruit">
                            <div class="left">
                                <h4 class="title-type01">
									서류작성시 유의사항
								</h4>
                            </div>
                            <div style="margin:10px 0 30px 0;">
<textarea style="width:100%; height:200px; padding: 10px; font-family: 'Noto Sans KR', sans-serif" readonly>
1. 지원서 작성시 유의사항
&nbsp;&nbsp;가. 누락되는 부분이 없도록 정확하게 작성하고 반드시 지원자 서명 또는 날인을 해 주십시오.
&nbsp;&nbsp;나. 지원사항은 초빙 공고와 일치하게 지원학과, 전공분야을 정확하게 구분하여 작성하고, 성명란은 FULL NAME으로 각각 기재해 주십시오.
&nbsp;&nbsp;다. 전화번호는 언제라도 연락이 가능한 곳으로 정확하게 기재해 주십시오.
&nbsp;&nbsp;라. 기간은 입학일과 학위취득일(졸업)을 기재하며, 학교명은 FULL NAME으로 기재해 주십시오.
&nbsp;&nbsp;마. 학위명은 학위증서에 명시된 학위로 기재하고, 평점평균은 출신학교의 성적증명서와 일치 하게 기재하고 학교 특성상 석사과정이나 박사과정의 성적표가 없는 경우에는 ‘없음’으로 기재해 주십시오.
&nbsp;&nbsp;바. 학위(박사, 석사, 학사)를 2개 이상 취득한 경우에는 모두 기재해 주십시오.
&nbsp;&nbsp;사. 경력사항은 최근 경력부터 기재하며, 경력증명서를 제출한 사항에 대하여만 기재해 주십시오.

2. 기타
&nbsp;&nbsp;가. 제출서류는 접수기한 도착분에 한하며, 방문 또는 우편접수 가능합니다.
&nbsp;&nbsp;나. E-mail로는 접수받지 않습니다.
</textarea>
                            </div>
                            <!--<div style="text-align:right;">
                                <input type="button" value="전임교원 신규임용 규정 다운로드" onclick="location.href='download1.php'" style="padding:10px 20px; border:0; background:#f53d3d;font-weight:bold;color:#FFFFFF;cursor:pointer"/>
                            </div>-->
                            <div class="cont">
                                <h5 class="title-type02">춘해보건대학교 겸임교수 초빙 이력서</h5>
                                <?php
                                if ( $j == "u" ) {
                                    ?>
                                    <p>
                                        <input type="button" value="기본사항 인쇄" style="padding:5px 10px; border:0; background:#f53d3d;font-weight:bold;color:#FFFFFF;cursor:pointer" onclick="GPEN_PRINT(<?=$wr_id?>)"/>&nbsp;
                                        <input type="button" value="자기소개서 인쇄" style="padding:5px 10px; border:0; background:#f53d3d;font-weight:bold;color:#FFFFFF;cursor:pointer" onclick="GPEN2_PRINT(<?=$wr_id?>)"/>&nbsp;
                                        <!--<input type="button" value="연구실적 인쇄" style="padding:5px 10px; border:0; background:#f53d3d;font-weight:bold;color:#FFFFFF;cursor:pointer" onclick="GPEN3_PRINT(<?=$wr_id?>)"/>-->
                                    </p>
                                <?php } ?>
                                <form name="frm" method="POST" action="proc.php" onsubmit="return check_form(this)" enctype="multipart/form-data"  >
                                    <input type="hidden" name="j" value="<?=$j?>" />
                                    <input type="hidden" name="wr_id" value="<?=$row[wr_id]?>" />
                                    <input type="hidden" name="pass_check" value="<?=$pass?>" />
                                    <input type="hidden" name="resume_num" value="<?=$resume_num?>" />
                                    <table class="table_box_recruit">
                                        <colgroup>
                                            <col width="125px">
                                            <col width="125px">
                                            <col width="100px">
                                            <col width="125px">
                                            <col width="125px">
                                            <col width="125px">
                                            <col width="125px">
                                            <col width="150px">
                                        </colgroup>
                                        <tr>
                                            <td colspan="6" class="sub_title">1.지원사항</td>
                                            <td colspan="2" rowspan="4"><?if($row[file_name]){?><img id="img_preview" src="<?=$row[file_name]?>" width="150px"/><?}else{?>사진<br />(3cm X 4cm)<br />아래의 찾아보기로 사진을 추가하세요.<img id="img_preview" style="display:none;" width="150px"/><?}?></td>
                                        </tr>
                                        <tr>
                                            <th><span style="color:red;font-size:150%">*</span>&nbsp;지원학과</th>
                                            <td colspan="2" class="left">
                                                <input type="text" name="apply_major" value="<?=$row['apply_major']?>">
                                            </td>

                                            <th><span style="color:red;font-size:150%">*</span>&nbsp;초빙분야</th>
                                            <td colspan="2" id="td_type_gubun">겸임교수
                                                <input type="hidden" name="type_gubun" value="겸임교수">
                                            </td>

                                        </tr>

                                        <tr>
                                            <th><span style="color:red;font-size:150%">*</span>&nbsp;초빙분야 구분번호</th>
                                            <td colspan="2" class="left"><input type="text" name="major" value="<?=$row[major]?>"/></td>
											<th><span style="color:red;font-size:150%">*</span>&nbsp;담당과목명</th>
                                            <td colspan="2" class="left"><input type="text" name="damdang_class" value="<?=$row[damdang_class]?>"/></td>
                                        </tr>
                                        <tr>
                                            <th>성명</th>
                                            <td class="left" colspan="2">
                                                <span style="color:red;font-size:150%">*</span>&nbsp;[국문]<br />
                                                <input type="text" name="kor_name" value="<?=$kor_name?>" />
                                            </td>
                                            <td class="left" colspan="2">
                                                [영문]<br />
                                                <input type="text" name="eng_name" value="<?=$row[eng_name]?>" />
                                            </td>
                                            <td class="left">
                                                [한문]<br />
                                                <input type="text" name="chi_name" style="width:100px;" value="<?=$row[chi_name]?>" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" class="sub_title">2.인적사항</td>
                                            <td colspan="2"><span style="color:red;font-size:150%">*</span>&nbsp;<input type="file" name="file1" style="width:230px; padding: 0;" id="input_file"/></td>
                                        </tr>
                                        <tr>
                                            <th><span style="color:red;font-size:150%">*</span>&nbsp;성별</th>
                                            <td><input type="radio" name="sex" value="남" <?if($row[sex]=="남"){echo "checked";}?>/>&nbsp;남&nbsp;&nbsp;<input type="radio" name="sex" value="여" <?if($row[sex]=="여"){echo "checked";}?>/>&nbsp;여</td>
                                            <th>국적</th>
                                            <td colspan="3"><input type="text" name="country" style="width:100px" value="<?=$row[country]?>"/></td>
                                            <th>병역</th>
                                            <td><input type="radio" name="army" value="필" <?if($row[army]=="필"){echo "checked";}?>/>&nbsp;필&nbsp;&nbsp;<input type="radio" name="army" value="미필" <?if($row[army]=="미필"){echo "checked";}?>/>&nbsp;미필&nbsp;&nbsp;<input type="radio" name="army" value="면제" <?if($row[army]=="면제"){echo "checked";}?>/>&nbsp;면제</td>
                                        </tr>
                                        <?
                                        $birth = explode("-",$row[birth]);
                                        $hTel = explode("-",$row[hTel]);
                                        $jTel = explode("-",$row[jTel]);
                                        $phone = explode("-",$phone);
                                        $zip = explode("-",$row[zip]);
                                        ?>
                                        <tr>
                                            <th><span style="color:red;font-size:150%">*</span>&nbsp;생년월일</th>
                                            <td colspan="4"><input type="text" name="bYear" style="width:60px;" maxlength="4" value="<?=$birth[0]?>"/>년&nbsp;&nbsp;<input type="text" name="bMonth" style="width:60px;" maxlength="2" value="<?=$birth[1]?>"/>월&nbsp;&nbsp;<input type="text" name="bDay" style="width:60px;" maxlength="2" value="<?=$birth[2]?>"/>일&nbsp;&nbsp;(만<input type="text" name="age" style="width:40px;ime-mode:disabled" maxlength="2" value="<?=$row[age]?>"/>세)</td>
                                            <th rowspan="3">연락처</th>
                                            <td colspan="2" rowspan="3" class="left">
                                                <div><span style="width:60px;display:inline-block">자택</span> : <input type="text" name="hTel1" style="width:40px;ime-mode:disabled" maxlength="4" value="<?=$hTel[0]?>"/> - <input type="text" name="hTel2" style="width:40px;ime-mode:disabled" maxlength="4"  value="<?=$hTel[1]?>"/> - <input type="text" name="hTel3" style="width:40px;ime-mode:disabled" maxlength="4"  value="<?=$hTel[2]?>"/></div>
                                                <div style="margin-top:5px;"><span style="width:60px; display:inline-block">직장</span> : <input type="text" name="jTel1" style="width:40px;ime-mode:disabled" maxlength="4"  value="<?=$jTel[0]?>"/> - <input type="text" name="jTel2" style="width:40px;ime-mode:disabled" maxlength="4"  value="<?=$jTel[1]?>"/> - <input type="text" name="jTel3" style="width:40px;ime-mode:disabled" maxlength="4"  value="<?=$jTel[2]?>"/></div>
                                                <div style="margin-top:5px;"><span style="width:60px; display:inline-block"><span style="color:red;font-size:150%">*</span>&nbsp;휴대폰</span> : <input type="text" name="phone1" style="width:40px;ime-mode:disabled" maxlength="4"  value="<?=$phone[0]?>"/> - <input type="text" name="phone2" style="width:40px;ime-mode:disabled" maxlength="4" value="<?=$phone[1]?>"/> - <input type="text" name="phone3" style="width:40px;ime-mode:disabled" maxlength="4" value="<?=$phone[2]?>"/></div>
                                                <div style="margin-top:5px;"><span style="width:60px; display:inline-block"><span style="color:red;font-size:150%">*</span>&nbsp;Email</span> : <input type="text" name="email" style="width:150px" value="<?=$row[email]?>"/> </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th><span style="color:red;font-size:150%">*</span>&nbsp;현주소<br />(국내연락처)</th>
                                            <td colspan="4" class="left">
                                                <div >
                                                    (우편번호 :
                                                    <? if ( $resume_num >= 15 ) { ?>
                                                        <input type="text" name="zonecode" id="zonecode" maxlength="5" style="width: 80px; text-align: center" readonly value="<?=$row[zonecode]?>">
                                                        <input type="hidden" name="zip1" id="zip1" maxlength="3" style="width:40px;text-align:center" readonly value="<?=$zip[0]?>"/>
                                                        <input type="hidden" name="zip2" id="zip2" maxlength="3" style="width:40px;text-align:center;" readonly value="<?=$zip[1]?>"/>
                                                    <? } else { ?>
                                                        <input type="hidden" name="zonecode" id="zonecode" maxlength="5" style="width: 80px; text-align: center" readonly value="<?=$row[zonecode]?>">
                                                        <input type="text" name="zip1" id="zip1" maxlength="3" style="width:40px;text-align:center" readonly value="<?=$zip[0]?>"/> -
                                                        <input type="text" name="zip2" id="zip2" maxlength="3" style="width:40px;text-align:center;" readonly value="<?=$zip[1]?>"/>
                                                    <? } ?>
                                                    )
                                                    &nbsp;&nbsp;<input type="button" value="우편번호검색" class="btn" onclick="openDaumPostcode()"/></div>
                                                <div style="padding-top:5px;"><input type="text" name="addr1" id="addr1" style="width:400px" readonly value="<?=$row[addr1]?>"/></div>
                                                <div style="padding-top:5px;"><input type="text" name="addr2" id="addr2" style="width:400px" value="<?=$row[addr2]?>"/></div>
                                            </td>
                                        </tr>
                                        <script src="//t1.kakaocdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
                                        <script>
                                            function openDaumPostcode() {
                                                new daum.Postcode({
                                                    oncomplete: function(data) {
                                                        document.getElementById("zonecode").value = data.zonecode;
                                                        document.getElementById("zip1").value = data.postcode1;
                                                        document.getElementById("zip2").value = data.postcode2;
                                                        document.getElementById("addr1").value = data.address;
                                                        document.getElementById("addr2").focus();
                                                    }
                                                }).open();
                                            }
                                        </script>
                                        <tr>
                                            <th>현근무지</th>
                                            <td colspan="2" class="left"><input type="text" name="company" style="width:300px;" value="<?=$row[company]?>"/></td>
                                            <th> 직위 </th>
                                            <td>
                                                <input type="text" name="company_auth" value="<?=$row['company_auth']?>">
                                            </td>
                                        </tr>
                                        <!-- // 2021.01.19 추가 By.Son -->
                                        <tr>
                                            <th> 은행명 </th>
                                            <td colspan="3">
                                                <input type="text" name="bank_name" value="<?=$row['bank_name']?>">
                                            </td>
                                            <th> 계좌번호 </th>
                                            <td colspan="3">
                                                <input type="text" name="bank_account" value="<?=$row['bank_account']?>">
                                            </td>
                                        </tr>

                                        <tr>
                                            <td colspan="8" class="sub_title">3. 학력사항</td>
                                        </tr>
                                        <tr>
                                        <th>구분</th>
                                        <th colspan="2">기간</th>
                                            <th>수여기관(학교명)</th>
                                            <th>소재지</th>
                                            <th>전공</th>
                                            <th>학위명<br/>(학위취득일)</th>
                                            <th>평균평점</th>
                                            </tr>
                                            <?
                                            $hPeriod = explode("~",$row[hPeriod]);
                                            $cPeriod = explode("~",$row[cPeriod]);
                                            $cPeriod1 = explode("~",$row[cPeriod1]);
                                            $uPeriod = explode("~",$row[uPeriod]);
                                            $uPeriod1 = explode("~",$row[uPeriod1]);

                                            $mPeriod = explode("~",$row[mPeriod]);
                                            $mPeriod1 = explode("~",$row[mPeriod1]);
                                            $dPeriod = explode("~",$row[dPeriod]);
                                            $dPeriod1 = explode("~",$row[dPeriod1]);
                                            ?>
                                            <tr>
                                            <th>박사</th>
                                            <td colspan="2"><input type="text" name="dPeriod1" style="width:80px;" value="<?=$dPeriod[0]?>" /> ~ <input type="text" name="dPeriod2" style="width:80px;" value="<?=$dPeriod[1]?>" /> </td>
                                            <td><input type="text" name="doctor" value="<?=$row[doctor]?>" /></td>
                                            <td><input type="text" name="doctor_addr" value="<?=$sql_school_addr[doctor_addr]?>" /></td>
                                            <td><input type="text" name="dMajor" style="width:100px;" value="<?=$row[dMajor]?>" /></td>
                                            <td><input type="text" name="dDegree" style="width:100px" value="<?=$row[dDegree]?>" /><br /> (<input type="text" name="dDegree_date" style="width:80px;" value="<?=$row[dDegree_date]?>" />)</td>
                                        <td><input type="text" name="dScore" style="width:30px;" value="<?=$row[dScore]?>" /> / <input type="text" name="dTotal" style="width:30px;" value="<?=$row[dTotal]?>"/></td>
                                            </tr>
                                            <tr>
                                            <th>박사</th>
                                            <td colspan="2"><input type="text" name="dPeriod1_1" style="width:80px;" value="<?=$dPeriod1[0]?>" /> ~ <input type="text" name="dPeriod1_2" style="width:80px;" value="<?=$dPeriod1[1]?>" /> </td>
                                            <td><input type="text" name="doctor1" value="<?=$row[doctor1]?>" /></td>
                                            <td><input type="text" name="doctor1_addr" value="<?=$sql_school_addr[doctor1_addr]?>" /></td>
                                            <td><input type="text" name="dMajor1" style="width:100px;" value="<?=$row[dMajor1]?>" /></td>
                                            <td><input type="text" name="dDegree1" style="width:100px" value="<?=$row[dDegree1]?>" /><br /> (<input type="text" name="dDegree_date1" style="width:80px;" value="<?=$row[dDegree_date1]?>" />)</td>
                                        <td><input type="text" name="dScore1" style="width:30px;" value="<?=$row[dScore1]?>" /> / <input type="text" name="dTotal1" style="width:30px;" value="<?=$row[dTotal1]?>"/></td>
                                            </tr>
                                            <tr>
                                            <th>석사</th>
                                            <td colspan="2"><input type="text" name="mPeriod1" style="width:80px;" value="<?=$mPeriod[0]?>" /> ~ <input type="text" name="mPeriod2" style="width:80px;" value="<?=$mPeriod[1]?>" /> </td>
                                            <td><input type="text" name="master" value="<?=$row[master]?>"/></td>
                                            <td><input type="text" name="master_addr" value="<?=$sql_school_addr[master_addr]?>"/></td>
                                            <td><input type="text" name="mMajor" style="width:100px;" value="<?=$row[mMajor]?>" /></td>
                                            <td><input type="text" name="mDegree" style="width:100px" value="<?=$row[mDegree]?>" /><br /> (<input type="text" name="mDegree_date" style="width:80px;" value="<?=$row[mDegree_date]?>"/>)</td>
                                        <td><input type="text" name="mScore" style="width:30px;" value="<?=$row[mScore]?>" /> / <input type="text" name="mTotal" style="width:30px;" value="<?=$row[mTotal]?>" /></td>
                                            </tr>
                                            <tr>
                                            <th>석사</th>
                                            <td colspan="2"><input type="text" name="mPeriod1_1" style="width:80px;" value="<?=$mPeriod1[0]?>" /> ~ <input type="text" name="mPeriod1_2" style="width:80px;" value="<?=$mPeriod1[1]?>" /> </td>
                                            <td><input type="text" name="master1" value="<?=$row[master1]?>"/></td>
                                            <td><input type="text" name="master1_addr" value="<?=$sql_school_addr[master1_addr]?>"/></td>
                                            <td><input type="text" name="mMajor1" style="width:100px;" value="<?=$row[mMajor1]?>" /></td>
                                            <td><input type="text" name="mDegree1" style="width:100px" value="<?=$row[mDegree1]?>" /><br /> (<input type="text" name="mDegree_date1" style="width:80px;" value="<?=$row[mDegree_date1]?>"/>)</td>
                                        <td><input type="text" name="mScore1" style="width:30px;" value="<?=$row[mScore1]?>" /> / <input type="text" name="mTotal1" style="width:30px;" value="<?=$row[mTotal1]?>" /></td>
                                            </tr>
                                            <tr>
                                            <th><span style="color:red;font-size:150%">*</span>&nbsp;학사</th>
                                        <td colspan="2"><input type="text" name="uPeriod1" style="width:80px;" value="<?=$uPeriod[0]?>"/> ~ <input type="text" name="uPeriod2" style="width:80px;" value="<?=$uPeriod[1]?>"/> </td>
                                            <td><input type="text" name="univ" value="<?=$row[univ]?>"/></td>
                                            <td><input type="text" name="univ_addr" value="<?=$sql_school_addr[univ_addr]?>"/></td>
                                            <td><input type="text" name="uMajor" style="width:100px;" value="<?=$row[uMajor]?>" /></td>
                                            <td><input type="text" name="uDegree" style="width:100px" value="<?=$row[uDegree]?>" /><br /> (<input type="text" name="uDegree_date" style="width:80px;" value="<?=$row[uDegree_date]?>"/>)</td>
                                        <td><input type="text" name="uScore" style="width:30px;" value="<?=$row[uScore]?>" /> / <input type="text" name="uTotal" style="width:30px;" value="<?=$row[uTotal]?>" /></td>
                                            </tr>
                                            <tr>
                                            <th>학사</th>
                                            <td colspan="2"><input type="text" name="uPeriod1_1" style="width:80px;" value="<?=$uPeriod1[0]?>"/> ~ <input type="text" name="uPeriod1_2" style="width:80px;" value="<?=$uPeriod1[1]?>"/> </td>
                                            <td><input type="text" name="univ1" value="<?=$row[univ1]?>"/></td>
                                            <td><input type="text" name="univ1_addr" value="<?=$sql_school_addr[univ1_addr]?>"/></td>
                                            <td><input type="text" name="uMajor1" style="width:100px;" value="<?=$row[uMajor1]?>" /></td>
                                            <td><input type="text" name="uDegree1" style="width:100px" value="<?=$row[uDegree1]?>" /><br /> (<input type="text" name="uDegree_date1" style="width:80px;" value="<?=$row[uDegree_date1]?>"/>)</td>
                                        <td><input type="text" name="uScore1" style="width:30px;" value="<?=$row[uScore1]?>" /> / <input type="text" name="uTotal1" style="width:30px;" value="<?=$row[uTotal1]?>" /></td>
                                            </tr>
                                            <tr>
                                            <th>전문학사</th>
                                            <td colspan="2"><input type="text" name="cPeriod1" style="width:80px;" value="<?=$cPeriod[0]?>"/> ~ <input type="text" name="cPeriod2" style="width:80px;" value="<?=$cPeriod[1]?>"/> </td>
                                            <td><input type="text" name="colleage" value="<?=$row[colleage]?>"/></td>
                                            <td><input type="text" name="colleage_addr" value="<?=$sql_school_addr[colleage_addr]?>"/></td>
                                            <td><input type="text" name="cMajor" style="width:100px;" value="<?=$row[cMajor]?>"/></td>
                                            <td><input type="text" name="cDegree" style="width:100px" value="<?=$row[cDegree]?>"/><br /> (<input type="text" name="cDegree_date" style="width:80px;" value="<?=$row[cDegree_date]?>"/>)</td>
                                        <td><input type="text" name="cScore" style="width:30px;" value="<?=$row[cScore]?>"/> / <input type="text" name="cTotal" style="width:30px;" value="<?=$row[cTotal]?>"/></td>
                                            </tr>
                                            <tr>
                                            <th>전문학사</th>
                                            <td colspan="2"><input type="text" name="cPeriod1_1" style="width:80px;" value="<?=$cPeriod1[0]?>"/> ~ <input type="text" name="cPeriod1_2" style="width:80px;" value="<?=$cPeriod1[1]?>"/> </td>
                                            <td><input type="text" name="colleage1" value="<?=$row[colleage1]?>"/></td>
                                            <td><input type="text" name="colleage1_addr" value="<?=$sql_school_addr[colleage1_addr]?>"/></td>
                                            <td><input type="text" name="cMajor1" style="width:100px;" value="<?=$row[cMajor1]?>"/></td>
                                            <td><input type="text" name="cDegree1" style="width:100px" value="<?=$row[cDegree1]?>"/><br /> (<input type="text" name="cDegree_date1" style="width:80px;" value="<?=$row[cDegree_date1]?>"/>)</td>
                                        <td><input type="text" name="cScore1" style="width:30px;" value="<?=$row[cScore1]?>"/> / <input type="text" name="cTotal1" style="width:30px;" value="<?=$row[cTotal1]?>"/></td>
                                            </tr>
                                            <tr>
                                            <th><span style="color:red;font-size:150%">*</span>&nbsp;고등학교</th>
                                        <td colspan="2"><input type="text" name="hPeriod1" style="width:80px;" value="<?=$hPeriod[0]?>"/> ~ <input type="text" name="hPeriod2" style="width:80px;" value="<?=$hPeriod[1]?>"/> </td>
                                            <td><input type="text" name="hSchool" value="<?=$row[hSchool]?>" /></td>
                                            <td><input type="text" name="hSchool_addr" value="<?=$sql_school_addr[hSchool_addr]?>" /></td>
                                            <td>-</td>
                                            <td>-</td>
                                            <td>-</td>
                                            </tr>



                                            <tr>
                                            <td colspan="8" class="sub_title">4. 경력사항(경력은 증빙서류를 첨부한 것만 인정됨, 경력증명서는 우편으로 접수 받습니다.)<br />※ 최종 임용될 경우 자격 및 호봉 산출자료로 활용되오니 정확히 작성바랍니다.</td>
                                        </tr>
                                        <tr>
                                        <th colspan="3">기간</th>
                                            <th colspan="2">근무년월</th>
                                            <th colspan="2">근무기관명</th>
                                            <th>직위</th>
                                            </tr>
                                            <?
                                            //print_r($row);
                                            //echo $row[jobPeriod1];
                                            $jpsPeriod1 = explode("-",$row[jpsPeriod1]);
                                            $jpePeriod1 = explode("-",$row[jpePeriod1]);
                                            $jobPeriod1 = explode("-",$row[jobPeriod1]);
                                            $jpsPeriod2 = explode("-",$row[jpsPeriod2]);
                                            $jobPeriod2 = explode("-",$row[jobPeriod2]);
                                            $jpePeriod2 = explode("-",$row[jpePeriod2]);
                                            $jpsPeriod3 = explode("-",$row[jpsPeriod3]);
                                            $jobPeriod3 = explode("-",$row[jobPeriod3]);
                                            $jpePeriod3 = explode("-",$row[jpePeriod3]);
                                            $jpsPeriod4 = explode("-",$row[jpsPeriod4]);
                                            $jobPeriod4 = explode("-",$row[jobPeriod4]);
                                            $jpePeriod4 = explode("-",$row[jpePeriod4]);
                                            $jpsPeriod5 = explode("-",$row[jpsPeriod5]);
                                            $jobPeriod5 = explode("-",$row[jobPeriod5]);
                                            $jpePeriod5 = explode("-",$row[jpePeriod5]);
                                            $jpsPeriod6 = explode("-",$row[jpsPeriod6]);
                                            $jobPeriod6 = explode("-",$row[jobPeriod6]);
                                            $jpePeriod6 = explode("-",$row[jpePeriod6]);
                                            $jpsPeriod7 = explode("-",$row[jpsPeriod7]);
                                            $jobPeriod7 = explode("-",$row[jobPeriod7]);
                                            $jpePeriod7 = explode("-",$row[jpePeriod7]);
                                            $jpsPeriod8 = explode("-",$row[jpsPeriod8]);
                                            $jobPeriod8 = explode("-",$row[jobPeriod8]);
                                            $jpePeriod8 = explode("-",$row[jpePeriod8]);
                                            $jpsPeriod9 = explode("-",$row[jpsPeriod9]);
                                            $jobPeriod9 = explode("-",$row[jobPeriod9]);
                                            $jpePeriod9 = explode("-",$row[jpePeriod9]);
                                            $jpsPeriod10 = explode("-",$row[jpsPeriod10]);
                                            $jobPeriod10 = explode("-",$row[jobPeriod10]);
                                            $jpePeriod10 = explode("-",$row[jpePeriod10]);
                                            $jpsPeriod11 = explode("-",$row[jpsPeriod11]);
                                            $jobPeriod11 = explode("-",$row[jobPeriod11]);
                                            $jpePeriod11 = explode("-",$row[jpePeriod11]);
                                            $jpsPeriod12 = explode("-",$row[jpsPeriod12]);
                                            $jobPeriod12 = explode("-",$row[jobPeriod12]);
                                            $jpePeriod12 = explode("-",$row[jpePeriod12]);
                                            $jpsPeriod13 = explode("-",$row[jpsPeriod13]);
                                            $jobPeriod13 = explode("-",$row[jobPeriod13]);
                                            $jpePeriod13 = explode("-",$row[jpePeriod13]);
                                            $jpsPeriod14 = explode("-",$row[jpsPeriod14]);
                                            $jobPeriod14 = explode("-",$row[jobPeriod14]);
                                            $jpePeriod14 = explode("-",$row[jpePeriod14]);
                                            $jpsPeriod15 = explode("-",$row[jpsPeriod15]);
                                            $jobPeriod15 = explode("-",$row[jobPeriod15]);
                                            $jpePeriod15 = explode("-",$row[jpePeriod15]);

                                            if(!$jobPeriod1[0])$jobPeriod1[0]=0; if(!$jobPeriod1[1])$jobPeriod1[1]=0;
                                            if(!$jobPeriod2[0])$jobPeriod2[0]=0; if(!$jobPeriod2[1])$jobPeriod2[1]=0;
                                            if(!$jobPeriod3[0])$jobPeriod3[0]=0; if(!$jobPeriod3[1])$jobPeriod3[1]=0;
                                            if(!$jobPeriod4[0])$jobPeriod4[0]=0; if(!$jobPeriod4[1])$jobPeriod4[1]=0;
                                            if(!$jobPeriod5[0])$jobPeriod5[0]=0; if(!$jobPeriod5[1])$jobPeriod5[1]=0;
                                            if(!$jobPeriod6[0])$jobPeriod6[0]=0; if(!$jobPeriod6[1])$jobPeriod6[1]=0;
                                            if(!$jobPeriod7[0])$jobPeriod7[0]=0; if(!$jobPeriod7[1])$jobPeriod7[1]=0;
                                            if(!$jobPeriod8[0])$jobPeriod8[0]=0; if(!$jobPeriod8[1])$jobPeriod8[1]=0;
                                            if(!$jobPeriod9[0])$jobPeriod9[0]=0; if(!$jobPeriod9[1])$jobPeriod9[1]=0;
                                            if(!$jobPeriod10[0])$jobPeriod10[0]=0; if(!$jobPeriod10[1])$jobPeriod10[1]=0;
                                            if(!$jobPeriod11[0])$jobPeriod11[0]=0; if(!$jobPeriod11[1])$jobPeriod11[1]=0;
                                            if(!$jobPeriod12[0])$jobPeriod12[0]=0; if(!$jobPeriod12[1])$jobPeriod12[1]=0;
                                            if(!$jobPeriod13[0])$jobPeriod13[0]=0; if(!$jobPeriod13[1])$jobPeriod13[1]=0;
                                            if(!$jobPeriod14[0])$jobPeriod14[0]=0; if(!$jobPeriod14[1])$jobPeriod14[1]=0;
                                            if(!$jobPeriod15[0])$jobPeriod15[0]=0; if(!$jobPeriod15[1])$jobPeriod15[1]=0;
                                            ?>
                                            <tr>
                                            <td colspan="3"><input type="text" name="jpsYear1" style="width:40px;ime-mode:disabled" maxlength="4" value="<?=$jpsPeriod1[0]?>" onkeyPress="InpuOnlyNumber(this);"/>.<input type="text" name="jpsMonth1" style="width:40px;ime-mode:disabled" maxlength="2" value="<?=$jpsPeriod1[1]?>" onkeyPress="InpuOnlyNumber(this);"/>.<input type="text" name="jpsDate1" style="width:40px;ime-mode:disabled" maxlength="2" value="<?=$jpsPeriod1[2]?>" onkeyPress="InpuOnlyNumber(this);"/> ~ <input type="text" name="jpeYear1" style="width:40px;ime-mode:disabled" maxlength="4" value="<?=$jpePeriod1[0]?>" onkeyPress="InpuOnlyNumber(this);"/>.<input type="text" name="jpeMonth1" style="width:40px;ime-mode:disabled" maxlength="2" value="<?=$jpePeriod1[1]?>" onkeyPress="InpuOnlyNumber(this);"/>.<input type="text" name="jpeDate1" style="width:40px;ime-mode:disabled" maxlength="2" value="<?=$jpePeriod1[2]?>" onkeyPress="InpuOnlyNumber(this);" /></td>
                                            <td colspan="2"><input type="text" name="jobYear1" style="width:40px;ime-mode:disabled" maxlength="2" value="<?=$jobPeriod1[0]?>"/>&nbsp;년&nbsp;&nbsp;<input type="text" name="jobMonth1" style="width:40px;ime-mode:disabled" maxlength="2" value="<?=$jobPeriod1[1]?>"/>&nbsp;월</td>
                                        <td colspan="2"><input type="text" name="jobCompany1" value="<?=$row[jobCompany1]?>"/> </td>
                                            <td><input type="text" name="jobDegree1" style="width:100px;" value="<?=$row[jobDegree1]?>"/></td>
                                            </tr>
                                            <tr>
                                            <td colspan="3"><input type="text" name="jpsYear2" style="width:40px;ime-mode:disabled" maxlength="4" value="<?=$jpsPeriod2[0]?>" onkeyPress="InpuOnlyNumber(this);"/>.<input type="text" name="jpsMonth2" style="width:40px;ime-mode:disabled" maxlength="2" value="<?=$jpsPeriod2[1]?>" onkeyPress="InpuOnlyNumber(this);"/>.<input type="text" name="jpsDate2" style="width:40px;ime-mode:disabled" maxlength="2" value="<?=$jpsPeriod2[2]?>" onkeyPress="InpuOnlyNumber(this);"/> ~ <input type="text" name="jpeYear2" style="width:40px;ime-mode:disabled" maxlength="4" value="<?=$jpePeriod2[0]?>" onkeyPress="InpuOnlyNumber(this);"/>.<input type="text" name="jpeMonth2" style="width:40px;ime-mode:disabled" maxlength="2" value="<?=$jpePeriod2[1]?>" onkeyPress="InpuOnlyNumber(this);"/>.<input type="text" name="jpeDate2" style="width:40px;ime-mode:disabled" maxlength="2" value="<?=$jpePeriod2[2]?>" onkeyPress="InpuOnlyNumber(this);"/></td>
                                            <td colspan="2"><input type="text" name="jobYear2" style="width:40px;ime-mode:disabled" maxlength="2" value="<?=$jobPeriod2[0]?>"/>&nbsp;년&nbsp;&nbsp;<input type="text" name="jobMonth2" style="width:40px;ime-mode:disabled" maxlength="2" value="<?=$jobPeriod2[1]?>"/>&nbsp;월</td>
                                        <td colspan="2"><input type="text" name="jobCompany2" value="<?=$row[jobCompany2]?>"/> </td>
                                            <td><input type="text" name="jobDegree2" style="width:100px;" value="<?=$row[jobDegree2]?>"/></td>
                                            </tr>
                                            <tr>
                                            <td colspan="3"><input type="text" name="jpsYear3" style="width:40px;ime-mode:disabled" maxlength="4" value="<?=$jpsPeriod3[0]?>" onkeyPress="InpuOnlyNumber(this);"/>.<input type="text" name="jpsMonth3" style="width:40px;ime-mode:disabled" maxlength="2" value="<?=$jpsPeriod3[1]?>" onkeyPress="InpuOnlyNumber(this);"/>.<input type="text" name="jpsDate3" style="width:40px;ime-mode:disabled" maxlength="2" value="<?=$jpsPeriod3[2]?>" onkeyPress="InpuOnlyNumber(this);"/> ~ <input type="text" name="jpeYear3" style="width:40px;ime-mode:disabled" maxlength="4" value="<?=$jpePeriod3[0]?>" onkeyPress="InpuOnlyNumber(this);"/>.<input type="text" name="jpeMonth3" style="width:40px;ime-mode:disabled" maxlength="2" value="<?=$jpePeriod3[1]?>" onkeyPress="InpuOnlyNumber(this);"/>.<input type="text" name="jpeDate3" style="width:40px;ime-mode:disabled" maxlength="2" value="<?=$jpePeriod3[2]?>" onkeyPress="InpuOnlyNumber(this);"/></td>
                                            <td colspan="2"><input type="text" name="jobYear3" style="width:40px;ime-mode:disabled" maxlength="2" value="<?=$jobPeriod3[0]?>"/>&nbsp;년&nbsp;&nbsp;<input type="text" name="jobMonth3" style="width:40px;ime-mode:disabled" maxlength="2" value="<?=$jobPeriod3[1]?>"/>&nbsp;월</td>
                                        <td colspan="2"><input type="text" name="jobCompany3" value="<?=$row[jobCompany3]?>"/> </td>
                                            <td><input type="text" name="jobDegree3" style="width:100px;" value="<?=$row[jobDegree3]?>"/></td>
                                            </tr>
                                            <tr>
                                            <td colspan="3"><input type="text" name="jpsYear4" style="width:40px;ime-mode:disabled" maxlength="4" value="<?=$jpsPeriod4[0]?>" onkeyPress="InpuOnlyNumber(this);"/>.<input type="text" name="jpsMonth4" style="width:40px;ime-mode:disabled" maxlength="2" value="<?=$jpsPeriod4[1]?>" onkeyPress="InpuOnlyNumber(this);"/>.<input type="text" name="jpsDate4" style="width:40px;ime-mode:disabled" maxlength="2" value="<?=$jpsPeriod4[2]?>" onkeyPress="InpuOnlyNumber(this);"/> ~ <input type="text" name="jpeYear4" style="width:40px;ime-mode:disabled" maxlength="4" value="<?=$jpePeriod4[0]?>" onkeyPress="InpuOnlyNumber(this);"/>.<input type="text" name="jpeMonth4" style="width:40px;ime-mode:disabled" maxlength="2" value="<?=$jpePeriod4[1]?>" onkeyPress="InpuOnlyNumber(this);"/>.<input type="text" name="jpeDate4" style="width:40px;ime-mode:disabled" maxlength="2" value="<?=$jpePeriod4[2]?>" onkeyPress="InpuOnlyNumber(this);"/></td>
                                            <td colspan="2"><input type="text" name="jobYear4" style="width:40px;ime-mode:disabled" maxlength="2" value="<?=$jobPeriod4[0]?>"/>&nbsp;년&nbsp;&nbsp;<input type="text" name="jobMonth4" style="width:40px;ime-mode:disabled" maxlength="2" value="<?=$jobPeriod4[1]?>"/>&nbsp;월</td>
                                        <td colspan="2"><input type="text" name="jobCompany4" value="<?=$row[jobCompany4]?>"/> </td>
                                            <td><input type="text" name="jobDegree4" style="width:100px;" value="<?=$row[jobDegree4]?>"/></td>
                                            </tr>
                                            <tr>
                                            <td colspan="3"><input type="text" name="jpsYear5" style="width:40px;ime-mode:disabled" maxlength="4" value="<?=$jpsPeriod5[0]?>" onkeyPress="InpuOnlyNumber(this);"/>.<input type="text" name="jpsMonth5" style="width:40px;ime-mode:disabled" maxlength="2" value="<?=$jpsPeriod5[1]?>" onkeyPress="InpuOnlyNumber(this);"/>.<input type="text" name="jpsDate5" style="width:40px;ime-mode:disabled" maxlength="2" value="<?=$jpsPeriod5[2]?>" onkeyPress="InpuOnlyNumber(this);"/> ~ <input type="text" name="jpeYear5" style="width:40px;ime-mode:disabled" maxlength="4" value="<?=$jpePeriod5[0]?>" onkeyPress="InpuOnlyNumber(this);"/>.<input type="text" name="jpeMonth5" style="width:40px;ime-mode:disabled" maxlength="2" value="<?=$jpePeriod5[1]?>" onkeyPress="InpuOnlyNumber(this);"/>.<input type="text" name="jpeDate5" style="width:40px;ime-mode:disabled" maxlength="2" value="<?=$jpePeriod5[2]?>" onkeyPress="InpuOnlyNumber(this);"/></td>
                                            <td colspan="2"><input type="text" name="jobYear5" style="width:40px;ime-mode:disabled" maxlength="2" value="<?=$jobPeriod5[0]?>"/>&nbsp;년&nbsp;&nbsp;<input type="text" name="jobMonth5" style="width:40px;ime-mode:disabled" maxlength="2" value="<?=$jobPeriod5[1]?>"/>&nbsp;월</td>
                                        <td colspan="2"><input type="text" name="jobCompany5" value="<?=$row[jobCompany5]?>"/> </td>
                                            <td><input type="text" name="jobDegree5" style="width:100px;" value="<?=$row[jobDegree5]?>"/></td>
                                            </tr>
                                            <tr>
                                            <td colspan="3"><input type="text" name="jpsYear6" style="width:40px;ime-mode:disabled" maxlength="4" value="<?=$jpsPeriod6[0]?>" onkeyPress="InpuOnlyNumber(this);"/>.<input type="text" name="jpsMonth6" style="width:40px;ime-mode:disabled" maxlength="2" value="<?=$jpsPeriod6[1]?>" onkeyPress="InpuOnlyNumber(this);"/>.<input type="text" name="jpsDate6" style="width:40px;ime-mode:disabled" maxlength="2" value="<?=$jpsPeriod6[2]?>" onkeyPress="InpuOnlyNumber(this);"/> ~ <input type="text" name="jpeYear6" style="width:40px;ime-mode:disabled" maxlength="4" value="<?=$jpePeriod6[0]?>" onkeyPress="InpuOnlyNumber(this);"/>.<input type="text" name="jpeMonth6" style="width:40px;ime-mode:disabled" maxlength="2" value="<?=$jpePeriod6[1]?>" onkeyPress="InpuOnlyNumber(this);"/>.<input type="text" name="jpeDate6" style="width:40px;ime-mode:disabled" maxlength="2" value="<?=$jpePeriod6[2]?>" onkeyPress="InpuOnlyNumber(this);"/></td>
                                            <td colspan="2"><input type="text" name="jobYear6" style="width:40px;ime-mode:disabled" maxlength="2" value="<?=$jobPeriod6[0]?>"/>&nbsp;년&nbsp;&nbsp;<input type="text" name="jobMonth6" style="width:40px;ime-mode:disabled" maxlength="2" value="<?=$jobPeriod6[1]?>"/>&nbsp;월</td>
                                        <td colspan="2"><input type="text" name="jobCompany6" value="<?=$row[jobCompany6]?>"/> </td>
                                            <td><input type="text" name="jobDegree6" style="width:100px;" value="<?=$row[jobDegree6]?>"/></td>
                                            </tr>
                                            <tr>
                                            <td colspan="3"><input type="text" name="jpsYear7" style="width:40px;ime-mode:disabled" maxlength="4" value="<?=$jpsPeriod7[0]?>" onkeyPress="InpuOnlyNumber(this);"/>.<input type="text" name="jpsMonth7" style="width:40px;ime-mode:disabled" maxlength="2" value="<?=$jpsPeriod7[1]?>" onkeyPress="InpuOnlyNumber(this);"/>.<input type="text" name="jpsDate7" style="width:40px;ime-mode:disabled" maxlength="2" value="<?=$jpsPeriod7[2]?>" onkeyPress="InpuOnlyNumber(this);"/> ~ <input type="text" name="jpeYear7" style="width:40px;ime-mode:disabled" maxlength="4" value="<?=$jpePeriod7[0]?>" onkeyPress="InpuOnlyNumber(this);"/>.<input type="text" name="jpeMonth7" style="width:40px;ime-mode:disabled" maxlength="2" value="<?=$jpePeriod7[1]?>" onkeyPress="InpuOnlyNumber(this);"/>.<input type="text" name="jpeDate7" style="width:40px;ime-mode:disabled" maxlength="2" value="<?=$jpePeriod7[2]?>" onkeyPress="InpuOnlyNumber(this);"/></td>
                                            <td colspan="2"><input type="text" name="jobYear7" style="width:40px;ime-mode:disabled" maxlength="2" value="<?=$jobPeriod7[0]?>"/>&nbsp;년&nbsp;&nbsp;<input type="text" name="jobMonth7" style="width:40px;ime-mode:disabled" maxlength="2" value="<?=$jobPeriod7[1]?>"/>&nbsp;월</td>
                                        <td colspan="2"><input type="text" name="jobCompany7" value="<?=$row[jobCompany7]?>"/> </td>
                                            <td><input type="text" name="jobDegree7" style="width:100px;" value="<?=$row[jobDegree7]?>"/></td>
                                            </tr>
                                            <tr>
                                            <td colspan="3"><input type="text" name="jpsYear8" style="width:40px;ime-mode:disabled" maxlength="4" value="<?=$jpsPeriod8[0]?>" onkeyPress="InpuOnlyNumber(this);"/>.<input type="text" name="jpsMonth8" style="width:40px;ime-mode:disabled" maxlength="2" value="<?=$jpsPeriod8[1]?>" onkeyPress="InpuOnlyNumber(this);"/>.<input type="text" name="jpsDate8" style="width:40px;ime-mode:disabled" maxlength="2" value="<?=$jpsPeriod8[2]?>" onkeyPress="InpuOnlyNumber(this);"/> ~ <input type="text" name="jpeYear8" style="width:40px;ime-mode:disabled" maxlength="4" value="<?=$jpePeriod8[0]?>" onkeyPress="InpuOnlyNumber(this);"/>.<input type="text" name="jpeMonth8" style="width:40px;ime-mode:disabled" maxlength="2" value="<?=$jpePeriod8[1]?>" onkeyPress="InpuOnlyNumber(this);"/>.<input type="text" name="jpeDate8" style="width:40px;ime-mode:disabled" maxlength="2" value="<?=$jpePeriod8[2]?>" onkeyPress="InpuOnlyNumber(this);"/></td>
                                            <td colspan="2"><input type="text" name="jobYear8" style="width:40px;ime-mode:disabled" maxlength="2" value="<?=$jobPeriod8[0]?>"/>&nbsp;년&nbsp;&nbsp;<input type="text" name="jobMonth8" style="width:40px;ime-mode:disabled" maxlength="2" value="<?=$jobPeriod8[1]?>"/>&nbsp;월</td>
                                        <td colspan="2"><input type="text" name="jobCompany8" value="<?=$row[jobCompany8]?>"/> </td>
                                            <td><input type="text" name="jobDegree8" style="width:100px;" value="<?=$row[jobDegree8]?>"/></td>
                                            </tr>
                                            <tr>
                                            <td colspan="3"><input type="text" name="jpsYear9" style="width:40px;ime-mode:disabled" maxlength="4" value="<?=$jpsPeriod9[0]?>" onkeyPress="InpuOnlyNumber(this);"/>.<input type="text" name="jpsMonth9" style="width:40px;ime-mode:disabled" maxlength="2" value="<?=$jpsPeriod9[1]?>" onkeyPress="InpuOnlyNumber(this);"/>.<input type="text" name="jpsDate9" style="width:40px;ime-mode:disabled" maxlength="2" value="<?=$jpsPeriod9[2]?>" onkeyPress="InpuOnlyNumber(this);"/> ~ <input type="text" name="jpeYear9" style="width:40px;ime-mode:disabled" maxlength="4" value="<?=$jpePeriod9[0]?>" onkeyPress="InpuOnlyNumber(this);"/>.<input type="text" name="jpeMonth9" style="width:40px;ime-mode:disabled" maxlength="2" value="<?=$jpePeriod9[1]?>" onkeyPress="InpuOnlyNumber(this);"/>.<input type="text" name="jpeDate9" style="width:40px;ime-mode:disabled" maxlength="2" value="<?=$jpePeriod9[2]?>" onkeyPress="InpuOnlyNumber(this);"/></td>
                                            <td colspan="2"><input type="text" name="jobYear9" style="width:40px;ime-mode:disabled" maxlength="2" value="<?=$jobPeriod9[0]?>"/>&nbsp;년&nbsp;&nbsp;<input type="text" name="jobMonth9" style="width:40px;ime-mode:disabled" maxlength="2" value="<?=$jobPeriod9[1]?>"/>&nbsp;월</td>
                                        <td colspan="2"><input type="text" name="jobCompany9" value="<?=$row[jobCompany9]?>"/> </td>
                                            <td><input type="text" name="jobDegree9" style="width:100px;" value="<?=$row[jobDegree9]?>"/></td>
                                            </tr>
                                            <!-- 2017-01-04 입력란 추가 -->
                                            <tr>
                                            <td colspan="3">
                                            <input type="text" name="jpsYear10" style="width:40px;ime-mode:disabled" maxlength="4" value="<?=$jpsPeriod10[0]?>" onkeyPress="InpuOnlyNumber(this);"/>.
                                        <input type="text" name="jpsMonth10" style="width:40px;ime-mode:disabled" maxlength="2" value="<?=$jpsPeriod10[1]?>" onkeyPress="InpuOnlyNumber(this);"/>.
                                        <input type="text" name="jpsDate10" style="width:40px;ime-mode:disabled" maxlength="2" value="<?=$jpsPeriod10[2]?>" onkeyPress="InpuOnlyNumber(this);"/> ~
                                            <input type="text" name="jpeYear10" style="width:40px;ime-mode:disabled" maxlength="4" value="<?=$jpePeriod10[0]?>" onkeyPress="InpuOnlyNumber(this);"/>.
                                        <input type="text" name="jpeMonth10" style="width:40px;ime-mode:disabled" maxlength="2" value="<?=$jpePeriod10[1]?>" onkeyPress="InpuOnlyNumber(this);"/>.
                                        <input type="text" name="jpeDate10" style="width:40px;ime-mode:disabled" maxlength="2" value="<?=$jpePeriod10[2]?>" onkeyPress="InpuOnlyNumber(this);"/>
                                            </td>
                                            <td colspan="2">
                                            <input type="text" name="jobYear10" style="width:40px;ime-mode:disabled" maxlength="2" value="<?=$jobPeriod10[0]?>"/>&nbsp;년&nbsp;&nbsp;
                                        <input type="text" name="jobMonth10" style="width:40px;ime-mode:disabled" maxlength="2" value="<?=$jobPeriod10[1]?>"/>&nbsp;월
                                        </td>
                                        <td colspan="2"><input type="text" name="jobCompany10" value="<?=$row[jobCompany10]?>"/> </td>
                                            <td><input type="text" name="jobDegree10" style="width:100px;" value="<?=$row[jobDegree10]?>"/></td>
                                            </tr>
                                            <tr>
                                            <td colspan="3">
                                            <input type="text" name="jpsYear11" style="width:40px;ime-mode:disabled" maxlength="4" value="<?=$jpsPeriod11[0]?>" onkeyPress="InpuOnlyNumber(this);"/>.
                                        <input type="text" name="jpsMonth11" style="width:40px;ime-mode:disabled" maxlength="2" value="<?=$jpsPeriod11[1]?>" onkeyPress="InpuOnlyNumber(this);"/>.
                                        <input type="text" name="jpsDate11" style="width:40px;ime-mode:disabled" maxlength="2" value="<?=$jpsPeriod11[2]?>" onkeyPress="InpuOnlyNumber(this);"/> ~
                                            <input type="text" name="jpeYear11" style="width:40px;ime-mode:disabled" maxlength="4" value="<?=$jpePeriod11[0]?>" onkeyPress="InpuOnlyNumber(this);"/>.
                                        <input type="text" name="jpeMonth11" style="width:40px;ime-mode:disabled" maxlength="2" value="<?=$jpePeriod11[1]?>" onkeyPress="InpuOnlyNumber(this);"/>.
                                        <input type="text" name="jpeDate11" style="width:40px;ime-mode:disabled" maxlength="2" value="<?=$jpePeriod11[2]?>" onkeyPress="InpuOnlyNumber(this);"/>
                                            </td>
                                            <td colspan="2">
                                            <input type="text" name="jobYear11" style="width:40px;ime-mode:disabled" maxlength="2" value="<?=$jobPeriod11[0]?>"/>&nbsp;년&nbsp;&nbsp;
                                        <input type="text" name="jobMonth11" style="width:40px;ime-mode:disabled" maxlength="2" value="<?=$jobPeriod11[1]?>"/>&nbsp;월
                                        </td>
                                        <td colspan="2"><input type="text" name="jobCompany11" value="<?=$row[jobCompany11]?>"/> </td>
                                            <td><input type="text" name="jobDegree11" style="width:100px;" value="<?=$row[jobDegree11]?>"/></td>
                                            </tr>
                                            <tr>
                                            <td colspan="3">
                                            <input type="text" name="jpsYear12" style="width:40px;ime-mode:disabled" maxlength="4" value="<?=$jpsPeriod12[0]?>" onkeyPress="InpuOnlyNumber(this);"/>.
                                        <input type="text" name="jpsMonth12" style="width:40px;ime-mode:disabled" maxlength="2" value="<?=$jpsPeriod12[1]?>" onkeyPress="InpuOnlyNumber(this);"/>.
                                        <input type="text" name="jpsDate12" style="width:40px;ime-mode:disabled" maxlength="2" value="<?=$jpsPeriod12[2]?>" onkeyPress="InpuOnlyNumber(this);"/> ~
                                            <input type="text" name="jpeYear12" style="width:40px;ime-mode:disabled" maxlength="4" value="<?=$jpePeriod12[0]?>" onkeyPress="InpuOnlyNumber(this);"/>.
                                        <input type="text" name="jpeMonth12" style="width:40px;ime-mode:disabled" maxlength="2" value="<?=$jpePeriod12[1]?>" onkeyPress="InpuOnlyNumber(this);"/>.
                                        <input type="text" name="jpeDate12" style="width:40px;ime-mode:disabled" maxlength="2" value="<?=$jpePeriod12[2]?>" onkeyPress="InpuOnlyNumber(this);"/>
                                            </td>
                                            <td colspan="2">
                                            <input type="text" name="jobYear12" style="width:40px;ime-mode:disabled" maxlength="2" value="<?=$jobPeriod12[0]?>"/>&nbsp;년&nbsp;&nbsp;
                                        <input type="text" name="jobMonth12" style="width:40px;ime-mode:disabled" maxlength="2" value="<?=$jobPeriod12[1]?>"/>&nbsp;월
                                        </td>
                                        <td colspan="2"><input type="text" name="jobCompany12" value="<?=$row[jobCompany12]?>"/> </td>
                                            <td><input type="text" name="jobDegree12" style="width:100px;" value="<?=$row[jobDegree12]?>"/></td>
                                            </tr>
                                            <tr>
                                            <td colspan="3">
                                            <input type="text" name="jpsYear13" style="width:40px;ime-mode:disabled" maxlength="4" value="<?=$jpsPeriod13[0]?>" onkeyPress="InpuOnlyNumber(this);"/>.
                                        <input type="text" name="jpsMonth13" style="width:40px;ime-mode:disabled" maxlength="2" value="<?=$jpsPeriod13[1]?>" onkeyPress="InpuOnlyNumber(this);"/>.
                                        <input type="text" name="jpsDate13" style="width:40px;ime-mode:disabled" maxlength="2" value="<?=$jpsPeriod13[2]?>" onkeyPress="InpuOnlyNumber(this);"/> ~
                                            <input type="text" name="jpeYear13" style="width:40px;ime-mode:disabled" maxlength="4" value="<?=$jpePeriod13[0]?>" onkeyPress="InpuOnlyNumber(this);"/>.
                                        <input type="text" name="jpeMonth13" style="width:40px;ime-mode:disabled" maxlength="2" value="<?=$jpePeriod13[1]?>" onkeyPress="InpuOnlyNumber(this);"/>.
                                        <input type="text" name="jpeDate13" style="width:40px;ime-mode:disabled" maxlength="2" value="<?=$jpePeriod13[2]?>" onkeyPress="InpuOnlyNumber(this);"/>
                                            </td>
                                            <td colspan="2">
                                            <input type="text" name="jobYear13" style="width:40px;ime-mode:disabled" maxlength="2" value="<?=$jobPeriod13[0]?>"/>&nbsp;년&nbsp;&nbsp;
                                        <input type="text" name="jobMonth13" style="width:40px;ime-mode:disabled" maxlength="2" value="<?=$jobPeriod13[1]?>"/>&nbsp;월
                                        </td>
                                        <td colspan="2"><input type="text" name="jobCompany13" value="<?=$row[jobCompany13]?>"/> </td>
                                            <td><input type="text" name="jobDegree13" style="width:100px;" value="<?=$row[jobDegree13]?>"/></td>
                                            </tr>
                                            <tr>
                                            <td colspan="3">
                                            <input type="text" name="jpsYear14" style="width:40px;ime-mode:disabled" maxlength="4" value="<?=$jpsPeriod14[0]?>" onkeyPress="InpuOnlyNumber(this);"/>.
                                        <input type="text" name="jpsMonth14" style="width:40px;ime-mode:disabled" maxlength="2" value="<?=$jpsPeriod14[1]?>" onkeyPress="InpuOnlyNumber(this);"/>.
                                        <input type="text" name="jpsDate14" style="width:40px;ime-mode:disabled" maxlength="2" value="<?=$jpsPeriod14[2]?>" onkeyPress="InpuOnlyNumber(this);"/> ~
                                            <input type="text" name="jpeYear14" style="width:40px;ime-mode:disabled" maxlength="4" value="<?=$jpePeriod14[0]?>" onkeyPress="InpuOnlyNumber(this);"/>.
                                        <input type="text" name="jpeMonth14" style="width:40px;ime-mode:disabled" maxlength="2" value="<?=$jpePeriod14[1]?>" onkeyPress="InpuOnlyNumber(this);"/>.
                                        <input type="text" name="jpeDate14" style="width:40px;ime-mode:disabled" maxlength="2" value="<?=$jpePeriod14[2]?>" onkeyPress="InpuOnlyNumber(this);"/>
                                            </td>
                                            <td colspan="2">
                                            <input type="text" name="jobYear14" style="width:40px;ime-mode:disabled" maxlength="2" value="<?=$jobPeriod14[0]?>"/>&nbsp;년&nbsp;&nbsp;
                                        <input type="text" name="jobMonth14" style="width:40px;ime-mode:disabled" maxlength="2" value="<?=$jobPeriod14[1]?>"/>&nbsp;월
                                        </td>
                                        <td colspan="2"><input type="text" name="jobCompany14" value="<?=$row[jobCompany14]?>"/> </td>
                                            <td><input type="text" name="jobDegree14" style="width:100px;" value="<?=$row[jobDegree14]?>"/></td>
                                            </tr>
                                            <tr>
                                            <td colspan="3">
                                            <input type="text" name="jpsYear15" style="width:40px;ime-mode:disabled" maxlength="4" value="<?=$jpsPeriod15[0]?>" onkeyPress="InpuOnlyNumber(this);"/>.
                                        <input type="text" name="jpsMonth15" style="width:40px;ime-mode:disabled" maxlength="2" value="<?=$jpsPeriod15[1]?>" onkeyPress="InpuOnlyNumber(this);"/>.
                                        <input type="text" name="jpsDate15" style="width:40px;ime-mode:disabled" maxlength="2" value="<?=$jpsPeriod15[2]?>" onkeyPress="InpuOnlyNumber(this);"/> ~
                                            <input type="text" name="jpeYear15" style="width:40px;ime-mode:disabled" maxlength="4" value="<?=$jpePeriod15[0]?>" onkeyPress="InpuOnlyNumber(this);"/>.
                                        <input type="text" name="jpeMonth15" style="width:40px;ime-mode:disabled" maxlength="2" value="<?=$jpePeriod15[1]?>" onkeyPress="InpuOnlyNumber(this);"/>.
                                        <input type="text" name="jpeDate15" style="width:40px;ime-mode:disabled" maxlength="2" value="<?=$jpePeriod15[2]?>" onkeyPress="InpuOnlyNumber(this);"/>
                                            </td>
                                            <td colspan="2">
                                            <input type="text" name="jobYear15" style="width:40px;ime-mode:disabled" maxlength="2" value="<?=$jobPeriod15[0]?>"/>&nbsp;년&nbsp;&nbsp;
                                        <input type="text" name="jobMonth15" style="width:40px;ime-mode:disabled" maxlength="2" value="<?=$jobPeriod15[1]?>"/>&nbsp;월
                                        </td>
                                        <td colspan="2"><input type="text" name="jobCompany15" value="<?=$row[jobCompany15]?>"/> </td>
                                            <td><input type="text" name="jobDegree15" style="width:100px;" value="<?=$row[jobDegree15]?>"/></td>
                                            </tr>

                                            <tr>
                                            <td colspan="8" class="sub_title">5. 기타사항(기타 보충적으로 기술할 사항, 자격증 포상 등)</td>
                                        </tr>
                                        <tr>
                                        <th colspan="3">자격증 또는 포상명</th>
                                        <th colspan="3">취득 및 포상일자</th>
                                        <th colspan="2">시행기관</th>
                                            </tr>
                                            <tr>
                                            <td colspan="3"><input type="text" name="etc1" value="<?=$row[etc1]?>"/></td>
                                            <td colspan="3"><input type="text" name="etc1_date" value="<?=$row[etc1_date]?>"/></td>
                                            <td colspan="2"><input type="text" name="etc1_company" value="<?=$row[etc1_company]?>"/></td>
                                            </tr>
                                            <tr>
                                            <td colspan="3"><input type="text" name="etc2" value="<?=$row[etc2]?>"/></td>
                                            <td colspan="3"><input type="text" name="etc2_date" value="<?=$row[etc2_date]?>"/></td>
                                            <td colspan="2"><input type="text" name="etc2_company" value="<?=$row[etc2_company]?>"/></td>
                                            </tr>
                                            <tr>
                                            <td colspan="3"><input type="text" name="etc3" value="<?=$row[etc3]?>"/></td>
                                            <td colspan="3"><input type="text" name="etc3_date" value="<?=$row[etc3_date]?>"/></td>
                                            <td colspan="2"><input type="text" name="etc3_company" value="<?=$row[etc3_company]?>"/></td>
                                            </tr>
                                            <tr>
                                            <td colspan="3"><input type="text" name="etc4" value="<?=$row[etc4]?>"/></td>
                                            <td colspan="3"><input type="text" name="etc4_date" value="<?=$row[etc4_date]?>"/></td>
                                            <td colspan="2"><input type="text" name="etc4_company" value="<?=$row[etc4_company]?>"/></td>
                                            </tr>
                                            <tr>
                                            <td colspan="3"><input type="text" name="etc5" value="<?=$row[etc5]?>"/></td>
                                            <td colspan="3"><input type="text" name="etc5_date" value="<?=$row[etc5_date]?>"/></td>
                                            <td colspan="2"><input type="text" name="etc5_company" value="<?=$row[etc5_company]?>"/></td>
                                            </tr>
                                            <tr>
                                            <td colspan="3"><input type="text" name="etc6" value="<?=$row[etc6]?>"/></td>
                                            <td colspan="3"><input type="text" name="etc6_date" value="<?=$row[etc6_date]?>"/></td>
                                            <td colspan="2"><input type="text" name="etc6_company" value="<?=$row[etc6_company]?>"/></td>
                                            </tr>
                                            <tr>
                                            <td colspan="3"><input type="text" name="etc7" value="<?=$row[etc7]?>"/></td>
                                            <td colspan="3"><input type="text" name="etc7_date" value="<?=$row[etc7_date]?>"/></td>
                                            <td colspan="2"><input type="text" name="etc7_company" value="<?=$row[etc7_company]?>"/></td>
                                            </tr>
                                            <tr>
                                            <td colspan="3"><input type="text" name="etc8" value="<?=$row[etc8]?>"/></td>
                                            <td colspan="3"><input type="text" name="etc8_date" value="<?=$row[etc8_date]?>"/></td>
                                            <td colspan="2"><input type="text" name="etc8_company" value="<?=$row[etc8_company]?>"/></td>
                                            </tr>
                                            <!-- 2017-01-05 추가 ( 입력란 추가 ) -->
                                            <tr>
                                            <td colspan="3"><input type="text" name="etc9" value="<?=$row[etc9]?>"/></td>
                                            <td colspan="3"><input type="text" name="etc9_date" value="<?=$row[etc9_date]?>"/></td>
                                            <td colspan="2"><input type="text" name="etc9_company" value="<?=$row[etc9_company]?>"/></td>
                                            </tr>
                                            <tr>
                                            <td colspan="3"><input type="text" name="etc10" value="<?=$row[etc10]?>"/></td>
                                            <td colspan="3"><input type="text" name="etc10_date" value="<?=$row[etc10_date]?>"/></td>
                                            <td colspan="2"><input type="text" name="etc10_company" value="<?=$row[etc10_company]?>"/></td>
                                            </tr>
                                            <tr>
                                            <td colspan="3"><input type="text" name="etc11" value="<?=$row[etc11]?>"/></td>
                                            <td colspan="3"><input type="text" name="etc11_date" value="<?=$row[etc11_date]?>"/></td>
                                            <td colspan="2"><input type="text" name="etc11_company" value="<?=$row[etc11_company]?>"/></td>
                                            </tr>
                                            <tr>
                                            <td colspan="3"><input type="text" name="etc12" value="<?=$row[etc12]?>"/></td>
                                            <td colspan="3"><input type="text" name="etc12_date" value="<?=$row[etc12_date]?>"/></td>
                                            <td colspan="2"><input type="text" name="etc12_company" value="<?=$row[etc12_company]?>"/></td>
                                            </tr>
                                            <tr>
                                            <td colspan="3"><input type="text" name="etc13" value="<?=$row[etc13]?>"/></td>
                                            <td colspan="3"><input type="text" name="etc13_date" value="<?=$row[etc13_date]?>"/></td>
                                            <td colspan="2"><input type="text" name="etc13_company" value="<?=$row[etc13_company]?>"/></td>
                                            </tr>
                                            <tr>
                                            <td colspan="3"><input type="text" name="etc14" value="<?=$row[etc14]?>"/></td>
                                            <td colspan="3"><input type="text" name="etc14_date" value="<?=$row[etc14_date]?>"/></td>
                                            <td colspan="2"><input type="text" name="etc14_company" value="<?=$row[etc14_company]?>"/></td>
                                            </tr>
                                            <tr>
                                            <td colspan="3"><input type="text" name="etc15" value="<?=$row[etc15]?>"/></td>
                                            <td colspan="3"><input type="text" name="etc15_date" value="<?=$row[etc15_date]?>"/></td>
                                            <td colspan="2"><input type="text" name="etc15_company" value="<?=$row[etc15_company]?>"/></td>
                                            </tr>
                                            </table>
                                            <table class="table_box_recruit" style="margin:10px 0px;">
                                            <colgroup>
                                            <col width="150px">
                                            <col width="200px">
                                            <col width="350px">
                                            <col width="100px">
                                            <col width="100px">
                                            <col width="100px">
                                            </colgroup>
                                            <tr>
                                            <td colspan="6" class="sub_title"><span style="color:red;font-size:150%">*</span>&nbsp;자기소개서<div style="float:right;color:red">특수문자(당구장표시, 가운데점 등)은 사용할 수 없습니다.</div></td>
                                        </tr>
                                        <tr>
                                        <td colspan="6"><textarea name="profile" style="width:98%; height:300px;"><?=$date[profile]?></textarea></td>
                                        </tr>

                                    </table>
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
                                    <input type="hidden" name="pass" value="<?=$password?>" />
                                </form>
                            </div>
                        </div>
                    </div>
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