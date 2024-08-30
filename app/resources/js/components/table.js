import Component from "./component";

export default class Table extends Component {

    static td(child = null, attributes = {}){
        return Table.create({tagName: 'td', attributes, child})
    }

    static th(child = null, attributes = {}){
        return Table.create({tagName: 'th', attributes, child})
    }

    static tr(child = null, attributes = {}){
        return Table.create({tagName: 'tr', attributes, child})
    }
}