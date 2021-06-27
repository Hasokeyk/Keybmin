jQuery(function($){

	try{
		$('.multiSelectBox').multiSelect({
			selectAll: true
		});
	}catch(e){

	}

	try{
		$('.icon-selector').iconpicker().on('change', function(e){
			$('.icon_class').val(e.icon);
		});
	}catch(e){
		console.log(222)
	}

	//PAGE CREAT
	$('.page_name').on('keyup',function(){
		var page_name = $(this).val();

		var selectshort_code = $('.parent_id option:selected').data('short_code')+'-';
		var shortCode = (selectshort_code+toSeoUrl(page_name)).trimLeft('-');
		$('.page_link').val('?page='+shortCode);
		$('.short_code').val(shortCode);

	})

	$('.parent_id').on('change',function(){
		var page_name = toSeoUrl($('.page_name').val());
		var selectshort_code = $(' option:selected',this).data('short_code');
		if(selectshort_code == 0){
			selectshort_code = page_name;
		}else{
			selectshort_code = selectshort_code+'-'+page_name;
		}
		$('.page_link').val('?page='+selectshort_code);
		$('.short_code').val(selectshort_code);
	})
	//PAGE CREAT

	//DEL BUTTON
	$('.del-btn').on('click',function(){

		var src = $(this).attr('href');
		Swal.fire({
			title: 'Emin Misiniz?',
			text: "Bu işlem geri getirilemez!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Sil gitsin',
			cancelButtonText: 'Tekrar düşüneyim...'
		}).then((result) => {
			if (result.value) {
				window.location = src;
			}
		})

		return false;

	})
	//DEL BUTTON

	//INSTALL DB TYPE
	$('.dbtype').on('change',function(){
		var type = $(this).val();

		var port = '3360';
		if(type == 'mysqli'){
			port = '3306';
		}else if(type == 'postgresql'){
			port = '5432';
		}
		$('.port').val(port);

	})
	//INSTALL DB TYPE

})

function toSeoUrl(text) {
	var trMap = {
        'çÇ':'c',
        'ğĞ':'g',
        'şŞ':'s',
        'üÜ':'u',
        'ıİ':'i',
        'öÖ':'o'
    };
    for(var key in trMap) {
        text = text.replace(new RegExp('['+key+']','g'), trMap[key]);
    }
    return  text.replace(/[^-a-zA-Z0-9\s]+/ig, '') // remove non-alphanumeric chars
                .replace(/\s/gi, "-") // convert spaces to dashes
                .replace(/[-]+/gi, "-") // trim repeated dashes
                .toLowerCase();
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