import Component from "./component";

export default class Label extends Component {

    static create(text, attributes = {}){
        return Label.create({tagName: 'label', attributes, text});
    }

}