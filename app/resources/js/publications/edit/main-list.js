import ObjectHelper from "../../utilities/objectHelper";
import { isEmptyString } from "../../utilities/string";
import { formatUrl } from "../../utilities/url";

export default class PublicationEditList {

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
}