export default class SimpleHash {

    static generate(str) {
        let hash = 0;
        if (str.length === 0) return hash;
      
        for (let i = 0; i < str.length; i++) {
          const char = str.charCodeAt(i); // Obtener el código ASCII del carácter
          hash = (hash << 5) - hash + char; // Operación de desplazamiento y adición
          hash |= 0; // Convertir a un número entero de 32 bits
        }

        //Convert to positive number
        if(hash < 0) hash = hash * -1;
      
        return hash.toString(); // Devolver el hash como string
      }

}