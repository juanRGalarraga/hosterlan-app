import { 
    ContextMenu, 
    SimpleHash, 
    Table, 
    Div, 
    DOM,
    Input,
    Label
} from '../../components/main';
    
import Alert from '../../components/alert';

export default class AvailableDay {

    buttonAddDates
    inputSince
    inputTo
    contextMenu
    static dates = {}
    static datesInputs = []
    search
    tableDates = 'tableDates'
    form

    constructor(){
        this.getInputDates({sinceId: 'available_since', toId: 'available_to'});
        this.loadButtonAddDates('buttonAddDates');
        this.contextMenu = new ContextMenu({
            withModifier: false,
            deleteAction: function(clickeableZone){
                clickeableZone.remove();
                delete AvailableDay.dates[clickeableZone.id];
            }
        });

        this.contextMenu.createContextMenu();

        this.form = DOM.captureElement('publicationStep2Form');
        // this.search = new Search('table-search');
        // this.search.loadListener((input) => {
        //     ObjectHelper.searchPropertyByValue(input.value);
        // });
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

    loadButtonRemoveDates(buttonOrId){
        let button = DOM.captureElement(buttonOrId);
    
        button.onclick = () => {
            this.removeDates(DOM.$(button).attr('data-date'))
        }
    }

    addDates(dateSince = null, dateTo = null) {

        let since = dateSince ?? this.inputSince?.value;
        let to = dateTo ?? this.inputTo?.value;
    
        if ((typeof since != "string" || typeof to != "string")
            || (since.length < 1 || to.length < 1)) {
            return;
        }

        let [sinceDay, sinceMonth, sinceYear] = since.split('/');
        since = `${sinceDay}/${sinceMonth}/${sinceYear}`;

        let [toDay, toMonth, toYear] = to.split('/');
        to = `${toDay}/${toMonth}/${toYear}`;

        // let dateSinceObj = new Date(since).getTime();
        // let dateToObj = new Date(to).getTime();

        // if (dateSinceObj >= dateToObj) {
        //     return Alert.warning({title: 'Atención', text: 'La fecha de fin debe ser mayor a la fecha de inicio'});
        // }

        let dateMap = SimpleHash.generate(`${since}:${to}`);
        
        if (AvailableDay.dates.hasOwnProperty(dateMap)) {
            return;
        }

        this.createRow(dateMap, since, to);

        AvailableDay.dates[dateMap] = {since,to};
    }

    static getArrayDates() { 
        return Object.values(AvailableDay.dates);
    }

    createRow(id, dateSince, dateTo){
        let hashId = SimpleHash.generate(`${dateSince}:${dateTo}`)
        let inputClassName = 'w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600';
        let trAttributes = {
            class: 'bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600',
            id: hashId
        }
        let tdAttributes = {
            class: 'px-6 py-3',
        }
        let divAttributes = {
            class : 'flex items-center'
        }

        let row = 
        Table.tr( (tr) => {
            tr.td(

                Div.create( (div) => {
                    div.appendChild(Input.create(null, {id, type:'checkbox', class: inputClassName}))
                    div.appendChild(Label.create('checkbox', {class:'sr-only', for: id}))
                }, divAttributes ), tdAttributes)

            tr.th(dateSince, tdAttributes);

            tr.th(dateTo, tdAttributes);

        }, trAttributes);

        this.contextMenu.setClickeableZone(row)

        this.contextMenu.loadContextMenu();

        let inputSince = Input.create('availableDays', {name: `days[${hashId}][since]`, type:'text', hidden:'true', class: 'hidden', value:dateSince});
        let inputTo = Input.create('availableDays', {name: `days[${hashId}][to]`, type:'text', hidden:'true', class: 'hidden', value:dateTo});

        this.form.insertAdjacentElement('beforeend', inputSince);
        this.form.insertAdjacentElement('beforeend', inputTo);
        AvailableDay.datesInputs.push(inputSince);
        AvailableDay.datesInputs.push(inputTo);

        this.tableDates.appendChild(row);

        return row;
    }
}