let availableDateFrom = document.getElementById("availableDateFrom"),
    availableDateTo = document.getElementById("availableDateTo");


let options = {
    navigator: false
}

document.addEventListener('DOMContentLoaded', e => {
    jsCalendar.new(availableDateFrom, new Date(), options);
    jsCalendar.new(availableDateTo, new Date(), options);
});