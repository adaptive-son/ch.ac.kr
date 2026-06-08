<?
include_once "../_common.php";

/*------------------------ 인서트 ---------------------------------*/
if($Confirm=="insert"){

    if(strlen($_POST['fm_board_key']) == 2){
        //게시판 메인테이블명
        $_POST[fm_board_id] = "bbs_".$_POST[fm_board_id];
    }

    //게시판 생성
    $bbs_table_sql = "
					CREATE TABLE IF NOT EXISTS `".$_POST[fm_board_id]."` (
					  `idx` int(11) NOT NULL auto_increment,
					  `code` varchar(10) NOT NULL default '0',
					  `sub_no` int(11) NOT NULL default '0',
					  `category` varchar(255) default NULL,
					  `notice` enum('Y','N') NOT NULL default 'N',
					  `notice_start` varchar(50) default NULL,
					  `notice_end` varchar(50) default NULL,
					  `title` varchar(255) default NULL,
					  `name` varchar(50) default NULL,
					  `pwd` varchar(50) default NULL,
					  `view_secret` enum('Y','N') NOT NULL default 'N',
					  `readnum` int(11) default '0',
					  `writeday` datetime default NULL,
					  `content` longtext,
					  `ref` int(11) default NULL,
					  `re_step` int(11) default NULL,
					  `re_level` int(11) default NULL,
					  `up_file_idx` int(11) unsigned NOT NULL default '0',
					  `up_file` int(5) unsigned NOT NULL default '0',
					  `userIp` varchar(30) default NULL,
					  `adminid` varchar(50) default NULL,
					  `userid` varchar(50) default NULL,
					  `del_yn` enum('Y','N') NOT NULL default 'N',
					  `etc_char1` varchar(255) default NULL,
					  `etc_char2` varchar(255) default NULL,
					  `etc_char3` varchar(255) default NULL,
					  `etc_text1` varchar(2000) default NULL,
					  `etc_text2` varchar(2000) default NULL,
					  PRIMARY KEY  (`idx`)
					) ENGINE=MyISAM DEFAULT CHARSET=utf8;
	";

    //업로드파일
    $bbs_file_sql = "
					CREATE TABLE IF NOT EXISTS `".$_POST[fm_board_id]."_file` (
					  `idx` int(11) NOT NULL auto_increment,
					  `up_file_idx` int(11) unsigned NOT NULL default '0',
					  `up_filename` varchar(255) default NULL,
					  `up_filepath` varchar(255) default NULL,
					  `up_filesize` int(11) NOT NULL default '0',
					  `file_width` int(11) NOT NULL DEFAULT '0',
					  `file_height` smallint(6) NOT NULL DEFAULT '0',
					  `file_type` tinyint(4) NOT NULL DEFAULT '0',
					  `datetime` datetime default NULL,
					  `userIp` varchar(30) default NULL,
					  `down_count` int(11) unsigned NOT NULL default '0',
					  `file_text` text,
					  PRIMARY KEY  (`idx`)
					) ENGINE=MyISAM DEFAULT CHARSET=utf8;
	";

    //코멘트
    $bbs_comment_sql = "
			CREATE TABLE `".$_POST[fm_board_id]."_comment` (
                `idx` INT(11) NOT NULL AUTO_INCREMENT,
                `bbs_idx` INT(11) NOT NULL,
                `name` VARCHAR(50) NULL DEFAULT NULL,
                `pwd` VARCHAR(50) NULL DEFAULT NULL,
                `content` LONGTEXT NULL,
                `writeday` DATETIME NULL DEFAULT NULL,
                `userIp` VARCHAR(30) NULL DEFAULT NULL,
                `adminid` VARCHAR(50) NULL DEFAULT NULL,
                `userid` VARCHAR(50) NULL DEFAULT NULL,
                `del_yn` ENUM('Y','N') NOT NULL DEFAULT 'N',
                `view_secret` ENUM('Y','N') NOT NULL DEFAULT 'N',
                PRIMARY KEY (`idx`)
            );
	";

    $set_sql = setQuery ($_POST, "fm_");
    $sql = "insert into ".TABLE_BOARD_MNG." set ".$set_sql;

    if($adb->query($sql)){
        if(strlen($_POST['fm_board_key']) == 2){
            $adb->query($bbs_table_sql); //게시판 메인테이블
            $adb->query($bbs_file_sql); //게시판 파일테이블
            $adb->query($bbs_comment_sql); //게시판 코멘트테이블
        }
    }

    include_once("../include/__footer.php");
    OnlyMsgView("등록하였습니다.");
    ReFresh_parent("list.php");

}


