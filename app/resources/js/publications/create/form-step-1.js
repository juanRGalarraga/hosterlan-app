import Input from '../../components/input.js';
import PublicationFile from '../files.js';

let publicationFile = new PublicationFile({inputId: 'dropzone-file'});
publicationFile.fillField();

let price = new Input('price');
price.checkFormatNumber();

window.addEventListener('beforeunload', function (e) {
    let confirmationMessage = 'Are you sure you want to leave? Changes you made may not be saved.';
    e.returnValue = confirmationMessage; // Gecko, Trident, Chrome 34+
    return confirmationMessage; // Gecko, WebKit, Chrome <34
});