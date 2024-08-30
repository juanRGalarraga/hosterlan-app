import Component from "./component"

export default class Div {

    static create(child, attributes = {}){
        return Component.createComponent({tagName: 'div', attributes, child})
    }

}