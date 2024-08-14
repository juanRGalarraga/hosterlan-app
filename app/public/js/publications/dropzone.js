class PublicationDropzone {

    input = null
    rootCarrousel = 'rootCarrousel'
    carrouselPlaceholder = 'carrousel-placeholder'
    carrouselSlider = 'carrousel-slider'
    items = []

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
            .then( base64 => thisInstance.createImageComponent(base64) )
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

    createImageComponent(base64){

        const carrouselSliderButton = document.createElement('button');
        carrouselSliderButton.id = `carousel-indicator-${itemNumber}`;
        this.carrouselSlider.inserAdjacentElement('afterbegin', carrouselSliderButton);

        let itemNumber = this.rootCarrousel.children.length;
        this.sliders.push({
            position: itemNumber,
            el: document.getElementById(`carousel-indicator-${itemNumber}`)
        });

        const options = {
            defaultPosition: 1,
            interval: 3000,
        
            indicators: {
                activeClasses: 'bg-white dark:bg-gray-800',
                inactiveClasses:
                    'bg-white/50 dark:bg-gray-800/50 hover:bg-white dark:hover:bg-gray-800',
                items: this.sliders,
            },
        
            // // callback functions
            // onNext: () => {
            //     console.log('next slider item is shown');
            // },
            // onPrev: () => {
            //     console.log('previous slider item is shown');
            // },
            // onChange: () => {
            //     console.log('new slider item has been shown');
            // },
        };

        
        let carrousel = new Carousel(this.rootCarrousel, this.items, options, instanceOptions);

        carrousel.cycle();
    }

    createImageComponent(base64Image) {

        this.carrouselPlaceholder.classList.add('hidden');

        const carrouselSliderButton = document.createElement('button');
        carrouselSliderButton.className = 'w-3 h-3 rounded-full';
        carrouselSliderButton.setAttribute('data-carousel-slide-to', this.rootCarrousel.children.length);
        
        const innerDiv = document.createElement('div');
        innerDiv.className = 'duration-700 ease-in-out absolute inset-0 transition-transform transform translate-x-0 z-30';
        innerDiv.setAttribute('data-carousel-item', '');
        innerDiv.setAttribute('data-carousel-number', this.rootCarrousel.children.length);
    
        const img = document.createElement('img');
        img.className = 'absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2';
        img.src = base64Image;
        img.alt = '...';
    
        innerDiv.appendChild(img);

        this.rootCarrousel.insertAdjacentElement('afterbegin', innerDiv);
    }
}

new PublicationDropzone('dropzone-file');