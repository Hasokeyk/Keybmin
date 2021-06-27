<?php
    
    global $keybmin;
    
    $fileName = pathinfo((__FILE__))['filename'];
    
    $csses = [
        'https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css',
        $this->settings['THEMEPATH'].'assets/css/login.css',
    ];
    
    $jses = [
        'https://code.jquery.com/jquery-3.4.1.min.js',
        $this->settings['THEMEPATH'].'assets/js/main.js',
    ];

?>
<!doctype html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>e-Kitap - Panel</title>
    
    <?php
        //$keybmin->preload($allCss??null, $allJs??null, 'global');
        $keybmin->css_minify($globalCss ?? null, 'global');
        $keybmin->css_minify($csses ?? null, $fileName);
    ?>

</head>
<body>
<?php
    global $keybmin;
    
    $login = $keybmin->login_check();
    if($login){
        header("Location:".$keybmin->settings['SITEURL']);
    }
    
    if(isset($post) and !empty($post)){
        if($keybmin->post_control([
                'mail',
                'password',
            ]) and $_POST['post'] == 'login'){
            $results = $keybmin->user_login($mail, $password);
            if($results['status'] == 'success'){
                header("Refresh:1;");
            }
        }
    }
?>
<div class="wrapper fadeInDown">
    <div id="formContent">
        <!-- Tabs Titles -->

        <!-- Icon -->
        <div class="fadeIn first">
            <img src="<?=$this->settings['THEMEPATH']?>/assets/images/ekitap-icon.png" id="login-icon" alt="e-Kitap Logo"/>
        </div>

        <!-- Login Form -->
        <form action="" method="post">
            <input type="hidden" name="post" value="login">
            
            <?php
                if(isset($results['status'])){
                    ?>
                    <div class="alert alert-<?=$results['status']?>"><?=$results['message']?></div>
                    <?php
                }
            ?>

            <input type="email" id="email" class="fadeIn second" name="mail" placeholder="E-Mail">
            <input type="password" id="password" class="fadeIn third" name="password" password="password" placeholder="Password">
            <br>
            <br>
            <input type="submit" class="fadeIn fourth" value="Log In">
        </form>

    </div>
</div>

<?php
    $keybmin->js_minify($jses ?? null, $fileName);
?>
</body>
</html>