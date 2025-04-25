import './bootstrap';
import { createRoot } from 'react-dom/client'
import { createInertiaApp } from '@inertiajs/react'
import { store } from './store/index'
import { Provider } from 'react-redux'
import { setUser } from '@/store/slices/authSlice'

createInertiaApp({
    resolve: name => {
        const pages = import.meta.glob('./pages/**/*.tsx', { eager: true })
        return pages[`./pages/${name}.tsx`]
    },
    setup({ el, App, props }) {

        store.dispatch(setUser(props.auth?.user))

        createRoot(el).render(
            <Provider store={store}>
                <App {...props} />
            </Provider>
        )
    },
})