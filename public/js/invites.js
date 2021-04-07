$(function(){
    let token = $('meta[name="csrf-token"]').attr('content');
    $('.context_menu_btn').on('click', function(){
        $('.context_menu').not($(this).siblings('.context_menu')).hide();
        $(this).siblings('.context_menu').toggle();
    })
    $(document).on('click', function(e){
        if(e.target.className != 'context_menu_btn' && e.target.className != 'context_menu')
            $('.context_menu').hide();
    });
});
