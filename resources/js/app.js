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
import BoardColumn from './components/BoardColumn.vue';
import ColumnCard from './components/ColumnCard.vue';

app.component('board-index', BoardIndex);
app.component('board-show', BoardShow);
app.component('board-column', BoardColumn);
app.component('column-card', ColumnCard);

app.use(ZiggyVue, Ziggy);
app.mount('#app');