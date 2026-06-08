<?
header("Content-Type: text/html; charset=UTF-8");

include "../connect_db.php";
$sql = "select * from nse_tb order by no desc limit 1";
$res = mysql_query($sql,$connect);
$show = mysql_fetch_assoc($res);
echo "{$show['content']}";

?>