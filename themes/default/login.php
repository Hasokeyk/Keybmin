<?php

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

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="<?=$this->settings['THEMEPATH']?>/assets/vendor/bootstrap/css/bootstrap.min.css">
	<link href="<?=$this->settings['THEMEPATH']?>assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
	<link rel="stylesheet" href="<?=$this->settings['THEMEPATH']?>assets/libs/css/style.css">
	<link rel="stylesheet" href="<?=$this->settings['THEMEPATH']?>assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
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
                <img class="logo-img" src="<?=$this->settings['THEMEPATH']?>assets/images/logo.png" alt="logo">
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
					<input class="form-control form-control-lg" name="mail" id="email" type="text" placeholder="<?=_("E-mail")?>" autocomplete="off">
				</div>
				<div class="form-group">
					<input class="form-control form-control-lg" name="password" id="password" type="password" placeholder="<?=_("Password")?>">
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
				<a href="#" class="footer-link"><?=_("Create An Account")?></a></div>
			<div class="card-footer-item card-footer-item-bordered">
				<a href="#" class="footer-link"><?=_("Forgot Password")?></a>
			</div>
		</div>
	</div>
</div>

<!-- ============================================================== -->
<!-- end login page  -->
<!-- ============================================================== -->
<!-- Optional JavaScript -->
<script src="<?=$this->settings['THEMEPATH']?>assets/vendor/jquery/jquery-3.3.1.min.js"></script>
<script src="<?=$this->settings['THEMEPATH']?>assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
</body>

</html>