import {defineConfig} from 'vite'
import {viteStaticCopy} from 'vite-plugin-static-copy'
import path from "path";

// https://vitejs.dev/config/

//Add All css and js here
//Important: Key must be output filepath without extension, and value will be the file source
const inputs = [
    'resources/elementor/product-variation-select-control.js',
]
export default defineConfig({
    plugins:
        [
            viteStaticCopy({
                targets: [
                    {src: 'resources/images', dest: ''},
                ]
            })
        ],

    build: {
        manifest: true,
        outDir: 'assets',
        //assetsDir: '',
        publicDir: 'assets',
        //root: '/',
        emptyOutDir: true, // delete the contents of the output directory before each build

        // https://rollupjs.org/guide/en/#big-list-of-options
        rollupOptions: {
            input: inputs,
            output: {
                chunkFileNames: '[name].js',
                entryFileNames: '[name].js',
            },
        },
    },

    resolve: {
        alias: {
            'vue': 'vue/dist/vue.esm-bundler.js',
            '@': path.resolve(__dirname, 'resources/admin'),
        },
    },

    server: {
        port: 4230,
        strictPort: true,
        cors: {
            origin: '*',
            methods: ['GET'],
            allowedHeaders: ['Content-Type', 'Authorization'],
        },
        hmr: {
            port: 4230,
            host: 'localhost',
            protocol: 'ws',
        }
    }
})
