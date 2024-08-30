import Util from "./util";

export default class Table {

    static td(child = null, attributes = {}){

        let td = Util.createElement('td');

        Util.addAtributes(td, attributes);

        Util.addClass(td, 'w-4', 'p-4');

        if(child instanceof HTMLElement){
            td.appendChild(child);
        } else if(typeof child == "string"){
            td.insertAdjacentText('beforeend', child);
        } else if(typeof child == "function"){
            child(td);
        } 

        return td;
    }

    static th(child = null, attributes = {}){

        let th = Util.createElement('th');

        Util.addAtributes(th, attributes);

        if(child instanceof HTMLElement){
            th.appendChild(child);
        } else if(typeof child == "string"){
            th.insertAdjacentText('beforeend', child);
        } else if(typeof child == "function"){
            child(th);
        }

        return th;
    }

    static tr(child = null, attributes = {}){

        let tr = Util.createElement('tr');

        Util.addAtributes(tr, attributes);

        tr.__proto__.td = function(element, attributes = {}) {
            tr.appendChild(Table.td(element, attributes))
        };

        tr.__proto__.th = function(element, attributes = {}) {
            tr.appendChild(Table.th(element, attributes))
        };

        if(child instanceof HTMLTableCellElement){
            tr.appendChild(child);
        } else if(typeof child == "string"){
            tr.insertAdjacentText('beforeend', child);
        } else if(typeof child == "function"){
            child(tr);
        } 

        return tr;
    }
}