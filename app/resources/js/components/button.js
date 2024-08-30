import Component from "./component";

export default class Button {
    static create(child, attributes = {}){
        return Component.createComponent({tagName: 'button', attributes, child})
    }
}