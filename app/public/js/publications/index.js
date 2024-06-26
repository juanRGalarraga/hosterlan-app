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
  static KEY_ENTER = "Enter";

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

    this.initEvents();
  }
  
  initEvents(){
    let thisObj = this;
    this.search.onkeyup = function(ev){
      if(ev.key == PublicationList.KEY_ENTER) {
        thisObj.getList({search:ev.target.value})
      }
    }
  }


  getList(dataToSend = null){
    let thisObj = this;
    const url = 'publications/list';
    const params = dataToSend;

    // Convert parameters to a query string
    const queryString = new URLSearchParams(params).toString();

    // Append query string to the URL
    const fullUrl = `${url}?${queryString}`;

    let publicationMainlist = document.getElementById('publicationMainlist');
    fetch(fullUrl, dataToSend)
      .then((respuesta) => respuesta.blob())
      .then(blob => {
        blob.text().then(text => {
          publicationMainlist.innerHTML = text;
          thisObj.loadOnClickToShow(thisObj.listId);
        });
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