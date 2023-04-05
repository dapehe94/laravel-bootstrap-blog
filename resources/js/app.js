import './bootstrap';
import '../sass/app.scss';
import * as bootstrap from 'bootstrap'

import { createApp, h, ref } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import moment from 'moment/min/moment-with-locales';

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';
const app_locale = ref(import.meta.env.VITE_LOCALE);

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {

        const app = createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue, Ziggy);
            

        // apply global filters
        app.config.globalProperties.$filters = {
            mmmddyyyy(date) {
                moment.locale(`${app_locale}`)
                return moment(date).format("MMM DD, YYYY")
            },
            fromnow(date) {
                moment.locale(`${app_locale}`)
                return moment(date).fromNow()
            },
            // more filters
        }

        app.mount(el);

    },
    progress: {
        color: '#4B5563',
    }
});