<?php

	$fileName = pathinfo((__FILE__))['filename'];

	$csses = [
		$this->settings['THEMEPATH'].'assets/vendor/bootstrap/css/bootstrap.min.css',
		$this->settings['THEMEPATH'].'assets/vendor/fonts/circular-std/style.css',
		$this->settings['THEMEPATH'].'assets/libs/css/style.css',
		$this->settings['THEMEPATH'].'assets/vendor/fonts/fontawesome/css/fontawesome-all.css',
	];

	$jses = [
		$this->settings['THEMEPATH'].'assets/vendor/jquery/jquery-3.3.1.min.js',
		$this->settings['THEMEPATH'].'assets/vendor/bootstrap/js/bootstrap.bundle.js',
	];

	if(isset($post) and !empty($post)){
		if($this->postControl(['mail','password']) and $_POST['post'] == 'login'){
			$results = $this->userLogin($mail,$password);

			if($results['status'] == 'success'){
				header("Refresh:1;");
			}
		}
	}

?>
<!doctype html>
<html lang="en">
<head>

	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title><?=\Keybmin\keybmin::pageTitle();?></title>

	<?php
		$this->cssMinify($csses??null,$fileName);
	?>
	<!-- Bootstrap CSS -->
	<style>
		html,
		body {
			height: 100%;
		}

		body {
			display: -ms-flexbox;
			display: flex;
			-ms-flex-align: center;
			align-items: center;
			padding-top: 40px;
			padding-bottom: 40px;
		}
	</style>
</head>
<body>

	<!--CONTENT-->
	<!--CONTENT-->

<?php
	$this->jsMinify($jses??null,$fileName);
?>
</body>
</html>