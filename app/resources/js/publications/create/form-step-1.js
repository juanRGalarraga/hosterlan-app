import Input from '../../components/input.js';
import PublicationFile from '../files.js';

let publicationFile = new PublicationFile({inputId: 'dropzone-file', persist: false});
publicationFile.fillField();

let price = new Input('price');
price.checkFormatNumber();