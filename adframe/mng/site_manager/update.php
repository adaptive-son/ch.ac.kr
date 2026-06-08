<? include "../_common.php" ?>

<?php
/**
 */
if($j=="u" || $j=="d") {

    $sql = " select * from ".TABLE_SITE_MNG." where site_no = $site_no ";
    $cnt = mysql_num_rows(mysql_query($sql));
    if($cnt < 1) alert_msg("입력된 자료가 없습니다.");
}

$sql_gener = " site_id = '$site_id',
						site_name = '$site_name',
						site_domain = '$site_domain',
						site_type ='$site_type',
						site_title ='$site_title',
						locale_lang ='$locale_lang',
						member_clause ='$member_clause',
						member_perinfo ='$member_perinfo',
						pri_manager_name ='$pri_manager_name',
						manager_name = '$manager_name',
						site_email = '$site_email',
						site_phone = '$site_phone',
						site_fax = '$site_fax',
						site_addr = '$site_addr',
						site_keyword = '$site_keyword',
						site_desc = '$site_desc',
						site_copyright ='$site_copyright' ";

if($j=="") {
    //echo "1";
    $sql = " insert into ".TABLE_SITE_MNG." set $sql_gener ";

    //origin_folder 복사
    copy_directory($_SERVER['DOCUMENT_ROOT']."/pub/origin_folder",$_SERVER['DOCUMENT_ROOT']."/pub/".$site_id);

} else if ($j=="u") {
    //echo "2";
    $sql = " update ".TABLE_SITE_MNG." set $sql_gener where site_no = '$site_no' ";


} else if ($j=="d") {
    //echo "3";
    $sql = " delete from ".TABLE_SITE_MNG." where site_no = '$site_no' ";
}
$result = mysql_query($sql) or die(mysql_error());

if($j=="u") {
    alert_href("list.php","정상적으로 수정되었습니다.");
}else if($j=="d"){
    alert_href("list.php","정상적으로 삭제되었습니다.");
}else {
    alert_href("list.php","저장되었습니다.");
}

?>


