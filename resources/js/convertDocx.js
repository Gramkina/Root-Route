let mammoth = require("mammoth-styled");
import Quill from "quill";
import "quill/dist/quill.snow.css"

$(function(){

    let fileBase64 = $('#fileBase64').val();
    let bufView = Uint8Array.from(atob(fileBase64), c => c.charCodeAt(0));

    let editor = new Quill('#editor', {
        modules: {
            toolbar: false
        },
        readOnly: true,
        theme: 'snow'
    });
    mammoth.convertToHtml({arrayBuffer: bufView}).then((result)=>{
        let delta = editor.clipboard.convert(result.value);
        editor.setContents(delta, 'sielent');
    });
})

