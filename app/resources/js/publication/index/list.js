import ObjectHelper from "../../objectHelper";

export default class PublicationList {

  mainCardList = null;
  listId = 'publicationMainlist';
  static KEY_ENTER = "Enter";

  constructor(){
    this.loadOnClickToShow(this.listId);
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


  getList(dataToSend = null){
    let thisObj = this;
    let publicationMainlist = document.getElementById('publicationMainlist');
    let url = 'publications/list';

    if( !ObjectHelper.isEmpty(dataToSend)){
        const queryString = new URLSearchParams(dataToSend).toString();
    
        url = `${url}?${queryString}`;
    }
    console.log(url);
    fetch(url, dataToSend)
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