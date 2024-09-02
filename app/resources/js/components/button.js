import Component from "./component";

export default class Button {
    static create(child, attributes = {}){
        return Component.create({tagName: 'button', attributes, child})
    }
}