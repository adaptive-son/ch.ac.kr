<?php
	// 개별 페이지 실행 방지. 해당 문자열은 inc.constant.php에 정의된다.
	define("__AF__", TRUE);
	// adframe 템플릿 페이지 설정.
	include($_SERVER["DOCUMENT_ROOT"] . "/adframe/af_common.php");

	function Error( $msg ) {
		echo "<script> alert('".$msg."'); history.back(); </script>";
		exit;
	}

	$j = $_POST["j"];

	$id = date("Ymd");

	$reg_date = time();

	if($HTTP_POST_FILES[file1]) {
		$file1 = $HTTP_POST_FILES[file1][tmp_name];
		$file1_name = $HTTP_POST_FILES[file1][name];
		$file1_size = $HTTP_POST_FILES[file1][size];
		$file1_type = $HTTP_POST_FILES[file1][type];
	}

	if($file1_size>0&&$file1) {

		if(!is_uploaded_file($file1)) Error("정상적인 방법으로 업로드 해주세요");
		$file1_size=filesize($file1);

		// 업로드 금지
		if($file1_size>0) {
			$s_file_name1 = $file1_name;
			$temp1=explode(".",$file1_name);
			$temp1_name = $reg_date.'.'.$temp1[1];

			$file1 = eregi_replace("\\\\","\\",$file1);
			$s_file_name1 = str_replace(" ","_",$s_file_name1);
			$s_file_name1 = str_replace("-","_",$s_file_name1);

			// 디렉토리를 검사함
			if(!is_dir("./file_data/".$id)) {
				@mkdir("./file_data/".$id,0777);
				@chmod("./file_data/".$id,0706);
			}

			// 중복파일이 있을때;;
			if(file_exists("./file_data/$id/".$temp1_name)) {
				@mkdir("./file_data/$id/".$reg_date,0777);
				if(!move_uploaded_file($file1,"./file_data/$id/".$reg_date."/".$temp1_name)) Error("파일업로드가 제대로 되지 않았습니다");
				$file_name1 = "/recruit/file_data/$id/".$reg_date."/".$temp1_name;
				@chmod($file_name1,0706);
				@chmod("./file_data/$id/".$reg_date,0707);
			} else {
				if(!move_uploaded_file($file1,"./file_data/$id/".$temp1_name)) Error("파일업로드가 제대로 되지 않았습니다");
				$file_name1 = "/recruit/file_data/$id/".$temp1_name;
				@chmod($file_name1,0706);
			}
		}
	}


	if($apply_major == "간호학과"){
		$apply_num_1 = "간호";
		$apply_num_etcIdx = "02";
	}elseif($apply_major=="작업치료과"){
		$apply_num_1 = "작치";
		$apply_num_etcIdx = "";
	}else{
		$apply_num_1 = str_replace("과","",$apply_major);
		$apply_num_etcIdx = "";
	}

//################################################
// 접수번호 수정내용
$apply_num_2 = "(2019-1)";



//################################################

