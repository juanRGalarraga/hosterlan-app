import ObjectHelper from "../../utilities/objectHelper";
import { isEmptyString } from "../../utilities/string";

export default class PublicationEditList {

    constructor() { 
        this.callToFilterAction();
        this.callToClearFilterAction();
    }

    fetchList(dataToSend = {}) {

        let publicationMainlist = document.getElementById('mainList');
        let baseUrl = 'publications/edit/list/fetch';


        let url = new URL(baseUrl, window.location.origin).href;

        if( !ObjectHelper.isEmpty(dataToSend) ){
            const queryString = new URLSearchParams(dataToSend).toString();
            url = `${url}?${queryString}`;
        }

        const absoluteUrl = url
        
        this.#executeFetch(absoluteUrl, dataToSend, publicationMainlist);
    }

    async #executeFetch(url, dataToSend, publicationMainlist) {
        if (isEmptyString(url)) return console.error('Without URL');
        if( !(publicationMainlist instanceof HTMLElement) ) return console.error('Without element!');

        let response = await fetch(url, dataToSend);
        let blob = await response.blob();
        let text = await blob.text();
        publicationMainlist.innerHTML = text;
    }

    callToFilterAction() {
        let filterButton = document.getElementById('filterButton');
        filterButton.addEventListener('click', () => {
            this.filterList();
        });
    }

    callToClearFilterAction() { 
        let clearButton = document.getElementById('clearFilterButton');
        clearButton.addEventListener('click', () => {
            let totalCleaned = this.clearFilterValues();
            if (totalCleaned > 0) {
                this.fetchList();
            }
        });
    }

    filterList() { 
        let filterValues = this.collectFiltervalues();
        this.fetchList(filterValues);
    }


    collectFiltervalues() { 
        let filterValues = {};

        let filterInputs = document.querySelectorAll('.filter-input');

        if(filterInputs.length < 1) {
            return filterValues;
        }
        
        filterInputs.forEach((input) => {
            let inputName = input.getAttribute('name');
            let inputValue = input.value;
            filterValues[inputName] = inputValue;
        });

        return filterValues;
    }

    clearFilterValues() {
        let filterInputs = document.querySelectorAll('.filter-input')
        let totalCleaned = 0;

        if (filterInputs.length < 1) {
            return totalCleaned
        }

        filterInputs.forEach((input) => {
            input.value = ''
            totalCleaned++
        });

        return totalCleaned
    }

}