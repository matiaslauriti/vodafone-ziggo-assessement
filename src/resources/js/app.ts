import '../css/app.css';

import { createInertiaApp } from '@inertiajs/vue3';
import { createApp, DefineComponent, h } from 'vue';
import { ZiggyVue } from "ziggy-js";
import Layout from './layouts/Layout.vue';
import {resolvePageComponent} from "laravel-vite-plugin/inertia-helpers";

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => (title ? `${title} - ${appName}` : appName),
    resolve: async (name) => {
        const page = await resolvePageComponent(
            `./pages/${name}.vue`,
            import.meta.glob<DefineComponent>('./pages/**/*.vue'),
        );

        page.default.layout = page.default.layout || Layout;

        return page;
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