/*
	if($gubun=="정년과정"){
		$apply_num_2 = "(정)";
	}elseif($gubun=="비정년과정"){
		$apply_num_2 = "(비)";
	}

*/
/*
	if($type_gubun == "정신간호학"){
		$apply_num_3 = "-정신-";
	}else{
		$apply_num_3 = "-간호-";
	}
*/
	$apply_count=mysql_num_rows(mysql_query("SELECT * FROM recruit_copy WHERE resume_num='$resume_num'"));

	if($apply_count < 10){
		$apply_count = $apply_count + 1;
		$apply_count = "0".$apply_count;
	}else{
		$apply_count = $apply_count+1;
	}

	if($j==""){
		$apply_num = $apply_num_1.$apply_num_2."-".$apply_num_etcIdx."-";
	}elseif($j=="u"){

		$resume_data = mysql_fetch_array(mysql_query("SELECT apply_num FROM recruit1 WHERE wr_id='$wr_id'"));
		$apply_count_u = explode("-",$resume_data[apply_num]);
		$apply_count_u_idx = count($apply_count_u) - 1;

		$apply_num = $apply_num_1.$apply_num_2."-".$apply_num_etcIdx."-".$apply_count_u[$apply_count_u_idx];

	}
	$profile = addslashes($profile);
	$thesis1_content = addslashes($thesis1_content);
	$thesis2_content = addslashes($thesis2_content);
	$study1_content = addslashes($study1_content);
	$study2_content = addslashes($study2_content);
	$study3_content = addslashes($study3_content);
	$study4_content = addslashes($study4_content);
	$study5_content = addslashes($study5_content);
	$study6_content = addslashes($study6_content);
	$study7_content = addslashes($study7_content);
	$study8_content = addslashes($study8_content);

	$kor_name = trim($_POST["kor_name"]);

	$birth = $bYear."-".$bMonth."-".$bDay;
	if($hTel1 && $hTel2 && $hTel3){$hTel = $hTel1."-".$hTel2."-".$hTel3;}
	if($jTel1 && $jTel2 && $jTel3){$jTel = $jTel1."-".$jTel2."-".$jTel3;}
	$phone = $phone1."-".$phone2."-".$phone3;
	$zip = $zip1."-".$zip2;
	$hPeriod = $hPeriod1."~".$hPeriod2;

	$cPeriod = $cPeriod1."~".$cPeriod2;

	$cPeriod1 = $cPeriod1_1."~".$cPeriod1_2;

	$uPeriod = $uPeriod1."~".$uPeriod2;

	$uPeriod1 = $uPeriod1_1."~".$uPeriod1_2;

	$mPeriod = $mPeriod1."~".$mPeriod2;

	$mPeriod1 = $mPeriod1_1."~".$mPeriod1_2;

	$dPeriod = $dPeriod1."~".$dPeriod2;

	$dPeriod1 = $dPeriod1_1."~".$dPeriod1_2;

	if($jpsYear1 && $jpsMonth1 && $jpsDate1){$jpsPeriod1 = $jpsYear1."-".$jpsMonth1."-".$jpsDate1;}
	if($jpeYear1 && $jpeMonth1 && $jpeDate1){$jpePeriod1 = $jpeYear1."-".$jpeMonth1."-".$jpeDate1;}
	//if($jobYear1 && $jobMonth1){$jobPeriod1 = $jobYear1."-".$jobMonth1;}
	if($jobYear1 || $jobMonth1){$jobPeriod1 = $jobYear1."-".$jobMonth1;}
	if($jpsYear2 && $jpsMonth2 && $jpsDate2){$jpsPeriod2 = $jpsYear2."-".$jpsMonth2."-".$jpsDate2;}
	if($jpeYear2 && $jpeMonth2 && $jpeDate2){$jpePeriod2 = $jpeYear2."-".$jpeMonth2."-".$jpeDate2;}
	//if($jobYear2 && $jobMonth2){$jobPeriod2 = $jobYear2."-".$jobMonth2;}
	if($jobYear2 || $jobMonth2){$jobPeriod2 = $jobYear2."-".$jobMonth2;}
	if($jpsYear3 && $jpsMonth3 && $jpsDate3){$jpsPeriod3 = $jpsYear3."-".$jpsMonth3."-".$jpsDate3;}
	if($jpeYear3 && $jpeMonth3 && $jpeDate3){$jpePeriod3 = $jpeYear3."-".$jpeMonth3."-".$jpeDate3;}
	//if($jobYear3 && $jobMonth3){$jobPeriod3 = $jobYear3."-".$jobMonth3;}
	if($jobYear3 || $jobMonth3){$jobPeriod3 = $jobYear3."-".$jobMonth3;}
	if($jpsYear4 && $jpsMonth4 && $jpsDate4){$jpsPeriod4 = $jpsYear4."-".$jpsMonth4."-".$jpsDate4;}
	if($jpeYear4 && $jpeMonth4 && $jpeDate4){$jpePeriod4 = $jpeYear4."-".$jpeMonth4."-".$jpeDate4;}
	//if($jobYear4 && $jobMonth4){$jobPeriod4 = $jobYear4."-".$jobMonth4;}
	if($jobYear4 || $jobMonth4){$jobPeriod4 = $jobYear4."-".$jobMonth4;}
	if($jpsYear5 && $jpsMonth5 && $jpsDate5){$jpsPeriod5 = $jpsYear5."-".$jpsMonth5."-".$jpsDate5;}
	if($jpeYear5 && $jpeMonth5 && $jpeDate5){$jpePeriod5 = $jpeYear5."-".$jpeMonth5."-".$jpeDate5;}
	//if($jobYear5 && $jobMonth5){$jobPeriod5 = $jobYear5."-".$jobMonth5;}
	if($jobYear5 || $jobMonth5){$jobPeriod5 = $jobYear5."-".$jobMonth5;}
	if($jpsYear6 && $jpsMonth6 && $jpsDate6){$jpsPeriod6 = $jpsYear6."-".$jpsMonth6."-".$jpsDate6;}
	if($jpeYear6 && $jpeMonth6 && $jpeDate6){$jpePeriod6 = $jpeYear6."-".$jpeMonth6."-".$jpeDate6;}
	//if($jobYear6 && $jobMonth6){$jobPeriod6 = $jobYear6."-".$jobMonth6;}
	if($jobYear6 || $jobMonth6){$jobPeriod6 = $jobYear6."-".$jobMonth6;}
	if($jpsYear7 && $jpsMonth7 && $jpsDate7){$jpsPeriod7 = $jpsYear7."-".$jpsMonth7."-".$jpsDate7;}
	if($jpeYear7 && $jpeMonth7 && $jpeDate7){$jpePeriod7 = $jpeYear7."-".$jpeMonth7."-".$jpeDate7;}
	//if($jobYear7 && $jobMonth7){$jobPeriod7 = $jobYear7."-".$jobMonth7;}
	if($jobYear7 || $jobMonth7){$jobPeriod7 = $jobYear7."-".$jobMonth7;}
	if($jpsYear8 && $jpsMonth8 && $jpsDate8){$jpsPeriod8 = $jpsYear8."-".$jpsMonth8."-".$jpsDate8;}
	if($jpeYear8 && $jpeMonth8 && $jpeDate8){$jpePeriod8 = $jpeYear8."-".$jpeMonth8."-".$jpeDate8;}
	//if($jobYear8 && $jobMonth8){$jobPeriod8 = $jobYear8."-".$jobMonth8;}
	if($jobYear8 || $jobMonth8){$jobPeriod8 = $jobYear8."-".$jobMonth8;}
	if($jpsYear9 && $jpsMonth9 && $jpsDate9){$jpsPeriod9 = $jpsYear9."-".$jpsMonth9."-".$jpsDate9;}
	if($jpeYear9 && $jpeMonth9 && $jpeDate9){$jpePeriod9 = $jpeYear9."-".$jpeMonth9."-".$jpeDate9;}
	//if($jobYear9 && $jobMonth9){$jobPeriod9 = $jobYear9."-".$jobMonth9;}
	if($jobYear9 || $jobMonth9){$jobPeriod9 = $jobYear9."-".$jobMonth9;}
	if($jpsYear10 && $jpsMonth10 && $jpsDate10){$jpsPeriod10 = $jpsYear10."-".$jpsMonth10."-".$jpsDate10;}
	if($jpeYear10 && $jpeMonth10 && $jpeDate10){$jpePeriod10 = $jpeYear10."-".$jpeMonth10."-".$jpeDate10;}
	//if($jobYear10 && $jobMonth10){$jobPeriod10 = $jobYear10."-".$jobMonth10;}
	if($jobYear10 || $jobMonth10){$jobPeriod10 = $jobYear10."-".$jobMonth10;}
	if($jpsYear11 && $jpsMonth11 && $jpsDate11){$jpsPeriod11 = $jpsYear11."-".$jpsMonth11."-".$jpsDate11;}
	if($jpeYear11 && $jpeMonth11 && $jpeDate11){$jpePeriod11 = $jpeYear11."-".$jpeMonth11."-".$jpeDate11;}
	//if($jobYear11 && $jobMonth11){$jobPeriod11 = $jobYear11."-".$jobMonth11;}
	if($jobYear11 || $jobMonth11){$jobPeriod11 = $jobYear11."-".$jobMonth11;}
	if($jpsYear12 && $jpsMonth12 && $jpsDate12){$jpsPeriod12 = $jpsYear12."-".$jpsMonth12."-".$jpsDate12;}
	if($jpeYear12 && $jpeMonth12 && $jpeDate12){$jpePeriod12 = $jpeYear12."-".$jpeMonth12."-".$jpeDate12;}
	//if($jobYear12 && $jobMonth12){$jobPeriod12 = $jobYear12."-".$jobMonth12;}
	if($jobYear12 || $jobMonth12){$jobPeriod12 = $jobYear12."-".$jobMonth12;}
	if($jpsYear13 && $jpsMonth13 && $jpsDate13){$jpsPeriod13 = $jpsYear13."-".$jpsMonth13."-".$jpsDate13;}
	if($jpeYear13 && $jpeMonth13 && $jpeDate13){$jpePeriod13 = $jpeYear13."-".$jpeMonth13."-".$jpeDate13;}
	//if($jobYear13 && $jobMonth13){$jobPeriod13 = $jobYear13."-".$jobMonth13;}
	if($jobYear13 || $jobMonth13){$jobPeriod13 = $jobYear13."-".$jobMonth13;}
	if($jpsYear14 && $jpsMonth14 && $jpsDate14){$jpsPeriod14 = $jpsYear14."-".$jpsMonth14."-".$jpsDate14;}
	if($jpeYear14 && $jpeMonth14 && $jpeDate14){$jpePeriod14 = $jpeYear14."-".$jpeMonth14."-".$jpeDate14;}
	//if($jobYear14 && $jobMonth14){$jobPeriod14 = $jobYear14."-".$jobMonth14;}
	if($jobYear14 || $jobMonth14){$jobPeriod14 = $jobYear14."-".$jobMonth14;}
	if($jpsYear15 && $jpsMonth15 && $jpsDate15){$jpsPeriod15 = $jpsYear15."-".$jpsMonth15."-".$jpsDate15;}
	if($jpeYear15 && $jpeMonth15 && $jpeDate15){$jpePeriod15 = $jpeYear15."-".$jpeMonth15."-".$jpeDate15;}
	//if($jobYear15 && $jobMonth15){$jobPeriod15 = $jobYear15."-".$jobMonth15;}
	if($jobYear15 || $jobMonth15){$jobPeriod15 = $jobYear15."-".$jobMonth15;}

	$query1 = "	apply_major = '$apply_major',
							major = '$major',
							gubun = '$gubun',
							kor_name = '$kor_name',
							eng_name = '$eng_name',
							chi_name = '$chi_name',
							sex = '$sex',
							country = '$country',
							married = '$married',
							army = '$army',
							birth = '$birth',
							age = '$age',
							hTel = '$hTel',
							jTel = '$jTel',
							phone = '$phone',
							email = '$email',
							zip = '$zip',
							zonecode = '$zonecode',
							addr1 = '$addr1',
							addr2 = '$addr2',
							company = '$company',
							hPeriod = '$hPeriod',
							hSchool = '$hSchool',
							cPeriod = '$cPeriod',
							colleage = '$colleage',
							cMajor = '$cMajor',
							cDegree = '$cDegree',
							cDegree_date = '$cDegree_date',
							cScore = '$cScore',
							cTotal = '$cTotal',
							cPeriod1 = '$cPeriod1',
							colleage1 = '$colleage1',
							cMajor1 = '$cMajor1',
							cDegree1 = '$cDegree1',
							cDegree_date1 = '$cDegree_date1',
							cScore1 = '$cScore1',
							cTotal1 = '$cTotal1',
							uPeriod = '$uPeriod',
							univ = '$univ',
							uMajor = '$uMajor',
							uDegree = '$uDegree',
							uDegree_date = '$uDegree_date',
							uScore = '$uScore',
							uTotal = '$uTotal',
							uPeriod1 = '$uPeriod1',
							univ1 = '$univ1',
							uMajor1 = '$uMajor1',
							uDegree1 = '$uDegree1',
							uDegree_date1 = '$uDegree_date1',
							uScore1 = '$uScore1',
							uTotal1 = '$uTotal1',
							mPeriod = '$mPeriod',
							master = '$master',
							mMajor = '$mMajor',
							mDegree = '$mDegree',
							mDegree_date = '$mDegree_date',
							mScore = '$mScore',
							mTotal = '$mTotal',
							mPeriod1 = '$mPeriod1',
							master1 = '$master1',
							mMajor1 = '$mMajor1',
							mDegree1 = '$mDegree1',
							mDegree_date1 = '$mDegree_date1',
							mScore1 = '$mScore1',
							mTotal1 = '$mTotal1',
							dPeriod = '$dPeriod',
							doctor = '$doctor',
							dMajor = '$dMajor',
							dDegree = '$dDegree',
							dDegree_date = '$dDegree_date',
							dScore = '$dScore',
							dTotal = '$dTotal',
							dPeriod1 = '$dPeriod1',
							doctor1 = '$doctor1',
							dMajor1 = '$dMajor1',
							dDegree1 = '$dDegree1',
							dDegree_date1 = '$dDegree_date1',
							dScore1 = '$dScore1',
							dTotal1 = '$dTotal1',
							jpsPeriod1 = '$jpsPeriod1',
							jpePeriod1 = '$jpePeriod1',
							jobPeriod1 = '$jobPeriod1',
							jobCompany1 = '$jobCompany1',
							jobDegree1 = '$jobDegree1',
							jpsPeriod2 = '$jpsPeriod2',
							jpePeriod2 = '$jpePeriod2',
							jobPeriod2 = '$jobPeriod2',
							jobCompany2 = '$jobCompany2',
							jobDegree2 = '$jobDegree2',
							jpsPeriod3 = '$jpsPeriod3',
							jpePeriod3 = '$jpePeriod3',
							jobPeriod3 = '$jobPeriod3',
							jobCompany3 = '$jobCompany3',
							jobDegree3 = '$jobDegree3',
							jpsPeriod4 = '$jpsPeriod4',
							jpePeriod4 = '$jpePeriod4',
							jobPeriod4 = '$jobPeriod4',
							jobCompany4 = '$jobCompany4',
							jobDegree4 = '$jobDegree4',
							jpsPeriod5 = '$jpsPeriod5',
							jpePeriod5 = '$jpePeriod5',
							jobPeriod5 = '$jobPeriod5',
							jobCompany5 = '$jobCompany5',
							jobDegree5 = '$jobDegree5',
							jpsPeriod6 = '$jpsPeriod6',
							jpePeriod6 = '$jpePeriod6',
							jobPeriod6 = '$jobPeriod6',
							jobCompany6 = '$jobCompany6',
							jobDegree6 = '$jobDegree6',
							jpsPeriod7 = '$jpsPeriod7',
							jpePeriod7 = '$jpePeriod7',
							jobPeriod7 = '$jobPeriod7',
							jobCompany7 = '$jobCompany7',
							jobDegree7 = '$jobDegree7',
							jpsPeriod8 = '$jpsPeriod8',
							jpePeriod8 = '$jpePeriod8',
							jobPeriod8 = '$jobPeriod8',
							jobCompany8 = '$jobCompany8',
							jobDegree8 = '$jobDegree8',
							jpsPeriod9 = '$jpsPeriod9',
							jpePeriod9 = '$jpePeriod9',
							jobPeriod9 = '$jobPeriod9',
							jobCompany9 = '$jobCompany9',
							jobDegree9 = '$jobDegree9',
							jpsPeriod10 = '$jpsPeriod10',
							jpePeriod10 = '$jpePeriod10',
							jobPeriod10 = '$jobPeriod10',
							jobCompany10 = '$jobCompany10',
							jobDegree10 = '$jobDegree10',
							jpsPeriod11 = '$jpsPeriod11',
							jpePeriod11 = '$jpePeriod11',
							jobPeriod11 = '$jobPeriod11',
							jobCompany11 = '$jobCompany11',
							jobDegree11 = '$jobDegree11',
							jpsPeriod12 = '$jpsPeriod12',
							jpePeriod12 = '$jpePeriod12',
							jobPeriod12 = '$jobPeriod12',
							jobCompany12 = '$jobCompany12',
							jobDegree12 = '$jobDegree12',
							jpsPeriod13 = '$jpsPeriod13',
							jpePeriod13 = '$jpePeriod13',
							jobPeriod13 = '$jobPeriod13',
							jobCompany13 = '$jobCompany13',
							jobDegree13 = '$jobDegree13',
							jpsPeriod14 = '$jpsPeriod14',
							jpePeriod14 = '$jpePeriod14',
							jobPeriod14 = '$jobPeriod14',
							jobCompany14 = '$jobCompany14',
							jobDegree14 = '$jobDegree14',
							jpsPeriod15 = '$jpsPeriod15',
							jpePeriod15 = '$jpePeriod15',
							jobPeriod15 = '$jobPeriod15',
							jobCompany15 = '$jobCompany15',
							jobDegree15 = '$jobDegree15',
							etc1 = '$etc1',
							etc1_date = '$etc1_date',
							etc1_company = '$etc1_company',
							etc2 = '$etc2',
							etc2_date = '$etc2_date',
							etc2_company = '$etc2_company',
							etc3 = '$etc3',
							etc3_date = '$etc3_date',
							etc3_company = '$etc3_company',
							etc4 = '$etc4',
							etc4_date = '$etc4_date',
							etc4_company = '$etc4_company',
							etc5 = '$etc5',
							etc5_date = '$etc5_date',
							etc5_company = '$etc5_company',
							etc6 = '$etc6',
							etc6_date = '$etc6_date',
							etc6_company = '$etc6_company',
							etc7 = '$etc7',
							etc7_date = '$etc7_date',
							etc7_company = '$etc7_company',
							etc8 = '$etc8',
							etc8_date = '$etc8_date',
							etc8_company = '$etc8_company',
							etc9 = '$etc9',
							etc9_date = '$etc9_date',
							etc9_company = '$etc9_company',
							etc10 = '$etc10',
							etc10_date = '$etc10_date',
							etc10_company = '$etc10_company',
							etc11 = '$etc11',
							etc11_date = '$etc11_date',
							etc11_company = '$etc11_company',
							etc12 = '$etc12',
							etc12_date = '$etc12_date',
							etc12_company = '$etc12_company',
							etc13 = '$etc13',
							etc13_date = '$etc13_date',
							etc13_company = '$etc13_company',
							etc14 = '$etc14',
							etc14_date = '$etc14_date',
							etc14_company = '$etc14_company',
							etc15 = '$etc15',
							etc15_date = '$etc15_date',
							etc15_company = '$etc15_company',
							resume_num = '$resume_num'
	";
	$query2 = "profile = '$profile',
							sub_title= '$sub_title',
							thesis1_school = '$thesis1_school',
							thesis1_postgraduate = '$thesis1_postgraduate',
							thesis1_degree = '$thesis1_degree',
							thesis1_major = '$thesis1_major',
							thesis1_tutor = '$thesis1_tutor',
							thesis1_subject = '$thesis1_subject',
							thesis1_content = '$thesis1_content',
							thesis2_school = '$thesis2_school',
							thesis2_postgraduate = '$thesis2_postgraduate',
							thesis2_degree = '$thesis2_degree',
							thesis2_major = '$thesis2_major',
							thesis2_tutor = '$thesis2_tutor',
							thesis2_subject = '$thesis2_subject',
							thesis2_content = '$thesis2_content',
							study1_gubun = '$study1_gubun',
							study1_subject = '$study1_subject',
							study1_content = '$study1_content',
							study1_date = '$study1_date',
							study1_mem = '$study1_mem',
							study1_book = '$study1_book',
							study1_author = '$study1_author',
							study2_gubun = '$study2_gubun',
							study2_subject = '$study2_subject',
							study2_content = '$study2_content',
							study2_date = '$study2_date',
							study2_mem = '$study2_mem',
							study2_book = '$study2_book',
							study2_author = '$study2_author',
							study3_gubun = '$study3_gubun',
							study3_subject = '$study3_subject',
							study3_content = '$study3_content',
							study3_date = '$study3_date',
							study3_mem = '$study3_mem',
							study3_book = '$study3_book',
							study3_author = '$study3_author',
							study4_gubun = '$study4_gubun',
							study4_subject = '$study4_subject',
							study4_content = '$study4_content',
							study4_date = '$study4_date',
							study4_mem = '$study4_mem',
							study4_book = '$study4_book',
							study4_author = '$study4_author',
							study5_gubun = '$study5_gubun',
							study5_subject = '$study5_subject',
							study5_content = '$study5_content',
							study5_date = '$study5_date',
							study5_mem = '$study5_mem',
							study5_book = '$study5_book',
							study5_author = '$study5_author',
							study6_gubun = '$study6_gubun',
							study6_subject = '$study6_subject',
							study6_content = '$study6_content',
							study6_date = '$study6_date',
							study6_mem = '$study6_mem',
							study6_book = '$study6_book',
							study6_author = '$study6_author',
							study7_gubun = '$study7_gubun',
							study7_subject = '$study7_subject',
							study7_content = '$study7_content',
							study7_date = '$study7_date',
							study7_mem = '$study7_mem',
							study7_book = '$study7_book',
							study7_author = '$study7_author',
							study8_gubun = '$study8_gubun',
							study8_subject = '$study8_subject',
							study8_content = '$study8_content',
							study8_date = '$study8_date',
							study8_mem = '$study8_mem',
							study8_book = '$study8_book',
							study8_author = '$study8_author',
							study9_gubun = '$study9_gubun',
							study9_subject = '$study9_subject',
							study9_content = '$study9_content',
							study9_date = '$study9_date',
							study9_mem = '$study9_mem',
							study9_book = '$study9_book',
							study9_author = '$study9_author',
							study10_gubun = '$study10_gubun',
							study10_subject = '$study10_subject',
							study10_content = '$study10_content',
							study10_date = '$study10_date',
							study10_mem = '$study10_mem',
							study10_book = '$study10_book',
							study10_author = '$study10_author',
							study11_gubun = '$study11_gubun',
							study11_subject = '$study11_subject',
							study11_content = '$study11_content',
							study11_date = '$study11_date',
							study11_mem = '$study11_mem',
							study11_book = '$study11_book',
							study11_author = '$study11_author',
							study12_gubun = '$study12_gubun',
							study12_subject = '$study12_subject',
							study12_content = '$study12_content',
							study12_date = '$study12_date',
							study12_mem = '$study12_mem',
							study12_book = '$study12_book',
							study12_author = '$study12_author',
							study13_gubun = '$study13_gubun',
							study13_subject = '$study13_subject',
							study13_content = '$study13_content',
							study13_date = '$study13_date',
							study13_mem = '$study13_mem',
							study13_book = '$study13_book',
							study13_author = '$study13_author',
							study14_gubun = '$study14_gubun',
							study14_subject = '$study14_subject',
							study14_content = '$study14_content',
							study14_date = '$study14_date',
							study14_mem = '$study14_mem',
							study14_book = '$study14_book',
							study14_author = '$study14_author',
							study15_gubun = '$study15_gubun',
							study15_subject = '$study15_subject',
							study15_content = '$study15_content',
							study15_date = '$study15_date',
							study15_mem = '$study15_mem',
							study15_book = '$study15_book',
							study15_author = '$study15_author',
							study16_gubun = '$study16_gubun',
							study16_subject = '$study16_subject',
							study16_content = '$study16_content',
							study16_date = '$study16_date',
							study16_mem = '$study16_mem',
							study16_book = '$study16_book',
							study16_author = '$study16_author',
							study17_gubun = '$study17_gubun',
							study17_subject = '$study17_subject',
							study17_content = '$study17_content',
							study17_date = '$study17_date',
							study17_mem = '$study17_mem',
							study17_book = '$study17_book',
							study17_author = '$study17_author',
							study18_gubun = '$study18_gubun',
							study18_subject = '$study18_subject',
							study18_content = '$study18_content',
							study18_date = '$study18_date',
							study18_mem = '$study18_mem',
							study18_book = '$study18_book',
							study18_author = '$study18_author',
							study19_gubun = '$study19_gubun',
							study19_subject = '$study19_subject',
							study19_content = '$study19_content',
							study19_date = '$study19_date',
							study19_mem = '$study19_mem',
							study19_book = '$study19_book',
							study19_author = '$study19_author',
							study20_gubun = '$study20_gubun',
							study20_subject = '$study20_subject',
							study20_content = '$study20_content',
							study20_date = '$study20_date',
							study20_mem = '$study20_mem',
							study20_book = '$study20_book',
							study20_author = '$study20_author',
							password = '$pass'";

	$query3 = "
						hSchool_addr = '$hSchool_addr',
						colleage_addr = '$colleage_addr',
						colleage1_addr = '$colleage1_addr',
						univ_addr = '$univ_addr',
						univ1_addr = '$univ1_addr',
						master_addr = '$master_addr',
						master1_addr = '$master1_addr',
						doctor_addr = '$doctor_addr',
						doctor1_addr = '$doctor1_addr'
	";

	//$type_gubun = iconv("utf-8","euc-kr",$type_gubun);
	if($j==""){
		$sql = "INSERT recruit_copy SET apply_num='$apply_num',$query1 ,file_name='$file_name1', s_file_name='$s_file_name1'";
		$result = mysql_query($sql);
		$wr_ins_id = mysql_insert_id();
		$sql1 = "INSERT recruit1 SET parent = '$wr_ins_id',wr_datetime=now(),type_gubun='$type_gubun',$query2";
		if($_SERVER['REMOTE_ADDR']=="112.217.216.250"){
			//print_R($sql1);exit;
		}
		mysql_query($sql1);
		$sql2 = "INSERT recruit_school_addr SET parent = '$wr_ins_id',$query3";
		mysql_query($sql2);
		if($result){

			echo "<script>alert('이력서가 정상적으로 접수되었습니다.');location.href='./'</script>";
		}else{
			echo "<script>alert('오류가 발생하였습니다.');history.back();</script>";
		}
	}else if($j=="u"){

		if($s_file_name1){
			$query1 .= " ,file_name='$file_name1', s_file_name='$s_file_name1' ";
		}
		$query1 .= " WHERE wr_id='$wr_id'";
		$sql = "UPDATE recruit_copy SET apply_num='$apply_num', $query1 ";

		$result = mysql_query($sql);
		$sql1 = "UPDATE recruit1 SET type_gubun='$type_gubun',$query2 WHERE parent='$wr_id'";
		mysql_query($sql1);
		$sql2 = "UPDATE recruit_school_addr SET $query3 WHERE parent='$wr_id'";
		//print_R($sql2);exit;
		mysql_query($sql2);
		if($result){

			echo "<script>alert('이력서가 정상적으로 수정되었습니다.');location.href='./resume.php?j=u&wr_id=$wr_id&pass=$pass_check'</script>";
		}else{
			echo "<script>alert('오류가 발생하였습니다.');history.back();</script>";
		}
	}
?>
