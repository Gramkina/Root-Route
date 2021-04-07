$(function (){
    $('.option-language-element').on('click', function (){
        let lang = $(this).attr('lang');
        let token = $('meta[name="csrf-token"]').attr('content');
        $.get('/setLanguage', {lang: lang, _token: token }, function(){
            location.reload();
        })
    })
})
