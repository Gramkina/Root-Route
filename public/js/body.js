$(function () {

    let token = $('meta[name="csrf-token"]').attr('content');

    $('.logout_button').on('click', function (){
        $.get('/logout', {_token: token}, function(res){
            location.replace(res)
        });
    });
})
