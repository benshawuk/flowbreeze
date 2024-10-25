import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import basicSsl from '@vitejs/plugin-basic-ssl'; // Import the SSL plugin

export default defineConfig({
    plugins: [
        //basicSsl(),
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
    // server: {
    //     https: true, // Enable HTTPS
    //     host: 'localhost', // Use 'localhost' or '0.0.0.0' for LAN access
    //     port: 5173, // Default port, adjust if needed
    // },
});
