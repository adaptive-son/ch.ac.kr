<? 
include_once("../header.admin.php"); 
$sql = "SELECT * FROM recruit_copy WHERE resume_num=7";
$res = mysql_query($sql);
WHILE($row=mysql_fetch_array($res)){
	//print_R($row[apply_num]);echo "<br />";
	$apply_num = explode("-",$row[apply_num]);
/*
	$apply_num = $apply_num[0]."-".$apply_num[1]."-";
	if($row[wr_id]=="94"  || $row[wr_id]=="95"){
		$sql = "update recruit_copy SET apply_num='$apply_num' where wr_id='$row[wr_id]'";
		mysql_query($sql);
	}
	*/
	$data = mysql_fetch_array(mysql_query("select * from recruit1 WHERE parent='$row[wr_id]'"));

	if($row[wr_id]=="84" || $row[wr_id]=="89"){
		$sql = "UPDATE recruit1 SET type_gubun='°£È£ÇÐ' where parent ='$row[wr_id]'";
		mysql_query($sql);
	}
	
}

?>
