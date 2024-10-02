export default class Fetch {

    options = {
        type: 'json'
    }

    mergeOptions(userOptions = {}) { 
        this.options = Object.assign({}, userOptions)
    }

    async json(baseUrl, dataTosend, options = {} ) {
        try {

            this.mergeOptions(options)

            const absoluteUrl = new URL(baseUrl, window.location.origin).href;
            const response = await fetch(absoluteUrl, dataTosend);
            const text = await response.json();
            return text;
        } catch (error) {
            console.error("Error fetching json:", error);
        }
    }

    /**
     * This is helpful to fetch a file content from the server
     * @param {string} baseUrl endpoint to fetch
     * @param {object} dataTosend data to send to the server
     * @param {object} options 
     * @returns 
     */
    async render(baseUrl, dataTosend, options = {} ) {
        try {

            this.mergeOptions(options)

            const absoluteUrl = new URL(baseUrl, window.location.origin).href;
            const response = await fetch(absoluteUrl, dataTosend);
            const blob = await response.blob();
            const text = await blob.text();
            return text;
        } catch (error) {
            console.error("Error fetching files:", error);
        }
    }
}