import DOM from "./dom";
import Table from "./table";

export default class Component {

    static create({tagName, attributes= {}, child = null}){
        let element = DOM.createElement(tagName);

        DOM.addAtributes(element, attributes);

        element = Component.extendProto(element);

        if(child instanceof HTMLElement){
            DOM.$(element).append(child);
        } else if(typeof child == "string"){
            DOM.$(element).text(child);
        } else if(typeof child == "function"){
            child(element);
        }

        return element;
    }

    static extendProto(element){
        element.__proto__.td = function(child, attributes = {}) {
            DOM.$(element).append((Table.td(child, attributes)))
        };
        element.__proto__.th = function(child, attributes = {}) {
            DOM.$(element).append(Table.th(child, attributes))
        };
        return element;
    }
}