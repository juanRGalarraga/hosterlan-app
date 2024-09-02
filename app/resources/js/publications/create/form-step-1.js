import Input from '../../components/input.js';
import PublicationFile from './files.js';

let publicationFile = new PublicationFile('dropzone-file');
publicationFile.fillField();

let price = new Input('price');
price.checkFormatNumber();