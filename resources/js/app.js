import './bootstrap';
import { createApp } from 'vue';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';

const app = createApp({
    provide: {
        loggedInUserID: document.querySelector("meta[name='user-id']").getAttribute("content")
    }
});

import BoardIndex from './components/BoardIndex.vue';
import BoardShow from './components/BoardShow.vue';
app.component('board-index', BoardIndex);
app.component('board-show', BoardShow);

app.use(ZiggyVue, Ziggy);
app.mount('#app');