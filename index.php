<?php

	/*
		Hasan Yüksektepe
		25.02.2020
		hasanhasokeyk@hotmail.com
	*/

	use Keybmin\keybmin;

	ob_start();

	ini_set('session.gc_maxlifetime',60 * 60 * 24 * 100);
	ini_set('session.gc_probability',1);
	ini_set('session.gc_divisor',1);
	ini_set('session.cookie_lifetime', 60 * 60 * 24 * 100);

	session_start();

	global $mysqli,$keybmin;

	//GEREKLİ KÜTÜPHANELER
	require "48186.php";
	require KEYB."keybmin.php";
	//GEREKLİ KÜTÜPHANELER

	//$moduller = new moduller();
	$keybmin = new keybmin('mesajlio',[
		'test' => true,
		'lang' => 'tr_TR'
	]);