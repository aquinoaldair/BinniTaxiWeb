import '../css/app.css';
import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';

createInertiaApp({
    title: (title) => (title ? `${title} | BinniTaxi` : 'BinniTaxi'),
    progress: {
        color: '#2E8B57',
        delay: 120,
        includeCSS: true,
        showSpinner: false,
    },
    resolve: async (name) => {
        const pages = import.meta.glob('./Pages/**/*.vue');
        const page = pages[`./Pages/${name}.vue`];

        if (!page) {
            throw new Error(`Inertia page not found: ${name}`);
        }

        const module = await page();

        return 'default' in module ? module.default : module;
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .mount(el);
    },
});
