export default class String {

    isEmpty(subject) {
        return typeof subject != "string" || subject.length < 1;
    }

}