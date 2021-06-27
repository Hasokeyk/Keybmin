<footer class="container">
	<div class="footer clearfix mb-0 text-muted">
		<div class="float-start">
			<p><?=date('Y')?> © Keybmin</p>
		</div>
		<div class="float-end">
			<p>Yazan Çizen
				<span class="text-danger"><i class="bi bi-heart"></i></span>
				Hasan Yüksektepe
			</p>
		</div>
	</div>
</footer>
<?php
	global $keybmin;
	$keybmin->js_minify($globalJs??null, 'global');
	$keybmin->js_minify($jses??null, $fileName);
?>
</body></html>