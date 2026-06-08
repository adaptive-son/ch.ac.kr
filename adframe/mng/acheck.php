<?
session_start();

$admin_session = "ok";
//$s_id = $_SESSION[ID];
//if($s_id){$s_check="ok";}
if( $s_id == "" || $s_check != $admin_session ) 
{
	//echo "<script>alert('권한이 없습니다.');top.location='/adm';</script>";
	//exit;
}

?>