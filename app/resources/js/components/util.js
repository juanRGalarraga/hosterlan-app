import ObjectHelper from "../utilities/objectHelper";

export default class Util {

    static element

    static createElement(element){
        if(typeof element != "string"){
            throw new Error("Element must be an string");
        }
        return document.createElement(element)
    }

    static addClass(element, ...classes){
        if(!(element instanceof HTMLElement)){
            throw new Error("Element must be an HTMLElement instance");
        }

        element.classList.add(...classes)
    }

    static removeClass(element, ...classes){
        if(!(element instanceof HTMLElement)){
            throw new Error("Element must be an HTMLElement instance");
        }

        element.classList.remove(...classes)
    }

    static addAtributes(element, attributes){

        if(!(element instanceof HTMLElement)){
            throw new Error("Element must be and HTMLElement instance");
        }
        
        if(!ObjectHelper.isEmpty(attributes)){
            if(typeof attributes != "object"){
                throw new Error("Attributes must be an object");
            }
            for (const name in attributes) {
                Util.addAtribute(element,{name: name, value: attributes[name]});
            }
        }

        return element;
    }

    static addAtribute(element, {name, value}){

        if(!(element instanceof HTMLElement)){
            throw new Error("Element must be and HTMLElement instance");
        }
        
        if(typeof name != "string"){
            throw new Error("Name must be a string and value cannot be null");
        }

        return element.setAttribute(name, value);
    }

    static append(child){
        if(!(Util.element instanceof HTMLElement)){
            throw new Error("element must be an HTMLElement");
        }
        if(!(child instanceof HTMLElement)){
            throw new Error("Child must be an HTMLElement");
        }
        Util.element.insertAdjacentElement('beforeend', child)
    }

    static text(child){
        if(!(Util.element instanceof HTMLElement)){
            throw new Error("element must be an HTMLElement");
        }
        if(typeof child != "string"){
            throw new Error("Child must be a string");
        }
        Util.element.insertAdjacentText('beforeend', child)
    }


    static $(element){
        if(!(element instanceof HTMLElement)){
            throw new Error("element must be an HTMLElement");
        }
        Util.element = element
        return Util;
    }



}