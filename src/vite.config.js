import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    assetsInclude: ['**/*.png', '**/*.jpg', '**/*.jpeg', '**/*.svg'],

    plugins: [
        laravel({
            input: ['resources/js/app.js'],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
