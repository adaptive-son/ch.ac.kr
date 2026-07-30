<?php
header('Content-Type: text/plain');
echo "PHP_VERSION: ".PHP_VERSION."\n";
echo "SAPI: ".php_sapi_name()."\n";
echo "mysql_connect exists: ".(function_exists('mysql_connect')?'YES':'NO')."\n";
echo "mysqli_connect exists: ".(function_exists('mysqli_connect')?'YES':'NO')."\n";
echo "php.ini path: ".php_ini_loaded_file()."\n";
echo "auto_prepend_file: ".ini_get('auto_prepend_file')."\n";
?>
