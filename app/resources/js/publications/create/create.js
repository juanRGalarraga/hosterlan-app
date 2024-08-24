export default class PublicationCreate {
    form = null
    formId = "publicationForm"
    buttonToSendForm = null
    buttonToSendFormId = "buttonPublicationForm"
    url = ''

    constructor(){
        this.form = document.getElementById(this.formId)
        if( !(this.form instanceof HTMLFormElement) ){
            throw new Error("Form not found"); 
        }
        
        this.buttonToSendForm = document.getElementById(this.buttonToSendFormId)
        if( !(this.buttonToSendForm instanceof HTMLButtonElement) ){
            throw new Error("Button not found"); 
        }

        this.loadSendForm();
    }

    loadSendForm(){
        this.buttonToSendForm.onclick = (event) => {
            this.preventDefault();
            this.stopPropagation();
            // this.sendForm();
        }
    }

    sendForm(){
        let formData = new FormData(this.form);

        for (let [key, value] of publicationDropZone.formData) {
            formData.append(key, value);
        }
        
        fetch(this.form.getAttribute('url'), {
            method: 'POST',
            body: formData
        })
        .then(data => {
            console.log(data);
        }).catch(error => {
            console.log(error);
        });
    }
}