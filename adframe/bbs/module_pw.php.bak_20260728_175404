<?php

session_start();
include_once("_common.php");

$_POST = array_map('mysql_real_escape_string', $_POST);
$_GET = array_map('mysql_real_escape_string', $_GET);

$TREE_ID =$site_id;

if(strpos($_SERVER['HTTP_REFERER'], $_SERVER['HTTP_HOST']) == false) {
    exit;
}

/*----exit--------------------게시판 비밀번호 체크 ---------------------------------*/

$dataArr=Decode64($_REQUEST['data']);

$BBS_PWD=$_POST['pwd'];
if($chk != "ok") {
    $BBS_PWD=md5($_POST['pwd']);
}

$configBBS = DBarray("SELECT * FROM abbs_manager WHERE board_key='".$dataArr[Boardkey]."'"); //게시판 설정로드
if(empty($configBBS[idx])) {
    go_back("존재하지 않는 게시판입니다.");
}

//권한매핑 설정
include $_SERVER["DOCUMENT_ROOT"]."/adframe/mng/bbs_manager/auth_config.php";

$bbs_row = DBarray("SELECT * FROM ".$dataArr[DBTable]." WHERE idx=$dataArr[idx]");

if($BBS_PWD!=$bbs_row[pwd]) {
    OnlyMsgView("비밀번호가 올바르지 않습니다.");
    if($_GET['secret'] == "ok") {
        //ReFresh_parent("$BURL?bbs=list&data=$data");
        ReFresh_parent("$BURL?site_id=$_POST[site_id]&TREE_NO=$_POST[TREE_NO]&DEPTH=$_POST[DEPTH]");
    } else {
        ReFresh_parent("$BURL?site_id=$_POST[site_id]&TREE_NO=$_POST[TREE_NO]&DEPTH=$_POST[DEPTH]&bbs=see&data=$data");
    }

    exit;
} else {

    if(strtolower($_GET['del']) == "ok" && $_SESSION["_BBS_DELETE_CONN"] == $dataArr[idx]) {

        //			@session_unregister("_BBS_DELETE_CONN") or die("session_unregister err");
        unset($_SESSION["_BBS_DELETE_CONN"]);

        $go_url_ok = "$BURL?site_id=".$site_id."&TREE_NO=$TREE_NO&DEPTH=$DEPTH";
        $go_url_fali = "$BURL?site_id=".$site_id."&TREE_NO=$TREE_NO&DEPTH=$DEPTH";

        if($_REQUEST[CHILD]) {
            $go_url_ok .= "&CHILD=$_REQUEST[CHILD]";
            $go_url_fail .= "&CHILD=$_REQUEST[CHILD]";
        }

        /*if($mobile_detect == 1){
            $go_url_ok .= "&app=app";
            $go_url_fail .= "&app=app";
        }*/

        $go_url_ok .= "&bbs=list&data=$data";
        $go_url_fail .= "&data=$data";

        if(DBquery("UPDATE  ".$dataArr[DBTable]." SET del_yn='Y' WHERE idx=$dataArr[idx]")) {

            $file_result = DBquery("SELECT * FROM ".$configBBS[board_id]."_file WHERE up_file_idx='".$bbs_row[up_file_idx]."'");
            while($file_row=mysql_fetch_array($file_result)) {

                $sdata_dirpath = str_replace("upfile_data/", "upfile_data_thumnail/", $file_row[up_filepath]); //썸네일 디렉토리

                if(file_exists($file_row[up_filepath])) {
                    unlink($file_row[up_filepath]);
                } //파일삭제
                if(file_exists($sdata_dirpath)) {
                    unlink($sdata_dirpath);
                } //파일삭제

                DBquery("DELETE FROM ".$configBBS[board_id]."_file WHERE idx=$file_row[idx]");
            }

            OnlyMsgView("삭제를 완료하였습니다.");

            //변경사항에 대한 로그 남기기
            $qry = "insert into bbs_log SET bo_table='".$configBBS['board_id']."', bo_code='".$dataArr[Boardkey]."', status='del', up_id='".$_SESSION['MEMBER_ID']."',up_date=now(),bbs_idx='".$dataArr['idx']."'";
            DBquery($qry);
            ReFresh_parent($go_url_ok);
        } else {

            //echo"delete Err. ";
            OnlyMsgView("삭제시 오류가 발생 하였습니다.");
            ReFresh_parent($go_url_fail);

        }
    } elseif($_GET['edit'] == "ok") {

        @session_register("_BBS_PASS_LOGIN") or die("session_register err");
        $_BBS_PASS_LOGIN = $_SESSION["_BBS_PASS_LOGIN"] = $BBS_PWD;

        $go_url = "$BURL?site_id=".$site_id."&TREE_NO=$TREE_NO&DEPTH=$DEPTH";

        if($_REQUEST[CHILD]) {
            $go_url .= "&CHILD=$_REQUEST[CHILD]";
        }

        /*if($mobile_detect == 1){
            $go_url .= "&app=app";
        }*/

        $go_url .= "&bbs=repair&data=$data";

        ReFresh_parent($go_url);
    } elseif($_GET['secret'] == "ok") {
        //OnlyMsgView("암호가 일치합니다.");
        //echo "$BURL?TREE_NO=$TREE_NO&DEPTH=$DEPTH&bbs=see&data=$data";
        $_BBS_PASS_LOGIN = $_SESSION["_BBS_PASS_LOGIN"] = $BBS_PWD;
        $go_url = "$BURL?site_id=".$site_id."&TREE_NO=$TREE_NO&DEPTH=$DEPTH";

        if($_REQUEST[CHILD]) {
            $go_url .= "&CHILD=$_REQUEST[CHILD]";
        }

        /*if($mobile_detect == 1){
            $go_url .= "&app=app";
        }*/

        $go_url .= "&bbs=see&data=$data";

        ReFresh_parent($go_url);
    }
}
