import Util from "./util";

export default class Label {

    static create(text, attributes = {}){
        if(typeof text !== "string"){
            throw new Error("Text must be string type");
        }

        let label = Util.createElement('label');

        Util.addAtributes(label, attributes);

        return label;
    }

}