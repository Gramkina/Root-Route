$(function(){
    let token = $('meta[name="csrf-token"]').attr('content');
    let path = $('meta[name="path"]').attr('content');
    $('#create_folder_btn').on('click', function(){
        $('.crt_folder_err').empty();
        $('.blk_scr_dlg').css('display', 'flex');
    });
    $('.blk_scr_dlg').on('click', function(e){
        if(e.target.className == 'blk_scr_dlg') {
            $('.blk_scr_dlg').css('display', 'none');
        }
    });
    $('.dlg_close_btn').on('click', function(){
        $('.blk_scr_dlg').css('display', 'none');
    });
    $('#submit_crt_folder').on('click', function(e){
        $.post('/createFolder', $(this).parent().serializeArray().concat({name: '_token', value: token}), function(res) {
            $('.crt_folder_err').empty();
            switch(res['status']){
                case 0:{
                    console.log(res);
                    $('.crt_folder_err').append(res['errors']);
                    break;
                }
                case 1:{
                    location.replace(res['url']);
                }
            }
        });
    });
    $('#uploadFile').on('change', function(e){
        let fd = new FormData();
        fd.append('file', $(this)[0].files[0]);
        fd.append('_token', token);
        fd.append('path', path);
        $.ajax({
            url: '/uploadFile',
            method: 'post',
            data: fd,
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(res){
                console.log(res);
            },
        });
    });
});
