import PublicationList from './list.js';
import ObjectHelper from '../../utilities/objectHelper.js';
import { Datepicker } from 'flowbite-datepicker';

class PublicationFilter extends PublicationList {

    search
    publication_state
    available_since
    available_to
    price_min
    price_max
    roomCount
    bathroomCount
    rentType
    withPets
    filters = {}
    buttonApplyFilter
    buttonClearFilter

    constructor(){
        super()
        this.initFilters()
    }

    initFilters(){
        this.search = document.getElementById('search')
        this.publication_state = document.getElementById('publication_state')
        this.available_since = document.getElementById('available_since')
        this.available_to = document.getElementById('available_to')
        this.price_min = document.getElementById('price_min')
        this.price_max = document.getElementById('price_max')
        this.roomCount = document.getElementById('roomCount')
        this.bathroomCount = document.getElementById('bathroomCount')
        this.rentType = document.getElementById('rentType')
        this.withPets = document.getElementById('withPets')
        this.buttonApplyFilter = document.getElementById('buttonApplyFilter')
        this.buttonClearFilter = document.getElementById('buttonClearFilter')
        this.loadButtonApplyFilter()
        this.loadButtonClearFilter();

        //This is because the first time is not necessary to send date values
        this.available_since.value = '';
        this.available_to.value = '';
    }

    loadButtonApplyFilter(){
        let thisInstance = this
        this.buttonApplyFilter.onclick = function(event){
            thisInstance.getInputValues();
            if( !ObjectHelper.isEmpty(thisInstance.filters) ){
                thisInstance.getList(thisInstance.filters)
            }
        }
    }

    loadButtonClearFilter(){
        let thisInstance = this
        this.buttonClearFilter.onclick = function(event){
            thisInstance.clearFilters();
            thisInstance.getList();
        }
    }

    getInputValues(){
        this.appendToFilters('search',            this.search.value)
        this.appendToFilters('publication_state', this.publication_state.value)
        this.appendToFilters('available_since',   this.available_since.value)
        this.appendToFilters('available_to',      this.available_to.value)
        this.appendToFilters('price_min',         this.price_min.value)
        this.appendToFilters('price_max',         this.price_max.value)
        this.appendToFilters('roomCount',         this.roomCount.value)
        this.appendToFilters('bathroomCount',     this.bathroomCount.value)
        this.appendToFilters('rentType',          this.rentType.value)
        this.appendToFilters('withPets',          this.withPets.value)
    }

    clearFilters(){
        this.filters = {};
        this.search.value = ''
        this.available_since.value = ''
        this.available_to.value = ''
        this.price_min.value = ''
        this.price_max.value = ''
        this.publication_state[0].selected = true;
        this.roomCount[0].selected = true;
        this.bathroomCount[0].selected = true;
        this.rentType[0].selected = true;
        this.withPets.value = 'false'
        this.withPets.checked = false
    }

    appendToFilters(name, value){
        
        if(value.length < 1 || name.length < 1){
            return;
        }
        
        this.filters[name] = value;
        /**
         * TODO append to localstorage for persistence.
         */
    }

    loadDatePicker(){
        // set the target element of the input field
        const $datepickerEl = document.getElementById('dateRangePicker');

       // optional options with default values and callback functions
        const options = {
            defaultDatepickerId: null,
            autohide: false,
            format: 'dd/mm/yyyy',
            maxDate: null,
            minDate: null,
            orientation: 'bottom',
            buttons: false,
            autoSelectToday: false,
            title: null,
            rangePicker: false,
        };

        const instanceOptions = {
            id: 'dateRangePicker',
            override: true
        };
        const datepicker = new Datepicker($datepickerEl, options, instanceOptions);
    }

    sum(a, b) {
        
    }
}

document.addEventListener('DOMContentLoaded', e => {
  new PublicationFilter();
});