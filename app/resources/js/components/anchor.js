import Util from "./util";

export default class Anchor {

    static create(child, attributes = {}){

        let a = Util.createElement('a');

        Util.addAtributes(a, attributes);

        if(child instanceof HTMLElement){
            a.appendChild(child);
        } else if(typeof child == "string"){
            a.insertAdjacentText('beforeend', child);
        } else if(typeof child == "function"){
            child(a);
        }

        return a;
    }
}