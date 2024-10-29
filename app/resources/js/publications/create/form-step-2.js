import AvailableDay from "./availableDay";
import ObjectHelper from "../../utilities/objectHelper";
import Fetch from "../../components/fetch";
import { format } from "../../utilities/url";
import Alert from "../../components/alert";
class FormStep2 {
    buttonSendForm
    availableDay
    fetch

    constructor() {
        this.fetch = new Fetch();

        this.availableDay = new AvailableDay();

        this.buttonSendForm = document.getElementById("buttonSendForm");
        this.loadOnClick();
    }

    loadOnClick() {
        let thisInstance = this;
        this.buttonSendForm.onclick = function (event) {
            if (ObjectHelper.isEmpty(AvailableDay.dates)) {
                return Alert.warning({
                    title: 'Atención',
                    text: "Cargue al menos una fecha"
                });
            }
            thisInstance.sendForm();
        };
    }

    sendForm() {
        let form = document.getElementById("publicationStep2Form");
        if (!(form instanceof HTMLFormElement)) {
            return console.error("Form not found");
        }

        let url = format('publications/create', window.location.origin);
        
        let publicationId = form.querySelector('#publication_id')?.value ?? "";

        if (!publicationId) {
            return Alert.error({
                'title': 'Error',
                'text': 'Publication ID no encontrado'
            });
        }
        
        let init = {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                "X-CSRF-TOKEN": form.querySelector('[name="_token"]')?.value ?? ""
            },
            body: {
                publication_id: publicationId,
                days: AvailableDay.getArrayDates()
            },
        };
        this.fetch.json(url, init).then((response) => {
            debugger
            if (response.status == 200) {
                window.location.href = response.redirect;
            }
        });
    }
}

new FormStep2();