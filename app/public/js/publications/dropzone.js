class PublicationDropzone {

    input = null
    rootCarrousel = 'rootCarrousel'
    carrouselPlaceholder = 'carrousel-placeholder'
    carrouselSlider = 'carrousel-slider'
    itemsCarrousel = []
    sliders = []

    constructor(inputId){
        this.input = document.getElementById(inputId)
        if(!(this.input instanceof HTMLInputElement && this.input.type == 'file')){
            throw new Error("Input type file not found");
        }
        
        this.rootCarrousel = document.getElementById(this.rootCarrousel)
        if(!this.rootCarrousel){
            throw new Error("Root component image not found");
        }

        this.carrouselPlaceholder = document.getElementById(this.carrouselPlaceholder)
        if(!this.carrouselPlaceholder){
            throw new Error("Carrousel placeholder not found");
        }

        this.carrouselSlider = document.getElementById(this.carrouselSlider)
        if(!this.carrouselSlider){
            throw new Error("Carrousel slider not found");
        }

        this.loadOnchange();
    }

    loadOnchange() {
        let thisInstance = this
        this.input.onchange = function(event) {
            thisInstance.convertFileToBase64(event.target.files)
            .then( base64 => thisInstance.createCarousel(base64) )
            .catch( error => console.error(error) );
        };
    }
    
    convertFileToBase64(files) {

        return new Promise((resolve, reject) => {
            Array.from(files).forEach(file => {
                const reader = new FileReader();
        
                reader.onload = function(event) {
                    const base64Image = event.target.result;
                    resolve(base64Image);
                };

                reader.onerror = () => {
                    reject(`Error occurred reading file: ${file.name}`)
                }
        
                reader.readAsDataURL(file);
            });
        });

    }

    createCarousel(base64) {
        this.carrouselPlaceholder.classList.add('hidden');
        this.createSliderButton();
        this.createCarouselImage(base64);
    }

    createSliderButton() {
        let itemNumber = this.rootCarrousel.children.length;
        let isCurrent = (itemNumber == 0) ? 'true' : 'false';
        const carrouselSliderButton = document.createElement('button');
        carrouselSliderButton.type = 'button';
        carrouselSliderButton.className = 'w-3 h-3 rounded-full';
        carrouselSliderButton.setAttribute('data-carousel-slide-to', itemNumber);
        carrouselSliderButton.setAttribute('aria-current', isCurrent);
        carrouselSliderButton.id = `carousel-slider-${itemNumber}`;
        this.carrouselSlider.insertAdjacentElement('afterbegin', carrouselSliderButton);    
        return carrouselSliderButton;
    }

    createCarouselImage(base64Image) {
        let itemNumber = this.rootCarrousel.children.length;
        let isCurrent = (itemNumber == 0) ? 'true' : 'false';
        const innerDiv = document.createElement('div');
        innerDiv.id = `carousel-item-${itemNumber}`;
        innerDiv.className = 'duration-700 ease-in-out absolute inset-0 transition-transform transform translate-x-0 z-30';
        innerDiv.setAttribute('aria-current', isCurrent);
        innerDiv.setAttribute('data-carousel-item', '');
        innerDiv.setAttribute('data-carousel-number', itemNumber);
        
        const img = document.createElement('img');
        img.className = 'absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2';
        img.src = base64Image;
        img.alt = '...';
    
        innerDiv.appendChild(img);
        this.rootCarrousel.insertAdjacentElement('afterbegin', innerDiv);
        return innerDiv;
    }
}

new PublicationDropzone('dropzone-file');