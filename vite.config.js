import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/challenges.css',
                'resources/js/app.js',
                'resources/js/welcome-page.js'
            ],
            refresh: true,
        }),
    ],
    build: {
        manifest: true,
        outDir: 'public/build',
        rollupOptions: {
            output: {
                manualChunks: undefined,
            }
        }
    },
    // Ensure assets use absolute paths in production
    base: process.env.APP_ENV === 'production' ? process.env.VITE_ASSET_URL || '/' : '/',
});
