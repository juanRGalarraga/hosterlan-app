document.addEventListener('DOMContentLoaded', ev => {
  publicationLoadOnClickToShow();
});

function publicationLoadOnClickToShow() {
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

function publicationLoadFiltersEvents() {
  let search = document.getElementById('search');
  let publication_state = document.getElementById('publication_state');
  let available_from = document.getElementById('available_from');
  let available_to = document.getElementById('available_to');
  let price_min = document.getElementById('price_min');
  let price_max = document.getElementById('price_max');
  let roomCount = document.getElementById('roomCount');
  let bathroomCount = document.getElementById('bathroomCount');
  let rentType = document.getElementById('rentType');
  let withPets = document.getElementById('withPets');
}

function loadPublications() {
  let publicationMainlist = document.getElementById('publicationMainlist');
  fetch('publications/render')
    .then((respuesta) => respuesta.blob())
    .then(blob => {
      publicationMainlist = blob.text();
    });
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
