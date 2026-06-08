<?

include_once ("_common.php");

//error_reporting( E_ALL );
//ini_set( "display_errors", 1 );



$tree_id =$_REQUEST['site_id'];
$param_Menu = "site_id=".$tree_id."&TREE_NO=".$TREE_NO."&DEPTH=".$DEPTH;


if($_REQUEST['CHILD']){
	$param_Menu .= "&CHILD=".$_REQUEST['CHILD'];
}
//exit;

//print_r($_POST);
//echo "up_file_del : <br/>";echo $_POST["up_file_del"];
//echo "<br/><br/><br/>";

//echo "post escape up_file : <br/>";
//print_r(array_map('mysql_escape_string', $_POST["up_file_del"]));
//echo "<br/><br/><br/>";

//echo "up_file_del escape: <br/>";print_r(mysql_escape_string($_POST["up_file_del"]));
//echo "<br/><br/><br/>";

//$_delParam = array_map('mysql_escape_string', $_POST["up_file_del"]);
$_delParam = $_POST["up_file_del"];

//$_POST = array_map('mysql_escape_string', $_POST);
//$_GET = array_map('mysql_escape_string', $_GET);

//include $_SERVER["DOCUMENT_ROOT"]."/config/config.php";
//include $_SERVER["DOCUMENT_ROOT"]."/config/dbconn.php";
//include $_SERVER["DOCUMENT_ROOT"]."/config/function.php";

$dataArr=Decode64($_POST['data']);
$configBBS = DBarray("SELECT * FROM abbs_manager WHERE board_key='".$dataArr[Boardkey]."'"); //게시판 설정로드

if(empty($configBBS[idx]))	go_back("존재하지 않는 게시판입니다.");

//권한매핑 설정
include $_SERVER["DOCUMENT_ROOT"]."/adframe/mng/bbs_manager/auth_config.php";

//echo $_SESSION['_BBS_SecAdmin'];

//글쓰기 권한제어
if($_SESSION['_BBS_SecAdmin'] != 1 && $configBBS[auth_write_use] == "Y" && $configBBS[auth_write] && @strpos(",".$configBBS[auth_write], $bbs_authgroup) == false){
	go_back("글쓰기 권한이 없습니다.");
	exit;
}


//이노릭스 멀티업로더 시 HTTP_REFERER값 없음
if($configBBS[module_uploader] != "InnoAP.php"){
	if(strpos($_SERVER['HTTP_REFERER'], $_SERVER['HTTP_HOST']) == false)  exit;
}

/*------------------------게시판 글 수정 ---------------------------------*/
if($Confirm=="define" && $_SESSION["_BBS_WRITE_CONN"] == $dataArr[idx]){

//	@session_unregister("_BBS_PASS_LOGIN") or die("session_unregister err");
//	@session_unregister("_BBS_WRITE_CONN") or die("session_unregister err");
//	@session_unregister("_BBS_SecAdmin") or die("session_unregister err");

	// 2016-08-08 비로그인 글수정시 오류.
	//unset($_SESSION['_BBS_PASS_LOGIN']);
	//unset($_SESSION['_BBS_WRITE_CONN']);
	//unset($_SESSION['_BBS_SecAdmin']);

	$view_row = DBarray("SELECT * FROM ".$dataArr[DBTable]." WHERE idx=$dataArr[idx]"); //게시판 정보

	$__bbs_userkey = $_SESSION['u_id'];
	$__bbs_adminkey = $_SESSION['s_id'];


/*
	if($Html_Code)		$content = $Html_Code;
	elseif($Edit_Area)	$content = $Edit_Area;
	elseif($bHtml==1) {
		$content = str_replace("\n","", $content);
		$content = str_replace("
","", $content);
	}
	else			$content = $content;
*/
	// fm_notice is null => 'N'
	if(!$fm_notice){
		$fm_notice = "N";
	}

	//업로드 모듈 로딩
	$upfileidx = $view_row[up_file_idx]; //파일IDX
	if($configBBS[module_uploader] && file_exists("Extention/Uploader/".$configBBS[module_uploader]) ){
		include "Extention/Uploader/".$configBBS[module_uploader];
	}


	//에디터 모듈
	if($configBBS[module_editor] && file_exists("Extention/Editor/".$configBBS[module_editor]) ){
		include "Extention/Editor/".$configBBS[module_editor];
	}


    if(!$view_secret){
        $view_secret = "N";
    }

	$set_sql = setQuery ($_POST, "fm_");
	$set_sql .= ", userIp='$REMOTE_ADDR', userid='$bbs_userid', adminid='$bbs_adminid', notice='$fm_notice', view_secret='$view_secret',pwd='".md5($_POST[fm_pwd])."' ";
	if($filei > 0) $set_sql .= ", up_file= up_file+".$filei;


	$qry = "update ".$dataArr[DBTable]." set ".$set_sql." where idx='".$dataArr[idx]."'";


    $_SESSION["_BBS_PASS_LOGIN"] =  md5($_POST[fm_pwd]);
	if(DBquery($qry)){

		//이미지 업로드가 완료되었다면 디비처리
		for($i=0; $i < $filei; $i++){
			//echo $img_sql[$i];
			DBquery("insert into ".$dataArr[DBTable]."_file set ".$img_sql[$i]);
		}
		
//		@session_unregister("_BBS_PASS_LOGIN") or die("session_unregister err");
//		@session_unregister("_BBS_WRITE_CONN") or die("session_unregister err");
//		@session_unregister("_BBS_SecAdmin") or die("session_unregister err");


		// 2016-08-08 비로그인 글수정시 오류.
		//unset($_SESSION['_BBS_PASS_LOGIN']);
		//unset($_SESSION['_BBS_WRITE_CONN']);
		//unset($_SESSION['_BBS_SecAdmin']);

		if($configBBS[module_uploader] != "InnoAP.php"){
			OnlyMsgView("수정을 완료 하였습니다.");
			ReFresh_parent("$BURL?".$param_Menu."&bbs=see&data=$data");
		}else{

			echo "
				<script language='Javascript'>
					alert('수정을 완료 하였습니다.');
					location.replace('$BURL?$param_Menu&bbs=see&data=$data');
				</script>
			";
		}

	}
	else{
		//echo "$qry";

		if($configBBS[module_uploader] != "InnoAP.php"){
			OnlyMsgView("수정시 오류가 발생 하였습니다.!!");
			ReFresh_parent("$BURL?$param_Menu&data=$data");
		}else{
			echo "
				alert('수정시 오류가 발생 하였습니다.');
				location.replace('$BURL?$param_Menu&data=$data');
			";
		}
	}
 }

?>
