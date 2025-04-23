import Component from "./component";

export default class Table {

    static td(child = null, attributes = {}){
        return Component.create({tagName: 'td', attributes, child})
    }

    static th(child = null, attributes = {}){
        return Component.create({tagName: 'th', attributes, child})
    }

    static tr(child = null, attributes = {}){
        return Component.create({tagName: 'tr', attributes, child})
    }
}