class Input{

    input = null

    constructor(inputId){
        this.input = document.getElementById(inputId)
        if(!(this.input instanceof HTMLInputElement)){
            throw new Error("Input not found");
        }
    }

    checkFormatNumber(){
        this.input.onchange = (event) => {
            let userInput = parseInt(event.target.value);
            let pattern = new RegExp('/^\d{3,8}\.*\d{0,2}$/', 'g');
            let itHaveOnlyDigits = pattern.test(userInput);
            if(!itHaveOnlyDigits){
                event.target.value = '';
            }
        }
    }
}