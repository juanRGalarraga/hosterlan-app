/**
 * This is a common plugin to publication´s scenarios
 */

import SimpleHash from "../simpleHash.js";
import { formatUrl } from "../utilities/url.js";
import Fetch from "../components/old/fetch.js";

export default class PublicationFile {
    input = null;
    rootPreviewFiles = "previewFiles";
    form = "publicationForm";
    files = {};
    maxFilesUpload = 5;
    fetch
    persist = true

    constructor({
        inputId,
        form = "publicationForm",
        rootPreviewFiles = "previewFiles",
        persist = true
    }) {
        this.#initElements(inputId, form, rootPreviewFiles);
        this.loadOnchange();
        this.fetch = new Fetch();
        this.persist = persist
    }

    #initElements(inputId, form, rootPreviewFiles) {
        this.input = document.getElementById(inputId);
        if (!(
            this.input instanceof HTMLInputElement &&
            this.input.type == "file"
        )) {
            throw new Error("Input type file not found");
        }

        this.form = document.getElementById(form);
        if (!this.form) {
            throw new Error("Form not found");
        }

        this.rootPreviewFiles = document.getElementById(rootPreviewFiles);
        if (!this.rootPreviewFiles) {
            throw new Error("rootPreviewFiles not found");
        }
    }

    loadOnchange() {
        let thisInstance = this;
        this.input.onchange = function (event) {
            thisInstance.loadFiles({files : event.target.files});
        };
    }

    getInputUploadFiles() {
        let filesUploaded = document.querySelectorAll(".files");
        let inputs = {}
        if (filesUploaded && filesUploaded.length > 0) {
            Array.from(filesUploaded).forEach((input) => {
                inputs[input.id] = input.value;
            })
            return inputs
        }
        return {};
    }

    getUploadedFiles(publicationId) {
        let baseUrl = "pictures/getHTMLUploadFiles";

        formatUrl(baseUrl, {publicationId}).then((fullUrl) => {
            this.fetch.render(fullUrl, { publicationId }).then((text) => {
                this.rootPreviewFiles.innerHTML = text;
                this.loadButtonDeletePreviewFileAction();
                this.files = this.getInputUploadFiles();
            });
        })
    }
    

    loadFiles(dataTosend = null) {
        
        let baseUrl = "pictures/getHTMLUploadFiles";

        if (dataTosend?.files) {
            console.log(this.files);
            this.processFiles(dataTosend.files);
            console.log(this.files);
            
            dataTosend = this.files;
        }

        this.fetch.render(baseUrl, dataTosend).then((text) => {
            
            this.rootPreviewFiles.innerHTML = text;
            this.loadButtonDeletePreviewFileAction();
            this.files = this.getInputUploadFiles();
        });
    }

    processFiles(files) {
        let thisInstance = this;
        Array.from(files).forEach((file) => {
            if (!thisInstance.thisExceedMaxAllowedFiles()) {
                
                const value = URL.createObjectURL(file);
                
                // Generate a hash that is a single alphabetic character
                let hash = SimpleHash.generate(file.name);
                thisInstance.files[hash] = value;
                
                thisInstance.createInputFile(file, hash);
            }
        });
    }

    formatUrl(baseUrl, dataTosend) {
        if (dataTosend != null) {
            const queryString = new URLSearchParams(dataTosend);
            baseUrl += "?" + queryString;
        }
        return baseUrl;
    }

    createInputFile(theFile, id) {
        let input = document.createElement("input");
        input.setAttribute("type", "file");
        input.setAttribute("name", "files[]");
        input.classList.add("files");
        input.setAttribute("hidden", "true");
        input.id = id;

        const dt = new DataTransfer();
        dt.items.add(theFile);
        input.files = dt.files;

        this.input.value = "";

        this.form.insertAdjacentElement("afterbegin", input);
    }

    loadButtonDeletePreviewFileAction() {
        let thisInstance = this;
        let buttons = this.rootPreviewFiles.querySelectorAll(
            "button[data-button-delete-preview-file]"
        );
        if (buttons) {
            buttons.forEach((button) => {
                button.onclick = () => {
                    thisInstance.deleteFile(
                        button.getAttribute("data-filename"),
                        thisInstance.persist
                    );
                };
            });
        }
    }

    deleteFile(id, persist = true) {
        let indexOfFilename = this.files[id] ?? null;
        if (indexOfFilename == null) return console.error(id + " not exist");

        let input = document.getElementById(id);
        if (!input) return console.error(id + " input not exist");
        
        if (persist) {
            this.persistDeletePicture(id, input)
        }

        input.remove();

        this.deleteCard(input.id);

        delete this.files[id];
    }

    deleteCard(id) {
        let card = document.getElementById("wrapper-" + id);
        if (card) { 
            card.remove();
        }
    }

    persistDeletePicture(id, input) { 
        let thisInstance = this
        let baseUrl = `pictures/${id}`;
        const absoluteUrl = new URL(baseUrl, window.location.origin).href;

        formatUrl(absoluteUrl).then((fullUrl) => {

            let init = {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('[name="_token"]').value
                    },
                }
    
            this.fetch.json(fullUrl, init).then((response) => {
                if (response.status == 200) { 
                    let publicationId = document.getElementById("id").value;
                    thisInstance.getUploadedFiles(publicationId);
                }
            }).catch((error) => {
                input.remove();
                delete this.files[id];
                console.error(error);
            })

        })
    }

    thisExceedMaxAllowedFiles() {
        if (this?.files?.length && this?.files?.length > 0) {
            return Object.keys(this.files).length > this.maxFilesUpload
        }
        return false
    }

    /**
     * Method for only debug purposes
     */

    fillField() {
        document.getElementById("title").value = "Oportunidad de cabaña!!";
        document.getElementById("rent_type_id").options[1].selected = true;
        document.getElementById("bathroom_count").options[3].selected = true;
        document.getElementById("number_people").options[3].selected = true;
        document.getElementById("price").value = 2000;
        document.getElementById("ubication").value = "Gualeguaychú";
        document.getElementById("description").value =
            `Cabaña con 2 habitaciones, amueblada. Gran oportunida. Todas las comodidades. A 10 cuadras del centro.
            Aceptamos mascotas. No dudes en consultar. Precio por día.`;
        document.getElementById("pets").checked = true;
    }

    fillExample() {
        return {
            "heroes_villanos - copia.jpg":
                "https://u.osu.edu/duska.7/files/2017/04/stock-market-3-21gyd1b.jpg",
            "heroes_villanos.jpg":
                "https://u.osu.edu/duska.7/files/2017/04/stock-market-3-21gyd1b.jpg",
            "camila-nogueira-ambulo-polar-x-2000x1125.jpg":
                "https://u.osu.edu/duska.7/files/2017/04/stock-market-3-21gyd1b.jpg",
            "camila-nogueira-toonorth-ep-3.jpg":
                "https://u.osu.edu/duska.7/files/2017/04/stock-market-3-21gyd1b.jpg",
            "Imagen de WhatsApp 2023-02-23 a las 08.20.42 - copia.jpg":
                "https://u.osu.edu/duska.7/files/2017/04/stock-market-3-21gyd1b.jpg",
            "Imagen de WhatsApp 2023-02-23 a las 08.20.42.jpg":
                "https://u.osu.edu/duska.7/files/2017/04/stock-market-3-21gyd1b.jpg",
            "juan.galarraga_un_perro_hacker_caricatura_82212ca7-bd88-413e-90b0-e19d2615f32b - copia.png":
                "https://u.osu.edu/duska.7/files/2017/04/stock-market-3-21gyd1b.jpg",
            "juan.galarraga_un_perro_hacker_caricatura_82212ca7-bd88-413e-90b0-e19d2615f32b.png":
                "https://u.osu.edu/duska.7/files/2017/04/stock-market-3-21gyd1b.jpg",
            "grid_0una pareja de tango bailando en un teatro vacio sin butacas con luces azules2.jpg":
                "https://u.osu.edu/duska.7/files/2017/04/stock-market-3-21gyd1b.jpg",
            "una pareja de tango bailando en un teatro vacio sin butacas con luces azules.jpg":
                "https://u.osu.edu/duska.7/files/2017/04/stock-market-3-21gyd1b.jpg",
            "heroes_by_humanmgn_dcnjhi6.png":
                "https://u.osu.edu/duska.7/files/2017/04/stock-market-3-21gyd1b.jpg",
            "villains_by_humanmgn_dcnjgsd - copia (2).png":
                "https://u.osu.edu/duska.7/files/2017/04/stock-market-3-21gyd1b.jpg",
            "villains_by_humanmgn_dcnjgsd - copia.png":
                "https://u.osu.edu/duska.7/files/2017/04/stock-market-3-21gyd1b.jpg",
            "villains_by_humanmgn_dcnjgsd.png":
                "https://u.osu.edu/duska.7/files/2017/04/stock-market-3-21gyd1b.jpg",
        };
    }
}
