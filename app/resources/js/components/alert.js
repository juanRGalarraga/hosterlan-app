export default class Alert {

    alert

    constructor(){
        return this
    }

    init(id){
        if(typeof id !== "string") return;
        this.alert = document.getElementById(id)
        return this
    }

    hidden(alert){
        if( !(alert instanceof HTMLDivElement) ) return
        if( alert.classList.contains('hidden') ) return
        alert.classList.add('hidden')
    }
    show(alert){
        if( !(alert instanceof HTMLDivElement) ) return
        if( !alert.classList.contains('hidden') ) return
        alert.classList.remove('hidden')
    }
}