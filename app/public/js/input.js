class Input{

    input = null

    constructor(inputId){
        this.input = document.getElementById(inputId)
        if(!(this.input instanceof HTMLInputElement)){
            throw new Error("Input not found");
        }
    }

    checkFormatNumber(){
        this.input.onkeydown = (event) => {
            // Define tu expresión regular aquí
            const regex = /^\d{1,8}\.*\d{0,2}$/; // Ejemplo: solo permite letras y números

            // Captura el valor actual del input
            let currentValue = event.target.value;

            // Captura la tecla que el usuario presiona
            let keyPressed = event.key;
            
            if(!["Backspace", "Enter", "Tab"].includes( keyPressed )){
            
                // Genera el nuevo valor si se permite escribir la tecla presionada
                let newValue = currentValue + keyPressed;
    
                // Verifica si el nuevo valor cumple con la expresión regular
                if (!regex.test(newValue)) {
                    event.preventDefault(); 
                }

            }

        }
    }
}