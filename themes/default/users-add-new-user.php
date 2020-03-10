<?php

    if(isset($post) and !empty($post)){

        if($this->postControl(['userFullname','userMail','userPassword','userStatus','userAuth']) === true){

            $askUser = $mysqli->query("SELECT * FROM kb_users WHERE mail = '".$userMail."'");
            if($askUser->num_rows == 0){

                $addUser = $mysqli->query("INSERT INTO kb_users SET 
                fullName='".$userFullname."',
                mail='".$userMail."',
                password='".md5($userPassword)."',
                status='".$userStatus."',
                authID='".$userAuth."',
                time='".time()."'
               ");
                if($addUser){
	                $result = [
		                'status' => 'success',
		                'message' => $authName._(' Auth Added'),
	                ];
                }else{
	                $result = [
		                'status' => 'danger',
		                'message' => _('Auth Not Add'),
	                ];
                }

            }else{
                $result = [
                    'status' => 'danger',
                    'message' => _('This Auth is exists'),
                ];
            }

        }

    }

	$fileName = pathinfo((__FILE__))['filename'];

	$csses = [
	];

	require $this->settings['THEMEDIR']."/header.php";
	require $this->settings['THEMEDIR']."/sidebar.php";
?>

    <div class="dashboard-wrapper">
        <div class="container-fluid dashboard-content">

            <div class="page-title">
                <h1><?=$this->pageTitle();?></h1>
                <p><?=$this->pageDesc();?></p>
            </div>
            <hr>

            <?php
                if(isset($result)){
            ?>
            <div class="alert alert-<?=$result['status']?> bg-<?=$result['status']?> text-white"><?=$result['message']?></div>
            <?php
                }
            ?>

            <div class="card">
                <div class="card-body">
                    <form action="" method="post">
                        <input type="hidden" name="post" value="true">

                        <div class="row">
                            <div class="col-6">

                                <div class="form-group">
                                    <label for="userFullname" class="col-form-label"><?=_('User Fullname')?></label>
                                    <input id="userFullname" name="userFullname" type="text" class="form-control userFullname" required>
                                </div>
                                <div class="form-group">
                                    <label for="userMail" class="col-form-label"><?=_('User Mail')?></label>
                                    <input id="userMail" name="userMail" type="text" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="userPassword" class="col-form-label"><?=_('User Password')?></label>
                                    <input id="userPassword" name="userPassword" type="text" class="form-control" required>
                                </div>

                            </div>

                            <div class="col-6">

                                <div class="form-group">
                                    <label for="userStatus" class="col-form-label"><?=_('User Status')?></label>
                                    <select class="form-control" name="userStatus" id="userStatus" required>
                                        <option value="1" selected>Active</option>
                                        <option value="2">Deactive</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="userAuth" class="col-form-label"><?=_('User Auth')?></label>
                                    <select class="form-control" name="userAuth" id="userAuth" required>
                                    <?php
                                        $allAuth = $this->getAuthList();
                                        foreach($allAuth as $auth){
                                    ?>
                                        <option value="<?=$auth['id']?>"><?=$auth['authName']?></option>
                                    <?php
                                        }
                                    ?>
                                    </select>
                                </div>

                            </div>

                            <div class="col-12 text-right">
                                <button class="btn btn-primary"><?=_('Save')?></button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
<?php
	require $this->settings['THEMEDIR']."/footer.php";
?>