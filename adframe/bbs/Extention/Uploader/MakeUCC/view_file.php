<?
//MakeUCC 플래시 뷰어에서는 파일을 재생하기 위해 이 파일(view_file.asp 또는 view_file.php 또는 view_file.jsp 또는 view_file.aspx)을 호출합니다.
//이 파일의 확장자는 asp,php,jsp,aspx 등 해당 사이트 웹 프로그램 언어에 따라 변경하시면 됩니다.

//플래시에서 데이터를 보내고 받을 때에는 GET 또는 POST 방식으로 보내고 받습니다
//저희 MakeUCC 는 POST 방식으로 동작하며 아래와 같은 방식으로 보내고 받을 수 있습니다.

//php 의 경우 
//받을때 $_POST["MovieID"]; 
//보낼때 echo "&Video_File=http://127.0.0.1/200851319320_368365783898.flv";
//           echo "&Video_File=http://127.0.0.1/ThumbnailImg/200851319320_368365783898.jpg";

include $_SERVER["DOCUMENT_ROOT"]."/config/config.php";
include $_SERVER["DOCUMENT_ROOT"]."/config/dbconn.php";

$row = DBarray("SELECT * FROM ".$_POST['Param1']."_file WHERE idx='".$_POST['MovieID']."'");
//$row = DBarray("SELECT * FROM bbs_test_file WHERE idx='".$_POST['MovieID']."'");

echo "&Video_File=http://".$_SERVER['HTTP_HOST']."/bbs/".$row[up_filepath];
echo "&Image_File=http://".$_SERVER['HTTP_HOST']."/bbs/".$row[up_filename];

?>