import Component from "./component";

export default class Label {

    static create(text, attributes = {}){
        return Component.createComponent({tagName: 'label', attributes, text});
    }

}