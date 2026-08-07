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
        $allowed_ext = array('jpg','jpeg','png','gif','pdf','doc','docx','hwp');
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
            $file_name1 = "/recruit2/file_data/$id/".$reg_date."/".$temp1_name;
            @chmod($file_name1,0777);
            @chmod("./file_data/$id/".$reg_date,0777);
        } else {
            if(!move_uploaded_file($file1,"./file_data/$id/".$temp1_name)) Error("파일업로드가 제대로 되지 않았습니다");
            $file_name1 = "/recruit2/file_data/$id/".$temp1_name;
            @chmod($file_name1,0777);
        }
    }
}


if($apply_major == "간호학과"){
    $apply_num_1 = "간호";
}else{
    $apply_num_1 = str_replace("과","",$apply_major);
}

$apply_num_2 = "(2019)-01-";

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
$kor_name = trim($_POST["kor_name"]);
$phone = $phone1."-".$phone2."-".$phone3;

// 중복 지원 방지: 이름+전화번호+resume_num이 일치하는 지원서가 이미 있으면
// 새로 만들지 않고 그 지원서를 수정(UPDATE)하도록 전환한다.
// (private.php의 사전 중복확인을 못 거치고 곧장 들어온 경우를 위한 안전장치)
if ( $j == "" ) {
    $dup_check_sql = " select wr_id from recruit_copy_bi where kor_name = '".addslashes($kor_name)."' and phone = '".addslashes($phone)."' and resume_num = '".addslashes($resume_num)."' ";
    $dup_check_rs = mysql_query($dup_check_sql);
    if ( $dup_check_rs && mysql_num_rows($dup_check_rs) > 0 ) {
        $dup_row = mysql_fetch_assoc($dup_check_rs);
        $wr_id = $dup_row['wr_id'];
        $j = "u";
        $dup_redirect_to_list = true;
    }
}

$apply_count=mysql_num_rows(mysql_query("SELECT * FROM recruit_copy_bi WHERE resume_num='$resume_num'"));

if($apply_count < 10){
    $apply_count = $apply_count + 1;
    $apply_count = "0".$apply_count;
}else{
    $apply_count = $apply_count+1;
}

if($j==""){
    $apply_num = $apply_num_1.$apply_num_2.$apply_count;
}elseif($j=="u"){

    $resume_data = mysql_fetch_array(mysql_query("SELECT apply_num FROM recruit_bi1 WHERE wr_id='$wr_id'"));
    $apply_count_u = explode("-",$resume_data[apply_num]);

    $apply_num = $apply_num_1.$apply_num_2."-01-".$apply_count_u[3];

}

$birth = $bYear."-".$bMonth."-".$bDay;
if($hTel1 && $hTel2 && $hTel3){$hTel = $hTel1."-".$hTel2."-".$hTel3;}
if($jTel1 && $jTel2 && $jTel3){$jTel = $jTel1."-".$jTel2."-".$jTel3;}
//$zip = $zip1."-".$zip2;
$zip = $zonecode;
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
if($jobYear10 || $jobMonth10){$jobPeriod10 = $jobYear10."-".$jobMonth10;}

if($jpsYear11 && $jpsMonth11 && $jpsDate11){$jpsPeriod11 = $jpsYear11."-".$jpsMonth11."-".$jpsDate11;}
if($jpeYear11 && $jpeMonth11 && $jpeDate11){$jpePeriod11 = $jpeYear11."-".$jpeMonth11."-".$jpeDate11;}
if($jobYear11 || $jobMonth11){$jobPeriod11 = $jobYear11."-".$jobMonth11;}

if($jpsYear12 && $jpsMonth12 && $jpsDate12){$jpsPeriod12 = $jpsYear12."-".$jpsMonth12."-".$jpsDate12;}
if($jpeYear12 && $jpeMonth12 && $jpeDate12){$jpePeriod12 = $jpeYear12."-".$jpeMonth12."-".$jpeDate12;}
if($jobYear12 || $jobMonth12){$jobPeriod12 = $jobYear12."-".$jobMonth12;}

