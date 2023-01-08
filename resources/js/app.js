import './bootstrap';
import { createApp } from 'vue';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';

const app = createApp({
    provide: {
        loggedInUserID: document.querySelector("meta[name='user-id']").getAttribute("content")
    }
});

import BoardIndex from './components/BoardIndex.vue';
app.component('board-index', BoardIndex);

app.use(ZiggyVue, Ziggy);
app.mount('#app');