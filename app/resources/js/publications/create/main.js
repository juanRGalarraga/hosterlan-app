import Input from '../../input.js';
import PublicationFile from './files.js';

let publicationFile = new PublicationFile('dropzone-file');

let price = new Input('price');

price.checkFormatNumber();

publicationFile.fillField();