<?php
	// 개별 페이지 실행 방지. 해당 문자열은 inc.constant.php에 정의된다.
	define("__AF__", TRUE);
	// adframe 템플릿 페이지 설정.
	include($_SERVER["DOCUMENT_ROOT"] . "/adframe/af_common.php");
	// PHP7 compatibility: $HTTP_POST_FILES superglobal removed as of PHP 5.4, causing
	// the file-upload blocks below to always be skipped ($HTTP_POST_FILES[fileN] always empty).
	if (!isset($HTTP_POST_FILES) || !is_array($HTTP_POST_FILES)) { $HTTP_POST_FILES = $_FILES; }

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
			$allowed_ext = ['jpg','jpeg','png','gif','pdf','doc','docx','hwp'];
			if (!in_array(strtolower(end($temp1)), $allowed_ext)) { Error("허용되지 않는 파일 형식입니다."); }
			$temp1_name = $reg_date.'.'.$temp1[1];

			$file1 = preg_replace("/\\\\\\\\/","\\\\", $file1); // PHP7: eregi_replace removed
			$s_file_name1 = str_replace(" ","_",$s_file_name1);
			$s_file_name1 = str_replace("-","_",$s_file_name1);

			// 디렉토리를 검사함
			// apache 계정이 ch 그룹에도 속해있어(/etc/group), 소유자가 ch인 디렉토리/파일은
			// "그룹" 권한으로 검사된다(더 널널한 "기타" 권한은 적용 안 됨). 그룹 권한을 비워두던
			// 기존 0706/0707 로는 apache가 쓰기(및 접근) 자체가 막혀 업로드가 항상 실패했다.
			if(!is_dir("./file_data/".$id)) {
				@mkdir("./file_data/".$id,0777);
				@chmod("./file_data/".$id,0777);
			}

			// 중복파일이 있을때;;
			if(file_exists("./file_data/$id/".$temp1_name)) {
				@mkdir("./file_data/$id/".$reg_date,0777);
				if(!move_uploaded_file($file1,"./file_data/$id/".$reg_date."/".$temp1_name)) Error("파일업로드가 제대로 되지 않았습니다");
				$file_name1 = "/recruit4/file_data/$id/".$reg_date."/".$temp1_name;
				@chmod($file_name1,0777);
				@chmod("./file_data/$id/".$reg_date,0777);
			} else {
				if(!move_uploaded_file($file1,"./file_data/$id/".$temp1_name)) Error("파일업로드가 제대로 되지 않았습니다");
				$file_name1 = "/recruit4/file_data/$id/".$temp1_name;
				@chmod($file_name1,0777);
			}
		}
	}

	if($HTTP_POST_FILES[file2]) {
		$file2 = $HTTP_POST_FILES[file2][tmp_name];
		$file2_name = $HTTP_POST_FILES[file2][name];
		$file2_size = $HTTP_POST_FILES[file2][size];
		$file2_type = $HTTP_POST_FILES[file2][type];
	}

	if($file2_size>0&&$file2) {

		if(!is_uploaded_file($file2)) Error("정상적인 방법으로 업로드 해주세요");
		$file2_size=filesize($file2);

		// 업로드 금지
		if($file2_size>0) {
			$s_file_name2 = $file2_name;
			$temp2=explode(".",$file2_name);
			$allowed_ext = ['jpg','jpeg','png','gif','pdf','doc','docx','hwp'];
			if (!in_array(strtolower(end($temp2)), $allowed_ext)) { Error("허용되지 않는 파일 형식입니다."); }
			$temp2_name = $reg_date.'.'.$temp2[1];

			$file2 = preg_replace("/\\\\\\\\/","\\\\", $file2); // PHP7: eregi_replace removed
			$s_file_name2 = str_replace(" ","_",$s_file_name2);
			$s_file_name2 = str_replace("-","_",$s_file_name2);

			// 디렉토리를 검사함
			// apache 계정이 ch 그룹에도 속해있어(/etc/group), 소유자가 ch인 디렉토리/파일은
			// "그룹" 권한으로 검사된다(더 널널한 "기타" 권한은 적용 안 됨). 그룹 권한을 비워두던
			// 기존 0706/0707 로는 apache가 쓰기(및 접근) 자체가 막혀 업로드가 항상 실패했다.
			if(!is_dir("./file_data/".$id)) {
				@mkdir("./file_data/".$id,0777);
				@chmod("./file_data/".$id,0777);
			}

			// 중복파일이 있을때;;
			if(file_exists("./file_data/$id/".$temp2_name)) {
				@mkdir("./file_data/$id/".$reg_date,0777);
				if(!move_uploaded_file($file2,"./file_data/$id/".$reg_date."/".$temp2_name)) Error("파일업로드가 제대로 되지 않았습니다1");
				$file_name2 = "/recruit4/file_data/$id/".$reg_date."/".$temp2_name;
				@chmod($file_name2,0777);
				@chmod("./file_data/$id/".$reg_date,0777);
			} else {
				//echo $temp2_name;exit;
				if(!move_uploaded_file($file2,"./file_data/$id/".$temp2_name)) Error("파일업로드가 제대로 되지 않았습니다2");
				$file_name2 = "/recruit4/file_data/$id/".$temp2_name;
				@chmod($file_name2,0777);
			}
		}
	}


	$kor_name = trim($_POST["kor_name"]);

	if($hTel1 && $hTel2 && $hTel3){$hTel = $hTel1."-".$hTel2."-".$hTel3;}
	if($jTel1 && $jTel2 && $jTel3){$jTel = $jTel1."-".$jTel2."-".$jTel3;}
	$phone = $phone1."-".$phone2."-".$phone3;
	$zip = $zip1."-".$zip2;

	$department = addslashes($department);
	$careerYN = addslashes($careerYN);
	$kor_name = addslashes($kor_name);
	$eng_name = addslashes($eng_name);
	$chi_name = addslashes($chi_name);
	$sex = addslashes($sex);
	$birth = addslashes($birth);
	$age = addslashes($age);
	$hTel = addslashes($hTel);
	$jTel = addslashes($jTel);
	$phone = addslashes($phone);
	$email = addslashes($email);
	$zip = addslashes($zip);
	$zonecode = addslashes($zonecode);
	$addr1 = addslashes($addr1);
	$addr2 = addslashes($addr2);
	$company = addslashes($company);
	$hPeriod1 = addslashes($hPeriod1);
	$hPeriod2 = addslashes($hPeriod2);
	$hSchool = addslashes($hSchool);
	$cPeriod1 = addslashes($cPeriod1);
	$cPeriod2 = addslashes($cPeriod2);
	$colleage = addslashes($colleage);
	$cMajor = addslashes($cMajor);
	$cEndYN = addslashes($cEndYN);
	$cDegree = addslashes($cDegree);
	$cScore = addslashes($cScore);
	$cTotal = addslashes($cTotal);
	$uPeriod1 = addslashes($uPeriod1);
	$uPeriod2 = addslashes($uPeriod2);
	$univ = addslashes($univ);
	$uMajor = addslashes($uMajor);
	$uDegree = addslashes($uDegree);
	$uScore = addslashes($uScore);
	$uTotal = addslashes($uTotal);
	$mPeriod1 = addslashes($mPeriod1);
	$mPeriod2 = addslashes($mPeriod2);
	$master = addslashes($master);
	$mMajor = addslashes($mMajor);
	$mDegree = addslashes($mDegree);
	$mScore = addslashes($mScore);
	$mTotal = addslashes($mTotal);
	$etc1 = addslashes($etc1);
	$etc1_date = addslashes($etc1_date);
	$etc1_company = addslashes($etc1_company);
	$etc2 = addslashes($etc2);
	$etc2_date = addslashes($etc2_date);
	$etc2_company = addslashes($etc2_company);
	$etc3 = addslashes($etc3);
	$etc3_date = addslashes($etc3_date);
	$etc3_company = addslashes($etc3_company);
	$etc4 = addslashes($etc4);
	$etc4_date = addslashes($etc4_date);
	$etc4_company = addslashes($etc4_company);
	$etc5 = addslashes($etc5);
	$etc5_date = addslashes($etc5_date);
	$etc5_company = addslashes($etc5_company);
	$etc6 = addslashes($etc6);
	$etc6_date = addslashes($etc6_date);
	$etc6_company = addslashes($etc6_company);
	$specialty1 = addslashes($specialty1);
	$specialty1_degree = addslashes($specialty1_degree);
	$specialty1_score = addslashes($specialty1_score);
	$specialty1_date = addslashes($specialty1_date);
	$specialty1_nm = addslashes($specialty1_nm);
	$specialty2 = addslashes($specialty2);
	$specialty2_degree = addslashes($specialty2_degree);
	$specialty2_score = addslashes($specialty2_score);
	$specialty2_date = addslashes($specialty2_date);
	$specialty2_nm = addslashes($specialty2_nm);
	$veteransYN = addslashes($veteransYN);
	$veterans_no = addslashes($veterans_no);
	$army_type = addslashes($army_type);
	$army_rank = addslashes($army_rank);
	$army_start = addslashes($army_start);
	$army_end = addslashes($army_end);
	$army_service_month = addslashes($army_service_month);
	$disabled_no = addslashes($disabled_no);
	$disabled_type = addslashes($disabled_type);
	$disabled_degree = addslashes($disabled_degree);
	$low_incomeYN = addslashes($low_incomeYN);
	$basic_living = addslashes($basic_living);
	$one_parent = addslashes($one_parent);
	$jobStart1 = addslashes($jobStart1);
	$jobEnd1 = addslashes($jobEnd1);
	$jobYear1 = addslashes($jobYear1);
	$jobMonth1 = addslashes($jobMonth1);
	$jobCompany1 = addslashes($jobCompany1);
	$jobDepartment1 = addslashes($jobDepartment1);
	$jobDegree1 = addslashes($jobDegree1);
	$jobWork1 = addslashes($jobWork1);
	$retirement1 = addslashes($retirement1);
	$jobStart2 = addslashes($jobStart2);
	$jobEnd2 = addslashes($jobEnd2);
	$jobYear2 = addslashes($jobYear2);
	$jobMonth2 = addslashes($jobMonth2);
	$jobCompany2 = addslashes($jobCompany2);
	$jobDepartment2 = addslashes($jobDepartment2);
	$jobDegree2 = addslashes($jobDegree2);
	$jobWork2 = addslashes($jobWork2);
	$retirement2 = addslashes($retirement2);
	$jobStart3 = addslashes($jobStart3);
	$jobEnd3 = addslashes($jobEnd3);
	$jobYear3 = addslashes($jobYear3);
	$jobMonth3 = addslashes($jobMonth3);
	$jobCompany3 = addslashes($jobCompany3);
	$jobDepartment3 = addslashes($jobDepartment3);
	$jobDegree3 = addslashes($jobDegree3);
	$jobWork3 = addslashes($jobWork3);
	$retirement3 = addslashes($retirement3);
	$memo1 = addslashes($memo1);
	$memo2 = addslashes($memo2);
	$memo3 = addslashes($memo3);
	$memo4 = addslashes($memo4);
	$memo5 = addslashes($memo5);
	$memo6 = addslashes($memo6);
	$memo7 = addslashes($memo7);
	$pass = addslashes($pass);
	$resume_num = addslashes($resume_num);

	$query = "	department = '$department',
				careerYN = '$careerYN',
				kor_name = '$kor_name',
				eng_name = '$eng_name',
				chi_name = '$chi_name',
				sex = '$sex',
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
				hPeriod1 = '$hPeriod1',
				hPeriod2 = '$hPeriod2',
				hSchool = '$hSchool',
				cPeriod1 = '$cPeriod1',
				cPeriod2 = '$cPeriod2',
				colleage = '$colleage',
				cMajor = '$cMajor',
				cEndYN = '$cEndYN',
				cDegree = '$cDegree',
				cScore = '$cScore',
				cTotal = '$cTotal',
				uPeriod1 = '$uPeriod1',
				uPeriod2 = '$uPeriod2',
				univ = '$univ',
				uMajor = '$uMajor',
				uDegree = '$uDegree',
				uScore = '$uScore',
				uTotal = '$uTotal',
				mPeriod1 = '$mPeriod1',
				mPeriod2 = '$mPeriod2',
				master = '$master',
				mMajor = '$mMajor',
				mDegree = '$mDegree',
				mScore = '$mScore',
				mTotal = '$mTotal',
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
				specialty1 = '$specialty1',
				specialty1_degree = '$specialty1_degree',
				specialty1_score = '$specialty1_score',
				specialty1_date = '$specialty1_date',
				specialty1_nm = '$specialty1_nm',
				specialty2 = '$specialty2',
				specialty2_degree = '$specialty2_degree',
				specialty2_score = '$specialty2_score',
				specialty2_date = '$specialty2_date',
				specialty2_nm = '$specialty2_nm',
				veteransYN = '$veteransYN',
				veterans_no	= '$veterans_no',
				army_type	= '$army_type',
				army_rank	= '$army_rank',
				army_start	= '$army_start',
				army_end	= '$army_end',
				army_service_month = '$army_service_month',
				disabled_no = '$disabled_no',
				disabled_type = '$disabled_type',
				disabled_degree = '$disabled_degree',
				low_incomeYN = '$low_incomeYN',
				basic_living = '$basic_living',
				one_parent = '$one_parent',
				jobStart1 = '$jobStart1',
				jobEnd1 = '$jobEnd1',
				jobYear1 = '$jobYear1',
				jobMonth1 = '$jobMonth1',
				jobCompany1 = '$jobCompany1',
				jobDepartment1 = '$jobDepartment1',
				jobDegree1 = '$jobDegree1',
				jobWork1 = '$jobWork1',
				retirement1 = '$retirement1',
				jobStart2 = '$jobStart2',
				jobEnd2 = '$jobEnd2',
				jobYear2 = '$jobYear2',
				jobMonth2 = '$jobMonth2',
				jobCompany2 = '$jobCompany2',
				jobDepartment2 = '$jobDepartment2',
				jobDegree2 = '$jobDegree2',
				jobWork2 = '$jobWork2',
				retirement2 = '$retirement2',
				jobStart3 = '$jobStart3',
				jobEnd3 = '$jobEnd3',
				jobYear3 = '$jobYear3',
				jobMonth3 = '$jobMonth3',
				jobCompany3 = '$jobCompany3',
				jobDepartment3 = '$jobDepartment3',
				jobDegree3 = '$jobDegree3',
				jobWork3 = '$jobWork3',
				retirement3 = '$retirement3',
				memo1 = '$memo1',
				memo2 = '$memo2',
				memo3 = '$memo3',
				memo4 = '$memo4',
				memo5 = '$memo5',
				memo6 = '$memo6',
				memo7 = '$memo7',
				password = '$pass',
				resume_num = '$resume_num'
	";


	if($j==""){
		$sql = "INSERT employment SET $query ,file_name='$file_name1', s_file_name='$s_file_name1',file_name2='$file_name2', s_file_name2='$s_file_name2'";
		$result = mysql_query($sql);
		if($result){

			echo "<script>alert('이력서가 정상적으로 접수되었습니다.');location.href='./'</script>";
		}else{
			echo "<script>alert('오류가 발생하였습니다.');history.back();</script>";
		}
	}else if($j=="u"){

		if($s_file_name1){
			$query .= " ,file_name='$file_name1', s_file_name='$s_file_name1' ";
		}
		if($s_file_name2){
			$query .= ",file_name2='$file_name2', s_file_name2='$s_file_name2'";
		}
		$query .= " WHERE wr_id='$wr_id'";
		$sql = "UPDATE employment SET apply_num='$apply_num', $query ";

		$result = mysql_query($sql);
		if($result){

			echo "<script>alert('이력서가 정상적으로 수정되었습니다.');location.href='./resume.php?j=u&wr_id=$wr_id&pass=$pass_check'</script>";
		}else{
			echo "<script>alert('오류가 발생하였습니다.');history.back();</script>";
		}
	}
?>
