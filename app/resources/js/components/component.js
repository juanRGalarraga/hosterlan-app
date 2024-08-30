import Util from "./util";
import Table from "./table";

export default class Component {

    static createComponent({tagName, attributes= {}, child = null}){
        let element = Util.createElement(tagName);

        Util.addAtributes(element, attributes);

        element = Component.extendProto(element);

        if(child instanceof HTMLElement){
            Util.$(element).append(child);
        } else if(typeof child == "string"){
            Util.$(element).text(child);
        } else if(typeof child == "function"){
            child(element);
        }

        return element;
    }

    static extendProto(element){
        element.__proto__.td = function(child, attributes = {}) {
            element.appendChild(Table.td(child, attributes))
        };
        element.__proto__.th = function(child, attributes = {}) {
            element.appendChild(Table.th(child, attributes))
        };
        return element;
    }
}