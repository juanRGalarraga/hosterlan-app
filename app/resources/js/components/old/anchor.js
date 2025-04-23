import Component from "./component";

export default class Anchor {

    static create(child, attributes = {}){
        return Component.create({tagName: 'a', attributes, child})
    }
}