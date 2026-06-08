<?
//'MakeUCC 플래시 뷰어에서는 영상 파일을 재생하기 전에 이 파일(view_hit.asp 또는 view_hit.php 또는 view_hit.jsp 또는 view_hit.aspx)을 호출합니다.
//'이 파일의 확장자는 asp,php,jsp,aspx 등 해당 사이트 웹 프로그램 언어에 따라 변경하시면 됩니다.
//'왜나하면 플래시에서는 DB로 바로 접근해서 읽기나 쓰기를 할수 없기 때문입니다.
//'그래서 플래시에서 DB로 접근하기 위해서 서버사이드 언어와 연계해야 합니다.
//'플래시에서는 텍스트파일로 접근하며 읽기는 가능하나 쓰기는 불가능합니다.
//'플래시에서 보내고 받을 때에는 GET 또는 POST 방식으로 보내고 받습니다
//'저희 MakeUCC 는 POST 방식으로 동작하며 아래와 같은 방식으로 보내고 받을 수 있습니다.
//'php 의 경우 
//'받을때 trim($MovieID);
//'보낼때 echo "&Video_File=http://127.0.0.1/200851319320_368365783898.flv";
//'           echo "&Video_File=http://127.0.0.1/ThumbnailImg/200851319320_368365783898.jpg";
//'asp 의경우 
//'받을때 Request("MovieID")
//'보낼때 Response.Write "&Video_File=http://127.0.0.1/200851319320_368365783898.flv"
//'           Response.Write "&Image_File=http://127.0.0.1/ThumbnailImg/200851319320_368365783898.jpg"
//'jsp 의경우 
//'받을때 request.getParameter("MovieID");
//'보낼때 "&Video_File=http://127.0.0.1/200851319320_368365783898.flv"
//'           "&Image_File=http://127.0.0.1/ThumbnailImg/200851319320_368365783898.jpg"
//
//'뷰어에서 영상 파일을 재생하기 전에 이 파일을 호출하면서 POST 방식으로 MovieID 전달합니다.
//'그럼 POST 방식으로 전달된 MovieID 에 해당하는 영상 파일의 히트 카운트를 1 증가시키면 됩니다.
//'아래는 asp로 MovieID에 해당하는 영상 파일의 히트 카운트를 1증가하는 예제 코드 입니다.
//
//'	Dim MovieID : MovieID = Request("MovieID")
//'	Dim objDBconn
//'	Dim strConn : strConn = "Provider=SQLOLEDB;Data Source=127.0.0.1;Initial Catalog=MakeUCC_DB;user ID=MakeUCC_ID;Password=MakeUCC_PW"
//'	Dim strQuery
//
//'	If MovieID <> "" Then
//'		Set objDBconn = CreateObject("ADODB.Connection")
//'		objDBconn.Open strConn
//		
//'		strQuery = "UPDATE MovieInfo SET Hit_Count=Hit_Count+1 WHERE MovieID=" MovieID = Request("MovieID")& MovieID
//
//'		objDBconn.Execute strQuery
//
//'		objDBconn.Close : Set objDBconn = Nothing
//'	End If
//
//'컴포넌트 타입이 Premium 인 경우에는 앞/뒤 광고 영상의 히트 카운트도 증가 시킬 수 있습니다.
//'컴포넌트 타입이 Premium 인 경우에는 MovieID와 FileType이 POST 방식으로로 전달 됩니다.
//'앞 광고 영상을 재생할 때는 FileType이 "frontfile" 로 넘어고
//'뒤 광고 영상을 재생할 때는 FileType이 "rearfile" 로 넘어고
//'실재 영상을 재생할 때는 FileType이 "bodyfile" 로 넘어옵니다.
//'FileType을 체크하여 히트 카운트를 증가시키면 됩니다.
//
//'해당 사이트 웹 프로그래밍 언어에 맞게 이 파일의 확장자를 변경하십시오.
//'view_file.asp 또는 view_file.php 또는 view_file.jsp 또는 view_file.aspx

include $_SERVER["DOCUMENT_ROOT"]."/config/config.php";
include $_SERVER["DOCUMENT_ROOT"]."/config/dbconn.php";

$MovieID = trim($MovieID);

if($Param1 && $MovieID){
	@DBquery("update ".$Param1."_file set hit_count=hit_count+1 where idx=''".$MovieID."''");
}
?>
