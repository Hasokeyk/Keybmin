<?php

	if(isset($post) and !empty($post)){

		$zorunlu = [
			'page_name',
			'page_desc',
			'page_link',
			'short_code',
			'template',
			'page_status',
			'page_type',
			'icon_class'
		];
		if($keybmin->post_control($zorunlu) === true){
			$result = $keybmin->add_new_page($page_name, $page_desc, $page_link, $short_code, $page_status, $login_control, $template, $menu_status??0, $page_type, $_POST['pageAuth']??null, $parent_id, $icon_class);
		}
		else{
			$result = [
				'status'  => 'danger',
				'message' => _('Boş Bıraktınız')
			];
		}

	}

	$fileName = pathinfo((__FILE__))['filename'];

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
                                            <button class="btn btn-dark icon-selector" data-icon="fab fa-korvue" role="iconpicker"></button>
                                            <input type="hidden" name="icon_class" class="icon_class" value="fab fa-korvue">
                                        </span>
										<input id="page_name" name="page_name" type="text" class="form-control page_name" required>
									</div>
								</div>
								<div class="form-group">
									<label for="page_desc" class="col-form-label"><?=_('Açıklama')?></label>
									<input id="page_desc" name="page_desc" type="text" class="form-control" required>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label for="page_link" class="col-form-label"><?=_('Sayfa Linki')?></label>
											<input id="page_link" name="page_link" type="text" class="form-control page_link" value="?page=" readonly>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label for="short_code" class="col-form-label"><?=_('Kısa Kod')?></label>
											<input id="short_code" name="short_code" type="text" class="form-control short_code" value="" readonly>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label for="template" class="col-form-label"><?=_('Şablon')?></label>
											<select class="form-control" name="template" id="template" required>
												<?php
													$templates = glob($this->settings['THEMEDIR'].'/templates/*.php');
													foreach($templates as $template){
														$fileName = basename($template);
														?>
														<option value="<?=$fileName?>"><?=$fileName?></option>
														<?php
													}
												?>
											</select>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label for="page_status" class="col-form-label"><?=_('Durum')?></label>
											<select class="form-control" name="page_status" id="page_status" required>
												<option value="1"><?=_('Aktif')?></option>
												<option value="0"><?=_('Kapalı')?></option>
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label for="page_type" class="col-form-label"><?=_('Sayfa Türü')?></label>
											<select class="form-control" name="page_type" id="page_type">
												<option value="pages"><?=_('Pages')?></option>
												<option value="ajax"><?=_('Ajax')?></option>
												<option value="keybmin"><?=_('Keybmin')?></option>
											</select>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label for="menu_status" class="col-form-label"><?=_('Menüde Gözüksün mü?')?></label>
											<select class="form-control" name="menu_status" id="menu_status">
												<option value="1"><?=_('Evet')?></option>
												<option value="0"><?=_('Hayır')?></option>
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
														<option value="<?=$page['id']?>" data-short_code="<?=$page['shortcode']?>"><?=$page['title']?></option>
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
												<option value="1"><?=_('Evet')?></option>
												<option value="0"><?=_('Hayır')?></option>
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
												<option value="<?=$auth['id']?>" <?=$auth['id'] == 1?'selected disabled':''?>><?=$auth['auth_name']?></option>
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