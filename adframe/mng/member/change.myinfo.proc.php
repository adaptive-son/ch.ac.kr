<?php
include_once("../_common.php");

$password =  crypt($password, PASSWORD_BCRYPT);
$sql = "update ".TABLE_MEMBER." set password = '".$password."'  where id = '".$before_id."' ";
$adb->query($sql);

session_unset();
echo "<script> alert('관리자 정보가 바뀌었습니다. 다시 로그인해주시기 바랍니다.'); 
parent.location.href = '/adframe/mng'; </script>";

if ( $adb ) $adb->disconnect();

?>