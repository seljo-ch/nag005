import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    server: {
        host: '0.0.0.0', // Ermöglicht externen Zugriff
        port: 5173, // Standardport für Vite, kann geändert werden
        hmr: {
            host: 'dev.apps.nyffenegger.ch', // Ersetze mit deiner Apache-Domain oder IP-Adresse
        }
    }
});
