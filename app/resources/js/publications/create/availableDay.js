import { 
    ContextMenu, 
    SimpleHash, 
    Table, 
    Div, 
    Input,
    Anchor,
    Search,
    ObjectHelper,
    Label } from '../../components/component';

export default class AvailableDay {

    buttonAddDates
    inputSince
    inputTo
    contextMenu
    dates = {}
    search
    tableDates = 'tableDates'

    constructor(){
        this.getInputDates({sinceId: 'available_since', toId: 'available_to'});
        this.loadButtonAddDates('buttonAddDates');
        this.contextMenu = new ContextMenu();
        this.contextMenu.createContextMenu();

        // this.search = new Search('table-search');
        // this.search.loadListener((input) => {
        //     ObjectHelper.searchPropertyByValue(input.value);
        // });
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

        this.tableDates = document.getElementById(this.tableDates);
        if( !(this.tableDates instanceof HTMLTableSectionElement) ){
            return console.error("tableDates must be an HTMLTableSectionElement instace");
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

        let row = this.createRow(dateMap, since, to);

        this.tableDates.appendChild(row);

        this.dates[dateMap] = {since,to};
    }

    createRow(id, dateSince, dateTo){
        let inputClassName = 'w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600';
        let trAttributes = {
            class: 'bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600',
        }
        let tdAttributes = {
            class: 'w-4 p-4'
        }
        let divAttributes = {
            class : 'flex items-center'
        }

        let parent = this

        let row = 
        Table.tr( (tr) => {
            tr.td(

                Div.create( (div) => {
                    div.appendChild(Input.create({id, type:'checkbox', class: inputClassName}))
                    div.appendChild(Label.create('checkbox', {class:'sr-only', for: id}))
                }, divAttributes ),

            tdAttributes )

            tr.th(dateSince, {scope:'row', class:'px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white'});

            tr.th(dateTo, {class:'px-6 py-4'});

            tr.td(Anchor.create('Borrar', {class:'font-medium text-blue-600 dark:text-blue-500 hover:underline'}));
        },
        trAttributes);
        console.log(row);
        
        return row;
    }
}