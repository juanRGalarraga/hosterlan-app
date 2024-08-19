class PublicationDropzone {

    input = null
    rootCarrousel = 'rootCarrousel'
    rootButtonSlideCarousel = 'buttonSlideCarousel'
    carrouselPlaceholder = 'carrousel-placeholder'
    carrouselSlider = 'carrousel-slider'
    itemsCarrousel = []
    sliders = []
    itemsCount = 0

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

        this.rootButtonSlideCarousel = document.getElementById(this.rootButtonSlideCarousel)
        if(!this.rootButtonSlideCarousel){
            throw new Error("rootButtonSlideCarousel not found");
        }

        this.loadOnchange();
    }

    loadOnchange() {
        let thisInstance = this
        this.input.onchange = function(event) {
            thisInstance.convertFileToBase64(event.target.files)
            .then( base64 => { thisInstance.createCarousel(base64); })
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
        let isCurrent = (this.itemsCount == 0) ? 'true' : 'false';
        const carrouselSliderButton = document.createElement('button');
        carrouselSliderButton.type = 'button';
        carrouselSliderButton.className = 'w-3 h-3 rounded-full';
        carrouselSliderButton.setAttribute('data-carousel-slide-to', this.itemsCount);
        carrouselSliderButton.setAttribute('aria-current', isCurrent);
        carrouselSliderButton.id = `carousel-slider-${this.itemsCount}`;
        this.carrouselSlider.insertAdjacentElement('afterbegin', carrouselSliderButton);    
        return carrouselSliderButton;
    }

    createCarouselImage(base64Image) {
        let isActive = (this.itemsCount == 0) ? 'active' : '';

        if( [0, 1].includes(this.itemsCount) ){
            let thisCarouselImage = this.rootCarrousel.querySelector(`div[data-carousel-number="${this.itemsCount}"] > img`);
            thisCarouselImage.src = base64Image;

            if(this.itemsCount == 1){
                this.rootButtonSlideCarousel.classList.remove('hidden');
            }

            this.addItem();

            return;
        }

        const innerDiv = document.createElement('div');
        innerDiv.id = `carousel-item-${this.itemsCount}`;
        innerDiv.className = 'hidden duration-700 ease-in-out';
        
        innerDiv.setAttribute('data-carousel-item', isActive);
        innerDiv.setAttribute('data-carousel-number', this.itemsCount);
        
        const img = document.createElement('img');
        img.className = 'absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2';
        img.src = base64Image;
        img.alt = '...';
    
        innerDiv.appendChild(img);
        this.rootCarrousel.insertAdjacentElement('beforeend', innerDiv);

        this.addItem();

        return innerDiv;
    }

    addItem(){
        return this.itemsCount++;
    }
}