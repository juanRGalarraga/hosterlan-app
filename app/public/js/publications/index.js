class PublicationList {

  mainCardList = null;
  inputPearch = null;
  inputPublicationState = null;
  inputPvailableFrom = null;
  inputPvailableTo = null;
  inputPriceMin = null;
  inputPriceMax = null;
  inputPoomCount = null;
  inputPathroomCount = null;
  inputPentType = null;
  inputPithPets = null;
  listId = 'publicationMainlist';

  constructor(){
    this.loadOnClickToShow(this.listId);
    this.initInputsFilter();
    return this;
  }

  loadOnClickToShow(listId){
    this.mainCardList = document.getElementById(listId);

    if (!(this.mainCardList instanceof HTMLElement)) return console.error('Without element!');

    let elements = this.mainCardList.getElementsByClassName('clickeable-card');
    for (const element of elements) {
      element.onclick = (event) => {
        this.updateView(element);
      }
    }
  }

  initInputsFilter(){
    this.search = document.getElementById('search');
    this.publication_state = document.getElementById('publication_state');
    this.available_from = document.getElementById('available_from');
    this.available_to = document.getElementById('available_to');
    this.price_min = document.getElementById('price_min');
    this.price_max = document.getElementById('price_max');
    this.roomCount = document.getElementById('roomCount');
    this.bathroomCount = document.getElementById('bathroomCount');
    this.rentType = document.getElementById('rentType');
    this.withPets = document.getElementById('withPets');
  }

  getList(){
    let publicationMainlist = document.getElementById('publicationMainlist');
    fetch('publications/render')
      .then((respuesta) => respuesta.blob())
      .then(blob => {
        publicationMainlist = blob.text();
      });
  }

  viewPublication(id){
    window.open('publications/' + id, '_self');
  }

  updateView(element){
  
    if (!document.startViewTransition) {
      this.viewPublication(element.id)
      return;
    }
  
    // With View Transitions:
    const transition = document.startViewTransition(() => this.viewPublication(element.id));

  }

}




document.addEventListener('DOMContentLoaded', ev => {
  new PublicationList();
});