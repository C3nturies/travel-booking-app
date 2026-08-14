import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { bunny } from 'laravel-vite-plugin/fonts';
import tailwindcss from '@tailwindcss/vite';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                //'resources/scss/app.scss',
                'resources/scss/pages/home.scss',
                'resources/scss/pages/destinations.scss',
                'resources/scss/pages/destination-details.scss',
                'resources/scss/pages/booking.scss',
                //'resources/css/app.css',
                //'resources/js/app.js'

                'resources/js/pages/home.js',
                'resources/js/pages/destinations.js',
                'resources/js/pages/destination-details.js',
                'resources/js/pages/booking.js',
                ],
            refresh: true,
            fonts: [
                bunny('Instrument Sans', {
                    weights: [400, 500, 600],
                }),
            ],
        }),
        //tailwindcss(),
        vue(),
    ],
    resolve: {
        alias: {
            vue: 'vue/dist/vue.esm-bundler.js'
        }
    },
    server: {
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
});
