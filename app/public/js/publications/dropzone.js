class PublicationDropzone {

    input = null
    rootPreviewFiles = 'previewFiles'
    form = 'publicationForm'
    files = []
    filesSrc = []
    inputForm

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

        this.loadOnchange();
    }

    loadOnchange() {
        let thisInstance = this
        this.input.onchange = function(event) {
            Array.from(event.target.files).forEach(file => {
                const blobURL = URL.createObjectURL(file);
                if( !thisInstance.files.includes(file.name) ){
                    thisInstance.files.push(file.name)
                    thisInstance.filesSrc.push(blobURL)
                    thisInstance.createInputForm(file);
                }
            });
            if(this.files.length > 0){
                thisInstance.getFiles({filename: thisInstance.files, src: thisInstance.filesSrc});
            }
            this.value = "";
        };
    }

    getFiles(dataTosend = null) {
        
        let thisInstance = this;

        let baseUrl = 'getPreviewFiles';
        
        const queryString = new URLSearchParams(dataTosend).toString();

        if(dataTosend != null){
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

    createInputForm(theFile){
        let input = document.createElement('input');
        input.setAttribute('type', 'file');
        input.setAttribute('name', 'files[]');
        input.setAttribute('hidden', 'true');
        input.id = theFile.name;
        
        const dt = new DataTransfer();
		dt.items.add(theFile);
        input.files = dt.files;

        this.form.insertAdjacentElement('afterbegin', input);

    }

    loadButtonDeletePreviewFileAction(){
        let thisInstance = this;
        let buttons = this.rootPreviewFiles.querySelectorAll('button[data-button-delete-preview-file]');
        if(buttons) {
            buttons.forEach(button => {
                button.onclick = () => {
                    thisInstance.deleteFile(button.getAttribute('data-filename'));
                } 
            });
        }
    }

    deleteFile(filename){
        console.log(this.files);
        console.log(this.filesSrc);
        let indexOfFilename = this.files.indexOf(filename);
        if(indexOfFilename == -1) return console.error(filename + " not exist");
        this.files.splice(indexOfFilename, 1);
        this.filesSrc.splice(indexOfFilename, 1);

        let input = document.getElementById(filename);

        if(!input) return console.error(filename + " input not exist");
        input.remove();

        console.log(this.files);
        console.log(this.filesSrc);
        
        this.getFiles({filename: this.files, src: this.filesSrc});
    }
}

let publicationDropZone = new PublicationDropzone('dropzone-file');
// publicationDropZone.getFiles();