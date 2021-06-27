<?php

	if(isset($post) and !empty($post)){

		if($keybmin->post_control([
				'userFullname',
				'userMail',
				'userStatus',
				'user_auth'
			]) === true){

			if(isset($userPassword) and !empty($userPassword)){
				$sql = "password='".md5($userPassword)."',";
			}
			else{
				$sql = '';
			}

			$ask_user = $keybmin->db->query("SELECT * FROM kb_users WHERE id = '".$user_id."'");
			if($ask_user->num_rows>0){

				$addUser = $keybmin->db->query("UPDATE kb_users SET full_name='".$userFullname."', mail='".$userMail."', ".$sql." status='".$userStatus."', auth_id='".$user_auth."', time='".time()."' WHERE id = '".$user_id."'");
				if($addUser){
					$result = [
						'status'  => 'success',
						'message' => _('Kullanıcı Güncellendi'),
					];
				}
				else{
					$result = [
						'status'  => 'danger',
						'message' => _('Kullanıcı Güncellenemedi'),
					];
				}

			}
			else{
				$result = [
					'status'  => 'danger',
					'message' => _('Kullanıcı Bulunamadı'),
				];
			}

		}

	}

	if(isset($user_id) and !empty($user_id) and is_numeric($user_id)){

		$ask_user = $keybmin->db->query("SELECT * FROM kb_users WHERE id = '".$user_id."'");
		if($ask_user->num_rows>0){
			$user_info = $ask_user->fetch_assoc();
		}
		else{
			$result = [
				'status'  => 'danger',
				'message' => _('This user is not exists'),
			];
		}

	}

	$fileName = pathinfo((__FILE__))['filename'];

	$csses = [];

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
				<div class="card-body">
					<form action="" method="post">
						<input type="hidden" name="post" value="true">
						<div class="row">
							<div class="col-6">
								<div class="form-group">
									<label for="userFullname" class="col-form-label"><?=_('Ad Soyad')?></label>
									<input id="userFullname" name="userFullname" type="text" class="form-control userFullname" value="<?=$user_info['full_name']?>" required>
								</div>
								<div class="form-group">
									<label for="userMail" class="col-form-label"><?=_('Mail Adresi')?></label>
									<input id="userMail" name="userMail" type="text" class="form-control" value="<?=$user_info['mail']?>" required>
								</div>
								<div class="form-group">
									<label for="userPassword" class="col-form-label"><?=_('Parola')?></label>
									<input id="userPassword" name="userPassword" type="text" class="form-control">
								</div>
							</div>
							<div class="col-6">
								<div class="form-group">
									<label for="userStatus" class="col-form-label"><?=_('Durum')?></label>
									<select class="form-control" name="userStatus" id="userStatus" required>
										<option value="1" <?=$user_info['status'] == '1'?'selected':'';?>><?=_('Aktif')?></option>
										<option value="2" <?=$user_info['status'] == '2'?'selected':'';?>><?=_('Pasif')?></option>
									</select>
								</div>
								<div class="form-group">
									<label for="user_auth" class="col-form-label"><?=_('Yetkilendirme')?></label>
									<select class="form-control" name="user_auth" id="user_auth" required>
										<?php
											$allAuth = $keybmin->get_auth_lists();
											foreach($allAuth as $auth){
												?>
												<option value="<?=$auth['id']?>" <?=$user_info['auth_id'] == $auth['id']?'selected':'';?>><?=$auth['auth_name']?></option>
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