if($jpsYear13 && $jpsMonth13 && $jpsDate13){$jpsPeriod13 = $jpsYear13."-".$jpsMonth13."-".$jpsDate13;}
if($jpeYear13 && $jpeMonth13 && $jpeDate13){$jpePeriod13 = $jpeYear13."-".$jpeMonth13."-".$jpeDate13;}
if($jobYear13 || $jobMonth13){$jobPeriod13 = $jobYear13."-".$jobMonth13;}

if($jpsYear14 && $jpsMonth14 && $jpsDate14){$jpsPeriod14 = $jpsYear14."-".$jpsMonth14."-".$jpsDate14;}
if($jpeYear14 && $jpeMonth14 && $jpeDate14){$jpePeriod14 = $jpeYear14."-".$jpeMonth14."-".$jpeDate14;}
if($jobYear14 || $jobMonth14){$jobPeriod14 = $jobYear14."-".$jobMonth14;}

if($jpsYear15 && $jpsMonth15 && $jpsDate15){$jpsPeriod15 = $jpsYear15."-".$jpsMonth15."-".$jpsDate15;}
if($jpeYear15 && $jpeMonth15 && $jpeDate15){$jpePeriod15 = $jpeYear15."-".$jpeMonth15."-".$jpeDate15;}
if($jobYear15 || $jobMonth15){$jobPeriod15 = $jobYear15."-".$jobMonth15;}

