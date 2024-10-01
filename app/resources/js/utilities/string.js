export function isEmptyString(subject) {
    return typeof subject != "string" || subject.length < 1;
}