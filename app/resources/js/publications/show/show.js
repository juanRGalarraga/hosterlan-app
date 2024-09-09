import DOM from '../../components/dom';

export default class PublicationShow {
    buttonsReserveDay = 'buttons-reserve-day'
    buttonCloseId = 'buttonCloseView';
    buttonClose;

    constructor(){
        this.loadButtonClose(this.buttonCloseId);
        this.loadButtonReserveDay(this.buttonsReserveDay);
    }

    loadButtonClose(id){
        this.buttonClose = document.getElementById(id);
        this.buttonClose.onclick = () => {
            this.returnToList();
        }
    }

    loadButtonReserveDay(element){
        let reserveDayText = DOM.captureElement('reserveDayText');
        this.buttonsReserveDay = DOM.captureElements(element);

        this.buttonsReserveDay.forEach(button => {
            button.onclick = () => {
                let date = DOM.$(button).attr('data-date');

                let dayAvailableId = DOM.$(button).attr('data-day-available-id');

                DOM.$('publication_day_available_id').attr('value', dayAvailableId);
                reserveDayText.innerText = date;
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