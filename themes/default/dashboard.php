<?php

	global $keybmin;

	$fileName = pathinfo((__FILE__))['filename'];

	$csses = [];
	$jses  = [
		//$this->settings['THEMEPATH'].'assets/js/pages/dashboard.js',
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
		<section class="section">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">Default Layout</h4>
				</div>
				<div class="card-body">
					Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam, commodi? Ullam quaerat similique iusto temporibus, vero aliquam praesentium, odit deserunt eaque nihil saepe hic deleniti? Placeat delectus quibusdam ratione ullam!
				</div>
			</div>
		</section>
	</div>
	<?php
		require $this->settings['THEMEDIR']."/footer.php";
	?>
