import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/main.scss',
                'resources/css/library.scss',
                'resources/css/application.scss',
                'resources/css/animations.scss',
                'resources/js/app.js',
                'resources/js/list-create.js',
                'resources/js/animations.js',

            ],
            refresh: true,
        }),
    ],
});
