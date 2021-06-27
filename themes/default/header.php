<?php

	global $keybmin;

	$fileName = pathinfo((__FILE__))['filename'];

	$globalCss = [
		'https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap',
		$this->settings['THEMEPATH'].'/assets/css/vendor/fontawesome/css/all.min.css',
		$this->settings['THEMEPATH'].'/assets/vendors/bootstrap/css/bootstrap.css',
		$this->settings['THEMEPATH'].'/assets/css/app.css',
	];
	$allCss    = array_merge($globalCss, $csses??[]);

	$globalJs = [
		'https://code.jquery.com/jquery-3.4.1.min.js',
        $keybmin->settings['KEYBPATH'].'keybmin_assets/vendor/sweetalert2/js/sweetalert2.all.min.js',
        $this->settings['THEMEPATH'].'assets/vendors/bootstrap/js/bootstrap.bundle.js',
		$this->settings['THEMEPATH'].'assets/js/main.js',
		$this->settings['THEMEPATH'].'assets/js/fetih.js',
	];
	$allJs    = array_merge($globalJs, $jses??[]);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$keybmin->page_title?></title>
    <meta name="description" content="<?=$keybmin->page_desc?>">

	<?php
		//$keybmin->preload($allCss??null, $allJs??null, 'global');
		$keybmin->css_minify($globalCss??null, 'global');
		$keybmin->css_minify($csses??null, $fileName);
	?>

</head>
<div id="app">
    <?php
        if(!isset($sidebar)){
            require "sidebar.php";
        }
    ?>