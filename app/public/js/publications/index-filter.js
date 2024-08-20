function formatDate(date) {
    const day = String(date.getDate()).padStart(2, '0');
    const month = String(date.getMonth() + 1).padStart(2, '0'); // Los meses comienzan en 0
    const year = date.getFullYear();

    return `${day}/${month}/${year}`;
}

// Función para sumar días a una fecha
function addDays(date, days) {
    const result = new Date(date);
    result.setDate(result.getDate() + days);
    return result;
}


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

    appendFilter(name, value){

    }

    initEvents(){

        let thisObj = this;
    
        const applyFilter = (filter) => {
          thisObj.appendFilter(filter);
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
        this.available_from.onchange = (ev) => {
          applyFilter({availableFrom: ev.target.value});
        };
        this.available_to.onchange = (ev) => {
          applyFilter({availableTo: ev.target.value});
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
        document.getElementById('available_from').value = '';
        document.getElementById('available_to').value = '';
    }
}


document.addEventListener('DOMContentLoaded', ev => {
    new PublicationFilter();
});