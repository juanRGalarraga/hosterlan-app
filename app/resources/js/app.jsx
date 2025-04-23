import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import 'flowbite';
import { createRoot } from 'react-dom/client'
import { createInertiaApp } from '@inertiajs/react'
import { store } from './store/index'
import { Provider } from 'react-redux'

createInertiaApp({
    resolve: name => {
        const pages = import.meta.glob('./pages/**/*.tsx', { eager: true })
        return pages[`./pages/${name}.tsx`]
    },
    setup({ el, App, props }) {
        createRoot(el).render(
            <Provider store={store}>
                <App {...props} />
            </Provider>
        )
    },
})