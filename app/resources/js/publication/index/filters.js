import PublicationList from './list.js';
import DateRangePicker from 'flowbite-datepicker/DateRangePicker';
import Datepicker from 'flowbite-datepicker/Datepicker';

class PublicationFilter extends PublicationList {

    inputPearch = null;
    inputPublicationState = null;
    inputPvailableFrom = null;
    inputPvailableTo = null;
    inputPriceMin = null;
    inputPriceMax = null;
    inputPoomCount = null;
    inputPathroomCount = null;
    inputPentType = null;
    inputPithPets = null;

    constructor(){
        super();
        this.initInputsFilter();
        this.loadDaterangePicker();
    }

    initInputsFilter(){
        this.search = document.getElementById('search');
        this.publication_state = document.getElementById('publication_state');
        this.available_from = document.getElementById('available_from');
        this.available_to = document.getElementById('available_to');
        this.price_min = document.getElementById('price_min');
        this.price_max = document.getElementById('price_max');
        this.roomCount = document.getElementById('roomCount');
        this.bathroomCount = document.getElementById('bathroomCount');
        this.rentType = document.getElementById('rentType');
        this.withPets = document.getElementById('withPets');
        this.initEvents();
    }

    initEvents(){

        let thisObj = this;
    
        const applyFilter = (filter) => {
          thisObj.getList(filter);
        }
    
        this.search.onkeyup = function(ev){
          if(ev.key == PublicationList.KEY_ENTER) {
            applyFilter({search: ev.target.value});
          }
        }
    
        this.publication_state.onchange = (ev) => {
          applyFilter({state: ev.target.value});
        };

        this.roomCount.onchange = (ev) => {
          applyFilter({roomCount: ev.target.value});
        };
        this.bathroomCount.onchange = (ev) => {
          applyFilter({bathroomCount: ev.target.value});
        };
        this.rentType.onchange = (ev) => {
          applyFilter({rentType: ev.target.value});
        };
        this.withPets.onchange = (ev) => {
          applyFilter({withPets: ev.target.value});
        };
    
        this.price_min.onkeyup = (ev) => {
          if(ev.key == PublicationList.KEY_ENTER) {
            applyFilter({price_min: ev.target.value});
          }
        };
    
        this.price_max.onkeyup = (ev) => {
          if(ev.key == PublicationList.KEY_ENTER) {
            applyFilter({price_max: ev.target.value});
          }
        };
    }

    loadDaterangePicker(){
        let dateRangePicker = document.getElementById('available_from');

        let dateRangePickerJs = new Datepicker(dateRangePicker);

        dateRangePickerJs.addEventListener('changeDate', e => {
          console.log(e.target.value);
        });
    }
}

function handeDateChange(date){
  console.log(date);
  
}


document.addEventListener('DOMContentLoaded', e => {
  new PublicationFilter();
});