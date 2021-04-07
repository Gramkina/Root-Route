$(function(){

    $('input[name=role]').on('change', function(){
        let role = $(this).val();
        if(role == 'admin'){
            $('#form_admin').show();
            $('#form_user').hide();
        }
        else if(role = 'user'){
            $('#form_user').show();
            $('#form_admin').hide();
        }
        $('.error_block').css({'display': 'none'});
        $('.success_block').css({'display': 'none'});
    })

    let token = $('meta[name="csrf-token"]').attr('content');

    $('.add_user_btn').on('click', function (){
        let role = $('input[name=role]:checked').val();
        switch(role){
            case 'user':{
                $.post('/users', $(this).parent().parent().serializeArray().concat({name: '_token', value: token}), function(res){resultAdd(res)});
                break;
            }
            case 'admin':{
                $.post('/accounts', $(this).parent().parent().serializeArray().concat({name: '_token', value: token}), function(res){resultAdd(res)});
                break;
            }
        }
    });
    function resultAdd(res){
        $('.error_block').css({'display': 'none'});
        $('.success_block').css({'display': 'none'});
        if(res['status'] == 0) {
            $('.error_block').css({'display': 'inline-block'}).children().empty();
            $.each(res['errors'], function(index, value){
                $('.error_block').children().append('<li>'+value+'</li>');
            });
        }
        else if(res['status'] == 1){
            $('.success_block').css({'display': 'inline-flex'});
            $('.success_message').empty().append(res['message']);
        }
    }
});
