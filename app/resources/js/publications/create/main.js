import Input from '../../input.js';
import PublicationFile from './files.js';
import AvailableDay from './availableDay.js';

let publicationFile = new PublicationFile('dropzone-file');
publicationFile.fillField();

let price = new Input('price');
price.checkFormatNumber();

new AvailableDay();