/*------------------------ 업데이트 ---------------------------------*/
if($Confirm=="update"){

    $set_sql = setQuery ($_POST, "fm_");
    $sql = "update ".TABLE_BOARD_MNG." set ".$set_sql." where idx = '$idx' ";

    $adb->query($sql);

    if($_SERVER["REMOTE_ADDR"] == "112.217.216.250"){
        //echo $sql; exit;
    }

    /*
    OnlyMsgView("수정하였습니다.");
    ReFresh_parent("add.php?w=u&idx=$idx");
    */
    include_once("../include/__footer.php");
    alert_replace("add.php?w=u&idx=$idx", "수정하였습니다.");

}


/*------------------------ 삭제 ---------------------------------*/
if($Confirm=="delete"){

    /*
    $pg_row = DBarray("SELECT idx FROM ".$DBTable." WHERE idx=$idx");


    if(!empty($pg_row[cms_img])) {
        @unlink("../../bbs/".$dir."/".$pg_row[cms_img]); //파일삭제
    }
    */

    if ( $adb->query("DELETE FROM ".TABLE_BOARD_MNG."  WHERE idx = '$idx' ")){

        /*
        OnlyMsgView("해당 데이터 삭제를 완료하였습니다.");
        ReFresh_parent("list.php");
        */
        include_once("../include/__footer.php");
        alert_replace("list.php", "해당 데이터 삭제를 완료하였습니다.");

    }else{

        echo"delete Err. ";

    }

}


/*------------------------ 권한 ---------------------------------*/
if($Confirm=="auth"){

    if($_SERVER["REMOTE_ADDR"] == "112.217.216.250"){
        //print_r2($_POST); //config_menu3: A,M,S,E
        //exit;
    }
    if(empty($_POST['fm_auth_admin']))	$_POST['fm_auth_admin'] = "N";

    for($a=1; $a <= 8; $a++){

        for($i=0;$i < count($_POST['config_menu'.$a]); $i++){
            if($i == 0)	$icomma = "";
            else		$icomma = ",";

            //$auth_menu."_".$a = $icomma.$_POST['config_menu'.$a][$i];
            //echo $_POST['config_menu'.$a][$i]."<br>";

            if($a == 1)	$_POST['fm_auth_list'] = $_POST['fm_auth_list'].$icomma.$_POST['config_menu'.$a][$i];
            if($a == 2)	$_POST['fm_auth_read'] = $_POST['fm_auth_read'].$icomma.$_POST['config_menu'.$a][$i];
            if($a == 3)	$_POST['fm_auth_write'] = $_POST['fm_auth_write'].$icomma.$_POST['config_menu'.$a][$i];
            if($a == 4)	$_POST['fm_auth_reply'] = $_POST['fm_auth_reply'].$icomma.$_POST['config_menu'.$a][$i];
            if($a == 5)	$_POST['fm_auth_comment'] = $_POST['fm_auth_comment'].$icomma.$_POST['config_menu'.$a][$i];
            if($a == 7)	$_POST['fm_auth_download'] = $_POST['fm_auth_download'].$icomma.$_POST['config_menu'.$a][$i];
            if($a == 8)	$_POST['fm_manager_group'] = $_POST['fm_manager_group'].$icomma.$_POST['config_menu'.$a][$i];

        }

    }
    if(empty($_POST['fm_auth_list']))	$_POST['fm_auth_list'] = "";
    if(empty($_POST['fm_auth_read']))	$_POST['fm_auth_read'] = "";
    if(empty($_POST['fm_auth_write']))	$_POST['fm_auth_write'] = "";
    if(empty($_POST['fm_auth_reply']))	$_POST['fm_auth_reply'] = "";
    if(empty($_POST['fm_auth_comment']))	$_POST['fm_auth_comment'] = "";
    if(empty($_POST['fm_auth_download']))	$_POST['fm_auth_download'] = "";

    if(empty($_POST['fm_manager_group']))	$_POST['fm_manager_group'] = "";

    if(empty($_POST['fm_auth_list_use']))	$_POST['fm_auth_list_use'] = "";
    if(empty($_POST['fm_auth_read_use']))	$_POST['fm_auth_read_use'] = "";
    if(empty($_POST['fm_auth_write_use']))	$_POST['fm_auth_write_use'] = "";
    if(empty($_POST['fm_auth_reply_use']))	$_POST['fm_auth_reply_use'] = "";
    if(empty($_POST['fm_auth_comment_use']))	$_POST['fm_auth_comment_use'] = "";
    if(empty($_POST['fm_auth_download_use']))	$_POST['fm_auth_download_use'] = "";



    $set_sql = setQuery ($_POST, "fm_");
    $sql = "update ".TABLE_BOARD_MNG." set ".$set_sql." where idx = '$idx' ";


    if($_SERVER["REMOTE_ADDR"] == "112.217.216.250"){
        //echo $sql; //abbs_manager
        //exit;
    }

    $adb->query($sql);



    /*
    OnlyMsgView("권한설정을 하였습니다.");
    ReFresh_parent("auth.php?idx=$idx");
    */
    include_once("../include/__footer.php");
    alert_replace("auth.php?idx=$idx", "권한설정을 하였습니다.");

}

?>