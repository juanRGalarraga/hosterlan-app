import PublicationList from "./publications/index/list";

export default class NavigationSearch {

    inputId = 'search'
    inputEl
    publicationList

    constructor(){
        this.inputEl = document.getElementById(this.inputId)
        if( !(this.inputEl instanceof HTMLInputElement) || this.inputEl.type != 'text'){
            return;
        }

        this.publicationList = new PublicationList
        this.loadListener();
    }

    loadListener(){
        let thisInstance = this
        this.inputEl.onkeyup = function(event){
            if(event.key == 'Enter'){
                thisInstance.publicationList.getList({search: event.target.value});
            }
        }
    }
}