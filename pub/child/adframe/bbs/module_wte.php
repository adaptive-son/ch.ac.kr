<?
@session_start();
$_POST = array_map('mysql_escape_string', $_POST);
$_GET = array_map('mysql_escape_string', $_GET);
ini_set('max_input_vars', '1000000000000');

include_once ("_common.php");
// 메일 관련 함수 추가 ( 2017-03-03. By.Son )
include_once ("../lib/lib.mail.function.php");

$dataArr=Decode64($_POST['data']);
$configBBS = DBarray("SELECT * FROM abbs_manager WHERE board_key='".$dataArr[Boardkey]."'"); //게시판 설정로드
if(empty($configBBS[idx]))	go_back("존재하지 않는 게시판입니다.");

//권한매핑 설정
include $_SERVER["DOCUMENT_ROOT"]."/adframe/mng/bbs_manager/auth_config.php";

//if($_POST['Confirm']=="define" && $_SESSION["_BBS_WRITE_CONN"]){
if($_POST['Confirm']=="define"){

    //구글 캡챠 검증
    /*
    $captcha = $_POST['g-recaptcha'];
    $secretKey = '6Lf87cMZAAAAABKzLSf84gCfVgi_XJu35GmVR-MO'; // 위에서 발급 받은 "비밀 키"를 넣어줍니다.
    $ip = $_SERVER['REMOTE_ADDR']; // 옵션값으로 안 넣어도 됩니다.

    $data = array(
        'secret' => $secretKey,
        'response' => $captcha,
        'remoteip' => $ip  // ip를 안 넣을거면 여기서도 빼줘야죠
    );

    $url = "https://www.google.com/recaptcha/api/siteverify";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    $response = curl_exec($ch);
    curl_close($ch);

    $responseKeys = json_decode($response, true);
    if ($responseKeys["success"]) {
        // 스팸 검사가 통과 했을 때의 처리
    } else {
        // 스팸 검사가 실패 했을 때의 처리
        //go_back("비정상적인 접근입니다.");
        //exit;
    }*/


    $agent = $_SERVER['HTTP_USER_AGENT'];
    if( strpos($agent,'bot') === false && strpos($agent,'Google') === false && strpos($agent,'Yeti') === false && strpos($agent,'NAVER')){
        go_back("비정상적인 접근입니다.");
        exit;
    }


	//답글 권한제어
	if($dataArr[idx]) {
		if($_SESSION['_BBS_SecAdmin'] != 1 && $configBBS[auth_reply_use] == "Y" && $configBBS[auth_reply] && @strpos(",".$configBBS[auth_reply], $bbs_authgroup) == false){
			go_back("답글쓰기 권한이 없습니다.");
			exit;
		}

	//글쓰기 권한제어
	}else{
		//alert("n");
		//alert($_SESSION['_BBS_SecAdmin']);
		if($_SESSION['_BBS_SecAdmin'] != 1 && $configBBS[auth_write_use] == "Y" && $configBBS[auth_write] && @strpos(",".$configBBS[auth_write], $bbs_authgroup) == false){
			//alert("n");
			go_back("글쓰기 권한이 없습니다.");
			exit;
		}
	}

	//이노릭스 멀티업로더 시 HTTP_REFERER값 없음
	if($configBBS[module_uploader] != "InnoAP.php"){
		if(strpos($_SERVER['HTTP_REFERER'], $_SERVER['HTTP_HOST']) == false)  exit;
	}

	unset($_SESSION['_BBS_WRITE_CONN']);
	unset($_SESSION['_BBS_SecAdmin']);

    //변수설정  :ref,re_level,re_step,content
	if($dataArr[idx]) { //답변
		$qry="SELECT MAX(idx) as maxcnt, name, title, content, userid FROM ".$dataArr[DBTable]." WHERE idx=$dataArr[idx]";
		$result=DBquery($qry);
		$row=@mysql_fetch_array($result);
		$up_sql="UPDATE ".$dataArr[DBTable]." SET re_step=re_step+1 WHERE ref=$ref AND re_step > $re_step";
		$up_result=DBquery($up_sql);
		$re_step++;
		$re_level++;
		$bbs_userid = $row[userid];
	}else{
		$qry_result=DBquery("SELECT MAX(idx) as maxcnt FROM ".$dataArr[DBTable]."");
		$row=mysql_fetch_array($qry_result);
		$ref=$row[0]+1;
		$re_step=0;
		$re_level=0;
	}

	//업로드 모듈 로딩
	$upfileidx = time(); //파일IDX
	if($configBBS[module_uploader] && file_exists("Extention/Uploader/".$configBBS[module_uploader]) ){
		include "Extention/Uploader/".$configBBS[module_uploader];
	}
	if($configBBS[module_editor] && file_exists("Extention/Editor/".$configBBS[module_editor]) ){
		include "Extention/Editor/".$configBBS[module_editor];
	}

	//cat 존재할때
	if($_POST[fm_cat3]){
		$set_sql = "name = '$_POST[fm_name]',  cat1 ='$_POST[fm_cat1]', cat2 ='$_POST[fm_cat2]', cat3='$_POST[fm_cat3]', title='$_POST[fm_title]',pwd='".md5($_POST[fm_pwd])."',content='$_POST[fm_content]'";
	}
	//cat 없을때
	else {
		$set_sql = "name = '$_POST[fm_name]',  title='$_POST[fm_title]',pwd='".md5($_POST[fm_pwd])."',content='$_POST[fm_content]'";
	}


	if($_POST[fm_ucc_code]){
		$set_sql .=", ucc_code = '$_POST[fm_ucc_code]'";
	}
	if($_POST[fm_category]){
		$set_sql .=", category = '$_POST[fm_category]'";
	}
	if(!$fm_notice){
		$fm_notice = "N";
        $fm_notice_start ="";
        $fm_notice_end ="";
	} else {
		if($fm_notice_end) {
			$fm_notice_end = $fm_notice_end . " 23:59:59";
		}
	}
	if(!$view_secret){
		$view_secret = "N";
	}

	$set_sql .= ", code='$dataArr[Boardkey]', ref='$ref', re_step='$re_step', re_level='$re_level', up_file_idx='$upfileidx', up_file='$filei', notice='$fm_notice', view_secret='$view_secret' , notice_start='$fm_notice_start', notice_end='$fm_notice_end' ";
	$set_sql .= ", userIp='$_SERVER[REMOTE_ADDR]', userid='$bbs_userid', adminid='$bbs_adminid', writeday=now() ";

	if($_POST['fm_sub_no']=="" || $_POST['fm_sub_no']==null )
		$set_sql .= "";
	else
		$set_sql .= ", sub_no='".$dataArr[Sub_No]."'";

	// 기타 입력사항이 존재할 경우 (20170822.By.Son)
    if ( $_POST[fm_etc1] && $_POST[fm_etc1] != "" ) $set_sql .= ", etc1 = '".addslashes($_POST[fm_etc1])."'";
    if ( $_POST[fm_etc2] && $_POST[fm_etc2] != "" ) $set_sql .= ", etc2 = '".addslashes($_POST[fm_etc2])."'";
    if ( $_POST[fm_etc3] && $_POST[fm_etc3] != "" ) $set_sql .= ", etc3 = '".addslashes($_POST[fm_etc3])."'";
    if ( $_POST[fm_etc4] && $_POST[fm_etc4] != "" ) $set_sql .= ", etc4 = '".addslashes($_POST[fm_etc4])."'";
    if ( $_POST[fm_etc5] && $_POST[fm_etc5] != "" ) $set_sql .= ", etc5 = '".addslashes($_POST[fm_etc5])."'";



    // 기타 입력사항이 존재할 경우 (20190819.By.Hwang)
    if ( $_POST[fm_etc_char1] && $_POST[fm_etc_char1] != "" ) $set_sql .= ", etc_char1 = '".addslashes($_POST[fm_etc_char1])."'";
    if ( $_POST[fm_etc_char2] && $_POST[fm_etc_char2] != "" ) $set_sql .= ", etc_char2 = '".addslashes($_POST[fm_etc_char2])."'";
    if ( $_POST[fm_etc_char3] && $_POST[fm_etc_char3] != "" ) $set_sql .= ", etc_char3 = '".addslashes($_POST[fm_etc_char3])."'";
	if ( $_POST[fm_etc_char4] && $_POST[fm_etc_char4] != "" ) $set_sql .= ", etc_char4 = '".addslashes($_POST[fm_etc_char4])."'";
    if ( $_POST[fm_etc_char5] && $_POST[fm_etc_char5] != "" ) $set_sql .= ", etc_char5 = '".addslashes($_POST[fm_etc_char5])."'";
    if ( $_POST[fm_etc_char6] && $_POST[fm_etc_char6] != "" ) $set_sql .= ", etc_char6 = '".addslashes($_POST[fm_etc_char6])."'";
	if ( $_POST[fm_etc_char7] && $_POST[fm_etc_char7] != "" ) $set_sql .= ", etc_char7 = '".addslashes($_POST[fm_etc_char7])."'";
    if ( $_POST[fm_etc_text1] && $_POST[fm_etc_text1] != "" ) $set_sql .= ", etc_text1 = '".addslashes($_POST[fm_etc_text1])."'";
    if ( $_POST[fm_etc_text2] && $_POST[fm_etc_text2] != "" ) $set_sql .= ", etc_text2 = '".addslashes($_POST[fm_etc_text2])."'";


	$qry = "insert into ".$dataArr[DBTable]." set ".$set_sql;

	if(DBquery($qry)){

	    // 1:1 문의 게시판인 경우에만, 메일링 발송
        /*
	    if ( $dataArr[DBTable] == "bbs_ask" && $dataArr[BoardKey] == "1310" ) {
            sendMailSimple($_POST[fm_title], $_POST[fm_content], $_POST[toEmail]);
        }*/

		unset($_SESSION['_BBS_WRITE_CONN']);
		unset($_SESSION['_BBS_SecAdmin']);

		//이미지 업로드가 완료되었다면 디비처리
		for($i=0; $i < $filei; $i++){
			DBquery("insert into ".$dataArr[DBTable]."_file set ".$img_sql[$i]);
		}

		$site_id =$_REQUEST['site_id'];

		if($dataArr[idx])	$URL_GO = $BURL."?site_id=".$site_id."&TREE_NO=".$TREE_NO."&DEPTH=".$DEPTH.$param_MENU;
		else				$URL_GO = $BURL."?site_id=".$site_id."&TREE_NO=".$TREE_NO."&DEPTH=".$DEPTH.$param_MENU."&data=".$data;

		//if ($_SERVER['REMOTE_ADDR']=="112.217.216.250") {print_r($qry); exit;}
		//멀티업로더 콜백처리
		if($configBBS[module_uploader] != "InnoAP.php"){
			ReFresh_parent($URL_GO);
		}else{
			echo "
				<script>
					location.replace('".$URL_GO."');
				</script>
			";
		}

	}

	else{

		//멀티업로더 콜백처리
		if($configBBS[module_uploader] != "InnoAP.php"){
			ReFresh_parent("$BURL?$param_MENU&data=$data");
		}else{
			echo "
				<script>
					alert('등록시 오류가 발생 하였습니다.');
					location.replace('$BURL?$param_MENU&data=$data');
				</script>
			";
		}
	}

	// print_r($qry);
	exit;



/*------------------------게시판 코멘트 등록 ---------------------------------*/
}else if($_POST['Confirm']=="Comment" && $_SESSION["_BBS_DELETE_CONN"]){

	if(strpos($_SERVER['HTTP_REFERER'], $_SERVER['HTTP_HOST']) == false)  exit;

	//코멘트 권한제어
	if($_SESSION['_BBS_SecAdmin'] != 1 && $configBBS[auth_comment_use] == "Y" && $configBBS[auth_comment] && @strpos(",".$configBBS[auth_comment], $bbs_authgroup) == false){
		go_back("답글쓰기 권한이 없습니다.");
		exit;
	}

	$bbs_idx = $_SESSION["_BBS_DELETE_CONN"];

	unset($_SESSION['_BBS_DELETE_CONN']);
	unset($_SESSION['_BBS_SecAdmin']);

	$set_sql = setQuery ($_POST, "fm_");

	$set_sql .= ", bbs_idx='".$bbs_idx."' ";
	$set_sql .= ", userIp='$_SERVER[REMOTE_ADDR]', userid='$bbs_userid', adminid='$bbs_adminid', writeday=now() ";
	$set_sql .= ", view_secret='N' ";

	$qry = "insert into ".$dataArr[DBTable]."_comment set ".$set_sql;
    $tree_id =$_REQUEST['site_id'];
	if(DBquery($qry)){
		ReFresh_parent($BURL."?site_id=".$tree_id."&TREE_NO=".$TREE_NO."&DEPTH=".$DEPTH.$param_MENU."&bbs=see&data=".$data);
	}else{
		ReFresh_parent($BURL."?site_id=".$tree_id."&TREE_NO=".$TREE_NO."&DEPTH=".$DEPTH.$param_MENU."&bbs=see&data=".$data);
	}

}else{
	ReFresh_parent($BURL."?site_id=".$tree_id."&TREE_NO=".$TREE_NO."&DEPTH=".$DEPTH.$param_MENU);
}

?>
