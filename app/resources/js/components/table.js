import Util from "./util";

export default class Table {

    static td(child){

        let td = Util.createElement('td');

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

    static th(content = null){

        let th = Util.createElement('th');

        Util.addClass(th, 'px-6','py-4','font-medium','text-gray-900','whitespace-nowrap','dark:text-white');

        if(content instanceof HTMLElement){
            th.appendChild(content);
        }

        return th;
    }

    static tr(child = null){

        let tr = Util.createElement('tr');

        Util.addClass(tr, 'w-bg-white','border-b','dark:bg-gray-800','dark:border-gray-700','hover:bg-gray-50','dark:hover:bg-gray-600');

        tr.__proto__.td = function(element) {
            tr.appendChild(Table.td(element))
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