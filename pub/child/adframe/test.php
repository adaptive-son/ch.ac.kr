<?php
error_reporting( E_ALL );
ini_set( "display_errors", 1 );


function phpInjectionFiltering($str) {
	$str = preg_replace("/\s{1,}1\=(.*)+/","", $str);
	$str = preg_replace("/\s{1,}(or|and|null|where|limit)/i"," ", $str);
	$str = preg_replace("/[\s\t\'\;\=]+/","", $str);
	return $str;
}

$test = phpInjectionFiltering("/home/dev/adframe/test.php");


echo $test;


$_GET['popupw'] = urlencode(700);
$_GET['popuph'] = 700;

$popup_w = $_GET['popupw'] == "" ? "500": $_GET['popupw'];
$popup_h = $_GET['popuph'] == "" ? "500": $_GET['popuph'];

echo $popup_w;
?>
