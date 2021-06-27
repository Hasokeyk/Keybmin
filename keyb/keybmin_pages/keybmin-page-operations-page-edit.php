<?php

	if(isset($post) and !empty($post)){

		$zorunlu = $keybmin->post_control([
			'page_name',
			'page_desc',
			'page_link',
			'short_code',
			'page_status',
			'page_type',
			'icon_class',
			'menu_status',
		]);
		if($zorunlu === true){
			$result = $keybmin->update_page($page_id, $page_name, $page_desc, $page_link, $short_code, $page_status, $login_control, $menu_status, $page_type, $_POST['pageAuth']??null, $parent_id, $icon_class);
		}
		else{
			$result = [
				'status'  => 'danger',
				'message' => $zorunlu.' '._('Boş Bıraktınız')
			];
		}

	}

	if(isset($page_id) and !empty($page_id) and is_numeric($page_id)){

		$ask_page = $keybmin->db->query("SELECT * FROM kb_pages WHERE id = '".$page_id."'");
		if($ask_page->num_rows>0){
			$page_detail = $ask_page->fetch_assoc();
		}
		else{
			$result = [
				'status'  => 'danger',
				'message' => _('This page is not exists'),
			];
		}

	}

	$csses = [
		$keybmin->settings['KEYBPATH'].'keybmin_assets/vendor/sweetalert2/css/sweetalert2.min.css',
		$keybmin->settings['KEYBPATH'].'keybmin_assets/vendor/multi-select/css/multi-select.css',
		$keybmin->settings['KEYBPATH'].'keybmin_assets/vendor/bootstrap-picker/css/bootstrap-picker.min.css',
		$keybmin->settings['KEYBPATH'].'keybmin_assets/vendor/bootstrap-iconpicker/css/bootstrap-iconpicker.min.css',
	];

	$jses = [
		$keybmin->settings['KEYBPATH'].'keybmin_assets/vendor/sweetalert2/js/sweetalert2.all.min.js',
		$keybmin->settings['KEYBPATH'].'keybmin_assets/vendor/bootstrap/js/bootstrap.bundle.min.js',
		$keybmin->settings['KEYBPATH'].'keybmin_assets/vendor/multi-select/js/jquery.multi-select.js',
		$keybmin->settings['KEYBPATH'].'keybmin_assets/vendor/popover/js/popper.min.js',
		$keybmin->settings['KEYBPATH'].'keybmin_assets/vendor/bootstrap-picker/js/bootstrap-picker.min.js',
		$keybmin->settings['KEYBPATH'].'keybmin_assets/vendor/bootstrap-iconpicker/js/bootstrap-iconpicker.bundle.min.js',
		$keybmin->settings['KEYBPATH'].'keybmin_assets/js/keybmin.js',
	];

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
							<div class="col-6">
								<div class="form-group">
									<label for="page_name" class="col-form-label"><?=_('Başlık')?></label>
									<div class="input-group">
                                        <span class="input-group-prepend">
                                            <button class="btn btn-dark icon-selector" data-icon="<?=$page_detail['icon_class']?>" role="iconpicker"></button>
                                            <input type="hidden" name="icon_class" class="icon_class" value="<?=$page_detail['icon_class']?>">
                                        </span>
										<input id="page_name" name="page_name" type="text" class="form-control page_name" value="<?=$page_detail['title']?>" required>
									</div>
								</div>
								<div class="form-group">
									<label for="page_desc" class="col-form-label"><?=_('Açıklama')?></label>
									<input id="page_desc" name="page_desc" type="text" class="form-control" value="<?=$page_detail['description']?>" required>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label for="page_link" class="col-form-label"><?=_('Sayfa Linki')?></label>
											<input id="page_link" name="page_link" type="text" class="form-control page_link" value="<?=$page_detail['link']?>" readonly>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label for="short_code" class="col-form-label"><?=_('Kısa Kod')?></label>
											<input id="short_code" name="short_code" type="text" class="form-control short_code" value="<?=$page_detail['shortcode']?>" readonly>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-4">
										<div class="form-group">
											<label for="page_status" class="col-form-label"><?=_('Durum')?></label>
											<select class="form-control" name="page_status" id="page_status" required>
												<option value="1" <?=$page_detail['status'] == '1'?'selected':''?>><?=_('Aktif')?></option>
												<option value="0" <?=$page_detail['status'] == '0'?'selected':''?>><?=_('Kapalı')?></option>
											</select>
										</div>
									</div>
									<div class="col-lg-4">
										<div class="form-group">
											<label for="page_type" class="col-form-label"><?=_('Sayfa Türü')?></label>
											<select class="form-control" name="page_type" id="page_type">
												<option value="pages" <?=$page_detail['type'] == 'pages'?'selected':''?>><?=_('Pages')?></option>
												<option value="ajax" <?=$page_detail['type'] == 'ajax'?'selected':''?>><?=_('Ajax')?></option>
												<option value="keybmin" <?=$page_detail['type'] == 'keybmin'?'selected':''?>><?=_('Keybmin')?></option>
											</select>
										</div>
									</div>
									<div class="col-lg-4">
										<div class="form-group">
											<label for="menu_status" class="col-form-label"><?=_('Menüde Gözüksün mü?')?></label>
											<select class="form-control" name="menu_status" id="menu_status">
												<option value="1" <?=$page_detail['menu'] == '1'?'selected':''?>><?=_('Evet')?></option>
												<option value="2" <?=$page_detail['menu'] == '2'?'selected':''?>><?=_('Hayır')?></option>
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label for="parent_id" class="col-form-label"><?=_('Üst Sayfa')?></label>
											<select class="form-control parent_id" name="parent_id" id="parent_id" required>
												<option value="0" data-short_code=""><?=_('Üst Sayfa Yok')?></option>
												<?php
													$allPage = $keybmin->get_page_lists();
													foreach($allPage as $page){
														?>
														<option value="<?=$page['id']?>" data-short_code="<?=$page['shortcode']?>" <?=$page_detail['parent_id'] == $page['id']?'selected':''?>><?=$page['title']?></option>
														<?php
													}
												?>
											</select>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label for="login_control" class="col-form-label"><?=_('Oturum Kontrolü Yapılsın mı?')?></label>
											<select class="form-control" name="login_control" id="login_control">
												<option value="1" <?=$page_detail['login_control'] == '1'?'selected':''?>><?=_('Evet')?></option>
												<option value="0" <?=$page_detail['login_control'] == '0'?'selected':''?>><?=_('Hayır')?></option>
											</select>
										</div>
									</div>
								</div>
							</div>
							<div class="col-6">
								<div class="form-group">
									<label for="pageAuth" class="col-form-label"><?=_('Yetkilendirme')?></label>
									<select class="form-control multiSelectBox" name="pageAuth[]" id="pageAuth" required multiple>
										<?php
											$allAuth = $keybmin->get_auth_lists();
											foreach($allAuth as $auth){
												?>
												<option value="<?=$auth['id']?>" <?=$auth['id'] == 1?'selected disabled':''?> <?=in_array($auth['id'], json_decode($page_detail['user_auth']))?'selected':''?>><?=$auth['auth_name']?></option>
												<?php
											}
										?>
									</select>
								</div>
							</div>
							<div class="col-12 text-right">
								<button class="btn btn-primary"><?=_('Güncelle')?></button>
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