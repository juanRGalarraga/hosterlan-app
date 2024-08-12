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
            event.preventDefault();
            let userInput = event.target.value;
            let itHaveOnlyDigits = /^\d{1,20}\.*\d{0,2}$/.test(userInput);
            
            if(!itHaveOnlyDigits){
                event.target.value = userInput.substring(0, userInput.length-1);
            }
        }
    }
}