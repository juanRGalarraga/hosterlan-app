import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import 'flowbite';

import NavigationSearch from './navigation-search';

new NavigationSearch();