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
<!-- ============================================================== -->
<!-- login page  -->
<!-- ============================================================== -->
<div class="splash-container">
	<div class="card ">
		<div class="card-header text-center">
            <a href="/">
                <img src="<?=$this->settings['SITEURL'].'uploads/imgs/'.$this->settings['logo']?>" width="100">
            </a>
        </div>
		<div class="card-body">
			<form action="" method="post">

				<?php
					if(isset($results['status'])){
                ?>
                <div class="alert alert-<?=$results['status']?>"><?=$results['message']?></div>
                <?php
					}
				?>

                <input type="hidden" name="post" value="login">

				<div class="form-group">
					<input class="form-control form-control-lg" name="mail" id="email" type="text" placeholder="<?=_("E-mail")?>" autocomplete="off" required>
				</div>
				<div class="form-group">
					<input class="form-control form-control-lg" name="password" minlength="5" maxlength="100" id="password" type="password" placeholder="<?=_("Password")?>" required>
				</div>
				<div class="form-group">
					<label class="custom-control custom-checkbox">
						<input class="custom-control-input" type="checkbox"><span class="custom-control-label"><?=_("Remember Me")?></span>
					</label>
				</div>
				<button type="submit" class="btn btn-primary btn-lg btn-block"><?=_("Sign in")?></button>
			</form>
		</div>
		<div class="card-footer bg-white p-0  ">
			<div class="card-footer-item card-footer-item-bordered">
				<a href="?page=register" class="footer-link"><?=_("Create An Account")?></a>
            </div>
			<div class="card-footer-item card-footer-item-bordered">
				<a href="#" class="footer-link"><?=_("Forgot Password")?></a>
			</div>
		</div>
	</div>
</div>

<!-- ============================================================== -->
<!-- end login page  -->
<!-- ============================================================== -->

<?php
	$this->jsMinify($jses??null,$fileName);
?>

</body>

</html>