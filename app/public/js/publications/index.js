document.addEventListener('DOMContentLoaded', ev => {
    publicationsOnClick();
});

function publicationsOnClick() {
    console.log("Im in line 6");
    let mainCardList = document.getElementById('card-list');
    if (!(mainCardList instanceof HTMLElement)) return console.error('Without element!');

    mainCardList.onclick = (ev) => {
        console.log(ev.target.tagName);
        if (ev.target.tagName == "x-booking-card") {
            ev.preventDefault();
            ev.stopImmediatePropagation();
            }
    }
}

function viewPublication(publicationId) {
    
}

function updateView(event) {

    // Handle the difference in whether the event is fired on the <a> or the <img>
    const targetIdentifier = event.target.firstChild || event.target;
  
    const displayNewImage = () => {
      const mainSrc = `${targetIdentifier.src.split("_th.jpg")[0]}.jpg`;
      galleryImg.src = mainSrc;
      galleryCaption.textContent = targetIdentifier.alt;
    };
  
    // Fallback for browsers that don't support View Transitions:
    if (!document.startViewTransition) {
      displayNewImage();
      return;
    }
  
    // With View Transitions:
    const transition = document.startViewTransition(() => displayNewImage());
}