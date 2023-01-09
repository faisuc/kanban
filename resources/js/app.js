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
import BoardColumnCreate from './components/BoardColumnCreate.vue';
import ColumnCard from './components/ColumnCard.vue';
import CardCreate from './components/CardCreate.vue';

app.component('board-index', BoardIndex);
app.component('board-show', BoardShow);
app.component('board-column', BoardColumn);
app.component('board-column-create', BoardColumnCreate);
app.component('column-card', ColumnCard);
app.component('card-create', CardCreate);

app.use(ZiggyVue, Ziggy);
app.mount('#app');

app.config.compilerOptions.isCustomElement = (tag) => {
    return tag.startsWith('board-column');
}