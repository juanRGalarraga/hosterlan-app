import AvailableDay from "./availableDay";
import ObjectHelper from "../../utilities/objectHelper";
import Fetch from "../../components/fetch";
import { format } from "../../utilities/url";
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
                return console.error("No hay fechas disponibles");
            }
            thisInstance.sendForm();
        };
    }

    sendForm() {
        let form = document.getElementById("publicationStep2Form");
        if (!(form instanceof HTMLFormElement)) {
            return console.error("Form not found");
        }

        let formData = new FormData(form);

        formData.append("available", JSON.stringify(AvailableDay.dates));
        let url = format('publication/create/2', window.location.origin);
        this.fetch.json({
            url: url,
            method: form.method ||= "POST",
            header: {
                "X-CSRF-TOKEN": formData.get("_token")
            },
            body: form,
            success: function (response) {
                console.log(response);
            },
            error: function (error) {
                console.error(error);
            }
        });
    }
}

new FormStep2();