$(function(){

    let token = $('meta[name="csrf-token"]').attr('content');

    $('.btn-login').on('click', function (){
        $.post('/loginUser', $(this).parent().serializeArray().concat({name: '_token', value: token}), function(res){
            $('.error_block').css({'display': 'none'});
            if(res['status'] == 0) {
                $('.error_block').css({'display': 'inline-block'}).empty();
                $.each(res['errors'], function(index, value){
                    $('.error_block').append('<div>'+value+'</div>');
                });
            }
            else if(res['status'] == 1)
                location.replace(res['url']);
        });
    });
});
