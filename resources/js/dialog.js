class Dialog{

    constructor(dialogContent, options = null) {
        this.content = document.getElementById(dialogContent);
        this.isShow = false;

        this.dialogBackground = document.getElementsByClassName('dialog_background')[0];
        if(typeof(this.dialogBackground) != 'undefined' && this.dialogBackground != null){
            this.wrapContent(this.dialogBackground, this.content);
        }
        else{
            this.dialogBackground = document.createElement('div');
            this.dialogBackground.setAttribute('class', 'dialog_background');
            this.wrapContent(this.dialogBackground, this.content);
        }

        this.content.setAttribute('class', 'dialog-main-block');
        this.content.style.display = 'none';

        if(options) {
            if (options['title']) {
                let title = document.createElement('div');
                title.setAttribute('class', 'dialog_title');
                this.closeButton = document.createElement('img');
                this.closeButton.setAttribute('class', 'dialog_close_btn');
                this.closeButton.setAttribute('src', '/img/close.svg');
                title.prepend(this.closeButton);
                title.prepend(options['title']);
                this.content.prepend(title);
            }
        }

        this.dialogBackground.addEventListener('click', this.hideDialogBackground.bind(this));
        this.closeButton.addEventListener('click', this.closeDialog.bind(this));

    }

    hideDialogBackground(e){
        if(e.target.className === 'dialog_background'){
            this.closeDialog();
        }
    }

    closeDialog(){
        if(this.isShow){
            this.isShow = false;
            this.dialogBackground.style.display = 'none';
            this.content.style.display = 'none';
        }
    }

    openDialog(){
        if(!this.isShow){
            this.isShow = true;
            this.dialogBackground.style.display = 'flex';
            this.content.style.display = 'block';
        }
    }

    wrapContent(parent, child){
        this.content.parentNode.insertBefore(parent, child);
        parent.appendChild(child);
    }

}

module.exports = Dialog;
