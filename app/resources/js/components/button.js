import Component from "./component";

export default class Button extends Component {
    static create(child, attributes = {}){
        return Button.create({tagName: 'button', attributes, child})
    }
}