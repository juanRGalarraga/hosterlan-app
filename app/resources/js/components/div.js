import Util from "./util"

export default class Div {

    static create(child, attributes = {}){
        let div = Util.createElement('div');

        Util.addAtributes(div, attributes);

        if(child instanceof HTMLElement){
            div.appendChild(child);
        } else if(typeof child == "function"){
            child(div);
        }

        return div;
    }

}