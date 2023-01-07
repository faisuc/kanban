import './bootstrap';
import { createApp } from 'vue';

const app = createApp({});

import BoardIndex from './components/BoardIndex.vue';
app.component('board-index', BoardIndex);

app.mount('#app');