let mammoth = require("mammoth-styled");
import Quill from "quill";
import "quill/dist/quill.snow.css";
import * as quillToWord from "quill-to-word";

$(function(){
    let token = $('meta[name="csrf-token"]').attr('content');
    let currentFileHashName = $('meta[name="current_file_hash_name"]').attr('content');

    let fileBase64 = $('#fileBase64').val();
    let bufView = Uint8Array.from(atob(fileBase64), c => c.charCodeAt(0));

    var toolbarOptions = [
        ['bold', 'italic', 'underline', 'strike'],
        ['blockquote', 'code-block'],
        [{ 'header': 1 }, { 'header': 2 }],
        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
        [{ 'script': 'sub'}, { 'script': 'super' }],
        [{ 'indent': '-1'}, { 'indent': '+1' }],
        [{ 'direction': 'rtl' }],
        [{ 'size': ['small', false, 'large', 'huge'] }],
        [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
        [{ 'color': [] }, { 'background': [] }],
        [{ 'font': [] }],
        [{ 'align': [] }],
        ['clean']
    ];

    let editor = new Quill('#editor', {
        modules: {
            toolbar: [
                [{ 'font': [] }, { 'size': [] }],
                [ 'bold', 'italic', 'underline', 'strike' ],
                [{ 'color': [] }, { 'background': [] }],
                [{ 'script': 'super' }, { 'script': 'sub' }],
                [{ 'header': '1' }, { 'header': '2' }, 'blockquote', 'code-block' ],
                [{ 'list': 'ordered' }, { 'list': 'bullet'}, { 'indent': '-1' }, { 'indent': '+1' }],
                [ 'direction', { 'align': [] }],
                [ 'link', 'image', 'video', 'formula' ],
                [ 'clean' ]
            ]
        },
        theme: 'snow'
    });
    mammoth.convertToHtml({arrayBuffer: bufView}).then((result)=>{
        let delta = editor.clipboard.convert(result.value);
        editor.setContents(delta, 'sielent');
    });

    $('#save_edit_btn').on('click', function(){
        let delta = editor.getContents();
        const  configuration  =  {
            exportAs : 'blob'
        }
        let doc = quillToWord.generateWord(delta, configuration);
        $.when(doc).done(function(docx){
            let fd = new FormData();
            fd.append('_token', token);
            fd.append('currentFileHashName', currentFileHashName);
            fd.append('file', docx);
            $.ajax({
                url: '/save-edit-file',
                method: 'post',
                data: fd,
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function(res){
                    if(res['status'] == 1){
                        location.replace(res['url']);
                    }
                }
            });
        })
    });
})

