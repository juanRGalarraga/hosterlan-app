import AvailableDay from "./availableDay";

new AvailableDay();

window.onbeforeunload = (event) => {
    return "Seguro que quiere abandonar la pagina?"
    // this.preventDefault();
    // navigator.sendBeacon('/connection-close', JSON.stringify({
    //     page: window.location.pathname
    // }));
    // event.returnValue = true;

};