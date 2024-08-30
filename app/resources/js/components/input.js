import Component from "./component";

export default class Input extends Component {

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

    static create(child = null, attributes = {}){

        let input = Input.create({tagName: 'input', attributes, child})

        if(!attributes['class'] ?? ''){
            input.className = 
            `rounded-none rounded-r-lg 
            bg-gray-50 border text-gray-900 
            focus:ring-blue-500 focus:border-blue-500 
            block flex-1  w-full text-sm border-gray-300 
            p-2.5  dark:bg-gray-700 dark:border-gray-600 
            dark:placeholder-gray-400 dark:text-white 
            dark:focus:ring-blue-500 dark:focus:border-blue-500 
            minimal-input ml-2`;
        }

        return input;
    }
}