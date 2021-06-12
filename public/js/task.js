$(function () {

    let detailBtn = $('.detailed_btn');
    let taskDescription = $('.task_description');

    $('.task_main_div').on('click', function () {
        detailBtn.attr('href', $(this).attr('ref'))
        taskDescription.html($(this).attr('desc'))
    })
})
