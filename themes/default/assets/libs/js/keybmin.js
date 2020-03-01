jQuery(function($){

	$('.multiSelectBox').multiSelect({
		selectAll: true
	});

	$('.icon-selector').iconpicker({
		icon:'fab fa-korvue'
	}).on('change', function(e){
		$('.iconClass').val(e.icon);
	});

	//PAGE CREAT
	$('.pageName').on('keyup',function(){
		var pageName = $(this).val();

		var selectPageShortcode = $('.parentPageID option:selected').data('pageshortcode')+'-';
		var shortCode = (selectPageShortcode+toSeoUrl(pageName)).trimLeft('-');
		$('.pageLink').val('?page='+shortCode);
		$('.pageShortcode').val(shortCode);

	})

	$('.parentPageID').on('change',function(){
		var pageName = toSeoUrl($('.pageName').val());
		var selectPageShortcode = $(' option:selected',this).data('pageshortcode');
		if(selectPageShortcode == 0){
			selectPageShortcode = pageName;
		}else{
			selectPageShortcode = selectPageShortcode+'-'+pageName;
		}
		$('.pageLink').val('?page='+selectPageShortcode);
		$('.pageShortcode').val(selectPageShortcode);
	})
	//PAGE CREAT

	//DEL BUTTON
	$('.del-btn').on('click',function(){

		var src = $(this).attr('href');
		Swal.fire({
			title: 'Are you sure?',
			text: "You won't be able to revert this!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, delete it!'
		}).then((result) => {
			if (result.value) {
				window.location = src;
			}
		})

		return false;

	})
	//DEL BUTTON

})

function toSeoUrl(url) {
	return url.toString()               // Convert to string
		.normalize('NFD')               // Change diacritics
		.replace(/[\u0300-\u036f]/g,'') // Remove illegal characters
		.replace(/\s+/g,'-')            // Change whitespace to dashes
		.toLowerCase()                  // Change to lowercase
		.replace(/&/g,'-and-')          // Replace ampersand
		.replace(/[^a-z0-9\-]/g,'')     // Remove anything that is not a letter, number or dash
		.replace(/-+/g,'-')             // Remove duplicate dashes
		.replace(/^-*/,'')              // Remove starting dashes
		.replace(/-*$/,'');             // Remove trailing dashes
}

String.prototype.trimLeft = function(charlist) {
	if (charlist === undefined)
		charlist = "\s";

	return this.replace(new RegExp("^[" + charlist + "]+"), "");
};

String.prototype.trimRight = function(charlist) {
	if (charlist === undefined)
		charlist = "\s";

	return this.replace(new RegExp("[" + charlist + "]+$"), "");
};