//echo $jobPeriod2;
//echo $jobYear2."-".$jobMonth2;
//exit;
//echo $jobPeriod3;
//echo $jobYear3."-".$jobMonth3;
//exit;

	$apply_major = addslashes($apply_major);
	$major = addslashes($major);
	$damdang_class = addslashes($damdang_class);
	$gubun = addslashes($gubun);
	$kor_name = addslashes($kor_name);
	$eng_name = addslashes($eng_name);
	$chi_name = addslashes($chi_name);
	$sex = addslashes($sex);
	$country = addslashes($country);
	$married = addslashes($married);
	$army = addslashes($army);
	$birth = addslashes($birth);
	$age = addslashes($age);
	$hTel = addslashes($hTel);
	$jTel = addslashes($jTel);
	$phone = addslashes($phone);
	$email = addslashes($email);
	$zip = addslashes($zip);
	$addr1 = addslashes($addr1);
	$addr2 = addslashes($addr2);
	$company = addslashes($company);
	$hPeriod = addslashes($hPeriod);
	$hSchool = addslashes($hSchool);
	$cPeriod = addslashes($cPeriod);
	$colleage = addslashes($colleage);
	$cMajor = addslashes($cMajor);
	$cDegree = addslashes($cDegree);
	$cDegree_date = addslashes($cDegree_date);
	$cScore = addslashes($cScore);
	$cTotal = addslashes($cTotal);
	$cPeriod1 = addslashes($cPeriod1);
	$colleage1 = addslashes($colleage1);
	$cMajor1 = addslashes($cMajor1);
	$cDegree1 = addslashes($cDegree1);
	$cDegree_date1 = addslashes($cDegree_date1);
	$cScore1 = addslashes($cScore1);
	$cTotal1 = addslashes($cTotal1);
	$uPeriod = addslashes($uPeriod);
	$univ = addslashes($univ);
	$uMajor = addslashes($uMajor);
	$uDegree = addslashes($uDegree);
	$uDegree_date = addslashes($uDegree_date);
	$uScore = addslashes($uScore);
	$uTotal = addslashes($uTotal);
	$uPeriod1 = addslashes($uPeriod1);
	$univ1 = addslashes($univ1);
	$uMajor1 = addslashes($uMajor1);
	$uDegree1 = addslashes($uDegree1);
	$uDegree_date1 = addslashes($uDegree_date1);
	$uScore1 = addslashes($uScore1);
	$uTotal1 = addslashes($uTotal1);
	$mPeriod = addslashes($mPeriod);
	$master = addslashes($master);
	$mMajor = addslashes($mMajor);
	$mDegree = addslashes($mDegree);
	$mDegree_date = addslashes($mDegree_date);
	$mScore = addslashes($mScore);
	$mTotal = addslashes($mTotal);
	$mPeriod1 = addslashes($mPeriod1);
	$master1 = addslashes($master1);
	$mMajor1 = addslashes($mMajor1);
	$mDegree1 = addslashes($mDegree1);
	$mDegree_date1 = addslashes($mDegree_date1);
	$mScore1 = addslashes($mScore1);
	$mTotal1 = addslashes($mTotal1);
	$dPeriod = addslashes($dPeriod);
	$doctor = addslashes($doctor);
	$dMajor = addslashes($dMajor);
	$dDegree = addslashes($dDegree);
	$dDegree_date = addslashes($dDegree_date);
	$dScore = addslashes($dScore);
	$dTotal = addslashes($dTotal);
	$dPeriod1 = addslashes($dPeriod1);
	$doctor1 = addslashes($doctor1);
	$dMajor1 = addslashes($dMajor1);
	$dDegree1 = addslashes($dDegree1);
	$dDegree_date1 = addslashes($dDegree_date1);
	$dScore1 = addslashes($dScore1);
	$dTotal1 = addslashes($dTotal1);
	$jpsPeriod1 = addslashes($jpsPeriod1);
	$jpePeriod1 = addslashes($jpePeriod1);
	$jobPeriod1 = addslashes($jobPeriod1);
	$jobCompany1 = addslashes($jobCompany1);
	$jobDegree1 = addslashes($jobDegree1);
	$jpsPeriod2 = addslashes($jpsPeriod2);
	$jpePeriod2 = addslashes($jpePeriod2);
	$jobPeriod2 = addslashes($jobPeriod2);
	$jobCompany2 = addslashes($jobCompany2);
	$jobDegree2 = addslashes($jobDegree2);
	$jpsPeriod3 = addslashes($jpsPeriod3);
	$jpePeriod3 = addslashes($jpePeriod3);
	$jobPeriod3 = addslashes($jobPeriod3);
	$jobCompany3 = addslashes($jobCompany3);
	$jobDegree3 = addslashes($jobDegree3);
	$jpsPeriod4 = addslashes($jpsPeriod4);
	$jpePeriod4 = addslashes($jpePeriod4);
	$jobPeriod4 = addslashes($jobPeriod4);
	$jobCompany4 = addslashes($jobCompany4);
	$jobDegree4 = addslashes($jobDegree4);
	$jpsPeriod5 = addslashes($jpsPeriod5);
	$jpePeriod5 = addslashes($jpePeriod5);
	$jobPeriod5 = addslashes($jobPeriod5);
	$jobCompany5 = addslashes($jobCompany5);
	$jobDegree5 = addslashes($jobDegree5);
	$jpsPeriod6 = addslashes($jpsPeriod6);
	$jpePeriod6 = addslashes($jpePeriod6);
	$jobPeriod6 = addslashes($jobPeriod6);
	$jobCompany6 = addslashes($jobCompany6);
	$jobDegree6 = addslashes($jobDegree6);
	$jpsPeriod7 = addslashes($jpsPeriod7);
	$jpePeriod7 = addslashes($jpePeriod7);
	$jobPeriod7 = addslashes($jobPeriod7);
	$jobCompany7 = addslashes($jobCompany7);
	$jobDegree7 = addslashes($jobDegree7);
	$jpsPeriod8 = addslashes($jpsPeriod8);
	$jpePeriod8 = addslashes($jpePeriod8);
	$jobPeriod8 = addslashes($jobPeriod8);
	$jobCompany8 = addslashes($jobCompany8);
	$jobDegree8 = addslashes($jobDegree8);
	$jpsPeriod9 = addslashes($jpsPeriod9);
	$jpePeriod9 = addslashes($jpePeriod9);
	$jobPeriod9 = addslashes($jobPeriod9);
	$jobCompany9 = addslashes($jobCompany9);
	$jobDegree9 = addslashes($jobDegree9);
	$jpsPeriod10 = addslashes($jpsPeriod10);
	$jpePeriod10 = addslashes($jpePeriod10);
	$jobPeriod10 = addslashes($jobPeriod10);
	$jobCompany10 = addslashes($jobCompany10);
	$jobDegree10 = addslashes($jobDegree10);
	$jpsPeriod11 = addslashes($jpsPeriod11);
	$jpePeriod11 = addslashes($jpePeriod11);
	$jobPeriod11 = addslashes($jobPeriod11);
	$jobCompany11 = addslashes($jobCompany11);
	$jobDegree11 = addslashes($jobDegree11);
	$jpsPeriod12 = addslashes($jpsPeriod12);
	$jpePeriod12 = addslashes($jpePeriod12);
	$jobPeriod12 = addslashes($jobPeriod12);
	$jobCompany12 = addslashes($jobCompany12);
	$jobDegree12 = addslashes($jobDegree12);
	$jpsPeriod13 = addslashes($jpsPeriod13);
	$jpePeriod13 = addslashes($jpePeriod13);
	$jobPeriod13 = addslashes($jobPeriod13);
	$jobCompany13 = addslashes($jobCompany13);
	$jobDegree13 = addslashes($jobDegree13);
	$jpsPeriod14 = addslashes($jpsPeriod14);
	$jpePeriod14 = addslashes($jpePeriod14);
	$jobPeriod14 = addslashes($jobPeriod14);
	$jobCompany14 = addslashes($jobCompany14);
	$jobDegree14 = addslashes($jobDegree14);
	$jpsPeriod15 = addslashes($jpsPeriod15);
	$jpePeriod15 = addslashes($jpePeriod15);
	$jobPeriod15 = addslashes($jobPeriod15);
	$jobCompany15 = addslashes($jobCompany15);
	$jobDegree15 = addslashes($jobDegree15);
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
	$etc7 = addslashes($etc7);
	$etc7_date = addslashes($etc7_date);
	$etc7_company = addslashes($etc7_company);
	$etc8 = addslashes($etc8);
	$etc8_date = addslashes($etc8_date);
	$etc8_company = addslashes($etc8_company);
	$etc9 = addslashes($etc9);
	$etc9_date = addslashes($etc9_date);
	$etc9_company = addslashes($etc9_company);
	$etc10 = addslashes($etc10);
	$etc10_date = addslashes($etc10_date);
	$etc10_company = addslashes($etc10_company);
	$etc11 = addslashes($etc11);
	$etc11_date = addslashes($etc11_date);
	$etc11_company = addslashes($etc11_company);
	$etc12 = addslashes($etc12);
	$etc12_date = addslashes($etc12_date);
	$etc12_company = addslashes($etc12_company);
	$etc13 = addslashes($etc13);
	$etc13_date = addslashes($etc13_date);
	$etc13_company = addslashes($etc13_company);
	$etc14 = addslashes($etc14);
	$etc14_date = addslashes($etc14_date);
	$etc14_company = addslashes($etc14_company);
	$etc15 = addslashes($etc15);
	$etc15_date = addslashes($etc15_date);
	$etc15_company = addslashes($etc15_company);
	$resume_num = addslashes($resume_num);
	$bank_name = addslashes($bank_name);
	$bank_account = addslashes($bank_account);
	$company_auth = addslashes($company_auth);
	$profile = addslashes($profile);
	$sub_title = addslashes($sub_title);
	$thesis1_school = addslashes($thesis1_school);
	$thesis1_postgraduate = addslashes($thesis1_postgraduate);
	$thesis1_degree = addslashes($thesis1_degree);
	$thesis1_major = addslashes($thesis1_major);
	$thesis1_subject = addslashes($thesis1_subject);
	$thesis1_content = addslashes($thesis1_content);
	$thesis2_school = addslashes($thesis2_school);
	$thesis2_postgraduate = addslashes($thesis2_postgraduate);
	$thesis2_degree = addslashes($thesis2_degree);
	$thesis2_major = addslashes($thesis2_major);
	$thesis2_subject = addslashes($thesis2_subject);
	$thesis2_content = addslashes($thesis2_content);
	$study1_gubun = addslashes($study1_gubun);
	$study1_subject = addslashes($study1_subject);
	$study1_content = addslashes($study1_content);
	$study1_date = addslashes($study1_date);
	$study1_mem = addslashes($study1_mem);
	$study1_book = addslashes($study1_book);
	$study2_gubun = addslashes($study2_gubun);
	$study2_subject = addslashes($study2_subject);
	$study2_content = addslashes($study2_content);
	$study2_date = addslashes($study2_date);
	$study2_mem = addslashes($study2_mem);
	$study2_book = addslashes($study2_book);
	$study3_gubun = addslashes($study3_gubun);
	$study3_subject = addslashes($study3_subject);
	$study3_content = addslashes($study3_content);
	$study3_date = addslashes($study3_date);
	$study3_mem = addslashes($study3_mem);
	$study3_book = addslashes($study3_book);
	$study4_gubun = addslashes($study4_gubun);
	$study4_subject = addslashes($study4_subject);
	$study4_content = addslashes($study4_content);
	$study4_date = addslashes($study4_date);
	$study4_mem = addslashes($study4_mem);
	$study4_book = addslashes($study4_book);
	$study5_gubun = addslashes($study5_gubun);
	$study5_subject = addslashes($study5_subject);
	$study5_content = addslashes($study5_content);
	$study5_date = addslashes($study5_date);
	$study5_mem = addslashes($study5_mem);
	$study6_book = addslashes($study6_book);
	$study6_gubun = addslashes($study6_gubun);
	$study6_subject = addslashes($study6_subject);
	$study6_content = addslashes($study6_content);
	$study6_date = addslashes($study6_date);
	$study6_mem = addslashes($study6_mem);
	$study7_gubun = addslashes($study7_gubun);
	$study7_subject = addslashes($study7_subject);
	$study7_content = addslashes($study7_content);
	$study7_date = addslashes($study7_date);
	$study7_mem = addslashes($study7_mem);
	$study7_book = addslashes($study7_book);
	$study8_gubun = addslashes($study8_gubun);
	$study8_subject = addslashes($study8_subject);
	$study8_content = addslashes($study8_content);
	$study8_date = addslashes($study8_date);
	$study8_mem = addslashes($study8_mem);
	$study8_book = addslashes($study8_book);
	$pass = addslashes($pass);

