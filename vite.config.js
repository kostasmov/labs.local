import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/style.css',
                'resources/js/calendar.js',
                'resources/js/date_updater.js',
                'resources/js/photos-table.js'
            ],
            refresh: true,
        }),
    ],
    optimizeDeps: {
        include: [
            'resources/js/date_updater.js',
            'resources/js/photos-table.js'
        ],
    }
});
