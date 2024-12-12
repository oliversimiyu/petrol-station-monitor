import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import sass from 'sass';
import dartSass from 'sass';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
    css: {
        preprocessorOptions: {
            scss: {
                implementation: dartSass,
            },
        },
    },
});
