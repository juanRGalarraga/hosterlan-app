import DOM from "./dom"
export default class ContextMenu {

    contextMenu
    clickeableZone
    deleteAction
    modifyAction
    options= {
        clickeableZoneElement: null,
        withModifier: true,
        withDeleter: true
    }

    constructor(options){
        this.options = Object.assign({}, this.options, options)
    }

    setClickeableZone(clicleableZone = null){

        this.clickeableZone = clicleableZone;

        if(typeof this.options.clickeableZoneElement == "string"){
            if(!this.options.clickeableZoneElement.startsWith('#')){
                this.options.clickeableZoneElement = `#${this.options.clickeableZoneElement}`;
                this.clickeableZone = document.querySelector(this.options.clickeableZoneElement)
            }
        }
    
        if( !(this.clickeableZone instanceof HTMLElement)){
            return console.error("clickeableZone not found");
        }
    }

    loadContextMenu(){

        let thisInstance = this

        this.clickeableZone.addEventListener('contextmenu', (e) => {
            e.preventDefault();
            thisInstance.contextMenu.setAttribute('id', e.target.getAttribute('data-id'));
            thisInstance.contextMenu.style.top = `${e.clientY}px`;
            thisInstance.contextMenu.style.left = `${e.clientX}px`;
            thisInstance.contextMenu.classList.remove('hidden');            
        });

        document.addEventListener('click', () => {
            thisInstance.hiddenContextMenu();
        });
    }

    createContextMenu(contextMenu = null){
        this.contextMenu = contextMenu;

        if(typeof contextMenu == "string"){
            this.contextMenu = document.getElementById(contextMenu);
        }

        if( !(this.contextMenu instanceof HTMLElement) ){
            this.contextMenu = this.createDefaultContextMenu();
        }

        document.getElementsByTagName('body')[0].appendChild(this.contextMenu);
    }

    createDefaultContextMenu(){
        let contextMenu = document.createElement('div');
        contextMenu.className = "hidden absolute bg-white border border-gray-300 shadow-lg rounded-md w-48";

        let ul = document.createElement('ul');
        ul.className = "list-none p-0 m-0";

        if(this.options.withModifier){
            let liModify = document.createElement('li');
            liModify.className = "px-4 py-2 hover:bg-gray-100 cursor-pointer mycss-text-black";
            liModify.insertAdjacentText('afterbegin', 'Modificar');
            ul.appendChild(liModify)
            if(typeof this.options.modifyAction == 'function'){
                liDelete.onclick = () => {
                    this.options.modifyAction.call(this, this.clickeableZone);
                }
            }
        }

        if(this.options.withDeleter){
            let liDelete = document.createElement('li');
            liDelete.className = "px-4 py-2 hover:bg-gray-100 cursor-pointer mycss-text-black";
            liDelete.insertAdjacentText('afterbegin', 'Eliminar');
            if(typeof this.options.deleteAction == 'function'){
                liDelete.onclick = () => {
                    this.options.deleteAction.call(this, this.clickeableZone);
                }
            }

            ul.appendChild(liDelete)
        }

        contextMenu.appendChild(ul);



        return contextMenu;
    }

    hiddenContextMenu(){
        this.contextMenu.classList.add('hidden');
    }
}