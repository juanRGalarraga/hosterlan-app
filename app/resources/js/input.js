export default class Input{

    input = null

    constructor(inputId){
        this.input = document.getElementById(inputId)
        if(!(this.input instanceof HTMLInputElement)){
            throw new Error("Input not found");
        }
    }

    checkFormatNumber(){
        this.input.onkeydown = (event) => {

            const regex = /^\d{1,8}\.*\d{0,2}$/; // Only Allows number with (8,2) format and optional decimal.

            let currentValue = event.target.value;

            let keyPressed = event.key;
            
            //Ignore this keys...
            if(!["Backspace", "Enter", "Tab"].includes( keyPressed )){
            
                let newValue = currentValue + keyPressed;

                if (!regex.test(newValue)) {
                    event.preventDefault(); 
                }

            }
        }
    }
}