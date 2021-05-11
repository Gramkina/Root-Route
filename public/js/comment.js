$(function () {

    $('#add_comment_btn').on('click', function(){
        $.post('/add-comment', $('#your_comment_form').serializeArray(), function (res) {
            if(res['status'] == 1){
                location.replace(res['url']);
            }
        })
    });

});
