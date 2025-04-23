/**
 * Use this plugin for fetch-tailwind pagination template
 */

export default class Pagination {
    collectLinkPagination(paginationClass = 'pagination-link') { 
        let paginationLinks = document.querySelectorAll(`.${paginationClass}`);
        
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

    getButtonNextPage(buttonId = 'nextPageUrlButton') { 
        let buttonNext = document.getElementById(buttonId);

        if (!(buttonNext instanceof HTMLButtonElement)) {
            return
        }

        buttonNext.onclick = () => { 
            let nextPage = buttonNext.getAttribute('data-href');
            this.fetchList({ page: nextPage });
        }

        return buttonNext
    }

    getButtonPrevPage(buttonId = 'previusPageUrlButton') {
        let buttonPrev = document.getElementById(buttonId);

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