import DOM from '../../components/dom';
import Fetch from '../../components/fetch';
import { format } from '../../utilities/url';
import alert from '../../components/alert';

export default class PublicationShow {
    buttonsReserveDay = 'buttons-reserve-day'
    buttonCloseId = 'buttonCloseView';
    buttonClose;
    fetch

    constructor(){
        this.loadButtonClose(this.buttonCloseId);
        this.loadButtonReserveDay(this.buttonsReserveDay);
        this.fetch = new Fetch();
    }

    loadButtonClose(id){
        this.buttonClose = document.getElementById(id);
        this.buttonClose.onclick = () => {
            this.returnToList();
        }
    }

    loadButtonReserveDay(element){
        this.buttonsReserveDay = DOM.captureElements(element);
        this.buttonsReserveDay.forEach(button => {
            button.onclick = () => {
                let available_day_id = DOM.$(button).attr('data-day-available-id');
                let publication_id = DOM.$(button).attr('data-publication-id');
                let reserveId = DOM.$(button).attr('data-reserve-id');
                
                
                if (reserveId) {
                    let url = format(`reservation/create/${reserveId}`, window.location.origin);
                    
                    window.location.href = url;
                    return;
                }
                let dataToSend = {
                    publication_id,
                    available_day_id,
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('[name="_token"]').value
                    }
                }
                let url = format(`reservation/create`, window.location.origin, dataToSend);
                window.location.href = url;
            }
        });
    }

    returnToList(){

        const viewList = () => {
            window.history.back();
        }

        if (!document.startViewTransition) {
            viewList();
            return;
        }
    
        document.startViewTransition(() => viewList());
    }
}