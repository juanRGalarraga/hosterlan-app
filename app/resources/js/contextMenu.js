export default class ContextMenu {

    contextMenu
    clickeableZone
    deleteAction
    modifyAction

    setClickeableZone(clickeableZoneElement){
        this.clickeableZone = clickeableZoneElement;

        if(typeof clickeableZoneElement == "string"){
            if(!clickeableZoneElement.startsWith('#')){
                clickeableZoneElement = `#${clickeableZoneElement}`;
                this.clickeableZone = document.querySelector(clickeableZoneElement)
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

            if (this.clickeableZone?.id) {
                thisInstance.contextMenu.setAttribute(this.clickeableZone.id);
            }

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

        if( !(contextMenu instanceof HTMLElement) ){
            this.contextMenu = this.createDefaultContextMenu();
        }

        document.getElementsByTagName('body')[0].appendChild(this.contextMenu);
    }

    createDefaultContextMenu(){
        let contextMenu = document.createElement('div');
        contextMenu.className = "hidden absolute bg-white border border-gray-300 shadow-lg rounded-md w-48";

        let ul = document.createElement('ul');
        ul.className = "list-none p-0 m-0";

        let liModify = document.createElement('li');
        liModify.className = "px-4 py-2 hover:bg-gray-100 cursor-pointer mycss-text-black";
        liModify.insertAdjacentText('afterbegin', 'Modificar');

        let liDelete = document.createElement('li');
        liDelete.className = "px-4 py-2 hover:bg-gray-100 cursor-pointer mycss-text-black";
        liDelete.insertAdjacentText('afterbegin', 'Eliminar');

        ul.appendChild(liDelete)
        ul.appendChild(liModify)
        contextMenu.appendChild(ul);

        return contextMenu;
    }

    hiddenContextMenu(){
        this.contextMenu.classList.add('hidden');
    }

    addDeleteAction(callback){
        deleteAction.click = (e) => {
            callback();
            thisInstance.hiddenContextMenu();
        }
    }

    addModifyAction(callback){
        if(typeof callback != "function"){
            return console.error();
        }

        modifyAction.click = (e) => {
            callback();
            thisInstance.hiddenContextMenu();
        }
    }

}