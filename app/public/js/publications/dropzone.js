class PublicationDropzone {

    input = null
    rootCarrousel = 'preview-carousel'
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
        
        this.rootCarrousel = document.getElementById(this.rootCarrousel)
        if(!this.rootCarrousel){
            throw new Error("Root component image not found");
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
                formData.append('image[]', blobURL);
            });
            thisInstance.getCarousel({body: formData});
        };

    }
    
    convertFileToBase64(files) {
        return new Promise((resolve, reject) => {
            Array.from(files).forEach(file => {
                
                const reader = new FileReader();
        
                reader.onload = function(event) {
                    const base64 = event.target.result;
                    resolve(base64);
                };

                reader.onerror = () => {
                    reject(`Error occurred reading file: ${file.name}`)
                }
        
                reader.readAsDataURL(file);

            });
        });
    }

    createCarousel(data) {
        this.getCarousel();
    }

    createSliderButton() {
        const carrouselSliderButton = document.createElement('button');
        carrouselSliderButton.type = 'button';
        carrouselSliderButton.className = 'w-3 h-3 rounded-full';
        carrouselSliderButton.setAttribute('data-carousel-slide-to', this.itemsCount);
        carrouselSliderButton.id = `carousel-slider-${this.itemsCount}`;
        this.carrouselSlider.insertAdjacentElement('afterbegin', carrouselSliderButton);    
        return carrouselSliderButton;
    }

    createCarouselImage(data) {
        let isActive = (this.itemsCount == 0) ? 'active' : '';

        if( [0, 1].includes(this.itemsCount) ){
            let thisCarouselImage = this.rootCarrousel.querySelector(`div[data-carousel-number="${this.itemsCount}"] > img`);
            thisCarouselImage.src = data;

            if(this.itemsCount == 1){
                this.rootButtonSlideCarousel.classList.remove('hidden');
            }

            this.reloadCarousel();

            this.addItem();

            return;
        }

        const innerDiv = document.createElement('div');
        innerDiv.className = 'duration-700 ease-in-out absolute inset-0 transition-transform transform z-10 translate-x-full z-20';
        
        innerDiv.setAttribute('data-carousel-item', isActive);
        innerDiv.setAttribute('data-carousel-number', this.itemsCount);
        
        const img = document.createElement('img');
        img.className = 'absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2';
        img.src = data;
        img.alt = '...';
    
        innerDiv.appendChild(img);
            
        this.rootCarrousel.insertAdjacentElement('beforeend', innerDiv);

        this.addItem();

        this.reloadCarousel();

        return innerDiv;
    }

    reloadCarousel() {
        new Carousel(this.rootCarrousel, {
            interval: 3000, // Set your desired interval
            wrap: true
        });
    }

    addItem(){
        return this.itemsCount++;
    }

    getCarousel(dataToSend = {}){

        let thisInstance = this;
        const url = 'carousel';

        dataToSend = Object.assign(dataToSend, {method: 'POST'});

        fetch(url, dataToSend)
          .then((respuesta) => respuesta.blob())
          .then(blob => {
            
            blob.text().then(text => {
                thisInstance.rootCarrousel.innerHTML = text;
            });

          }).catch(error => {
            console.error(error);
          });
      }
}