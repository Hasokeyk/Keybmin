jQuery(function($){

	$('.multiSelectBox').multiSelect({
		selectAll: true
	});

	//PAGE CREAT
	$('.pageName').on('keyup',function(){
		var pageName = $(this).val();

		var selectPageShortcode = $('.parentPageID option:selected').data('pageshortcode');
		var shortCode = ((selectPageShortcode??'')??+'-')+toSeoUrl(pageName);
		$('.pageLink').val('?page='+shortCode);
		$('.pageShortcode').val(shortCode);

	})

	$('.parentPageID').on('change',function(){
		var selectPageShortcode = $(' option:selected',this).data('pageshortcode');
		var pageName = toSeoUrl($('.pageName').val());
		$('.pageLink').val('?page='+selectPageShortcode+'-'+pageName);
		$('.pageShortcode').val(selectPageShortcode+'-'+pageName);
	})
	//PAGE CREAT

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