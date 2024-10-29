import PublicationFile from "../files";
import Fetch from "../../components/fetch";
import { format } from "../../utilities/url";
import Alert from "../../components/alert";

class PublicationEdit {
    buttonUploadId = 'buttonUpdatePublication'
    fetch = null;

    constructor() {
        this.loadButtonUpload()
    }

    loadButtonUpload() { 
        this.buttonUpload = document.getElementById(this.buttonUploadId);
        this.buttonUpload.addEventListener('click', () => {
            this.updatePublication();
        });
    }

    updatePublication() {
        if (!this.checkValidity()) {
            return;
        }

        // let publicationId = document.getElementById('id')?.value;
        // this.fetch = new Fetch();
        
        // this.fetch.json(`publications/update/${publicationId}`,
        //     { method: 'PUT', body: new FormData(form) }).then(response => 
        // {
        //         if (response.status !== 200) {
        //         console.log(response);
                
        //         Alert.error({ title: response.title, text: response.message });
        //         return;
        //     }

        //     Alert.success({ title: response.title, text: response.message });
        //     window.location.href = format(`publications/show/${publicationId}`, window.location.origin);
        //     return;
        // }
        // );
    }

    checkValidity() {
        let title = document.getElementById("title").value,
            price = document.getElementById("price").value,
            ubication = document.getElementById("ubication").value;
        
        let messages = {};
        if (!title || title.length < 5) {
            messages['title'] = "Titulo es requerido (Debe contener al menos 5 caracteres)";
        }

        if (!price) {
            messages['price'] = "Precio es requerido";
        }

        if (!ubication) {
            messages['ubication'] = "Ubicación es requerida";
        }
        
        if (Object.keys(messages).length > 0) {
            Alert.warning({title: 'Atención', text: 'Completa los datos faltantes antes de continuar'});
            return false;
        }
        return true;
    }
}

let publicationFile = new PublicationFile({ inputId: "dropzone-file" });

let publicationId = document.getElementById("id").value;

publicationFile.getUploadedFiles(publicationId);

new PublicationEdit();