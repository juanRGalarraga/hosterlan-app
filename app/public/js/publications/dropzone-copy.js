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
        
        this.rootCarrousel = document.getElementById(this.rootCarrousel)
        if(!this.rootCarrousel){
            throw new Error("Root component image not found");
        }

        this.carrouselSlider = document.getElementById(this.carrouselSlider)
        if(!this.carrouselSlider){
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
                formData.append('file', blobURL, 'image');
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
        data.forEach(element => {
            let slick = $('#preview-carousel').slick();
            $('#preview-carousel').slick('slickAdd', `<div></div>`);
        });
        // data.indicators.forEach(indicator => {   
        //     this.createSliderButton(indicator);
        //     indicator.el = document.getElementById(indicator.el)
        // });
        // data.items.forEach(item => {
        //     this.createCarouselImage(item);
        //     item.el = document.getElementById(item.el)
        // });

        // this.reloadCarousel(data.items, data.indicators);
    }

    createSliderButton(dataIndicators) {
        const carrouselSliderButton = document.createElement('button');
        carrouselSliderButton.type = 'button';
        carrouselSliderButton.className = 'w-3 h-3 rounded-full';
        carrouselSliderButton.setAttribute('data-carousel-slide-to', dataIndicators.position);
        carrouselSliderButton.id = `carousel-slider-${dataIndicators.position}`;
        this.carrouselSlider.insertAdjacentElement('afterbegin', carrouselSliderButton);    
        return carrouselSliderButton;
    }

    createCarouselImage(data) {
        const innerDiv = document.createElement('div');
        innerDiv.className = 'duration-700 ease-in-out absolute inset-0 transition-transform transform z-10 translate-x-full z-20';
        innerDiv.id = `carousel-image-${data.position}`;
        innerDiv.setAttribute('data-carousel-item', data?.isActive);
        innerDiv.setAttribute('data-carousel-number', data.position);
        
        const img = document.createElement('img');
        img.className = 'absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2';
        img.src = data?.src ?? '';
        img.alt = '...';
    
        innerDiv.appendChild(img);
            
        this.rootCarrousel.insertAdjacentElement('beforeend', innerDiv);

        return innerDiv;
    }

    reloadCarousel(items, indicators) {
        const options = {
            defaultPosition: 0,
            indicators: {
                activeClasses: 'bg-white dark:bg-gray-800',
                inactiveClasses:
                    'bg-white/50 dark:bg-gray-800/50 hover:bg-white dark:hover:bg-gray-800',
                items: indicators,
            },
        };
        
        const instanceOptions = {
            id:'preview-carousel',
            override: true
        };


        let root = document.getElementById('preview-carousel');
        this.rootCarrousel.remove();
        let carousel = new Carousel(root, items, options, instanceOptions);
    }

    getCarousel(dataToSend = {}){

        let fullUrl = 'carousel';
        let thisInstance = this;

        dataToSend = Object.assign(dataToSend, {method: 'POST'});

        fetch(fullUrl, dataToSend)
          .then((respuesta) => respuesta.json())
            .then(data => {
              
              thisInstance.createCarousel(data);
            
          }).catch(error => {
            console.error(error);
          });
      }
}

// let publicationDropZone = new PublicationDropzone('dropzone-file');