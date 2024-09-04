export default class Search {

    inputEl
    publicationList
    inputExists = false
    keyToSearch = 'Enter'

    constructor(inputId){

        if(typeof inputId != "string"){
            throw new Error("InputId must be a string");
        }

        this.inputEl = document.getElementById(inputId)
        
        if( !(this.inputEl instanceof HTMLInputElement) || this.inputEl.type != 'text'){
            this.inputExists = false;
            return;
        }
    }

    exists(){
        return this.inputExists;
    }

    setKeyToSearch(key){
        this.keyToSearch = key;
        return this
    }

    loadListener(callback){

        let thisInstance = this;
        if(typeof callback != "function"){
            throw new Error("Callback must be a function");
        }

        this.inputEl.onkeyup = function (event) {
            console.log(event.key);
            console.log(thisInstance.keyToSearch);
            
            if(event.key == thisInstance.keyToSearch){
                callback(thisInstance.inputEl)
            }
        }
    }
}