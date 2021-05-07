$(function(){

    let currentFileHashName = $('meta[name="current_file_hash_name"]').attr('content');

    let selectVersionDialog = new Dialog('select-ver-dlg', {
        title: 'Список версий файла',
    });
    let addVersionDialog = new Dialog('add_version_dlg', {
        title: 'Добавить версию файла',
    })

    $('#select-ver-btn').on('click', function () {
        selectVersionDialog.openDialog();
    })
    $('#add_ver_btn').on('click', function () {
        $('.add_version_err').empty();
        addVersionDialog.openDialog();
    })

    $('#submit_add_ver').on('click', function(){
        let fd = new FormData($('#add_ver_form')[0]);
        fd.append('file', $('#add_ver_file_input')[0].files[0]);
        $.ajax({
            url: '/addFileVersion',
            method: 'post',
            data: fd,
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(res){
                if(res['status'] == '0'){
                    $('.add_version_err').empty();
                    $('.add_version_err').append(res['errors']);
                }
                else if(res['status'] == '1'){
                    location.replace(res['url']);
                }
            }
        });
    });

})
