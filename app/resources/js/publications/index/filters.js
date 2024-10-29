import PublicationList from './list.js';
import ObjectHelper from '../../utilities/objectHelper.js';
import { Datepicker } from 'flowbite-datepicker';
import Search from '../../components/search.js';

class PublicationFilter extends PublicationList {

    search
    available_since
    available_to
    price_min
    price_max
    bathroomCount
    ubication
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
        this.available_since = document.getElementById('available_since')
        this.available_to = document.getElementById('available_to')
        this.price_min = document.getElementById('price_min')
        this.price_max = document.getElementById('price_max')
        this.bathroomCount = document.getElementById('bathroomCount')
        this.ubication = document.getElementById('ubication')
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
        this.appendToFilters('available_since',   this.available_since.value)
        this.appendToFilters('available_to',      this.available_to.value)
        this.appendToFilters('price_min',         this.price_min.value)
        this.appendToFilters('ubication',         this.ubication.value)
        this.appendToFilters('price_max',         this.price_max.value)
        this.appendToFilters('bathroomCount',     this.bathroomCount.value)
        this.appendToFilters('rentType',          this.rentType.value)
        this.appendToFilters('withPets',          this.withPets.value)
    }

    clearFilters(){
        this.filters = {};
        this.search.value = ''
        this.available_since.value = ''
        this.available_to.value = ''
        this.ubication.value = ''
        this.price_min.value = ''
        this.price_max.value = ''
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
}

let search = new Search('search');

if(search){
    let publicationList = new PublicationList;
    search.loadListener((input) => {
        publicationList.getList({search: input.value});
    });
}

document.addEventListener('DOMContentLoaded', e => {
  new PublicationFilter();
});