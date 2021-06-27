<?php

	$zorunlu = $keybmin->get_control([
		'action',
		'auth_id'
	]);
	if($zorunlu === true and $action == 'del' and is_numeric($auth_id)){

		$askPage = $keybmin->db->query("SELECT * FROM kb_auth WHERE id = '".$auth_id."'");
		if($askPage->num_rows>0){

			$ai = $askPage->fetch_assoc();

			$del = $keybmin->db->query("DELETE FROM kb_auth WHERE id = '".$auth_id."'");
			if($del){
				$result = [
					'status'  => 'success',
					'message' => $ai['auth_name']._(' auth delete'),
				];
			}
			else{
				$result = [
					'status'  => 'danger',
					'message' => $ai['auth_name']._(' not auth delete'),
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
								<th scope="col">Yetki Adı</th>
								<th scope="col">Yetki Açıklaması</th>
								<th scope="col">Alt Yetkiler</th>
								<th scope="col">Olaylar</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$allPages = $keybmin->get_auth_lists();
								foreach($allPages as $p){
									?>
									<tr>
										<th scope="row"><?=$p['id']?></th>
										<td><?=$p['auth_name']?></td>
										<td><?=$p['auth_desc']?></td>
										<td>
											<?php
												$subAuth = $keybmin->get_auth_lists($p['id']);
												if($subAuth == null){
													echo '<div class="text-danger">'._('Alt Yetki').'</div>';
												}
												else{
													foreach($subAuth as $auth){
														echo $auth['auth_name']."\n </br>";
													}
												}
											?>
										</td>
										<td>
											<a href="?page=keybmin-auth-operations-auth-edit&auth_id=<?=$p['id']?>" class="btn btn-primary"><?=_('Edit')?></a>
											<a href="?page=<?=$page?>&action=del&auth_id=<?=$p['id']?>" class="btn btn-danger del-btn"><?=_('Del')?></a>
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