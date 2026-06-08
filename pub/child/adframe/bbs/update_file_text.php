<?php
include_once ("_common.php");

$_POST = array_map('mysql_real_escape_string', $_POST);
$_GET = array_map('mysql_real_escape_string', $_GET);


$sql = "UPDATE ".$bbs_id."_file SET file_text='".$text."' WHERE idx='".$idx."'";

DBquery($sql);
echo "ok";
?>