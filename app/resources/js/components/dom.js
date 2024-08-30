import ObjectHelper from "../utilities/objectHelper";

export default class DOM {

    static element


    /**
     * Capture and element for the id or for the instance
     * @param {string|HTMLElement} element 
     * @returns {HTMLElement}
     * @throws {Error}
     */
    static captureElement(element){
        let ele = element;
        if(typeof element == "string"){
            ele = document.getElementById(element)
        }
console.log(element);
console.log(ele);

        if(!(ele instanceof HTMLElement)){
            throw new Error("Element not found");
        }
        return ele;
    }

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
                DOM.addAtribute(element,{name: name, value: attributes[name]});
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
        if(!(DOM.element instanceof HTMLElement)){
            throw new Error("element must be an HTMLElement");
        }
        if(!(child instanceof HTMLElement)){
            throw new Error("Child must be an HTMLElement");
        }
        DOM.element.insertAdjacentElement('beforeend', child)
    }

    static text(child){
        if(!(DOM.element instanceof HTMLElement)){
            throw new Error("element must be an HTMLElement");
        }
        if(typeof child != "string"){
            throw new Error("Child must be a string");
        }
        DOM.element.insertAdjacentText('beforeend', child)
    }


    static $(element){
        if(!(element instanceof HTMLElement)){
            throw new Error("element must be an HTMLElement");
        }
        DOM.element = element
        return DOM;
    }



}