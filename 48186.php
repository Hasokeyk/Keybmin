<?php

	//HATALARI GÖSTERME
use SeinopSys\PostgresDb;

error_reporting(E_ALL);
	ini_set('display_errors', 1);
	//HATALARI GÖSTERME

	//YEREL SAAT
	date_default_timezone_set('Europe/Istanbul');
	//YEREL SAAT

    global $mysqli,$keybmin,$moduller;

    //GEREKLİ DEĞİŞKENLER
    define('ROOT',(__DIR__));
    define('THEMEDIR',ROOT.'/themes/');
    define('KEYB',ROOT.'/keyb/');
    define('PAGES',ROOT.'/pages/');
    define('UPLOADDIR',ROOT.'/uploads/');
    define('LANGDIR',ROOT.'/langs/');
    //GEREKLİ DEĞİŞKENLER

    require KEYB."vendor/autoload.php";

	//VERİTABANI BAĞLANMA
    $host       = '-{LOCALHOST}-';
    $user       = '-{USERNAME}-';
    $pass       = '-{PASSWORD}-';
    $dbname     = '-{DATABASE}-';
    $dbtype     = '-{DATABASETYPE}-';

    $lockFile = KEYB.'lock.keybmin';
    if(file_exists($lockFile)){

        if($dbtype == 'mysqli'){
            $db = new mysqli($host,$user,$pass,$dbname);
            if($db->connect_error){
                echo "Veritabanı hatası";
                exit;
            }else{
                $db->set_charset("utf8mb4");
            }
        }else if($dbtype == 'postgresql'){
            require (__DIR__).'/library/PostgresDb.php';
            $db = new PostgresDb($this->dbname, $this->host, $this->user, $this->pass);
            try {
                $db->getConnection();
            } catch (Exception $err) {
                echo "Veritabanı hatası";
                exit;
            }
        }
    }else{
        require KEYB."keybmin_install.php";
        require KEYB.'install.php';
        exit();
    }
	//VERİTABANI BAĞLANMA
