import Component from "./component";

export default class Anchor extends Component {

    static create(child, attributes = {}){
        return Component.createComponent({tagName: 'a', attributes, child})
    }
}