import Input from '../../components/old/input.js';
import PublicationFile from '../files.js';

let publicationFile = new PublicationFile({inputId: 'dropzone-file', persist: false});
publicationFile.fillField();

let price = new Input('price');
price.checkFormatNumber();