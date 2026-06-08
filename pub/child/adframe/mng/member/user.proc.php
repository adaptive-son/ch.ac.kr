<? include "../_common.php" ?>

<?php
if($mode=="u" || $mode=="d") {

    $sql = " select * from ".TABLE_MEMBER." where id = '$id' ";
    $cnt = mysql_num_rows(mysql_query($sql));
    if($cnt < 1) alert_msg("회원을 찾을 수 없습니다.");
}
if($password!=""){
    $password =  crypt($password, PASSWORD_BCRYPT);
}

if($mode=="") {
    $sql = " insert into ".TABLE_MEMBER." (id, name, password, user_type,del_yn,regi_date,modi_date) 
    values ('".$id."','".$name."','$password','$member_type','N',now(),now())  ";
} else if ($mode=="u") {
    $sql = " update ".TABLE_MEMBER." set name='".$name."' , user_type='$member_type' ";
    if($password!="") $sql .= " , password='$password' ";
    $sql .= " , modi_date = now() where id = '$id' " ;
} else if ($mode=="d") {
    $sql = " update ".TABLE_MEMBER." set del_yn='Y' where id = '$id' ";
    echo $sql;
}
$result = mysql_query($sql) or die(mysql_error());


if($mode=="u") {
    alert_href("user.list.php","정상적으로 수정되었습니다.");
}else if($mode=="d"){
    alert_href("user.list.php","정상적으로 삭제되었습니다.");
}else {
    alert_href("user.list.php","저장되었습니다.");
}

?>


