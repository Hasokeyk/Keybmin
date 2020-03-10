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
		$required = $this->postControl(['fullname','mail','password','confirmPassword']);
		if($required === true and $_POST['post'] == 'register'){
			$results = $this->userRegister($fullname,$mail,$password,$confirmPassword);
			if($results['status'] == 'success'){
				header("Refresh:1; url=/");
			}
		}else{
			$result = [
				'status' => 'danger',
				'message' => $required.' '._('Parameters Not Found'),
			];
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
    <!-- signup form  -->
    <!-- ============================================================== -->
    <form action="" method="post" class="splash-container">
        <div class="card">
            <div class="card-header">
                <h3 class="mb-1"><?=$this->pageInfo['title'];?></h3>
                <p><?=$this->pageInfo['description'];?></p>
            </div>
            <div class="card-body">

	            <?php
		            if(isset($results['status'])){
                ?>
                <div class="alert alert-<?=$results['status']?>"><?=$results['message']?></div>
                <?php
		            }
	            ?>

                <input type="hidden" name="post" value="register">

                <div class="form-group">
                    <input type="text" class="form-control form-control-lg" name="fullname" placeholder="<?=_('Fullname')?>" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <input type="email" class="form-control form-control-lg" name="mail" placeholder="<?=_('E-mail')?>" autocomplete="off"required>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control form-control-lg" name="password" minlength="7" maxlength="100" placeholder="<?=_('Password')?>" required>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control form-control-lg" name="confirmPassword" minlength="7" maxlength="100" placeholder="<?=_('Password Confirm')?>" required>
                </div>
                <div class="form-group pt-2">
                    <button class="btn btn-block btn-primary" type="submit"><?=_('Register My Account')?></button>
                </div>
                <div class="form-group">
                    <label class="custom-control custom-checkbox">
                        <input class="custom-control-input" type="checkbox">
                        <span class="custom-control-label">
                            <a href="#"><?=_('Terms and conditions')?></a>
                        </span>
                    </label>
                </div>
            </div>
            <div class="card-footer bg-white">
                <p><?=_('Already member?')?> <a href="/" class="text-secondary"><?=_('Login Here')?></a></p>
            </div>
        </div>
    </form>

<?php
	$this->jsMinify($jses??null,$fileName);
?>
</body>
</html>