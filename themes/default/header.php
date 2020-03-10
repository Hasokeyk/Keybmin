<?php

	$fileName = pathinfo((__FILE__))['filename'];

    $globalCss = [
        'https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i',
        $this->settings['THEMEPATH'].'assets/vendor/bootstrap/css/bootstrap.min.css',
        $this->settings['THEMEPATH'].'assets/vendor/fonts/circular-std/style.css',
        $this->settings['THEMEPATH'].'assets/libs/css/style.css',
        $this->settings['THEMEPATH'].'assets/vendor/fonts/fontawesome/css/fontawesome-all.css',
        $this->settings['THEMEPATH'].'assets/vendor/fonts/material-design-iconic-font/css/materialdesignicons.min.css',
        $this->settings['THEMEPATH'].'assets/vendor/charts/c3charts/c3.css',
        $this->settings['THEMEPATH'].'assets/vendor/fonts/flag-icon-css/flag-icon.min.css',
        $this->settings['THEMEPATH'].'assets/vendor/multi-select/css/multi-select.css',
	    $this->settings['THEMEPATH'].'assets/vendor/bootstrap-popover/css/bootstrap-picker.min.css',
	    $this->settings['THEMEPATH'].'assets/vendor/icon-selector/css/bootstrap-iconpicker.min.css',
    ];
    $allCss = array_merge($globalCss,$csses??[]);

    $globalJs = [
        'https://code.jquery.com/jquery-3.4.1.min.js',
        $this->settings['THEMEPATH'].'assets/vendor/bootstrap/js/bootstrap.bundle.js',
        $this->settings['THEMEPATH'].'assets/vendor/slimscroll/jquery.slimscroll.js',
        $this->settings['THEMEPATH'].'assets/vendor/multi-select/js/jquery.multi-select.js',
        $this->settings['THEMEPATH'].'assets/vendor/sweetalert2/sweetalert2.all.min.js',
        $this->settings['THEMEPATH'].'assets/vendor/bootstrap-popover/js/bootstrap-picker.min.js',
        $this->settings['THEMEPATH'].'assets/vendor/icon-selector/js/bootstrap-iconpicker.bundle.min.js',
        $this->settings['THEMEPATH'].'assets/libs/js/main-js.js',
        $this->settings['THEMEPATH'].'assets/libs/js/keybmin.js',
    ];
	$allJs = array_merge($globalJs,$jses??[]);

?>
<!doctype html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?=$this->pageTitle();?></title>
    <meta name="description" content="<?=$this->pageDesc()?>">

	<?php
		$this->preload($allCss??null,$allJs??null,'global');
		$this->cssMinify($globalCss??null,'global');
		$this->cssMinify($csses??null,$fileName);
	?>

</head>
<body>
<!-- ============================================================== -->
<!-- main wrapper -->
<!-- ============================================================== -->
<div class="dashboard-main-wrapper">
    <!-- ============================================================== -->
    <!-- navbar -->
    <!-- ============================================================== -->
    <div class="dashboard-header">
        <nav class="navbar navbar-expand-lg bg-white fixed-top">
            <a class="navbar-brand" href="/">
                <img src="<?=$this->settings['SITEURL'].'uploads/imgs/'.$this->settings['logo']?>" width="100">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse " id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto navbar-right-top">
                    <li class="nav-item">
                        <div id="custom-search" class="top-search-bar">
                            <input class="form-control" type="text" placeholder="Search..">
                        </div>
                    </li>
                    <li class="nav-item dropdown notification">
                        <a class="nav-link nav-icons" href="#" id="navbarDropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-fw fa-bell"></i> <span class="indicator"></span></a>
                        <ul class="dropdown-menu dropdown-menu-right notification-dropdown">
                            <li>
                                <div class="notification-title"> Notification</div>
                                <div class="notification-list">
                                    <div class="list-group">

                                        <a href="#" class="list-group-item list-group-item-action active">
                                            <div class="notification-info">
                                                <div class="notification-list-user-img"><img src="<?=$this->settings['THEMEPATH']?>assets/images/avatar-2.jpg" alt="" class="user-avatar-md rounded-circle"></div>
                                                <div class="notification-list-user-block"><span class="notification-list-user-name">Jeremy Rakestraw</span>accepted your invitation to join the team.
                                                    <div class="notification-date">2 min ago</div>
                                                </div>
                                            </div>
                                        </a>

                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="list-footer"> <a href="#">View all notifications</a></div>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown connection">
                        <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-fw fa-th"></i> </a>
                        <ul class="dropdown-menu dropdown-menu-right connection-dropdown">
                            <li class="connection-list">
                                <div class="row">
                                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 ">
                                        <a href="#" class="connection-item"><img src="<?=$this->settings['THEMEPATH']?>assets/images/github.png" alt="" > <span>Github</span></a>
                                    </div>
                                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 ">
                                        <a href="#" class="connection-item"><img src="<?=$this->settings['THEMEPATH']?>assets/images/dribbble.png" alt="" > <span>Dribbble</span></a>
                                    </div>
                                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 ">
                                        <a href="#" class="connection-item"><img src="<?=$this->settings['THEMEPATH']?>assets/images/dropbox.png" alt="" > <span>Dropbox</span></a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 ">
                                        <a href="#" class="connection-item"><img src="<?=$this->settings['THEMEPATH']?>assets/images/bitbucket.png" alt=""> <span>Bitbucket</span></a>
                                    </div>
                                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 ">
                                        <a href="#" class="connection-item"><img src="<?=$this->settings['THEMEPATH']?>assets/images/mail_chimp.png" alt="" ><span>Mail chimp</span></a>
                                    </div>
                                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 ">
                                        <a href="#" class="connection-item"><img src="<?=$this->settings['THEMEPATH']?>assets/images/slack.png" alt="" > <span>Slack</span></a>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="conntection-footer"><a href="#">More</a></div>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown nav-user">
                        <a class="nav-link nav-user-img" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?=$this->settings['THEMEPATH']?>assets/images/avatar-1.jpg" alt="" class="user-avatar-md rounded-circle"></a>
                        <div class="dropdown-menu dropdown-menu-right nav-user-dropdown" aria-labelledby="navbarDropdownMenuLink2">
                            <div class="nav-user-info">
                                <h5 class="mb-0 text-white nav-user-name">John Abraham </h5>
                                <span class="status"></span><span class="ml-2">Available</span>
                            </div>
                            <a class="dropdown-item" href="#"><i class="fas fa-user mr-2"></i>Account</a>
                            <a class="dropdown-item" href="#"><i class="fas fa-cog mr-2"></i>Setting</a>
                            <a class="dropdown-item" href="#"><i class="fas fa-power-off mr-2"></i>Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
    <!-- ============================================================== -->
    <!-- end navbar -->
    <!-- ============================================================== -->