import Component from "./component"

export default class Div extends Component {

    static create(child, attributes = {}){
        return Div.create({tagName: 'div', attributes, child})
    }

}