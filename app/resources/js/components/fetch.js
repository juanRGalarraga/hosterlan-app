import { format as formatUrl } from "../utilities/url";

export default class Fetch {

    options = {
        type: 'json'
    }

    constructor() {
        this.options['baseUrl'] = window.location.origin;
    }

    mergeOptions(userOptions = {}) {
        this.options = Object.assign({}, this.options, userOptions)
    }

    async json(endpoint, dataToSend = {}, options = {} ) {
        try {
            this.mergeOptions(options)
            
            let finalUrl = formatUrl(endpoint, this.options.baseUrl)
            
            if (dataToSend?.method?.toUpperCase() == "GET") {
                finalUrl = formatUrl(endpoint, this.options.baseUrl, dataToSend)   
            }

            if (dataToSend?.body !== null) {
                dataToSend.body = JSON.stringify(dataToSend.body)
            }
            debugger
            const response = await fetch(finalUrl, dataToSend);
            debugger
            console.log(response);
            
            const text = await response.json();
            return text;

        } catch (error) {
            console.error("Error fetching json:", error);
        }
    }

    /**
     * This is helpful to fetch a file content from the server
     * @param {string} baseUrl endpoint to fetch
     * @param {object} dataToSend data to send to the server
     * @param {object} options 
     * @returns 
     */
    async render(endpoint, dataToSend, options = {} ) {
        try {
            
            this.mergeOptions(options)
            
            const finalUrl = formatUrl(endpoint, this.options.baseUrl, dataToSend)
            
            const response = await fetch(finalUrl, dataToSend)
            const blob = await response.blob();
            const text = await blob.text();
            return text;
        } catch (error) {
            console.error("Error fetching files:", error);
        }
    }
}