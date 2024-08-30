import Component from "./component";

export default class Label {

    static create(text, attributes = {}){
        return Component.create({tagName: 'label', attributes, text});
    }

}