export default class PublicationShow {
    buttonCloseId = 'buttonCloseView';
    buttonClose;

    constructor(){
        this.loadButtonClose(this.buttonCloseId);
    }

    loadButtonClose(id){
        this.buttonClose = document.getElementById(id);
        this.buttonClose.onclick = () => {
            this.returnToList();
        }
    }

    returnToList(){

        const viewList = () => {
            window.history.back();
        }

        if (!document.startViewTransition) {
            viewList();
            return;
        }
    
        document.startViewTransition(() => viewList());
    }

}

document.addEventListener('DOMContentLoaded', (ev) => {
    new PublicationShow;
});