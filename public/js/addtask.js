$(function () {
    let countTask = 1;
    let executerList = $('#executorList').clone().html();
    let token = $('meta[name="csrf-token"]').attr('content');

    $('.add_new_task').on('click', function () {
        $(this).before('<div class="task_block"><form id="form'+countTask+'">\n<div class="title_task"><img src="http://127.0.0.1:8000/img/tasks/task_type_1.svg">Подзадача '+(countTask+1)+'</div>\n<input type="text" name="taskName" placeholder="Название задачи">\n<textarea name="taskDescription" placeholder="Описание задачи"></textarea>\n<div class="title_field">Тип задачи</div>\n            <select form="form'+countTask+'" name="type">\n                <option selected disabled>Выберите тип задачи</option>\n                <option value="Запрос">Запрос</option>\n                <option value="Запрос на подпись">Запрос на подпись</option>\n                <option value="Информация">Информация</option>\n            </select>\n            <div class="title_field">Дата начала задания</div>\n            <input name="start_date" type="date">\n            <div class="title_field">Дата окончания задания</div>\n            <input name="finish_date" type="date">\n            <div class="title_field">Исполнитель задания</div>\n<select form="form'+(countTask++)+'" name="executor">      '+executerList+'               \n        </select></form>\n    </div>')
    })

    $('#add_task').on('click', function(){
        let arraygl = {'_token': token, 'sharedName': $('#sharedName').val(), 'sharedDescription': $('#sharedDescription').val()};
        let vrarray = {};
        $('form').each(function(i){
            let array = $(this).serializeArray();
            let filesArray = []
            let vvaray = {};
            $.each(array, function(i){
                if(this.name == 'files'){
                    filesArray.push(this.value);
                }
                else {
                    vvaray[this.name] = this.value;
                }
            })
            vvaray['files'] = filesArray;
            vrarray[i] = vvaray;
        });
        arraygl['data'] = vrarray;
        $.post('/task/add', arraygl, function(res){
            console.log(res)
        });
    });

})
