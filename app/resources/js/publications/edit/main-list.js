import Spinner from "../../components/spinner";
import Pagination from "../../components/fetchPagination";
import Fetch from "../../components/fetch";
import Alert from "../../components/alert";
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
            this.callToDeletePublication();
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
        let filterValues = this.collectFilterValues();
        this.fetchList(filterValues);
    }

    collectFilterValues() { 
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

    callToDeletePublication() { 
        let deleteButtons = document.querySelectorAll('.delete-publication');
        deleteButtons.forEach((button) => {
            button.addEventListener('click', (e) => {
                let publicationId = button.getAttribute('data-publication-id');
                this.deletePublication(publicationId);
            });
        });
    }

    deletePublication(publicationId) { 
        let url = `publications/${publicationId}`;
        let init = {
            method: 'DELETE'
        }
        this.fetch.json(url, init).then((response) => {

            if (response.status === 200) {
                Alert.success({title: response.title, text: response.message});
                this.fetchList();
                return;
            }
            console.error(response)
        });
    }

}