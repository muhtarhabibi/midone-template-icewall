import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { viteStaticCopy } from "vite-plugin-static-copy";

export default defineConfig({
    plugins: [
        viteStaticCopy({
            targets: [
                {
                    src: "resources/images",
                    dest: "assets",
                },
                {
                    src: "resources/json",
                    dest: "assets",
                },
            ],
        }),
        laravel({
            input: [
                "resources/css/app.css",
                "resources/js/app.js",
                "resources/js/midone/ckeditor-classic.js",
                "resources/js/midone/ckeditor-inline.js",
                "resources/js/midone/ckeditor-balloon.js",
                "resources/js/midone/ckeditor-balloon-block.js",
                "resources/js/midone/ckeditor-document.js",
            ],
            refresh: true,
        }),
    ],
});
