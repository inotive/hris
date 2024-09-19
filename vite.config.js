import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/js/app.js', 
                // 'resources/template/plugins/global/plugins.bundle.js',
                // 'resources/template/js/scripts.bundle.js',
                // 'resources/template/js/widgets.bundle.js',
                // 'resources/template/js/custom/widgets.js',
                // 'resources/template/js/custom/authentication/sign-in/general.js',

                'resources/css/app.css', 
                // 'resources/template/plugins/global/plugins.bundle.css', 
                // 'resources/template/css/style.bundle.css',
            ],
            refresh: true,
        }),
    ],
});
