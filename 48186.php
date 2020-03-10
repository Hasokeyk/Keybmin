<?php

	//HATALARI GÖSTERME
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
	//HATALARI GÖSTERME

	//YEREL SAAT
	date_default_timezone_set('Europe/Istanbul');
	//YEREL SAAT

	//VERİTABANI BAĞLANMA
	global $mysqli,$keybmin,$moduller;
	$mysqli = new mysqli('localhost','mesajliodb','48186hasokeyk','mesajliodb');

	if($mysqli->connect_error){
		echo "Veritabanı hatası";
		exit;
	}else{
		$mysqli->set_charset("utf8mb4");
	}
	//VERİTABANI BAĞLANMA

	//GEREKLİ DEĞİŞKENLER
	define('ROOT',(__DIR__));
	define('THEMEDIR',ROOT.'/themes/');
	define('KEYB',ROOT.'/keyb/');
	define('PAGES',ROOT.'/pages/');
	define('UPLOADDIR',ROOT.'/uploads/');
	define('LANGDIR',ROOT.'/langs/');
	//GEREKLİ DEĞİŞKENLER

	require KEYB."vendor/autoload.php";