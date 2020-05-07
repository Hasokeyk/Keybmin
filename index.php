<?php
    session_start();
    ob_start();

	/*
		Hasan Yüksektepe
		04.05.2020
		hasanhasokeyk@hotmail.com
	*/

    global $mysqli,$keybmin;

    //GEREKLİ KÜTÜPHANELER
    require "48186.php";
    require KEYB."keybmin.php";
    //GEREKLİ KÜTÜPHANELER

	use Keybmin\keybmin;

	$keybmin = new keybmin('keybmin',[
		'test' => true,
		'lang' => 'tr_TR'
	]);