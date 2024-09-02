export default class ObjectHelper {
    
    static isEmpty(obj){

        if(!obj || typeof obj != "object") return false;

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

    
    static searchPropertyByValue(obj, valorBuscado) {
        for (const propiedad in obj) {
          if (obj.hasOwnProperty(propiedad)) {
            const valores = Object.values(obj[propiedad]);
      
            if (valores.includes(valorBuscado)) {
              return propiedad;
            }
          }
        }
      
        return null; // Devuelve null si no se encuentra el valor
      }
}