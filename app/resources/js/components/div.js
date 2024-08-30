import Component from "./component"

export default class Div {

    static create(child, attributes = {}){
        return Component.create({tagName: 'div', attributes, child})
    }

}