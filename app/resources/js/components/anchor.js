import Component from "./component";

export default class Anchor extends Component {

    static create(child, attributes = {}){
        return Anchor.create({tagName: 'a', attributes, child})
    }
}