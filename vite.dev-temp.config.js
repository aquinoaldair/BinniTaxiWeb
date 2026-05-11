import baseConfig from './vite.config.js';
import { defineConfig, mergeConfig } from 'vite';

export default defineConfig(
    mergeConfig(baseConfig, {
        cacheDir: 'storage/framework/vite',
    }),
);
