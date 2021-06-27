<?php

	if(isset($post) and !empty($post)){

		$zorunlu = $keybmin->post_control([
			'auth_name',
			'auth_desc'
		]);
		if($zorunlu === true){
			$result = $keybmin->update_auth($auth_id, $auth_name, $auth_desc, $_POST['sub_auth']);
		}
		else{
			$result = [
				'status'  => 'danger',
				'message' => $zorunlu.' '._('Boş Bıraktınız')
			];
		}

	}

	if(isset($auth_id) and !empty($auth_id) and is_numeric($auth_id)){

		$askAuth = $keybmin->db->query("SELECT * FROM kb_auth WHERE id = '".$auth_id."'");
		if($askAuth->num_rows>0){
			$authDetail = $askAuth->fetch_assoc();
		}
		else{
			$result = [
				'status'  => 'danger',
				'message' => _('Yetki Bulunamadı 2'),
			];
		}

	}

	$fileName = pathinfo((__FILE__))['filename'];

	$csses = [];

	require $this->settings['THEMEDIR']."/header.php";
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
							<div class="col-12">
								<div class="form-group">
									<label for="auth_name" class="col-form-label"><?=_('Yetki Adı')?></label>
									<input id="auth_name" name="auth_name" type="text" class="form-control auth_name" value="<?=$authDetail['auth_name']?>" required>
								</div>
								<div class="form-group">
									<label for="auth_desc" class="col-form-label"><?=_('Yetki Açıklaması')?></label>
									<input id="auth_desc" name="auth_desc" type="text" class="form-control" value="<?=$authDetail['auth_desc']?>" required>
								</div>
								<div class="form-group">
									<label for="sub_auth" class="col-form-label"><?=_('Üst Yetki')?></label>
									<select class="form-control" name="sub_auth" id="sub_auth" required>
										<option value="0">Üst Yetki Yok</option>
										<?php
											$allAuth = $keybmin->get_auth_lists();
											foreach($allAuth as $auth){
												?>
												<option value="<?=$auth['id']?>" <?=($authDetail['parent_id'] == $auth['id']?'selected':'')?>><?=$auth['auth_name']?></option>
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