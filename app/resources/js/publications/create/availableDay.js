import { ContextMenu, SimpleHash, Table, Div, Input, Label } from '../../components/component';

export default class AvailableDay {

    buttonAddDates
    inputSince
    inputTo
    contextMenu
    dates = {}

    constructor(){
        this.getInputDates({sinceId: 'available_since', toId: 'available_to'});
        this.loadButtonAddDates('buttonAddDates');
        this.contextMenu = new ContextMenu();
        this.contextMenu.createContextMenu();
        this.insertRow();
        
    }

    loadOptionsContextMenu() {
        this.contextMenu.addDeleteAction(function () {
            
        });

        this.contextMenu.addModifyAction(function () {
            
        });
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

        let dateMap = SimpleHash.generate(`${since}:${to}`);
        
        if (this.dates.hasOwnProperty(dateMap)) {
            return;
        }

        let value = `${since} hasta ${since}`;
        // this.createInput('available_days', 'availableDays[]', dateMap, value);

        this.dates[dateMap] = {since,to};
    }

    insertRow(root){
        let inputClassName = 'w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600';

        let row = 
        Table.tr( (tr) => {
            tr.td(
                Div.create( (div) => {
                    div.appendChild(Input.create({id: '', type:'checkbox', class: inputClassName}))
                    div.appendChild(Label.create('checkbox', {class:'sr-only'}))
                })
            )
            tr.td("10/28/32");
            tr.td("10/28/32");
        });
        
        console.log(row);
        /* <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                <td class="w-4 p-4">
                    <div class="flex items-center">
                        <input id="checkbox-table-search-1" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                    </div>
                </td>
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    Apple MacBook Pro 17"
                </th>
                <td class="px-6 py-4">
                    Silver
                </td>
                <td class="px-6 py-4">
                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">{{__('Borrar')}}</a>
                </td>
        // </tr> */
    }
    
    createInput(rootId, name, id, value){

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
        input.setAttribute('id', SimpleHash.generate(value));

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