import PublicationList from './list.js';
import DateRangePicker from 'flowbite-datepicker/DateRangePicker';
import Datepicker from 'flowbite-datepicker/Datepicker';

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
    filters = []
    buttonApplyFilter

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
        this.loadButtonApplyFilter()
    }

    loadButtonApplyFilter(){
        let thisInstance = this
        this.buttonApplyFilter.onclick = function(event){
            thisInstance.getInputValues();
        }
    }

    getInputValues(){
        this.filters.push({search:            this.search.value})
        this.filters.push({publication_state: this.publication_state.value})
        this.filters.push({available_since:    this.available_since.value})
        this.filters.push({available_to:      this.available_to.value})
        this.filters.push({price_min:         this.price_min.value})
        this.filters.push({price_max:         this.price_max.value})
        this.filters.push({roomCount:         this.roomCount.value})
        this.filters.push({bathroomCount:     this.bathroomCount.value})
        this.filters.push({rentType:          this.rentType.value})
        this.filters.push({withPets:          this.withPets.value})
    }
}

document.addEventListener('DOMContentLoaded', e => {
  new PublicationFilter();
});