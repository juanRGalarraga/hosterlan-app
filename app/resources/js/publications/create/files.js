import SimpleHash from "../../simpleHash.js";
import Alert from "../../components/alert.js";
import {formatUrl} from "../../utilities/url.js";

export default class PublicationFile {
    input = null;
    rootPreviewFiles = "previewFiles";
    form = "publicationForm";
    files = {};
    maxFilesUpload = 5;
    alertWarningMaxAllowedFiles;

    constructor({
        inputId,
        form = "publicationForm",
        rootPreviewFiles = "previewFiles",
    }) {
        this.input = document.getElementById(inputId);
        if (
            !(
                this.input instanceof HTMLInputElement &&
                this.input.type == "file"
            )
        ) {
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

        this.alertWarningMaxAllowedFiles = new Alert().init(
            "alertWarningMaxAllowedFiles"
        );

        this.loadOnchange();
    }

    loadOnchange() {
        let thisInstance = this;
        this.input.onchange = function (event) {
            thisInstance.loadFiles({files : event.target.files});
        };
    }

    mergeWithUploadedFiles() {
        let thisInstance = this;
        let filesUploaded = document.querySelectorAll(".files");
        
        Array.from(filesUploaded).forEach(input => {
            console.log(input.value);
            
            if (input.value) {
                thisInstance.files[input.id] = input.value;
            }
        })
        
    }

    getUploadedFiles(publicationId) {
        let baseUrl = "publications/getUploadedFiles";

        formatUrl(baseUrl, {publicationId}).then((fullUrl) => {
            this.fetchFiles(fullUrl, {publicationId}).then((text) => {
                this.rootPreviewFiles.innerHTML = text;
                this.loadButtonDeletePreviewFileAction();
            });
        })
    }
    

    loadFiles(dataTosend = null) {

        let baseUrl = "publications/getUploadedFiles";

        if (dataTosend?.files) {

            this.processFiles(dataTosend.files);
            //Because i neet the blob not the file
            this.mergeWithUploadedFiles();

            dataTosend.files = this.files;
            console.log(dataTosend.files);
            
        }

        dataTosend = dataTosend.files
        formatUrl(baseUrl, dataTosend).then((fullUrl) => {
            this.fetchFiles(fullUrl, dataTosend).then((text) => {
                this.rootPreviewFiles.innerHTML = text;
                this.loadButtonDeletePreviewFileAction();
            });
        })
    }

    processFiles(files) {
        let thisInstance = this;
        Array.from(files).forEach((file) => {
            if (!thisInstance.thisExceedMaxAllowedFiles()) {
                const value = URL.createObjectURL(file);
                let id = SimpleHash.generate(file.name);
                this.files[id] = value;
            }
        });
    }

    formatUrl(baseUrl, dataTosend) {
        if (dataTosend != null) {
            const queryString = new URLSearchParams(dataTosend).toString();
            console.log(queryString);
            
            baseUrl += "?" + queryString;
        }
        return baseUrl;
    }

    async fetchFiles(baseUrl, dataTosend) {
        try {
            const absoluteUrl = new URL(baseUrl, window.location.origin).href;
            const response = await fetch(absoluteUrl, dataTosend);
            const blob = await response.blob();
            const text = await blob.text();
            return text;
        } catch (error) {
            console.error("Error fetching files:", error);
        }
    }

    createInputFile(theFile, id) {
        let input = document.createElement("input");
        input.setAttribute("type", "file");
        input.setAttribute("name", "files[]");
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
                        button.getAttribute("data-filename")
                    );
                };
            });
        }
    }

    deleteFile(id) {
        let indexOfFilename = this.files[id] ?? null;
        if (indexOfFilename == null) return console.error(id + " not exist");
        delete this.files[id];

        let input = document.getElementById(id);
        if (!input) return console.error(id + " input not exist");

        input.remove();
        this.loadFiles(this.files);
    }

    thisExceedMaxAllowedFiles() {
        return false;
        return Object.keys(this.files).length > this.maxFilesUpload;
    }

    /**
     * Method for only debug purposes
     */

    fillField() {
        document.getElementById("title").value = "Oportunidad de cabaña!!";
        document.getElementById("rent_type_id").options[1].selected = true;
        document.getElementById("room_count").options[2].selected = true;
        document.getElementById("bathroom_count").options[3].selected = true;
        document.getElementById("number_people").options[3].selected = true;
        document.getElementById("price").value = 2000;
        document.getElementById("ubication").value = "Gualeguaychú";
        document.getElementById("description").value =
            "Cabaña con 2 habitaciones, amueblada. Gran oportunidad";
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
