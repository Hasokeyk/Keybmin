<?php

	if(isset($post) and !empty($post)){

		$required = $keybmin->post_control([
			'user_full_name',
			'user_mail',
			'user_password',
			'user_status',
			'user_auth'
		]);
		if($required === true){

			$askUser = $keybmin->db->query("SELECT * FROM kb_users WHERE mail = '".$user_mail."'");
			if($askUser->num_rows == 0){

				$addUser = $keybmin->db->query("INSERT INTO kb_users SET full_name='".$user_full_name."', mail='".$user_mail."', password='".md5($user_password)."', status='".$user_status."', auth_id='".$user_auth."', time='".time()."'");
				if($addUser){
					$result = [
						'status'  => 'success',
						'message' => _('Kullanıcı Eklendi'),
					];
				}
				else{
					$result = [
						'status'  => 'danger',
						'message' => _('Kullanıcı Eklenemedi'),
					];
				}

			}
			else{
				$result = [
					'status'  => 'danger',
					'message' => _('Kullanıcı Zaten Var'),
				];
			}

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
									<label for="user_full_name" class="col-form-label"><?=_('Ad Soyad')?></label>
									<input id="user_full_name" name="user_full_name" type="text" class="form-control user_full_name" required>
								</div>
								<div class="form-group">
									<label for="user_mail" class="col-form-label"><?=_('Mail Adresi')?></label>
									<input id="user_mail" name="user_mail" type="text" class="form-control" required>
								</div>
								<div class="form-group">
									<label for="user_password" class="col-form-label"><?=_('Parola')?></label>
									<input id="user_password" name="user_password" type="text" class="form-control" required>
								</div>
							</div>
							<div class="col-6">
								<div class="form-group">
									<label for="user_status" class="col-form-label"><?=_('Durum')?></label>
									<select class="form-control" name="user_status" id="user_status" required>
										<option value="1" selected><?=_('Aktif')?></option>
										<option value="2"><?=_('Pasif')?></option>
									</select>
								</div>
								<div class="form-group">
									<label for="user_auth" class="col-form-label"><?=_('Yetkilendirme')?></label>
									<select class="form-control" name="user_auth" id="user_auth" required>
										<?php
											$allAuth = $keybmin->get_auth_lists();
											foreach($allAuth as $auth){
												?>
												<option value="<?=$auth['id']?>"><?=$auth['auth_name']?></option>
												<?php
											}
										?>
									</select>
								</div>
							</div>
							<div class="col-12 text-right">
								<button class="btn btn-primary"><?=_('Kaydet')?></button>
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