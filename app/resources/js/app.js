import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import 'flowbite';
import Search from './components/search';
import PublicationList from './publications/index/list';

let search = new Search('search');

let publicationList = new PublicationList;
search.loadListener((input) => {
    publicationList.getList({search: input.value});
});