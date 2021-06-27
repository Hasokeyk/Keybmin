jQuery(function($){

    //GET DEVICE LIST
    $('.get_devices_btn').on('click', function(){

        var form_validate = frm_validate('.device_list_frm');
        if(form_validate){
            var old_text = $(this).val();
            var button = $(this);
            $(this).prop('disabled',true).val('Lütfen Bekleyin...');
            $.post('?page=open-menu-ajax', $('.device_list_frm').serialize(), function(e){
                if(e.status=='success'){
                    $('.devices_list').show();
                    $('.devices_list .devices_list_content').html(e.data);
                    $('.devices_list .token').val(e.token);
                }
                else{
                    swal.fire('İşlem', e.message, 'warning')
                }
                $(button).prop('disabled',false).val(old_text);
            })
        }
        else{
            swal.fire('İşlem', 'Lütfen tüm alanları doldurun', 'warning')
        }

        return false;
    })
    //GET DEVICE LIST

    //DEVICE REMOVE
    $(document).on('click', '.device_remove_btn', function(){

        var id = $(this).data('id');
        var token = $('.token').val();
        var md = $('.md').val();
        var mdm = $('.mdm').val();
        var div = $(this).parent().parent();

        $.post('?page=open-menu-ajax', {
            action:'remove_device',
            id,
            token,
            md,
            mdm
        }, function(e){
            if(e.status == 'success'){
                $(div).remove();
            }else{
                swal.fire('İşlem', e.message, 'warning')
            }
        })

    })
    //DEVICE REMOVE

    //FORM VALIDATE
    function frm_validate(class_name = ''){

        var input_c = $(class_name+' input[type="text"]:required').length;
        if(input_c>0){
            var input = false;
            $(class_name+' input[type="text"]:required').each(function(i, e){

                var value = $(e).val();
                if(value!=''){
                    input = true;
                    $(e).addClass('border-success').removeClass('border-danger');
                }
                else{
                    $(e).addClass('border-danger').removeClass('border-success');
                }

            })
        }
        else{
            input = true;
        }

        var textarea_c = $(class_name+' textarea:required').length;
        if(textarea_c>0){
            var textarea = false;
            $(class_name+' textarea:required').each(function(i, e){

                var value = $(e).val();
                if(value!=''){
                    textarea = true;
                    $(e).addClass('border-success').removeClass('border-danger');
                }
                else{
                    $(e).addClass('border-danger').removeClass('border-success');
                }

            })
        }
        else{
            textarea = true
        }

        var select_c = $(class_name+' select:required').length;
        if(select_c>0){
            var select = false;
            $(class_name+' select:required').each(function(i, e){

                var value = $(e).val();
                if(value!=''){
                    select = true;
                    $(e).addClass('border-success').removeClass('border-danger');
                }
                else{
                    $(e).addClass('border-danger').removeClass('border-success');
                }

            })
        }
        else{
            select = true;
        }

        var input_file_c = $(class_name+' input[type="file"]:required').length;
        if(input_file_c>0){
            var input_file = false;
            $(class_name+' input[type="file"]:required').each(function(i, e){
                var value = $(e).val();
                if(value!=''){
                    input_file = true;
                    $(e).addClass('border-success').removeClass('border-danger');
                }
                else{
                    $(e).addClass('border-danger').removeClass('border-success');
                }
            })
        }
        else{
            input_file = true;
        }

        if(input && textarea && input_file && select){
            return true;
        }
        else{
            return false;
        }
    }

    //FORM VALIDATE
});
