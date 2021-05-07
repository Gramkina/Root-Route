$(function() {

    let token = $('meta[name="csrf-token"]').attr('content');
    let path = $('meta[name="path"]').attr('content');

    let createFolderDialog = new Dialog('crt_folder_dlg', {
        title: 'Введите название папки',
    });
    let uploadFileDialog = new Dialog('upload_file_dlg', {
        title: 'Загрузить файл',
    });

    $('#create_folder_btn').on('click', function(){
        $('.crt_folder_err').empty();
        createFolderDialog.openDialog();
    });
    $('#upload_file_btn').on('click', function(){
        $('.upload_file_err').empty();
        uploadFileDialog.openDialog();
    });
    $('#upload_file_input').on('change', function(e){
        $('#file_name').html($(this)[0].files[0].name);
    });

    $('#submit_crt_folder').on('click', function(e){
        $.post('/createFolder', $(this).parent().serializeArray().concat({name: '_token', value: token}), function(res) {
            $('.crt_folder_err').empty();
            switch(res['status']){
                case 0:{
                    $('.crt_folder_err').append(res['errors']);
                    break;
                }
                case 1:{
                    location.replace(res['url']);
                }
            }
        });
    });
    $('#submit_upload_file').on('click', function(e){
        let fd = new FormData($('#upload_file_form')[0]);
        fd.append('file', $('#upload_file_input')[0].files[0]);
        fd.append('_token', token);
        $.ajax({
            url: '/uploadFile',
            method: 'post',
            data: fd,
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(res){
                $('.upload_file_err').empty();
                switch(res['status']){
                    case 0:{
                        $('.upload_file_err').append(res['errors']);
                        break;
                    }
                    case 1:{
                        location.replace(res['url']);
                    }
                }
            },
        });
    });
});
