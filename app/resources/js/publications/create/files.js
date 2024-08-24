import SimpleHash from '../../simpleHash.js';
import Alert from '../../utilities/alert.js';

export default class PublicationFile {
    input = null
    rootPreviewFiles = 'previewFiles'
    form = 'publicationForm'
    files = {}
    inputForm
    maxFilesUpload = 5
    alertWarningMaxAllowedFiles

    constructor(inputId){
        this.input = document.getElementById(inputId)
        if(!(this.input instanceof HTMLInputElement && this.input.type == 'file')){
            throw new Error("Input type file not found");
        }

        this.form = document.getElementById(this.form)
        if(!this.form){
            throw new Error("Form not found");
        }

        this.rootPreviewFiles = document.getElementById(this.rootPreviewFiles)
        if(!this.rootPreviewFiles){
            throw new Error("rootPreviewFiles not found");
        }
        
        this.alertWarningMaxAllowedFiles = new Alert().init('alertWarningMaxAllowedFiles');

        this.loadOnchange();
        // this.getFiles();
    }

    loadOnchange() {
        let thisInstance = this
        this.input.onchange = function(event) {
            Array.from(event.target.files).forEach(file => {
                
                if( !thisInstance.thisExceedMaxAllowedFiles() ){

                    const blobURL = URL.createObjectURL(file);
                    let hashId = SimpleHash.generate(file.name)
                    thisInstance.files[hashId] = blobURL;
                    thisInstance.createInputForm(file, hashId);

                } 

            });

            thisInstance.getFiles(thisInstance.files);
        };
    }

    getFiles(dataTosend = null) {
        let thisInstance = this;

        let baseUrl = 'getPreviewFiles'
        
        // dataTosend = this.fillExample()
        if(dataTosend != null){
            
            const queryString = new URLSearchParams(dataTosend).toString();
            baseUrl += '?' + queryString;
        }

        fetch(baseUrl, dataTosend)
        .then((respuesta) => respuesta.blob())
        .then(blob => {
            blob.text().then(text => {
                thisInstance.rootPreviewFiles.innerHTML = text;
                thisInstance.loadButtonDeletePreviewFileAction();
            });
        });
    }

    createInputForm(theFile, id){
        let input = document.createElement('input');
        input.setAttribute('type', 'file');
        input.setAttribute('name', 'files[]');
        input.setAttribute('hidden', 'true');
        input.id = id
        
        const dt = new DataTransfer();
		dt.items.add(theFile);
        input.files = dt.files;

        this.input.value = '';

        this.form.insertAdjacentElement('afterbegin', input);
    }

    loadButtonDeletePreviewFileAction(){
        let thisInstance = this;
        let buttons = this.rootPreviewFiles.querySelectorAll('button[data-button-delete-preview-file]');
        if(buttons) {
            buttons.forEach(button => {
                button.onclick = () => {
                    thisInstance.deleteFile( button.getAttribute('data-filename') );
                } 
            });
        }
    }

    deleteFile(id){
        let indexOfFilename = this.files[id] ?? null;
        if(indexOfFilename == null) return console.error(id + " not exist");
        delete this.files[id];

        let input = document.getElementById(id);
        if(!input) return console.error(id + " input not exist");

        input.remove();
        this.getFiles(this.files);
    }

    thisExceedMaxAllowedFiles(){
        return Object.keys(this.files).length > this.maxFilesUpload
    }


    /**
     * Method for only debug purposes
     */

    fillField(){
        document.getElementById('title').value = "Oportunidad de cabaña!!";
        document.getElementById('rent_type_id').options[1].selected = true;
        document.getElementById('room_count').options[2].selected = true;
        document.getElementById('bathroom_count').options[3].selected = true;
        document.getElementById('number_people').options[3].selected = true;
        document.getElementById('price').value = 2000;
        document.getElementById('ubication').value = 'Gualeguaychú';
        document.getElementById('description').value = 'Cabaña con 2 habitaciones, amueblada. Gran oportunidad';
        document.getElementById('pets').checked = true;
        document.getElementById('available_since').value = '06/03/2024';
        document.getElementById('available_to').value = '06/04/2024';
    }

    fillExample(){
        return {
            "heroes_villanos - copia.jpg": "https://u.osu.edu/duska.7/files/2017/04/stock-market-3-21gyd1b.jpg",
            "heroes_villanos.jpg": "https://u.osu.edu/duska.7/files/2017/04/stock-market-3-21gyd1b.jpg",
            "camila-nogueira-ambulo-polar-x-2000x1125.jpg": "https://u.osu.edu/duska.7/files/2017/04/stock-market-3-21gyd1b.jpg",
            "camila-nogueira-toonorth-ep-3.jpg": "https://u.osu.edu/duska.7/files/2017/04/stock-market-3-21gyd1b.jpg",
            "Imagen de WhatsApp 2023-02-23 a las 08.20.42 - copia.jpg": "https://u.osu.edu/duska.7/files/2017/04/stock-market-3-21gyd1b.jpg",
            "Imagen de WhatsApp 2023-02-23 a las 08.20.42.jpg": "https://u.osu.edu/duska.7/files/2017/04/stock-market-3-21gyd1b.jpg",
            "juan.galarraga_un_perro_hacker_caricatura_82212ca7-bd88-413e-90b0-e19d2615f32b - copia.png": "https://u.osu.edu/duska.7/files/2017/04/stock-market-3-21gyd1b.jpg",
            "juan.galarraga_un_perro_hacker_caricatura_82212ca7-bd88-413e-90b0-e19d2615f32b.png": "https://u.osu.edu/duska.7/files/2017/04/stock-market-3-21gyd1b.jpg",
            "grid_0una pareja de tango bailando en un teatro vacio sin butacas con luces azules2.jpg": "https://u.osu.edu/duska.7/files/2017/04/stock-market-3-21gyd1b.jpg",
            "una pareja de tango bailando en un teatro vacio sin butacas con luces azules.jpg": "https://u.osu.edu/duska.7/files/2017/04/stock-market-3-21gyd1b.jpg",
            "heroes_by_humanmgn_dcnjhi6.png": "https://u.osu.edu/duska.7/files/2017/04/stock-market-3-21gyd1b.jpg",
            "villains_by_humanmgn_dcnjgsd - copia (2).png": "https://u.osu.edu/duska.7/files/2017/04/stock-market-3-21gyd1b.jpg",
            "villains_by_humanmgn_dcnjgsd - copia.png": "https://u.osu.edu/duska.7/files/2017/04/stock-market-3-21gyd1b.jpg",
            "villains_by_humanmgn_dcnjgsd.png": "https://u.osu.edu/duska.7/files/2017/04/stock-market-3-21gyd1b.jpg"
        }
    }
}