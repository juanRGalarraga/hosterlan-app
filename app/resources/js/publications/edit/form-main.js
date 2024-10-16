import PublicationFile from "../files";
import Fetch from "../../components/fetch";
import { format } from "../../utilities/url";
import Alert from "../../components/alert";

class PublicationEdit {
    buttonUploadId = 'buttonUpdatePublication'
    fetch = null;

    constructor() {
        this.fetch = new Fetch();
        this.buttonUpload = document.getElementById(this.buttonUploadId);
        this.buttonUpload.addEventListener('click', this.updatePublication);
    }

    updatePublication() {
        let form = document.getElementById('publicationForm');
        let publicationId = document.getElementById('id')?.value;
        
        this.fetch.json(`publications/update/${publicationId}`,
            { method: 'PUT', body: new FormData(form) }).then(response => 
        {
            if (response.status !== 200) {
                Alert.error({ title: response.title, message: response.message });
                return;
            }

            Alert.success({ title: response.title, message: response.message });
            window.location.href = format(`publications/show/${publicationId}`, window.location.origin);
            return;
        }
        );
    }
}

let publicationFile = new PublicationFile({ inputId: "dropzone-file" });

let publicationId = document.getElementById("id").value;

publicationFile.getUploadedFiles(publicationId);

new PublicationEdit();