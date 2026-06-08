<!doctype html>
<html lang="ko">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0" />
  <meta name="format-detection" content="telephone=no" />
  <?php 
	include "../include/meta.php";

	$sql = "SELECT * FROM ".TABLE_TOPPOPUP." WHERE no='".$_GET['no']."'";
	$row = $adb->getRow($sql);
  ?>
  <title><?php echo $row['title']?></title>
</head>
<body>
	<div class="wrapper" id="wrapper">
		<img src="/img02/main/<?php echo $pId?>" alt="<?php echo $row['link_url_text']?>"/>
  	</div>
</body>
</html>
