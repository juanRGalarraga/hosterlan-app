import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path';
import react from '@vitejs/plugin-react';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                // 'resources/css/calendar/calendar.css',
                // 'resources/js/calendar/calendar.js',
                'resources/js/app.jsx',
            ],
            refresh: true,
        }),
        react()
    ],
    commonjsOptions: {
        esmExternals: true 
    },
    resolve: {
        alias: {
            '@': path.resolve(__dirname, 'resources/js'),
        },
    },
});