$query1 = "	apply_major = '$apply_major',
							major = '$major',
							damdang_class = '$damdang_class',
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
							,bank_name = '$bank_name'
							,bank_account = '$bank_account'
							,company_auth = '$company_auth'
	";
$query2 = "profile = '$profile',
							resume_num = '$resume_num',
							sub_title= '$sub_title',
							thesis1_school = '$thesis1_school',
							thesis1_postgraduate = '$thesis1_postgraduate',
							thesis1_degree = '$thesis1_degree',
							thesis1_major = '$thesis1_major',
							thesis1_subject = '$thesis1_subject',
							thesis1_content = '$thesis1_content',
							thesis2_school = '$thesis2_school',
							thesis2_postgraduate = '$thesis2_postgraduate',
							thesis2_degree = '$thesis2_degree',
							thesis2_major = '$thesis2_major',
							thesis2_subject = '$thesis2_subject',
							thesis2_content = '$thesis2_content',
							study1_gubun = '$study1_gubun',
							study1_subject = '$study1_subject',
							study1_content = '$study1_content',
							study1_date = '$study1_date',
							study1_mem = '$study1_mem',
							study1_book = '$study1_book',
							study2_gubun = '$study2_gubun',
							study2_subject = '$study2_subject',
							study2_content = '$study2_content',
							study2_date = '$study2_date',
							study2_mem = '$study2_mem',
							study2_book = '$study2_book',
							study3_gubun = '$study3_gubun',
							study3_subject = '$study3_subject',
							study3_content = '$study3_content',
							study3_date = '$study3_date',
							study3_mem = '$study3_mem',
							study3_book = '$study3_book',
							study4_gubun = '$study4_gubun',
							study4_subject = '$study4_subject',
							study4_content = '$study4_content',
							study4_date = '$study4_date',
							study4_mem = '$study4_mem',
							study4_book = '$study4_book',
							study5_gubun = '$study5_gubun',
							study5_subject = '$study5_subject',
							study5_content = '$study5_content',
							study5_date = '$study5_date',
							study5_mem = '$study5_mem',
							study5_book = '$study6_book',
							study6_gubun = '$study6_gubun',
							study6_subject = '$study6_subject',
							study6_content = '$study6_content',
							study6_date = '$study6_date',
							study6_mem = '$study6_mem',
							study6_book = '$study6_book',
							study7_gubun = '$study7_gubun',
							study7_subject = '$study7_subject',
							study7_content = '$study7_content',
							study7_date = '$study7_date',
							study7_mem = '$study7_mem',
							study7_book = '$study7_book',
							study8_gubun = '$study8_gubun',
							study8_subject = '$study8_subject',
							study8_content = '$study8_content',
							study8_date = '$study8_date',
							study8_mem = '$study8_mem',
							study8_book = '$study8_book',
							password = '$pass'";
