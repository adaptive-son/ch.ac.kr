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
				$file_name1 = "/recruit4/file_data/$id/".$reg_date."/".$temp1_name;
				@chmod($file_name1,0706);
				@chmod("./file_data/$id/".$reg_date,0707);
			} else {
				if(!move_uploaded_file($file1,"./file_data/$id/".$temp1_name)) Error("파일업로드가 제대로 되지 않았습니다");
				$file_name1 = "/recruit4/file_data/$id/".$temp1_name;
				@chmod($file_name1,0706);
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
			$temp2_name = $reg_date.'.'.$temp2[1];

			$file2 = eregi_replace("\\\\","\\",$file2);
			$s_file_name2 = str_replace(" ","_",$s_file_name2);
			$s_file_name2 = str_replace("-","_",$s_file_name2);

			// 디렉토리를 검사함
			if(!is_dir("./file_data/".$id)) {
				@mkdir("./file_data/".$id,0777);
				@chmod("./file_data/".$id,0706);
			}

			// 중복파일이 있을때;;
			if(file_exists("./file_data/$id/".$temp2_name)) {
				@mkdir("./file_data/$id/".$reg_date,0777);
				if(!move_uploaded_file($file2,"./file_data/$id/".$reg_date."/".$temp2_name)) Error("파일업로드가 제대로 되지 않았습니다1");
				$file_name2 = "/recruit4/file_data/$id/".$reg_date."/".$temp2_name;
				@chmod($file_name2,0707);
				@chmod("./file_data/$id/".$reg_date,0707);
			} else {
				//echo $temp2_name;exit;
				if(!move_uploaded_file($file2,"./file_data/$id/".$temp2_name)) Error("파일업로드가 제대로 되지 않았습니다2");
				$file_name2 = "/recruit4/file_data/$id/".$temp2_name;
				@chmod($file_name2,0707);
			}
		}
	}

	$memo1 = addslashes($memo1);
	$memo2 = addslashes($memo2);
	$memo3 = addslashes($memo3);
	$memo4 = addslashes($memo4);
	$memo5 = addslashes($memo5);
	$memo6 = addslashes($memo6);
	$memo7 = addslashes($memo7);

	$kor_name = trim($_POST["kor_name"]);

	if($hTel1 && $hTel2 && $hTel3){$hTel = $hTel1."-".$hTel2."-".$hTel3;}
	if($jTel1 && $jTel2 && $jTel3){$jTel = $jTel1."-".$jTel2."-".$jTel3;}
	$phone = $phone1."-".$phone2."-".$phone3;
	$zip = $zip1."-".$zip2;

	$query = "	department = '$department',
				careerYN = '$major',
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
				one_parent = '$oneparent',
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
				jobStart3 = '$jobStart2',
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
