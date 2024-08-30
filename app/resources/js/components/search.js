export default class Search {

    inputEl
    publicationList
    keyToSearch = 'Enter'

    constructor(inputId){

        if(typeof inputId != "string"){
            throw new Error("InputId must be a string");
        }

        this.inputEl = document.getElementById(inputId)
        if( !(this.inputEl instanceof HTMLInputElement) || this.inputEl.type != 'text'){
            return;
        }
    }

    setKeyToSearch(key){
        this.keyToSearch = key;
        return this
    }

    loadListener(callback){

        if(typeof callback != "function"){
            throw new Error("Callback must be a function");
        }

        this.inputEl.onkeyup = function(event){
            if(event.key == keyToSearch){
                callback(inputEl)
            }
        }
    }
}