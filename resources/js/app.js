import './bootstrap';
import { createApp } from 'vue';

const app = createApp({
    provide: {
        loggedInUserID: document.querySelector("meta[name='user-id']").getAttribute("content")
    }
});

import BoardIndex from './components/BoardIndex.vue';
app.component('board-index', BoardIndex);

app.mount('#app');