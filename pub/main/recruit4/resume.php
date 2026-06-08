<?
// 개별 페이지 실행 방지. 해당 문자열은 inc.constant.php에 정의된다.
define("__AF__", TRUE);
// adframe 템플릿 페이지 설정.
include($_SERVER["DOCUMENT_ROOT"] . "/adframe/af_common.php");

if( trim($j) == "" && $agree == "2" ) echo "<script> alert('올바르지 못한 접근입니다.'); history.back(); </script>";
//########################################################################################

?>
<!doctype html>
<html lang="ko">

<head>
	<title>
        채용지원서 &lt; 춘해보건대학교
    </title>
    <? include_once( $_SERVER["DOCUMENT_ROOT"] . "/include/meta.php" ); ?>
    
    <link rel="stylesheet" type="text/css" href="./css/notokr.css" media="all"/>
	<!--
    <link rel="stylesheet" type="text/css" href="./css/default.css" media="all"/>
	-->
    <link rel="stylesheet" type="text/css" href="./css/layout_20180724.css" media="all"/>
    <link rel="stylesheet" type="text/css" href="./css/style.css" media="all"/>
	<script>
		$(function(){
			$(".dateTime").datepicker({
				dateFormat: 'yy-mm-dd'
			});
		});

		function check_form(f){
			if(f.department.value==""){alert("지원부서를 입력해주세요.");f.department.focus(); return false;}
			if($("input:radio[name='careerYN']:checked").length==0){
				alert("입사구분을 선택하세요."); $("#career_n").focus(); return false;
			}
			
			if(f.kor_name.value==""){alert("국문 성명을 입력하세요.");}
			if(f.addr1.value==""){alert("주소를 입력하세요.");f.addr1.focus(); return false;}
			if(f.hTel1.value==""){alert("전화번호를 입력하세요.");f.hTel1.focus(); return false;}
			if(f.hTel2.value==""){alert("전화번호를 입력하세요.");f.hTel2.focus(); return false;}
			if(f.hTel3.value==""){alert("전화번호를 입력하세요.");f.hTel3.focus(); return false;}
			if(f.phone1.value==""){alert("휴대폰을 입력하세요.");f.phone1.focus(); return false;}
			if(f.phone2.value==""){alert("휴대폰을 입력하세요.");f.phone2.focus(); return false;}
			if(f.phone3.value==""){alert("휴대폰을 입력하세요.");f.phone3.focus(); return false;}
			if(f.bYear.value==""){alert("생년월일을 입력하세요.");f.bYear.focus();return false;}
			if(f.bMonth.value==""){alert("생년월일을 입력하세요.");f.bMonth.focus();return false;}
			if(f.bDay.value==""){alert("생년월일을 입력하세요.");f.bDay.focus();return false;}
			if(f.email.value==""){alert("이메일을 입력하세요.");f.email.focus(); return false;}

			var sex = document.getElementsByName("sex");
			var sex_num = sex.length;
			chk1 = 0;
			for(i=0;i<sex_num; i++){
				if(sex[i].checked==true){chk1++;break;}
			}
			if(chk1==0){alert("성별을 선택하세요");return false;}
			
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

		function InpuOnlyNumber(obj) {
			if (event.keyCode >= 48 && event.keyCode <= 57) { // 숫자키만 입력
				return true;
			} else {
				event.returnValue = false;
			}
		}
		function GPEN_PRINT(wr_id){
			//alert("팝업이 뜨면 인쇄를 한번더 클릭해주세요.\n 인터넷 익스플로러에서만 인쇄가 가능합니다.");
			var p = window.open("/adframe/mng/recruit/print.php?wr_id="+wr_id,"PrintWin","width=800, height=700, scrollbars=yes");
			p.focus();
		}
		function GPEN2_PRINT(wr_id){
			//alert("팝업이 뜨면 인쇄를 한번더 클릭해주세요.\n 인터넷 익스플로러에서만 인쇄가 가능합니다.");
			var p = window.open("/adframe/mng/recruit/print2.php?wr_id="+wr_id,"PrintWin","width=800, height=700, scrollbars=yes");
			p.focus();
		}
		function GPEN3_PRINT(wr_id){
			//alert("팝업이 뜨면 인쇄를 한번더 클릭해주세요.\n 인터넷 익스플로러에서만 인쇄가 가능합니다.");
			var p = window.open("/adframe/mng/recruit/print3.php?wr_id="+wr_id,"PrintWin","width=800, height=700, scrollbars=yes");
			p.focus();
		}
	</script>
	<script src="//t1.kakaocdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
	<script style="text/javascript">
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
                채용지원
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
						// 수정인 경우
						if ( $j == "u" ) {							
							$sql = " select * from employment where wr_id = '".$wr_id."' ";
							$rs = mysql_query($sql);
							if ( mysql_num_rows($rs) == 0 ) {
								echo "<script> alert('회원정보가 올바르지 못합니다.'); history.back(); </script>";
							} else {
								$row = mysql_fetch_assoc($rs);
								// 변수 설정
								$kor_name = $row[kor_name];
								$phone = $row[phone];
								$resume_num = $row[resume_num];
								
								if ( $row['password'] != $pass ) {

									echo "<script> alert('비밀번호가 다릅니다.'); history.back(); </script>";
								}
							}
						}
						?>

                        <h3 class="contents-title">
                            채용지원서
                            <span class="arrow"></span>
                        </h3>

                        <div id="contents_recruit">
                            <div class="cont">
                                <h5 class="title-type02">춘해보건대학교 채용지원서</h5>
                                <form name="frm" method="POST" action="proc.php" onsubmit="return check_form(this)" enctype="multipart/form-data"  >
                                    <input type="hidden" name="j" value="<?=$j?>" />
                                    <input type="hidden" name="wr_id" value="<?=$row['wr_id']?>" />
                                    <input type="hidden" name="pass_check" value="<?=$pass?>" />
                                    <input type="hidden" name="resume_num" value="<?=$resume_num?>" />
                                    <table class="table_box_recruit">
                                        <colgroup>
                                            <col width="10%">
                                            <col width="12.5%">
                                            <col width="10%">
                                            <col width="12.5%">
                                            <col width="12.5%">
                                            <col width="12.5%">
                                            <col width="12.5%">
                                            <col width="17.5%">
                                        </colgroup>
                                        <tr>											
                                            <th><span style="color:red;font-size:150%">*</span>&nbsp;지원부서</th>
                                            <td colspan="3" class="left">
                                               <input type="text" id="department" name="department" value="<?php echo $row['department']?>" />
                                            </td>

                                            <th><span style="color:red;font-size:150%">*</span>&nbsp;입사구분</th>
                                            <td colspan="3" id="td_type_gubun">
                                                <input type="radio" id="career_n" name="careerYN" value="N" <?php if($row['careerYN']=="N"){echo "checked";}?> />&nbsp;<label for="career_n">신입</label>
												&nbsp;&nbsp;&nbsp&nbsp;
												<input type="radio" id="career_y" name="careerYN" value="Y" <?php if($row['careerYN']=="Y"){echo "checked";}?> />&nbsp;<label for="career_y">경력</label>
                                            </td>

                                        </tr>
                                        <tr>
											<td colspan="2" rowspan="4"><?if($row[file_name]){?><img id="img_preview" src="<?=$row[file_name]?>" width="150px"/><?}else{?>사진<br />(3cm X 4cm)<br />아래의 찾아보기로 사진을 추가하세요.<img id="img_preview" style="display:none;" width="150px"/><?}?></td>
                                            <th>성명</th>
                                            <td class="left" colspan="2">
                                                <span style="color:red;font-size:150%">*</span>&nbsp;[국문]<br />
                                                <input type="text" name="kor_name" value="<?=$row['kor_name']?$row['kor_name']:$_POST['kor_name'];?>" />
                                            </td>
                                            <td class="left" colspan="2">
                                                [영문]<br />
                                                <input type="text" name="eng_name" value="<?=$row['eng_name']?>" />
                                            </td>
                                            <td class="left">
                                                [한문]<br />
                                                <input type="text" name="chi_name" style="max-width:100%;" value="<?=$row['chi_name']?>" />
                                            </td>
                                        </tr>
										<tr>
                                            <th><span style="color:red;font-size:150%">*</span>&nbsp;주소</th>
                                            <td colspan="5" class="left">
                                                <div >
                                                    (우편번호 :
                                                    
                                                        <input type="text" name="zonecode" id="zonecode" maxlength="5" style="width: 80px; text-align: center" readonly value="<?=$row[zonecode]?>">
                                                        <input type="hidden" name="zip1" id="zip1" maxlength="3" style="width:40px;text-align:center" readonly value="<?=$zip[0]?>"/> -
                                                        <input type="hidden" name="zip2" id="zip2" maxlength="3" style="width:40px;text-align:center;" readonly value="<?=$zip[1]?>"/>
                                                    )
                                                    &nbsp;&nbsp;<input type="button" value="우편번호검색" class="btn" onclick="openDaumPostcode()"/></div>
                                                <div style="padding-top:5px;"><input type="text" name="addr1" id="addr1" style="max-width:100% !important" readonly value="<?=$row[addr1]?>"/></div>
                                                <div style="padding-top:5px;"><input type="text" name="addr2" id="addr2" style="max-width:100% !important" value="<?=$row[addr2]?>"/></div>
                                            </td>
                                        </tr>
										<?
                                        $hTel = explode("-",$row[hTel]);
                                        $jTel = explode("-",$row[jTel]);
                                        $phone = explode("-",$phone);
                                        $zip = explode("-",$row[zip]);
                                        ?>
										<tr>
											<th><span style="color:red;font-size:150%">*</span>&nbsp;전화번호</th>
                                            <td colspan="2"><input type="text" name="hTel1" style="width:40px;ime-mode:disabled" maxlength="4" value="<?=$hTel[0]?>"/> - <input type="text" name="hTel2" style="width:40px;ime-mode:disabled" maxlength="4"  value="<?=$hTel[1]?>"/> - <input type="text" name="hTel3" style="width:40px;ime-mode:disabled" maxlength="4"  value="<?=$hTel[2]?>"/></td>
                                            <th><span style="color:red;font-size:150%">*</span>&nbsp;휴대폰</th>
                                            <td colspan="3"><input type="text" name="phone1" style="width:40px;ime-mode:disabled" maxlength="4"  value="<?=$phone[0]?>"/> - <input type="text" name="phone2" style="width:40px;ime-mode:disabled" maxlength="4" value="<?=$phone[1]?>"/> - <input type="text" name="phone3" style="width:40px;ime-mode:disabled" maxlength="4" value="<?=$phone[2]?>"/></td>
										</tr>
										<tr>
                                            <th><span style="color:red;font-size:150%">*</span>&nbsp;생년월일</th>
                                            <td colspan="2">
												<input type="text" name="birth"  value="<?=$row['birth']?>" style="width:80px;text-indent:0px !important;text-align:center !important;" />&nbsp;&nbsp;
												(만<input type="text" name="age" style="width:40px;ime-mode:disabled" maxlength="2" value="<?=$row[age]?>"/>세)
											</td>
                                            <th ><span style="color:red;font-size:150%">*</span>&nbsp;이메일</th>
                                            <td colspan="3">                                                
                                                <input type="text" name="email" style="max-width:100%" value="<?=$row[email]?>"/>
                                            </td>
                                        </tr>
                                        <tr>
											<td colspan="2"><span style="color:red;font-size:150%">*</span>&nbsp;<input type="file" name="file1" id="input_file" style="width:70%;"/></td>
                                            <th><span style="color:red;font-size:150%">*</span>&nbsp;성별</th>
                                            <td colspan="2"><input type="radio" name="sex" value="남" <?if($row[sex]=="남"){echo "checked";}?>/>&nbsp;남&nbsp;&nbsp;<input type="radio" name="sex" value="여" <?if($row[sex]=="여"){echo "checked";}?>/>&nbsp;여</td>
                                            <th>비상연락처</th>
                                            <td colspan="2"><input type="text" name="jTel1" style="width:40px;ime-mode:disabled" maxlength="4" value="<?=$jTel[0]?>"/> - <input type="text" name="jTel2" style="width:40px;ime-mode:disabled" maxlength="4"  value="<?=$jTel[1]?>"/> - <input type="text" name="jTel3" style="width:40px;ime-mode:disabled" maxlength="4"  value="<?=$jTel[2]?>"/></td>
                                        </tr>
									</table>
                                        
									<table class="table_box_recruit" style="margin-top:10px;">
                                        <colgroup>
                                            <col width="80px">
                                            <col width="200px">
                                            <col width="*">
                                            <col width="125px">
                                            <col width="125px">
                                            <col width="125px">
                                        </colgroup>
										<tr>
											<th rowspan="5">학력</th>
											<th>기간</th>
                                            <th>학교명</th>
                                            <th>전공분야</th>
                                            <th>성적</th>
                                            <th>평균평점</th>
                                         </tr>
                                            <tr>
												<td><input type="text" name="hPeriod1" style="width:80px;" value="<?=$row['hPeriod1']?>"/> ~ <input type="text" name="hPeriod2" style="width:80px;" value="<?=$row['hPeriod2']?>"/> </td>
												<td style="text-align:left"><input type="text" name="hSchool" value="<?=$row[hSchool]?>" style="width:120px;"/> &nbsp;고등학교(졸업)</td>
												<td>-</td>
												<td>-</td>
												<td>-</td>
                                            </tr>
                                            <tr>
												<td>
													<input type="text" name="cPeriod1" style="width:80px;" value="<?=$row['cPeriod1']?>"/> ~ <input type="text" name="cPeriod2" style="width:80px;" value="<?=$row['cPeriod2']?>"/> 
												</td>
												<td style="text-align:left">
													<input type="text" name="colleage" value="<?=$row['colleage']?>" style="width:120px;"/> &nbsp;대학(
													<input type="radio" name="cEndYN" id="cEndN" value="N" <?php if($row['cEndYN']=="N"){echo "checked";}?>/><label for="cEndC">중퇴</label>&nbsp;&nbsp;
													<input type="radio" name="cEndYN" id="cEndF" value="F" <?php if($row['cEndYN']=="F"){echo "checked";}?> /><label for="cEndF">졸업예정</label>&nbsp;&nbsp;
													<input type="radio" name="cEndYN" id="cEndY" value="Y" <?php if($row['cEndYN']=="Y"){echo "checked";}?> /><label for="cEndY">졸업</label>)
												</td>
												<td>
													<input type="text" name="cMajor" style="width:100px;" value="<?=$row[cMajor]?>"/>
												</td>
												<td>
													<input type="text" name="cScore" style="width:30px;" value="<?=$row[cScore]?>"/> / <input type="text" name="cTotal" style="width:30px;" value="<?=$row[cTotal]?>"/>
												</td>
												<td>
													<input type="text" name="cDegree" style="width:60px" value="<?=$row[cDegree]?>"/>
												</td>
												
                                            </tr>
                                            <tr>
												<td >
													<input type="text" name="uPeriod1" style="width:80px;" value="<?=$row['uPeriod1']?>"/> ~ <input type="text" name="uPeriod2" style="width:80px;" value="<?=$row['uPeriod2']?>"/> 
												</td>
												<td style="text-align:left">
													<input type="text" name="univ" value="<?=$row[univ]?>" style="width:120px"/> &nbsp;
													대학교(
													<input type="radio" name="uEndYN" id="uEndN" value="N" <?php if($row['uEndYN']=="N"){echo "checked";}?>/><label for="uEndC">중퇴</label>&nbsp;&nbsp;
													<input type="radio" name="uEndYN" id="uEndF" value="F" <?php if($row['uEndYN']=="F"){echo "checked";}?> /><label for="uEndF">졸업예정</label>&nbsp;&nbsp;
													<input type="radio" name="uEndYN" id="uEndY" value="Y" <?php if($row['uEndYN']=="Y"){echo "checked";}?> /><label for="uEndY">졸업</label>)
												</td>
												<td>
													<input type="text" name="uMajor" style="width:100px;" value="<?=$row[uMajor]?>" />
												</td>
												<td>
													<input type="text" name="uScore" style="width:30px;" value="<?=$row[uScore]?>" /> / <input type="text" name="uTotal" style="width:30px;" value="<?=$row[uTotal]?>" />
												</td>
												<td>
													<input type="text" name="uDegree" style="width:60px" value="<?=$row[uDegree]?>" />
												</td>
												
                                            </tr>
                                            <tr>
												<td>
													<input type="text" name="mPeriod1" style="width:80px;" value="<?=$row['mPeriod1']?>" /> ~ <input type="text" name="mPeriod2" style="width:80px;" value="<?=$row['mPeriod2']?>" /> 
												</td>
												<td style="text-align:left">
													<input type="text" name="master" value="<?=$row[master]?>"/>
												</td>
												<td>
													<input type="text" name="mMajor" style="width:100px;" value="<?=$row[mMajor]?>" />
												</td>
												<td>
													<input type="text" name="mScore" style="width:30px;" value="<?=$row[mScore]?>" /> / <input type="text" name="mTotal" style="width:30px;" value="<?=$row[mTotal]?>" />
												</td>
												<td>
													<input type="text" name="mDegree" style="width:60px" value="<?=$row[mDegree]?>" />
												</td>												
											</tr>
										</table>
										<table class="table_box_recruit" style="margin-top:10px;">
											<colgroup>
												<col width="80px" />
												<col width="*" />
												<col width="150px" />
												<col width="250px" />
											</colgroup>
											<tr>
												<th rowspan="7">자격 및 면허</th>
												<th>자격&middot;면허명</th>
												<th>취득년월일</th>
												<th>발행기관</th>
                                            </tr>
                                            <tr>
												<td><input type="text" name="etc1" value="<?=$row[etc1]?>" style="width:100%; max-width:100%;"/></td>
												<td><input type="text" name="etc1_date" style="width:80px;text-indent:0px !important;text-align:center !important;" value="<?=$row[etc1_date]?>" /></td>
												<td><input type="text" name="etc1_company" value="<?=$row[etc1_company]?>"/></td>
                                            </tr>
                                            <tr>
												<td><input type="text" name="etc2" value="<?=$row[etc2]?>" style="width:100%; max-width:100%;"/></td>
												<td><input type="text" name="etc2_date" style="width:80px;text-indent:0px !important;text-align:center !important;" value="<?=$row[etc2_date]?>" /></td>
												<td><input type="text" name="etc2_company" value="<?=$row[etc2_company]?>"/></td>
                                            </tr>
                                            <tr>
												<td><input type="text" name="etc3" value="<?=$row[etc3]?>" style="width:100%; max-width:100%;"/></td>
												<td><input type="text" name="etc3_date" style="width:80px;text-indent:0px !important;text-align:center !important;" value="<?=$row[etc3_date]?>" /></td>
												<td><input type="text" name="etc3_company" value="<?=$row[etc3_company]?>"/></td>
                                            </tr>
                                            <tr>
												<td><input type="text" name="etc4" value="<?=$row[etc4]?>" style="width:100%; max-width:100%;"/></td>
												<td><input type="text" name="etc4_date" style="width:80px;text-indent:0px !important;text-align:center !important;" value="<?=$row[etc4_date]?>"/></td>
												<td><input type="text" name="etc4_company" value="<?=$row[etc4_company]?>"/></td>
                                            </tr>
                                            <tr>
												<td><input type="text" name="etc5" value="<?=$row[etc5]?>" style="width:100%; max-width:100%;"/></td>
												<td><input type="text" name="etc5_date" style="width:80px;text-indent:0px !important;text-align:center !important;" value="<?=$row[etc5_date]?>"/></td>
												<td><input type="text" name="etc5_company" value="<?=$row[etc5_company]?>"/></td>
                                            </tr>
                                            <tr>
												<td><input type="text" name="etc6" value="<?=$row[etc6]?>" style="width:100%; max-width:100%;"/></td>
												<td><input type="text" name="etc6_date" style="width:80px;text-indent:0px !important;text-align:center !important;" value="<?=$row[etc6_date]?>"/></td>
												<td><input type="text" name="etc6_company" value="<?=$row[etc6_company]?>"/></td>
                                            </tr>
                                        </table>
										<table class="table_box_recruit" style="margin-top:10px;">
											<colgroup>
												<col width="80px" />
												<col width="*" />
												<col width="120px" />
												<col width="120px" />
												<col width="120px" />
												<col width="200px" />
											</colgroup>
											<tr>
												<th rowspan="3">외국어 및 특기사항</th>
												<th>종류</th>
												<th>등급</th>
												<th>점수</th>
												<th>취득일</th>
												<th>발급기관</th>
											</tr>
											<tr>
												<td><input type="text" name="specialty1" value="<?=$row['specialty1']?>" style="width:100%; max-width:100%;"/></td>
												<td><input type="text" name="specialty1_degree" value="<?=$row['specialty1_degree']?>" style="width:80px; text-indext:0px !important"/></td>
												<td><input type="text" name="specialty1_score" value="<?=$row['specialty1_score']?>" style="width:80px; text-indext:0px !important"/></td>
												<td><input type="text" name="specialty1_date" style="width:80px;text-indent:0px !important;text-align:center !important;" value="<?=$row['specialty1_date']?>" /></td>
												<td><input type="text" name="specialty1_nm" value="<?=$row['specialty1_nm']?>"/></td>
											</tr>
											<tr>
												<td><input type="text" name="specialty2" value="<?=$row['specialty2']?>" style="width:100%; max-width:100%;"/></td>
												<td><input type="text" name="specialty2_degree" value="<?=$row['specialty2_degree']?>" style="width:80px; text-indext:0px !important"/></td>
												<td><input type="text" name="specialty2_score" value="<?=$row['specialty2_score']?>" style="width:80px; text-indext:0px !important"/></td>
												<td><input type="text" name="specialty2_date" style="width:80px;text-indent:0px !important;text-align:center !important;" value="<?=$row['specialty2_date']?>" /></td>
												<td><input type="text" name="specialty2_nm" value="<?=$row['specialty2_nm']?>"/></td>
											</tr>
										</table>
                                        <table class="table_box_recruit" style="margin-top:10px;">
											<colgroup>
												<col width="80px" />
												<col width="100px" />
												<col width="100px" />
												<col width="100px" />
												<col width="100px" />
												<col width="*" />
												<col width="100px" />
												<col width="*" />
												<col width="*" />
											</colgroup>
											<tr>
												<th rowspan="5">병역<br />&middot;<br />장애<br />&middot;<br />보훈</th>
												<th rowspan="2">취업지원<br />대상자여부</th>
												<td rowspan="2" colspan="2">
													<input type="radio" id="veteransY" name="veteransYN" value="Y" <?php if($row['veteransYN']=="Y"){echo "checked";}?>/>&nbsp;&nbsp;<label for="veteransY">보훈</label>&nbsp;&nbsp;&nbsp;&nbsp;
													<input type="radio" id="veteransN" name="veteransYN" value="N" <?php if($row['veteransYN']=="N"){echo "checked";}?>/>&nbsp;&nbsp;<label for="veteransN">비보훈</label>
												</td>
												<th rowspan="2">보훈번호</th>
												<td rowspan="2">
													<input type="text" name="veterans_no" value="<?php echo $row['verterans_no']?>">
												</td>
												<th>
													병역(군별)
												</th>
												<td colspan="2">
													<select name="army_type">
														<option value="육군" <?php if($row['army_type']=="육군"){echo "selected";}?>>육군</option>
														<option value="해군" <?php if($row['army_type']=="해군"){echo "selected";}?>>해군</option>
														<option value="공군" <?php if($row['army_type']=="공군"){echo "selected";}?>>공군</option>
														<option value="기타" <?php if($row['army_type']=="기타"){echo "selected";}?>>기타</option>
													</select>
												</td>
											</tr>
											<tr>
												<th>계급 및 병과</th>
												<td colspan="2"><input type="text" name="army_rank" /></td>
											</tr>
											<tr>
												<th rowspan="2">장애여부</th>
												<th>장애종별</th>
												<th>장애정도</th>
												<th rowspan="2">장애인등록번호</th>
												<td rowspan="2">
													<input type="text" name="disabled_no" value="<?php echo $row['disabled_no']?>">
												</td>
												<th rowspan="2">복무기간</th>
												<td rowspan="2" colspan="2">
													<input type="text" name="army_start" value="<?php echo $row['army_start']?>" style="width:60px;text-indent:0px !important;text-align:center !important;"/>
													~ 
													<input type="text" name="army_end" value="<?php echo $row['army_end']?>" style="width:60px;text-indent:0px !important;text-align:center !important;"/>&nbsp;&nbsp;&nbsp;&nbsp;
													(<input type="text" name="army_service_month" value="<?php echo $row['army_service_month']?>" style="width:40px;text-indent:0px !important"/>&nbsp;개월)
												</td>
											</tr>
											<tr>
												<td><input type="text" name="disabled_type" value="<?php echo $row['disabled_type']?>" /></td>
												<td><input type="text" name="disabled_degree" value="<?php echo $row['disabled_degree']?>" /></td>
											</tr>
											<tr>
												<th>저소득층<br />여부</th>
												<td colspan="2">
													<input type="radio" id="low_incomeY" name="low_incomeYN" value="Y" <?php if($row['low_incomeYN']=="Y"){echo "checked";}?>/>&nbsp;&nbsp;<label for="low_incomeY">대상</label>&nbsp;&nbsp;&nbsp;&nbsp;
													<input type="radio" id="low_incomeN" name="low_incomeYN" value="N" <?php if($row['low_incomeYN']=="N"){echo "checked";}?>/>&nbsp;&nbsp;<label for="low_incomeN">비대상</label>
												</td>
												<th colspan="2">국민기초생활보장법 수급자 </th>
												<td><input type="checkbox" name="basic_living" value="Y" <?php if($row['basic_living']=="Y"){echo "checked";}?> /></td>
												<th >한부모가족지원법<br />보호대상자</th>
												<td><input type="checkbox" name="one_parent" value="Y" <?php if($row['one_parent']=="Y"){echo "checked";}?> /></td>
											</tr>
										</table>
										<table class="table_box_recruit" style="margin-top:10px;">
											<colgroup>
												<col width="80px" />
												<col width="*" />
												<col width="120px" />
												<col width="100px" />
												<col width="100px" />
												<col width="150px" />
												<col width="150px" />
											</colgroup>
											<tr>
												<th rowspan="4">주요<br />경력<br/>사항</th>
												<th>근무기간</th>
												<th>회사명</th>
												<th>부서</th>
												<th>직위/직급</th>
												<th>담당업무<br />(구체적으로기술)</th>
												<th>퇴직사유</th>
                                            </tr>
                                            <tr>
												<td>
													<input type="text" name="jobStart1" value="<?=$row['jobStart1']?>" style="width:60px;text-indent:0px !important;text-align:center !important;"/> 
													~ 
													<input type="text" name="jobEnd1" value="<?=$row['jobEnd1']?>" style="width:60px;text-indent:0px !important;text-align:center !important;" />
													(<input type="text" name="jobYear1" style="width:40px;ime-mode:disabled" maxlength="2" value="<?=$row['jobYear1']?>"/>&nbsp;년&nbsp;&nbsp;<input type="text" name="jobMonth1" style="width:40px;ime-mode:disabled" maxlength="2" value="<?=$row['jobMonth1']?>"/>&nbsp;월)
												</td>
												<td><input type="text" name="jobCompany1" value="<?=$row['jobCompany1']?>"/> </td>
												<td><input type="text" name="jobDepartment1" value="<?=$row['jobDepartment1']?>"/></td>
												<td><input type="text" name="jobDegree1" value="<?=$row['jobDegree1']?>"/></td>
												<td><input type="text" name="jobWork1" value="<?=$row['jobWork1']?>"/></td>
												<td><input type="text" name="retirement1" value="<?=$row['retirement1']?>"/></td>
                                            </tr>
											<tr>
												<td>
													<input type="text" name="jobStart2" value="<?=$row['jobStart2']?>" style="width:60px;text-indent:0px !important;text-align:center !important;"/> 
													~ 
													<input type="text" name="jobEnd2" value="<?=$row['jobEnd2']?>" style="width:60px;text-indent:0px !important;text-align:center !important;" />
													(<input type="text" name="jobYear2" style="width:40px;ime-mode:disabled" maxlength="2" value="<?=$row['jobYear2']?>"/>&nbsp;년&nbsp;&nbsp;<input type="text" name="jobMonth2" style="width:40px;ime-mode:disabled" maxlength="2" value="<?=$row['jobMonth2']?>"/>&nbsp;월)
												</td>
												<td><input type="text" name="jobCompany2" value="<?=$row['jobCompany2']?>"/> </td>
												<td><input type="text" name="jobDepartment2" value="<?=$row['jobDepartment2']?>"/></td>
												<td><input type="text" name="jobDegree2" value="<?=$row['jobDegree2']?>"/></td>
												<td><input type="text" name="jobWork2" value="<?=$row['jobWork2']?>"/></td>
												<td><input type="text" name="retirement2" value="<?=$row['retirement2']?>"/></td>
                                            </tr>
											<tr>
												<td>
													<input type="text" name="jobStart3" value="<?=$row['jobStart3']?>" style="width:60px;text-indent:0px !important;text-align:center !important;" /> 
													~ 
													<input type="text" name="jobEnd3" value="<?=$row['jobEnd3']?>" style="width:60px;text-indent:0px !important;text-align:center !important;" />
													(<input type="text" name="jobYear3" style="width:40px;ime-mode:disabled" maxlength="2" value="<?=$row['jobYear3']?>"/>&nbsp;년&nbsp;&nbsp;<input type="text" name="jobMonth3" style="width:40px;ime-mode:disabled" maxlength="2" value="<?=$row['jobMonth3']?>"/>&nbsp;월)
												</td>
												<td><input type="text" name="jobCompany3" value="<?=$row['jobCompany3']?>"/> </td>
												<td><input type="text" name="jobDepartment3" value="<?=$row['jobDepartment3']?>"/></td>
												<td><input type="text" name="jobDegree3" value="<?=$row['jobDegree3']?>"/></td>
												<td><input type="text" name="jobWork3" value="<?=$row['jobWork3']?>"/></td>
												<td><input type="text" name="retirement3" value="<?=$row['retirement3']?>"/></td>
                                            </tr>
										</table>
										
                                        <table class="table_box_recruit" style="margin-top:10px;">
											<tr>
												<th>자기소개서</th>
											</tr>
											<tr>
												<td><textarea name="memo1" style="width:98%; height:300px;text-align:left"><?=$row['memo1']?></textarea></td>
											</tr>
											<tr>
												<th>자신의 생활신념, 좌우명 및 성격의 장&middot;단점</th>
											</tr>
											<tr>
												<td><textarea name="memo2" style="width:98%; height:300px;"><?=$row['memo2']?></textarea></td>
											</tr>
											<tr>
												<th>자신이 생각하고 있는 대인관계</th>
											</tr>
											<tr>
												<td><textarea name="memo3" style="width:98%; height:300px;"><?=$row['memo3']?></textarea></td>
											</tr>
											<tr>
												<th>입사지원동기와 입사 후 포부</th>
											</tr>
											<tr>
												<td><textarea name="memo4" style="width:98%; height:300px;"><?=$row['memo4']?></textarea></td>
											</tr>
											<tr>
												<th>입사 후 희망업무와 그 선택 이유</th>
											</tr>
											<tr>
												<td><textarea name="memo5" style="width:98%; height:300px;"><?=$row['memo5']?></textarea></td>
											</tr>
											<tr>
												<th>지원부서(업무) 수행을 위한 숙련도 및 수행능력 등</th>
											</tr>
											<tr>
												<td><textarea name="memo6" style="width:98%; height:300px;"><?=$row['memo6']?></textarea></td>
											</tr>
											<tr>
												<th>기타 자기 자신을 구체적으로 소개할 수 있는 내용을 자유롭게 기술</th>
											</tr>
											<tr>
												<td><textarea name="memo7" style="width:98%; height:300px;"><?=$row['memo7']?></textarea></td>
											</tr>
										</table>

										<table class="table_box_recruit" style="margin-top:10px;">
											<tr>
												<th>파일 첨부</th>
											</tr>
											<tr>
												<td style="text-align:left">
												<input type="file" name="file2" /><?php if($row['s_file_name2']){echo $row['s_file_name2'];}?><br />
												<p style="margin-top:10px;">** 첨부하실 파일을 압축하여 첨부바라며, 압축시 전화번호 끝 네자리로 암호화 바랍니다.</p>
												</td>
											</tr>
										</table>

										<div class="btns-area">
											<button type="submit" class="btns-color01 btn-m02">
												확인
											</button>
											<button type="button" class="btns-color02 btn-m02" onclick="history.back();">
												취소
											</button>
										</div>
                                        <input type="hidden" name="pass" value="<?=$pass?>" />
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