if($j==""){
    $sql = "INSERT recruit_copy_bi SET apply_num='$apply_num',$query1 ,file_name='$file_name1', s_file_name='$s_file_name1'";
    $result = mysql_query($sql);
    $wr_ins_id = mysql_insert_id();
    $sql1 = "INSERT recruit_bi1 SET parent = '$wr_ins_id',wr_datetime=now(),type_gubun='$type_gubun',$query2";
    $result1 = mysql_query($sql1);
    if(!$result1) error_log("recruit2/proc.php INSERT recruit_bi1 실패 (wr_id=$wr_ins_id): ".mysql_error());
    if($result && $result1){
        echo "<script>alert('이력서가 정상적으로 접수되었습니다');location.href='./'</script>";
    }else{
        echo "<script>alert('이력서 접수 중 초빙분야·자기소개서·학위논문·연구실적·비밀번호 저장에 실패했습니다. 접수번호 $wr_ins_id 를 채용 담당자에게 알려주세요.');history.back();</script>";
    }
}else if($j=="u"){

    if($s_file_name1){
        $query1 .= " ,file_name='$file_name1', s_file_name='$s_file_name1' ";
    }
    $query1 .= " WHERE wr_id='$wr_id'";
    $sql = "UPDATE recruit_copy_bi SET apply_num='$apply_num', $query1 ";

    $result = mysql_query($sql);
    $sql1 = "UPDATE recruit_bi1 SET type_gubun='$type_gubun',$query2 WHERE parent='$wr_id'";
    $result1 = mysql_query($sql1);
    if(!$result1) error_log("recruit2/proc.php UPDATE recruit_bi1 실패 (wr_id=$wr_id): ".mysql_error());
    if($result && $result1){
        // 신규 지원 시도였다가 중복 감지로 수정 처리된 경우, pass_check 값이 없으므로
        // 비밀번호 확인이 필요한 수정화면 대신 목록으로 보낸다.
        if ( isset($dup_redirect_to_list) && $dup_redirect_to_list ) {
            echo "<script>alert('이미 접수된 지원서가 있어 기존 지원서를 수정 처리했습니다.');location.href='./'</script>";
        } else {
            echo "<script>alert('이력서가 정상적으로 수정되었습니다');location.href='./resume.php?j=u&wr_id=$wr_id&pass=$pass_check'</script>";
        }
    }else{
        echo "<script>alert('오류가 발생하였습니다');history.back();</script>";
    }
}
?>
