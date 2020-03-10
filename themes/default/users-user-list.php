<?php

    if($this->getControl(['action','userID']) === true and $action == 'del' and is_numeric($userID)){

        $askPage = $mysqli->query("SELECT * FROM kb_users WHERE id = '".$userID."'");
        if($askPage->num_rows > 0){

            $ai = $askPage->fetch_assoc();

            $del = $mysqli->query("DELETE FROM kb_users WHERE id = '".$userID."'");
            if($del){
	            $result = [
		            'status' => 'success',
		            'message' => $ai['fullName']._(' user delete'),
	            ];
            }else{
	            $result = [
		            'status' => 'danger',
		            'message' => $ai['fullName']._(' not user delete'),
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
                <h5 class="card-header"><?=$this->pageInfo['title']?> List</h5>
                <div class="card-body p-0">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Fullname</th>
                                <th scope="col">Mail</th>
                                <th scope="col">Status</th>
                                <th scope="col">Auth Name</th>
                                <th scope="col">Events</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $allUsers = $this->getUserList();
                                foreach($allUsers as $user){
                            ?>
                            <tr>
                                <th scope="row"><?=$user['id']?></th>
                                <td><?=$user['fullName']?></td>
                                <td><?=$user['mail']?></td>
                                <td><?=($user['status']==1?'<div class="text-success">'._('Active').'</div>':'<div class="text-danger">'._('Deactive').'</div>')?></td>
                                <td>
                                    <?php
                                        $subAuth = $keybmin::getAuthList($user['authID'],'id');
                                        if($subAuth == null){
                                            echo '<div class="text-danger">'._('No Sub Auth').'</div>';
                                        }else{
                                            foreach($subAuth as $auth){
                                                echo $auth['authName']."\n </br>";
                                            }
                                        }
                                    ?>
                                </td>
                                <td>
                                    <a href="?page=users-user-edit&userID=<?=$user['id']?>" class="btn btn-primary"><?=_('Edit')?></a>
                                    <a href="?page=<?=$page?>&action=del&userID=<?=$user['id']?>" class="btn btn-danger del-btn"><?=_('Del')?></a>
                                </td>
                            </tr>
                            <?php
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
	</div>
<?php
	require $this->settings['THEMEDIR']."/footer.php";
?>