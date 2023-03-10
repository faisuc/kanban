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
import BoardCreate from './components/BoardCreate.vue';
import BoardColumn from './components/BoardColumn.vue';
import BoardColumnCreate from './components/BoardColumnCreate.vue';
import ColumnCard from './components/ColumnCard.vue';
import CardCreate from './components/CardCreate.vue';
import CardModal from './components/CardModal.vue';

app.component('board-index', BoardIndex);
app.component('board-show', BoardShow);
app.component('board-create', BoardCreate);
app.component('board-column', BoardColumn);
app.component('board-column-create', BoardColumnCreate);
app.component('column-card', ColumnCard);
app.component('card-create', CardCreate);
app.component('card-modal', CardModal);

app.use(ZiggyVue, Ziggy);
app.mount('#app');