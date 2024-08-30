import Component from "./component";

export default class Table {

    static td(child = null, attributes = {}){
        return Component.createComponent({tagName: 'td', attributes, child})
    }

    static th(child = null, attributes = {}){
        return Component.createComponent({tagName: 'th', attributes, child})
    }

    static tr(child = null, attributes = {}){

        let tr = Component.createComponent({tagName: 'tr', attributes, child})

        return tr;
    }
}