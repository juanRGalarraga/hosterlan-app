import ObjectHelper from "../../utilities/objectHelper";
import { isEmptyString } from "../../utilities/string";
import Spinner from "../../components/spinner";

export default class PublicationEditList {

    spinner

    constructor() { 
        this.callToFilterAction();
        this.callToClearFilterAction();
        this.spinner = new Spinner();

    }

    fetchList(dataToSend = {}) {

        // this.spinner.show('mainView');

        let publicationMainlist = document.getElementById('mainList');
        let baseUrl = 'publications/edit/list/fetch';


        let url = new URL(baseUrl, window.location.origin).href;

        console.log(url);
        

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
        this.refreshPagination();
    }

    refreshPagination() {
        this.collectLinkPagination();
        this.getButtonNextPage();
        this.getButtonPrevPage();
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

    collectLinkPagination() { 
        let paginationLinks = document.querySelectorAll('.pagination-link');
        
        if(paginationLinks.length < 1) {
            return;
        }

        paginationLinks.forEach((link) => {
            let page = link.getAttribute('data-page');
            link.addEventListener('click', (event) => {
                event.preventDefault();
                this.fetchList({ page: page });
            });
        });
    }

    getButtonNextPage() { 
        let buttonNext = document.getElementById('nextPageUrlButton');

        if (!(buttonNext instanceof HTMLButtonElement)) {
            return
        }

        buttonNext.onclick = () => { 
            let nextPage = buttonNext.getAttribute('data-href');
            this.fetchList({ page: nextPage });
        }

        return buttonNext
    }

    getButtonPrevPage() {
        let buttonPrev = document.getElementById('previusPageUrlButton');

        if (!(buttonPrev instanceof HTMLButtonElement)) {
            return
        }
        
        buttonPrev.onclick = () => {
            let prevPage = buttonPrev.getAttribute('data-href');
            this.fetchList({ page: prevPage });
        }

        return buttonPrev;
    }

}