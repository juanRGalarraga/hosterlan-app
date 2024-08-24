export default class Alert {

    alert

    constructor(){
        return this;
    }

    init(id){
        if(typeof id !== "string") return;
        this.alert = document.getElementById(id)
        this.hidden(this.alert);
        return this;
    }

    hidden(alert){
        if( !(alert instanceof HTMLElement) ) return
        if( alert.classList.contains('hidden') ) return
        alert.classList.add('hidden')
    }
    show(alert){
        if( !(alert instanceof HTMLElement) ) return
        if( !alert.classList.contains('hidden') ) return
        debugger
        alert.classList.remove('hidden')
    }
}