class PublicationDropzone {

    input = null
    rootCarrousel = 'rootCarrousel'
    rootButtonSlideCarousel = 'buttonSlideCarousel'
    carrouselSlider = 'carrousel-slider'
    itemsCarrousel = []
    sliders = []
    itemsCount = 0
    form = 'publicationForm'

    constructor(inputId){
        this.input = document.getElementById(inputId)
        if(!(this.input instanceof HTMLInputElement && this.input.type == 'file')){
            throw new Error("Input type file not found");
        }

        this.form = document.getElementById(this.form)
        if(!this.form){
            throw new Error("Form not found");
        }

        this.loadOnchange();
    }

    loadOnchange() {
        let thisInstance = this
        let images = [];
        let formData = new FormData();
        this.input.onchange = function(event) {
            Array.from(event.target.files).forEach(file => {
                const blobURL = URL.createObjectURL(file);
                formData.append('file', blobURL, 'image');
                thisInstance.appendFile();
            });
        };
    }

    appendFile(fileData) {
        let span = '';
    }
}

// let publicationDropZone = new PublicationDropzone('dropzone-file');