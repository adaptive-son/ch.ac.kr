<?
include $_SERVER["DOCUMENT_ROOT"]."/config/session.php";

include_once("./research_date.php");

if($_SESSION['MEMBER_UID'] == ""){
?><script>alert("잘못된접근입니다.");
</script><? exit; } ?>
<?

if($date >= $date_start and $date < $date_end){
	
	$way_datetime = date("Y-m-d H:i:s");
	$way_ip = $_SERVER['REMOTE_ADDR'];
	$mb_id	= $_SESSION['MEMBER_UID'];
	$mb_name = $_SESSION['MEMBER_UNAME'];
	$mb_license = $_SESSION['MEMBER_GROUP'];


	for($i=0;$i<count($q_1);$i++){
		if($i=="0"){
			$q_1_ext = $q_1[$i];
		}else{
			$q_1_ext .= "|".$q_1[$i];
		}
	}

	for($i=0;$i<count($q_21);$i++){
		if($i=="0"){
			$q_21_ext = $q_21[$i];
		}else{
			$q_21_ext .= "|".$q_21[$i];
		}
	}
	
	$sql_common = " 
				 q_1					= '$q_1_ext',
				 q_2					= '$q_2',
				 q_3					= '$q_3',
				 q_4					= '$q_4',
				 q_5					= '$q_5',
				 q_6					= '$q_6',
				 q_7					= '$q_7',
				 q_8					= '$q_8',
				 q_9					= '$q_9',
				 q_10					= '$q_10',
				 q_11					= '$q_11',
				 q_12					= '$q_12',
				 q_13					= '$q_13',
				 q_14					= '$q_14',
				 q_15					= '$q_15',
				 q_16					= '$q_16',
				 q_17					= '$q_17',
				 q_18					= '$q_18',
				 q_19					= '$q_19',
				 q_20					= '$q_20',
				 q_21					= '$q_21_ext',
				 q_22					= '$q_22',
				 mb_id				= '$mb_id',
				 mb_name			= '$mb_name',
				 mb_license 	= '$mb_license',
				 way_datetime	= '$way_datetime',
				 way_ip				= '$way_ip'
	";

	
	$sql = " insert into way_survey2015 set $sql_common ";
	mysql_query($sql)or die(mysql_error());
?>
	<script>
	alert("설문조사 참여가 완료되었습니다. 감사합니다.");
	//window.close();
	location.href="/index.php";
	</script>
<?	
 }else{ ?>
	<script>
	alert("설문조사 기간이 아닙니다.");
	//window.close();
	location.href="/index.php";
	</script>
<? } ?>	