<?php

    if($keybmin->get_control(['action','user_id']) === true and $action == 'del' and is_numeric($user_id)){

        $askPage = $keybmin->db->query("SELECT * FROM kb_users WHERE id = '".$user_id."'");
        if($askPage->num_rows > 0){

            $user_info = $askPage->fetch_assoc();

            $del = $keybmin->db->query("DELETE FROM kb_users WHERE id = '".$user_id."'");
            if($del){
	            $result = [
		            'status' => 'success',
		            'message' => $user_info['full_name']._(' user delete'),
	            ];
            }else{
	            $result = [
		            'status' => 'danger',
		            'message' => $user_info['full_name']._(' not user delete'),
	            ];
            }

        }

    }

	$fileName = pathinfo((__FILE__))['filename'];

	$csses = [];

	$jses = [
		$keybmin->settings['KEYBPATH'].'keybmin_assets/vendor/sweetalert2/js/sweetalert2.all.min.js',
		$keybmin->settings['KEYBPATH'].'keybmin_assets/js/keybmin.js',
	];

	require $this->settings['THEMEDIR']."/header.php";
	require $this->settings['THEMEDIR']."/sidebar.php";
?>
	<div id="main">

		<div class="page-heading">

			<div class="page-title">
				<div class="row">
					<div class="col-12 col-md-6 order-md-1 order-last">
						<h3><?=$keybmin->page_title?></h3>
						<p class="text-subtitle text-muted"><?=$keybmin->page_desc?></p>
					</div>
				</div>
			</div>

            <?php
                if(isset($result)){
            ?>
            <div class="alert alert-<?=$result['status']?> bg-<?=$result['status']?> text-white"><?=$result['message']?></div>
            <?php
                }
            ?>

            <div class="card">
                <h5 class="card-header"><?=$keybmin->page_info['title']?> List</h5>
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
                                $allUsers = $keybmin->get_user_lists();
                                foreach($allUsers as $user){
                            ?>
                            <tr>
                                <th scope="row"><?=$user['id']?></th>
                                <td><?=$user['full_name']?></td>
                                <td><?=$user['mail']?></td>
                                <td><?=($user['status']==1?'<div class="text-success">'._('Active').'</div>':'<div class="text-danger">'._('Deactive').'</div>')?></td>
                                <td>
                                    <?php
                                        $subAuth = $keybmin->get_auth_lists($user['auth_id'],'id');
                                        if($subAuth == null){
                                            echo '<div class="text-danger">'._('No Sub Auth').'</div>';
                                        }else{
                                            foreach($subAuth as $auth){
                                                echo $auth['auth_name']."\n </br>";
                                            }
                                        }
                                    ?>
                                </td>
                                <td>
                                    <a href="?page=users-user-edit&user_id=<?=$user['id']?>" class="btn btn-primary"><?=_('Edit')?></a>
                                    <a href="?page=<?=$page?>&action=del&user_id=<?=$user['id']?>" class="btn btn-danger del-btn"><?=_('Del')?></a>
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