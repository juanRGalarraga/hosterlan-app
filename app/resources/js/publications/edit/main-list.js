import Spinner from "../../components/spinner";
import Pagination from "../../components/fetchPagination";
import Fetch from "../../components/fetch";

export default class PublicationEditList {

    spinner
    pagination
    fetch

    constructor() { 
        this.pagination = new Pagination();
        this.callToFilterAction();
        this.callToClearFilterAction();
        this.spinner = new Spinner();
        this.fetch = new Fetch();

    }

    fetchList(dataToSend = {}) {

        // this.spinner.show('mainView');

        let publicationMainlist = document.getElementById('mainList');
        let url = 'publications/edit/list/fetch';
        
        this.fetch.render(url, dataToSend).then((text) => { 
            publicationMainlist.innerHTML = text;
            this.refreshPagination();
        })
    }

    refreshPagination() {
        this.pagination.collectLinkPagination();
        this.pagination.getButtonNextPage();
        this.pagination.getButtonPrevPage();
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