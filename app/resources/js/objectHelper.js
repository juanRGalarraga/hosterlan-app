export default class ObjectHelper {
    
    static isEmpty(obj){

        if (Object.keys(obj).length === 0) {
            return true;
        }

        for (let key in obj) {

            if (obj.hasOwnProperty(key)) {
                const value = obj[key];
                if (
                    value === null ||
                    value === undefined ||
                    (typeof value === 'string' && value.trim() === '') ||
                    (Array.isArray(value) && value.length === 0) ||
                    (typeof value === 'object' && ObjectHelper.isEmpty(value))
                ) {
                    continue;
                } else {
                    return false; 
                }
            }
        }

        // Si todas las propiedades están vacías, el objeto está vacío
        return true;
    }

}