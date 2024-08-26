import ContextMenu from "../../contextMenu";

export default class AvailableDay {

    buttonAddDates
    inputSince
    inputTo
    contextMenu

    constructor(){
        this.getInputDates({sinceId: 'available_since', toId: 'available_to'});
        this.loadButtonAddDates('buttonAddDates');
        this.contextMenu = new ContextMenu();
        this.contextMenu.createContextMenu();
    }

    getInputDates({sinceId, toId}){
        this.inputSince = document.getElementById(sinceId);
        if( !(this.inputSince instanceof HTMLInputElement) ){
            return console.error("inputSince not found");
        }

        this.inputTo = document.getElementById(toId);
        if( !(this.inputTo instanceof HTMLInputElement) ){
            return console.error("inputTo not found");
        }
    }

    loadButtonAddDates(buttonId){
        let thisInstance = this;

        this.buttonAddDates = document.getElementById(buttonId);
        if( !(this.buttonAddDates instanceof HTMLButtonElement) ){
            return console.error("buttonAddDates not found");
        }

        this.buttonAddDates.onclick = () => {
            thisInstance.addDates();
        }
    }

    addDates(){
        let since = this.inputSince?.value;
        let to = this.inputTo?.value;
    
        if((typeof since != "string" || typeof to != "string")
            || (since.length < 1 || to.length < 1)){
            return;
        }

        let value = `${since} hasta ${since}`;
        this.createInput('available_days', 'availableDays[]', value);
    }
    
    createInput(rootId, name, value){

        let rootElement = document.getElementById(rootId);
        if( !(rootElement instanceof HTMLDivElement) ){
            return console.error("rootElement div not found");
        }

        let input = document.createElement('input');
        input.setAttribute('readonly', 'true');
        input.setAttribute('type', 'text');
        input.setAttribute('name', `${name}`);
        input.setAttribute('value', value);
        input.setAttribute('title', value);
        input.className = 
        `availableDaysClickeable rounded-none rounded-r-lg 
        bg-gray-50 border text-gray-900 
        focus:ring-blue-500 focus:border-blue-500 
        block flex-1  w-full text-sm border-gray-300 
        p-2.5  dark:bg-gray-700 dark:border-gray-600 
        dark:placeholder-gray-400 dark:text-white 
        dark:focus:ring-blue-500 dark:focus:border-blue-500 
        minimal-input ml-2`;

        rootElement.appendChild(input);
        this.contextMenu.setClickeableZone(input);
        this.contextMenu.loadContextMenu();
    }
}