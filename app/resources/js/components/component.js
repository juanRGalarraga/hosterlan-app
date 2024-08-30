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

    /**
     * This method is useful to generate a td element into parent element.
     * When is neccessary use a callback in create() method, this allow to 
     * call the appendChild method in it.
     * @param HTMLElement element 
     * @returns 
     */
    static extendProto(element){
        if(!(element instanceof HTMLElement)){
            throw new Error("element must be an HTMLElement");
        }

        element.__proto__.td = function(child, attributes = {}) {
            DOM.$(element).append((Table.td(child, attributes)))
        };
        element.__proto__.th = function(child, attributes = {}) {
            DOM.$(element).append(Table.th(child, attributes))
        };
        return element;
    }
}