import Input from '../../components/input.js';
import PublicationFile from './files.js';

let publicationFile = new PublicationFile({inputId: 'dropzone-file'});
publicationFile.fillField();

let price = new Input('price');
price.checkFormatNumber();